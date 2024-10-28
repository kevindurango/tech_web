<?php
include 'db_connection.php';

// Retrieve posted data
$product_id = $_POST['id'];
$name = $_POST['name'];
$sku = $_POST['sku'];
$short_description = $_POST['short_description'];
$price = $_POST['price'];
$product_description = $_POST['product_description'];
$feature_product = isset($_POST['feature_product']) ? 1 : 0; // Checkbox value
$brand_id = $_POST['brand_id'];
$product_variation_id = $_POST['product_variation_id']; // Single selected variation
$attributes = isset($_POST['attribute_value_ids']) ? $_POST['attribute_value_ids'] : [];

// Update the main product details
$update_product_query = "UPDATE products SET name = ?, SKU = ?, short_description = ?, price = ?, 
    product_description = ?, feature_product = ?, brand_id = ? WHERE id = ?";
$stmt = $conn->prepare($update_product_query);
$stmt->bind_param("sssdssii", $name, $sku, $short_description, $price, $product_description, $feature_product, $brand_id, $product_id);
$stmt->execute();

// Fetch the category path for the selected product variation
$category_path = [];
$current_category_id = $product_variation_id;

while ($current_category_id) {
    $category_query = $conn->prepare("SELECT id, parent_id FROM categories WHERE id = ?");
    $category_query->bind_param("i", $current_category_id);
    $category_query->execute();
    $category_result = $category_query->get_result();
    $category = $category_result->fetch_assoc();

    if ($category) {
        $category_path[] = $category['id'];
        $current_category_id = $category['parent_id'];
    } else {
        break;
    }
}

// Clear existing categories for the product
$conn->query("DELETE FROM product_categories WHERE product_id = $product_id");

// Insert the new categories for the product based on the category path
foreach (array_reverse($category_path) as $category_id) {
    $insert_category_query = "INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)";
    $insert_category_stmt = $conn->prepare($insert_category_query);
    $insert_category_stmt->bind_param("ii", $product_id, $category_id);
    $insert_category_stmt->execute();
}

// Clear existing attributes for the product
$conn->query("DELETE FROM product_attributes WHERE product_id = $product_id");

// Insert the new attributes for the product
if (!empty($attributes)) {
    foreach ($attributes as $attribute_id => $value_ids) {
        foreach ($value_ids as $value_id) {
            $insert_attribute_query = "INSERT INTO product_attributes (product_id, attribute_value_id) VALUES (?, ?)";
            $insert_attribute_stmt = $conn->prepare($insert_attribute_query);
            $insert_attribute_stmt->bind_param("ii", $product_id, $value_id);
            $insert_attribute_stmt->execute();
        }
    }
}

// Redirect back to the edit page with a success message
header("Location: edit_product.php?id=$product_id&update=success");
exit();
?>
