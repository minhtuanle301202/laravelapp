<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Carts;
use App\Models\CartItems;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\ProductVariants;

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

    public function createOrUpdateCart($id,$data)
    {
        $variant = ProductVariants::find($data->variant_id);
        if ($variant->remain_quantity < $data->quantity) {
            $cart = null;
            return $cart;
        }

        $cart = Carts::firstOrNew(['user_id' => $id]);
        $cart->price = 0;
        $cart->quantity = 0;
        $cart->save();

        $cartItem = CartItems::where('cart_id',$cart->id)
            ->where('variants_product_id',$data->variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $data->quantity;
            $cartItem->price = $cartItem->quantity * $cartItem->productVariant->price;
            $cartItem->save();
        } else {
            $cartItem = new CartItems();
            $cartItem->cart_id = $cart->id;
            $cartItem->variants_product_id = $data->variant_id;
            $cartItem->price = $data->quantity * $cartItem->productVariant->price;
            $cartItem->quantity = $data->quantity;
            $cartItem->save();
        }

        $this->updateCart($cart);
        return $cart;
    }

    public function getCart($userId)
    {
        $cart = Carts::firstOrCreate(
            ['user_id' => $userId],
            ['price' => 0, 'quantity' => 0]
        );

        return $cart;
    }

    public function updateCartItemQuantity($data)
    {
        $cartItem = CartItems::find($data->cartItemId);
        $cartItem->update([
            'price' => $data->finalPrice,
            'quantity' => $data->quantity,
        ]);
        $cart = $cartItem->cart ;
        $this->updateCart($cart);
        return $cart;
    }

    public function deleteCartItem($data)
    {
        $cartItem = CartItems::find($data->cartItemId);
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

    public function placeAnOrder($data)
    {
        $user = auth()->user();
        $userId = $user->id;
        $cart = $user->cart;

        $overStocks = [];
        foreach ($cart->cartItems as $cartItem) {
            if ($cartItem->productVariant->remain_quantity < $cartItem->quantity ) {
                $overStocks[] = [
                    'name' => $cartItem->productVariant->product->name,
                    'color' => $cartItem->productVariant->color,
                    'capacity' => $cartItem->productVariant->capacity,
                    'remain_quantity' =>$cartItem->productVariant->remain_quantity
                ];
            }
        }

        if ($overStocks) {
            return ['overStocks' => $overStocks,'message' => 'Đặt hàng quá số lượng'];
        } else {
            if ($cart->cartItems->isEmpty())
            {
                return ['message' => 'Giỏ hàng trống'];
            }

            $order = Orders::create([
                'user_id' => $userId,
                'order_date' => NOW(),
                'status' => 'Chờ xử lý',
                'total_price' => $cart->price,
                'address' => $data->address,
                'payment_method' => $data->payment_method,
                'username' => $data->name,
                'phone' => $data->phone_number,
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

                $productVariant = $cartItem->productVariant;
                $productVariant->remain_quantity -= $cartItem->quantity;
                $productVariant->sold_quantity += $cartItem->quantity;
                $productVariant->save();
            }

            OrderDetails::insert($listOrderDetails);

            $cart->delete();

            return ['message' => 'Đặt hàng thành công'];
        }


    }
}

?>