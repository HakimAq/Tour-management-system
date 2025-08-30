<?php
$booking_id = $_GET['booking_id'];
$amount = 2000; // ideally fetch from package price
$success_url = "http://localhost/tms/esewa_success.php?booking_id=$booking_id";
$failure_url = "http://localhost/tms/esewa_failed.php?booking_id=$booking_id";
?>

<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <input type="hidden" name="amount" value="<?= $amount ?>">
    <input type="hidden" name="tax_amount" value="0">
    <input type="hidden" name="total_amount" value="<?= $amount ?>">
    <input type="hidden" name="transaction_uuid" value="<?= uniqid() ?>">
    <input type="hidden" name="product_code" value="EPAYTEST">
    <input type="hidden" name="success_url" value="<?= $success_url ?>">
    <input type="hidden" name="failure_url" value="<?= $failure_url ?>">
    <button type="submit">Pay with eSewa</button>
</form>
