<?php

$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "ecommerce_db";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $short_description = $_POST['short_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];
    $discount_percentage = $_POST['discount'];
    $rating = $_POST['rating'];
    $review_count = $_POST['review_count'];
    $storage_options = $_POST['storage_options'];
    $color_options = $_POST['color_options'];
    $special_offer = $_POST['special_offer'];
    $bank_offer = $_POST['bank_offer'];
    $membership_offer = $_POST['membership_offer'];
    $featured = isset($_POST['featured']) ? 1 : 0;

    $image_url = '';
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/"; 
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $image_url = $target_file;
    }

    $sql = "INSERT INTO products (name, SKU, short_description, price, discounted_price, discount_percentage, 
            rating, review_count, storage_options, color_options, 
            featured, image_url, description, special_offer, bank_offer, membership_offer) 
            VALUES ('$name', '$sku', '$short_description', '$original_price', '$discounted_price', 
            '$discount_percentage', '$rating', '$review_count', '$storage_options', '$color_options', 
            '$featured', '$image_url', '$description', '$special_offer', '$bank_offer', '$membership_offer')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); 
?>
