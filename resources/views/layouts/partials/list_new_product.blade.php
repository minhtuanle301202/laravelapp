@foreach ($newProducts->take(4) as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
        <a href="{{ route('product.detail', $product->id) }}" class="product-link">
            <div class="product-item">
                <span class="is-loved"></span>
                <img src="{{ $product->image }}" alt="Image">
                <div class="name">{{ $product->name }}</div>
                <div class="price">{{ number_format($product->variants->first()->price, 0, ',', '.') }} VND</div>
                <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
            </div>
        </a>
    </div>
@endforeach