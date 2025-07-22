<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(): Response
    {
        $viewData = [
            'title' => 'Login'
        ];

        return response()->view('auth.login.index', $viewData);
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(User::EMAIL_INPUT_NAME, User::PASSWORD_INPUT_NAME);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    User::EMAIL_INPUT_NAME => 'Invalid email or password.',
                ])
                ->withInput($request->except(User::PASSWORD_INPUT_NAME));
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('task.index'))
            ->with('success', 'Welcome, ' . Auth::user()->name . '!');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
}
