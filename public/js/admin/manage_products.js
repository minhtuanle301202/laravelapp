$(document).ready(function() {
    function loadProducts(request,currentPage,categoryId,productName) {
            $.ajax({
                url: '/admin/manage/products/' + request,
                method: 'GET',
                data: {
                    page : currentPage,
                    categoryId: categoryId,
                    productName: productName,
                },
                success: function(response) {
                    if (response.message === 'Thành công') {
                        $('#product-content').html(response.data.products);
                        if (request === 'prev-products') {
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

    $('.prev-products').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        let categoryId = $('#productType').val();
        let productName = $('#productName').val();

        if (currentPage > 1) {
            loadProducts('prev-products',currentPage,categoryId,productName);
        }
    })

    $('.next-products').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        let categoryId = $('#productType').val();
        let productName = $('#productName').val();

        loadProducts('next-products',currentPage,categoryId,productName);
    })

    $('.btn-search').click(function() {
        event.preventDefault();
        let productName = $('#productName').val();
        let categoryId = $('#productType').val();
        $('#page-numbers').val(0);
        let currentPage = $('#page-numbers').val();

            $.ajax({
                url: '/admin/manage/products/search-product',
                method: 'GET',
                data: {
                    page : currentPage,
                    productName: productName,
                    categoryId: categoryId,
                },
                success: function(response) {
                    if (response.message === 'Thành công') {
                        $('#product-content').html(response.data.products);
                        currentPage++;
                        $('#page-numbers').val(currentPage);
                    } else {
                        alert(response.message);
                    }
                }
            })
    })

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
                    let currentPage = 1;
                    loadProducts('next-products',currentPage-1,categoryId);
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
                    let currentPage = $('#page-numbers').val();
                    loadProducts('next-products',currentPage-1,categoryId);
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
                        let currentPage = $('#page-numbers').val();
                        console.log(currentPage);
                        loadProducts('next-products',currentPage-1,categoryId);
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