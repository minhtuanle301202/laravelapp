@if ($variants->isEmpty())
    <p class="text-center">Không tìm thấy biển thể nào</p>
    @else
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Ảnh</th>
        <th>Dung lượng</th>
        <th>Màu sắc</th>
        <th>Số lượng đã bán</th>
        <th>Số lượng còn lại</th>
        <th>Giá</th>
        <th>Option</th>
    </tr>
    </thead>
    <tbody id="variantTableBody">
    @foreach ($variants as $variant)
        <tr>
            <td>{{ $variant->product->name }}</td>
            <td><img src="{{ $variant->product->image }}" alt="Product Image" class="img-fluid"></td>
            <td>{{ $variant->capacity }}</td>
            <td>{{ $variant->color }}</td>
            <td>{{ $variant->sold_quantity }}</td>
            <td>{{ $variant->remain_quantity }}</td>
            <td>{{ number_format($variant->price, 0, ',', '.')}} VND</td>
            <td>
                <div class="option">
                    <button class="btn btn-info btn-sm btn-edit" data-id="{{ $variant->id }}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $variant->id }}"><i class="fas fa-trash-alt"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pagination-variants">
    {{ $variants->links() }}
</div>
@endif