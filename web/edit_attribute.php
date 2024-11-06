<?php
include 'db_connection.php';
include '../classes/productattribute.php';

$productAttribute = new productattribute($conn); // Instantiate the class

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $attribute = $productAttribute->getAttributeById($id); // Fetch current attribute data

    if (!$attribute) {
        die("Attribute not found.");
    }
} else {
    die("Invalid request.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attribute_name = $_POST['attribute_name'];
    $resultMessage = $productAttribute->updateAttribute($id, $attribute_name); // Call the update method
    echo htmlspecialchars($resultMessage);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attribute</title>
</head>
<body>
    <h2>Edit Attribute</h2>
    <form action="edit_attribute.php?id=<?php echo $id; ?>" method="POST">
        <label for="attribute_name">Attribute Name:</label>
        <input type="text" id="attribute_name" name="attribute_name" value="<?php echo htmlspecialchars($attribute['attribute_name']); ?>" required>
        <input type="submit" value="Update Attribute">
    </form>
    <br>
    <a href="attribute_list.php">Back to Attributes List</a>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
