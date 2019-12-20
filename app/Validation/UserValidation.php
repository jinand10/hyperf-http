<?php

declare(strict_types=1);

namespace App\Validation;

class UserValidation
{
    public function registerRule(): array
    {
        return [
            'name' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ];
    }

    public function registerMessage(): array
    {
        return [];
    }

    public function registerAttribute(): array
    {
        return [];
    }

    public function loginRule(): array
    {
        return [
            'phone' => 'required',
            'password' => 'required',
        ];
    }

    public function loginMessage(): array
    {
        return [];
    }

    public function loginAttribute(): array
    {
        return [];
    }
}
