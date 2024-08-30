$(document).ready(function() {
    $('#orderStatus').change(function() {
        let status = $(this).val();
        event.preventDefault();
        $('#page-numbers').val(0);
        let currentPage = $('#page-numbers').val();
        loadOrders('next-orders',currentPage,status);
    });

    function loadOrders(request,currentPage,status,startDate,endDate) {
        $.ajax({
            url: '/admin/manage/orders/' + request,
            method: 'GET',
            data: {
                page : currentPage,
                status: status,
                startDate: startDate,
                endDate: endDate,
            },
            success: function(response) {
                if (!response.message) {
                    $('#orders-content').html(response.orders);
                    if (request === 'prev-orders') {
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

    $('.prev-orders').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        let status = $('#orderStatus').val();
        let startDate = $('#orderStartDate').val();
        let endDate = $('#orderEndDate').val();

        if (currentPage > 1) {
            loadOrders('prev-orders',currentPage,status,startDate,endDate);
        }
    })

    $('.next-orders').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        let status = $('#orderStatus').val();
        let startDate = $('#orderStartDate').val();
        let endDate = $('#orderEndDate').val();
        loadOrders('next-orders',currentPage,status,startDate,endDate);
    })

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });


    $('.btn-search').click(function() {
        event.preventDefault();
        let status = $('#orderStatus').val();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let orderCode = $('#orderCode').val();

        $('#page-numbers').val(0);
        let currentPage = $('#page-numbers').val();
            $.ajax({
                url: '/admin/manage/orders/search',
                method: 'GET',
                data: {
                    page : currentPage,
                    status: status,
                    orderCode: orderCode,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function(response) {
                    if (!response.message) {
                        $('#orders-content').html(response.orders);
                        currentPage++;
                        $('#page-numbers').val(currentPage);
                    } else {
                        alert(response.message);
                    }
                }
            })
    })

    $('#orders-content').on('click','.btn-edit',function(event) {
        let orderId =  $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/admin/manage/orders/get-info',
            method: 'GET',
            data: {
                _token: csrfToken,
                orderId: orderId
            },
            success: function(response) {
                $('#editOrderId').val(response.id);
                $('#editUserName').val(response.username);
                $('#editPhone').val(response.phone);
                $('#editStatus').val(response.status);
                $('#editPaymentMethod').val(response.payment_method);
                $('#editAddress').val(response.address);
                $('#editOrderDate').val(response.order_date.split(' ')[0]);
                $('#editOrderModal').modal('show');
            }
        });
    })

    $('#editOrderForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let status = $('#orderStatus').val();
        let startDate = $('#orderStartDate').val();
        let endDate = $('#orderEndDate').val();
        $.ajax({
            url: '/admin/manage/orders/update' ,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.message === 'Cập nhật thông tin đơn hàng thành công') {
                    $('#editOrderModal').modal('hide');
                    $('#editOrderForm')[0].reset();
                    $('.modal-backdrop').remove();
                    alert('Thông tin đơn hàng đã được cập nhật');
                    let currentPage = $('#page-numbers').val();
                    loadOrders('next-orders',currentPage-1,status,startDate,endDate);
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

    $('#orders-content').on('click','.btn-order-details',function(event) {
        let orderId =  $(this).data('id');
        window.location.href = '/admin/manage/orders/show-order-details/' + orderId ;
    })
});

function displayErrorsInAlert(errors) {
    let errorMessages = '';

    $.each(errors, function(key, messages) {
        errorMessages += messages[0] + '\n';
    });
    alert('Đã xảy ra lỗi:\n' + errorMessages);
}
