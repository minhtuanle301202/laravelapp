<?php
namespace App\Http\Controllers;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\OrderService;
use App\Services\NewsService;

class HomeController extends Controller {
    protected CategoryService $categoryService;
    protected ProductService $productService;
    protected OrderService $orderService;
    protected NewsService $newsService;

    public function __construct(CategoryService $categoryService, ProductService $productService, OrderService $orderService, NewsService $newsService) {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->newsService = $newsService;
    }

    public function index() {
        $categories = $this->categoryService->handleGetAllCategories();
        $firstCategory = $categories->first();
        $newProducts = $this->productService->handleGetNewProductsByCategoryId($firstCategory->id);
        $bigNews = $this->newsService->handleGetBigNewsByCategoryId();
        $products = $this->productService->handleGetProductsByCategoryId($firstCategory->id);
        $news = $this->newsService->handleGetLastestNews();

        return view('pages.home', compact('categories','newProducts','products','news','bigNews'));
    }
}

?>