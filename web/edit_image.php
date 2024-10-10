<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $image_id = (int)$_GET['id'];

    // Fetch current image details
    $fetch_query = "SELECT * FROM images WHERE id = ?";
    $fetch_stmt = $conn->prepare($fetch_query);
    $fetch_stmt->bind_param("i", $image_id);
    $fetch_stmt->execute();
    $image_result = $fetch_stmt->get_result();

    if ($image_result->num_rows === 0) {
        die("Image not found.");
    }

    $image_data = $image_result->fetch_assoc();
    $current_image_path = $image_data['image_path'];
    $product_id = $image_data['product_id'];

    // Handle form submission for updating the image
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
        // Define target directory for new image upload using the product-specific folder
        $target_dir = "C:/xampp/htdocs/tech_web/uploads/$product_id/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $relative_image_path = "/tech_web/uploads/$product_id/" . basename($_FILES['image']['name']);  // Relative path for DB

        // Get the file extension
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the uploaded file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            die("File is not an image.");
        }

        // Check if the directory exists, if not create it
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory with appropriate permissions
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update image path in the database with relative path
            $update_query = "UPDATE images SET image_path = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("si", $relative_image_path, $image_id);

            if ($update_stmt->execute()) {
                // Also update the product's main image if needed
                $update_product_query = "UPDATE products SET main_image_url = ? WHERE id = ?";
                $update_product_stmt = $conn->prepare($update_product_query);
                $update_product_stmt->bind_param("si", $relative_image_path, $product_id);

                if ($update_product_stmt->execute()) {
                    echo "Image updated successfully.";
                } else {
                    echo "Error updating product image.";
                }

                $update_product_stmt->close();
            } else {
                echo "Error updating image in the database.";
            }
            $update_stmt->close();
        } else {
            echo "Error moving uploaded file.";
        }
    }
} else {
    die("Invalid request.");
}

// Fetch and display the form for the current image
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Image</title>
</head>
<body>
    <h2>Edit Image</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Current Image:</label><br>
        <img src="<?php echo htmlspecialchars($current_image_path); ?>" alt="Current Image" width="200"><br><br>
        <label for="image">Upload New Image:</label>
        <input type="file" name="image" required>
        <input type="submit" value="Update Image">
    </form>
    <br>
    <a href="image_management.php?id=<?php echo $product_id; ?>">Back to Image Management</a>
</body>
</html>

<?php
$conn->close();
?>
