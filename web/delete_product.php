<?php
include 'db_connection.php';
include 'Product.php'; // Ensure to include your Product class

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Create an instance of the Product class
    $product = new Product('', '', '', 0, '', 0, 0); 

    // Call the delete method
    if ($product->deleteProduct($product_id, $conn)) {
        echo "Product deleted successfully. <a href='product_list.php'>Go back to product list</a>";
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "No product ID specified.";
}

// Close the database connection
$conn->close();
?>
