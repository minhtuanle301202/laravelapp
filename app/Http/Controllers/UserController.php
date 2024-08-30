<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showRegistrationForm()
    {
        return view('auth.signup');
    }

    public function handleRegisterUser(UserRegisterRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->userService->registerUser($validatedData);
        Auth::login($user);
        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function handleLoginUser(UserLoginRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->userService->loginUser($validatedData);

        if ($user) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->withErrors(['login_error' => 'Tên người dùng hoặc mật khẩu không đúng.']);
        }
    }

    public function handleLogout()
    {
       $this->userService->logoutUser();

       return redirect()->route('home');
    }

}



