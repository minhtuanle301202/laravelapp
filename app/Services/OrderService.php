<?php
namespace App\Services;
use App\Repositories\OrderRepository;

class  OrderService
{
    protected $OrderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


}
?>