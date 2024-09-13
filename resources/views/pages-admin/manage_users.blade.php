@extends('layouts.admin.master')
@section('title','Quản lý tài khoản')
@section('content')
    @include('layouts.partials-admin.sidebar')
    <div class="main-content col-10">
        <div class="container">
            <div class="top-content ml-3">
                <h2>Danh Sách Tài Khoản</h2>
                <button class=" btn-add-user" data-toggle="modal" data-target="#addUserModal">Thêm Tài Khoản</button>
            </div>
            <div id="users-content">
                @if ($users->isEmpty())
                    <p class="text-center">Không tìm thấy tài khoản nào</p>
                @else
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <div class="option">
                                    <button class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#editUserModal" data-id="{{ $user->id }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    </tbody>
                </table>
                    <div class="pagination-users">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>


        </div>
    </div>

    <!-- Modals thêm và sửa tài khoản -->
    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Thêm Tài Khoản</h5>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="red-dot">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" >Số điện thoại <span class="red-dot">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="red-dot">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" >Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh Sửa Tài Khoản</h5>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        @csrf
                        <input type="hidden" id="editUserId" name="userId">
                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" >Số điện thoại </label>
                            <input type="text" class="form-control" id="editPhone" name="phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/manage_users.js') }}"></script>
@endsection
