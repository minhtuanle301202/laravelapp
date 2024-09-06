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
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            return jsonResponse(true, 'Thành công', $news);
        }
    }

    public function handleGetPreviousNews(Request $request)
    {
        $page = $request->page;
        $news = $this->newsService->getPrevNews($page,self::NUMBER_NEWS_PER_PAGE);
        if ($news->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            return jsonResponse(true, 'Thành công', $news);
        }
    }

    public function handleCreateNews(Request $request)
    {
        $data = $request->only('title','content','image','published_date');
        $news = $this->newsService->createNews($data);
        if ($news) {
            return jsonResponse(true, 'Thêm tin tức thành công');
        } else {
            return jsonResponse(false, 'Thêm tin tức thất bại');
        }
    }

    public function showNewsDetails(Request $request)
    {
        $news = $this->newsService->getNewsDetails($request->newsId);
        if (!$news) {
            return jsonResponse(false, 'Tin tức không tồn tại');
        } else {
            return jsonResponse(true, 'Thành công', $news);
        }
    }

    public function updateNewsDetails(Request $request)
    {
        $newsId = $request->newsId;
        $data = $request->only('title','content','image','published_date');
        $news = $this->newsService->updateNewsDetails($newsId, $data);
        if ($news) {
            return jsonResponse(true, 'Cập nhật thông tin tin tức thành công');
        } else {
            return jsonResponse(false, 'Cập nhật thông tin tin tức thất bại');
        }
    }

    public function deleteNews(Request $request)
    {
        $newsId = $request->newsId;

        $result = $this->newsService->deleteNews($newsId);
        if ($result) {
            return jsonResponse(true, 'Xóa tin tức thành công');
        } else {
            return jsonResponse(false, 'Xóa tin tức thất bại');
        }
    }

}
?>