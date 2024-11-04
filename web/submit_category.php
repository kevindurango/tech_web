<?php
include 'db_connection.php';
include 'category.php'; 

// Create an instance of the category class
$category = new category($conn);

// Get form data
$category_name = $_POST['category_name'];
$description = $_POST['description'];
$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;

// Add the category with the specified parent ID
$resultMessage = $category->addCategory($category_name, $description, $parent_id);

// Display the result message safely
echo htmlspecialchars($resultMessage);

// Close the database connection
$conn->close();
?>
