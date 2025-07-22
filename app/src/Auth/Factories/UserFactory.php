<?php

declare(strict_types=1);

namespace App\src\Auth\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function createUser(string $name, string $email, string $password): User
    {
        $user = new User();
        $user->name = $name;
        $user->email = strtolower($email);
        $user->password = Hash::make($password);

        return $user;
    }
}
