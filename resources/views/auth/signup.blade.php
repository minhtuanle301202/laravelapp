@extends('layouts.users.master')
@section('title','Signup')
@section('content')


    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}">
    <div class="col-12 link">
        <div class="container">
            <div class="breadcrumb">
                <a class="home">Trang chủ</a>
                <span>>></span>
                <a class="sign-up">Đăng ký tài khoản</a>
            </div>
        </div>
    </div>

    <div class="page-content-account">
        <div class="container">
            <div class="row">
                <div class="left-col ">
                    <div class="group-login group-log">
                        <h1>
                            Đăng ký tài khoản
                        </h1>

                        <form method="post" action="{{ route('register') }}" id="customer_register" accept-charset="UTF-8">
                            @csrf
                            <fieldset class="form-group">
                                <label>Họ và tên<span class="required">*</span></label>
                                <input type="text" class="form-control form-control-lg" value="" name="username" id="username" placeholder="Họ và tên" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Số điện thoại <span class="required">*</span></label>
                                <input placeholder="Số điện thoại" type="text" pattern="\d+" id="Phone" class="form-control form-control-comment form-control-lg" name="phone" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" class="form-control form-control-lg" value="" name="email" id="email" placeholder="Email" required="">
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Mật khẩu <span class="required">*</span> </label>
                                <input type="password" class="form-control form-control-lg" value="" name="password" id="password" placeholder="Mật khẩu" required="">
                            </fieldset>
                            <button class="btn-login" type="submit" value="Đăng ký">Đăng ký</button>

                            @if ($errors->any())
                                <div class="error">
                                    <span>{{ $errors->first() }}</span>
                                </div>
                            @endif


                        </form>


                    </div>

                </div>
                <div class="right-col ">
                    <h6>
                        Quyền lợi với thành viên
                    </h6>
                    <div>
                        <p>Vận chuyển siêu tốc</p>
                        <p>Sản phẩm đa dạng	</p>
                        <p>Đổi trả dễ dàng</p>
                        <p>Tích điểm đổi quà</p>
                        <p>Được giảm giá cho lần mua tiếp theo lên đến 10%</p>
                    </div>
                    <a href="{{ route('login') }}" class="btn-register-default">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
@endsection