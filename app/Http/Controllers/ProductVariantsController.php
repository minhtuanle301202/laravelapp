<?php
namespace App\Http\Controllers;
use App\Services\ProductVariantsService;
use Illuminate\Http\Request;

class ProductVariantsController extends Controller
{
    protected ProductVariantsService $productVariantsService;

    public function __construct(ProductVariantsService $productVariantsService)
    {
        $this->productVariantsService = $productVariantsService;
    }

    public function handleGetPrice(Request $request)
    {
        $productId = $request->product_id;
        $color = $request->color;
        $capacity = $request->capacity;
        $variants = $this->productVariantsService->getPrice($productId, $color, $capacity);
        return response()->json($variants);
    }
}
