<?php
include 'db_connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
    <h2>Add New Product</h2>
    <form action="submit_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="sku">SKU:</label>
        <input type="text" id="sku" name="sku" required><br><br>

        <label for="short_description">Short Description:</label>
        <textarea id="short_description" name="short_description" required></textarea><br><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required><br><br>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description"></textarea><br><br>

        <label for="feature_product">Feature Product:</label>
        <input type="checkbox" id="feature_product" name="feature_product"><br><br>

        <label for="categories">Select Categories:</label>
        <select id="categories" name="categories[]" multiple required>
            <?php
            $result = $conn->query("SELECT id, category_name FROM Categories");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
            }
            ?>
        </select><br><br>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <label for="attributes">Select Attributes:</label>
        <select id="attributes" name="attributes[]" multiple>
            <?php
            $attr_result = $conn->query("SELECT id, attribute_name FROM Attributes");
            while ($attr_row = $attr_result->fetch_assoc()) {
                
                $value_result = $conn->query("SELECT id, value FROM Attribute_Values WHERE attribute_id = " . $attr_row['id']);
                echo "<optgroup label='" . htmlspecialchars($attr_row['attribute_name']) . "'>";
                while ($value_row = $value_result->fetch_assoc()) {
                    echo "<option value='" . $value_row['id'] . "'>" . htmlspecialchars($value_row['value']) . "</option>";
                }
                echo "</optgroup>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Add Product">
    </form>

    <script>
        $(document).ready(function() {
            $('#attributes').select2({
                placeholder: 'Select Attributes',
                allowClear: true
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
