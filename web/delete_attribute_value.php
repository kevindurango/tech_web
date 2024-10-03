<?php
include 'Database.php';
include 'Product_Attribute_Value.php';

$db = new Database();
$conn = $db->getConnection();
$attributeValue = new ProductAttributeValue($conn);

if (isset($_GET['id'])) {
    $valueId = $_GET['id'];

    if ($attributeValue->deleteAttributeValue($valueId)) {
        header("Location: attribute_list.php?msg=Attribute value deleted successfully");
        exit();
    } else {
        echo "Error deleting attribute value.";
    }
} else {
    header("Location: attribute_list.php?msg=Invalid value ID.");
    exit();
}
