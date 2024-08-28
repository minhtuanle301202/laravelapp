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

    public function show()
    {
        $news = $this->newsRepository->show();
        return $news;
    }

    public function getPrevNews($page,$perPage)
    {
        $offset = ($page - 2) * $perPage;
        $news = $this->newsRepository->getNewsInPagination($offset,$perPage);

        return $news;
    }

    public function getNextNews($page,$perPage)
    {
        $offset = $page * $perPage;
        $news = $this->newsRepository->getNewsInPagination($offset,$perPage);

        return $news;
    }

    public function getNewsDetails($id)
    {
        $news = $this->newsRepository->find($id);

        return $news;
    }

    public function getAllNews($perPage)
    {
        $news = $this->newsRepository->getAllNews($perPage);
        return $news;
    }

    public function createNews($data)
    {
        $news = $this->newsRepository->create($data);
        return $news;
    }

    public function updateNewsDetails($id, $data)
    {
        $news = $this->newsRepository->update($id, $data);
        return $news;
    }

    public function deleteNews($id)
    {
        $state = $this->newsRepository->delete($id);
        return $state;
    }

}
?>