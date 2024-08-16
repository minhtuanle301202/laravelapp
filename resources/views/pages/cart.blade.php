@extends('layouts.users.master')
@section('title','Cart')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/cart.css') }}">
    <div class="col-12 link">
        <div class="container">
            <div class="breadcrumb">
                <a class="home" href="{{ route('home') }}">Trang chủ</a>
                <span>>></span>
                <a class="cart-link">Giỏ hàng</a>
            </div>
        </div>
    </div>

    <div class="cart-container">
        <div class="cart-title">Giỏ hàng của bạn</div>
        <div class="line"></div>
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
                @if($cartItems !== null)
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td class="product-image" ><img src="{{ $cartItem->productVariant->product->image }}" alt="Image"></td>
                            <td class="product-name" data-cartitem-id="{{ $cartItem->id }}" >{{ $cartItem->productVariant->product->name }}-{{ $cartItem->productVariant->color }}-{{ $cartItem->productVariant->capacity }}</td>
                            <td class="variant-price" data-variant-price="{{ $cartItem->productVariant->price }}">{{ $cartItem->productVariant->price }}</td>
                            <td class="product-quantity">
                                <div class="change-quantity">
                                    <button class="btn-subtract {{ $cartItem->id }}">-</button>
                                     <input type="text" class="now-quantity {{ $cartItem->id }}" value="{{ $cartItem->quantity }}">
                                    <button class="btn-add {{$cartItem->id}}">+</button>
                                </div>
                            </td>
                            <td class="cartItem-price {{ $cartItem->id }}">{{ $cartItem->price }}</td>
                            <td><button class="btn-delete btn btn-primary">Xóa</button></td>
                        </tr>
                    @endforeach
                @else
                    <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                @endif
                </tbody>
            </table>
        </div>
        <div class="total-price">
            <div class="title">Tổng tiền thanh toán:</div>
            <div class="text-price ">{{ $cart->price }}</div>
        </div>
        <div class="cart-button">
            <button class="remove-all btn btn-primary">Xóa tất cả</button>
            <button class="pay btn btn-primary">Thanh toán</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/cart.js') }}"></script>

@endsection