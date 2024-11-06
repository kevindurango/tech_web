<?php
include 'db_connection.php'; // Include your database connection
include '../classes/imagemanager.php';

$imageManager = new ImageManager($conn);

if (isset($_GET['id']) && isset($_GET['product_id'])) {
    $image_id = (int)$_GET['id'];
    $product_id = (int)$_GET['product_id'];

    // Use the deleteImage method from ImageManager
    $resultMessage = $imageManager->deleteImage($image_id, $product_id);

    // Redirect back to image management with a message
    header("Location: image_management.php?id=" . $product_id . "&message=" . urlencode($resultMessage));
    exit();
} else {
    die("Invalid request. Image ID: " . $_GET['id'] . " Product ID: " . $_GET['product_id']);
}

$conn->close();
?>
