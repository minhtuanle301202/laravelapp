<div class="admin-header">
    <h1>
        @if (request()->is('admin/manage/products*'))
            Quản Lý Sản Phẩm
        @elseif (request()->is('admin/manage/orders*'))
            Quản Lý Đơn Đặt Hàng
        @elseif (request()->is('admin/manage/users*'))
            Quản Lý Tài Khoản
        @elseif (request()->is('admin/statistics*'))
            Thống Kê Và Báo Cáo
        @elseif (request()->is('admin/manage/news*'))
            Quản Lý Tin Tức
        @else
            Trang Quản Trị
        @endif
    </h1>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Đăng Xuất</button>
    </form>
</div>
