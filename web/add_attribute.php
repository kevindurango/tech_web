<?php
include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attribute_name = $_POST['attribute_name'];

    $stmt = $conn->prepare("INSERT INTO Attributes (attribute_name) VALUES (?)");
    $stmt->bind_param("s", $attribute_name);

    if ($stmt->execute()) {
        echo "New attribute created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
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
    <form action="attribute.php" method="POST">
        <label for="attribute_name">Attribute Name:</label>
        <input type="text" id="attribute_name" name="attribute_name" required>
        <input type="submit" value="Add Attribute">
    </form>
    <br>
    <a href="attribute_list.php">Back to Attributes List</a>
</body>
</html>

<?php
$conn->close();
?>
