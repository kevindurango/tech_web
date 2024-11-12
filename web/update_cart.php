<?php
session_start();
include '../web/db_connection.php';

// Set header to indicate JSON response
header('Content-Type: application/json');

// Check if the POST request contains valid data
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Validate quantity (it should be at least 1)
    if ($quantity < 1) {
        echo json_encode([
            'success' => false,
            'message' => 'Quantity must be at least 1.'
        ]);
        exit;
    }

    // Check if the product exists in the cart
    if (isset($_SESSION['cart'][$productId])) {
        // Update the quantity in the session cart
        $_SESSION['cart'][$productId] = $quantity;

        // Calculate the new cart total and item total
        $cartTotal = 0;
        $itemTotal = 0;

        foreach ($_SESSION['cart'] as $id => $qty) {
            // Fetch product price from the database
            $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if ($product) {
                $currentItemTotal = $product['price'] * $qty;
                $cartTotal += $currentItemTotal;
                if ($id == $productId) {
                    $itemTotal = $currentItemTotal; // Total for the specific item
                }
            }
        }

        // Respond with the updated totals
        echo json_encode([
            'success' => true,
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal,
            'message' => 'Cart updated successfully!'
        ]);
        exit;
    } else {
        // If the product is not found in the cart
        echo json_encode([
            'success' => false,
            'message' => 'Product not found in the cart.'
        ]);
        exit;
    }
} else {
    // If invalid request
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request or missing parameters.'
    ]);
    exit;
}
?>
