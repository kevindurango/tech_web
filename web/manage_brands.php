<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Brands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <h1>Manage Brands</h1>

    <!-- Brands Table -->
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>Logo</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connection.php';
            include '../classes/brandmanager.php';

            $brandManager = new brandmanager($conn);
            
            $sql = "SELECT * FROM brands";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['brand_name']}</td>
                        <td><img src='{$row['logo_url']}' alt='{$row['brand_name']} logo' style='height: 50px; width: auto;'></td>
                        <td>{$row['description']}</td>
                        <td>
                            <button onclick=\"window.location.href='edit_brand.php?id={$row['id']}'\"><i class='fas fa-edit'></i> Edit</button>
                            <button onclick=\"deleteBrand({$row['id']})\"><i class='fas fa-trash-alt'></i> Delete</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No brands found</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <!-- Form to Add New Brand -->
    <div>
        <h2>Add New Brand</h2>
        <form action="add_brand.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="brand_name">Brand Name:</label>
                <input type="text" id="brand_name" name="brand_name" required>
            </div>
            <div>
                <label for="brand_logo">Brand Logo:</label>
                <input type="file" id="brand_logo" name="brand_logo" required>
            </div>
            <div>
                <label for="brand_description">Description:</label>
                <textarea id="brand_description" name="brand_description" rows="4" required></textarea>
            </div>
            <button type="submit">Add Brand</button>
        </form>
    </div>

    <!-- JavaScript to handle the delete action -->
    <script>
        function deleteBrand(brandId) {
            if (confirm("Are you sure you want to delete this brand?")) {
                window.location.href = 'delete_brand.php?id=' + brandId;
            }
        }
    </script>
</body>
</html>
