@extends('layouts.users.master')
@section('title','Category')
@section('content')
    <div class="header-content">
        @include('layouts.partials.sidebar')
        @include('layouts.partials.banner')
    </div>
    <div class="middle-content">
        <div class="left-middle-content">
            @include('layouts.partials.support')
        </div>

        <div class="right-content">
            <div class="title-category">{{ $category->name }}</div>
            <div id="products-list">
                @include('layouts.partials.list_product',['products' => $products])
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/productsListInCategoryPages.js') }}"></script>
@endsection

