<table class="table table-bordered">
    <thead>
    <tr>
        <th>Mã đơn hàng</th>
        <th>Người mua</th>
        <th>Trạng thái</th>
        <th>Tổng tiền (VND)</th>
        <th>Ngày đặt</th>
        <th>Cập nhật</th>
        <th>Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($orders as $order)
        <tr>
            <td>{{ $order->order_code }}</td>
            <td>{{ $order->username }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ number_format($order->total_price, 0, ',', '.')}}</td>
            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y H:i:s') }}</td>
            <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y H:i:s') }}</td>
            <td>
                <div class="option">
                    <button class="btn btn-info btn-sm btn-edit" data-id="{{ $order->id }}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-primary btn-sm btn-order-details" data-id="{{ $order->id }}"><i class="fas fa-info-circle"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

