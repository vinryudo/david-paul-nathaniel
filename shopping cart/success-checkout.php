<?php
session_start();
session_destroy(); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Bowtie & Necktie Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

    <header class="bg-dark text-white py-3 shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Bowtie & Necktie Shop</h1>
            <a href="cart.php" class="btn btn-outline-light position-relative">
                <i class="bi bi-cart"></i> Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">0</span>
            </a>
        </div>
    </header>

    <!-- Success Message -->
    <div class="container mt-5 text-center">
        <div class="p-5 rounded-3 shadow-sm bg-light">
            <div class="icon mb-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            </div>
            <h2 class="fw-bold mb-3">Order Successful!</h2>
            <p class="text-muted">Thank you for shopping with us! Your order has been processed successfully.</p>
            <p>We hope to see you again soon!</p>
            <a href="index.php" class="btn btn-dark mt-4"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
