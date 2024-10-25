<?php
include 'db_connection.php';

// Get the product_type_id from the query parameters
$product_type_id = isset($_GET['product_type_id']) ? intval($_GET['product_type_id']) : 0;

if ($product_type_id) {
    // Fetch product variations based on the product type ID
    $variations_result = $conn->query("SELECT * FROM categories WHERE parent_id = $product_type_id");

    // Check for SQL errors
    if (!$variations_result) {
        die("Query failed: " . $conn->error);
    }

    if ($variations_result->num_rows > 0) {
        echo '<option value="">Show All Variations</option>';
        while ($variation = $variations_result->fetch_assoc()) {
            echo '<option value="' . $variation['id'] . '">' . htmlspecialchars($variation['category_name']) . '</option>';
        }
    } else {
        echo '<option value="">No Variations Found</option>';
    }
} else {
    echo '<option value="">Select a Product Type first</option>';
}

$conn->close();
?>

