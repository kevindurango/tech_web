<?php

include 'db_connect.php';

$sql = "SELECT * FROM Products";
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
                <th>Brand</th>
                <th>Name</th>
                <th>Warranty</th>
                <th>Price</th>
                <th>Discounted Price</th>
                <th>Original Price</th>
                <th>Discount (%)</th>
                <th>Rating</th>
                <th>Reviews</th>
                <th>Storage Options</th>
                <th>Color Options</th>
                <th>Special Offer</th>
                <th>Bank Offer</th>
                <th>Membership Offer</th>
                <th>Terms & Conditions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($product = $result->fetch_assoc()) {

        $name = isset($product['name']) && !empty($product['name']) ? htmlspecialchars($product['name']) : 'N/A';
        $brand = isset($product['brand']) && !empty($product['brand']) ? htmlspecialchars($product['brand']) : 'N/A';
        $warranty = isset($product['warranty']) && !empty($product['warranty']) ? htmlspecialchars($product['warranty']) : 'N/A';
        $price = isset($product['original_price']) && !empty($product['original_price']) ? number_format($product['original_price'], 2) : 'N/A';
        $discounted_price = isset($product['discounted_price']) && !empty($product['discounted_price']) ? number_format($product['discounted_price'], 2) : 'N/A';
        $discount_percentage = isset($product['discount_percentage']) && !empty($product['discount_percentage']) ? $product['discount_percentage'] : 'N/A';
        $rating = isset($product['rating']) && !empty($product['rating']) ? number_format($product['rating'], 1) : 'N/A';
        $review_count = isset($product['review_count']) && !empty($product['review_count']) ? $product['review_count'] : 'N/A';
        $storage_options = isset($product['storage_options']) && !empty($product['storage_options']) ? htmlspecialchars($product['storage_options']) : 'N/A';
        $color_options = isset($product['color_options']) && !empty($product['color_options']) ? htmlspecialchars($product['color_options']) : 'N/A';
        $special_offer = isset($product['special_offer']) && !empty($product['special_offer']) ? htmlspecialchars($product['special_offer']) : 'N/A';
        $bank_offer = isset($product['bank_offer']) && !empty($product['bank_offer']) ? htmlspecialchars($product['bank_offer']) : 'N/A';
        $membership_offer = isset($product['membership_offer']) && !empty($product['membership_offer']) ? htmlspecialchars($product['membership_offer']) : 'N/A';
        $terms_conditions = isset($product['terms_conditions']) && !empty($product['terms_conditions']) ? htmlspecialchars($product['terms_conditions']) : 'N/A';
        $image_url = isset($product['image_url']) && !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : 'no_image.png';

        echo '
            <tr>
                <td><img src="/tech_web/assets/products/' . $image_url . '" alt="' . $name . '" class="product-image" style="width: 100px; height: auto;"></td>
                <td>' . $brand . '</td>
                <td>' . $name . '</td>
                <td>' . $warranty . '</td>
                <td class="text-danger">$' . $price . '</td>
                <td class="text-success">$' . $discounted_price . '</td>
                <td class="text-muted text-decoration-line-through">$' . $price . '</td>
                <td>' . $discount_percentage . '%</td>
                <td>' . $rating . ' <i class="bi bi-star-fill text-warning"></i></td>
                <td>' . $review_count . ' reviews</td>
                <td>' . $storage_options . '</td>
                <td>' . $color_options . '</td>
                <td>' . $special_offer . '</td>
                <td>' . $bank_offer . '</td>
                <td>' . $membership_offer . '</td>
                <td>' . $terms_conditions . '</td>
                <td><a href="product_page.php?id=' . $product['id'] . '" class="btn btn-primary">View Details</a></td>
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
