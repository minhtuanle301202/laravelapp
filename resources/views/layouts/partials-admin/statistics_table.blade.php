<table class="table table-bordered">
    <thead>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Ảnh</th>
        <th>Số lượng đã bán</th>
        <th>Doanh thu(VND)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($topProducts as $topProduct)
        <tr>
            <td>{{ $topProduct->product->name }}</td>
            <td><img src="{{ $topProduct->product->image }}"></td>
            <td>{{ $topProduct->total_quantity }}</td>
            <td>{{ number_format($topProduct->total_revenue, 0, ',', '.') }}</td>
        </tr
    @endforeach
    </tbody>
</table>

