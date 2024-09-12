<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPaymentRequest;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItems;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function createOrUpdateCart(Request $request)
    {

        $user = auth()->user();
        $userId = $user->id;
        $cart = $this->cartService->createOrUpdateCart($userId, $request);

        if ($cart) {
            return response()->json(['message' => 'Thêm vào giỏ hàng thành công',
                'quantity' => $cart->quantity]);
        } else {
            return response()->json(['message' => 'Số lượng sản phẩm còn lại không đủ']);
        }

    }

    public function show()
    {
        $cart = $this->cartService->getCart(Auth::user()->id);
        if ($cart) {
            $cart->load('cartItems.productVariant');
        } else {
            $cart = null;
        }

        return view('pages.cart', compact('cart'));
    }

    public function updateCartItemQuantity(Request $request)
    {
        $cart = $this->cartService->updateCartItemQuantity($request);

        return response()->json(['cart' => $cart]);
    }

    public function deleteCartItem(Request $request)
    {
        $cart = $this->cartService->deleteCartItem($request);
        if ($cart->cartItems->isEmpty())
        {
            return response()->json(['cart' =>$cart ,'message' =>'Không có sản phẩm nào']);
        }
        return response()->json(['cart' => $cart]);
    }

    public function deleteAllCartItems()
    {
        $cartId = auth()->user()->cart->id;
        $cart = $this->cartService->deleteAllCartItems($cartId);

        return response()->json(['cart' => $cart]);
    }

    public function showPayMentPage()
    {
        $user = auth()->user();
        $cart = $user->cart;
        return view('pages.payment',compact('cart', 'user'));
    }

    public function placeAnOrder(UserPaymentRequest $request)
    {
        $data = $request;
        $status = $this->cartService->placeAnOrder($data);

        if ($status['message'] === 'Đặt hàng thành công') {
            return response()->json(['message' => 'Đặt hàng thành công']);
        } else if ($status['message'] === 'Giỏ hàng trống') {
            return redirect()->route('cart.show')->with('Giỏ hảng của bạn trống');
        } else {
            return response()->json(['message' => $status['message'] , 'overStocks' => $status['overStocks']]);
        }
    }
}
?>