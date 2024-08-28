<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNewsController extends Controller
{
    const NUMBER_NEWS_PER_PAGE = 4;
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function showManageNewsPage()
    {
        $news = $this->newsService->getAllNews(self::NUMBER_NEWS_PER_PAGE);

        return view('pages-admin.manage_news', compact('news'));
    }

    public function handleGetNextNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getNextNews($page,self::NUMBER_NEWS_PER_PAGE);
        if ($news->isEmpty()) {
            return response()->json(['message' => 'Không còn dữ liệu']);
        } else {
            return response()->json($news);
        }
    }

    public function handleGetPreviousNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getPrevNews($page,self::NUMBER_NEWS_PER_PAGE);
        if ($news->isEmpty()) {
            return response()->json(['message' => 'Không còn dữ liệu']);
        } else {
            return response()->json($news);
        }
    }

    public function handleCreateNews(Request $request)
    {
        $data = $request->only('title','content','image','published_date');
        $news = $this->newsService->createNews($data);
        if ($news) {
            return response()->json(['message' => 'Thêm tin tức thành công']);
        } else {
            return response()->json(['message' => 'Thêm tin tức thất bại']);
        }
    }

    public function showNewsDetails(Request $request)
    {
        $news = $this->newsService->getNewsDetails($request->newsId);
        if (!$news) {
            return response()->json(['message' => 'Tin tức không tồn tại']);
        } else {
            return response()->json($news);
        }
    }

    public function updateNewsDetails(Request $request)
    {
        $newsId = $request->newsId;
        $data = $request->only('title','content','image','published_date');
        $news = $this->newsService->updateNewsDetails($newsId, $data);
        if ($news) {
            return response()->json(['message' => 'Cập nhật thông tin tin tức thành công']);
        } else {
            return response()->json(['message' => 'Cập nhật thông tin tin tức thất bại']);
        }
    }

    public function deleteNews(Request $request)
    {
        $newsId = $request->newsId;

        $result = $this->newsService->deleteNews($newsId);
        if ($result) {
            return response()->json(['message' => 'Xóa tin tức thành công']);
        } else {
            return response()->json(['message' => 'Xóa tin tức thất bại']);
        }
    }

}
?>