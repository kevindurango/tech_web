<?php
session_start();
include '../web/db_connection.php';

// Check if the cart session exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php'); // Redirect to cart if empty
    exit();
}

// Function to fetch product details by ID
function getProductDetails($productId, $conn) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Fetch product details for all items in the cart
$cartItems = [];
$totalPrice = 0;

foreach ($_SESSION['cart'] as $productId => $quantity) {
    $product = getProductDetails($productId, $conn);
    if ($product) {
        $product['quantity'] = $quantity; // Add quantity to product details
        $totalPrice += $product['price'] * $quantity; // Calculate total price
        $cartItems[] = $product; // Add product to cart items
    }
}

// Process form submission for billing details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Here you would process the billing information and finalize the order
    // For demonstration purposes, we’ll just redirect to a confirmation page
    // Store billing information in session or database as needed

    header('Location: order_confirmation.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <div class="container mt-4">
        <h2 class="fw-bold">Checkout</h2>
        <div class="row">
            <div class="col-md-8">
                <h3 class="fw-bold">Billing Information</h3>
                <form action="checkout.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-success">Place Order</button>
                </form>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Order Summary</h3>
                        <hr>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($cartItems as $item): ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><?= htmlspecialchars($item['name']); ?> (<?= $item['quantity']; ?>)</span>
                                    <span><?= number_format($item['price'] * $item['quantity'], 2) ?> €</span>
                                </li>
                            <?php endforeach; ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong><?= number_format($totalPrice, 2) ?> €</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
