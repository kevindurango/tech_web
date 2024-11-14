<?php
session_start();
include '../web/db_connection.php';
include '../classes/Cart.php';

// Set header to indicate JSON response
header('Content-Type: application/json');

// Check if the POST request contains valid data
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Create a new instance of the Cart class
    $cart = new Cart($conn);

    // Update item quantity using the Cart class method
    $response = $cart->updateItemQuantity($productId, $quantity);

    // Return JSON response
    echo json_encode($response);
    exit;
} else {
    // If invalid request
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request or missing parameters.'
    ]);
    exit;
}
