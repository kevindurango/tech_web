<?php
include 'db_connection.php'; 
include '../classes/category.php';

$categoryManager = new category($conn);
$main_categories_result = $categoryManager->fetchMainCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List with Filter</title>
    <style>
        .category-level { margin-left: 20px; }
        .expand-btn { cursor: pointer; color: blue; text-decoration: underline; }
        .subcategories { display: none; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Category List with Filter</h2>

    <label for="parent-category-filter">Filter by Product Line:</label>
    <select id="parent-category-filter">
        <option value="">Show All Product Lines</option>
        <?php while ($main_category = $main_categories_result->fetch_assoc()) { ?>
            <option value="<?php echo $main_category['id']; ?>">
                <?php echo htmlspecialchars($main_category['category_name']); ?>
            </option>
        <?php } ?>
    </select>

    <label for="product-type-filter">Filter by Product Type:</label>
    <select id="product-type-filter" disabled>
        <option value="">Select a Product Line first</option>
    </select>

    <table border="1" id="category-table">
        <tr>
            <th>ID</th>
            <th>Name (Product Type)</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </table>

    <br>
    <a href="category_form.php">Add New Product Type</a>

    <script>
        $(document).ready(function() {
            fetchCategories();

            $('#parent-category-filter').change(function() {
                var parentId = $(this).val();
                fetchCategories(parentId);
                fetchProductTypes(parentId);
            });

            $('#product-type-filter').change(function() {
                var parentId = $('#parent-category-filter').val();
                var productTypeId = $(this).val();
                fetchCategories(parentId, productTypeId);
            });

            function fetchCategories(parentId = '', productTypeId = '') {
                $.ajax({
                    url: 'fetch_categories.php',
                    type: 'GET',
                    data: { 
                        parent_id: parentId, 
                        product_type_id: productTypeId 
                    },
                    success: function(response) {
                        $('#category-table').html(response);
                    }
                });
            }

            function fetchProductTypes(parentId) {
                $.ajax({
                    url: 'fetch_product_types.php',
                    type: 'GET',
                    data: { parent_id: parentId },
                    success: function(response) {
                        $('#product-type-filter').html(response).prop('disabled', false);
                    }
                });
            }

            $(document).on('click', '.expand-btn', function() {
                var categoryId = $(this).data('id');
                var subcategoryRow = $('#subcategories-' + categoryId);

                if (subcategoryRow.is(':visible')) {
                    subcategoryRow.hide();
                    $(this).html('&#9654;');
                } else {
                    if (subcategoryRow.find('td').html().trim() === '') {
                        $.ajax({
                            url: 'fetch_subcategories.php',
                            type: 'GET',
                            data: { parent_id: categoryId },
                            success: function(response) {
                                subcategoryRow.find('td').html(response);
                            }
                        });
                    }
                    subcategoryRow.show();
                    $(this).html('&#9660;'); 
                }
            });
        });
    </script>
</body>
</html>

<?php
$categoryManager->closeConnection();
?>
