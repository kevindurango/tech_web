<?php
include 'db_connection.php';
include '../classes/product.php';

// Retrieve POST data
$name = $_POST['name'] ?? '';
$sku = $_POST['sku'] ?? '';
$short_description = $_POST['short_description'] ?? '';
$price = $_POST['price'] ?? 0.0;
$product_description = $_POST['product_description'] ?? '';
$feature_product = isset($_POST['feature_product']) ? 1 : 0; 
$brand_id = $_POST['brand_id'] ?? null;
$categories = isset($_POST['categories']) ? $_POST['categories'] : [];
$attributes = isset($_POST['attributes']) ? $_POST['attributes'] : [];
$image = $_FILES['image'];

// Handle image upload
$image_path = Product::uploadImage($image);

if ($image_path) {
    // Initialize product object and submit
    $product = new Product($name, $sku, $short_description, $price, $product_description, $feature_product, $brand_id, $attributes, $image_path);

    if ($product->submitProduct($conn, $categories)) {
        echo "New product created successfully!";
    } else {
        echo "Failed to create new product.";
    }
}
$conn->close();
?>
