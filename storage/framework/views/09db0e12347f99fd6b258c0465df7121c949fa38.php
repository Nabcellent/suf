
<!--    Start Confirm Section    -->

<div class="card">
    <div class="card-header">
        <h1>Confirm your payment</h1>
    </div>
    <div class="card-body">
        <form id="confirm_payment_form" action="/profile/confirm-payment" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="order_id" name="order_id" class="form-control" value="">
            <div class="form-group">
                <div class="form-group">
                    <label for="invoice_no">Invoice Number *</label>
                    <input type="text" class="form-control" id="invoice_no" name="invoice_no" value="" placeholder="Enter invoice number" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="amount_paid">Amount Paid *</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">KSH</span>
                        </div>
                        <input type="number" class="form-control" id="amount_paid" name="amount_paid" placeholder="Amount required is ..." required>
                    </div>
                    <label for="amount_paid"></label>
                </div>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method *</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    <option hidden value="">Select Payment Method</option>
                    <option value="M-Pesa">M-Pesa</option>
                    <option value="PayPal">PayPal</option>
                    <option value="PayPal">Other Bank</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="transaction_id">Transaction ID *</label>
                    <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Enter transaction Id" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="code">PayPal Code *</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter confirmation code" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="payment_date">Payment Date *</label>
                    <input type="text" class="form-control" id="payment_date" name="payment_date" value="" placeholder="Enter payment date" required>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" name="submit_payment" value="submit_payment" class="btn btn-outline-success"><i class="fas fa-check-circle"></i> Confirm Payment</button>
                <img class="d-none loader_gif" src="/images/loaders/Infinity-1s-197px.gif" alt="loader.gif">
            </div>
        </form>
    </div>
</div>
<!--    End Confirm Section    -->
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/profile/confirm_payment.blade.php ENDPATH**/ ?>