<?php
include 'db_connection.php';
include '../classes/productattribute.php';

$productAttribute = new productattribute($conn); // Instantiate using the new class name

if (isset($_GET['id']) && isset($_GET['attribute_id'])) {
    $id = intval($_GET['id']); 
    $attribute_id = intval($_GET['attribute_id']); 

    $resultMessage = $productAttribute->deleteAttributeValue($id); // Call the delete method

    // Redirect with a success/error message
    header("Location: attribute_values.php?id=$attribute_id&message=" . urlencode($resultMessage));
    exit();
} else {
    // Redirect if the request is invalid
    header("Location: attribute_values.php?id=$attribute_id&message=" . urlencode("Invalid request."));
    exit();
}

$conn->close(); // Close the connection
?>
