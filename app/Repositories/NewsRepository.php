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
        $news = News::orderBy('created_at','DESC')
            ->take(5)
            ->get();
        return $news;
    }
}
?>