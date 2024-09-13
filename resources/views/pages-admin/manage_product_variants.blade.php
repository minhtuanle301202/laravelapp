@extends('layouts.admin.master')
@section('title', 'Danh Sách Biến Thể Sản Phẩm')
@section('content')
    @include('layouts.partials-admin.sidebar')
    <div class="main-content col-10">
        <div class="container">
            <div class="link-back ml-3 mb-3">
                <a href="/admin/manage/products">Danh Sách Sản Phẩm</a>
                <span>>></span>
                <p>{{ $product->name }}</p>
                <input type="hidden" id="TypeVariants" value="{{ $product->id }}">
            </div>
            <div class="top-container variant-list ml-3 mr-3 mb-3">
                <h3>Danh Sách Biến Thể Sản Phẩm</h3>
                <button class="btn-add-variant" data-toggle="modal" data-target="#addVariantModal">Thêm Biến Thể</button>
            </div>
            <div id="variants-content">
                @include('layouts.partials-admin.product_variants', ['variants' => $variants])
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
        </div>
    </div>

    <div class="modal fade" id="addVariantModal" tabindex="-1" role="dialog" aria-labelledby="addVariantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVariantModalLabel">Thêm Biến Thể</h5>
                </div>
                <div class="modal-body">
                    <form id="addVariantForm">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="capacity">Dung Lượng <span class="red-dot">*</span></label>
                            <input type="number" class="form-control" id="capacity" name="capacity" required>
                        </div>
                        <div class="form-group">
                            <label for="color">Màu Sắc <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá <span class="red-dot">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="remain_quantity">Số Lượng Còn Lại <span class="red-dot">*</span></label>
                            <input type="number" class="form-control" id="remain_quantity" name="remain_quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editVariantModal" tabindex="-1" role="dialog" aria-labelledby="editVariantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVariantModalLabel">Chỉnh Sửa Biến Thể</h5>
                </div>
                <div class="modal-body">
                    <form id="editVariantForm">
                        @csrf
                        <input type="hidden" id="edit_variant_id" name="id">
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="edit_capacity">Dung Lượng <span class="red-dot">*</span></label>
                            <input type="number" class="form-control" id="edit_capacity" name="capacity" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_color">Màu Sắc <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="edit_color" name="color" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_price">Giá <span class="red-dot">*</span></label>
                            <input type="number" class="form-control" id="edit_price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_remain_quantity">Số Lượng Còn Lại <span class="red-dot">*</span></label>
                            <input type="number" class="form-control" id="edit_remain_quantity" name="remain_quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/manage_product_variants.js') }}"></script>
@endsection
