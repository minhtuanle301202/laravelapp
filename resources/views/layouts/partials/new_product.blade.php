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
        @include('layouts.partials.list_new_product',['newProducts' => $newProducts])
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/new_product.js') }}"></script>