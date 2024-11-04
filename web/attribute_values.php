<?php
include 'db_connection.php';
include 'ProductAttribute.php'; // Include the ProductAttribute class

$productAttribute = new ProductAttribute($conn); // Create an instance

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $attribute = $productAttribute->getAttributeById($id); // Fetch attribute details

    if (!$attribute) {
        die("Attribute not found.");
    }

    $result = $productAttribute->getAttributeValues($id); // Fetch attribute values
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attribute Values for <?php echo htmlspecialchars($attribute['attribute_name']); ?></title>
</head>
<body>
    <h2>Values for <?php echo htmlspecialchars($attribute['attribute_name']); ?></h2>
    
    <a href="add_attribute_value.php?id=<?php echo $id; ?>">Add New Value</a>
    <br><br>
    
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Value</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?> <!-- Check if $result is valid -->
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['value']); ?></td>
                        <td>
                            <a href="edit_attribute_value.php?id=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="delete_attribute_value.php?id=<?php echo $row['id']; ?>&attribute_id=<?php echo $id; ?>" 
                               onclick="return confirm('Are you sure you want to delete this value?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No values found for this attribute.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="attribute_list.php">Back to Attributes List</a>
</body>
</html>

<?php
$productAttribute->closeConnection(); // Close the connection
?>
