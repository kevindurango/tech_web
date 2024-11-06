<?php
include 'db_connection.php';
include '../classes/productattribute.php';

$productAttribute = new productattribute($conn); 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $resultMessage = $productAttribute->deleteAttribute($id);
    
    header("Location: attribute_list.php?message=" . urlencode($resultMessage));
    exit();
} else {
    header("Location: attribute_list.php?message=" . urlencode("Invalid request."));
    exit();
}

$conn->close(); 
?>
