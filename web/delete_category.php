<?php
include 'db_connection.php';
include 'Category.php'; 

$category = new Category($conn);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $resultMessage = $category->deleteCategory($id);
    
    echo $resultMessage;
    echo "<br><a href='category_list.php'>View Category List</a>";
} else {
    echo "Invalid request.";
}

$conn->close();
?>
