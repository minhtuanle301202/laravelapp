<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class AdminStatisticsController extends Controller
{
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

        return view('pages-admin.manage_statistics', [
            'months' => $data['months'],
            'orderCounts' => $data['orderCounts'],
            'revenue' => $data['revenue'],
            'years' => $years,
            'selectedYear' => $selectedYear,
            'topRevenueProducts' => $topRevenueProducts,
            'bestSellerProducts' => $bestSellerProducts
        ]);
    }

}

?>