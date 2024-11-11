<?php
session_start();
include 'db_connection.php';
include '../classes/imagemanager.php';

if (isset($_GET['id'])) {
    $image_id = (int)$_GET['id'];

    $imageManager = new ImageManager($conn);

    $image_data = $imageManager->getImageById($image_id);
    
    if (!$image_data) {
        die("Image not found.");
    }

    $current_image_path = $image_data['image_path'];
    $product_id = $image_data['product_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
        $resultMessage = $imageManager->updateImage($image_id, $product_id, $_FILES['image']);
        echo $resultMessage; 
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Image</title>
</head>
<body>
    <h2>Edit Image</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Current Image:</label><br>
        <img src="<?php echo htmlspecialchars($current_image_path); ?>" alt="Current Image" width="200"><br><br>
        <label for="image">Upload New Image:</label>
        <input type="file" name="image" required>
        <input type="submit" value="Update Image">
    </form>
    <br>
    <a href="image_management.php?id=<?php echo $product_id; ?>">Back to Image Management</a>
</body>
</html>

<?php
$conn->close();
?>
