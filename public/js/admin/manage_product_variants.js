$(document).ready(function() {
    let productId = $('#TypeVariants').val();
    function loadVariants(request,currentPage) {
        $.ajax({
            url: '/admin/manage/products/' + productId + '/variants/' + request,
            method: 'GET',
            data: {
                page : currentPage,
                productId:productId
            },
            success: function(response) {
                if (response.message === 'Thành công') {
                    $('#variants-content').html(response.data.variants);
                    if (request === 'prev-variants') {
                        currentPage--;
                    } else {
                        currentPage++;
                    }
                    $('#page-numbers').val(currentPage);
                } else {
                    alert(response.message);
                }
            }
        });
    }

    $('.prev-variants').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();

        if (currentPage > 1) {
            loadVariants('prev-variants',currentPage);
        }
    })

    $('.next-variants').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        loadVariants('next-variants',currentPage);
    })

    $('.btn-add-variant').click(function(){
        $('#addVariantModal').modal('show');
    });

    $('#addVariantForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/admin/manage/products/' + productId + '/variants/create',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if (response.message === 'Thêm biến thể thành công') {
                    $('#addVariantModal').modal('hide');
                    $('#addVariantForm')[0].reset();
                    $('.modal-backdrop').remove();
                    alert('Biến thể đã được thêm thành công!');
                    let currentPage = 1;
                    loadVariants('next-variants',currentPage-1,productId);
                } else {
                    alert(response.message);
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

    $('#variants-content').on('click','.btn-edit',function(event) {
        let variantId =  $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/admin/manage/products/'+productId+'/variants/get-info'  ,
            method: 'GET',
            data: {
                _token: csrfToken,
                variantId: variantId
            },
            success: function(response) {

                $('#edit_variant_id').val(response.data.id);
                $('#edit_capacity').val(response.data.capacity);
                $('#edit_color').val(response.data.color);
                $('#edit_price').val(parseInt(response.data.price.toLocaleString('vi-VN')));
                $('#edit_remain_quantity').val(response.data.remain_quantity);
                $('#editVariantModal').modal('show');
            }
        });
    })


    $('#editVariantForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: '/admin/manage/products/'+productId+'/variants/update' ,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.message === 'Cập nhật thông tin biến thể thành công') {
                    $('#editVariantModal').modal('hide');
                    $('#editVariantForm')[0].reset();
                    $('.modal-backdrop').remove();
                    alert('Thông tin biến thể đã được cập nhật');
                    let currentPage = $('#page-numbers').val();
                    loadVariants('next-variants',currentPage-1);
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

    $('#variants-content').on('click', '.btn-delete', function() {
        let variantId =  $(this).data('id');
        let row = $(this).closest('tr');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Bạn có chắc chắn muốn xóa biến thể này không?')) {
            $.ajax({
                url: '/admin/manage/products/'+productId+'/variants/delete' ,
                method: 'DELETE',
                data: {
                    _token: csrfToken,
                    variantId: variantId
                },
                success: function(response) {
                    if (response.message === 'Xóa biến thể thành công') {
                        row.remove();
                        alert(response.message);
                        let currentPage = $('#page-numbers').val();
                        console.log(currentPage);
                        loadVariants('next-variants',currentPage-1);
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