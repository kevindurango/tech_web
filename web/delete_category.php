<?php
include 'Database.php';
include 'Category.php';

$db = new Database();
$category = new Category($db->getConnection());

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($category->deleteCategory($id)) {
        header('Location: categories.php');
        exit();
    } else {
        echo "Error deleting category.";
    }
}
?>
