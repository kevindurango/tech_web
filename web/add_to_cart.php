<?php
session_start();
include 'db_connection.php';
include '../classes/cart.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];
$cart = new Cart($conn, $userId);

if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $cart->addProduct($productId, $quantity);

    echo json_encode(['success' => true, 'message' => 'Product added to cart.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Product ID not provided.']);
}
?>

