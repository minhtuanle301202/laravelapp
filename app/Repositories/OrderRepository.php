<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Orders;

class OrderRepository extends BaseRepository
{
    public function __construct(Orders $order) {
        parent::__construct($order);
    }


}
?>