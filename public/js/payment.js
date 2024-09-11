$(document).ready(function() {
    $('.btn-order').on('click', function() {
        event.preventDefault();

        $.ajax({
            url: '/user/cart/place-an-order' ,
            method: 'POST',
            data: {
                _token: $('#csrf-token').val(),
                address: $('#address').val(),
                payment_method: $('#payment-method').val(),
                name: $('#name').val(),
                phone_number: $('#phone-number').val(),
            },
            success: function(response) {
                if (response.message === 'Đặt hàng thành công') {
                    data = `<div class="group_alert"> 
<div class="alert alert-success" role="alert">
                             ${response.message}
                           </div>
                       <div class="alert_btn"> 
                         <button class="btn-back-to-home btn btn-primary"><a href="/">Quay lại trang chủ</a></button>
                       </div> 
</div>`;
                    $('.payment-container').html(data);
                } else if(response.message === 'Đặt hàng quá số lượng') {
                    console.log(response);
                    $('.payment-container').html('');
                    $('.payment-container').append('<p class="over-stock-product">Đã có sản phẩm đặt quá số lượng cho phép</p>');
                    $.each(response.overStocks,function(index,value) {
                        $('.payment-container').append('<p class="over-stock-product"> Sản phẩm '+value.name+ '-' + value.color + '-' + value.capacity + ' chỉ còn lại '+ value.remain_quantity + ' sản phẩm');
                    })

                    $('.payment-container').append(`<div class="alert_btn"> 
                         <button class="btn-back-to-home btn btn-primary">Quay lại giỏ hàng để sửa lại</button>
                       </div>`)

                    $('.btn-back-to-home').click(function() {
                        window.location.href = '/user/cart';
                    });
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