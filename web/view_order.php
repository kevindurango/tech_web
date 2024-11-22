<?php
session_start();
include '../web/db_connection.php';
include '../classes/Order.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

try {
    $orderId = intval($_GET['id'] ?? 0);
    $userId = $_SESSION['user_id'];

    if ($orderId === 0) {
        throw new Exception("Invalid order ID.");
    }

    $order = new Order($conn);

    // Fetch order details, items, and payment information
    $orderDetails = $order->getOrderById($orderId, $userId);
    if (!$orderDetails) {
        throw new Exception("Order not found.");
    }

    $orderItems = $order->getOrderItems($orderId);
    $paymentDetails = $order->getPaymentDetails($userId);

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        .order-summary, .payment-summary {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 15px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .total-box {
            font-size: 1.25rem;
            font-weight: bold;
            color: #dc3545;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Order Details</h2>
    
    <!-- Order Summary -->
    <div class="order-summary">
        <h4 class="section-title">Order Summary</h4>
        <p><strong>Order ID:</strong> <?= htmlspecialchars($orderDetails['order_id']); ?></p>
        <p><strong>Order Date:</strong> <?= htmlspecialchars($orderDetails['order_date']); ?></p>
        <p><strong>Customer Name:</strong> <?= htmlspecialchars($orderDetails['customer_name']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($orderDetails['customer_email']); ?></p>
        <p><strong>Order Status:</strong> <?= ucfirst(htmlspecialchars($orderDetails['order_status'])); ?></p>
    </div>

    <!-- Order Items -->
    <div class="order-summary">
        <h4 class="section-title">Items Purchased</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']); ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>$<?= number_format($item['price'], 2); ?></td>
                        <td>$<?= number_format($item['quantity'] * $item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="total-box">Order Total: $<?= number_format($orderDetails['total_amount'], 2); ?></p>
    </div>

    <!-- Payment Details -->
    <div class="payment-summary">
        <h4 class="section-title">Payment Information</h4>
        <p><strong>Card Type:</strong> <?= htmlspecialchars($paymentDetails['card_type']); ?></p>
        <p><strong>Card Number:</strong> <?= '**** **** **** ' . substr($paymentDetails['card_number'], -4); ?></p>
        <p><strong>Expiration Date:</strong> <?= htmlspecialchars($paymentDetails['expiration_date']); ?></p>
    </div>

    <!-- Back Button -->
    <a href="sales_orders.php" class="btn btn-secondary">Back to Orders</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
