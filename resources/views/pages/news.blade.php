@extends('layouts.users.master')
@section('title','News')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/news.css') }}">
    <div class="col-12 link">
        <div class="breadcrumb">
            <a class="home" href="{{ route('home') }}">Trang chủ</a>
            <span>>></span>
            <a class="news-link">Tin tức</a>
        </div>
    </div>
    <div class="news-container">
        <div class="news-list-title">Tin tức</div>
        <div class="line"></div>
        <div class="news-list" id="news-content">
          @include('layouts.partials.list_news',['news' => $news])
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/news.js') }}"></script>
@endsection
