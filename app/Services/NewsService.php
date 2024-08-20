<?php
namespace App\Services;
use App\Repositories\NewsRepository;

class NewsService
{
    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function handleGetLastestNews()
    {
        $news = $this->newsRepository->getLastestNews();

        return $news;
    }

    public function handleGetBigNewsByCategoryId()
    {
        $bigNews = $this->newsRepository->getBigNewsByCategoryId();

        return $bigNews;
    }

    public function getNextSmallNews($newsId)
    {
        $nextNews = $this->newsRepository->getNextSmallNews($newsId);

        return $nextNews;
    }

    public function getPrevSmallNews($newsId)
    {
        $prevNews = $this->newsRepository->getPrevSmallNews($newsId);

        return $prevNews;
    }

    public function getPrevBigNews($page)
    {
        $news = $this->newsRepository->getPrevBigNews($page);

        return $news;
    }

    public function getNextBigNews($page)
    {
        $news = $this->newsRepository->getNextBigNews($page);

        return $news;
    }
}
?>