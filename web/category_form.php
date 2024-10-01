<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $sql = "INSERT INTO categories (category_name, category_description) VALUES ('$category_name', '$category_description')";

    if ($conn->query($sql) === TRUE) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
    <form action="category_form.php" method="post">
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" required><br>

        <label for="category_description">Category Description:</label>
        <textarea name="category_description"></textarea><br>

        <input type="submit" value="Add Category">
    </form>
</body>
</html>
