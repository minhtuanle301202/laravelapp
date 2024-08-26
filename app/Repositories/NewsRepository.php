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
        $news = News::order()->first();
        return $news;
    }

    public function getBigNewsByCategoryId()
    {
        $bigNews = News::order()->simplePaginate(4,['*'],'news_page');
        return $bigNews;
    }

    public function getNextSmallNews($newsId)
    {
        $nextNews = News::where('id', '>', $newsId)->order()->first();
        return $nextNews;
    }

    public function getPrevSmallNews($newsId)
    {
        $prevNews = News::where('id', '=', $newsId-1)->order()->first();
        return $prevNews;
    }

    public function getPrevBigNews($page)
    {
        $perPage = 4;
        $offset = ($page - 2) * $perPage;

        $news = News::order()
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $news;
    }

    public function getNextBigNews($page)
    {
        $perPage = 4;
        $offset = $page  * $perPage;

        $news = News::order()
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $news;
    }
}
?>