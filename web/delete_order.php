<?php
session_start();
include '../web/db_connection.php';
include '../classes/Order.php';

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validate and sanitize the 'id' parameter
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $orderId = intval($_GET['id']); // Sanitize input
} else {
    header("Location: orders.php?error=Invalid order ID.");
    exit;
}

try {
    $order = new Order($conn);
    $order->deleteOrder($orderId);

    // Redirect back to the orders page with a success message
    header("Location: sales_orders.php?message=Order deleted successfully");
    exit;
} catch (Exception $e) {
    // Redirect back to the orders page with an error message
    header("Location: sales_orders.php?error=" . urlencode($e->getMessage()));
    exit;
}
?>
