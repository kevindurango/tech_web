<?php
include 'db_connection.php'; 

if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);

    // Fetch the main category details
    $stmt = $conn->prepare("SELECT * FROM Categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $category_result = $stmt->get_result();
    $main_category = $category_result->fetch_assoc();

    // Fetch subcategories related to the main category
    $subcategories_stmt = $conn->prepare("SELECT * FROM Subcategories WHERE category_id = ?");
    $subcategories_stmt->bind_param("i", $category_id);
    $subcategories_stmt->execute();
    $subcategories_result = $subcategories_stmt->get_result();
} else {
    die("No category selected.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcategories of <?php echo htmlspecialchars($main_category['category_name']); ?></title>
</head>
<body>
    <h2>Subcategories of <?php echo htmlspecialchars($main_category['category_name']); ?></h2>

    <?php if ($subcategories_result->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Subcategory Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $subcategories_result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['subcategory_name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="edit_subcategory.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete_subcategory.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this subcategory?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No subcategories found for this category.</p>
    <?php } ?>

    <br>
    <a href="subcategory_form.php?category_id=<?php echo $category_id; ?>">Add New Subcategory</a>
    <br>
    <a href="category_list.php">Back to Categories</a> <!-- Link back to the main categories page -->
</body>
</html>

<?php
$stmt->close();
$subcategories_stmt->close();
$conn->close();
?>
