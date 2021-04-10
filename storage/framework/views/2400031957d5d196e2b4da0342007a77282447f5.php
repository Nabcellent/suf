<div class="box bg-light p-3 rounded shadow">
    <div class="row">
        <div class="col">
            <h1>My Orders</h1>
            <p class="lead">Your Orders in one place</p>
            <p class="text-muted">If your have any Queries, please <a href="/contact-us">contact us</a></p>
        </div>
        <div class="dropdown-divider"></div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Due Amount</th>
                        <th scope="col">Invoice No</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Size</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Paid/Unpaid</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th scope='row'>$i</th>
                            <td>KES - 800</td>
                            <td>$invoiceNo</td>
                            <td>$quantity</td>
                            <td>$size</td>
                            <td>$orderDate</td>
                            <td>$orderStatus</td>
                            <td>
                                <a href='/profile/confirm-payment' target='_blank' class='text-nowrap morphic_btn morphic_btn_success'>
                                    <span><i class='fas fa-clipboard-check'></i> Confirm Paid</span>
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/profile/myorders.blade.php ENDPATH**/ ?>