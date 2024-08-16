<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Carts;
use App\Models\CartItems;

class CartRepository extends BaseRepository
{
    public function __construct(Carts $cart)
    {
        parent::__construct($cart);
    }

    public function createOrUpdateCart($id,$request)
    {
        $cart = Carts::firstOrNew(['user_id' => $id]);
        $cart->price = 0;
        $cart->quantity = 0;
        $cart->save();

        $cartItem = CartItems::where('cart_id',$cart->id)
                                ->where('variants_product_id',$request->variant_id)
                                ->first();
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = new CartItems();
            $cartItem->cart_id = $cart->id;
            $cartItem->variants_product_id = $request->variant_id;
            $cartItem->price = $request->final_price;
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }
        $cart->price = $cart->cartItems->sum('price');
        $cart->quantity = $cart->cartItems->sum('quantity');
        $cart->save();
        return $cart;
    }

    public function getCart($userId)
    {
        $cart = Carts::where('user_id', $userId)->first();
        return $cart;
    }
}

?>