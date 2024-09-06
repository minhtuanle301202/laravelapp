<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Requests\EditOrderRequest;

class AdminOrderController extends Controller
{
    const NUMBER_ORDER_PER_PAGE = 4;
    protected OrderService $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function showManageOrdersPage()
    {
        $orders = $this->orderService->getAllOrders(self::NUMBER_ORDER_PER_PAGE);
        return view('pages-admin.manage_orders', compact('orders'));
    }

    public function handleGetNextOrders(Request $request)
    {
        $page = $request->page;
        $orders = $this->orderService->getNextOrders($page,self::NUMBER_ORDER_PER_PAGE,$request);

        if ($orders->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.orders', compact('orders'))->render();
            return jsonResponse(true, 'Thành công', ['orders' => $html]);
        }
    }

    public function handleGetPreviousOrders(Request $request)
    {
        $page = $request->page;
        $orders = $this->orderService->getPrevOrders($page,self::NUMBER_ORDER_PER_PAGE,$request);

        if ($orders->isEmpty()) {
            return jsonResponse(false, 'Không còn dữ liệu');
        } else {
            $html = view('layouts.partials-admin.orders', compact('orders'))->render();
            return jsonResponse(true, 'Thành công', ['orders' => $html]);
        }
    }

    public function handleSearchOrders(Request $request)
    {
        $orders = $this->orderService->searchOrders($request,self::NUMBER_ORDER_PER_PAGE);
        if ($orders->isEmpty()) {
            return jsonResponse(false, 'Không tìm thấy kết quả');
        } else {
            $html = view('layouts.partials-admin.orders', compact('orders'))->render();
            return jsonResponse(true, 'Thành công', ['orders' => $html]);
        }
    }

    public function handleGetOrderInfo(Request $request)
    {
        $order = $this->orderService->getOrderInfo($request->orderId);
        if (!$order) {
            return jsonResponse(false, 'Đơn hàng không tồn tại');
        } else {
            return jsonResponse(true, 'Thành công', $order);
        }
    }

    public function handleUpdateOrder(EditOrderRequest $request)
    {
        $orderId = $request->id;
        $data = $request->only('username','address','phone','order_date','status');

        $order = $this->orderService->updateOrder($orderId, $data);
        if ($order) {
            return jsonResponse(true, 'Cập nhật thông tin đơn hàng thành công');
        } else {
            return jsonResponse(false, 'Cập nhật thông tin đơn hàng thất bại');
        }
    }

    public function handleShowOrderDetail($id)
    {
        $order = $this->orderService->getOrderById($id);
        $order->load('orderDetails.product.category','orderDetails.productVariant');

        return view('pages-admin.manage_order_details',compact('order'));
    }

}
?>