<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Services\NewsService;
use App\Models\News;
use Illuminate\Http\Request;
use App\Exceptions\UserException;

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

    public function show()
    {
        $news = $this->newsService->show();

        return view('pages.news', compact('news'));
    }

    public function handleGetPreviousNews(Request $request)
    {
            $page = $request->page;
            $news = $this->newsService->getPrevNews($page);

            return response()->json($news);
    }

    public function handleGetNextNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getNextNews($page);

        if ($news->isEmpty())
        {
            return response()->json(['message' => 'Không tồn tại tin tức']);
        } else {
            return response()->json($news);
        }
    }

    public function showNewsDetails($id)
    {
        $news = $this->newsService->getNewsDetails($id);

        if (!$news) {
            throw new UserException();
        }

        return view('pages.news_details', compact('news'));
    }

}
?>