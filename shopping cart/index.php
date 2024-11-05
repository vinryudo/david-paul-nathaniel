<?php
session_start();
include 'cartFunction.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$item1 = [
    "id" => 1,
    "name" => "Classic White Bowtie",
    "price" => 550,
    "image" => "../shopping cart/img/item1a.jpg",
    "image_hover" => "../shopping cart/img/item1b.jpg"
];

$item2 = [
    "id" => 2,
    "name" => "Elegant Silver Bowtie",
    "price" => 500,
    "image" => "../shopping cart/img/item2a.jpg",
    "image_hover" => "../shopping cart/img/item2b.jpg"
];

$item3 = [
    "id" => 3,
    "name" => "Striped Charcoal Bowtie",
    "price" => 470,
    "image" => "../shopping cart/img/item3a.jpg",
    "image_hover" => "../shopping cart/img/item3b.jpg"
];

$item4 = [
    "id" => 4,
    "name" => "Matte Gray Necktie",
    "price" => 550,
    "image" => "../shopping cart/img/item4a.jpg",
    "image_hover" => "../shopping cart/img/item4b.jpg"
];

$item5 = [
    "id" => 5,
    "name" => "Sleek Black Necktie",
    "price" => 480,
    "image" => "../shopping cart/img/item5a.jpg",
    "image_hover" => "../shopping cart/img/item5b.jpg"
];

$item6 = [
    "id" => 6,
    "name" => "Royal Purple Bowtie",
    "price" => 530,
    "image" => "../shopping cart/img/item6a.jpg",
    "image_hover" => "../shopping cart/img/item6b.jpg"
];

$item7 = [
    "id" => 7,
    "name" => "Crimson Red Necktie",
    "price" => 600,
    "image" => "../shopping cart/img/item7a.jpg",
    "image_hover" => "../shopping cart/img/item7b.jpg"
];

$item8 = [
    "id" => 8,
    "name" => "Bold Navy Necktie",
    "price" => 650,
    "image" => "../shopping cart/img/item8a.jpg",
    "image_hover" => "../shopping cart/img/item8b.jpg"
];

// Array of items
$items = [$item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8];

// Calculate total item count in the cart
$cart_count = 0;
foreach ($_SESSION['cart'] as $cart_item) {
    $cart_count += $cart_item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tie Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0">Tie Collection</h1>
            <a href="cart.php" class="btn btn-outline-light">
                <i class="bi bi-cart"></i> Cart 
                <span class="badge bg-warning text-dark"><?php echo $cart_count; ?></span>
            </a>
        </div>
    </header>

    <main class="container mt-4">
        <div class="row g-4">
            <?php foreach ($items as $item): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-card shadow-lg border-0 rounded-3 position-relative" onclick="window.location.href='details.php?id=<?php echo $item['id']; ?>'">
                        <div class="card-img-top position-relative">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid normal rounded-top">
                            <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid hover position-absolute top-0 start-0 rounded-top">
                        </div>
                        <div class="card-body p-3 position-relative">
                            <h5 class="card-title fw-bold mb-2"><?php echo $item['name']; ?></h5>
                            <p class="card-text text-muted mb-3">₱<span><?php echo number_format($item['price'], 2); ?></span></p><br>
                            <button class="btn btn-primary w-100 add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <style>
        .header {
            background-image: linear-gradient(to right, #343a40, #495057);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product-card {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .product-card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: opacity 0.5s ease;
        }

        .product-card img.hover {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .product-card:hover img.normal {
            opacity: 0;
        }

        .product-card:hover img.hover {
            opacity: 1;
        }

        .card-body {
            text-align: center;
            position: relative;
        }

        .add-to-cart-btn {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            margin: auto;
            transition: bottom 0.3s ease-in-out;
        }

        .product-card:hover .add-to-cart-btn {
            bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .cart-badge {
            font-size: 1.2rem;
            background-color: transparent;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .cart-count {
            border-radius: 50%;
            font-size: 0.9rem;
            padding: 2px 7px;
        }
    </style>
</body>
</html>
