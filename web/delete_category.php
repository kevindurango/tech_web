<?php
include 'db_connection.php';
include 'category.php'; 

$category = new category($conn); 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $resultMessage = $category->deleteCategory($id);
    
    echo htmlspecialchars($resultMessage); 
    echo "<br><a href='category_list.php'>View Category List</a>";
} else {
    echo "Invalid request.";
}

$conn->close();
?>
