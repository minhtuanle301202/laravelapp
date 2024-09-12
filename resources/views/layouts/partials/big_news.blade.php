<div class="news-container">
    <div class="header-news-container">
        <div class="left-header-news-container">Tin tức Mới nhất</div>
        <div class="right-header-news-container">
        </div>
    </div>
    <div class="line col-12 mb-3"></div>
    <div class="middle-news-container" id="news-list">
        <div id="news-item">
            @foreach($bigNews as $newsItem)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-2">
                    <div class="news-item">
                        <div class="image-container">
                            <img src="{{ $newsItem->image }}" alt="Tin tức">
                        </div>
                        <div class="news-title"><a href="{{  route('news.news-details',$newsItem->id) }}">{{ $newsItem->title }}</a></div>
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

