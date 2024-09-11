@extends('layouts.admin.master')
@section('title', 'Quản Lý Sản Phẩm')
@section('content')
    @include('layouts.partials-admin.sidebar')
    <div class="main-content col-10">
        <div class="container">
            <div class="row align-items-end ml-3">
                <div class="col-md-5 pl-0">
                    <label for="productType">Loại sản phẩm</label>
                    <select class="form-control" id="productType">
                        <option value="0">Tất cả</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="productName">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="productName" placeholder="Nhập tên sản phẩm">
                </div>
            </div>
            <button class="btn btn-primary btn-search ml-3 mt-2 mb-4">Tìm kiếm</button>
            <div class="top-content ml-3">
                <h2>Danh Sách Sản Phẩm</h2>
                <button class=" btn-add-product" data-toggle="modal" data-target="#addProductModal">Thêm Sản Phẩm</button>
            </div>
            <div id="product-content">
                @include('layouts.partials-admin.products',['products' => $products])
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" name="page-numbers"  id="page-numbers" value="1">
            <div class="pagination-products">
                <button id="prev-products" class="prev-products">
                    << Previous
                </button>
                <button id="next-products" class="next-products">
                    Next >>
                </button>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm Sản Phẩm</h5>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên sản phẩm <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả <span class="red-dot">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Link ảnh <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Loại sản phẩm <span class="red-dot">*</span></label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Chỉnh Sửa Sản Phẩm</h5>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        @csrf
                        <input type="hidden" id="edit_product_id" name="id">
                        <div class="form-group">
                            <label for="edit_name">Tên sản phẩm <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Mô tả <span class="red-dot">*</span></label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Link ảnh <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="edit_image" name="image" required>
                        </div>
                        <input type="hidden" class="edit-category_id" id="edit_category_id" name="category_id">
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/manage_products.js') }}"></script>
@endsection
