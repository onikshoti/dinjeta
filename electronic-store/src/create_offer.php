<?php
// create_offer.php

require_once 'includes/db.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offer_name = $_POST['offer_name'];
    $discount_percentage = $_POST['discount_percentage'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if (createOffer($offer_name, $discount_percentage, $start_date, $end_date)) {
        echo "Offer created successfully!";
    } else {
        echo "Failed to create offer. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Offer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Create New Offer</h1>
    <form action="create_offer.php" method="POST">
        <label for="offer_name">Offer Name:</label>
        <input type="text" id="offer_name" name="offer_name" required>

        <label for="discount_percentage">Discount Percentage:</label>
        <input type="number" id="discount_percentage" name="discount_percentage" required min="1" max="100">

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <button type="submit">Create Offer</button>
    </form>
</body>
</html>