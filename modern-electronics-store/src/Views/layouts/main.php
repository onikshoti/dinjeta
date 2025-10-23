<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Modern Electronics Store</title>
</head>
<body>
    <header>
        <h1>Welcome to the Modern Electronics Store</h1>
        <nav>
            <ul>
                <li><a href="/products/list.php">Product List</a></li>
                <li><a href="/products/add.php">Add Product</a></li>
                <li><a href="/products/remove.php">Remove Product</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php include($view); ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Modern Electronics Store. All rights reserved.</p>
    </footer>
</body>
</html>