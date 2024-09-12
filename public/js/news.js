$(document).ready(function() {
    $('.prev-news').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        if (currentPage > 1) {
            $.ajax({
                url: '/news/prev-news',
                method: 'GET',
                data: {
                    page : currentPage
                },
                success: function(response) {
                    $('#news-item').html('');

                    $.each(response,function(index,item) {
                        $('#news-item').append(
                            '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-2">' +
                            '<div class="news-item">' +
                            '<img src="' + item.image + '" alt="Tin tức">' +
                            '<div class="news-title"><a href="#">' + item.title + '</a></div>' +
                            '<div class="posted-time">' + item.published_date + '</div>' +
                            '<div class="justify">' + item.content.substring(0, 150) + '...</div>' +
                            '</div>' +
                            '</div>'
                        );
                    });
                    currentPage--;
                    $('#page-numbers').val(currentPage);
                }
            });
        }
    })

    $('.next-news').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();

            $.ajax({
                url: '/news/next-news',
                method: 'GET',
                data: {
                    page : currentPage
                },
                success: function(response) {
                    if (!response.message) {
                        $('#news-item').html('');
                        $.each(response,function(index,item) {
                            let link = "/news/news-details/" + item.id;
                                $('#news-item').append(
                                '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-2">' +
                                '<div class="news-item">' +
                                '<img src="' + item.image + '" alt="Tin tức">' +
                                '<div class="news-title"><a href="'+ link +'">' + item.title + '</a></div>' +
                                '<div class="posted-time">' + item.published_date + '</div>' +
                                '<div class="justify">' + item.content.substring(0, 150) + '...</div>' +
                                '</div>' +
                                '</div>'
                            );
                        });
                        currentPage++;
                        $('#page-numbers').val(currentPage);
                    }
                }
            });

    })

});