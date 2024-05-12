<?php

declare(strict_types=1);

namespace App\Services\Post;

use App\Models\Post;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

final class Recommendation
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        $preferences = $this->discoverUserPreferences();

        return $preferences->isEmpty()
            ? Post::orderBy('likes')->limit(3)->get()
            : Post::where('rooms', $preferences[0]->rooms)
                ->where('type', $preferences[0]->type)
                ->whereDoesntHave('appointments', function (Builder $query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->whereBetween('size', [$preferences[0]->size - 25, $preferences[0]->size + 25])
                ->whereBetween('price', [$preferences[0]->price - 50, $preferences[0]->price + 50])
                ->with('pictures')
                ->get();
    }

    /**
     * @return Collection
     */
    private function discoverUserPreferences(): Collection
    {
        return Post::select('rooms', 'type')
            ->groupBy('rooms')
            ->groupBy('type')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->selectRaw('AVG(size) as size')
            ->selectRaw('AVG(price) as price')
            ->whereHas('appointments', function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->get();
    }
}
