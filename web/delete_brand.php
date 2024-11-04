<?php
include 'db_connection.php';
include 'brandmanager.php'; 

if (isset($_GET['id'])) {
    $brand_id = $_GET['id'];
    
    // Create an instance of brandmanager
    $brandManager = new brandmanager($conn);
    
    // Call the deleteBrand method
    $brandManager->deleteBrand($brand_id);
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the brands list
header('Location: manage_brands.php');
exit();
?>
