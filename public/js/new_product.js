$(document).ready(function() {
    $('.hot-category-link').on('click', function() {
        event.preventDefault();
        var categoryId = $(this).data('id');

        $('.hot-category-link').parent().removeClass('active');
        $(this).parent().addClass('active');

        $.ajax({
            url: '/new-products/category/' + categoryId,
            method: 'GET',
            success: function(response) {
                var productHtml = '';
                $.each(response, function(index, product) {
                    productHtml += `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-0">
                            <a href="/product/detail/${product.id}" class="product-link">
                                <div class="product-item">
                                    <span class="is-loved"></span>
                                    <img src="${product.image}" alt="Image">
                                    <div class="name">${product.name}</div>
                                    <div class="price">0 VND</div>
                                    <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
                                </div>
                            </a>
                        </div>
                    `;
                });
                $('#hot-product-list').html(productHtml);
            }
        });
    });
});