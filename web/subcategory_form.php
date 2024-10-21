<?php
include 'db_connection.php'; 

if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);

    // Fetch the main category name for display
    $stmt = $conn->prepare("SELECT category_name FROM Categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $category_result = $stmt->get_result();
    $main_category = $category_result->fetch_assoc();

    if (!$main_category) {
        die("Category not found.");
    }
} else {
    die("No category ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Subcategory</title>
</head>
<body>
    <h2>Add New Subcategory for <?php echo htmlspecialchars($main_category['category_name']); ?></h2>
    <form action="submit_subcategory.php" method="POST">
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        
        <label for="subcategory_name">Subcategory Name:</label>
        <input type="text" id="subcategory_name" name="subcategory_name" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <input type="submit" value="Add Subcategory">
    </form>

    <br>
    <a href="subcategories.php?category_id=<?php echo $category_id; ?>">Back to Subcategories</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
