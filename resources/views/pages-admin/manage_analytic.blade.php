@extends('layouts.admin')
@section('title', 'Thống Kê')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/statistics.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <ul class="nav nav-tabs mb-4" id="statsTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="best-sellers-tab" data-toggle="tab" href="#best-sellers" role="tab" aria-controls="best-sellers" aria-selected="true">Sản phẩm bán chạy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="top-revenue-tab" data-toggle="tab" href="#top-revenue" role="tab" aria-controls="top-revenue" aria-selected="false">Sản phẩm doanh thu tốt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="revenue-chart-tab" data-toggle="tab" href="#revenue-chart" role="tab" aria-controls="revenue-chart" aria-selected="false">Doanh thu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-chart-tab" data-toggle="tab" href="#order-chart" role="tab" aria-controls="order-chart" aria-selected="false">Đơn hàng</a>
                </li>
            </ul>
            <div class="tab-content" id="statsTabsContent">
                @include('partials-admin.best_sellers', ['bestSellers' => $bestSellers])
                @include('partials-admin.top_revenue', ['topRevenue' => $topRevenue])
                @include('partials-admin.revenue_chart')
                @include('partials-admin.order_chart')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/admin/statistics.js') }}"></script>
@endsection
