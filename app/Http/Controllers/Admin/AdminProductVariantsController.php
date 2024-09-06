<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\VariantRequest;
use App\Services\ProductVariantsService;
use App\Http\Requests\EditVariantRequest;
use Illuminate\Http\Request;

class AdminProductVariantsController extends Controller
{
    const NUMBER_VARIANTS_PER_PAGE = 4;
    protected ProductVariantsService $productVariantsService;

    public function __construct(ProductVariantsService $productVariantsService)
    {
        $this->productVariantsService = $productVariantsService;
    }

    public function showManageVariants($id)
    {
        $variants = $this->productVariantsService->getVariantsByProductId($id,self::NUMBER_VARIANTS_PER_PAGE);
        $product = $this->productVariantsService->getProductById($id);

        return view('pages-admin.manage_product_variants', compact('variants','product'));

    }

    public function handleGetNextVariants(Request $request)
    {
        $page = $request->page;
        $variants = $this->productVariantsService->getNextVariants($request->productId, $page,self::NUMBER_VARIANTS_PER_PAGE);

        if ($variants->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.product_variants', compact('variants'))->render();
            return jsonResponse(true, 'Thành công', ['variants' => $html]);
        }
    }

    public function handleGetPreviousVariants(Request $request)
    {
        $page = $request->page;
        $variants = $this->productVariantsService->getPrevVariants($request->productId, $page,self::NUMBER_VARIANTS_PER_PAGE);

        if ($variants->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.product_variants', compact('variants'))->render();
            return jsonResponse(true, 'Thành công', ['variants' => $html]);
        }
    }

    public function handleCreateVariant(VariantRequest $request)
    {

        $data = $request->only('capacity','price','color','remain_quantity','product_id');
        $variant = $this->productVariantsService->createVariant($data);

        if ($variant) {
            return jsonResponse(true, 'Thêm biến thể thành công');
        } else {
            return jsonResponse(false, 'Thêm biến thể thất bại');
        }
    }

    public function showVariantDetails(Request $request)
    {
        $variant = $this->productVariantsService->getVariantDetails($request->variantId);

        if (!$variant) {
            return jsonResponse(false, 'Biến thể không tồn tại');
        } else {
            return jsonResponse(true, 'Thành công', $variant);
        }
    }

    public function updateVariantDetails(EditVariantRequest $request)
    {
        $variantId = $request->id;
        $data = $request->only('capacity','price','color','remain_quantity','product_id');
        $result = $this->productVariantsService->updateVariantDetails($variantId, $data);

        if ($result['success']) {
            return jsonResponse(true, 'Cập nhật thông tin biến thể thành công');
        } else {
            return jsonResponse(false, $result['error'], null, 422);
        }
    }

    public function deleteVariant(Request $request)
    {
        $variantId = $request->variantId;
        $state = $this->productVariantsService->deleteVariant($variantId);

        if ($state) {
            return jsonResponse(true, 'Xóa biến thể thành công');
        } else {
            return jsonResponse(false, 'Xóa biến thể thất bại');
        }
    }
}
?>