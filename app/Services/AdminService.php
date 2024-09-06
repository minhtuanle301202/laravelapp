<?php
namespace App\Services;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;


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

    public function getNextUsers($page)
    {
        $users = $this->adminRepository->getNextUsers($page);
        return $users;
    }

    public function getPrevUsers($page)
    {
        $users = $this->adminRepository->getPrevUsers($page);
        return $users;
    }

    public function createUser($validatedData)
    {
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'user';
        $user = $this->adminRepository->createUser($validatedData);
        return $user;
    }

    public function getUserDetails($id)
    {
        $user = $this->adminRepository->getUserDetails($id);
        return $user;
    }

    public function updateUserDetails($id,$data)
    {
        $user = $this->adminRepository->updateUserDetails($id, $data);
        return $user;
    }

    public function deleteUser($id)
    {
        $state = $this->adminRepository->deleteUser($id);
        return $state;
    }

    public function getAllNews()
    {
        $news = $this->adminRepository->getAllNews();
        return $news;
    }
}
?>