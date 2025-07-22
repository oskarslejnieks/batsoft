<?php

declare(strict_types=1);

namespace App\src\Auth\Services;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\src\Auth\Factories\UserFactory;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private UserFactory $userFactory;

    public function __construct(
        UserFactory $userFactory
    ) {
        $this->userFactory = $userFactory;
    }

    /**
     * @param RegisterRequest $request
     * @return User
     */
    public function register(RegisterRequest $request): User
    {
        $data = $request->validated();

        $user = $this->userFactory->createUser(
            $data[User::NAME_INPUT_NAME],
            $data[User::EMAIL_INPUT_NAME],
            $data[User::PASSWORD_INPUT_NAME]
        );

        $user->save();
        Auth::login($user);

        return $user;
    }
}
