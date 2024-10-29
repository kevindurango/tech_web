<?php
include 'db_connection.php';
include 'product.php';

// Retrieve POST data
$product_id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$sku = $_POST['sku'] ?? '';
$short_description = $_POST['short_description'] ?? '';
$price = $_POST['price'] ?? 0.0;
$product_description = $_POST['product_description'] ?? '';
$feature_product = isset($_POST['feature_product']) ? 1 : 0; 
$brand_id = $_POST['brand_id'] ?? null;
$product_variation_id = $_POST['product_variation_id'] ?? null; 
$attributes = $_POST['attributes'] ?? []; 

// Initialize product object and set properties
$product = new Product($name, $sku, $short_description, $price, $product_description, $feature_product, $brand_id, $attributes);

// Call methods to update product details, categories, and attributes
if ($product->updateProduct($product_id, $conn)) {
    $product->updateProductCategories($product_id, $product_variation_id, $conn);
    $product->updateProductAttributes($product_id, $conn);

    // Redirect back to the edit page with a success message
    header("Location: edit_product.php?id=$product_id&update=success");
} else {
    echo "Failed to update product.";
}
exit();
?>
