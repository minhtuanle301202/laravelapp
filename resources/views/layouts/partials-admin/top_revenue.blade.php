<div class="tab-pane fade" id="top-revenue" role="tabpanel" aria-labelledby="top-revenue-tab">
    <h3 class="ml-3">Sản phẩm doanh thu tốt</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Doanh thu (VND)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($topRevenueProducts as $index => $topRevenueProduct)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $topRevenueProduct->product->name }}</td>
                <td><img src="{{ $topRevenueProduct->product->image }}"></td>
                <td>{{ number_format($topRevenueProduct->total_revenue, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
