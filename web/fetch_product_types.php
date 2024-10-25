<?php
include 'db_connection.php';

// Get the parent_id (Product Line) from the query parameters
$parent_id = isset($_GET['parent_id']) ? intval($_GET['parent_id']) : 0;

// Optionally, check if the request is coming from the edit page
$is_edit_request = isset($_GET['is_edit']) ? (bool)$_GET['is_edit'] : false;

// Fetch Product Types (subcategories) based on the selected Product Line
if ($parent_id) {
    $product_types_result = $conn->query("SELECT * FROM categories WHERE parent_id = $parent_id");

    if ($product_types_result->num_rows > 0) {
        echo '<option value="">Select a Product Type</option>';
        while ($product_type = $product_types_result->fetch_assoc()) {
            echo '<option value="' . $product_type['id'] . '">' . htmlspecialchars($product_type['category_name']) . '</option>';
        }
    } else {
        echo '<option value="">No Product Types found</option>';
    }
} else {
    echo '<option value="">Select a Product Line first</option>';
}

$conn->close();
?>


