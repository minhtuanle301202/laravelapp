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

    public function getPrevOrders($page,$perPage,$request)
    {
        $offset = ($page - 2) * $perPage;
        $orders = $this->orderRepository->getOrdersInPagination($offset,$perPage,$request);
        return $orders;
    }

    public function getNextOrders($page,$perPage,$request)
    {
        $offset = $page * $perPage;
        $orders = $this->orderRepository->getOrdersInPagination($offset,$perPage,$request);

        return $orders;
    }

    public function searchOrders($request,$perPage)
    {
        $orders = $this->orderRepository->searchOrders($request,$perPage);

        return $orders;
    }

    public function getOrderInfo($id)
    {
        $order = $this->orderRepository->find($id);

        return $order;
    }

    public function updateOrder($id,$data)
    {
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
}
?>