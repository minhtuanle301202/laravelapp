$(document).ready(function() {
    let cartItemId = 1;
    function updatePrice(quantity) {

        let variantPrice = $('.variant-price').data('variant-price');
        let cartItemQuantity = parseInt(quantity);
        let finalPrice = cartItemQuantity*parseInt(variantPrice);

        $('.cartItem-price'+'.'+cartItemId).text(finalPrice.toLocaleString('vi-VN') + ' VND');
            $.ajax({
            url: "/user/cart/update",
            method: "GET",
            data: {
                cartItemId: cartItemId,
                finalPrice: finalPrice,
                quantity: cartItemQuantity
            },
            success: function(response) {
                $('.text-price'+'.'+cartItemId).text(response.price.toLocaleString('vi-VN') + ' VND');
            }
        });
    }

    $('.btn-subtract'+'.'+cartItemId).click(function() {
        var $quantityInput = $('.now-quantity'+'.'+cartItemId);
        var currentQuantity = parseInt($quantityInput.val());
        cartItemId = $('.product-name').data('cartitem-id');
        console.log(cartItemId);
        // Đảm bảo số lượng không giảm xuống dưới 1
        if (currentQuantity > 1) {
            $quantityInput.val(currentQuantity - 1);
            currentQuantity--;
            updatePrice(currentQuantity);
        }
    });

    // Xử lý khi nhấp vào nút tăng
    $('.btn-add'+'.'+cartItemId).click(function() {
        var $quantityInput = $('.now-quantity'+'.'+cartItemId);
        var currentQuantity = parseInt($quantityInput.val());

        // Tăng số lượng
        $quantityInput.val(currentQuantity + 1);
        currentQuantity++;
        updatePrice(currentQuantity);
    });

    // Xử lý khi người dùng nhập số lượng
    $('.now-quantity').on('input', function() {
        var quantity = $(this).val();

        // Đảm bảo giá trị nhập vào là số và lớn hơn hoặc bằng 1
        if ($.isNumeric(quantity) && quantity >= 1) {
            $(this).val(quantity);
            updatePrice(quantity);
        } else {
            // Nếu giá trị không hợp lệ, reset về giá trị mặc định
            $(this).val(1);
        }
    });
})