$(document).ready(function() {

    function updatePrice(quantity,updateType) {
        var selectedColor = $('.color-button.active').data('color');
        var selectedStorage = $('.storage-button.active').data('storage');
        var productId = $('.product-name').data('product-id');
        var productQuantity = parseInt(quantity);
        var cartForm = $('#add-to-cart-form');
        var quantity = $('#quantity');
        var variantId = $('#variant-id');
        var variantPrice = $('#variant-price');
        var finalPriceInput = $('#final-price');

        if (cartForm.length > 0) {
            quantity.val(productQuantity);
        }

        $.ajax({
            url: "/product/get-price",
            method: "GET",
            data: {
                product_id: productId,
                color: selectedColor,
                capacity: selectedStorage
            },
            success: function(response) {
                var initialPrice = parseInt(response.price);
                var finalPrice = initialPrice * productQuantity;
                finalPriceInput.val(finalPrice);
                variantId.val(response.id);
                variantPrice.val(parseInt(response.price));
                $('.remain-quantity-count').text(response.remain_quantity);
                if (updateType === 1) {
                    $('#product-price').text(finalPrice.toLocaleString('vi-VN') + ' VND');
                }
            }
        });
    }

    // Khi chọn màu sắc
    $('#color-buttons').on('click', '.color-button', function() {
        var currentQuantity = parseInt($('.now-quantity').val());
        $('.color-button').removeClass('active');
        $(this).addClass('active');
        updatePrice(currentQuantity,1);
    });

    // Khi chọn dung lượng
    $('#storage-buttons').on('click', '.storage-button', function() {
        var currentQuantity = parseInt($('.now-quantity').val());
        $('.storage-button').removeClass('active');
        $(this).addClass('active');
        updatePrice(currentQuantity,1);
    });


    $('.btn-subtract').click(function() {
        var $quantityInput = $('.now-quantity');
        var currentQuantity = parseInt($quantityInput.val());

        // Đảm bảo số lượng không giảm xuống dưới 1
        if (currentQuantity > 1) {
            $quantityInput.val(currentQuantity - 1);
            currentQuantity--;
            updatePrice(currentQuantity,2);
        }
    });

    // Xử lý khi nhấp vào nút tăng
    $('.btn-add').click(function() {
        var $quantityInput = $('.now-quantity');
        var currentQuantity = parseInt($quantityInput.val());

        // Tăng số lượng
        $quantityInput.val(currentQuantity + 1);
        currentQuantity++;
        updatePrice(currentQuantity,2);
    });

    // Xử lý khi người dùng nhập số lượng
    $('.now-quantity').on('input', function() {
        var quantity = $(this).val();

        if ($.isNumeric(quantity) && quantity >= 1) {
            $(this).val(quantity);
                updatePrice(quantity,2);
        } else {

            $(this).val(1);
        }
    });

    $('#add-to-cart-form').submit(function (event) {
        event.preventDefault();
        let productId = $('#product-id').val();
        let variantId = $('#variant-id').val() === "" ? $('.color-button').data('variant-id') : $('#variant-id').val()  ;
        let price = $('#variant-price').val() === "" ? parseInt($('.color-button').data('price')) : $('#variant-price').val();
        let finalPrice = $('#final-price').val() === "" ? parseInt($('.color-button').data('price')) : $('#final-price').val();
        let quantity = $('#quantity').val()==="" ? 1 : $('#quantity').val();

        $.ajax({
            url: '/user/cart/add',
            method: "POST",
            data: {
                product_id: productId,
                variant_id: variantId,
                _token: $('#csrf-token').val(),
                price: price,
                final_price: finalPrice,
                quantity: quantity,
            },
            success: function(response) {
                $('#cart-alert').show();
                $('#cart-alert').text(response.message);
                $('.cart-count').text(response.quantity);

            },
            error: function(xhr, status, error) {
                alert("Error");
            }
        })
    });
});
