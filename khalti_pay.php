<button id="payment-button">Pay with Khalti</button>

<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script>
    var config = {
        "publicKey": "test_public_key_xxxxx",
        "productIdentity": "<?php echo $booking_id; ?>",
        "productName": "Tour Package",
        "productUrl": "http://localhost/tms/",
        "eventHandler": {
            onSuccess (payload) {
                fetch("khalti_verify.php", {
                    method: "POST",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify(payload)
                }).then(res => res.json())
                  .then(data => alert("Payment Success!"));
            }
        }
    };
    var checkout = new KhaltiCheckout(config);
    document.getElementById("payment-button").onclick = function () {
        checkout.show({amount: 2000*100}); // amount in paisa
    }
</script>
