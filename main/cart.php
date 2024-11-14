<?php
session_start();
include '../web/db_connection.php';
include '../classes/cart.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$cart = new Cart($conn, $userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    
    if ($_POST['action'] === 'add') {
        $cart->addProduct($productId, $quantity);
    } elseif ($_POST['action'] === 'update') {
        $cart->updateQuantity($productId, $quantity);
    } elseif ($_POST['action'] === 'remove') {
        $cart->removeProduct($productId);
    }
}

$cartItemsData = $cart->getCartItems();
$cartItems = $cartItemsData['items'];
$totalPrice = $cartItemsData['total'];
$estimatedDelivery = $cartItemsData['estimatedDelivery'];
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
                            <tr data-product-id="<?= $item['id'] ?>">
                                <td>
                                    <img src="<?= htmlspecialchars($item['main_image'] ?? '/tech_web/assets/placeholder.png') ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?>" width="60">
                                    <div>
                                        <strong><?= htmlspecialchars($item['name']) ?></strong>
                                        <?php if (!empty($item['short_description'])): ?>
                                            <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                                <?= htmlspecialchars($item['short_description']) ?></p>
                                        <?php endif; ?>

                                        <!-- Display product attributes -->
                                <?php if (!empty($item['attributes'])): ?>
                                    <ul class="list-unstyled mb-1" style="font-size: 0.85rem;">
                                        <?php foreach ($item['attributes'] as $attr): ?>
                                            <?php if ($attr['attribute_name'] !== 'tags'): ?>
                                                <li><strong><?= htmlspecialchars($attr['attribute_name']) ?>:</strong> <?= htmlspecialchars($attr['value']) ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                        <p class="text-muted mb-1" style="font-size: 0.85rem;">Estimated Delivery: <?= $estimatedDelivery ?></p>
                                        <a href="../web/remove_from_cart.php?product_id=<?= $item['id'] ?>" class="text-danger">Remove</a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="quantity-control">
                                        <button type="button" class="btn-icon" onclick="changeQuantity(this, <?= $item['id'] ?>, -1)">-</button>
                                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" readonly>
                                        <button type="button" class="btn-icon" onclick="changeQuantity(this, <?= $item['id'] ?>, 1)">+</button>
                                    </div>
                                </td>
                                <td class="text-end total-price" data-price="<?= $item['price'] ?>">
                                    <?php if ($item['discount_percentage'] > 0): ?>
                                        <p class="mb-0" style="font-size: 1rem;">
                                            <del class="text-muted">$<?= number_format($item['original_price'], 2) ?></del>
                                            <span class="text-danger">$<?= number_format($item['price'], 2) ?></span>
                                        </p>
                                        <p class="text-success small">Save <?= $item['discount_percentage'] ?>%</p>
                                    <?php else: ?>
                                        <p class="mb-0" style="font-size: 1rem;">$<?= number_format($item['price'], 2) ?></p>
                                    <?php endif; ?>
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
    const row = button.closest('tr');
    const input = row.querySelector('input[type="number"]');
    const priceCell = row.querySelector('.total-price');
    const unitPrice = parseFloat(priceCell.getAttribute('data-price'));
    let newQuantity = parseInt(input.value) + delta;
    if (newQuantity < 1) newQuantity = 1;
    input.value = newQuantity;

    fetch(`../web/update_cart.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${productId}&quantity=${newQuantity}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not OK');
        }
        return response.json(); 
    })
    .then(data => {
        if (data.success) {

            priceCell.innerText = `$${(unitPrice * newQuantity).toFixed(2)}`;

            document.getElementById('subtotal').innerText = `$${(data.cartTotal).toFixed(2)}`;
            document.getElementById('total').innerText = `$${(data.cartTotal).toFixed(2)}`;
        } else {
            console.error(data.message || 'Could not update the cart. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
</body>
</html>
