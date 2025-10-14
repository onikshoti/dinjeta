<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemName = trim($_POST['item_name']);
    $itemPrice = trim($_POST['item_price']);
    $itemDescription = trim($_POST['item_description']);
    $itemImage = trim($_POST['item_image']);

    if (!empty($itemName) && !empty($itemPrice) && is_numeric($itemPrice) && !empty($itemDescription) && !empty($itemImage)) {
        $result = addItem($itemName, $itemPrice, $itemDescription, $itemImage);
        if ($result) {
            echo "Item added successfully!";
        } else {
            echo "Failed to add item. Please try again.";
        }
    } else {
        echo "Please fill in all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h1>Add New Electronic Item</h1>
    <form action="add_item.php" method="POST">
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required>

        <label for="item_price">Item Price:</label>
        <input type="text" id="item_price" name="item_price" required>

        <label for="item_description">Item Description:</label>
        <textarea id="item_description" name="item_description" required></textarea>

        <label for="item_image">Item Image URL:</label>
        <input type="text" id="item_image" name="item_image" required>

        <button type="submit">Add Item</button>
    </form>
    <a href="products.php">Back to Products</a>
</body>
</html>