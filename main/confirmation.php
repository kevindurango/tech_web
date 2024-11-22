<?php
session_start();
include '../web/db_connection.php';
include '../classes/Cart.php';
include '../classes/Order.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

try {
    $userId = $_SESSION['user_id']; 

    // Initialize Cart and Order objects
    $cart = new Cart($conn, $userId);
    $order = new Order($conn);

    // Fetch cart items and calculate totals
    $cartItems = $cart->getCartItems();
    $checkoutDetails = $cart->calculateTotals($cartItems);

    // Create order and fetch its details
    $orderId = $order->createOrder($userId, $cartItems, $checkoutDetails['total']);
    $orderDetails = $order->getOrderDetails($orderId, $userId);
    $orderItems = $order->getOrderItems($orderId);

    // Fetch payment details and clear cart
    $paymentDetails = $order->getPaymentDetails($userId);
    $cart->clearCart();

    // Format card number
    function formatCardNumber($cardNumber)
    {
        return '**** **** **** ' . substr($cardNumber, -4);
    }
} catch (Exception $e) {
    die("An error occurred while processing your request. Please try again later.");
}
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
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
<?php include 'header.php'; ?>
<main class="container my-5">
    <div class="confirmation-container">
        <div class="text-center mb-4">
            <h2 class="text-danger">Thank You for Your Order!</h2>
            <p class="lead text-muted">Your order has been successfully processed. We appreciate your trust in us!</p>
            <p>Order ID: <strong>#<?= htmlspecialchars($orderDetails['id']) ?></strong></p>
            <p>Order Date: <strong><?= htmlspecialchars($orderDetails['created_at']) ?></strong></p>
        </div>

        <section class="summary">
            <div class="section-title"><i class="bi bi-receipt"></i> Order Summary</div>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Subtotal:</strong> $<?= number_format($checkoutDetails['subtotal'], 2) ?></p>
                    <p><strong>Taxes:</strong> $<?= number_format($checkoutDetails['taxes'], 2) ?></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="confirmation-total-box">Total: $<?= number_format($checkoutDetails['total'], 2) ?></div>
                </div>
            </div>
        </section>

        <section class="cart-items">
            <div class="section-title"><i class="bi bi-bag-check"></i> Items Purchased</div>
            <table class="table table-striped table-bordered">
                <thead class="table-danger">
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
                           <td><?= htmlspecialchars($item['product_name']) ?></td>
                           <td><?= $item['quantity'] ?></td>
                           <td>$<?= number_format($item['price'], 2) ?></td>
                           <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
        </section>

        <section class="payment-summary">
            <div class="section-title"><i class="bi bi-credit-card-2-back"></i> Payment Information</div>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Card Type:</strong> <?= htmlspecialchars($paymentDetails['card_type']) ?></p>
                    <p><strong>Card Number:</strong> <?= formatCardNumber($paymentDetails['card_number']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Expiration Date:</strong> <?= htmlspecialchars($paymentDetails['expiration_date']) ?></p>
                </div>
            </div>
        </section>

        <div class="button-container d-flex justify-content-between mt-4">
            <a href="category_page.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle"></i> Continue Shopping</a>
            <button class="btn btn-danger" onclick="printPage()"><i class="bi bi-printer"></i> Print Confirmation</button>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
