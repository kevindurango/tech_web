<?php
include 'db_connection.php'; 

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    $sql = "DELETE FROM Products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        echo "Product deleted successfully. <a href='product_list.php'>Go back to product list</a>";
    } else {
        echo "Error deleting product: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No product ID specified.";
}

$conn->close();
?>
