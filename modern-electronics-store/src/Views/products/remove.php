<?php
require_once '../../Helpers/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];

    // Create a new database connection
    $db = new Database();
    $connection = $db->connect();

    // Prepare and execute the delete statement
    $stmt = $connection->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        $message = "Product removed successfully.";
    } else {
        $message = "Error removing product: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}

// Fetch products for the selection
$db = new Database();
$connection = $db->connect();
$result = $connection->query("SELECT id, name FROM products");
$products = $result->fetch_all(MYSQLI_ASSOC);
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Remove Product</title>
</head>
<body>
    <div class="container">
        <h1>Remove Product</h1>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST" action="remove.php">
            <label for="product_id">Select Product to Remove:</label>
            <select name="product_id" id="product_id" required>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Remove Product</button>
        </form>
    </div>
</body>
</html>