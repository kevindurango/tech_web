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

        <!-- Brand selection -->
        <label for="brand">Select Brand:</label>
        <select id="brand" name="brand_id" required>
            <option value="">Select a Brand</option>
            <?php
            $brand_result = $conn->query("SELECT id, brand_name FROM brands");
            while ($brand_row = $brand_result->fetch_assoc()) {
                echo "<option value='" . $brand_row['id'] . "'>" . htmlspecialchars($brand_row['brand_name']) . "</option>";
            }
            ?>
        </select><br><br>

        <!-- Categories selection -->
        <label for="categories">Select Categories:</label>
        <select id="categories" name="categories[]" multiple required>
            <?php
            $result = $conn->query("SELECT id, category_name FROM categories");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
            }
            ?>
        </select><br><br>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <!-- Product Variation Selection -->
        <label for="product_variation">Select Product Variation:</label>
        <select id="product_variation" name="product_variation_id" required>
            <option value="">Select a Product Variation</option>
            <?php
            $variations_result = $conn->query("SELECT id, category_name FROM categories WHERE parent_id IS NOT NULL");
            while ($variation = $variations_result->fetch_assoc()) {
                echo "<option value='" . $variation['id'] . "'>" . htmlspecialchars($variation['category_name']) . "</option>";
            }
            ?>
        </select><br><br>

        <!-- Attributes selection -->
        <label for="attributes">Select Attributes:</label>
        <select id="attributes" name="attributes[]" multiple required>
            <?php
            $attr_result = $conn->query("SELECT id, attribute_name FROM attributes");
            while ($attr_row = $attr_result->fetch_assoc()) {
                $value_result = $conn->query("SELECT id, value FROM attribute_values WHERE attribute_id = " . $attr_row['id']);
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

    <div id="category-path" style="display: none;"></div>

    <script>
        $(document).ready(function() {
            // Initialize select2 for better UI
            $('#attributes').select2({
                placeholder: 'Select attributes',
                allowClear: true
            });

            $('#categories').select2({
                placeholder: 'Select categories',
                allowClear: true
            });

            $('#product_variation').select2({
                placeholder: 'Select product variation',
                allowClear: true
            });

            $('#brand').select2({
                placeholder: 'Select brand',
                allowClear: true
            });

            // AJAX call to fetch category path when product variation is selected
            $('#product_variation').on('change', function() {
                var variation_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'fetch_category_path.php',
                    data: { variation_id: variation_id },
                    success: function(response) {
                        $('#category-path').html(response).show();
                    }
                });
            });
        });
    </script>
</body>
</html>
