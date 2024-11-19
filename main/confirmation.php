<?php
session_start();
include '../web/db_connection.php';
include '../classes/Cart.php'; // Include the Cart class

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id']; // Get the logged-in user ID

// Create Cart object
$cart = new Cart($conn, $userId);

// Fetch cart items for the user
$cartItems = $cart->getCartItems();

// Calculate the totals for the cart
$checkoutDetails = $cart->calculateTotals($cartItems);

// Fetch checkout info and payment details
$checkoutInfo = $cart->getCheckoutInfo();
$paymentDetails = $cart->getPaymentDetails();

// Clear the cart after confirmation
$cart->clearCart();

// Function to format the card number to show only the last 4 digits
function formatCardNumber($cardNumber) {
    return '**** **** **** ' . substr($cardNumber, -4);
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
        // Function to trigger the print dialog
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">
    <div class="confirmation-container">
        <div class="confirmation-header">
            <h2>Thank you for your order!</h2>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h5>Order Summary</h5>
            <p><strong>Subtotal:</strong> $<?= number_format($checkoutDetails['subtotal'], 2) ?></p>
            <p><strong>Taxes:</strong> $<?= number_format($checkoutDetails['taxes'], 2) ?></p>
            <div class="total-box">
                <p><strong>Total:</strong> $<?= number_format($checkoutDetails['total'], 2) ?></p>
            </div>
        </div>

        <!-- Cart Items -->
        <div class="cart-items">
            <h5>Items Purchased</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>$<?= number_format($item['total'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Payment Summary -->
        <div class="payment-summary">
            <h5>Payment Information</h5>
            <p><strong>Card Type:</strong> <?= htmlspecialchars($paymentDetails['card_type']) ?></p>
            <p><strong>Card Number:</strong> <?= formatCardNumber($paymentDetails['card_number']) ?></p>
            <p><strong>Expiration Date:</strong> <?= htmlspecialchars($paymentDetails['expiration_date']) ?></p>
        </div>

        <div class="button-container">
            <!-- Continue Shopping -->
            <a href="category_page.php" class="btn-continue-shopping">Continue Shopping</a>

            <!-- Print Button -->
            <button class="btn-print" onclick="printPage()">Print Confirmation</button>
        </div>

    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
