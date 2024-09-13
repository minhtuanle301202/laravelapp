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
        $news = $this->newsService->getPrevNews($page,4);

        return response()->json($news);
    }

    public function handleGetNextBigNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getNextNews($page,4);

        return response()->json($news);
    }

    public function show(Request $request)
    {
        $news = $this->newsService->show();
        if ($request->ajax()) {
            return view('layouts.partials.list_news',compact('news'))->render();
        } else {
            return view('pages.news', compact('news'));
        }
    }

    public function handleGetPreviousNews(Request $request)
    {
            $page = $request->page;
            $news = $this->newsService->getPrevNews($page,8);

            return response()->json($news);
    }

    public function handleGetNextNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getNextNews($page,8);

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

        return view('pages.news_details', compact('news'));
    }

}
?>