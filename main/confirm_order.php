<?php
session_start();
include '../web/db_connection.php';
include '../classes/cart.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$cart = new Cart($conn, $_SESSION['user_id']);
$checkoutDetails = $cart->getCheckoutDetails();

// Assuming $shippingAddress and $billingAddress are retrieved from session or post request.
$shippingAddress = $_POST['shipping_address'] ?? 'Default Shipping Address';
$billingAddress = $_POST['billing_address'] ?? 'Default Billing Address';

if ($checkoutDetails['total'] > 0) {
    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into orders
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status, shipping_address, billing_address, payment_status) VALUES (?, ?, 'pending', ?, ?, 'unpaid')");
        $stmt->bind_param("idss", $_SESSION['user_id'], $checkoutDetails['total'], $shippingAddress, $billingAddress);
        $stmt->execute();
        $orderId = $stmt->insert_id;

        // Insert into order_items
        foreach ($checkoutDetails['items'] as $item) {
            if (!isset($item['id']) || empty($item['id'])) {
                throw new Exception("Invalid product ID in order items.");
            }
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $orderId, $item['id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        // Commit transaction
        $conn->commit();

        // Clear cart
        $cart->clearCart();

        // Redirect to confirmation page
        header("Location: order_confirmation.php?order_id=" . $orderId);
        exit;

    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Order failed: " . $e->getMessage();
    }
} else {
    echo "Cart is empty or total is zero.";
}
?>
