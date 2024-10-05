<?php
include 'db_connection.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT id, category_name, description FROM Categories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();

    if (!$category) {
        die("Category not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form action="update_category.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($category['description']); ?></textarea><br><br>

        <input type="submit" value="Update Category">
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
