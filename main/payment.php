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

// Handle form submission for shipping and payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture shipping information
    $deliveryMethod = $_POST['deliveryMethod'];
    $carrier = $_POST['carrier'] ?? null;
    $accountNumber = $_POST['accountNumber'] ?? null;
    $serviceType = $_POST['serviceType'] ?? null;

    // Capture payment information
    $cardType = $_POST['cardType'];
    $cardNumber = $_POST['cardNumber'];
    $expirationDate = $_POST['expirationDate'];
    $cvv = $_POST['cvv'];

    // Save shipping info in the `shipping_info` table
    $stmtShipping = $conn->prepare("
        INSERT INTO shipping_info (user_id, order_id, carrier, account_number, service_type, delivery_method)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $orderId = $cart->getOrderId(); // Implement a method in the `Cart` class to fetch the active order ID
    $stmtShipping->bind_param("iissss", $userId, $orderId, $carrier, $accountNumber, $serviceType, $deliveryMethod);
    $stmtShipping->execute();

    // Save payment info in the `payment_info` table
    $stmtPayment = $conn->prepare("
        INSERT INTO payment_info (user_id, card_type, card_number, expiration_date, cvv)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmtPayment->bind_param("issss", $userId, $cardType, $cardNumber, $expirationDate, $cvv);
    $stmtPayment->execute();

    // Redirect to the confirmation page
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

<main class="container my-5">
    <!-- Progress Bar -->
    <div class="progress-bar-custom mb-4">
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

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Order Confirmation Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Confirm Order</h4>
                </div>
                <div class="card-body">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="d-flex mb-3">
                            <img src="<?= htmlspecialchars($item['image'] ?? '/tech_web/assets/product.jpg') ?>" alt="Product Image" class="img-fluid" style="width: 100px; margin-right: 15px;">
                            <div>
                                <h6><?= htmlspecialchars($item['name']) ?></h6>
                                <p>Quantity: <?= $item['quantity'] ?></p>
                                <p class="text-muted">$<?= number_format($item['total'], 2) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Delivery Method Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Choose a delivery method</h4>
                </div>
                <div class="card-body">
                    <form id="shippingForm" action="payment.php" method="POST">
                        <div class="mb-3">
                            <input type="radio" id="shipAccount" name="deliveryMethod" value="Ship On Account" checked>
                            <label for="shipAccount" class="fw-bold">Ship On Account</label>
                            <div class="mt-2">
                                <select name="carrier" class="form-select mb-2">
                                    <option value="FEDEX">FEDEX</option>
                                    <option value="UPS">UPS</option>
                                </select>
                                <input type="text" name="accountNumber" class="form-control mb-2" placeholder="Account #">
                                <select name="serviceType" class="form-select">
                                    <option value="Standard Overnight">Standard Overnight</option>
                                    <option value="Priority Overnight">Priority Overnight</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" id="ground" name="deliveryMethod" value="Ground">
                            <label class="form-check-label" for="ground">Ground</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" id="standardOvernight" name="deliveryMethod" value="Standard Overnight">
                            <label class="form-check-label" for="standardOvernight">Standard Overnight</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" id="priorityOvernight" name="deliveryMethod" value="Priority Overnight">
                            <label class="form-check-label" for="priorityOvernight">Priority Overnight</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="twoDay" name="deliveryMethod" value="2 Day">
                            <label class="form-check-label" for="twoDay">2 Day</label>
                        </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="card">
                <div class="card-header">
                    <h4>Pay with</h4>
                </div>
                <div class="card-body">
                        <div class="mb-3">
                            <label for="cardType" class="form-label">Card Type</label>
                            <select id="cardType" name="cardType" class="form-select" required>
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
                        <!-- Buttons Row -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="cart.php" class="btn-continue-shopping w-25">Return to Cart</a>
                            <button type="submit" class="btn-next">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card">
                <div class="card-header">
                    <h4>Order Total</h4>
                </div>
                <div class="card-body">
                    <p>Delivery: <span class="float-end">$0.00</span></p>
                    <p>Subtotal: <span class="float-end">$<?= number_format($checkoutDetails['subtotal'], 2) ?></span></p>
                    <p>Taxes: <span class="float-end">$<?= number_format($checkoutDetails['taxes'], 2) ?></span></p>
                    <hr>
                    <p class="fw-bold">Total: <span class="float-end">$<?= number_format($checkoutDetails['total'], 2) ?></span></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
