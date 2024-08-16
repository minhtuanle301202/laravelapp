<?php
namespace App\Services;
use App\Repositories\CartRepository;

class CartService {
    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function createOrUpdateCart($id,$request)
    {
        return $this->cartRepository->createOrUpdateCart($id,$request);
    }

    public function getCart($userId)
    {
        return $this->cartRepository->getCart($userId);
    }
}
?>