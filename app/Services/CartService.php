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

    public function updateCartItemQuantity($request)
    {
        $cart = $this->cartRepository->updateCartItemQuantity($request);

        return $cart;
    }

    public function deleteCartItem($request)
    {
        $cart = $this->cartRepository->deleteCartItem($request);

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