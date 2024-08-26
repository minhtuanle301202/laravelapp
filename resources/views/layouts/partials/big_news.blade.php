<div class="news-container">
    <div class="header-news-container">
        <div class="left-header-news-container">Tin tức</div>
        <div class="right-header-news-container">
                <button id="prev-sidebar-news" class="prev-big-news">
                    <img src="{{ asset('images/arrow-left.svg') }}" alt="Icon">
                </button>
                <button id="next-sidebar-news" class="next-big-news">
                    <img src="{{ asset('images/arrow-right.svg') }}" alt="Icon">
                </button>
        </div>
    </div>
    <div class="line col-12 mb-3"></div>
    <div class="middle-news-container" id="news-list">
        <div id="news-item">
            @foreach($bigNews as $newsItem)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-2">
                    <div class="news-item">
                        <img src="{{ $newsItem->image }}" alt="Tin tức">
                        <div class="news-title"><a href="#">{{ $newsItem->title }}</a></div>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/big_news.js') }}"></script>

