@extends('layouts.admin.master')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content')
    @include('layouts.partials-admin.sidebar')
    <div class="main-content col-10">
        <div class="container">
            <div class="go-home mb-3">
                <a href="/admin/manage/orders">Danh Sách Đơn Hàng</a>
                <span>>></span>
                <p>Chi Tiết Đơn Hàng</p>
            </div>
            <h2 class="mt-4 mb-4">Thông tin đơn mua</h2>
            <table class="table table-bordered order-info">
                <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Loại</th>
                    <th>Số lượng mua</th>
                    <th>Giá bán (VND)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->product->name }}</td>
                        <td>{{ $orderDetail->product->category->name }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ number_format($orderDetail->productVariant->price, 0, ',', '.')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="order-details">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Tên người đặt hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        {{ $order->username }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Địa chỉ nhận hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        {{ $order->address }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>SDT nhận hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        {{ $order->phone }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Hình thức thanh toán:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        {{ $order->payment_method }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
