<div class="news-sidebar">
    <div class="header-news-sidebar">
        <div class="left-header-news-sidebar">Tin tức</div>
        <div class="right-header-news-sidebar">
            <button id="prev-sidebar-news" >
                <img src="{{ asset('images/arrow-left.svg') }}" alt="Icon">
            </button>
            <button id="next-sidebar-news">
                <img src="{{ asset('images/arrow-right.svg') }}" alt="Icon">
            </button>
        </div>
    </div>
    <div class="line col-12 mb-2"></div>
    <div class="middle-news-sidebar" id="news-sidebar-content">
            <img  src="{{ $news->image }}" alt="Tin tức">
            <div class="news-title" data-news-id="{{ $news->id }}"><a href="#">{{ $news->title }}</a></div>
            <div class="posted-time">{{ \Carbon\Carbon::parse($news->published_date)->format('d/m/Y') }}</div>
            <div class="justify">
                {{ Str::limit($news->content, 150) }}
            </div>
            <input type="hidden"  id="page-number" value="1">
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/small_news.js')}}"></script>
