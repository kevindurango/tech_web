<?php
include 'db_connection.php'; // Include your database connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product ID and other form data
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $short_description = $_POST['short_description'];
    $product_description = $_POST['product_description']; // New product description field
    $price = $_POST['price'];
    $feature_product = isset($_POST['feature_product']) ? 1 : 0;
    $brand_id = $_POST['brand_id'];
    $product_variation_id = $_POST['product_variation_id'];
    $attributes = isset($_POST['attributes']) ? $_POST['attributes'] : [];

    // Update product details
    $update_query = "UPDATE products SET name=?, SKU=?, short_description=?, product_description=?, price=?, feature_product=?, brand_id=? WHERE id=?";
    $update_stmt = $conn->prepare($update_query);
    
    // Correctly bind parameters
    $update_stmt->bind_param("ssssdiii", $name, $sku, $short_description, $product_description, $price, $feature_product, $brand_id, $product_id);

    if ($update_stmt->execute()) {
        // Update successful, now update product categories
        $conn->query("DELETE FROM product_categories WHERE product_id = $product_id"); // Remove existing categories

        // Insert new product category
        $insert_category_query = "INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)";
        $insert_category_stmt = $conn->prepare($insert_category_query);
        $insert_category_stmt->bind_param("ii", $product_id, $product_variation_id);
        $insert_category_stmt->execute();

        // Update product attributes
        $conn->query("DELETE FROM product_attributes WHERE product_id = $product_id"); // Remove existing attributes

        // Insert new attributes
        if (!empty($attributes)) {
            $insert_attribute_query = "INSERT INTO product_attributes (product_id, attribute_value_id) VALUES (?, ?)";
            $insert_attribute_stmt = $conn->prepare($insert_attribute_query);
            foreach ($attributes as $attribute_value_id) {
                $insert_attribute_stmt->bind_param("ii", $product_id, $attribute_value_id);
                $insert_attribute_stmt->execute();
            }
        }

        // Redirect to edit page with success message
        header("Location: edit_product.php?id=$product_id&update=success");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
