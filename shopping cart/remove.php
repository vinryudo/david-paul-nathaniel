<?php
session_start();
include 'cartFunction.php'; 
$cart_count = get_cart_count();

$item_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : null;
$item = null;

if ($item_id && isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] == $item_id) {
            $item = $cart_item;
            break;
        }
    }
}

if (!$item) {
    header("Location: cart.php");
    exit;
}

// Array declaration for items following the same format as cart.php
$items = [
    $item1 = [
        "id" => 1,
        "name" => "Classic White Bowtie",
        "price" => 550,
        "image" => "../img/item1a.jpg",
        "image_hover" => "../img/item1b.jpg",
        "description" => "A timeless white bowtie perfect for formal events."
    ],
    $item2 = [
        "id" => 2,
        "name" => "Elegant Silver Bowtie",
        "price" => 500,
        "image" => "../img/item2a.jpg",
        "image_hover" => "../img/item2b.jpg",
        "description" => "Add sophistication with this elegant silver bowtie."
    ],
    $item3 = [
        "id" => 3,
        "name" => "Striped Charcoal Bowtie",
        "price" => 470,
        "image" => "../img/item3a.jpg",
        "image_hover" => "../img/item3b.jpg",
        "description" => "A stylish striped charcoal bowtie for any occasion."
    ],
    $item4 = [
        "id" => 4,
        "name" => "Matte Gray Necktie",
        "price" => 550,
        "image" => "../img/item4a.jpg",
        "image_hover" => "../img/item4b.jpg",
        "description" => "A sleek matte gray necktie to elevate your look."
    ],
    $item5 = [
        "id" => 5,
        "name" => "Sleek Black Necktie",
        "price" => 480,
        "image" => "../img/item5a.jpg",
        "image_hover" => "../img/item5b.jpg",
        "description" => "A classic black necktie for formal attire."
    ],
    $item6 = [
        "id" => 6,
        "name" => "Royal Purple Bowtie",
        "price" => 530,
        "image" => "../img/item6a.jpg",
        "image_hover" => "../img/item6b.jpg",
        "description" => "A bold royal purple bowtie that stands out."
    ],
    $item7 = [
        "id" => 7,
        "name" => "Crimson Red Necktie",
        "price" => 600,
        "image" => "../img/item7a.jpg",
        "image_hover" => "../img/item7b.jpg",
        "description" => "A striking crimson red necktie to make a statement."
    ],
    $item8 = [
        "id" => 8,
        "name" => "Bold Navy Necktie",
        "price" => 650,
        "image" => "../img/item8a.jpg",
        "image_hover" => "../img/item8b.jpg",
        "description" => "A bold navy necktie for a confident look."
    ]
];

// Function to get item details
function getItemDetails($id, $items) {
    foreach ($items as $item) {
        if ($item['id'] == $id) {
            return $item;
        }
    }
    return null;
}

$product_details = getItemDetails($item_id, $items);

if (!$product_details) {
    echo "<div class='alert alert-danger'>Product details not found. Please go back and try again.</div>";
    exit;
}

// Remove item from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $item_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
    header("Location: cart.php?message=Item successfully removed.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Confirmation - Bowtie & Necktie Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3 shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Bowtie & Necktie Shop</h1>
            <a href="cart.php" class="btn btn-outline-light position-relative">
                <i class="bi bi-cart"></i> Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                    <?php echo $cart_count; ?>
                </span>
            </a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($product_details['image']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?>" class="img-fluid normal-image">
                            <img src="<?php echo htmlspecialchars($product_details['image_hover']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?> (hover)" class="img-fluid hover-image position-absolute top-0 start-0">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3><?php echo htmlspecialchars($product_details['name']); ?> <span class="badge bg-warning">₱<?php echo number_format($product_details['price'], 2); ?></span></h3>
                        <p class="mt-3"><?php echo htmlspecialchars($product_details['description']); ?></p>
                        <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size']); ?></p>
                        <p><strong>Quantity:</strong> <?php echo (int)$item['quantity']; ?></p>
                        <div class="mt-4">
                            <form method="POST">
                                <button type="submit" class="btn btn-dark me-2">
                                    <i class="bi bi-trash"></i> Confirm Product Removal
                                </button><br><br>
                            </form>
                            <a href="cart.php" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Cancel/Go Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
