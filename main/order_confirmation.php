<?php
session_start();
include '../web/db_connection.php';

// Check if an order ID is provided in the URL
if (!isset($_GET['order_id'])) {
    header("Location: index.php"); // Redirect to homepage if no order ID
    exit;
}

$orderId = intval($_GET['order_id']);

// Fetch order details from the database
$stmt = $conn->prepare("
    SELECT o.id AS order_id, o.order_date, o.total_price, o.status,
           u.first_name, u.last_name, u.email
    FROM orders o
    JOIN users u ON o.user_id = u.id
    WHERE o.id = ?
    LIMIT 1
");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

// Check if the order exists
if (!$order) {
    echo "<p>Order not found. Please contact customer support.</p>";
    exit;
}

// Debug output to confirm $orderId
echo "<p>Debug: Order ID is " . htmlspecialchars($orderId) . "</p>";

// Fetch order items
$stmt = $conn->prepare("
    SELECT p.name, p.price, oi.quantity
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$orderItems = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/cart.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-4">Thank You for Your Order!</h1>
        <p>Your order has been successfully placed. A confirmation email has been sent to <?= htmlspecialchars($order['email']) ?>.</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Order Summary (Order #<?= htmlspecialchars($order['order_id']) ?>)</h2>
            <p>Order Date: <?= date('F j, Y', strtotime($order['order_date'])) ?></p>
        </div>
        <div class="card-body">
            <h5>Customer Information</h5>
            <p>Name: <?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></p>
            <p>Email: <?= htmlspecialchars($order['email']) ?></p>
            
            <h5 class="mt-4">Order Items</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($orderItems->num_rows > 0): ?>
                        <?php while ($item = $orderItems->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No items found for this order. Please contact support if you believe this is an error.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h5 class="mt-4">Order Total</h5>
            <p><strong>Total: $<?= number_format($order['total_price'], 2) ?></strong></p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
