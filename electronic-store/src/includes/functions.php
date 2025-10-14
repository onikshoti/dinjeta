<?php
// This file contains various utility functions used throughout the application

// Demo data for products and offers
$demo_products = [
    ['id' => 1, 'name' => 'Smartphone', 'price' => 299],
    ['id' => 2, 'name' => 'Laptop', 'price' => 799],
    ['id' => 3, 'name' => 'Wireless Headphones', 'price' => 99],
    ['id' => 4, 'name' => 'Smartwatch', 'price' => 149]
];

$demo_offers = [
    ['title' => 'Summer Sale', 'discount' => 15],
    ['title' => 'Buy 1 Get 1 Free', 'discount' => 50]
];

// Cart logic using session
function addItemToCart($itemId, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId] += $quantity;
    } else {
        $_SESSION['cart'][$itemId] = $quantity;
    }
}

function removeItemFromCart($itemId) {
    if (isset($_SESSION['cart'][$itemId])) {
        unset($_SESSION['cart'][$itemId]);
    }
}

function changeItemPrice($itemId, $newPrice) {
    global $demo_products;
    foreach ($demo_products as &$product) {
        if ($product['id'] == $itemId) {
            $product['price'] = $newPrice;
            break;
        }
    }
}

function createNewOffer($offerDetails) {
    global $demo_offers;
    $demo_offers[] = $offerDetails;
}

function fetchProductDetails($productId) {
    global $demo_products;
    foreach ($demo_products as $product) {
        if ($product['id'] == $productId) {
            return $product;
        }
    }
    return null;
}

function fetchAllProducts() {
    global $demo_products;
    return $demo_products;
}

function fetchCurrentOffers() {
    global $demo_offers;
    return $demo_offers;
}

// For compatibility with your index.php
function getProducts() {
    return fetchAllProducts();
}

function getCurrentOffers() {
    return fetchCurrentOffers();
}
?>