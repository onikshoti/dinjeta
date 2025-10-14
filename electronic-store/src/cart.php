<?php
session_start();

// Initialize the shopping cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to add an item to the cart
function addToCart($productId, $quantity) {
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

// Function to remove an item from the cart
function removeFromCart($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

// Function to get the total price of items in the cart
function getTotalPrice($products) {
    $total = 0;
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        if (isset($products[$productId])) {
            $total += $products[$productId]['price'] * $quantity;
        }
    }
    return $total;
}

// Load products from the database or a predefined array
$products = []; // This should be populated from the database or products.php

// Handle adding items to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    addToCart($productId, $quantity);
}

// Handle removing items from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];
    removeFromCart($productId);
}

// Calculate total price
$totalPrice = getTotalPrice($products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $productId => $quantity): ?>
                <tr>
                    <td><?php echo htmlspecialchars($productId); ?></td>
                    <td><?php echo htmlspecialchars($quantity); ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($productId); ?>">
                            <button type="submit" name="remove_from_cart">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Total Price: $<?php echo number_format($totalPrice, 2); ?></h2>
    <button onclick="window.location.href='index.php'">Continue Shopping</button>
    <button onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
</body>
</html>