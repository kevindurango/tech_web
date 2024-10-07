<?php

include 'db_connection.php';

$product_id = 1;

$product_query = "SELECT * FROM products WHERE id = $product_id";
$product_result = $conn->query($product_query);
$product = $product_result->fetch_assoc();

$images_query = "SELECT * FROM images WHERE product_id = $product_id";
$images_result = $conn->query($images_query);

$attributes_query = "SELECT a.attribute_name, av.value 
                     FROM product_attributes pa 
                     JOIN attribute_values av ON pa.attribute_value_id = av.id 
                     JOIN attributes a ON av.attribute_id = a.id 
                     WHERE pa.product_id = $product_id";
$attributes_result = $conn->query($attributes_query);

$attributes = [];
while ($attribute = $attributes_result->fetch_assoc()) {
    $attributes[] = $attribute;
}

$categories_query = "SELECT c.id, c.category_name 
                     FROM product_categories pc 
                     JOIN categories c ON pc.category_id = c.id 
                     WHERE pc.product_id = $product_id";
$categories_result = $conn->query($categories_query);

$tags = [];
foreach ($attributes as $attribute) {
    if ($attribute['attribute_name'] === 'tags') {
        $tags[] = htmlspecialchars($attribute['value']);
    }
}

$similar_products_query = "SELECT p.id, p.name, p.price, p.original_price, c.category_name, i.image_path 
                           FROM products p 
                           JOIN product_categories pc ON p.id = pc.product_id 
                           JOIN categories c ON pc.category_id = c.id 
                           JOIN images i ON p.id = i.product_id 
                           WHERE pc.category_id IN (SELECT category_id FROM product_categories WHERE product_id = $product_id) 
                           AND p.id != $product_id";
$similar_products_result = $conn->query($similar_products_query);

$conn->close();
?>
