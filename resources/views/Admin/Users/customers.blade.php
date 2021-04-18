@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Customers</h6>
                        <button class="btn btn-outline-info">Add Customer</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="customers_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>gender</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($customers as $customer)
                                    <tr>
                                        <td></td>
                                        <td>{{ $customer['first_name'] }}</td>
                                        <td>{{ $customer['last_name'] }}</td>
                                        <td>{{ $customer['email'] }}</td>
                                        <td>{{ $customer['primary_phone']['phone'] }}</td>
                                        <td>{{ $customer['gender'] }}</td>
                                        <td class="action">
                                            <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                            <a href="#" class="ml-3" title="Remove"><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--    Start delete modal    -->

        <div class="modal fade" id="del_product_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="#" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Are you sure you want to delete this product?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="yes" value="Delete Product" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--    End delete modal    -->
    </div>

@endsection
