@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Reviews</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-end mb-2" style="display: none">
                            <button data-model="Review" data-table="#reviews_table" class="btn btn-outline-red delete-all">
                                <i class="fas fa-trash"></i> Delete all
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="reviews_table">
                                <thead>
                                <tr>
                                    <th><input class="form-check-input select-all" type="checkbox"></th>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Review</th>
                                    <th>Rating</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($reviews as $review)
                                    <tr id="{{ $review->id }}">
                                        <td></td>
                                        <td></td>
                                        <td><a href="#">{{ $review->user->email }}</a></td>
                                        <td>{!! $review->review !!}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ date('d.m.Y', strtotime($review->updated_at)) }}</td>
                                        <td class="action">
                                            @if($review->status)
                                                <a class="update_status" data-id="{{ $review->id }}" data-model="Review" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $review->id }}" data-model="Review" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                            <a href="#" title="Modify"><i class="fas fa-pen text-success"></i></a>
                                            <a href="#" class="delete-from-table" title="Remove" data-id="{{ $review->id }}" data-model="Review">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

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
                            <a href="{{ route('admin.admins') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Admins<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                            </a>
                            <a href="{{ route('admin.sellers') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Sellers<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                            </a>
                            <a href="{{ route('admin.customers') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Customers<span class="badge badge-primary badge-pill">{{ tableCount()['customers'] }}</span>
                            </a>
                            <a href="{{ route('admin.product.index') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const reviewsDataTable = $('#reviews_table').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            order: [[4, 'desc']],
            language: {
                info: 'Number of reviews: _MAX_',
                infoFiltered: "(filtered _TOTAL_ reviews)",
                search: "_INPUT_",
                searchPlaceholder: "Search review"
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                searchable: false,
                orderable: false,
                targets: 1
            }, {
                searchable: false,
                orderable: false,
                targets: 5
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
        });
        reviewsDataTable.on('order.dt search.dt', function () {
            reviewsDataTable.column(1, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell["innerHTML"] = i + 1;
            });
        }).draw();
    </script>

@endsection
