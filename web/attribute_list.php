<?php
include 'db_connection.php'; // Include the database connection file

$sql = "SELECT id, attribute_name FROM Attributes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attribute List</title>
    <script>
        function confirmDelete(attributeName) {
            return confirm("Are you sure you want to delete the attribute '" + attributeName + "'?");
        }
    </script>
</head>
<body>
    <h2>Attribute Names</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Attribute Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['attribute_name']); ?></td>
                        <td>
                            <a href="attribute_values.php?id=<?php echo $row['id']; ?>">View Values</a> |
                            <a href="delete_attribute.php?id=<?php echo $row['id']; ?>" 
                               onclick="return confirmDelete('<?php echo htmlspecialchars($row['attribute_name']); ?>');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No attributes found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="add_attribute.php">Add New Attribute</a>
</body>
</html>

<?php
$conn->close();
?>
