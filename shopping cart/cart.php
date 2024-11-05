<?php
session_start();
include 'cartFunction.php'; 

// Item array with updated format
$item1 = [
    "id" => 1,
    "name" => "Classic White Bowtie",
    "price" => 550,
    "image" => "img/item1a.jpg",
    "image_hover" => "img/item1b.jpg"
];

$item2 = [
    "id" => 2,
    "name" => "Elegant Silver Bowtie",
    "price" => 500,
    "image" => "img/item2a.jpg",
    "image_hover" => "img/item2b.jpg"
];

$item3 = [
    "id" => 3,
    "name" => "Striped Charcoal Bowtie",
    "price" => 470,
    "image" => "img/item3a.jpg",
    "image_hover" => "img/item3b.jpg"
];

$item4 = [
    "id" => 4,
    "name" => "Matte Gray Necktie",
    "price" => 550,
    "image" => "img/item4a.jpg",
    "image_hover" => "img/item4b.jpg"
];

$item5 = [
    "id" => 5,
    "name" => "Sleek Black Necktie",
    "price" => 480,
    "image" => "img/item5a.jpg",
    "image_hover" => "img/item5b.jpg"
];

$item6 = [
    "id" => 6,
    "name" => "Royal Purple Bowtie",
    "price" => 530,
    "image" => "img/item6a.jpg",
    "image_hover" => "img/item6b.jpg"
];

$item7 = [
    "id" => 7,
    "name" => "Crimson Red Necktie",
    "price" => 600,
    "image" => "img/item7a.jpg",
    "image_hover" => "img/item7b.jpg"
];

$item8 = [
    "id" => 8,
    "name" => "Bold Navy Necktie",
    "price" => 650,
    "image" => "img/item8a.jpg",
    "image_hover" => "img/item8b.jpg"
];

// Array of items
$itemCollection = [$item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8];

// Process form submission for quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                $cart_item['quantity'] = min(max(1, (int)$quantity), 99);
            }
        }
    }
    header("Location: cart.php");
    exit;
}

// Calculate total cart value and item count
$total_price = 0;
$total_quantity = 0;

foreach ($_SESSION['cart'] as $cart_item) {
    foreach ($itemCollection as $item) {
        if ($item['id'] === $cart_item['id']) {
            $total_price += $cart_item['quantity'] * $item['price'];
            break;
        }
    }
    $total_quantity += $cart_item['quantity'];
}

$cart_count = $total_quantity;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Bowtie & Necktie Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
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

    <div class="container">
        <h2 class="mb-4">Your Shopping Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-emoji-frown fs-3"></i><br>
                Your cart is currently empty.
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary btn-lg mt-3"><i class="bi bi-arrow-left-circle"></i> Continue Shopping</a>
            </div>
        <?php else: ?>
            <form action="cart.php" method="POST">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                                <?php
                                    $item_details = null;
                                    foreach ($itemCollection as $item) {
                                        if ($item['id'] === $cart_item['id']) {
                                            $item_details = $item;
                                            break;
                                        }
                                    }
                                    if ($item_details):
                                        $item_total = $item_details['price'] * $cart_item['quantity'];
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo $item_details['image']; ?>" alt="<?php echo htmlspecialchars($item_details['name']); ?>" class="me-3 rounded" style="width: 60px; height: auto;">
                                            <div>
                                                <strong><?php echo htmlspecialchars($item_details['name']); ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo isset($cart_item['size']) ? htmlspecialchars($cart_item['size']) : 'N/A'; ?></td>
                                    <td class="text-center">
                                        <input type="number" name="quantity[<?php echo $cart_item['id']; ?>]" value="<?php echo $cart_item['quantity']; ?>" min="1" max="99" class="form-control w-50 mx-auto">
                                    </td>
                                    <td>₱<?php echo number_format($item_details['price'], 2); ?></td>
                                    <td>₱<?php echo number_format($item_total, 2); ?></td>
                                    <td class="text-center">
                                        <a href="remove.php?product_id=<?php echo $cart_item['id']; ?>" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> Remove
                                        </a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr class="table-light">
                                <td colspan="4" class="text-end fw-bold">Total</td>
                                <td colspan="2" class="fw-bold">₱<?php echo number_format($total_price, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="index.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left-circle"></i> Continue Shopping</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update Cart</button>
                    <a href="success-checkout.php" class="btn btn-primary"><i class="bi bi-credit-card"></i> Proceed to Checkout</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
