<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            color: #007BFF;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #007BFF;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 140px;
        }

        .line {
            margin-bottom: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #999;
        }

        .box {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Booking Invoice</h2>
        <p>Thank you for booking with us!</p>
    </div>

    <div class="box">
        <!-- User Details -->
        <div class="section">
            <div class="section-title">User Details</div>
            <div class="line"><span class="label">Name:</span> <?= $booking['user_name'] ?? 'N/A' ?></div>
            <div class="line"><span class="label">Mobile:</span> <?= $booking['phonenum'] ?? 'N/A' ?></div>
            <div class="line"><span class="label">Address:</span> <?= $booking['adderss'] ?? 'N/A' ?></div>
        </div>

        <!-- Room Details -->
        <div class="section">
            <div class="section-title">Room Details</div>
            <div class="line"><span class="label">Room Name:</span> <?= $booking['room_name'] ?? 'N/A' ?></div>
            <div class="line"><span class="label">Room No:</span> <?= $booking['room_no'] ?? 'N/A' ?></div>
            <div class="line"><span class="label">Check-In:</span> <?= $booking['check_in'] ?></div>
            <div class="line"><span class="label">Check-Out:</span> <?= $booking['check_out'] ?></div>
        </div>

        <!-- Payment Details -->
        <div class="section">
            <div class="section-title">Payment Details</div>
            <div class="line"><span class="label">Order ID:</span> <?= $booking['order_id'] ?></div>
            <div class="line"><span class="label">Transaction ID:</span> <?= $booking['trans_id'] ?? '-' ?></div>
            <div class="line"><span class="label">Payment Status:</span> <?= $booking['trans_status'] ?? '-' ?></div>
            <div class="line"><span class="label">Total Pay:</span> ₹<?= $booking['total_pay'] ?></div>
            <div class="line"><span class="label">Booking Status:</span> <?= ucfirst($booking['booking_status']) ?></div>
            <div class="line"><span class="label">Payment Message:</span> <?= $booking['trans_respmgs'] ?? '-' ?></div>
        </div>
    </div>

    <div class="footer">
        &copy; <?= date('Y') ?> Your Hotel Name. All rights reserved.
    </div>

</body>

</html>
