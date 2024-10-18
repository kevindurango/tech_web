<?php
include 'db_connection.php'; 

$result = $conn->query("SELECT * FROM categories"); // Note: Changed to lowercase 'categories' for consistency
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <style>
        /* Optional: Style the icon to fit nicely */
        .category-icon {
            width: 30px; /* Set the width of the icon */
            height: 30px; /* Set the height of the icon */
            margin-right: 10px; /* Space between icon and text */
        }
    </style>
</head>
<body>
    <h2>Category List</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Icon</th> <!-- New header for the icon -->
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <?php if (!empty($row['icon_path'])): ?> <!-- Check if the icon path is not empty -->
                    <img src="<?php echo htmlspecialchars($row['icon_path']); ?>" alt="<?php echo htmlspecialchars($row['category_name']); ?>" class="category-icon">
                <?php else: ?>
                    No Icon
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($row['category_name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td>
                <a href="edit_category.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete_category.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a> |
                <a href="category_values.php?category_id=<?php echo $row['id']; ?>">View Products</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="category_form.php">Add New Category</a>
</body>
</html>

<?php
$conn->close();
?>
