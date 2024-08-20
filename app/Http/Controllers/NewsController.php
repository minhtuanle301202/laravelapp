<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Services\NewsService;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller {
    protected NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function handleGetNextSmallNews(Request $request)
    {
        $newsId = $request->newsId;
        $news = $this->newsService->getNextSmallNews($newsId);

        if ($news == null) {
            return response()->json(['message' => 'No more small news']);
        }
            return response()->json($news);
    }

    public function handleGetPreviousSmallNews(Request $request)
    {
        $newsId = $request->newsId;
        $news = $this->newsService->getPrevSmallNews($newsId);

        return response()->json($news);
    }

    public function handleGetPreviousBigNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getPrevBigNews($page);

        return response()->json($news);
    }

    public function handleGetNextBigNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getNextBigNews($page);

        return response()->json($news);
    }

}
?>