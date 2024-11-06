<?php
session_start();
include '../web/db_connection.php';
include '../classes/imagemanager.php';

$imageManager = new ImageManager($conn);

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Default to 0 if not set

if ($product_id <= 0) {
    die("Invalid product ID.");
}

// Fetch product details for display
$product = $imageManager->getProductDetails($product_id);
if (!$product) {
    die("Product not found.");
}

// Fetch images related to the product
$images_result = $imageManager->getImagesByProductId($product_id);

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadMessage = $imageManager->uploadImage($product_id, $_FILES['image']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Management for <?php echo htmlspecialchars($product['name']); ?></title>
</head>
<body>
    <h2>Image Management for <?php echo htmlspecialchars($product['name']); ?></h2>

    <?php if (isset($uploadMessage)): ?>
        <p><?php echo $uploadMessage; ?></p>
    <?php endif; ?>

    <h3>Upload New Image</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="submit" value="Upload Image">
    </form>

    <h3>Current Images</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($images_result->num_rows > 0): ?>
                <?php while ($image = $images_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $image['id']; ?></td>
                        <td>
                            <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="Product Image" width="100" height="100">
                        </td>
                        <td>
                            <a href="edit_image.php?id=<?php echo $image['id']; ?>&product_id=<?php echo $product_id; ?>">Edit</a>
                            <a href="delete_image.php?id=<?php echo $image['id']; ?>&product_id=<?php echo $product_id; ?>" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No images found for this product.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="product_list.php">Back to Product List</a>
</body>
</html>

<?php
$conn->close();
?>
