<table class="table table-bordered">
    <thead>
    <tr>
        <th>Ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng đã bán</th>
        <th>Số lượng còn lại</th>
        <th>Loại sản phẩm</th>
        <th>Ngày tạo</th>
        <th>Ngày cập nhật</th>
        <th>Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $index => $product)
        <tr>
            <td><img src="{{ $product->image }}" alt="Product Image" class="img-fluid"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->variants()->sum('sold_quantity') }}</td>
            <td>{{ $product->variants()->sum('remain_quantity') }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->created_at->format('d-m-Y') }}</td>
            <td>{{ $product->updated_at->format('d-m-Y') }}</td>
            <td>
                <div class="option">
                    <button class="btn btn-info btn-sm btn-edit" data-id="{{ $product->id }}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $product->id }}"><i class="fas fa-trash-alt"></i></button>
                    <button class="btn btn-primary btn-sm btn-variants" data-id="{{ $product->id }}"><i class="fas fa-info-circle"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>