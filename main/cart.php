<?php

session_start();
include '../web/db_connection.php';
include '../classes/cart.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id']; // Get the logged-in user ID

// Create Cart object
$cart = new Cart($conn, $userId);

// Handle adding or updating items in the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Update cart item or add new item
    if (isset($_POST['decrease'])) {
        $cart->updateCartItem($productId, -1); // Decrease quantity
    } else if (isset($_POST['increase'])) {
        $cart->updateCartItem($productId, 1); // Increase quantity
    } else {
        $cart->updateCartItem($productId, $quantity); // Add new item
    }

    header('Location: cart.php');
    exit;
}

// Handle removing items from the cart
if (isset($_GET['remove'])) {
    $productId = intval($_GET['remove']);
    $cart->removeCartItem($productId);
    header('Location: cart.php');
    exit;
}

// Fetch cart items for the user
$cartItems = $cart->getCartItems();
$checkoutDetails = $cart->calculateTotals($cartItems);

// Calculate the total price
$totalPrice = $checkoutDetails['total'];
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

    <div class="cart-container">
        <div class="cart-table mb-4">
            <h3 class="p-3">Shopping Cart</h3>
            <?php if (empty($cartItems)): ?>
                <p class="text-center">Your cart is currently empty. <a href="/shop">Continue Shopping</a></p>
            <?php else: ?>
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
                            <tr data-product-id="<?= $item['product_id'] ?>">
                                <td>
                                    <img src="<?= htmlspecialchars($item['image'] ?? '/tech_web/assets/placeholder.png') ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?>" width="60">
                                    <div>
                                        <strong><?= htmlspecialchars($item['name']) ?></strong>
                                        <p class="text-muted"><?= htmlspecialchars($item['attributes']) ?></p>
                                        <a href="?remove=<?= $item['product_id'] ?>" class="text-danger">Remove</a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="cart.php" class="quantity-control">
                                        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                        <button type="submit" name="decrease" class="btn-icon">-</button>
                                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" readonly>
                                        <button type="submit" name="increase" class="btn-icon">+</button>
                                    </form>
                                </td>
                                <td class="text-end total-price">
                                    <p class="mb-0" style="font-size: 1rem;">$<?= number_format($item['total'], 2) ?></p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <div class="cart-actions">
                <a href="/shop" class="btn btn-continue-shopping continue-shopping">
                    <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>
                <a href="checkout.php" class="btn btn-primary">Process Checkout</a>
            </div>
        </div>

        <div class="order-summary mb-4">
            <h5>Order Total</h5>
            <p>Subtotal: <span id="subtotal">$<?= number_format($checkoutDetails['subtotal'], 2) ?></span></p>
            <p>Taxes: <span id="taxes">$0.00</span></p>
            <p><strong>Total: <span id="total">$<?= number_format($totalPrice, 2) ?></span></strong></p>
            <a href="checkout.php" class="btn btn-primary w-100 mt-3">Proceed to Checkout</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
