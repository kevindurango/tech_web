<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $brand_id = $_GET['id'];

    // Fetch brand details
    $sql = "SELECT * FROM brands WHERE id = $brand_id";
    $result = mysqli_query($conn, $sql);
    $brand = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brand</title>
</head>
<body>
    <h1>Edit Brand</h1>
    <form action="update_brand.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $brand['id']; ?>">

        <label for="brand_name">Brand Name:</label>
        <input type="text" id="brand_name" name="brand_name" value="<?php echo $brand['brand_name']; ?>" required>

        <label for="brand_logo">Brand Logo:</label>
        <input type="file" id="brand_logo" name="brand_logo">
        <img src="<?php echo $brand['logo_url']; ?>" alt="<?php echo $brand['brand_name']; ?> logo" style="max-height: 50px;">

        <label for="brand_description">Description:</label>
        <textarea id="brand_description" name="brand_description" rows="4" required><?php echo $brand['description']; ?></textarea>

        <button type="submit">Update Brand</button>
    </form>
</body>
</html>
