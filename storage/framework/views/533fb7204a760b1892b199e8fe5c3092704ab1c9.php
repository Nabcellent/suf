<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-10">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Coupons</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="orders_table">
                                <thead>
                                <tr>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Pay Method</th>
                                    <th scope="col">Pay Type</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <% orders.forEach(row => { %>
                                <tr>
                                    <th><%= row.id %></th>
                                    <td><%= row.email %></td>
                                    <td><%= row.phone %></td>
                                    <td><%= row.payment_method %></td>
                                    <td><%= row.payment_type %></td>
                                    <td><%= row.discount %></td>
                                    <td><%= row.total %></td>
                                    <td><%= row.status %></td>
                                    <td><%= moment(row.created_at).format('DD/MM/YYYY') %></td>
                                    <td class="action" style="background-color: #1a202c">
                                        <a href="/orders/view/<%= row.id %>" class="ml-2" title="view Order">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                        <% if(row.tracking_number !== 0) { %>
                                        <a href="orders/invoice/<%= row.id %>" class="ml-2" title="View Invoice" target="_blank">
                                            <i class="fas fa-file-invoice text-warning"></i>
                                        </a>
                                        <a href="http://localhost:8000/admin/invoice-pdf/<%= row.id %>" class="ml-2" title="GENERATE PDF" target="_blank">
                                            <i class='fas fa-file-pdf text-white'></i>
                                        </a>
                                        <% } %>
                                    </td>
                                </tr>
                                <% }); %>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Orders/list.blade.php ENDPATH**/ ?>