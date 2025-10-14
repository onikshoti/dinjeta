<?php
// change_price.php

require_once 'includes/db.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $newPrice = $_POST['new_price'];

    if (updateProductPrice($productId, $newPrice)) {
        echo "Price updated successfully.";
    } else {
        echo "Failed to update price. Please try again.";
    }
}

$products = getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Price</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h1>Change Product Price</h1>
    <form action="change_price.php" method="POST">
        <label for="product_id">Select Product:</label>
        <select name="product_id" id="product_id" required>
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?> - $<?php echo $product['price']; ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="new_price">New Price:</label>
        <input type="number" name="new_price" id="new_price" step="0.01" required>
        
        <button type="submit">Update Price</button>
    </form>
</body>
</html>