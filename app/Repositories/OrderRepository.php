<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Orders;
use Illuminate\Support\Carbon;

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


    public function findOrders($request)
    {
        $status = $request->status;
        $orderCode = $request->orderCode;
        $endDate = $request->endDate;
        $startDate = $request->startDate;
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

    public function getOrdersInPagination($offset,$perPage,$request)
    {
        $orders = $this->findOrders($request)->orderBy('id','desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $orders;
    }

    public function searchOrders($request,$perPage)
    {
        $orders = $this->findOrders($request)->orderBy('id','desc')
                        ->take($perPage)
                        ->get();

        return $orders;
    }
}
?>