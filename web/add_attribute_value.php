<?php
include 'db_connection.php';
include_once 'productattribute.php'; // Use the new class name

$productAttribute = new productattribute($conn); // Instantiate using the new class name

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attribute_id = $_POST['attribute_id'];
    $value = $_POST['value'];

    // Call the method to add the attribute value
    $resultMessage = $productAttribute->addAttributeValue($attribute_id, $value);

    echo htmlspecialchars($resultMessage); // Output success/error message
}

// Fetch attributes from the database for the dropdown
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
    <title>Add New Value</title>
</head>
<body>
    <h2>Add New Value to Attribute</h2>
    <form action="add_attribute_value.php" method="POST">
        <label for="attribute_id">Select Attribute:</label>
        <select id="attribute_id" name="attribute_id" required>
            <option value="">--Select Attribute--</option>
            <?php while ($row = $attributes_result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['attribute_name']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="value">Value:</label>
        <input type="text" id="value" name="value" required>
        <input type="submit" value="Add Value">
    </form>
    <br>
    <a href="attribute_list.php">Back to Attributes List</a>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
