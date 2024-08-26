$(document).ready(function() {
    $(document).on('click', '.pagination-links a', function(e) {
        e.preventDefault(); // Ngăn chặn việc load lại trang
        var url = $(this).attr('href'); // Lấy URL từ link pagination
        console.log(url);
        $.ajax({
            url: url, // Gửi AJAX request tới URL mới
            success: function(data) {
                $('#products-list').html(data); // Thay thế nội dung của div chứa sản phẩm
            }
        });
    });
});