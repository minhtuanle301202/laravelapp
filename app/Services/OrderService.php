<?php
namespace App\Services;
use App\Models\OrderDetails;
use App\Repositories\OrderRepository;

class  OrderService
{
    protected OrderRepository $OrderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders($perPage)
    {
        return $this->orderRepository->getAllOrders($perPage);
    }

    public function getPrevOrders($page,$perPage,$data)
    {
        $offset = ($page - 2) * $perPage;
        $orders = $this->orderRepository->getOrdersInPagination($offset,$perPage,$data);
        return $orders;
    }

    public function getNextOrders($page,$perPage,$data)
    {
        $offset = $page * $perPage;
        $orders = $this->orderRepository->getOrdersInPagination($offset,$perPage,$data);

        return $orders;
    }

    public function searchOrders($data,$perPage)
    {
        $orders = $this->orderRepository->searchOrders($data,$perPage);

        return $orders;
    }

    public function getOrderInfo($id)
    {
        $order = $this->orderRepository->find($id);

        return $order;
    }

    public function updateOrder($id,$data)
    {
        if ($data['status'] == 'Giao hàng thành công') {
            $this->orderRepository->updateProductQuantity($id);
        }

        $order = $this->orderRepository->update($id,$data);

        return $order;
    }

    public function getOrderById($id)
    {
        $order = $this->orderRepository->find($id);

        return $order;
    }

    public function getFirstOrderById($id)
    {
        $order = $this->orderRepository->getFirstOrderById($id);

        return $order;
    }

    public function getFirstOrderDetailsById($id)
    {
        return OrderDetails::where('order_id', $id)->first();
    }

    public function getMonthlyOrders($selectedYear)
    {
        return $this->orderRepository->getMonthlyOrders($selectedYear);
    }

    public function getAvailableYears()
    {
        return $this->orderRepository->getAvailableYears();
    }

    public function showTopRevenue()
    {
        return $this->orderRepository->getTopRevenue();
    }

    public function showBestSeller()
    {
        return $this->orderRepository->getBestSeller();
    }

}
?>