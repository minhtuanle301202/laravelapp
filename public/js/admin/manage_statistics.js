$(document).ready(function() {
    let rc = document.getElementById('revenueChart').getContext('2d');
    let occ = document.getElementById('orderChart').getContext('2d');
    let months = JSON.parse(document.getElementById('chartMonths').value);
    let revenue = JSON.parse(document.getElementById('chartRevenue').value);
    let orderCounts = JSON.parse(document.getElementById('chartOrderCounts').value);

    var revenueChart = new Chart(rc, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Tổng doanh thu',
                data: revenue,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VND)'
                    }
                }
            }
        }
    });

    var orderChart = new Chart(occ, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Tổng số đơn hàng',
                data: orderCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số đơn hàng'
                    }
                }
            }
        }
    })

});
