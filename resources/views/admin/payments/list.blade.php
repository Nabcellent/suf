@extends('admin.layouts.app')
@section('content')
    <?php use App\Models\Order ?>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F M-Pesa Payments</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="mpesa_table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($mpesa as $pay)
                                <tr>
                                    <th></th>
                                    <th>{{ $pay['request']['phone'] }}</th>
                                    <td>{{ $pay['amount'] === null ? $pay['request']['amount'] : $pay['amount'] }}</td>
                                    <td>{{ $pay['result_desc'] }}</td>
                                    <td class="font-weight-bolder">{{ $pay['status'] }}</td>
                                    <td>{{ date('d~m~y', strtotime($pay['created_at'])) }}</td>
                                    <td class="action" style="background-color: #1a202c">
                                        <a href="{{ route('admin.order', ['id' => $pay['id']]) }}" class="ml-2" title="view Order">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                            <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                            @if(isAdmin())
                                <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Categories<span class="badge badge-primary badge-pill">{{ tableCount()['categories'] }}</span>
                                </a>
                            @endif
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">{{ tableCount()['qtySold'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        const mpesaDataTable = $('#mpesa_table').DataTable({
            scrollY:        '50vh',
            scrollCollapse: true,
            order: [0, 'DESC'],
            language: {
                info: 'Number of payments: _MAX_',
                infoFiltered:   "(filtered _TOTAL_ payments)",
                search: "_INPUT_",
                searchPlaceholder: "Search payment"
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 1
            }, {
                searchable: false,
                orderable: false,
                targets: 5
            }],
            createdRow: function(row, data) {
                if(data[1].replace(/[$,]/g, '') * 1 > 1000) {
                    $('td', row).eq(0).addClass('text-success');
                } else if(data[1].replace(/[$,]/g, '') * 1 < 1000) {
                    $('td', row).eq(0).addClass('text-danger');
                }
                if(data[4].toLowerCase() === 'cancelled') {
                    $('td', row).eq(2).addClass('text-warning');
                } else if(data[4].toLowerCase() === 'failed') {
                    $('td', row).eq(2).addClass('text-danger');
                } else if(data[4].toLowerCase() === 'paid') {
                    $('td', row).eq(2).addClass('text-success');
                }
            },
        });
        mpesaDataTable.on( 'order.dt search.dt', function () {
            mpesaDataTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell["innerHTML"] = i+1;
            } );
        }).draw();
    </script>

@endsection
