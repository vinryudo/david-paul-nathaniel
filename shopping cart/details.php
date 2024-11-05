<?php
session_start();
include 'cartFunction.php';

$items = [
    [
        "id" => 1,
        "name" => "Classic White Bowtie",
        "price" => 550,
        "image" => "img/item1a.jpg",
        "image_hover" => "img/item1b.jpg",
        "description" => "A timeless classic white bowtie that complements any formal attire."
    ],
    [
        "id" => 2,
        "name" => "Elegant Silver Bowtie",
        "price" => 500,
        "image" => "img/item2a.jpg",
        "image_hover" => "img/item2b.jpg",
        "description" => "This elegant silver bowtie adds a touch of sophistication to your outfit."
    ],
    [
        "id" => 3,
        "name" => "Striped Charcoal Bowtie",
        "price" => 470,
        "image" => "img/item3a.jpg",
        "image_hover" => "img/item3b.jpg",
        "description" => "A stylish striped charcoal bowtie perfect for semi-formal and formal events."
    ],
    [
        "id" => 4,
        "name" => "Matte Gray Necktie",
        "price" => 550,
        "image" => "img/item4a.jpg",
        "image_hover" => "img/item4b.jpg",
        "description" => "A sophisticated matte gray necktie that pairs well with modern suits."
    ],
    [
        "id" => 5,
        "name" => "Sleek Black Necktie",
        "price" => 480,
        "image" => "img/item5a.jpg",
        "image_hover" => "img/item5b.jpg",
        "description" => "A sleek black necktie that is a must-have for any formal wardrobe."
    ],
    [
        "id" => 6,
        "name" => "Royal Purple Bowtie",
        "price" => 530,
        "image" => "img/item6a.jpg",
        "image_hover" => "img/item6b.jpg",
        "description" => "A royal purple bowtie that adds a bold, distinguished flair to your ensemble."
    ],
    [
        "id" => 7,
        "name" => "Crimson Red Necktie",
        "price" => 600,
        "image" => "img/item7a.jpg",
        "image_hover" => "img/item7b.jpg",
        "description" => "A striking crimson red necktie that stands out and makes a statement."
    ],
    [
        "id" => 8,
        "name" => "Bold Navy Necktie",
        "price" => 650,
        "image" => "img/item8a.jpg",
        "image_hover" => "img/item8b.jpg",
        "description" => "A bold navy necktie that exudes confidence and style."
    ]
];

// Get item ID from URL
$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$item = null;

// Find item by ID
foreach ($items as $product) {
    if ($product['id'] === $item_id) {
        $item = $product;
        break;
    }
}

// Redirect if item not found
if (!$item) {
    header("Location: index.php");
    exit;
}

// Calculate total item count in the cart
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $cart_count += $cart_item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item['name']; ?> - Bowtie and Necktie Shop</title>
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

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-5 col-md-6 mb-4">
            <div class="product-image-wrapper">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid rounded shadow-sm">
                <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid rounded shadow-sm hover-image position-absolute top-0 start-0">
            </div>
        </div>
        <div class="col-lg-7 col-md-6">
            <h2 class="fw-bold"><?php echo $item['name']; ?></h2>
            <p class="text-muted fs-4">₱<?php echo number_format($item['price'], 2); ?></p>
            <p class="text-muted"><?php echo $item['description']; ?></p>

            <form action="confirm.php" method="POST" class="mt-4">
                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                <h5>Select Size:</h5>
                <div class="mb-3">
                    <?php foreach (['XS', 'S', 'M', 'L', 'XL'] as $size): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" value="<?php echo $size; ?>" id="size<?php echo $size; ?>" <?php echo $size === 'XS' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="size<?php echo $size; ?>"><?php echo $size; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h5>Enter Quantity:</h5>
                <input type="number" class="form-control w-50 mb-3" name="quantity" value="1" min="1" max="99">

                <button type="submit" class="btn btn-primary btn-lg w-100"><i class="bi bi-check-circle"></i> Confirm Product Purchase</button>
                <a href="index.php" class="btn btn-outline-secondary btn-lg w-100 mt-2"><i class="bi bi-arrow-left"></i> Cancel/Go Back</a>
            </form>
        </div>
    </div>
</div>

<style>
    .product-image-wrapper {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
    }

    .hover-image {
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .product-image-wrapper:hover .hover-image {
        opacity: 1;
    }

    .product-image-wrapper:hover img {
        opacity: 0;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
