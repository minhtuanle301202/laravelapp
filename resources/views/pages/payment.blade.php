@extends('layouts.users.master')
@section('title', 'Payment')
@section('content')
    <link href="{{ asset('css/pages/payment.css') }}" rel="stylesheet">
    <div class="col-12 link">
        <div class="breadcrumb">
            <a class="home" href="{{ route('home') }}">Trang chủ</a>
            <span>>></span>
            <a href="{{ route('cart.show') }}" class="cart-payment-link">Giỏ hàng</a>
            <span>>></span>
            <a href="#" class="payment-link">Thanh toán</a>
        </div>
    </div>
    <div class="payment-container">
        <div class="order-info">
            <div class="title">Nhập đầy đủ thông tin để đặt hàng</div>
            <form id="order-form" method="POST" action="{{ route('cart.placeAnOrder') }}">
                @csrf
                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Họ tên <span>*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên" value="{{ $user->username }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ nhận hàng <span>*</span></label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" required>
                </div>
                <div class="form-group">
                    <label for="phone-number">Số điện thoại <span>*</span></label>
                    <input type="text" class="form-control" id="phone-number" name="phone_number" placeholder="+84xxxxxxxxx" value="{{ $user->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="payment-method">Phương thức thanh toán <span>*</span></label>
                    <input type="text" class="form-control" id="payment-method" name="payment_method" value="Thanh toán khi nhận hàng" readonly>
                </div>
                <div class="total-price">
                    <div class="title">Tổng tiền thanh toán:</div>
                    <div class="text-price" data-cart-price="{{ $cart->price }}">{{ number_format($cart->price, 0, ',', '.') }} VND</div>
                </div>
                <div class="button-form">
                    <button type="submit" class="btn btn-primary btn-order">Đặt hàng</button>
                    <button class="btn-back-to-home btn btn-primary"><a href="{{ route('home') }}">Quay lại trang chủ</a></button>
                </div>

            </form>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/payment.js') }}"></script>