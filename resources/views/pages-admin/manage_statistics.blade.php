@extends('layouts.admin.master')
@section('title', 'Thống Kê')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages-admin/manage_statistics.css') }}">
    @include('layouts.partials-admin.sidebar')
    <div class="main-content col-10">
        <div class="container">
            <ul class="nav nav-tabs mb-4" id="statsTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="revenue-chart-tab" data-toggle="tab" href="#revenue-chart" role="tab" aria-controls="revenue-chart" aria-selected="false">Doanh thu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-chart-tab" data-toggle="tab" href="#order-chart" role="tab" aria-controls="order-chart" aria-selected="false">Đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="top-revenue-tab" data-toggle="tab" href="#top-revenue" role="tab" aria-controls="top-revenue" aria-selected="true">Sản phẩm doanh thu tốt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="best-seller-tab" data-toggle="tab" href="#best-seller" role="tab" aria-controls="best-seller" aria-selected="true">Sản phẩm bán chạy</a>
                </li>
            </ul>
            <div class="tab-content" id="statsTabsContent">
                @include('layouts.partials-admin.revenue_chart')
                @include('layouts.partials-admin.order_chart')
                @include('layouts.partials-admin.top_revenue',['topRevenueProducts' => $topRevenueProducts])
                @include('layouts.partials-admin.best_seller',['bestSellerProducts' => $bestSellerProducts])
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/manage_statistics.js') }}"></script>
@endsection
