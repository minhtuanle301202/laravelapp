<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;

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
        $products = $this->productService->getNextProductsByCategoryId($page,self::NUMBER_PRODUCT_PER_PAGE, $request);

        if ($products->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.products', compact('products'))->render();
            return jsonResponse(true, 'Thành công', ['products' => $html]);
        }
    }

    public function handleGetPreviousProducts(Request $request)
    {
        $page = $request->page;
        $products = $this->productService->getPrevProductsByCategoryId($page,self::NUMBER_PRODUCT_PER_PAGE, $request);

        if ($products->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.products', compact('products'))->render();
            return jsonResponse(true, 'Thành công', ['products' => $html]);
        }
    }

    public function handleSearchProduct(Request $request)
    {
        $products = $this->productService->searchProduct($request,self::NUMBER_PRODUCT_PER_PAGE);

        if ($products->isEmpty()) {
            return jsonResponse(false, 'Không tìm thấy kết quả');
        } else {
            $html = view('layouts.partials-admin.products', compact('products'))->render();
            return jsonResponse(true, 'Thành công', ['products' => $html]);
        }
    }

    public function showProductDetails(Request $request)
    {
        $productId = $request->productId;

        $product =  $this->productService->getProductById($productId);

        if (!$product) {
            return jsonResponse(false, 'Sản phẩm không tồn tại');
        } else {
            return jsonResponse(true, 'Thành công', $product);
        }
    }

    public function updateProductDetails(EditProductRequest $request)
    {
        $productId = $request->id;
        $data = $request->only('name','description','image','category_id');
        $result = $this->productService->updateProductDetails($productId,$data);

        if ($result['success']) {
            return response()->json(['message' => 'Cập nhật thông tin sản phẩm thành công']);
        } else {
            return jsonResponse(false, $result['error'], null, 422);
        }
    }

    public function deleteProduct(Request $request)
    {
        $productId = $request->productId;

        $result = $this->productService->deleteProduct($productId);
        if ($result) {
            return jsonResponse(true, 'Xóa sản phẩm thành công');
        } else {
            return jsonResponse(false, 'Xóa sản phẩm thất bại');
        }
    }

    public function handleCreateProduct(ProductRequest $request)
    {
        $data = $request->only('name','description','image','category_id');
        $result = $this->productService->createProduct($data);
        if ($result['success']) {
            return jsonResponse(true, 'Thêm sản phẩm thành công');
        } else {
            return jsonResponse(false, $result['error'], null, 422);
        }
    }
}
?>