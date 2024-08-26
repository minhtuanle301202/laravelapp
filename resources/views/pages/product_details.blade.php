@extends('layouts.users.master')
@section('title', 'Product Detail')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/product-details.css') }}">
    <div class="go-home">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span>>></span>
        <a href="#">Điện thoại di động</a>
        <span>>></span>
        <p>{{ $product->name }}</p>
    </div>
    <div class="product-detail-container">
        <div class="header-product-detail-container">
            <div class="product-image col-12 col-sm-4">
                <img src="{{ $product->image }}" alt="Image">
                <span class="is-loved"></span>
            </div>
            <div class="product-detail col-12 col-sm-8">
                <div class="product-name" data-product-id="{{ $product->id }}">{{ $product->name }}</div>
                <div class="line"></div>
                <div class="price" id="product-price" >{{ number_format($initialPrice, 0, ',', '.') }} VND</div>
                <div class="description">{{ $product->description }}</div>
                <div class="variants">
                    <div class="variant">
                        <div class="title">Chọn màu sắc:</div>
                        <div id="color-buttons">
                            @foreach($product->variants->unique('color') as $variant)
                                <button class="color-button btn btn-outline-primary {{ $loop->first ? 'active' : '' }}"
                                        data-color="{{ $variant->color }}"
                                        data-price="{{ $variant->price }}"
                                        data-storage="{{ $variant->capacity }}"
                                        data-variant-id="{{ $variant->id }}">
                                    {{ $variant->color }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="variant">
                        <div class="title">Chọn dung lượng:</div>
                        <div id="storage-buttons">
                            @foreach($product->variants->unique('capacity') as $variant)
                                <button class="storage-button btn btn-outline-primary {{ $loop->first ? 'active' : '' }}"
                                        data-storage="{{ $variant->capacity }}"
                                        data-price="{{ $variant->price }}"
                                        data-color="{{ $variant->color }}"
                                        data-variant-id="{{ $variant->id }}">
                                    {{ $variant->capacity }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="quantity">
                    <div class="title">Số lượng:</div>
                    <div class="change-quantity">
                        <button class="btn-subtract">-</button>
                        <input type="text" class="now-quantity" value="1">
                        <button class="btn-add ">+</button>
                    </div>
                </div>
                @auth
                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                        <input type="hidden" name="product_id" id="product-id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" id="variant-id">
                        <input type="hidden" name="quantity" id="quantity">
                        <input type="hidden" name="price" id="variant-price" >
                        <input type="hidden" name="final_price" id="final-price">
                        <button type="submit" class="add-to-cart btn btn-primary">Thêm vào giỏ hàng</button>
                    </form>
                    <button class="link-to-cart"><a href="{{ route('cart.show') }}">Đến giỏ hàng</a></button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary add-to-cart">Đăng nhập để thêm vào giỏ hàng</a>
                @endauth
                <div id="stock-alert"></div>
            </div>
        </div>
    </div>

    <div id="cart-alert" class="cart_alert">
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/product_details.js') }}"></script>
@endsection
