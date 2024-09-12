@extends('layouts.admin.master')
@section('title', 'Danh Sách Đơn Hàng')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    @include('layouts.partials-admin.sidebar')
    <div class="main-content col-10">
        <div class="container">
            <div class="row mb-4 align-items-end ml-3">
                <div class="col-md-5 pl-0">
                    <label for="orderStatus">Trạng thái đơn hàng:</label>
                    <select class="form-control" id="orderStatus" name="status">
                        <option value="">Tất cả</option>
                        <option value="Chờ xử lý">Chờ xử lý</option>
                        <option value="Đang giao hàng">Đang giao hàng</option>
                        <option value="Giao hàng thành công">Giao hàng thành công</option>
                        <option value="Đã hủy">Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="orderCode">Mã đơn hàng:</label>
                    <input type="text" class="form-control" id="orderCode" name="order_code" placeholder="Nhập mã đơn hàng">
                </div>
            </div>
            <div class="row mb-4 align-items-end ml-3">
                <div class="col-md-5 pl-0">
                    <label for="startDate">Ngày đặt từ ngày:</label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" id="startDate" name="start_date" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="endDate">Đến ngày:</label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" id="endDate" name="end_date" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn-search ml-3">Tìm kiếm</button>
            @if ($orders->isNotEmpty())
            <h2 class="ml-3 mb-3">Danh Sách Đơn Hàng</h2>
            <div id="orders-content">
                @include('layouts.partials-admin.orders', ['orders' => $orders])
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" name="page-numbers"  id="page-numbers" value="1">
            <div class="pagination-orders">
                <button id="prev-orders" class="prev-orders">
                    << Previous
                </button>
                <button id="next-orders" class="next-orders">
                    Next >>
                </button>
            </div>
        </div>
        @else
            <p class="text-center">Không tìm thấy đơn hàng nào.</p>
        @endif
    </div>

    <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="editOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLabel">Chỉnh Sửa Đơn Hàng</h5>
                </div>
                <div class="modal-body">
                    <form id="editOrderForm">
                        @csrf
                        <input type="hidden" id="editOrderId" name="id">
                        <div class="form-group">
                            <label for="editUserName">Người mua</label>
                            <input type="text" class="form-control" id="editUserName" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="editAddress">Địa chỉ</label>
                            <input type="text" class="form-control" id="editAddress" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="editPhone">Điện thoại</label>
                            <input type="text" class="form-control" id="editPhone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="editOrderDate">Ngày đặt</label>
                            <input type="date" class="form-control" id="editOrderDate" name="order_date" required>
                        </div>
                        <div class="form-group">
                            <label for="editPaymentMethod">Phương thức thanh toán</label>
                            <input type="text" class="form-control" id="editPaymentMethod" name="payment_method" value="Thanh toán khi nhận hàng" readonly>
                        </div>

                        <div class="form-group">
                            <label for="editOrderStatus">Trạng thái</label>
                            <select class="form-control" id="editOrderStatus" name="status" required>
                                @foreach($statusCollection as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="updateOrderButton">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/manage_orders.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
