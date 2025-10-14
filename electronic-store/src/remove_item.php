<?php
session_start();
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_POST['remove_item'])) {
    $item_id = $_POST['item_id'];
    
    // Remove item from the cart
    if (isset($_SESSION['cart'][$item_id])) {
        unset($_SESSION['cart'][$item_id]);
        echo "Item removed from cart.";
    } else {
        echo "Item not found in cart.";
    }

    // Optionally, remove item from the product list if needed
    // Uncomment the following lines if you want to remove from products as well
    /*
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $item_id);
    if ($stmt->execute()) {
        echo "Item removed from product list.";
    } else {
        echo "Error removing item from product list.";
    }
    */
}
?>