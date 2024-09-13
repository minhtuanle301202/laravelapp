$(document).ready(function() {

    let currentUrl = window.location.href;
    if (currentUrl.includes('productName')) {
        $(document).on('click', '.pagination-products a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let page = url.split('page=')[1];
            let childUrl = '&page=' + page;
            let newUrl = currentUrl + childUrl;
            console.log(newUrl);
            $.ajax({
                url: newUrl,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#product-content').html(response);
                    let url = new URL(window.location.href);
                    url.searchParams.set('page', page);
                    window.history.pushState({}, '', url);
                },
                error: function(xhr) {
                    console.log('Something went wrong.');
                }
            });
        });
    }


    $('.btn-add-product').click(function(){
        $('#addProductModal').modal('show');
    });

    $('#addProductForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/admin/manage/products/create',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if (response.message === 'Thêm sản phẩm thành công') {
                    let categoryId = $('#category_id').val();
                    $('#addProductModal').modal('hide');
                    $('#addProductForm')[0].reset();
                    $('.modal-backdrop').remove();
                    alert('Sản phẩm đã được thêm thành công!');
                    location.reload();
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

    $('#product-content').on('click','.btn-edit',function(event) {
        let productId =  $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/admin/manage/products/get-info',
            method: 'GET',
            data: {
                _token: csrfToken,
                productId: productId
            },
            success: function(response) {

                $('#edit_product_id').val(response.data.id);
                $('#edit_name').val(response.data.name);
                $('#edit_description').val(response.data.description);
                $('#edit_image').val(response.data.image);
                $('#edit_category_id').val(response.data.category_id);
                $('#editProductModal').modal('show');
            }
        });
    })


    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let categoryId = $('#productType').val();
        $.ajax({
            url: '/admin/manage/products/update' ,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.message === 'Cập nhật thông tin sản phẩm thành công') {
                    $('#editProductModal').modal('hide');
                    $('.modal-backdrop').remove();
                    alert('Thông tin sản phẩm đã được cập nhật');
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

    $('#product-content').on('click', '.btn-delete', function() {
        let productId =  $(this).data('id');
        let row = $(this).closest('tr');
        let categoryId = $('#productType').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
            $.ajax({
                url: '/admin/manage/products/delete' ,
                method: 'DELETE',
                data: {
                    _token: csrfToken,
                    productId: productId
                },
                success: function(response) {
                    if (response.message === 'Xóa sản phẩm thành công') {
                        row.remove();
                        alert(response.message);
                        let rowCount = $('#productTableBody tr').length;
                        if (rowCount < 1) {
                            let currentUrl = window.location.href;
                            let url = new URL(currentUrl);
                            let currentPage = currentUrl.split('page=')[1];

                            if (typeof currentPage === 'undefined') {
                                window.location.href = currentUrl;
                            } else {

                                if (parseInt(currentPage) === 1) {
                                    window.location.href = currentUrl;
                                } else {
                                    url.searchParams.set('page',parseInt(currentPage)-1) ;
                                    window.location.href = url.href;
                                }
                            }
                        } else {
                            location.reload();
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

    $('#product-content').on('click','.btn-variants',function(event) {
        let productId =  $(this).data('id');
        window.location.href = '/admin/manage/products/' + productId + '/variants' ;
    })
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