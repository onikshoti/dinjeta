<?php
require_once '../../Controllers/ProductController.php';

$productController = new ProductController();
$products = $productController->listProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Product List</title>
</head>
<body>
    <div class="container">
        <h1>Product List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                        <td>
                            <a href="remove.php?id=<?php echo htmlspecialchars($product['id']); ?>">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add.php" class="btn">Add New Product</a>
    </div>
</body>
</html>