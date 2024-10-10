<?php
include 'db_connection.php'; 

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Default to 0 if not set

if ($product_id <= 0) {
    die("Invalid product ID.");
}

// Fetch product details for display
$product_query = "SELECT name FROM products WHERE id = ?";
$product_stmt = $conn->prepare($product_query);
$product_stmt->bind_param("i", $product_id);
$product_stmt->execute();
$product_result = $product_stmt->get_result();
$product = $product_result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Fetch images related to the product
$images_query = "SELECT * FROM images WHERE product_id = ?";
$images_stmt = $conn->prepare($images_query);
$images_stmt->bind_param("i", $product_id);
$images_stmt->execute();
$images_result = $images_stmt->get_result();

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Define target directory with an absolute path for storage
    $absolute_target_dir = $_SERVER['DOCUMENT_ROOT'] . "/tech_web/uploads/" . $product_id . "/"; 

    // Check if directory exists, if not create it
    if (!file_exists($absolute_target_dir)) {
        mkdir($absolute_target_dir, 0777, true);
    }

    // Define the target file path using the uploaded image name
    $target_file = $absolute_target_dir . basename($_FILES["image"]["name"]);
    $relative_image_path = "/tech_web/uploads/" . $product_id . "/" . basename($_FILES["image"]["name"]); // Relative path for DB
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert image into the database with the relative path
        $insert_query = "INSERT INTO images (product_id, image_path) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("is", $product_id, $relative_image_path);
        $insert_stmt->execute();

        if ($insert_stmt->affected_rows > 0) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Error moving uploaded file.";
    }
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
                            <!-- Display the image using the relative path stored in the database -->
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
