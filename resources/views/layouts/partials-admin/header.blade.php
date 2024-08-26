<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/partials-admin/header.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header class="main-header">
    <div class="header-left">
        <h1>Admin Manage</h1>
    </div>
    <div class="header-right">
        <i class="fa-solid fa-user-tie"></i>
        <button class="btn btn-danger">Đăng xuất</button>
    </div>
</header>

<div class="admin-container">
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="#" class="active">Quản lý sản phẩm</a></li>
            <li><a href="#">Quản lý đơn hàng </a></li>
            <li><a href="#">Quản lý tài khoản</a></li>
            <li><a href="#">Thống kê và báo cáo</a></li>
            <li><a href="#">Quản lý nội dung trang web</a></li>
        </ul>
    </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
