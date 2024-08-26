$(document).ready(function() {
    $('.category-link').on('click', function(e) {
        e.preventDefault();

        var categoryId = $(this).data('id');

        $.ajax({
            url: '/products/category',
            method: 'GET',
            data: {
                category_id: categoryId
            },
            success: function(response) {
                $('#products-list').html(response);

                // Cập nhật URL mà không reload lại trang
                var url = new URL(window.location.href);
                url.searchParams.set('category_id', categoryId);
                window.history.pushState({}, '', url);
            },
            error: function(xhr) {
                console.log('Something went wrong.');
            }
        });

        $('.category-item').removeClass('active');
        $(this).closest('.category-item').addClass('active');
    });

    // AJAX pagination
    $(document).on('click', '.pagination-links a', function(e) {
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        var categoryId = $('.category-item.active .category-link').data('id');

        $.ajax({
            url: '/products/category',
            method: 'GET',
            data: {
                category_id: categoryId,
                page: page
            },
            success: function(response) {
                $('#products-list').html(response);

                // Cập nhật URL mà không reload lại trang
                var url = new URL(window.location.href);
                url.searchParams.set('page', page);
                window.history.pushState({}, '', url);
            },
            error: function(xhr) {
                console.log('Something went wrong.');
            }
        });
    });
});