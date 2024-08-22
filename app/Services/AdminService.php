<?php
namespace App\Services;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function loginAdmin($validatedData)
    {
        if (Auth::guard('admin')->attempt($validatedData)) {
            return Auth::guard('admin')->user();
        }

        return null;
    }

    public function getAllUsers()
    {
        $users = $this->adminRepository->getAllUsers();
        return $users;
    }
}
?>