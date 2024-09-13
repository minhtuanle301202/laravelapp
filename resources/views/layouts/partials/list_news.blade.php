@if ($news->isEmpty())
    <p class="news-no-found">Không tìm thấy bản tin nào</p>
@else
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
</div>
<div class="pagination-news">
   {{ $news->links() }}
</div>
@endif