<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
</head>
<body>
    <h2>Add New Category</h2>
    <form action="submit_category.php" method="POST">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="parent_id">Select Parent Category (Optional):</label>
        <select id="parent_id" name="parent_id">
            <option value="0">None</option>
            <?php
            // Include the Category class and database connection
            include 'Category.php'; // Ensure you have the correct path to your class file
            include 'db_connection.php'; // Your DB connection file

            // Create an instance of the Category class
            $category = new Category($conn);
            // Fetch all categories
            $all_categories = $category->fetchAllCategories();
            // Display categories in a hierarchical format
            echo $category->displayCategories($all_categories);
            ?>
        </select><br><br>

        <input type="submit" value="Add Category">
    </form>
</body>
</html>
