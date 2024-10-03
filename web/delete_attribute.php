<?php
include 'Database.php';
include 'Product_Attribute.php';

$db = new Database();
$conn = $db->getConnection();
$attribute = new ProductAttribute($conn);

if (isset($_GET['id'])) {
    $attributeId = $_GET['id'];

    if ($attribute->deleteAttribute($attributeId)) {
        header("Location: attribute_list.php?msg=Attribute deleted successfully");
        exit();
    } else {
        echo "Error deleting attribute.";
    }
} else {
    header("Location: attribute_list.php?msg=Invalid attribute ID.");
    exit();
}
