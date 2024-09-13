$(document).ready(function() {
    $(document).on('click', '.pagination-news a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let page = url.split('page=')[1];
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('.news-list').html(response);
                let url = new URL(window.location.href);
                url.searchParams.set('page', page);
                window.history.pushState({}, '', url);
            },
            error: function(xhr) {
                console.log('Something went wrong.');
            }
        });
    });
});