<?php
include 'db_connection.php';

// Fetch all main categories to populate the parent category dropdown
function fetchMainCategories() {
    global $conn;
    $categories = [];
    $stmt = $conn->prepare("SELECT id, category_name FROM Categories WHERE parent_id IS NULL ORDER BY category_name");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    $stmt->close();
    return $categories;
}

// Fetch subcategories based on the selected parent category
function fetchSubcategories($parent_id) {
    global $conn;
    $subcategories = [];
    $stmt = $conn->prepare("SELECT id, category_name FROM Categories WHERE parent_id = ? ORDER BY category_name");
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $subcategories[] = $row;
    }
    $stmt->close();
    return $subcategories;
}

// Handle the AJAX request to fetch subcategories
if (isset($_GET['parent_id'])) {
    $parent_id = intval($_GET['parent_id']);
    echo json_encode(fetchSubcategories($parent_id));
    exit;
}

$main_categories = fetchMainCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sub-Subcategory</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Add Sub-Subcategory</h2>
    <form action="insert_subsubcategory.php" method="POST">
        <label for="parent_id">Select Parent Category:</label>
        <select id="parent_id" name="parent_id" required>
            <option value="">Select a category</option>
            <?php foreach ($main_categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>">
                    <?php echo htmlspecialchars($cat['category_name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="subcategory_id">Select Subcategory:</label>
        <select id="subcategory_id" name="subcategory_id" required disabled>
            <option value="">Select a subcategory</option>
        </select><br><br>

        <label for="category_name">Sub-Subcategory Name:</label>
        <input type="text" id="category_name" name="category_name" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <input type="submit" value="Add Sub-Subcategory">
    </form>

    <script>
        $(document).ready(function() {
            $('#parent_id').change(function() {
                var parentId = $(this).val();
                if (parentId) {
                    // Fetch subcategories via AJAX
                    $.ajax({
                        url: 'add_subsubcategory.php',
                        type: 'GET',
                        data: { parent_id: parentId },
                        success: function(data) {
                            var subcategories = JSON.parse(data);
                            $('#subcategory_id').empty().append('<option value="">Select a subcategory</option>');
                            $.each(subcategories, function(index, subcategory) {
                                $('#subcategory_id').append('<option value="' + subcategory.id + '">' + subcategory.category_name + '</option>');
                            });
                            $('#subcategory_id').prop('disabled', false);
                        }
                    });
                } else {
                    $('#subcategory_id').prop('disabled', true).empty().append('<option value="">Select a subcategory</option>');
                }
            });
        });
    </script>
</body>
</html>
