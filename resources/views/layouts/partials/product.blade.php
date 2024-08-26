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
    <div class="middle-products" id="products-list">
        @include('layouts.partials.list_product', ['$category' => $category])
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/product.js') }}"></script>