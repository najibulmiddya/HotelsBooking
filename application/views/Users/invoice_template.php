<?php $data = $bookings; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - <?= $data['order_id'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
            background: #f8f9fa;
        }

        .invoice-box {
            max-width: 850px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .invoice-header {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 700;
            color: #343a40;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .text-gray {
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="invoice-box">
        <!-- Header -->
        <div class="row invoice-header align-items-center">
            <div class="col-md-6">
                <h1 class="invoice-title">Hotel Booking Invoice</h1>
                <small class="text-muted">Invoice #: <?= $data['order_id'] ?></small>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <strong>Date:</strong> <?= date('d-m-Y', strtotime($data['datetime'])) ?><br>
                <strong>Time:</strong> <?= date('h:i A', strtotime($data['datetime'])) ?>
            </div>
        </div>

        <!-- Customer + Booking Info -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-uppercase text-primary">Customer Details</h6>
                <p class="mb-1"><strong>Name:</strong> <?= $data['user_name'] ?></p>
                <p class="mb-1"><strong>Phone:</strong> <?= $data['phonenum'] ?></p>
                <p class="mb-1"><strong>Address:</strong> <?= $data['adderss'] ?></p>
            </div>
            <div class="col-md-6 text-md-end">
                <h6 class="text-uppercase text-primary">Booking Details</h6>
                <p class="mb-1"><strong>Booking ID:</strong> <?= $data['booking_id'] ?></p>
                <p class="mb-1"><strong>Room:</strong> <?= $data['room_name'] ?> (<?= $data['room_no'] ?: 'Not Assigned' ?>)</p>
                <p class="mb-1"><strong>Booking Status:</strong>
                    <span class="badge bg-success text-capitalize"><?= $data['booking_status'] ?></span>
                </p>
            </div>
        </div>

        <!-- Stay Info Table -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Per Night Price</th>
                    <th>Total Pay</th>
                    <th>Arrival</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['check_in'] ?></td>
                    <td><?= $data['check_out'] ?></td>
                    <td>₹<?= number_format($data['price'], 2) ?></td>
                    <td>₹<?= number_format($data['total_pay'], 2) ?></td>
                    <td><?= $data['arraval'] ? 'Yes' : 'No' ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Info -->
        <h6 class="text-uppercase text-primary mt-4">Payment Details</h6>
        <table class="table table-borderless mb-4">
            <tr>
                <td><strong>Transaction ID:</strong></td>
                <td><?= $data['trans_id'] ?></td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td><?= $data['trans_status'] ?> (<?= $data['trans_respmgs'] ?>)</td>
            </tr>
            <tr>
                <td><strong>Paid Amount:</strong></td>
                <td><strong class="text-success">₹<?= number_format($data['trans_amt'], 2) ?></strong></td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="text-center text-muted small mt-4">
            <hr>
            <p class="mb-0">Thank you for booking with us. We hope you enjoyed your stay!</p>
            <p class="mb-0">This is a computer-generated invoice and does not require a physical signature.</p>
        </div>
    </div>

</body>

</html>