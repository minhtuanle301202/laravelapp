<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\News;

class NewsRepository extends BaseRepository
{
    public function __construct(News $news)
    {
        parent::__construct($news);
    }

    public function getLastestNews()
    {
        $news = News::orderBy('published_date', 'desc')->first();
        return $news;
    }

    public function getBigNewsByCategoryId()
    {
        $bigNews = News::orderBy('published_date', 'desc')->simplePaginate(4,['*'],'news_page');
        return $bigNews;
    }

    public function getNextSmallNews($newsId)
    {
        $nextNews = News::where('id', '>', $newsId)->orderBy('published_date', 'desc')->first();
        return $nextNews;
    }

    public function getPrevSmallNews($newsId)
    {
        $prevNews = News::where('id', '=', $newsId-1)->orderBy('published_date', 'desc')->first();
        return $prevNews;
    }

    public function getPrevBigNews($page)
    {
        $perPage = 4;
        $offset = ($page - 2) * $perPage;

        $news = News::orderBy('published_date', 'desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $news;
    }

    public function getNextBigNews($page)
    {
        $perPage = 4;
        $offset = $page  * $perPage;

        $news = News::orderBy('published_date', 'desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $news;
    }

    public function show()
    {
        $news = News::take(8)->get();
        return $news;
    }

    public function getPrevNews($page)
    {
        $perPage = 8;
        $offset = ($page - 2) * $perPage;

        $news = News::orderBy('id', 'asc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $news;
    }

    public function getNextNews($page)
    {
        $perPage = 8;
        $offset = $page  * $perPage;

        $news = News::orderBy('id', 'desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $news;
    }
}
?>