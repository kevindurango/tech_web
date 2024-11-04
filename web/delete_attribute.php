<?php
include 'db_connection.php';
include 'productattribute.php'; // Include the new class name

$productAttribute = new productattribute($conn); // Instantiate using the new class name

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Call the delete method from the ProductAttribute class
    $resultMessage = $productAttribute->deleteAttribute($id);
    
    // Redirect with a success/error message
    header("Location: attribute_list.php?message=" . urlencode($resultMessage));
    exit();
} else {
    header("Location: attribute_list.php?message=" . urlencode("Invalid request."));
    exit();
}

$conn->close(); // Close the connection
?>
