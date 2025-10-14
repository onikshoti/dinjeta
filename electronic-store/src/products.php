<?php
// products.php

session_start();
require_once 'includes/functions.php';

// Initialize products in session if not set
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = getProducts();
}

// Handle add product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    if ($name && $price > 0) {
        $newId = count($_SESSION['products']) ? max(array_column($_SESSION['products'], 'id')) + 1 : 1;
        $_SESSION['products'][] = ['id' => $newId, 'name' => $name, 'price' => $price];
    }
}

// Handle remove product
if (isset($_GET['remove'])) {
    $removeId = intval($_GET['remove']);
    $_SESSION['products'] = array_filter($_SESSION['products'], function($p) use ($removeId) {
        return $p['id'] !== $removeId;
    });
}

$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Products - Electronic Store</title>
</head>
<body>
    <header>
        <h1>Available Electronic Devices</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="offers.php">Offers</a>
            <a href="cart.php">Shopping Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a>
            <a href="/wordpress/wp-content/themes/electronic-store/src/products.php">Products</a>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Add Product</h2>
            <form method="post" style="margin-bottom:2rem;">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" name="price" placeholder="Price" step="0.01" required>
                <button class="btn" type="submit" name="add">Add Product</button>
            </form>
        </section>
        <section class="product-list">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-item">
                        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                        <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                        <a class="btn" href="?remove=<?php echo $product['id']; ?>" onclick="return confirm('Remove this product?')">Remove</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products available at the moment.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Electronic Store</p>
    </footer>
</body>
</html>