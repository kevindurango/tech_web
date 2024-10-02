<?php
include 'Database.php';  
include 'Category.php'; 

$db = new Database();
$conn = $db->getConnection();

$category = new Category($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category->category_name = $_POST['category_name'];
    $category->category_description = $_POST['category_description'];


    if ($category->addCategory()) {
        echo "Category added successfully!";
    } else {
        echo "Error adding category.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
    <h2>Add New Category</h2>
    <form action="category_form.php" method="post">
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" required><br>

        <label for="category_description">Category Description:</label>
        <textarea name="category_description"></textarea><br>

        <input type="submit" value="Add Category">
    </form>
</body>
</html>
