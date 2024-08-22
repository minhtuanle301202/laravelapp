@extends('layouts.users.master')
@section('title', 'News detail')
@section('content')
    <div class="col-12 link">
        <div class="breadcrumb">
            <a class="home" href="{{ route('home') }}">Trang chủ</a>
            <span>>></span>
            <a class="news-links" href="{{ route('news.show') }}">Tin tức</a>
            <span>>></span>
            <a class="news-title-link">{{ $news->title }}</a>
        </div>
    </div>
    <div class="news-container">
        <img class="news-image" src="{{ $news->image }}" alt="Image">
        <div class="news-title">{{ $news->title }}</div>
        <div class="posted-time">{{ \Carbon\Carbon::parse($news->published_date)->format('d/m/Y') }}</div>
        <div class="news-content">
            {{ $news->content }}
        </div>
    </div>
@endsection
