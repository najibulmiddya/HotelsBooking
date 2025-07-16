<!-- razorpay/razorpay_redirect.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Razorpay</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h3>Processing Payment...</h3>

    <script>
        var options = {
            "key": "<?= $key_id ?>",
            "amount": "<?= $amount * 100 ?>",  
            "currency": "INR",
            "name": "Room Booking",
            "description": "Hotel room booking payment",
            "order_id": "<?= $razorpay_order_id ?>",
            "handler": function (response) {
                $.post("<?= base_url('razorpay/verify') ?>", {
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature,
                    order_id: "<?= $order_id ?>",
                    amount: "<?= $amount ?>"
                }, function (res) {
                    try {
                        let result = JSON.parse(res);
                        alert(result.message);
                        if (result.status) {
                            window.location.href = "<?= base_url('home'); ?>";
                        }
                    } catch (e) {
                        alert("Payment succeeded, but there was a response error.");
                    }
                });
            },
            "prefill": {
                "name": "<?= $user['NAME'] ?>",
                "email": "demo@example.com",
                "contact": "9999999999"
            },
            "theme": {
                "color": "#528FF0"
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    </script>
</body>
</html>
