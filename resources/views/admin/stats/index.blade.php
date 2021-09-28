@extends('admin.layouts.app')
@section('title', 'Stats')
@section('content')

    <div id="chart-index" class="container-fluid">
        <div class="row mb-3">
            <div class="col-7">
                <div class="card p-3">
                    <div id="users" style="height: 300px;"></div>
                </div>
            </div>
            <div class="col-5">
                <div id="top_customers" style="height: 300px;"></div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-5">
                <div id="top_products" style="height: 300px;"></div>
            </div>
            <div class="col-7">
                <div class="card p-3">
                    <div id="orders" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-9">
                <div id="products" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script>
        const chart = {
            users: new Chartisan({
                el: '#users',
                url: "@chart('users')",
                hooks: new ChartisanHooks()
                    .colors(['#ECC94B', '#4299E1'])
                    .responsive()
                    .beginAtZero()
                    .legend({position: 'bottom'})
                    .title('Recent users')
                    .datasets([{type: 'line', fill: false}, 'bar']),
            }),

            topCustomers: new Chartisan({
                el: '#top_customers',
                url: "@chart('orders.product')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading some chart data...',
                },
                hooks: new ChartisanHooks()
                    .responsive()
                    .title('Top 3 ordered products')
                    .datasets('pie')
                    .pieColors([`rgba(153, 0, 0, 1)`, `rgba(153, 0, 0, .8)`, 'rgba(153, 0, 0, .6)'])
                    .legend({position: 'bottom'})
            }),

            topProducts: new Chartisan({
                el: '#top_products',
                url: "@chart('orders.product')",
                loader: {
                    color: '#000',
                    size: [30, 30],
                    type: 'bar',
                    textColor: '#900',
                    text: 'Loading some chart data...',
                },
                hooks: new ChartisanHooks()
                    .responsive()
                    .title('Top 5 ordered products')
                    .datasets('pie')
                    .pieColors([`rgba(153, 0, 0, 1)`, `rgba(153, 0, 0, .8)`, 'rgba(153, 0, 0, .6)'])
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
                    text: 'Loading some chart data...',
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
                    text: 'Loading some chart data...',
                },
                hooks: new ChartisanHooks()
                    .beginAtZero()
                    .responsive()
                    .legend({position: 'bottom'})
                    .title('Products created in the last week.')
                    .colors(['rgb(30, 100, 225)'])
                    .datasets([{type: 'line', fill: false}, 'bar'])
                    .padding(20)
            }),
        }

        const colorCodeSet = 'ABCDEF0123456789';

        function randomColor(noOfDatasets) {
            let colors = [];

            for (let i = 0; i < noOfDatasets; i++) colors.push(`#${str_shuffle(colorCodeSet).substr(0, 6)}`);

            return colors;
        }
        function str_shuffle(str) {
            if (arguments.length === 0) throw new Error('Wrong parameter count for str_shuffle()');
            if (str === null) return '';

            str += '';

            let newStr = '', rand = void 0, i = str.length;

            while (i) {
                rand = Math.floor(Math.random() * i);
                newStr += str.charAt(rand);
                str = str.substring(0, rand) + str.substr(rand + 1);
                i--;
            }

            return newStr;
        }

        setInterval(() => {
            chart.users.update({background: true})
            chart.orders.update({background: true})
            chart.products.update({background: true})
            chart.topProducts.update({background: true})
        }, 600000)
    </script>
@endsection
