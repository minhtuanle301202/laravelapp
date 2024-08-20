$(document).ready(function() {
    $('.hot-category-link').on('click', function() {
        event.preventDefault();
        let categoryId = $(this).data('id');

        $('.hot-category-link').parent().removeClass('active');
        $(this).parent().addClass('active');

        $.ajax({
            url: '/new-products/category/' + categoryId,
            method: 'GET',
            success: function(response) {
                $('#hot-product-list').html(response);

                // Cập nhật URL mà không reload lại trang
                var url = new URL(window.location.href);
                url.searchParams.set('category_id', categoryId);
                window.history.pushState({}, '', url);
            },
            error: function(xhr) {
                console.log('Something went wrong.');
            }
        });
    });
});