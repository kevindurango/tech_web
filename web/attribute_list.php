<?php
include 'db_connection.php';
include '../classes/productattribute.php';

$productAttribute = new productattribute($conn); // Instantiate the class

// Fetch attributes from the database
$attributes_result = $conn->query("SELECT id, attribute_name FROM Attributes");

if (!$attributes_result) {
    die("Error fetching attributes: " . $conn->error); // Handle query error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attribute List</title>
</head>
<body>
    <h2>Attribute List</h2>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Attribute Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $attributes_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['attribute_name']); ?></td>
                <td>
                    <a href="attribute_values.php?id=<?php echo $row['id']; ?>">View Values</a>
                    | 
                    <a href="edit_attribute.php?id=<?php echo $row['id']; ?>">Edit</a> <!-- Link to edit attribute -->
                    | 
                    <a href="delete_attribute.php?id=<?php echo $row['id']; ?>" 
                       onclick="return confirm('Are you sure you want to delete this attribute? This will also delete related values.');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    
    <br>
    <a href="add_attribute.php">Add New Attribute</a> <!-- Link to add attribute -->
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
