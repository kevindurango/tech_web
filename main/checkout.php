<?php
session_start();
include '../web/db_connection.php';
include '../classes/Cart.php'; // Include the Cart class

// Get user ID from session or set to null for guests
$userId = $_SESSION['user_id'] ?? null;

// Create Cart object
$cart = new Cart($conn, $userId);

// Fetch cart items and calculate totals
$cartItems = $cart->getCartItems();
$checkoutDetails = $cart->calculateTotals($cartItems);

// Insert checkout info into the database if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $street1 = $_POST['street1'];
    $street2 = $_POST['street2'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $sameAddress = isset($_POST['sameAddress']) ? 1 : 0;

    // Save checkout info in the database
    $cart->insertCheckoutInfo($name, $email, $phone, $street1, $street2, $city, $zip, $country, $state, $sameAddress);

    // Redirect to payment page after saving checkout info
    header("Location: payment.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
        <div class="step active">
            <div class="icon">✔</div>
            <div>Billing & Shipping</div>
        </div>
        <div class="step">
            <div class="icon">3</div>
            <div>Payment</div>
        </div>
        <div class="step">
            <div class="icon">4</div>
            <div>Confirmation</div>
        </div>
    </div>

    <div class="checkout-container d-flex justify-content-between">
        <!-- Billing and Shipping Form -->
        <div class="checkout-form-section">
            <h3>Fill in your address or <a href="login.php">Sign in</a></h3>
            <form action="checkout.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="street1" class="form-label">Street and Number</label>
                    <input type="text" class="form-control" id="street1" name="street1" required>
                </div>
                <div class="mb-3">
                    <label for="street2" class="form-label">Street 2</label>
                    <input type="text" class="form-control" id="street2" name="street2">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="col">
                        <label for="zip" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="United States">United States</option>
                            <option value="Canada">Canada</option>
                            <option value="Mexico">Mexico</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="state" class="form-label">State / Province</label>
                        <select class="form-select" id="state" name="state" required>
                            <option value="California">California</option>
                            <option value="New York">New York</option>
                            <option value="Texas">Texas</option>
                            <option value="Ontario">Ontario</option>
                            <option value="Quebec">Quebec</option>
                        </select>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="sameAddress" name="sameAddress" checked>
                    <label class="form-check-label" for="sameAddress">Ship to the same address</label>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-back" onclick="history.back()">Back</button>
                    <button type="submit" class="btn-next">Proceed to Payment</button>
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
            <a href="payment.php" class="btn btn-next-summary w-100 mt-3">Proceed to Payment</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
