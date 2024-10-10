<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $brand_id = $_GET['id'];

    // Delete the brand
    $sql = "DELETE FROM brands WHERE id = $brand_id";
    if (mysqli_query($conn, $sql)) {
        echo "Brand deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

// Redirect back to the brands list
header('Location: manage_brands.php');
?>