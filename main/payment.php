<?php
session_start();
include '../web/db_connection.php';
include '../classes/cart.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$cart = new Cart($conn, $_SESSION['user_id'] ?? null);
$checkoutDetails = $cart->getCheckoutDetails();
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
            <div class="icon">2</div>
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
        <!-- Payment Form Section -->
        <div class="payment-form-section">
            <h3>Enter Your Payment Information</h3>
            <form action="confirm_order.php" method="POST">
                <div class="mb-3">
                    <label for="cardName" class="form-label">Cardholder's Name</label>
                    <input type="text" class="form-control" id="cardName" name="cardName" required>
                </div>
                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" maxlength="19" required>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="expiryDate" class="form-label">Expiry Date (MM/YY)</label>
                        <input type="text" class="form-control" id="expiryDate" name="expiryDate" maxlength="5" placeholder="MM/YY" required>
                    </div>
                    <div class="col">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" required>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="saveCard" name="saveCard">
                    <label class="form-check-label" for="saveCard">Save card for future purchases</label>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-back" onclick="history.back()">Back</button>
                    <button type="submit" class="btn-next">Confirm Payment</button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="checkout-summary">
            <h5>Order Summary</h5>
            <p>Subtotal: <span id="subtotal">$<?= number_format($checkoutDetails['subtotal'], 2) ?></span></p>
            <p>Taxes: <span id="taxes">$<?= number_format($checkoutDetails['taxes'], 2) ?></span></p>
            <div class="total-box mt-3 p-3 border-top">
                <strong>Total:</strong> <span id="total">$<?= number_format($checkoutDetails['total'], 2) ?></span>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
