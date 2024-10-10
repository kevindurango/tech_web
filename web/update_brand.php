<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_id = $_POST['id'];
    $brand_name = $_POST['brand_name'];
    $description = $_POST['brand_description'];

    // Path to the brands directory
    $target_dir = "uploads/brands/";

    // Check if the directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check if a new logo is uploaded
    if (!empty($_FILES['brand_logo']['name'])) {
        $target_file = $target_dir . basename($_FILES["brand_logo"]["name"]);

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["brand_logo"]["tmp_name"], $target_file)) {
            // If file upload is successful, update with the new logo
            $logo_url = $target_file;
            $sql = "UPDATE brands SET brand_name = '$brand_name', logo_url = '$logo_url', description = '$description' WHERE id = $brand_id";
        } else {
            // Handle file upload failure
            echo "Sorry, there was an error uploading your file.";
            exit; // Stop script execution on error
        }
    } else {
        // If no new logo is uploaded, update without changing the logo
        $sql = "UPDATE brands SET brand_name = '$brand_name', description = '$description' WHERE id = $brand_id";
    }

    // Run the update query
    if (mysqli_query($conn, $sql)) {
        echo "Brand updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

// Redirect back to the brands list
header('Location: manage_brands.php');
?>
