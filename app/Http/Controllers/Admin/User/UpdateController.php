<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\PasswordChecker;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function __invoke(User $user, UpdateUserRequest $request)
    {
        $name = 'Пользователи';
        $data = $request->validated();

        $passwordErrors = (new PasswordChecker(
            $user, $data['old_password'], $data['password'], $data['password_confirmation']
        ))->process();

        if ($passwordErrors) {
            return redirect()->back()->withErrors($passwordErrors);
        }

        $data['password'] = Hash::make($data['password']);
        $user->update($data);

        return redirect()->route('admin.user.show', compact('user', 'name'));
    }
}
