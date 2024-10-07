<?php
include 'db_connection.php'; 

$result = $conn->query("SELECT * FROM Categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
</head>
<body>
    <h2>Category List</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
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
