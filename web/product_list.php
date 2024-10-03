<?php
include 'Database.php';
include 'Product.php';

$db = new Database();
$conn = $db->getConnection();

$product = new Product($conn);

$sql = "SELECT p.*, i.image_url 
        FROM products p 
        LEFT JOIN images i ON p.id = i.product_id"; 

$products = $conn->query($sql);

echo '<a href="add_product.php" class="btn btn-success">Add New Product</a>'; // Button to add new product

if ($products && $products->num_rows > 0) {
    echo '<table class="table table-striped">';
    echo '
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Short Description</th>
                <th>Price</th>
                <th>Featured</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($row = $products->fetch_assoc()) {
        $name = htmlspecialchars($row['name']);
        $sku = htmlspecialchars($row['sku']);
        $short_description = htmlspecialchars($row['short_description']);
        $price = number_format($row['price'], 2);
        $featured = $row['featured'] ? 'Yes' : 'No';
        
        $image_url = isset($row['image_url']) ? htmlspecialchars($row['image_url']) : 'no_image.png';

        echo '
            <tr>
                <td><img src="/tech_web/assets/products/' . $image_url . '" alt="' . $name . '" class="product-image" style="width: 100px; height: auto;"></td>
                <td>' . $name . '</td>
                <td>' . $sku . '</td>
                <td>' . $short_description . '</td>
                <td class="text-danger">$' . $price . '</td>
                <td>' . $featured . '</td>
                <td>
                    <a href="/tech_web/web/product_details.php?id=' . $row['id'] . '" class="btn btn-primary">View Details</a>
                    <a href="/tech_web/web/edit_product.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                    <a href="/tech_web/web/delete_product.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</a>
                </td>
            </tr>
        ';
    }

    echo '</tbody></table>';
} else {
    echo 'No products found.';
}
?>
