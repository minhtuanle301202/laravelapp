<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Orders;
use Illuminate\Support\Carbon;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    public function __construct(Orders $order) {
        parent::__construct($order);
    }

    public function getAllOrders($perPage)
    {
        $orders = Orders::OrderBy('id','desc')
            ->take($perPage)
            ->get();

        return $orders;
    }


    public function findOrders($data)
    {
        $status = $data->status;
        $orderCode = $data->orderCode;
        $endDate = $data->endDate;
        $startDate = $data->startDate;
        $query = Orders::query();

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($orderCode)) {
            $query->where('order_code', $orderCode);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $startDate = Carbon::createFromFormat('d-m-Y', $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat('d-m-Y', $endDate)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif (!empty($startDate)) {
            $startDate = Carbon::createFromFormat('d-m-Y', $startDate)->startOfDay();
            $query->whereDate('created_at', '>=', $startDate);
        } elseif (!empty($endDate)) {
            $endDate = Carbon::createFromFormat('d-m-Y', $endDate)->endOfDay();
            $query->whereDate('created_at', '<=', $endDate);
        }
        return $query;
    }

    public function getOrdersInPagination($offset,$perPage,$data)
    {
        $orders = $this->findOrders($data)->orderBy('id','desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $orders;
    }

    public function searchOrders($data,$perPage)
    {
        $orders = $this->findOrders($data)->orderBy('id','desc')
                        ->take($perPage)
                        ->get();

        return $orders;
    }

    public function updateProductQuantity($id) {
        $order = Orders::find($id);
        $orderDetails = $order->orderDetails;

        foreach ($orderDetails as $orderItem) {
            $variant = $orderItem->productVariant;
            $variant->sold_quantity++;
            $variant->remain_quantity--;
            $variant->save();
        }
    }

    public function getMonthlyOrders($selectedYear)
    {
        $ordersByMonth = Orders::selectRaw('MONTH(order_date) as month, COUNT(id) as total_orders,SUM(total_price) as revenue')
            ->where('status','Giao hàng thành công')
            ->whereYear('order_date', $selectedYear)
            ->groupBy('month')
            ->get();

        $months = [];
        $orderCounts = [];
        $revenue = [];

        foreach ($ordersByMonth as $data) {
            $months[] = Carbon::create()->month($data->month)->format('F'); // Lấy tên tháng
            $orderCounts[] = $data->total_orders;
            $revenue[] = $data->revenue;
        }

        return ['months' => $months, 'orderCounts' => $orderCounts,'revenue' => $revenue];
    }

    public function getAvailableYears()
    {
        return Orders::selectRaw('YEAR(order_date) as year')
            ->where('status','Giao hàng thành công')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');
    }

    public function getTopRevenue()
    {
        return OrderDetails::with('product')
            ->whereHas('order', function ($query) {
                $query->where('status', 'Giao hàng thành công');
            })
            ->select('product_id', DB::raw('SUM(price) as total_revenue'))
            ->groupBy('product_id')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();
    }

    public function getBestSeller()
    {
        return OrderDetails::with('product')
            ->whereHas('order', function ($query) {
                $query->where('status', 'Giao hàng thành công');
            })
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();
    }
}
?>