<?php
class imagemanager {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Fetch product details by ID
    public function getProductDetails($productId) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Fetch images related to the product
    public function getImagesByProductId($productId) {
        $stmt = $this->conn->prepare("SELECT * FROM images WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Fetch image details by ID
    public function getImageById($image_id) {
        $stmt = $this->conn->prepare("SELECT * FROM images WHERE id = ?");
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Delete an image by ID and associated product ID
    public function deleteImage($image_id, $product_id) {
        // Fetch the image details to get the path
        $image = $this->getImageById($image_id);

        if ($image) {
            // Delete the image record from the database
            $delete_query = "DELETE FROM images WHERE id = ?";
            $delete_stmt = $this->conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $image_id);
            $delete_stmt->execute();

            if ($delete_stmt->affected_rows > 0) {
                // Construct the full path of the image file
                $image_path = "C:/xampp/htdocs/tech_web/web/" . $image['image_path'];

                // Attempt to delete the image file from the server
                if (file_exists($image_path)) {
                    if (unlink($image_path)) { // Delete the file
                        return "Image deleted successfully.";
                    } else {
                        return "Error deleting image file from the server.";
                    }
                } else {
                    return "Error: Image file does not exist at $image_path.";
                }
            } else {
                return "Error deleting image from the database.";
            }
        } else {
            return "Image not found for image ID: $image_id.";
        }
    }

    // Upload a new image for the product
    public function uploadImage($productId, $file) {
        $absolute_target_dir = $_SERVER['DOCUMENT_ROOT'] . "/tech_web/uploads/" . $productId . "/";

        // Check if directory exists, if not create it
        if (!file_exists($absolute_target_dir)) {
            mkdir($absolute_target_dir, 0777, true);
        }

        // Define the target file path using the uploaded image name
        $target_file = $absolute_target_dir . basename($file["name"]);
        $relative_image_path = "/tech_web/uploads/" . $productId . "/" . basename($file["name"]); // Relative path for DB

        // Check if the uploaded file is an actual image
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            return "File is not an image.";
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // Insert image into the database with the relative path
            $insert_query = "INSERT INTO images (product_id, image_path) VALUES (?, ?)";
            $insert_stmt = $this->conn->prepare($insert_query);
            $insert_stmt->bind_param("is", $productId, $relative_image_path);
            $insert_stmt->execute();

            if ($insert_stmt->affected_rows > 0) {
                return "Image uploaded successfully.";
            } else {
                return "Error uploading image.";
            }
        } else {
            return "Error moving uploaded file.";
        }
    }

    // Update the image
    public function updateImage($image_id, $product_id, $file) {
        $target_dir = "C:/xampp/htdocs/tech_web/uploads/$product_id/";
        $target_file = $target_dir . basename($file['name']);
        $relative_image_path = "/tech_web/uploads/$product_id/" . basename($file['name']);

        // Check if the uploaded file is an actual image
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            return "File is not an image.";
        }

        // Check if the directory exists, if not create it
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            // Update image path in the database
            $update_query = "UPDATE images SET image_path = ? WHERE id = ?";
            $update_stmt = $this->conn->prepare($update_query);
            $update_stmt->bind_param("si", $relative_image_path, $image_id);
            if ($update_stmt->execute()) {
                // Also update the product's main image if needed
                $this->updateProductImage($relative_image_path, $product_id);
                return "Image updated successfully.";
            } else {
                return "Error updating image in the database.";
            }
        } else {
            return "Error moving uploaded file.";
        }
    }

    // Update product image
    private function updateProductImage($relative_image_path, $product_id) {
        $update_product_query = "UPDATE products SET main_image_url = ? WHERE id = ?";
        $update_product_stmt = $this->conn->prepare($update_product_query);
        $update_product_stmt->bind_param("si", $relative_image_path, $product_id);
        $update_product_stmt->execute();
        $update_product_stmt->close();
    }
}
?>
