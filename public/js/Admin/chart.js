/**------------------------------------------------------------------------------------------------  AJAX  */
$(() => {
    let dayChart, monthChart;

    let charts = {
        init: function () {
            this.fetchChartData();
        },
        fetchChartData: () => {
            const MODELS = getCheckedValues();

            $.ajax({
                url: 'chart',
                type: 'POST',
                data: {MODELS: MODELS},
                success: (response) => {
                    charts.createLineChart(response);
                }
            });
        },
        createLineChart: (response) => {
            const chartType = $('select#chart_type').val();
            let dailyDataSet = [];
            let monthlyDataSet = [];

            $(response.data.tables).each(function () {
                let bgColor, borderColor;
                switch(this.modelName) {
                    case 'Products': bgColor = 'rgba(0,123,255, .7)'; borderColor = 'rgba(0,123,255, 1)'
                        break;
                    case 'Orders' : bgColor = 'rgba(159, 25, 16, .7)'; borderColor = 'rgba(159, 25, 16, 1)'
                        break;
                    case 'Customers' : bgColor = 'rgba(40,167,69, .7)'; borderColor = 'rgba(40,167,69, 1)'
                        break;
                    case 'Sellers' : bgColor = 'rgba(23,164,186, .7)'; borderColor = 'rgba(23,164,186, 1)'
                        break;
                    default:
                        bgColor = 'rgba(159, 25, 16, 1)';
                }
                dailyDataSet.push({
                    fill: 'origin',
                    label: '# of ' + this.modelName,
                    lineTension: 0.3,
                    backgroundColor: bgColor,
                    borderColor: borderColor,
                    borderWidth: 3,
                    pointRadius: 5,
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
                    backgroundColor: bgColor,
                    borderColor: borderColor,
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBorderColor: '#fff',
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#000',
                    pointHitRadius: 20,
                    data: this.monthlyCountData,
                });
            });

            const dailyConfig = lineChart(
                chartType,
                response.data.days.byName,
                dailyDataSet,
                response.data.maxDay
            ).config;

            const monthlyConfig = lineChart(
                chartType,
                response.data.months.byName,
                monthlyDataSet,
                response.data.maxDay
            ).config;

            dayChart = new Chart(
                document.getElementById('dayChart'),
                dailyConfig
            );

            monthChart = new Chart(
                document.getElementById('monthChart'),
                monthlyConfig
            );
        }
    }

    charts.init();

    $(document).on("click", '.chart-toggle', function() {
        dayChart.destroy();
        monthChart.destroy();
        charts.init();
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
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                    },
                    y: {
                        min: 0,
                        max: max,
                        grid: {
                            color: 'rgb(0, 0, 208)'
                        },
                        ticks: {
                            //maxTicksLimit: 10,
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
