<?php
// offers.php
include 'includes/functions.php';
$offers = getCurrentOffers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Offers</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>Current Offers on Electronic Devices</h1>
         <nav>
            <ul>
                <li><a href="/wordpress/wp-content/themes/electronic-store/src/products.php">Products</a></li>
                <li><a href="/wordpress/wp-content/themes/electronic-store/src/offers.php">Offers</a></li>
                <li><a href="/wordpress/wp-content/themes/electronic-store/src/cart.php">Shopping Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php if (!empty($offers)): ?>
            <ul class="offer-list">
                <?php foreach ($offers as $offer): ?>
                    <li class="offer-item">
                        <h2><?php echo htmlspecialchars($offer['title']); ?></h2>
                        <?php if (!empty($offer['description'])): ?>
                            <p><?php echo htmlspecialchars($offer['description']); ?></p>
                        <?php endif; ?>
                        <p>Discount: <?php echo htmlspecialchars($offer['discount']); ?>%</p>
                        <?php if (!empty($offer['valid_until'])): ?>
                            <p>Valid until: <?php echo htmlspecialchars($offer['valid_until']); ?></p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No offers available at the moment.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Electronic Store</p>
    </footer>
</body>
</html>