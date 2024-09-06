<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function handleGetProductsByCategoryId(Request $request)
    {
        $categoryId = $request->category_id;
        $products = $this->productService->getProductsByCategoryId($categoryId);
        $products->load('variants');
        return view('layouts.partials.list_product',compact('products'))->render();
    }

    public function handleGetNewProductsByCategoryId($id)
    {
        $newProducts = $this->productService->handleGetNewProductsByCategoryId($id);
        $newProducts->load('variants');
        return view('layouts.partials.list_new_product',compact('newProducts'))->render();
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        $variants = $product->variants;
        $firstVariants = $variants->first();
        $initialPrice = $firstVariants->price;

        return view('pages.product_details',compact('product','variants','initialPrice'));
    }

    public function getProductsByCategoryIdInCategoryPage($id)
    {
        $categoryId = $id;
        $products = $this->productService->getProductsByCategoryIdInCategoryPage($categoryId);
        $products->load('variants');

        $category = $products->first()->category;

        if (request()->ajax()) {
            return view('.layouts.partials.list_product',compact('products'))->render();
        }

        return view('pages.list_products',compact('category','products'));

    }

}

?>