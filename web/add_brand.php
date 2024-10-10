<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $description = $_POST['brand_description'];

    // Handle file upload
    $target_dir = "uploads/brands/";
    $target_file = $target_dir . basename($_FILES["brand_logo"]["name"]);
    $uploadOk = 1;

    // Move the uploaded file
    if (move_uploaded_file($_FILES["brand_logo"]["tmp_name"], $target_file)) {
        $logo_url = $target_file;

        // Insert the brand into the database
        $sql = "INSERT INTO brands (brand_name, logo_url, description) VALUES ('$brand_name', '$logo_url', '$description')";
        if (mysqli_query($conn, $sql)) {
            echo "New brand added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

mysqli_close($conn);

// Redirect back to the brands list
header('Location: manage_brands.php');
?>
