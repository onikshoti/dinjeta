<?php
session_start();
include 'includes/functions.php';

$products = getProducts();
$offers = getCurrentOffers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Store</title>
    <link rel="stylesheet" href="/wordpress/wp-content/themes/electronic-store/style.css">
</head>
<body>
    <header>
        <h1>Welcome to the Electronic Store</h1>
        <nav>
            <ul>
                <li><a href="/wordpress/wp-content/themes/electronic-store/src/products.php">Products</a></li>
                <li><a href="/wordpress/wp-content/themes/electronic-store/src/offers.php">Offers</a></li>
                <li><a href="/wordpress/wp-content/themes/electronic-store/src/cart.php">Shopping Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <main>
            <section>
                <h2>Featured Products</h2>
                <div class="product-list">
                    <?php foreach ($products as $product): ?>
                        <div class="product-item">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                            <a class="btn" href="add_item.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section>
                <h2>Current Offers</h2>
                <div class="offer-list">
                    <?php foreach ($offers as $offer): ?>
                        <div class="offer-item">
                            <h3><?php echo htmlspecialchars($offer['title']); ?></h3>
                            <p>Discount: <?php echo htmlspecialchars($offer['discount']); ?>%</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Electronic Store. All rights reserved.</p>
    </footer>
</body>
</html>