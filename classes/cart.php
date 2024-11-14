<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Cart {
    private $conn;
    private $userId;

    public function __construct($conn, $userId = null) {
        $this->conn = $conn;
        $this->userId = $userId;
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Add product to the cart
    public function addProduct($productId, $quantity = 1) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
        return ['success' => true, 'message' => 'Product added to cart.'];
    }

    // Remove a product from the cart
    public function removeProduct($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
            return ['success' => true, 'message' => 'Product removed from cart.'];
        }
        return ['success' => false, 'message' => 'Product not found in cart.'];
    }

    // Update the quantity of a specific product in the cart
    public function updateQuantity($productId, $quantity) {
        if ($quantity <= 0) {
            return $this->removeProduct($productId);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
            return ['success' => true, 'message' => 'Quantity updated.'];
        }
    }

    // Get all items in the cart along with calculated totals
    public function getCartItems() {
        $cartItems = [];
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = $this->getProductDetails($productId);
            if ($product) {
                $product['quantity'] = $quantity;
                $totalPrice += $product['price'] * $quantity;
                $cartItems[] = $product;
            }
        }

        return [
            'items' => $cartItems,
            'total' => $totalPrice,
            'estimatedDelivery' => date('F j, Y', strtotime('+5 days')),
        ];
    }

    // Fetch product details, including main image and attributes
    private function getProductDetails($productId) {
        $stmt = $this->conn->prepare("
            SELECT p.*, i.image_path AS main_image
            FROM products p
            LEFT JOIN images i ON p.id = i.product_id
            WHERE p.id = ?
            LIMIT 1
        ");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();

        if ($product) {
            $product['attributes'] = $this->getProductAttributes($productId);
        }

        return $product;
    }

    // Fetch product attributes
    private function getProductAttributes($productId) {
        $attributeStmt = $this->conn->prepare("
            SELECT a.attribute_name, av.value
            FROM product_attributes pa
            JOIN attribute_values av ON pa.attribute_value_id = av.id
            JOIN attributes a ON av.attribute_id = a.id
            WHERE pa.product_id = ? AND a.attribute_name != 'tags'
        ");
        $attributeStmt->bind_param("i", $productId);
        $attributeStmt->execute();
        $attributes = $attributeStmt->get_result();

        $productAttributes = [];
        while ($attr = $attributes->fetch_assoc()) {
            $productAttributes[] = $attr;
        }

        return $productAttributes;
    }

    // Clear the entire cart
    public function clearCart() {
        $_SESSION['cart'] = [];
        return ['success' => true, 'message' => 'Cart cleared.'];
    }

    // Calculate and return the total price including any additional fees or taxes
    public function getTotalPrice() {
        return $this->calculateCartTotal();
    }

    // Calculate the subtotal of the cart
    private function calculateCartTotal() {
        $total = 0;
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $productPrice = $this->getProductPrice($productId);
            if ($productPrice !== null) {
                $total += $productPrice * $quantity;
            }
        }
        return $total;
    }

    // Update item quantity and recalculate totals
    public function updateItemQuantity($productId, $quantity) {
        if ($quantity < 1) {
            return [
                'success' => false,
                'message' => 'Quantity must be at least 1.'
            ];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $quantity;
            return $this->calculateTotals($productId);
        } else {
            return [
                'success' => false,
                'message' => 'Product not found in the cart.'
            ];
        }
    }

    // Calculate the item total for a specific item and the overall cart total
    private function calculateTotals($productId) {
        $cartTotal = 0;
        $itemTotal = 0;

        foreach ($_SESSION['cart'] as $id => $qty) {
            $productPrice = $this->getProductPrice($id);
            if ($productPrice !== null) {
                $currentItemTotal = $productPrice * $qty;
                $cartTotal += $currentItemTotal;

                if ($id == $productId) {
                    $itemTotal = $currentItemTotal;
                }
            }
        }

        return [
            'success' => true,
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal,
            'message' => 'Cart updated successfully!'
        ];
    }

    // Fetch product price for a specific product
    private function getProductPrice($productId) {
        $stmt = $this->conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        return $product ? $product['price'] : null;
    }

    // Calculate taxes based on a defined rate
    private function calculateTaxes($amount) {
        $taxRate = 0.10; // Example 10% tax rate
        return $amount * $taxRate;
    }

    // Checkout details with taxes and total summary
    public function getCheckoutDetails() {
        $cartItems = $this->getCartItems(); // Fetch items
        $subtotal = $cartItems['total'];
        $taxes = $this->calculateTaxes($subtotal);
        $total = $subtotal + $taxes;

        return [
            'subtotal' => $subtotal,
            'taxes' => $taxes,
            'total' => $total
        ];
    }
}
?>
