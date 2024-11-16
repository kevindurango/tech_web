<?php
session_start();
include '../web/db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to add items to the cart.']);
    exit;
}

$userId = $_SESSION['user_id'];
$productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

// Ensure the product ID and quantity are valid
if ($productId <= 0 || $quantity <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product or quantity.']);
    exit;
}

// Check if the user has a cart; if not, create one
$stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$cart = $result->fetch_assoc();

if ($cart) {
    $cartId = $cart['id'];
} else {
    // Create a new cart for the user
    $stmt = $conn->prepare("INSERT INTO cart (user_id) VALUES (?)");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $cartId = $conn->insert_id;
}

// Check if the product is already in the cart
$stmt = $conn->prepare("SELECT id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ?");
$stmt->bind_param("ii", $cartId, $productId);
$stmt->execute();
$result = $stmt->get_result();
$cartItem = $result->fetch_assoc();

if ($cartItem) {
    // Update quantity if the item already exists in the cart
    $newQuantity = $cartItem['quantity'] + $quantity;
    $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
    $stmt->bind_param("ii", $newQuantity, $cartItem['id']);
    $stmt->execute();
} else {
    // Insert a new item if it doesn’t exist in the cart
    $stmt = $conn->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $cartId, $productId, $quantity);
    $stmt->execute();
}

echo json_encode(['success' => true, 'message' => 'Product added to cart']);
exit;
