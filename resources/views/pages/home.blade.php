@extends('layouts.users.master')
@section('title','Home')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/partials/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/support.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/new_product.css')}}">
    <link rel="stylesheet" href="{{ asset('css/partials/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/small_news.css') }}">
    <div class="header-content">
        @include('layouts.partials.sidebar')
        @include('layouts.partials.banner')
    </div>

    <div class="middle-content">
        <div class="left-middle-content">
            @include('layouts.partials.support')
            @include('layouts.partials.small_news')
        </div>

        <div class="right-content">
            @include('layouts.partials.new_product')
            @include('layouts.partials.product')
        </div>

    </div>
    <div class="footer-content">

    </div>
@endsection