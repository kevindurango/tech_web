<?php
include 'db_connection.php';
include 'Category.php'; // Include your Category class file

// Create an instance of the Category class
$category = new Category($conn);

// Get form data
$category_name = $_POST['category_name'];
$description = $_POST['description'];
$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0; // Get the parent ID

// Call the method to add the category with parent ID
$resultMessage = $category->addCategory($category_name, $description, $parent_id); // Modify method to include parent_id

// Display the result message
echo $resultMessage;

// Close the database connection
$conn->close();
?>
