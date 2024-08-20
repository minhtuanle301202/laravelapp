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

    public function updateCart($cart)
    {
        $cart->price = $cart->cartItems->sum('price');
        $cart->quantity = $cart->cartItems->sum('quantity');
        $cart->save();
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

        $this->updateCart($cart);
        return $cart;
    }

    public function getCart($userId)
    {
        $cart = Carts::where('user_id', $userId)->first();
        return $cart;
    }

    public function updateCartItemQuantity($request)
    {
        CartItems::where('id',$request->cartItemId)
            ->update(['price' => $request->finalPrice,
                'quantity' => $request->quantity
            ]);
        $cartItem = CartItems::where('id',$request->cartItemId)
            ->first();
        $cart = $cartItem->cart ;
        $this->updateCart($cart);
        return $cart;
    }

    public function deleteCartItem($request)
    {
        $cartItem = CartItems::find($request->cartItemId);
        $cart = $cartItem->cart;
        $cartItem->delete();
        $this->updateCart($cart);
        return $cart;
    }

    public function deleteAllCartItems($cartId)
    {
        CartItems::where('cart_id',$cartId)->delete();
        $cart = Carts::find($cartId);
        $this->updateCart($cart);
        return $cart;
    }
}

?>