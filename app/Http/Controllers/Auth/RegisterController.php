<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\src\Auth\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $viewData = [
            'title' => 'Register'
        ];

        return response()->view('auth.register.index', $viewData);
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->userService->register($request);

        return redirect()->route('task.index');
    }
}
