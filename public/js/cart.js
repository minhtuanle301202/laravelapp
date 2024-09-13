$(document).ready(function() {

    function updatePrice(quantity,id) {

        let variantPrice = $('.variant-price-'+id).data('variant-price');
        let cartItemQuantity = parseInt(quantity);
        let finalPrice = cartItemQuantity*parseInt(variantPrice);
        let cartItemId = id;
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('.cartItem-price-'+cartItemId).text(finalPrice.toLocaleString('vi-VN') + ' VND');
        $.ajax({
            url: '/user/cart/update',
            method: "POST",
            data: {
                cartItemId: cartItemId,
                finalPrice: finalPrice,
                quantity: cartItemQuantity,
                _token: csrfToken
            },
            success: function(response) {
                $('.text-price').text(response.cart.price.toLocaleString('vi-VN') + ' VND');
                $('.cart-count').text(response.cart.quantity);
            }
        });
    }

    $('.btn-subtract').click(function() {
        let cartItemId = $(this).data('cartitem-id');
        let $quantityInput = $('.now-quantity-'+cartItemId);
        let currentQuantity = parseInt($quantityInput.val());
        let remainQuantity = $('.remain-quantity-'+cartItemId).val();

        // Đảm bảo số lượng không giảm xuống dưới 1
        if (currentQuantity > 1) {
            if (currentQuantity-1 > remainQuantity) {
                $quantityInput.val(remainQuantity.toString());
                currentQuantity = parseInt($quantityInput.val());
                updatePrice(currentQuantity,cartItemId);
                alert('Số lượng sản phẩm tối đa có thể đặt là ' + remainQuantity);
            } else {
                $quantityInput.val(currentQuantity - 1);
                currentQuantity--;
                updatePrice(currentQuantity,cartItemId);
            }

        }
    });

    // Xử lý khi nhấp vào nút tăng
    $('.btn-add').click(function() {
        let cartItemId = $(this).data('cartitem-id');
        let $quantityInput = $('.now-quantity-'+cartItemId);
        let currentQuantity = parseInt($quantityInput.val());
        let remainQuantity = $('.remain-quantity-'+cartItemId).val();
        // Tăng số lượng
        if (currentQuantity+1 > remainQuantity) {
            $quantityInput.val(remainQuantity.toString());
            currentQuantity = parseInt($quantityInput.val());
            updatePrice(currentQuantity,cartItemId);
            alert('Số lượng sản phẩm tối đa có thể đặt là ' + remainQuantity);
        } else {
            $quantityInput.val(currentQuantity + 1);
            currentQuantity++;
            updatePrice(currentQuantity,cartItemId);
        }
    });

    $('.now-quantity').on('input', function() {
        let quantity = $(this).val();
        let cartItemId = $(this).data('cartitem-id');
        let remainQuantity = $('.remain-quantity-'+cartItemId).val();

        // Đảm bảo giá trị nhập vào là số và lớn hơn hoặc bằng 1
        if ($.isNumeric(quantity) && quantity >= 1) {
            if (parseInt(quantity) > remainQuantity) {
                alert('Số lượng sản phẩm tối đa có thể đặt là ' + remainQuantity);
                $(this).val(remainQuantity.toString());
                updatePrice(remainQuantity.toString(),cartItemId);
            } else {
                $(this).val(quantity);
                updatePrice(quantity,cartItemId);
            }
        } else {
            // Nếu giá trị không hợp lệ, reset về giá trị mặc định
            $(this).val(1);
        }
    });

    $('.btn-delete').click(function() {
        let cartItemId =  $(this).data('cartitem-id');
        let row = $(this).closest('tr');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Bạn có chắc chắn muốn xóa mặt hàng này khỏi giỏ hàng không?')) {
            $.ajax({
                url: '/user/cart/delete',
                method: 'DELETE',
                data: {
                    cartItemId: cartItemId,
                    _token: csrfToken
                },
                success: function(response) {
                    row.remove();
                    $('.text-price').text(response.cart.price.toLocaleString('vi-VN') + ' VND');
                    $('.cart-count').text(response.cart.quantity);
                    if (response.message) {
                        $('.main-cart-pages').html(`
                        <div class="cart-empty-message">
                            <img class="bag-svg" src="../images/bag.svg">
                            <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                        </div>
                    `);
                    }
                },
                error: function(error) {
                    console.error('Error:',error);
                }
            })
        }
    });

    $('.remove-all').click(function () {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Bạn có chắc chắn muốn xóa tất cả các mặt hàng khỏi giỏ hàng hay không?')) {
            $.ajax({
                url: '/user/cart/delete-all',
                method: 'DELETE',
                data: {
                    _token: csrfToken
                },
                success: function(response) {
                    $('tbody').empty();
                    $('.text-price').text(response.cart.price.toLocaleString('vi-VN') + ' VND');
                    $('.cart-count').text(response.cart.quantity);
                    $('.main-cart-pages').html(`
                        <div class="cart-empty-message">
                            <img class="bag-svg" src="../images/bag.svg">
                            <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                        </div>
                    `);
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Đã xảy ra lỗi khi xóa tất cả mặt hàng.');
                }
            })
        }
    })
})