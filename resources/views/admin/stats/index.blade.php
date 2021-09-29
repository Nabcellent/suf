@extends('admin.layouts.app')
@section('title', 'Stats')
@section('content')

    <div id="chart-index" class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-7">
                <div class="card border-0 shadow p-3">
                    <div id="users" style="height: 300px;"></div>
                </div>
            </div>
            <div class="col-5">
                <div id="top_customers" style="height: 300px;"></div>
            </div>
        </div>
        <div class="row align-items-center mb-3">
            <div class="col-5">
                <div id="top_products" style="height: 300px;"></div>
            </div>
            <div class="col-7">
                <div class="card border-0 shadow p-3">
                    <div id="orders" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-3 justify-content-center">
            <div class="col-9">
                <div id="products" style="height: 300px;"></div>
            </div>
        </div>
        <div class="row align-items-center mb-3 justify-content-center">
            <div class="col-5">
                <div class="card border-0 shadow p-3">
                    <div id="best_sellers" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charting library -->
    <script src="{{ asset('vendor/chartisan/chart.min.js') }}"></script>
    <!-- Chartisan -->
    <script src="{{ asset('vendor/chartisan/chartisan.umd.js') }}"></script>
    <script>
        const randomScalingFactor = () => Math.round(Math.random() * 100)
        const randomColorFactor = () => Math.round(Math.random() * 255);
        const randomColor = opacity => {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };

        const gradientColor = rgbColor => {
            let rgb = rgbColor.join()
            let gradient = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 0, 400);

            gradient.addColorStop(0, `rgba(${rgb}, 1)`);
            gradient.addColorStop(0.5, `rgba(${rgb}, .5)`);
            gradient.addColorStop(1, `rgba(${rgb}, 0)`);

            return gradient;
        }

        const chart = {
            users: new Chartisan({
                el: '#users',
                url: "@chart('users')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading chart data...',
                },
                hooks: new ChartisanHooks()
                    .colors([`rgb(173, 10, 0)`, `rgb(0, 10, 173)`])
                    .responsive()
                    .beginAtZero()
                    .legend({position: 'bottom'})
                    .title('New users')
                    .datasets([
                        {
                            type: 'line', fill: true,
                            backgroundColor: gradientColor([0,123,255]),
                        }, {
                            type: 'line', fill: true,
                            backgroundColor: gradientColor([200, 15, 25]),
                        }
                    ])
            }),

            topCustomers: new Chartisan({
                el: '#top_customers',
                url: "@chart('esteemed.customers')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading chart data...',
                },
                hooks: new ChartisanHooks()
                    .responsive()
                    .title('Top 5 (esteemed) customers')
                    .datasets('pie')
                    .pieColors([`rgb(173, 10, 0)`, randomColor(.7), randomColor(.7), randomColor(.7), randomColor(.7)])
                    .legend({position: 'bottom'})
                    .tooltip({
                        callbacks: {
                            label: function (tooltipItem, data) {
                                let dataset = data.datasets[tooltipItem.datasetIndex];
                                let currentValue = dataset.data[tooltipItem.index];

                                return new Intl.NumberFormat('en-GB', {style: 'currency', currency: 'KES'}).format(currentValue)
                            }
                        }
                    })
            }),

            topProducts: new Chartisan({
                el: '#top_products',
                url: "@chart('orders.product')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading chart data...',
                },
                hooks: new ChartisanHooks()
                    .responsive()
                    .title('Top 5 ordered products')
                    .datasets('pie')
                    .pieColors([`rgba(173, 10, 0, 1)`, randomColor(.7), randomColor(.7), randomColor(.7), randomColor(.7)])
                    .legend({position: 'bottom'})
            }),

            orders: new Chartisan({
                el: '#orders',
                url: "@chart('orders')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading chart data...',
                },
                hooks: new ChartisanHooks()
                    .beginAtZero()
                    .responsive()
                    .legend({position: 'bottom'})
                    .title('Orders per day in the past one week.')
                    .colors(['rgb(30, 100, 225)'])
                    .datasets([{type: 'line', fill: false}, 'bar'])
                    .padding(20)
            }),

            products: new Chartisan({
                el: '#products',
                url: "@chart('products')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading chart data...',
                },
                hooks: new ChartisanHooks()
                    .beginAtZero()
                    .responsive()
                    .legend({position: 'bottom'})
                    .title('Products created in the last week.')
                    .colors([`rgba(255, 255, 0, .6)`])
                    .datasets([{type: 'line', fill: true}])
                    .padding(20)
            }),

            bestSellers: new Chartisan({
                el: '#best_sellers',
                url: "@chart('best.sellers')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading chart data...',
                },
                hooks: new ChartisanHooks()
                    .responsive()
                    .title('Best Sellers')
                    .datasets('pie')
                    .pieColors([`rgb(173, 10, 0)`, randomColor(.7), randomColor(.7), randomColor(.7), randomColor(.7)])
                    .legend({position: 'bottom'})
                    .tooltip({
                        callbacks: {
                            label: function (tooltipItem, data) {
                                let dataset = data.datasets[tooltipItem.datasetIndex];
                                let currentValue = dataset.data[tooltipItem.index];

                                return `${currentValue} products sold`
                            }
                        }
                    })
            }),
        }

        setInterval(() => {
            chart.users.update({background: true})
            chart.topCustomers.update({background: true})
            chart.orders.update({background: true})
            chart.topProducts.update({background: true})
            chart.products.update({background: true})
            chart.bestSellers.update({background: true})
        }, 10000)
    </script>
@endsection
