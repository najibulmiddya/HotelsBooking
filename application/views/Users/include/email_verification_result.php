<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            text-align: center;
            padding: 50px;
        }

        .box {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .success {
            color: green;
            font-size: 18px;
        }

        .error {
            color: red;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="box">
        <?php if ($status == 'success'): ?>
            <h2 class="success"><?= $message ?></h2>
        <?php else: ?>
            <h2 class="error"><?= $message ?></h2>
        <?php endif; ?>
    </div>

    <?php if (!empty($redirect_url)): ?>
        <script>
            setTimeout(function() {
                window.location.href = "<?= $redirect_url ?>";
            }, <?= ($redirect_delay ?? 10) * 1000 ?>); // delay in milliseconds
        </script>
    <?php endif; ?>

</body>

</html>