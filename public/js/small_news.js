$(document).ready(function() {
    var currentPage = 1;
    var totalPages = 1;

    function loadNews(page) {
        $.ajax({
            url: '/news?page=' + page,
            method: 'GET',
            success: function(response) {
                $('#news-sidebar-content').empty(); // Xóa tin tức hiện tại

                // Cập nhật số trang và dữ liệu tin tức
                totalPages = response.last_page;

                // Thêm tin tức vào danh sách (chỉ có một tin tức trên mỗi trang)
                if (response.data.length > 0) {
                    var newsItem = response.data[0];
                    $('#news-sidebar-content').append(
                        '<div class="news-item">' +
                        '<img src="' + newsItem.image + '" alt="Tin tức">' +
                        '<div class="news-title"><a href="#">' + newsItem.title + '</a></div>' +
                        '<div class="posted-time">' + moment(newsItem.published_date).format('DD/MM/YYYY') + '</div>' +
                        '<div class="justify">' +
                        newsItem.content.substring(0, 150) + (newsItem.content.length > 150 ? '...' : '') +
                        '</div>' +
                        '</div>'
                    );
                }

                // Cập nhật trạng thái của các nút Prev và Next
                updateNavigationButtons();
            }
        });
    }

    function updateNavigationButtons() {
        $('#prev-sidebar-news').prop('disabled', currentPage === 1);
        $('#next-sidebar-news').prop('disabled', currentPage >= totalPages);
    }

    $('#prev-sidebar-news').click(function() {
        if (currentPage > 1) {
            currentPage--;
            loadNews(currentPage);
        }
    });

    $('#next-sidebar-news').click(function() {
        if (currentPage < totalPages) {
            currentPage++;
            loadNews(currentPage);
        }
    });

    loadNews(currentPage);
});
