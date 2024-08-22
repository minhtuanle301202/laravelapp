@extends('layouts.admin.master')
@section('content')
    <div class="form-login">
        <div class="group-login group-log">
            <h1>
                Đăng nhập tài khoản
            </h1>

            <form method="post" action="{{ route('admin.login.process') }}" id="customer_login" accept-charset="UTF-8">
                @csrf
                <fieldset class="form-group">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" class="form-control form-control-lg" value="" name="email" id="email" placeholder="Email" required="">
                </fieldset>
                <fieldset class="form-group">
                    <label>Mật khẩu <span class="required">*</span> </label>
                    <input type="password" class="form-control form-control-lg" value="" name="password" id="password" placeholder="Mật khẩu" required="">
                </fieldset>
                <button class="btn-login" type="submit" value="Đăng nhập">Đăng nhập</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/login.js') }}"></script>
@endsection