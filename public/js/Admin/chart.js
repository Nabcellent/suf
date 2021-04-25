/**------------------------------------------------------------------------------------------------  AJAX  */
$(() => {
    let charts = {
        init: function () {
            this.fetchChartData();
        },
        fetchChartData: (model = 'Order') => {
            $.ajax({
                url: 'chart',
                type: 'POST',
                //data: {model},
                success: (response) => {
                    charts.createChart(response);
                }
            });
        },
        createChart: (response) => {
            console.log(response);

            const labels = response.days;

            const data = {
                labels: labels,
                datasets: [{
                    fill: 'origin',
                    label: '# of Orders',
                    lineTension: 0.3,
                    backgroundColor: [
                        'rgba(159, 25, 16, 1)',
                    ],
                    borderColor: [
                        'rgb(0, 0, 208)',
                    ],
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBorderColor: '#fff',
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#000',
                    pointHitRadius: 20,
                    data: response.dailyCountData,
                }]
            };

            const config = {
                type: 'line',
                data,
                options: {
                    scales: {
                        x: {
                            time: {
                                unit: 'date'
                            },
                            grid: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            min: 0,
                            max: response.maxDay,
                            grid: {
                                color: 'rgb(0, 0, 208)'
                            },
                            ticks: {
                                maxTicksLimit: 10,
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#000',
                            }
                        }
                    }
                }
            };

            new Chart(
                document.getElementById('myChart'),
                config
            );
        }
    }

    charts.init();

    /*$('#selectChart').on('change', function() {
        fetchChartData($(this).val());
    });*/
});

