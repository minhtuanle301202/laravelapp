$(document).ready(function() {
    $('.prev-big-news').click(function() {
        let currentPage = $('#page-numbers').val();
        if (currentPage > 1) {
            $.ajax({
                url: '/news/prev-big-news',
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
                            '<div class="news-title"><a href="/news/news-details/'+ item.id +'" >' + item.title + '</a></div>' +
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

    $('.next-big-news').click(function() {
        let currentPage = $('#page-numbers').val();
        console.log(currentPage);
        if (currentPage < 3) {
            $.ajax({
                url: '/news/next-big-news',
                method: 'GET',
                data: {
                    page : currentPage
                },
                success: function(response) {
                    $('#news-item').html('');
                    console.log(response);
                    $.each(response,function(index,item) {
                        $('#news-item').append(
                            '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-2">' +
                            '<div class="news-item">' +
                            '<img src="' + item.image + '" alt="Tin tức">' +
                            '<div class="news-title"><a href="/news/news-details/'+item.id+'">' + item.title + '</a></div>' +
                            '<div class="justify">' + item.content.substring(0, 150) + '...</div>' +
                            '</div>' +
                            '</div>'
                        );
                    });

                    currentPage++;
                    $('#page-numbers').val(currentPage);
                }

            });
        }
    })

});