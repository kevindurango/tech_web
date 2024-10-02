<?php
include 'Database.php';
include 'Product.php';

$db = new Database();
$conn = $db->getConnection();
$product = new Product($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($product->deleteProduct($id)) {
        header("Location: product_list.php?msg=Product deleted successfully");
        exit();
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "Invalid product ID.";
}
?>
