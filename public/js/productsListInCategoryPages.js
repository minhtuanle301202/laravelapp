$(document).ready(function() {
    $(document).on('click', '.pagination-links a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success: function(data) {
                $('#products-list').html(data);
            }
        });
    });
});