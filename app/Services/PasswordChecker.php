<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordChecker
{
    public function __construct(
        private readonly User $user,
        private readonly ?string $oldPassword,
        private readonly ?string $password,
        private readonly ?string $passwordConfirmation
    ) {
    }

    /**
     * @return array
     */
    public function process(): array
    {
        $errors = [];

        if (
            $this->oldPassword && !Hash::check($this->oldPassword, $this->user->password) &&
            $this->password
        ) {
            $errors[] = 'Ошибка! Текущий пароль введён неверно';
        }

        if (!$this->oldPassword && ($this->password || $this->passwordConfirmation)) {
            $errors[] = 'Ошибка! Введите текущий пароль перед сменой';
        }

        return $errors;
    }
}
