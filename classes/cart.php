<?php
class Cart {
    private $conn;
    private $userId;
    private $cartId;
    private $isGuest;

    // Constructor to initialize the database connection and userId or guest cart
    public function __construct($conn, $userId = null) {
        $this->conn = $conn;
        $this->userId = $userId;
        $this->isGuest = is_null($userId); // Check if this is a guest user
        $this->cartId = $this->getCartId();
    }

    // Get the user's cart ID or create a new cart if it doesn't exist
    private function getCartId() {
        if ($this->isGuest) {
            // Handle guest cart using a session or unique identifier
            if (!isset($_SESSION['guest_cart_id'])) {
                // Create a new guest cart
                $stmt = $this->conn->prepare("INSERT INTO cart (user_id) VALUES (NULL)");
                if (!$stmt) {
                    die("Failed to prepare statement: " . $this->conn->error);
                }
                $stmt->execute();
                $_SESSION['guest_cart_id'] = $this->conn->insert_id; // Store guest cart ID in session
            }
            return $_SESSION['guest_cart_id'];
        } else {
            // Handle registered user cart
            $stmt = $this->conn->prepare("SELECT id FROM cart WHERE user_id = ?");
            if (!$stmt) {
                die("Failed to prepare statement: " . $this->conn->error);
            }

            $stmt->bind_param("i", $this->userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $cart = $result->fetch_assoc();

            if ($cart) {
                return $cart['id'];
            } else {
                $stmt = $this->conn->prepare("INSERT INTO cart (user_id) VALUES (?)");
                if (!$stmt) {
                    die("Failed to prepare statement: " . $this->conn->error);
                }

                $stmt->bind_param("i", $this->userId);
                $stmt->execute();
                return $this->conn->insert_id;
            }
        }
    }

    // Fetch all cart items for the user or guest
    public function getCartItems() {
        $stmt = $this->conn->prepare("
            SELECT 
                ci.id AS cart_item_id, 
                p.id AS product_id, 
                p.name, 
                p.price, 
                ci.quantity, 
                (p.price * ci.quantity) AS total, 
                i.image_path AS image,
                GROUP_CONCAT(av.value SEPARATOR ', ') AS attributes
            FROM 
                cart_items ci
            JOIN 
                products p ON ci.product_id = p.id
            LEFT JOIN 
                images i ON p.id = i.product_id
            LEFT JOIN 
                product_attributes pa ON pa.product_id = p.id
            LEFT JOIN 
                attribute_values av ON pa.attribute_value_id = av.id
            LEFT JOIN 
                attributes a ON av.attribute_id = a.id
            WHERE 
                ci.cart_id = ?
            AND 
                a.attribute_name != 'tags'
            GROUP BY 
                ci.id
            ORDER BY 
                i.id ASC
        ");
        
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $this->cartId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update product quantity in the cart
    public function updateCartItem($productId, $quantity) {
        $stmt = $this->conn->prepare("SELECT id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ?");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $this->cartId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $cartItem = $result->fetch_assoc();

        if ($cartItem) {
            $newQuantity = max(1, $quantity); // Set quantity directly
            $stmt = $this->conn->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
            if (!$stmt) {
                die("Failed to prepare update statement: " . $this->conn->error);
            }
            $stmt->bind_param("ii", $newQuantity, $cartItem['id']);
            $stmt->execute();
        } else {
            $stmt = $this->conn->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)");
            if (!$stmt) {
                die("Failed to prepare insert statement: " . $this->conn->error);
            }
            $stmt->bind_param("iii", $this->cartId, $productId, $quantity);
            $stmt->execute();
        }
    }

    // Remove product from the cart
    public function removeCartItem($productId) {
        $stmt = $this->conn->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }
        
        $stmt->bind_param("ii", $this->cartId, $productId);
        $stmt->execute();
    }

    // Calculate the subtotal, taxes, and total for the cart
    public function calculateTotals($cartItems) {
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['total'];
        }

        // Example: 10% tax rate
        $taxes = $subtotal * 0.1;
        $total = $subtotal + $taxes;

        return [
            'subtotal' => $subtotal,
            'taxes' => $taxes,
            'total' => $total
        ];
    }

    // Insert checkout details into the database
    public function insertCheckoutInfo($name, $email, $phone, $street1, $street2, $city, $zip, $country, $state, $sameAddress) {
        $stmt = $this->conn->prepare("INSERT INTO checkout_info (user_id, name, email, phone, street1, street2, city, zip, country, state, same_address) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $userIdForInsert = $this->isGuest ? null : $this->userId; // Use NULL for guest users
        $stmt->bind_param("issssssssss", $userIdForInsert, $name, $email, $phone, $street1, $street2, $city, $zip, $country, $state, $sameAddress);
        
        return $stmt->execute();
    }

    // Save payment information
    public function savePaymentInfo($cardType, $cardNumber, $expirationDate, $cvv) {
        $stmt = $this->conn->prepare("INSERT INTO payment_info (user_id, card_type, card_number, expiration_date, cvv) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $userIdForInsert = $this->isGuest ? null : $this->userId; // Use NULL for guest users
        $stmt->bind_param("issss", $userIdForInsert, $cardType, $cardNumber, $expirationDate, $cvv);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Error executing the query: " . $stmt->error);
        }
    }

    // Get checkout information (for confirmation)
    public function getCheckoutInfo() {
        $stmt = $this->conn->prepare("SELECT * FROM checkout_info WHERE user_id = ? ORDER BY id DESC LIMIT 1");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $userIdForQuery = $this->isGuest ? null : $this->userId; // Use NULL for guest users
        $stmt->bind_param("i", $userIdForQuery);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get payment information (for confirmation)
    public function getPaymentDetails() {
        $stmt = $this->conn->prepare("SELECT * FROM payment_info WHERE user_id = ? ORDER BY id DESC LIMIT 1");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $userIdForQuery = $this->isGuest ? null : $this->userId; // Use NULL for guest users
        $stmt->bind_param("i", $userIdForQuery);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get the latest order ID for the user
    public function getOrderId() {
        $stmt = $this->conn->prepare("SELECT id FROM orders WHERE user_id = ? AND status = 'pending' ORDER BY created_at DESC LIMIT 1");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['id'] ?? null; 
    }
    
    
    // Clear the cart
    public function clearCart() {
        $stmt = $this->conn->prepare("DELETE FROM cart_items WHERE cart_id = ?");
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $this->cartId);
        $stmt->execute();
    }

    public function createOrder($userId, $cartItems, $total) {
        // Step 1: Insert a new order
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, total, status) VALUES (?, ?, 'pending')");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }
        $stmt->bind_param("id", $userId, $total);
        $stmt->execute();
        $orderId = $this->conn->insert_id;

        // Step 2: Insert cart items into order_items
        $stmt = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }

        foreach ($cartItems as $item) {
            $stmt->bind_param("iiid", $orderId, $item['product_id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        // Step 3: Clear the cart
        $this->clearCart();

        return $orderId;
    }
}

?>  