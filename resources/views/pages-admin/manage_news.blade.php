@extends('layouts.admin.master')
@section('title', 'Quản Lý Tin Tức')
@section('content')
@section('title','Quản lý tin tức')
    @include('layouts.partials-admin.sidebar')
    <div class="main-content col-10">
        <div class="container">
            <div class="top-content ml-3">
                <h2>Danh Sách Tin Tức</h2>
                <button class="btn-add-news" data-toggle="modal" data-target="#addNewsModal">Thêm Tin Tức</button>
            </div>
            <div id="news-content">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tiêu Đề</th>
                        <th>Ngày Đăng Tin</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($news as $newsItem)
                        <tr>
                            <td><img src="{{ $newsItem->image }}" alt="Image" width="100"></td>
                            <td>{{ $newsItem->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</td>
                            <td>
                                <div class="option">
                                    <button class="btn btn-info btn-sm btn-edit" data-id="{{ $newsItem->id }}" data-toggle="modal" data-target="#editNewsModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $newsItem->id }}"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    </tbody>
                </table>

            </div>
            <input type="hidden" name="page-numbers"  id="page-numbers" value="1">
            <div class="pagination-news">
                <button id="prev-news" class="prev-news">
                    << Previous
                </button>
                <button id="next-news" class="next-news">
                    Next >>
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">Thêm Tin Tức</h5>
                </div>
                <div class="modal-body">
                    <form id="addNewsForm">
                        @csrf
                        <div class="form-group">
                            <label for="title">Tiêu Đề <span>*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Nội Dung <span>*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="published_date">Ngày Đăng Tin <span>*</span></label>
                            <input type="date" class="form-control" id="published_date" name="published_date" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Link ảnh <span>*</span></label>
                            <input type="text" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Chỉnh Sửa Tin Tức</h5>
                </div>
                <div class="modal-body">
                    <form id="editNewsForm">
                        @csrf
                        <input type="hidden" id="editNewsId" name="newsId">
                        <div class="form-group">
                            <label for="edit_title">Tiêu Đề</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_content">Nội Dung</label>
                            <textarea class="form-control" id="edit_content" name="content" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_published_date">Ngày Đăng Tin</label>
                            <input type="date" class="form-control" id="edit_published_date" name="published_date" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Link Ảnh</label>
                            <input type="text" class="form-control" id="edit_image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/manage_news.js') }}"></script>
@endsection
