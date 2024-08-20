<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserService {
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser($validatedData)
    {
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'user';
        $user = $this->userRepository->create($validatedData);
        return $user;
    }

    public function loginUser($validatedData)
    {
        if (Auth::attempt(['email'=> $validatedData['email'],'password' => $validatedData['password']])) {
            return Auth::user();
        }

        return null;
    }

    public function logoutUser()
    {
        Auth::logout();

        return true;
    }
}

?>