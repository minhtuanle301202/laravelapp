$(document).ready(function() {
    function loadTopProducts(request,currentPage,endDate,startDate,sortBy,sortOrder) {
        $.ajax({
            url: '/admin/manage/statistics/' + request,
            method: 'GET',
            data: {
                page : currentPage,
                endDate: endDate,
                startDate: startDate,
                sortBy: sortBy,
                sortOrder: sortOrder
            },
            success: function(response) {
                if (response.message === 'Thành công') {
                    $('.topProducts-content').html(response.data.topProducts);
                    if (request === 'prev-top-products') {
                        currentPage--;
                    } else {
                        currentPage++;
                    }
                    $('#page-numbers').val(currentPage);
                } else {
                    alert(response.message);
                }
            }
        });
    }

    $('.btn-search').click(function () {
        event.preventDefault();
        let endDate = $('#endDate').val();
        let startDate = $('#startDate').val();
        let sortBy = $('#sortBy').val();
        let sortOrder = $('#sortOrder').val();

        $('#page-numbers').val(0);
        let currentPage = $('#page-numbers').val();

        $.ajax({
            url: '/admin/manage/statistics/search-top-products',
            method: 'GET',
            data: {
                endDate: endDate,
                startDate: startDate,
                sortBy: sortBy,
                sortOrder: sortOrder,
                page: currentPage
            },
            success: function (response) {
                if (response.message === 'Thành công') {
                    $('.topProducts-content').html(response.data.topProducts);
                    currentPage++;
                    $('#page-numbers').val(currentPage);
                } else {
                    alert(response.message);
                }
            }
        });
    })

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });

    $('.prev-top-products').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        let endDate = $('#endDate').val();
        let startDate = $('#startDate').val();
        let sortBy = $('#sortBy').val();
        let sortOrder = $('#sortOrder').val();

        if (currentPage > 1) {
            loadTopProducts('prev-top-products',currentPage,endDate,startDate,sortBy,sortOrder);
        }
    })

    $('.next-top-products').click(function() {
        event.preventDefault();
        let currentPage = $('#page-numbers').val();
        let endDate = $('#endDate').val();
        let startDate = $('#startDate').val();
        let sortBy = $('#sortBy').val();
        let sortOrder = $('#sortOrder').val();
        loadTopProducts('next-top-products',currentPage,endDate,startDate,sortBy,sortOrder);
    })
})