<?php

include 'db_connect.php';

$sql = "SELECT p.*, i.image_url FROM products p
        LEFT JOIN images i ON p.id = i.product_id"; 
$result = $conn->query($sql);

if (!$result) {
    die("Database query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo '<table class="table table-striped">';
    echo '
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Short Description</th>
                <th>Price</th>
                <th>Feature Product</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($product = $result->fetch_assoc()) {
        $name = isset($product['name']) && !empty($product['name']) ? htmlspecialchars($product['name']) : 'N/A';
        $sku = isset($product['sku']) && !empty($product['sku']) ? htmlspecialchars($product['sku']) : 'N/A'; 
        $short_description = isset($product['short_description']) && !empty($product['short_description']) ? htmlspecialchars($product['short_description']) : 'N/A';
        $price = isset($product['price']) && !empty($product['price']) ? number_format($product['price'], 2) : 'N/A';
        $featured = $product['featured'] ? 'Yes' : 'No';

        $image_url = isset($product['image_url']) && !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : 'no_image.png';

        echo '
            <tr>
                <td><img src="/tech_web/assets/products/' . $image_url . '" alt="' . $name . '" class="product-image" style="width: 100px; height: auto;"></td>
                <td>' . $name . '</td>
                <td>' . $sku . '</td>
                <td>' . $short_description . '</td>
                <td class="text-danger">$' . $price . '</td>
                <td>' . $featured . '</td>
                <td><a href="/tech_web/main/product_page.php?id=' . $product['id'] . '" class="btn btn-primary">View Details</a></td>
            </tr>
        ';
    }

    echo '
        </tbody>
    </table>';
} else {
    echo 'No products found.';
}

$conn->close();

?>
