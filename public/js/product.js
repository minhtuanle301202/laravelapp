$(document).ready(function() {
    // Khai báo biến toàn cục
    var currentPage = 1;
    var totalPages = 1;

    // Hàm để tải sản phẩm và phân trang
    function loadProducts(categoryId, page) {
        $.ajax({
            url: '/products/category/' + categoryId + '?page=' + page,
            method: 'GET',
            success: function(response) {
                $('#product-list').empty(); // Xóa sản phẩm hiện tại
                $('#pagination').empty(); // Xóa phân trang hiện tại

                // Cập nhật số trang và dữ liệu sản phẩm
                totalPages = response.last_page;

                // Thêm sản phẩm vào danh sách
                $.each(response.data, function(index, product) {
                    $('#product-list').append(
                        '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-0">' +
                        '<a href="/product/' + product.id + '" class="product-link">' +
                        '<div class="product-item">' +
                        '<span class="is-loved"></span>' +
                        '<img src="' + product.image + '" alt="Image">' +
                        '<div class="name">' + product.name + '</div>' +
                        '<div class="price">' + (product.price ? product.price.toLocaleString() : 'Giá không xác định') + ' VND</div>' +
                        '<button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>' +
                        '</div>' +
                        '</a>' +
                        '</div>'
                    );
                });


                updatePagination();
            }
        });
    }

    // Hàm để cập nhật thanh phân trang
    function updatePagination() {
        var paginationHtml = '';

        if (currentPage > 1) {
            paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + (currentPage - 1) + '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            paginationHtml += '<li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for (var i = 1; i <= totalPages; i++) {
            if (i === currentPage) {
                paginationHtml += '<li class="page-item active"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
            } else {
                paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
            }
        }

        if (currentPage < totalPages) {
            paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + (currentPage + 1) + '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        } else {
            paginationHtml += '<li class="page-item disabled"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        }

        $('#pagination').html(paginationHtml);
    }

    // Sự kiện khi nhấp vào một danh mục
    $('.category-menu .category-item').click(function(event) {
        event.preventDefault();
        var categoryId = $(this).find('.category-link').data('id');

        // Cập nhật lớp active cho danh mục hiện tại
        $('.category-menu .category-item').removeClass('active');
        $(this).addClass('active');

        // Tải sản phẩm cho danh mục đã chọn và trang đầu tiên
        if (categoryId) {
            currentPage = 1;
            loadProducts(categoryId, currentPage);
        }
    });

    // Sự kiện khi nhấp vào các liên kết phân trang
    $(document).on('click', '.pagination .page-link', function(event) {
        event.preventDefault();
        var page = $(this).data('page');

        if (page) {
            currentPage = page;
            var categoryId = $('.category-menu .category-item.active .category-link').data('id');
            loadProducts(categoryId, currentPage);
        }
    });

    // Tải sản phẩm của danh mục đầu tiên và trang đầu tiên khi trang được tải
    $(function() {
        var firstCategoryId = $('.category-menu .category-item:first .category-link').data('id');
        if (firstCategoryId) {
            loadProducts(firstCategoryId, currentPage);
        }
    });
});
