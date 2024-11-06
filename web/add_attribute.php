<?php
include 'db_connection.php';
include '../classes/productattribute.php';

$productAttribute = new productattribute($conn); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attribute_name = $_POST['attribute_name'];

    // Call the method to add the attribute
    $resultMessage = $productAttribute->addAttribute($attribute_name);
    $successMessage = htmlspecialchars($resultMessage); // Sanitize the output for safety
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Attribute</title>
</head>
<body>
    <h2>Add New Attribute</h2>
    
    <!-- Display success message if set -->
    <?php if (isset($successMessage)): ?>
        <p><?php echo $successMessage; ?></p>
    <?php endif; ?>
    
    <form action="add_attribute.php" method="POST">
        <label for="attribute_name">Attribute Name:</label>
        <input type="text" id="attribute_name" name="attribute_name" required>
        <input type="submit" value="Add Attribute">
    </form>
    <br>
    <a href="attribute_list.php">Back to Attributes List</a>
</body>
</html>

<?php
$productAttribute->closeConnection(); // Close the database connection
?>
