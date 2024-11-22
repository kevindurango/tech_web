<?php
class Order
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

       // Fetch all orders
       public function getAllOrders()
       {
           $query = "
               SELECT 
                   o.id AS order_number, 
                   DATE_FORMAT(o.created_at, '%m/%d/%Y') AS order_date, 
                   o.total AS total_amount, 
                   o.status AS invoice_status, 
                   u.username AS customer_name,
                   u.email AS customer_email
               FROM orders o
               JOIN users u ON o.user_id = u.id
               ORDER BY o.created_at DESC
           ";
   
           $result = $this->conn->query($query);
   
           if (!$result) {
               throw new Exception("Error fetching orders: " . $this->conn->error);
           }
   
           return $result->fetch_all(MYSQLI_ASSOC);
       }

    // Fetch an order by ID and user ID
    public function getOrderById($orderId, $userId)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                o.id AS order_id, 
                o.created_at AS order_date, 
                o.total AS total_amount, 
                o.status AS order_status, 
                u.username AS customer_name, 
                u.email AS customer_email 
            FROM orders o 
            JOIN users u ON o.user_id = u.id 
            WHERE o.id = ? AND o.user_id = ?
        ");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $orderId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch items associated with an order
    public function getOrderItems($orderId)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                oi.quantity, 
                oi.price, 
                p.name AS product_name 
            FROM order_items oi 
            JOIN products p ON oi.product_id = p.id 
            WHERE oi.order_id = ?
        ");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch payment details for an order
    public function getPaymentDetails($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                card_type, 
                card_number, 
                expiration_date 
            FROM payment_info 
            WHERE user_id = ? 
            ORDER BY id DESC LIMIT 1
        ");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function deleteOrder($orderId)
    {
        try {
            // Start a transaction
            $this->conn->begin_transaction();

            // Check if the order exists
            $checkOrderQuery = "SELECT id FROM orders WHERE id = ?";
            $stmt = $this->conn->prepare($checkOrderQuery);
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                throw new Exception("Order not found.");
            }

            // Delete associated items from the `order_items` table
            $deleteOrderItemsQuery = "DELETE FROM order_items WHERE order_id = ?";
            $stmt = $this->conn->prepare($deleteOrderItemsQuery);
            $stmt->bind_param("i", $orderId);
            $stmt->execute();

            // Delete the order itself
            $deleteOrderQuery = "DELETE FROM orders WHERE id = ?";
            $stmt = $this->conn->prepare($deleteOrderQuery);
            $stmt->bind_param("i", $orderId);
            $stmt->execute();

            // Commit the transaction
            $this->conn->commit();

            return true; // Indicate success
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->conn->rollback();
            throw $e; // Re-throw the exception for further handling
        } finally {
            $stmt->close();
        }
    }

     // Create a new order and populate order items
     public function createOrder($userId, $cartItems, $total)
     {
         $this->conn->begin_transaction();
         try {
             // Insert a new order
             $stmt = $this->conn->prepare("INSERT INTO orders (user_id, total, status) VALUES (?, ?, 'pending')");
             $stmt->bind_param("id", $userId, $total);
             $stmt->execute();
             $orderId = $this->conn->insert_id;
 
             // Insert order items
             $stmtItems = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
             foreach ($cartItems as $item) {
                 $stmtItems->bind_param("iiid", $orderId, $item['product_id'], $item['quantity'], $item['price']);
                 $stmtItems->execute();
             }
 
             // Commit transaction
             $this->conn->commit();
             return $orderId;
         } catch (Exception $e) {
             $this->conn->rollback();
             throw $e;
         }
     }
 
     // Fetch order details
     public function getOrderDetails($orderId, $userId)
     {
         $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
         $stmt->bind_param("ii", $orderId, $userId);
         $stmt->execute();
         return $stmt->get_result()->fetch_assoc();
     }
 

 }
?>
