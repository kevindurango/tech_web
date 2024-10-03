<?php
include 'Database.php';
include 'Product.php';

$db = new Database();
$conn = $db->getConnection();
$product = new Product($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product->name = $_POST['name'];
    $product->sku = $_POST['sku'];
    $product->short_description = $_POST['short_description'];
    $product->price = $_POST['price'];
    $product->featured = isset($_POST['featured']) ? 1 : 0;

    
    $productId = $product->addProduct();

    
    if ($productId && !empty($_POST['image_url'])) {
        if ($product->addImage($productId, $_POST['image_url'])) {
            header("Location: product_list.php?msg=Product added successfully");
            exit();
        } else {
            echo "Error adding image.";
        }
    } else {
        echo "Error adding product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product.php" method="post">
        <label for="name">Product Name:</label>
        <input type="text" name="name" required><br>

        <label for="sku">SKU:</label>
        <input type="text" name="sku" required><br>

        <label for="short_description">Short Description:</label>
        <textarea name="short_description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="featured">Featured:</label>
        <input type="checkbox" name="featured"><br>

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url"><br>

        <input type="submit" value="Add Product">
    </form>
    <a href="product_list.php">Back to Product List</a>
</body>
</html>
