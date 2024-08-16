<div class="hot-products-container">
    <div class="header-hot-products">
        <div class="title-hot-products">SẢN PHẨM MỚI</div>
        <ul class="hot-menu">
            @foreach($categories as $category)
                <li class="hot-item {{ $loop->first ? 'active' : '' }}">
                    <a href="#" class="hot-category-link" data-id="{{ $category->id }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="middle-hot-products" id="hot-product-list">
        @foreach ($newProducts->take(4) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-0">
                <a href="{{ route('product.detail', $product->id) }}" class="product-link">
                    <div class="product-item">
                        <span class="is-loved"></span>
                        <img src="{{ $product->image }}" alt="Image">
                        <div class="name">{{ $product->name }}</div>
                        <div class="price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                        <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/new_product.js') }}"></script>