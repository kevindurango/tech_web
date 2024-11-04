<?php
include 'db_connection.php';
include 'ProductAttribute.php'; // Use the ProductAttribute class

$productAttribute = new ProductAttribute($conn); // Create an instance

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $valueData = $productAttribute->getAttributeValueById($id); // Fetch attribute value details

    if (!$valueData) {
        die("Attribute value not found.");
    }
} else {
    die("Invalid request.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attribute_id = $_POST['attribute_id'];
    $value = $_POST['value'];
    $resultMessage = $productAttribute->editAttributeValue($id, $attribute_id, $value); // Call the update method

    // Redirect back to attribute values page
    header("Location: attribute_values.php?id=" . $attribute_id . "&message=" . urlencode($resultMessage));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attribute Value</title>
</head>
<body>
    <h2>Edit Attribute Value</h2>
    <form action="edit_attribute_value.php?id=<?php echo $id; ?>" method="POST">
        <input type="hidden" name="attribute_id" value="<?php echo htmlspecialchars($valueData['attribute_id']); ?>">
        <label for="value">Value:</label>
        <input type="text" id="value" name="value" value="<?php echo htmlspecialchars($valueData['value']); ?>" required>
        <input type="submit" value="Update Value">
    </form>
    <br>
    <a href="attribute_values.php?id=<?php echo htmlspecialchars($valueData['attribute_id']); ?>">Back to Attribute Values</a>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
