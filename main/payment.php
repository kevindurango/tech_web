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

// Fetch cart items for the user and calculate the totals
$cartItems = $cart->getCartItems();
$checkoutDetails = $cart->calculateTotals($cartItems);

// Insert payment data into the database if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get payment form data
    $cardType = $_POST['cardType'];
    $cardNumber = $_POST['cardNumber'];
    $expirationDate = $_POST['expirationDate'];
    $cvv = $_POST['cvv'];

    // Save payment details in the database using the Cart class method
    $cart->savePaymentInfo($cardType, $cardNumber, $expirationDate, $cvv);

    // Redirect to the confirmation page after successfully saving the payment info
    header("Location: confirmation.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/cart.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="container mb-5">
    <div class="progress-bar-custom">
        <div class="step completed">
            <div class="icon">1</div>
            <div>Review Order</div>
        </div>
        <div class="step completed">
            <div class="icon">✔</div>
            <div>Billing & Shipping</div>
        </div>
        <div class="step active">
            <div class="icon">✔</div>
            <div>Payment</div>
        </div>
        <div class="step">
            <div class="icon">4</div>
            <div>Confirmation</div>
        </div>
    </div>

    <div class="checkout-container d-flex justify-content-between">
        <!-- Payment Form -->
        <div class="checkout-form-section">
            <h3>Enter Payment Details</h3>
            <form action="payment.php" method="POST">
                <div class="mb-3">
                    <label for="cardType" class="form-label">Card Type</label>
                    <select class="form-select" id="cardType" name="cardType" required>
                        <option value="Visa">Visa</option>
                        <option value="MasterCard">MasterCard</option>
                        <option value="American Express">American Express</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="expirationDate" class="form-label">Expiration Date</label>
                        <input type="text" class="form-control" id="expirationDate" name="expirationDate" placeholder="MM/YY" required>
                    </div>
                    <div class="col">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-back" onclick="history.back()">Back</button>
                    <button type="submit" class="btn-next">Proceed to Confirmation</button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="checkout-summary">
            <h5>Order Total</h5>
            <p>Subtotal: <span id="subtotal">$<?= number_format($checkoutDetails['subtotal'], 2) ?></span></p>
            <p>Taxes: <span id="taxes">$<?= number_format($checkoutDetails['taxes'], 2) ?></span></p>
            <div class="total-box mt-3 p-3 border-top">
                <strong>Total:</strong> <span id="total">$<?= number_format($checkoutDetails['total'], 2) ?></span>
            </div>
            <a href="payment.php" class="btn btn-next-summary w-100 mt-3">Proceed to Confirmation</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
