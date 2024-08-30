<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class AdminProductController extends Controller
{
    const NUMBER_PRODUCT_PER_PAGE = 4;
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function showManageProductsPage()
    {
        $products = $this->productService->getAllProducts(self::NUMBER_PRODUCT_PER_PAGE);
        return view('pages-admin.manage_products', compact('products'));
    }

    public function handleGetNextProducts(Request $request)
    {
        $page = $request->page;
        $categoryId = $request->categoryId;
        if ($categoryId === "0") {
            $products = $this->productService->getNextProducts($page,self::NUMBER_PRODUCT_PER_PAGE);
        } else {
            $products = $this->productService->getNextProductsByCategoryId($page,self::NUMBER_PRODUCT_PER_PAGE, $categoryId);
        }

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Không còn dữ liệu']);
        } else {
            $html = view('layouts.partials-admin.products',compact('products'))->render();
            return response()->json(['products' => $html]);
        }
    }

    public function handleGetPreviousProducts(Request $request)
    {
        $page = $request->page;
        $categoryId = $request->categoryId;
        if ($categoryId === "0") {
            $products = $this->productService->getPrevProducts($page,self::NUMBER_PRODUCT_PER_PAGE);
        } else {
            $products = $this->productService->getPrevProductsByCategoryId($page,self::NUMBER_PRODUCT_PER_PAGE, $categoryId);
        }

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Không còn dữ liệu']);
        } else {
            $html = view('layouts.partials-admin.products',compact('products'))->render();
            return response()->json(['products' => $html]);
        }
    }

    public function handleSearchProduct(Request $request)
    {
        $productName = $request->productName;
        $products = $this->productService->searchProduct($productName);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy kết quả']);
        } else {
            $html = view('layouts.partials-admin.products', compact('products'))->render();
            return response()->json(['products' => $html]);
        }
    }

    public function showProductDetails(Request $request)
    {
        $productId = $request->productId;

        $product =  $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại']);
        } else {
            return response()->json($product);
        }
    }

    public function updateProductDetails(ProductRequest $request)
    {
        $productId = $request->id;
        $data = $request->only('name','description','image','category_id');
        $product = $this->productService->updateProductDetails($productId,$data);

        if ($product) {
            return response()->json(['message' => 'Cập nhật thông tin sản phẩm thành công']);
        } else {
            return response()->json(['message' => 'Cập nhật thông tin sản phẩm thất bại']);
        }

    }

    public function deleteProduct(Request $request)
    {
        $productId = $request->productId;

        $result = $this->productService->deleteProduct($productId);
        if ($result) {
            return response()->json(['message' => 'Xóa sản phẩm thành công']);
        } else {
            return response()->json(['message' => 'Xóa sản phẩm thất bại']);
        }
    }

    public function handleCreateProduct(ProductRequest $request)
    {
        $data = $request->only('name','description','image','category_id');
        $product = $this->productService->createProduct($data);
        if ($product) {
            return response()->json(['message' => 'Thêm sản phẩm thành công']);
        } else {
            return response()->json(['message' => 'Thêm sản phẩm thất bại']);
        }
    }
}
?>