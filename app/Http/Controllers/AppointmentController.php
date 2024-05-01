<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckPostOwner;
use App\Models\Appointment;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->id();
        $postId = $request->route('post');

        $existingAppointment = Appointment::where('user_id', $userId)
            ->where('post_id', $postId)
            ->exists();

        // Если отзыв уже существует, возвращаем ошибку
        if ($existingAppointment) {
            return redirect()->route('post.show', ['post' => $postId])->with('errorAppointment', 'Вы уже назначили встречу.');
        }

        $data = request()->validate([
            'date' => 'required|date',
            'note' => 'nullable|string',
            'approved' => 'boolean'
        ]);
        $data['user_id'] = auth()->id();
        $data['post_id'] = $request->route('post');

        Appointment::create($data);
        return redirect()->route('post.show', ['post' => $data['post_id']])->with('successAppointment', 'Вы добавили отзыв к посту.');
    }

    public function edit(Appointment $appointment)
    {
        return view('home.appointment.edit', compact( 'appointment') );
    }

    public function update(Appointment $appointment, Request $request)
    {
        $data = request()->validate([
            'date' => 'required|date',
            'note' => 'nullable|string',
            'approved' => 'boolean'
        ]);
        if ($request->has('approved')) {
            $data['approved'] = $request->approved;
            $data['user_id'] = $appointment->user_id;
        } else {
            $data['user_id'] = auth()->id();
        }
        $data['post_id'] = $appointment->post->id;


        $appointment->update($data);
        return redirect()->route('home.index');
    }

    public function destroy(Post $post, Appointment $appointment, Request $request)
    {

        $appointment->delete();
        return redirect()->route('home.index', $post->id);
    }
}
