@extends('Admin.layouts.app')
@section('content')

    <div id="order-view" class="container-fluid px-0">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="card bg-info text-white crud_table shadow mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Order Details</h6>
                                        <div>
                                            <span class="m-0" >#<%= order.id %></span>
                                            <a href="/orders/invoice/<%= order.id %>" class="ml-2 btn btn-outline-light" title="View Invoice" target="_blank">
                                                <i class="fas fa-file-invoice"></i> Invoice
                                            </a>
                                            <a href="http://localhost:8000/admin/invoice-pdf/<%= order.id %>" class="btn btn-outline-light">
                                                <i class="fa fa-file-pdf"></i> Generate PDF
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-sm table-borderless">
                                                                <tbody>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Order Number</th>
                                                                    <td class="py-1"><%= order.id %></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Coupon Code</th>
                                                                    <td class="py-1" colspan="2"><%= order.code %></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Coupon Discount</th>
                                                                    <td class="py-1" colspan="2"><%= order.discount %>/-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Delivery Fee</th>
                                                                    <td class="py-1" colspan="2"><%= order.delivery_fee %>/-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Payment Method</th>
                                                                    <td class="py-1" colspan="2"><%= order.payment_method %></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Payment Type</th>
                                                                    <td class="py-1" colspan="2"><%= order.payment_type %></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Amount Due</th>
                                                                    <td class="py-1 font-weight-bolder text-warning" colspan="2"><%= currencyFormat(order.total) %>/=</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <hr class="bg-light">
                                                            <div class="row">
                                                                <div class="col text-light">
                                                                    <p class="m-0">Order Date: &nbsp; <%= moment(order.created_at).format('MMMM Do YYYY @ h:mm:ss a') %></p>
                                                                    <p class="m-0">Order Status: &nbsp; <%= order.status %> %></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row pb-4">
                                                                <div class="col">
                                                                    <h6 class="m-0 font-weight-bold">Customer</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <table class="table-sm table-borderless">
                                                                        <tbody>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <td>:&nbsp;&nbsp;&nbsp;<%= order.first_name %> &nbsp; <%= order.last_name %></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email Address</th>
                                                                            <td>:&nbsp;&nbsp;&nbsp;<a href="mailto:<%= order.email %>" class="text-light"><%= order.email %></a></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h6 class="m-0 font-weight-bold">Delivery Address</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <table class="table-sm table-borderless">
                                                                        <tbody>
                                                                        <tr><th>County</th><td>:&nbsp;&nbsp;&nbsp;<%= order.county %></td></tr>
                                                                        <tr><th>Sub-County</th><td>:&nbsp;&nbsp;&nbsp;<%= order.subCounty %></td></tr>
                                                                        <tr><th>Address</th><td>:&nbsp;&nbsp;&nbsp;<%= order.address %></td></tr>
                                                                        <tr><th>Phone</th><td>:&nbsp;&nbsp;&nbsp;0<%= order.phone %></td></tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-danger"><i class="fab fa-opencart"></i> Order Products</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="categories_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Sub-Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <% order.orderProducts.forEach((product, i) => { %>
                                        <tr>
                                            <td><%= i + 1 %></td>
                                            <td><img src="/images/products/<%= product.main_image %>" alt="product" class="img-fluid"></td>
                                            <td><a href="/products/<%= product.product_id %>"><%= product.title %></a></td>
                                            <td><%= product.brand %></td>
                                            <td><%= product.username %></td>
                                            <td>
                                                <% for (const [key, value] of Object.entries(JSON.parse(product.details))) { %>
                                                <p class="m-0"><%= key %>: <%= value %></p>
                                                <% } %>
                                            </td>
                                            <td><%= product.quantity %></td>
                                            <td><%= product.final_unit_price %></td>
                                            <td><%= product.final_unit_price * product.quantity %></td>
                                        </tr>
                                        <% }) %>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="row">
                    <div class="col">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="/orders" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        All Orders<span class="badge badge-primary badge-pill">7</span>
                                    </a>
                                    <a href="/products" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Products<span class="badge badge-primary badge-pill">14</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Remaining stock<span class="badge badge-primary badge-pill">37</span>
                                    </a>
                                    <a href="/products/categories" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Categories<span class="badge badge-primary badge-pill">13</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5>Update Order Status</h5>
                                <hr>
                                <form id="update-order-status" action="/orders/status?_method=PATCH" method="POST">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option <%= (order.status === 'new') ? 'selected' : '' %> value="new">New</option>
                                            <option <%= (order.status === 'in process') ? 'selected' : '' %> value="in process">In Process</option>
                                            <option <%= (order.status === 'hold') ? 'selected' : '' %> value="hold">Hold</option>
                                            <option <%= (order.status === 'pending') ? 'selected' : '' %> value="pending">Pending</option>
                                            <option <%= (order.status === 'completed') ? 'selected' : '' %> value="completed">Completed</option>
                                            <option <%= (order.status === 'cancelled') ? 'selected' : '' %> value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                    <div id="courier" class="collapse">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <input type="text" class="form-control" name="courier" placeholder="Enter Courier Name">
                                            </div>
                                            <div class="form-group col">
                                                <input type="number" class="form-control" name="tracking_number" placeholder="Tracking number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="order_id" value="<%= order.id %>">
                                        <button type="submit" class="btn btn-outline-info">Update</button>
                                    </div>
                                </form>
                                <h5 class="mb-1">Logs</h5>
                                <hr class="mt-0">
                                <div>
                                    <% order.orderLogs.forEach(log => { %>
                                    <div class="row">
                                        <div class="col">
                                            <p class="font-weight-bold m-0"><%= log.status %></p>
                                            <p class="mb-1"><%= moment(log.created_at).format('MMMM Do YY @ h:mm:ss a') %></p>
                                            <hr class="col-6 mx-0 mt-0">
                                        </div>
                                    </div>
                                    <% }) %>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <%- include('./modals') %>

@endsection
