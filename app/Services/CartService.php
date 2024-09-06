<?php
namespace App\Services;
use App\Repositories\CartRepository;


class CartService {
    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function createOrUpdateCart($id,$data)
    {
        return $this->cartRepository->createOrUpdateCart($id,$data);
    }

    public function getCart($userId)
    {
        return $this->cartRepository->getCart($userId);
    }

    public function updateCartItemQuantity($data)
    {
        $cart = $this->cartRepository->updateCartItemQuantity($data);

        return $cart;
    }

    public function deleteCartItem($data)
    {
        $cart = $this->cartRepository->deleteCartItem($data);

        return $cart;
    }

    public function deleteAllCartItems($cartId)
    {
        $cart = $this->cartRepository->deleteAllCartItems($cartId);

        return $cart;
    }

    public function placeAnOrder($data)
    {
        return $this->cartRepository->placeAnOrder($data);
    }
}
?>