<?php
include 'db_connection.php';
include '../classes/brandmanager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_id = $_POST['id'];
    $brand_name = $_POST['brand_name'];
    $description = $_POST['brand_description'];

    // Create an instance of brandmanager
    $brandManager = new brandmanager($conn);
    $brandManager->setBrandDetails($brand_name, $description);
    
    // Call the updateBrand method
    $brandManager->updateBrand($brand_id, $brand_name, $description, $_FILES['brand_logo']);
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the brands list
header('Location: manage_brands.php');
exit();
?>
