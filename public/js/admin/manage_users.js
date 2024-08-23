$(document).ready(function() {
    $('.prev-users').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        if (currentPage > 1) {
            $.ajax({
                url: '/admin/manage/users/prev-users',
                method: 'GET',
                data: {
                    page : currentPage
                },
                success: function(response) {
                    $('tbody').html('');

                    $.each(response,function(index,user) {
                        $('tbody').append(
                            '<tr>' +
                            '<td>' + user.username + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + user.role + '</td>' +
                            '<td>' + user.created_at + '</td>' +
                            '<td>' + user.updated_at + '</td>' +
                            '<td>' +
                            '<div class="option">' +
                            '<button class="btn btn-info btn-sm btn-edit" data-id="' + user.id + '" data-toggle="modal" data-target="#editUserModal"><i class="fas fa-edit"></i></button>' +
                            '<button class="btn btn-danger btn-sm btn-delete" data-id="' + user.id + '"><i class="fas fa-trash-alt"></i></button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>'
                        );
                    });
                    currentPage--;
                    $('#page-numbers').val(currentPage);
                }
            });
        }
    })

    $('.next-users').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();

        $.ajax({
            url: '/admin/manage/users/next-users',
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
                            '<td>' + user.created_at + '</td>' +
                            '<td>' + user.updated_at + '</td>' +
                            '<td>' +
                            '<div class="option">' +
                            '<button class="btn btn-info btn-sm btn-edit" data-id="' + user.id + '" data-toggle="modal" data-target="#editUserModal"><i class="fas fa-edit"></i></button>' +
                            '<button class="btn btn-danger btn-sm btn-delete" data-id="' + user.id + '"><i class="fas fa-trash-alt"></i></button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>'
                        );
                    });
                    currentPage++;
                    $('#page-numbers').val(currentPage);
                }
            }
        });

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
                alert('Tài khoản đã được thêm thành công!');
                location.reload();
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

});

$(document).ready(function() {

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
                    alert('Thông tin đã được cập nhật');
                    location.reload();
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

});

function displayErrorsInAlert(errors) {
    let errorMessages = '';

    $.each(errors, function(key, messages) {
        errorMessages += messages[0] + '\n';
    });

    alert('Đã xảy ra lỗi:\n' + errorMessages);
}

$(document).ready(function() {
    $('tbody').on('click', '.btn-delete', function() {
        let userId =  $(this).data('id');
        let row = $(this).closest('tr');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Bạn có chắc chắn muốn xóa tài khoản này khỏi giỏ hàng không?')) {
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
                        location.reload();
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
})
