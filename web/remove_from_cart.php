<?php
session_start();
include '../web/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Get product_id from the URL
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

// Check if the product exists in the cart session
if (isset($_SESSION['cart'][$product_id])) {
    // Remove the product from the cart
    unset($_SESSION['cart'][$product_id]);
}

// Redirect back to the cart page
header("Location:../main/cart.php");
exit;
?>
