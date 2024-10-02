<?php
include 'Database.php';
include 'Product.php';

$db = new Database();
$conn = $db->getConnection();
$product = new Product($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetails = $product->getProductById($id);

    if (!$productDetails) {
        echo "Product not found.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $product->id = $id; 
        $product->name = $_POST['name'];
        $product->sku = $_POST['sku'];
        $product->short_description = $_POST['short_description'];
        $product->price = $_POST['price'];
        $product->featured = isset($_POST['featured']) ? 1 : 0;
        $image_url = $_POST['image_url']; 


        if ($product->updateProduct($product->id, $product->name, $product->sku, $product->short_description, $product->price, $product->featured)) {

            if ($product->updateImage($id, $image_url)) {
                header("Location: product_list.php?msg=Product updated successfully");
                exit();
            } else {
                echo "Error updating image.";
            }
        } else {
            echo "Error updating product.";
        }
    }
} else {
    echo "Invalid product ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - <?php echo htmlspecialchars($productDetails['name']); ?></title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="edit_product.php?id=<?php echo $id; ?>" method="post">
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($productDetails['name']); ?>" required><br>

        <label for="sku">SKU:</label>
        <input type="text" name="sku" value="<?php echo htmlspecialchars($productDetails['sku']); ?>" required><br>

        <label for="short_description">Short Description:</label>
        <textarea name="short_description" required><?php echo htmlspecialchars($productDetails['short_description']); ?></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($productDetails['price']); ?>" required><br>

        <label for="featured">Featured:</label>
        <input type="checkbox" name="featured" <?php echo $productDetails['featured'] ? 'checked' : ''; ?>><br>

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" value="<?php echo htmlspecialchars($productDetails['image_url']); ?>"><br>

        <input type="submit" value="Update Product">
    </form>
    <a href="product_list.php">Back to Product List</a>
</body>
</html>
