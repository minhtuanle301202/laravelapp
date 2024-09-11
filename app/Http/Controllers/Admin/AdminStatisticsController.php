<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class AdminStatisticsController extends Controller
{
    const NUMBER_ORDER_PER_PAGE = 3;
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function showChart(Request $request)
    {
        $selectedYear = $request->input('year',now()->year);

        $data = $this->orderService->getMonthlyOrders($selectedYear);

        $years = $this->orderService->getAvailableYears();

        $topRevenueProducts = $this->orderService->showTopRevenue();

        $bestSellerProducts = $this->orderService->showBestSeller();

        $topProducts = $this->orderService->showTopProducts();

        return view('pages-admin.manage_statistics', [
            'months' => $data['months'],
            'orderCounts' => $data['orderCounts'],
            'revenue' => $data['revenue'],
            'years' => $years,
            'selectedYear' => $selectedYear,
            'topRevenueProducts' => $topRevenueProducts,
            'bestSellerProducts' => $bestSellerProducts,
            'topProducts' => $topProducts
        ]);
    }

    public function handleSearchTopProducts(Request $request)
    {
        $topProducts = $this->orderService->searchTopProducts($request,self::NUMBER_ORDER_PER_PAGE);
        if ($topProducts->isEmpty()) {
            return jsonResponse(false, 'Không tìm thấy kết quả');
        } else {
            $html = view('layouts.partials-admin.statistics_table', compact('topProducts'))->render();
            return jsonResponse(true, 'Thành công', ['topProducts' => $html]);
        }
    }

    public function handleGetPrevTopProducts(Request $request)
    {
        $page = $request->page;
        $topProducts = $this->orderService->getPrevTopProducts($request, $page, self::NUMBER_ORDER_PER_PAGE);

        if ($topProducts->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.statistics_table', compact('topProducts'))->render();
            return jsonResponse(true, 'Thành công', ['topProducts' => $html]);
        }
    }

    public function handleGetNextTopProducts(Request $request)
    {
        $page = $request->page;
        $topProducts = $this->orderService->getNextTopProducts($request, $page, self::NUMBER_ORDER_PER_PAGE);

        if ($topProducts->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.statistics_table', compact('topProducts'))->render();
            return jsonResponse(true, 'Thành công', ['topProducts' => $html]);
        }
    }
}

?>