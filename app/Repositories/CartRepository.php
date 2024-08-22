<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Carts;
use App\Models\CartItems;
use App\Models\Orders;
use App\Models\OrderDetails;

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

    public function placeAnOrder($request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $cart = $user->cart;

        if ($cart->cartItems->isEmpty())
        {
            return redirect()->route('cart.show')->with('Giỏ hảng của bạn trống');
        }

        $order = Orders::create([
           'user_id' => $userId,
            'order_date' => NOW(),
            'status' => 'pending',
            'total_price' => $cart->price,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'username' => $request->name,
            'phone' => $request->phone_number,
        ]);

        $listOrderDetails = [];

        foreach ($cart->cartItems as $cartItem)
        {
            $listOrderDetails[] = [
                'order_id' => $order->id,
                'product_variants_id' => $cartItem->variants_product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
                'product_id' => $cartItem->productVariant->product_id,
                ];
        }

        foreach($listOrderDetails as $orderDetails)
        {
            OrderDetails::insert([
                'order_id' => $orderDetails['order_id'],
                'product_variants_id' => $orderDetails['product_variants_id'],
                'quantity' => $orderDetails['quantity'],
                'price' => $orderDetails['price'],
                'product_id' => $orderDetails['product_id'],
            ]);
        }

        $cart->delete();

        return true;
    }
}

?>