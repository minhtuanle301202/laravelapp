$(document).ready(function () {
    $('#next-sidebar-news').click(function () {
        let currentPage = $('#page-number').val();
        let newsId = $('.news-title').data('news-id');
        console.log(newsId);
        if (currentPage < 8) {
            $.ajax({
                url: '/news/next-small-news',
                method: 'GET',
                data: {
                    newsId: newsId,
                },
                success: function(response) {
                    console.log(response);
                    if (!response.message) {
                        currentPage++;
                        data = `<img  src="${response.image}" alt="Tin tức">
            <div class="news-title" data-news-id="${response.id}"><a href="/news/news-details/${response.id}">${response.title}</a></div>
            <div class="posted-time">${response.published_date}</div>
            <div class="justify">
                ${response.content}
            </div>
            <input type="hidden" id="page-number" value="${currentPage}">`;
                        $('#news-sidebar-content').html(data);
                    }
                }
            })
        }

    })

    $('#prev-sidebar-news').click(function () {
        let currentPage = $('#page-number').val();
        let newsId = $('.news-title').data('news-id');
        console.log(newsId);
        if (currentPage > 1) {
            $.ajax({
                url: '/news/prev-small-news',
                method: 'GET',
                data: {
                    newsId: newsId,
                },
                success: function(response) {
                    currentPage--;
                    let content = response.content;
                    let truncatedContent = content.length > 100 ? content.substring(0, 100) + '...' : content;
                    data = `<img  src="${response.image}" alt="Tin tức">
            <div class="news-title" data-news-id="${response.id}"><a href="/news/news-details/${response.id}">${response.title}</a></div>
            <div class="posted-time">${response.published_datez}</div>
            <div class="justify">
                 ${truncatedContent}
            </div>
            <input type="hidden" id="page-number" value="${currentPage}">`;
                    $('#news-sidebar-content').html(data);
                }
            })
        }

    })
})

