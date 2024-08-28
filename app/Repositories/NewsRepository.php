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
        $news = News::activeOrder()->first();
        return $news;
    }

    public function getBigNewsByCategoryId()
    {
        $bigNews = News::activeOrder()->simplePaginate(4,['*'],'news_page');
        return $bigNews;
    }

    public function getNextSmallNews($newsId)
    {
        $nextNews = News::where('id', '>', $newsId)->activeOrder()->first();
        return $nextNews;
    }

    public function getPrevSmallNews($newsId)
    {
        $prevNews = News::where('id', '=', $newsId-1)->activeOrder()->first();
        return $prevNews;
    }

    public function show()
    {
        $news = News::activeOrder()->take(8)->get();
        return $news;
    }

    public function getNewsInPagination($offset,$perPage)
    {
        $news = News::activeOrder()
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $news;
    }

    public function getAllNews($perPage)
    {
        $news = News::activeOrder()->take($perPage)->get();
        return $news;
    }

}
?>