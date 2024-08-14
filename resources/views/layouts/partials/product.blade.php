<div class="products-container">
    <div class="header-products">
        <ul class="category-menu">
            @foreach($categories as $category)
                <li class="category-item {{ $loop->first ? 'active' : '' }}">
                    <a href="#" class="category-link" data-id="{{ $category->id }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="middle-products" id="product-list">
        @foreach ($products as $product)
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
    <div class="pagination-wrapper">
        <nav aria-label="Page navigation example">
            <ul class="pagination" id="pagination">
                <!-- Pagination links will be dynamically added here -->
            </ul>
        </nav>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/product.js') }}"></script>
