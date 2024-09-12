$(document).ready(function() {

    $('.btn-add-news').click(function(){
        $('#published_date').val(formatDate());
        $('#published_date').attr('readonly', true);
        $('#addNewsModal').modal('show');

    });

    $('#addNewsForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/admin/manage/news/create',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if (response.message === 'Thêm tin tức thành công') {
                    $('#addNewsModal').modal('hide');
                    $('#addNewsForm')[0].reset();
                    $('.modal-backdrop').remove();
                    alert('Tin tức đã được thêm thành công!');
                    let currentUrl = window.location.href;
                    let currentPage = currentUrl.split('page=')[1];
                    if (currentPage) {
                        window.location.href = '/admin/manage/news?page='+ currentPage;
                    } else {
                        window.location.href = '/admin/manage/news';
                    }
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
        let newsId =  $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/admin/manage/news/get-info',
            method: 'GET',
            data: {
                _token: csrfToken,
                newsId: newsId
            },
            success: function(response) {
                $('#editNewsId').val(response.data.id);
                $('#edit_title').val(response.data.title);
                $('#edit_content').val(response.data.content);
                $('#edit_published_date').val(response.data.published_date.split(' ')[0]).attr('readonly', true);
                $('#edit_image').val(response.data.image);
                $('#editNewsModal').modal('show');
            }
        });
    })


    $('#editNewsForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: '/admin/manage/news/update' ,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.message === 'Cập nhật thông tin tin tức thành công') {
                    $('#editNewsModal').modal('hide');
                    $('.modal-backdrop').remove();
                    alert('Tin tức đã được cập nhật');
                    let currentUrl = window.location.href;
                    let currentPage = currentUrl.split('page=')[1];
                    if (currentPage) {
                        window.location.href = '/admin/manage/news?page='+ currentPage;
                    } else {
                        window.location.href = '/admin/manage/news';
                    }
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
        let newsId =  $(this).data('id');
        let row = $(this).closest('tr');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Bạn có chắc chắn muốn xóa tin tức này không?')) {
            $.ajax({
                url: '/admin/manage/news/delete' ,
                method: 'DELETE',
                data: {
                    _token: csrfToken,
                    newsId: newsId
                },
                success: function(response) {
                    if (response.message === 'Xóa tin tức thành công') {
                        row.remove();
                        alert(response.message);
                        let currentUrl = window.location.href;
                        let currentPage = currentUrl.split('page=')[1];
                        if (currentPage) {
                            window.location.href = '/admin/manage/news?page='+ currentPage;
                        } else {
                            window.location.href = '/admin/manage/news';
                        }
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

function formatDate() {
    let today = new Date();

    let yyyy = today.getFullYear();
    let mm = String(today.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
    let dd = String(today.getDate()).padStart(2, '0');

    let formattedDate = yyyy + '-' + mm + '-' + dd;
    return formattedDate;
}