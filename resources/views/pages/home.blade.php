@extends('layouts.users.master')
@section('title','Home')
@section('content')
    <div class="header-content">
        @include('layouts.partials.sidebar')
        @include('layouts.partials.banner')
    </div>

    <div class="middle-content">
        <div class="left-middle-content">
            @include('layouts.partials.support')
            @include('layouts.partials.small_news')
        </div>

        <div class="right-content">
            @include('layouts.partials.new_product')
            @include('layouts.partials.product')
        </div>

    </div>
    <div class="footer-content">
        @include('layouts.partials.big_news')
    </div>
@endsection