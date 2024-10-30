<?php
include 'db_connection.php';
include 'Category.php'; // Make sure to include your Category class file

// Create an instance of the Category class
$category = new Category($conn);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $categoryData = $category->getCategoryById($id);

    if (!$categoryData) {
        die("Category not found.");
    }
} else {
    die("Invalid request.");
}

// Function to fetch categories in a hierarchical format
function fetchCategories($parent_id = null, $level = 0) {
    global $conn; // Access the database connection
    $categories = [];

    $stmt = $conn->prepare("SELECT id, category_name FROM Categories WHERE parent_id " . ($parent_id === null ? "IS NULL" : "= ?"));
    if ($parent_id !== null) {
        $stmt->bind_param("i", $parent_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $categories[] = [
            'id' => $row['id'],
            'name' => str_repeat('&nbsp;', $level * 4) . htmlspecialchars($row['category_name']),
            'parent_id' => $parent_id,
        ];
        // Fetch subcategories recursively
        $subcategories = fetchCategories($row['id'], $level + 1);
        $categories = array_merge($categories, $subcategories);
    }

    $stmt->close();
    return $categories;
}

// Fetch all categories for the dropdown
$all_categories = fetchCategories();
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
        <input type="hidden" name="id" value="<?php echo $categoryData['id']; ?>">
        
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($categoryData['category_name']); ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($categoryData['description']); ?></textarea><br><br>

        <label for="parent_id">Select Parent Category (Product Line or Product Type):</label>
        <select id="parent_id" name="parent_id">
            <option value="0">None</option>
            <?php foreach ($all_categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $categoryData['parent_id']) ? 'selected' : ''; ?>>
                    <?php echo $cat['name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Update Category">
    </form>
</body>
</html>

<?php
$conn->close();
?>
