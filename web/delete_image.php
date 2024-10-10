    <?php
    include 'db_connection.php';

    if (isset($_GET['id']) && isset($_GET['product_id'])) {
        $image_id = (int)$_GET['id'];
        $product_id = (int)$_GET['product_id'];

        // Fetch the image details to get the path
        $image_query = "SELECT image_path FROM images WHERE id = ?";
        $image_stmt = $conn->prepare($image_query);
        $image_stmt->bind_param("i", $image_id);
        $image_stmt->execute();
        $image_result = $image_stmt->get_result();
        $image = $image_result->fetch_assoc();

        if ($image) {
            // Delete the image record from the database
            $delete_query = "DELETE FROM images WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $image_id);
            $delete_stmt->execute();

            if ($delete_stmt->affected_rows > 0) {
                // Construct the full path of the image file
                $image_path = "C:/xampp/htdocs/tech_web/web/" . $image['image_path'];

                // Attempt to delete the image file from the server
                if (file_exists($image_path)) {
                    if (unlink($image_path)) { // Delete the file
                        echo "Image deleted successfully.";
                    } else {
                        echo "Error deleting image file from the server.";
                    }
                } else {
                    echo "Error: Image file does not exist at $image_path.";
                }
            } else {
                echo "Error deleting image from the database.";
            }

            // Close statements
            $delete_stmt->close();
            $image_stmt->close();

            // Redirect back to image management
            header("Location: image_management.php?id=" . $product_id);
            exit();
        } else {
            echo "Image not found for image ID: $image_id.";
        }
    } else {
        die("Invalid request. Image ID: " . $_GET['id'] . " Product ID: " . $_GET['product_id']);
    }

    $conn->close();
    ?>
