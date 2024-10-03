<?php
include 'Database.php';
include 'Product_Attribute.php';
include 'Product_Attribute_Value.php';

$db = new Database();
$conn = $db->getConnection();

$attribute = new ProductAttribute($conn);

$attributesResult = $attribute->getAllAttributes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attribute List</title>
</head>
<body>
    <h1>Attribute List</h1>
    <a href="add_attribute.php">Add New Attribute</a>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>Attribute Name</th>
                <th>Attribute Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($attributesResult->num_rows > 0): ?>
                <?php while ($attributeRow = $attributesResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($attributeRow['attribute_name']); ?></td>
                        <td><?php echo htmlspecialchars($attributeRow['value']); ?></td>
                        <td>
                            <a href="edit_attribute_value.php?id=<?php echo $attributeRow['value_id']; ?>">Edit</a>
                            <a href="delete_attribute_value.php?id=<?php echo $attributeRow['value_id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this attribute value?');">Delete Value</a>
                            <a href="delete_attribute.php?id=<?php echo $attributeRow['attribute_id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this attribute and its values?');">Delete Name and Value</a>
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
</body>
</html>
