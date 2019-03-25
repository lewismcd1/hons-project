$(document).ready(function () {
    $.ajax({
        url: "includes/charts.php",
        method: "GET",
        success: function (data) {
            console.log(data);

            var product = [];
            var stock = [];
            var threshold = [];

            for (var i in data) {
                product.push(data[i].product_name);
                stock.push(data[i].product_stock);
                threshold.push(data[i].stock_threshold);
            }
            var ctx = $("#mycanvas");
            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: product,
                    datasets: [
                        {
                            type: 'bar',
                            label: 'Product Stock',
                            backgroundColor: 'rgba(109, 127, 204)',
                            borderColor: 'rgba(0,0,0)',
                            hoverBackgroundColor: 'rgba(255,255,255)',
                            hoverBorderColor: 'rgba(0,0,0)',
                            data: stock
                        },
                        {
                            type: 'line',
                            label: 'Stock Threshold',
                            borderColor: 'rgba(220,20,60)',
                            data: threshold,

                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            beginAtZero: true,
                            ticks: {
                                autoSkip: false
                            }
                        }],
                    }
                }
            });
            /*
             var chartdata = {
             labels: product,
             datasets: [
             {
             label: 'Product Stock',
             backgroundColor: 'rgba(109, 127, 204)',
             borderColor: 'rgba(200, 200, 200, 0.75)',
             hoverBackgroundColor: 'rgba(255,255,255)',
             hoverBorderColor: 'rgba(200, 200, 200, 1)',
             data: stock
             }
             ]
             };

             var ctx = $("#mycanvas");

             var barGraph = new Chart(ctx, {
             type: 'bar',
             data: chartdata
             });*/
        },
        error: function (data) {
            console.log(data);
        }
    });
});