<?php
session_start();
include '../web/db_connection.php';

// Check if the cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
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
        $product['quantity'] = $quantity;
        $totalPrice += $product['price'] * $quantity;
        $cartItems[] = $product;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/cart.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">
    <!-- Progress Bar -->
    <div class="progress-bar-custom">
        <div class="step completed">
            <div class="icon">✔</div>
            <div>Review Order</div>
        </div>
        <div class="step active">
            <div class="icon">2</div>
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

    <!-- Cart and Order Summary Layout -->
    <div class="cart-container">
        <!-- Shopping Cart Section -->
        <div class="cart-table mb-4">
            <h3 class="p-3">Shopping Cart</h3>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars($item['main_image'] ?? '/tech_web/assets/placeholder.png') ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?>" width="60">
                                <?= htmlspecialchars($item['name']) ?>
                                <br><a href="remove_from_cart.php?product_id=<?= $item['id'] ?>" class="text-danger">Remove</a>
                            </td>
                            <td class="text-center">
                                <div class="quantity-control">
                                    <button type="button" class="btn-icon" onclick="changeQuantity(this, <?= $item['id'] ?>, -1)">-</button>
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" readonly>
                                    <button type="button" class="btn-icon" onclick="changeQuantity(this, <?= $item['id'] ?>, 1)">+</button>
                                </div>
                            </td>
                            <td class="text-end">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Cart Actions below Shopping Cart -->
            <div class="cart-actions">
                <a href="/shop" class="btn btn-continue-shopping continue-shopping">
                    <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>
                <a href="checkout.php" class="btn btn-primary">Process Checkout</a>
            </div>

        </div>

        <!-- Order Summary Section -->
        <div class="order-summary mb-4">
            <h5>Order Total</h5>
            <p>Subtotal: <span id="subtotal">$<?= number_format($totalPrice, 2) ?></span></p>
            <p>Taxes: <span id="taxes">$0.00</span></p>
            <p><strong>Total: <span id="total">$<?= number_format($totalPrice, 2) ?></span></strong></p>
            <a href="checkout.php" class="btn btn-primary w-100 mt-3">Proceed to Checkout</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

<script>
function changeQuantity(button, productId, delta) {
    const input = button.closest('.quantity-control').querySelector('input[type="number"]');
    let newQuantity = parseInt(input.value) + delta;
    if (newQuantity < 1) newQuantity = 1;
    input.value = newQuantity;

    fetch(`update_cart.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${productId}&quantity=${newQuantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            button.closest('tr').querySelector('.total-price').innerText = `$${(data.itemTotal).toFixed(2)}`;
            document.getElementById('subtotal').innerText = `$${(data.cartTotal).toFixed(2)}`;
            document.getElementById('total').innerText = `$${(data.cartTotal).toFixed(2)}`;
        }
    });
}
</script>
</body>
</html>
