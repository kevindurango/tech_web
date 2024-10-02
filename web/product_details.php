<?php
include 'Database.php';
include 'Product.php';

$db = new Database();
$conn = $db->getConnection();

$product = new Product($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetails = $product->getProductById($id); 

    if ($productDetails) {
        $image_url = !empty($productDetails['image_url']) ? htmlspecialchars($productDetails['image_url']) : 'no_image.png'; 
        $name = htmlspecialchars($productDetails['name']);
        $sku = htmlspecialchars($productDetails['sku']);
        $short_description = htmlspecialchars($productDetails['short_description']);
        $price = number_format($productDetails['price'], 2);
        $featured = $productDetails['featured'] ? 'Yes' : 'No';

        echo '
        <h1>' . $name . '</h1>
        <img src="/tech_web/assets/products/' . $image_url . '" alt="' . $name . '" style="width: 200px; height: auto;">
        <p><strong>SKU:</strong> ' . $sku . '</p>
        <p><strong>Short Description:</strong> ' . $short_description . '</p>
        <p><strong>Price:</strong> $' . $price . '</p>
        <p><strong>Featured:</strong> ' . $featured . '</p>
        <a href="product_list.php" class="btn btn-secondary">Back to Product List</a>
        ';
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}
?>
