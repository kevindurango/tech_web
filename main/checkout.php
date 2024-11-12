<?php
session_start();
include '../web/db_connection.php';

// Function to fetch product details and price
function getProductDetails($productId, $conn) {
    $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Calculate the total dynamically based on items in the cart
$totalPrice = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $product = getProductDetails($productId, $conn);
        if ($product) {
            $totalPrice += $product['price'] * $quantity;
        }
    }
}

$taxes = 0.00; // Set taxes if needed
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
            <form action="payment.php" method="POST">
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
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+1" required>
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
                        </select>
                    </div>
                    <div class="col">
                        <label for="state" class="form-label">State / Province</label>
                        <select class="form-select" id="state" name="state" required>
                            <option value="Armed Forces Americas">Armed Forces Americas</option>
                        </select>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="sameAddress" name="sameAddress" checked>
                    <label for="sameAddress" class="form-check-label">Ship to the same address</label>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-back" onclick="history.back()">Back</button>
                    <button type="submit" class="btn-next">Next</button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="checkout-summary">
            <h5>Order Total</h5>
            <p>Subtotal: <span id="subtotal">$<?= number_format($totalPrice, 2) ?></span></p>
            <p>Taxes: <span id="taxes">$<?= number_format($taxes, 2) ?></span></p>
            <div class="total-box mt-3 p-3 border-top">
                <strong>Total:</strong> <span id="total">$<?= number_format($totalPrice + $taxes, 2) ?></span>
            </div>
            <a href="checkout.php" class="btn btn-next-summary w-100 mt-3">Proceed to Checkout</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
