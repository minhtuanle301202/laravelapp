<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('user.products.index', compact('products'));
    }

    public function handleGetProductsByCategoryId($id)
    {
        $products = $this->productService->getProductsByCategoryId($id);

        return response()->json([
            'data' => $products->items(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
            'total' => $products->total()
        ]);
    }


}

?>