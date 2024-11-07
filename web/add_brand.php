<?php
include 'db_connection.php';
include '../classes/brandmanager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandManager = new brandmanager($conn); 
    $brandManager->setBrandDetails($_POST['brand_name'], $_POST['brand_description']);

    // Handle file upload
    if ($brandManager->uploadLogo($_FILES["brand_logo"])) {
        $brandManager->addBrand();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    header('Location: manage_brands.php');
    exit();
}

mysqli_close($conn);
?>
