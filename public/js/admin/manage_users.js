$(document).ready(function() {
    function loadUsers(request,currentPage) {
        $.ajax({
            url: '/admin/manage/users/' + request,
            method: 'GET',
            data: {
                page : currentPage
            },
            success: function(response) {
                if (!response.message) {
                    $('tbody').html('');

                    $.each(response,function(index,user) {
                        $('tbody').append(
                            '<tr>' +
                            '<td>' + user.username + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + user.role + '</td>' +
                            '<td>' + formatDate(user.created_at) + '</td>' +
                            '<td>' + formatDate(user.updated_at) + '</td>' +
                            '<td>' +
                            '<div class="option">' +
                            '<button class="btn btn-info btn-sm btn-edit" data-id="' + user.id + '" data-toggle="modal" data-target="#editUserModal"><i class="fas fa-edit"></i></button>' +
                            '<button class="btn btn-danger btn-sm btn-delete" data-id="' + user.id + '"><i class="fas fa-trash-alt"></i></button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>'
                        );
                    });
                    if (request === 'prev-users') {
                        currentPage--;
                    } else {
                        currentPage++;
                    }
                    $('#page-numbers').val(currentPage);
                }
            }
        });
    }


    $('.prev-users').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        if (currentPage > 1) {
            loadUsers('prev-users',currentPage);
        }
    })

    $('.next-users').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        loadUsers('next-users',currentPage);
    })

    $('.btn-add-user').click(function(){
        $('#addUserModal').modal('show');
    });

    $('#addUserForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/admin/manage/users/create',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if (response.message === 'Thêm tài khoản thành công') {
                    $('#addUserModal').modal('hide');
                    $('.modal-backdrop').remove();
                    alert('Tài khoản đã được thêm thành công!');
                    let currentPage = $('#page-numbers').val();
                    loadUsers('next-users',currentPage-1);
                }
            },
            error: function(xhr){
                if (xhr.status === 422) { // 422 là mã lỗi dành cho lỗi xác thực
                    var errors = xhr.responseJSON.errors;
                    displayErrorsInAlert(errors);
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            }
        })
    });

    $('tbody').on('click','.btn-edit',function(event) {
        let userId =  $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/admin/manage/users/get-info',
            method: 'GET',
            data: {
                _token: csrfToken,
                userId: userId
            },
            success: function(response) {

                $('#editUserId').val(response.id);
                $('#editUsername').val(response.username);
                $('#editEmail').val(response.email);
                $('#editPhone').val(response.phone);
                $('#editUserModal').modal('show');
            }
        });
    })


    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: '/admin/manage/users/update' ,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.message === 'Cập nhật thông tin tài khoản thành công') {
                    $('#editUserModal').modal('hide');
                    $('.modal-backdrop').remove();
                    alert('Thông tin đã được cập nhật');
                    let currentPage = $('#page-numbers').val();
                    loadUsers('next-users',currentPage-1);
                } else {
                    alert(response.message);
                }

            },
            error: function(xhr) {
                if (xhr.status === 422) { // 422 là mã lỗi dành cho lỗi xác thực
                    var errors = xhr.responseJSON.errors;
                    displayErrorsInAlert(errors);
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            }
        });
    });

    $('tbody').on('click', '.btn-delete', function() {
        let userId =  $(this).data('id');
        let row = $(this).closest('tr');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')) {
            $.ajax({
                url: '/admin/manage/users/delete' ,
                method: 'DELETE',
                data: {
                    _token: csrfToken,
                    userId: userId
                },
                success: function(response) {
                    if (response.message === 'Xóa tài khoản thành công') {
                        row.remove();
                        alert(response.message);
                        let currentPage = $('#page-numbers').val();
                        loadUsers('next-users',currentPage-1);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.error('Error:',error);
                }
            })
        }
    });
});

function displayErrorsInAlert(errors) {
    let errorMessages = '';

    $.each(errors, function(key, messages) {
        errorMessages += messages[0] + '\n';
    });
    alert('Đã xảy ra lỗi:\n' + errorMessages);
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    const date = new Date(dateString);
    return date.toLocaleString('en-GB', options).replace(',', '');
}