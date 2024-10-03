<?php
include 'Database.php';
include 'Product_Attribute.php'; 

$db = new Database();
$conn = $db->getConnection();

$attribute = new ProductAttribute($conn); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attributeName = $_POST['attribute_name'];
    $attributeValues = $_POST['attribute_values']; 

    if (!empty($attributeName) && !empty($attributeValues)) {

        if ($attribute->addAttribute($attributeName, $attributeValues)) {
            header("Location: add_attribute.php?msg=Attribute added successfully");
            exit();
        } else {
            echo "Error adding attribute.";
        }
    } else {
        echo "Please fill in both fields.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Attribute</title>
</head>
<body>
    <h1>Add New Attribute</h1>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <form action="add_attribute.php" method="post">
        <label for="attribute_name">Attribute Name:</label>
        <input type="text" name="attribute_name" required><br>

        <label for="attribute_values">Attribute Values (comma-separated):</label>
        <input type="text" name="attribute_values" required><br>

        <input type="submit" value="Add Attribute">
    </form>
    <a href="product_list.php">Back to Product List</a>
</body>
</html>
