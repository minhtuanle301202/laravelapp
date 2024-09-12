<div class="tab-pane fade" id="best-seller" role="tabpanel" aria-labelledby="best-seller-tab">
    <h3 class="ml-3">Sản phẩm bán chạy nhất</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Số lượng đã bán</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bestSellerProducts as $index => $bestSellerProduct)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bestSellerProduct->product->name }}</td>
                <td><img src="{{ $bestSellerProduct->product->image }}"></td>
                <td>{{ $bestSellerProduct->total_quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>