<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    protected AdminService $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function showLoginForm()
    {
        return view('pages-admin.login');
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

        return view('pages-admin.manage_users', compact('users'));
    }

    public function handleLogoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function handleGetNextUsers(Request $request)
    {
        $page = $request->page;
        $users = $this->adminService->getNextUsers($page);
        if ($users->isEmpty()) {
            return response()->json(['message' => 'Không còn dữ liệu']);
        } else {
            return response()->json($users);
        }

    }

    public function handleGetPreviousUsers(Request $request)
    {
        $page = $request->page;
        $users = $this->adminService->getPrevUsers($page);
        if ($users->isEmpty()) {
            return response()->json(['message' => 'Không còn dữ liệu']);
        } else {
            return response()->json($users);
        }
    }

    public function handleCreateUser(UserRegisterRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->adminService->createUser($validatedData);
        if ($user) {
            return response()->json(['message' => 'Thêm tài khoản thành công']);
        } else {
            return response()->json(['message' => 'Thêm tài khoản thất bại']);
        }
    }

    public function showUserDetails(Request $request)
    {
        $user = $this->adminService->getUserDetails($request->userId);
        if (!$user) {
            return response()->json(['message' => 'Tài khoản không tồn tại']);
        } else {
            return response()->json($user);
        }
    }

    public function updateUserDetails(EditUserRequest $request)
    {
        $user = $this->adminService->updateUserDetails($request->userId,$request);
        if ($user) {
            return response()->json(['message' => 'Cập nhật thông tin tài khoản thành công']);
        } else {
            return response()->json(['message' => 'Cập nhật thông tin tài khoản thất bại']);
        }
    }

    public function deleteUser(Request $request)
    {
        $state = $this->adminService->deleteUser($request->userId);
        if ($state) {
            return response()->json(['message' => 'Xóa tài khoản thành công']);
        } else {
            return response()->json(['message' => 'Xóa tài khoản thất bại']);
        }
    }

}
?>