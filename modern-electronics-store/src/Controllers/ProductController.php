<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function listProducts()
    {
        $products = Product::all();
        include '../src/Views/products/list.php';
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            Product::create($name, $price, $description);
            header('Location: /products');
        } else {
            include '../src/Views/products/add.php';
        }
    }

    public function removeProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            Product::delete($id);
            header('Location: /products');
        } else {
            $products = Product::all();
            include '../src/Views/products/remove.php';
        }
    }
}