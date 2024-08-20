@extends('layouts.users.master')
@section('title','Cart')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/cart.css') }}">
    <div class="col-12 link">
            <div class="breadcrumb">
                <a class="home" href="{{ route('home') }}">Trang chủ</a>
                <span>>></span>
                <a class="cart-link">Giỏ hàng</a>
            </div>
    </div>

    <div class="cart-container">
        <div class="cart-title">Giỏ hàng của bạn</div>
        <div class="line"></div>
        <div class="main-cart-pages">
            @if ($cartItems->isNotEmpty())
                <div class="cart-detail">
                    <table>
                        <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td class="product-image" ><img src="{{ $cartItem->productVariant->product->image }}" alt="Image"></td>
                                <td class="product-name" data-cartitem-id="{{ $cartItem->id }}" >{{ $cartItem->productVariant->product->name }}-{{ $cartItem->productVariant->color }}-{{ $cartItem->productVariant->capacity }}</td>
                                <td class="variant-price-{{ $cartItem->id }}" data-variant-price="{{ $cartItem->productVariant->price }}">{{ number_format($cartItem->productVariant->price,0,',','.') }} VND</td>
                                <td class="product-quantity">
                                    <div class="change-quantity">
                                        <button class="btn-subtract" data-cartitem-id="{{ $cartItem->id }}">-</button>
                                        <input type="text" class="now-quantity-{{ $cartItem->id }} now-quantity" data-cartitem-id="{{ $cartItem->id }}" value="{{ $cartItem->quantity }}">
                                        <button class="btn-add" data-cartitem-id="{{ $cartItem->id }}">+</button>
                                    </div>
                                </td>
                                <td class="cartItem-price-{{ $cartItem->id }}">{{ $cartItem->price }}</td>
                                <td><button class="btn-delete btn btn-primary"  data-cartitem-id="{{ $cartItem->id }}"><i class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        </tbody>
                    </table>
                </div>
                <div class="total-price">
                    <div class="title">Tổng tiền thanh toán:</div>
                    <div class="text-price">{{ number_format($cart->price, 0, ',', '.') }} VND</div>
                </div>
                <div class="cart-button">
                    <button class="remove-all btn btn-primary">Xóa tất cả</button>
                    <button class="pay btn btn-primary">Thanh toán</button>
                </div>
            @else
                <div class="cart-empty-message">
                    <img class="bag-svg" src="{{ asset('images/bag.svg') }}">
                    <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                </div>
            @endif
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/cart.js') }}"></script>

@endsection