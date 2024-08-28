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
                data = `<div class="group_alert"> 
<div class="alert alert-success" role="alert">
                             ${response.message}
                           </div>
                       <div class="alert_btn"> 
                         <button class="btn-back-to-home btn btn-primary"><a href="/">Quay lại trang chủ</a></button>
                       </div> 
</div>`;
                $('.payment-container').html(data);
            },
            error: function(xhr) {

                console.log('Something went wrong.');
            }
        });
    });
});