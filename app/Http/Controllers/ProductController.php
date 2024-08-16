<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

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

    public function handleGetNewProductsByCategoryId($id)
    {
        $newProducts = $this->productService->handleGetNewProductsByCategoryId($id);
        return response()->json($newProducts);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        $variants = $product->variants;
        $firstVariants = $variants->first();
        $initialPrice = $firstVariants->price;
        return view('pages.product_details',compact('product','variants','initialPrice'));
    }

}

?>