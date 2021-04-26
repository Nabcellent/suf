/**------------------------------------------------------------------------------------------------  AJAX  */
$(() => {
    let dayChart, monthChart;
    let monthChartCanvas = document.getElementById('dayChart'),
        dayChartCanvas = document.getElementById('monthChart');

    let charts = {
        init: function () {
            this.fetchChartData()
                .then(data =>{
                    this.createCharts(this.setChartData(data));
                });
        },
        fetchChartData: async () => {
            const MODELS = getCheckedValues();

            return $.ajax({
                url: 'chart',
                type: 'POST',
                data: {MODELS: MODELS},
                success: (response) => {
                    return response;
                }
            });
        },
        setChartData: (response) => {
            const chartType = $('select#chart_type').val();
            let dailyDataSet = [];
            let monthlyDataSet = [];

            $(response.data.tables).each(function () {
                let bgColor, borderColor;
                let gradient = dayChartCanvas.getContext('2d').createLinearGradient(0, 0, 0, 500);
                switch(this.modelName) {
                    case 'Products': {
                        borderColor = 'rgba(0,123,255, 7)'
                        gradient.addColorStop(0, 'rgba(0,123,255, 1)');
                        gradient.addColorStop(0.5, 'rgba(0,123,255, .5)');
                        gradient.addColorStop(1, 'rgba(0,123,255, 0)');
                    }
                        break;
                    case 'Orders' : {
                        borderColor = 'rgba(159, 25, 16, .7)'
                        gradient.addColorStop(0, 'rgba(200, 15, 25, 1)');
                        gradient.addColorStop(0.5, 'rgba(200, 15, 25, .5)');
                        gradient.addColorStop(1, 'rgba(200, 15, 25, 0)');
                    }
                        break;
                    case 'Customers' : {
                        borderColor = 'rgba(40,167,69, 7)'
                        gradient.addColorStop(0, 'rgba(40,167,69, 1)');
                        gradient.addColorStop(0.5, 'rgba(40,167,69, .5)');
                        gradient.addColorStop(1, 'rgba(40,167,69, 0)');
                    }
                        break;
                    case 'Sellers' : {
                        borderColor = 'rgba(23,164,186, 7)'
                        gradient.addColorStop(0, 'rgba(23,164,186, 1)');
                        gradient.addColorStop(0.5, 'rgba(23,164,186, .5)');
                        gradient.addColorStop(1, 'rgba(23,164,186, 0)');
                    }
                        break;
                    default:
                        bgColor = 'rgba(159, 25, 16, 1)';
                }

                dailyDataSet.push({
                    fill: 'origin',
                    label: '# of ' + this.modelName,
                    lineTension: 0.3,
                    backgroundColor: gradient,
                    borderColor: borderColor,
                    borderWidth: 1,
                    pointRadius: 3,
                    pointBorderColor: '#fff',
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#000',
                    pointHitRadius: 20,
                    data: this.dailyCountData,
                });

                monthlyDataSet.push({
                    fill: 'origin',
                    label: '# of ' + this.modelName,
                    lineTension: 0.3,
                    backgroundColor: gradient,
                    borderColor: borderColor,
                    borderWidth: 1,
                    pointRadius: 3,
                    pointBorderColor: '#fff',
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#000',
                    pointHitRadius: 20,
                    data: this.monthlyCountData,
                });
            });

            return {
                dailyConfig: lineChart(
                    chartType,
                    response.data.days.byName,
                    dailyDataSet,
                    response.data.maxDay
                ).config,
                monthlyConfig: lineChart(
                    chartType,
                    response.data.months.byName,
                    monthlyDataSet,
                    response.data.maxMonth
                ).config
            }
        },
        createCharts: (chartData) => {
            dayChart = new Chart(
                monthChartCanvas,
                chartData.dailyConfig
            );

            monthChart = new Chart(
                dayChartCanvas,
                chartData.monthlyConfig,
            );
        },
        updateCharts: (dayConfig, monthConfig) => {
            dayChart.data = dayConfig.data;
            dayChart.update();
            monthChart.data = monthConfig.data;
            monthChart.update();
        }
    }

    charts.init();

    $(document).on("click", '.chart-toggle', function() {
        charts.fetchChartData()
            .then(data => {
                const {dailyConfig, monthlyConfig} = charts.setChartData(data);
                charts.updateCharts(dailyConfig, monthlyConfig);
            });
    });

    $(document).on("change", 'select#chart_type', function() {
        dayChart.destroy();
        monthChart.destroy();
        charts.init();
    });
});

function lineChart(chartType, labels, dataset, max) {
    return {
        config: {
            type: chartType,
            data: {
                labels: labels,
                datasets: dataset
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgb(100,100,255)',
                        }
                    },
                    y: {
                        title: {
                            color: '#900'
                        },
                        min: 0,
                        max: max,
                        grid: {
                            color: 'rgba(151,135,255, .3)'
                        },
                        ticks: {
                            color: 'rgb(100,100,255)',
                            // Include a dollar sign in the ticks
                            /*callback: function(value, index, values) {
                                return '$' + value;
                            }*/
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#fff',
                        }
                    }
                }
            }
        }
    }
}

function barChart() {

}


function getCheckedValues() {
    let filterData = [];

    $('.chart-toggle:checked').each(function() {
        filterData.push($(this).val());
    });
    return filterData;
}
