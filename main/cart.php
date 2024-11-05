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
        $product['quantity'] = $quantity; // Add quantity to product details
        $totalPrice += $product['price'] * $quantity; // Calculate total price
        $cartItems[] = $product; // Add product to cart items
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
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="mt-3">
    <div class="container">
        <h3 class="fw-bold mb-3 text-start fs-4">Your Shopping Cart</h3>
        <div class="row">
            <div class="col-md-8">
                <?php if (!empty($cartItems)): ?>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartItems as $item): ?>
                                        <tr>
                                            <td>
                                                <img src="<?= htmlspecialchars($item['main_image'] ?? '/tech_web/assets/placeholder.png') ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?>" style="width: 50px; height: auto;">
                                                <?= htmlspecialchars($item['name']) ?>
                                            </td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= number_format($item['price'], 2) ?> €</td>
                                            <td><?= number_format($item['price'] * $item['quantity'], 2) ?> €</td>
                                            <td>
                                                <form action="remove_from_cart.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Your cart is empty. <a href="category_page.php">Continue shopping</a>.</p>
                <?php endif; ?>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-bold">Order Total</h5>
                        <p>Subtotal: <?= number_format($totalPrice, 2) ?> €</p>
                        <h6>Total: <?= number_format($totalPrice, 2) ?> €</h6>
                        <a href="checkout.php" class="btn btn-success mt-3">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
