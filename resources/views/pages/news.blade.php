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
            <div class="middle-news-container" id="news-list">
                <div id="news-item">
                    @foreach($news as $newsItem)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-2">
                            <div class="news-item">
                                <img src="{{ $newsItem->image }}" alt="Tin tức">
                                <div class="news-title"><a href="{{ route('news.news-details',$newsItem->id) }}">{{ $newsItem->title }}</a></div>
                                <div class="posted-time">{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</div>
                                <div class="justify">
                                    {{ Str::limit($newsItem->content, 150) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" id="page-numbers" value="1">
            </div>
            <div class="pagination-news">
                <button id="prev-news" class="prev-news">
                    << Previous
                </button>
                <button id="next-news" class="next-news">
                    Next >>
                </button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/news.js') }}"></script>
@endsection
