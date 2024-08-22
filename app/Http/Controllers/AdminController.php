<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected AdminService $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function showLoginForm()
    {
        return view('layouts.pages-admin.login');
    }

    public function handleLoginAdmin(AdminLoginRequest $request)
    {

        $validatedData = $request->only('email','password');
        $admin = $this->adminService->loginAdmin($validatedData);


        if ($admin) {
            return redirect()->route('admin.manage.users');
        } else {
            return redirect()->route('admin.login')->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function showManageUsersPage()
    {
        $users = $this->adminService->getAllUsers();

        return view('layouts.pages-admin.manage_users', compact('users'));
    }
}
?>