@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-md-3 mb-4">
                <a href="{{ route('admin.product.index') }}" class="card-link">
                    <div class="card-body shadow position-relative">
                        <div class="row no-gutters align-items-center">
                            <div class="col text-xs font-weight-bold text-primary text-uppercase mb-1">Products</div>
                            <div class="col-auto">
                                <i class="fab fa-opencart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                {{ tableCount()['products'] }} <span class="visually-hidden">unread messages</span>
                            </span>
                    </div>
                </a>
                <div class="card border-primary shadow"></div>
            </div>

            <div class="col-12 col-md-3 mb-4">
                <a href="{{ route('admin.orders') }}" class="card-link text-danger">
                    <div class="card-body shadow position-relative">
                        <div class="row no-gutters align-items-center">
                            <div class="col text-xs font-weight-bold text-danger text-uppercase mb-1">Orders</div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ tableCount()['orders'] }} <span class="visually-hidden">unread messages</span>
                            </span>
                    </div>
                </a>
                <div class="card border-danger"></div>
            </div>

            <div class="col-12 col-md-3 mb-4">
                <a href="{{ route('admin.customers') }}" class="text-success card-link">
                    <div class="card-body shadow position-relative">
                        <div class="row no-gutters align-items-center">
                            <div class="col text-xs font-weight-bold text-success text-uppercase mb-1">Customers</div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                {{ tableCount()['customers'] }} <span class="visually-hidden">unread messages</span>
                            </span>
                    </div>
                </a>
                <div class="card border-success shadow">
                </div>
            </div>

            @if(isRed())
                <div class="col-12 col-md-3 mb-4">
                    <a href="{{ route('admin.sellers') }}" class="card-link text-info">
                        <div class="card-body shadow position-relative">
                            <div class="row no-gutters align-items-center">
                                <div class="col text-xs font-weight-bold text-info text-uppercase mb-1">Sellers</div>
                                <div class="col-auto">
                                    <i class="fas fa-user-tag fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                {{ tableCount()['sellers'] }} <span class="visually-hidden">unread messages</span>
                            </span>
                        </div>
                    </a>
                    <div class="card border-info shadow">
                    </div>
                </div>
            @endif
        </div>

        <div id="chart" class="row mb-4">
            <div class="col-md-9">
                <div class="card text-light p-1 p-md-3 chart_frame">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-days-tab" data-toggle="tab" href="#nav-days" aria-controls="nav-days"
                               aria-selected="true">Per Day</a>
                            <a class="nav-link" id="nav-months-tab" data-toggle="tab" href="#nav-months" aria-controls="nav-months"
                               aria-selected="false">Per Month</a>
                            <div class="data_options d-none d-md-block">
                                <div class="row justify-content-end">
                                    <div class="col-auto pr-0 d-flex align-items-center">
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input chart-toggle" id="products" name="Product"
                                                   value="Product" checked>
                                            <label class="custom-control-label" for="products">Products</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input chart-toggle" id="orders" name="Order"
                                                   value="Order" checked>
                                            <label class="custom-control-label" for="orders">Orders</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input chart-toggle" id="customers" name="Customer"
                                                   value="Customer">
                                            <label class="custom-control-label" for="customers">Customers</label>
                                        </div>
                                        @if(isAdmin() || isRed())
                                            <div class="custom-control custom-switch custom-control-inline">
                                                <input type="checkbox" class="custom-control-input chart-toggle" id="sellers" name="Seller"
                                                       value="Seller">
                                                <label class="custom-control-label" for="sellers">Sellers</label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-auto pl-0">
                                        <div class="input-group">
                                            <span class="input-group-text py-0" id="basic-addon1">Chart</span>
                                            <select class="form-control" id="chart_type">
                                                <option selected value="line">Line Graph</option>
                                                <option value="bar">Bar Graph</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-days" role="tabpanel" aria-labelledby="nav-days-tab">
                            <div class="card-body">
                                <canvas id="dayChart" width="100%" height="30"></canvas>
                                <canvas id="blank" style="display:none"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-months" role="tabpanel" aria-labelledby="nav-months-tab">
                            <div class="card-body">
                                <canvas id="monthChart" width="100%" height="30"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <img src="{{ asset('images/illustrations/undraw_statistic_chart_38b6.svg') }}" alt="">
            </div>
        </div>

        <div class="row">
            @if(count($newOrders) > 0)
                <div class="col-xl-7 col-lg-6 col-md-12">
                    <div class="card crud_card shadow mb-4">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-danger">New Orders</h6>
                            <div class="dropdown no-arrow">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v text-danger"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="dropdown-header">Order Options</div>
                                    <a class="dropdown-item" href="{{ route('admin.orders') }}">View All Orders</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Customer Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Order Date</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($newOrders as $order)
                                        <?php
                                        $statusColor = match (strtolower($order->status)) {
                                            'pending' => 'warning',
                                            'completed' => 'success',
                                            'cancelled' => 'danger',
                                            default => 'secondary',
                                        }
                                        ?>
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->email }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-{{ $statusColor }}">{{ $order->status }}</span>
                                            </td>
                                            <td>{{ date('M d, y', strtotime($order->created_at)) }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('admin.orders') }}" class="nav-link text-right pb-0"> view all</a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-xl-5 col-lg-6 col-md-12">
                <div class="card crud_card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                 src="{{ asset('images/illustrations/undraw_web_developer_p3e5.svg') }}" alt="">
                        </div>
                        <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow"
                                                                                              href="https://undraw.co/">unDraw</a>, a
                            constantly updated collection of beautiful svg images that you can use
                            completely free and without attribution!</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                            unDraw →</a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!--    CHART JS CDN    -->
    <script src="{{ asset('vendor/chartjs/chart.min.js') }}" crossorigin="anonymous"></script>

@endsection
