<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Services\NewsService;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller {
    protected NewsService $newsService;

    public function __construct(NewsService $newsService) {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $perPage = 1; // Chỉ một tin tức mỗi trang
        $news = News::paginate($perPage);

        return response()->json($news);
    }
}
?>