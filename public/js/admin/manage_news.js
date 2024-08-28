$(document).ready(function() {
    function loadNews(request,currentPage) {
        $.ajax({
            url: '/admin/manage/news/' + request,
            method: 'GET',
            data: {
                page : currentPage
            },
            success: function(response) {
                if (!response.message) {
                    $('tbody').html('');
                    $.each(response,function(index,newsItem) {
                        $('tbody').append(
                            '<tr>' +
                            '<td><img src="' + newsItem.image + '" alt="Image" width="100"></td>' +
                            '<td>' + newsItem.title + '</td>' +
                            '<td>' + formatDate(newsItem.published_date) + '</td>' +
                            '<td>' +
                            '<div class="option">' +
                            '<button class="btn btn-info btn-sm btn-edit" data-id="' + newsItem.id + '" data-toggle="modal" data-target="#editNewsModal"><i class="fas fa-edit"></i></button>' +
                            '<button class="btn btn-danger btn-sm btn-delete" data-id="' + newsItem.id + '"><i class="fas fa-trash-alt"></i></button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>'
                        );
                    });
                    if (request === 'prev-news') {
                        currentPage--;
                    } else {
                        currentPage++;
                    }
                    $('#page-numbers').val(currentPage);
                }
            }
        });
    }


    $('.prev-news').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        if (currentPage > 1) {
            loadNews('prev-news',currentPage);
        }
    })

    $('.next-news').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        loadNews('next-news',currentPage);
    })

    $('.btn-add-news').click(function(){
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
                    let currentPage = $('#page-numbers').val();
                    loadNews('next-news',currentPage-1);
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

                $('#editNewsId').val(response.id);
                $('#edit_title').val(response.title);
                $('#edit_content').val(response.content);
                $('#edit_published_date').val(response.published_date);
                $('#edit_image').val(response.image);
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
                    let currentPage = $('#page-numbers').val();
                    loadNews('next-news',currentPage-1);
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
                        let currentPage = $('#page-numbers').val();
                        loadNews('next-news',currentPage-1);
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