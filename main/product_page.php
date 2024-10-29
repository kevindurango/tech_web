<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> product page </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">  
    <link rel="stylesheet" href="/tech_web/styles/product.css">
</head>
<body>

<?php
class Product
{
    private $id;
    private $name;
    private $sku;
    private $short_description;
    private $price;
    private $product_description;
    private $feature_product;
    private $brand_id;
    private $attributes;
    private $image_path;

    // Constructor
    public function __construct($name, $sku, $short_description, $price, $product_description, $feature_product, $brand_id, $attributes = [], $image_path = null)
    {
        $this->name = $name;
        $this->sku = $sku;
        $this->short_description = $short_description;
        $this->price = $price;
        $this->product_description = $product_description;
        $this->feature_product = $feature_product;
        $this->brand_id = $brand_id;
        $this->attributes = $attributes;
        $this->image_path = $image_path;
    }

    // Method to submit a new product
    public function submitProduct($conn, $categories)
    {
        $stmt = $conn->prepare("INSERT INTO products (name, SKU, short_description, price, product_description, feature_product, brand_id, main_image_url) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdssss", $this->name, $this->sku, $this->short_description, $this->price, $this->product_description, $this->feature_product, $this->brand_id, $this->image_path);

        if ($stmt->execute()) {
            $product_id = $stmt->insert_id;

            foreach ($categories as $category_id) {
                $stmt_category = $conn->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
                $stmt_category->bind_param("ii", $product_id, $category_id);
                $stmt_category->execute();
                $stmt_category->close();
            }

            if (!empty($this->attributes)) {
                foreach ($this->attributes as $attribute_value_id) {
                    $stmt_attribute = $conn->prepare("INSERT INTO product_attributes (product_id, attribute_value_id) VALUES (?, ?)");
                    $stmt_attribute->bind_param("ii", $product_id, $attribute_value_id);
                    $stmt_attribute->execute();
                    $stmt_attribute->close();
                }
            }

            $stmt->close();
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    // Method to update product details
    public function updateProduct($product_id, $conn)
    {
        $update_product_query = "UPDATE products SET name = ?, SKU = ?, short_description = ?, price = ?, 
            product_description = ?, feature_product = ?, brand_id = ? WHERE id = ?";
        $stmt = $conn->prepare($update_product_query);
        $stmt->bind_param("sssdssii", $this->name, $this->sku, $this->short_description, $this->price, $this->product_description, $this->feature_product, $this->brand_id, $product_id);

        if (!$stmt->execute()) {
            echo "Error updating product: " . $stmt->error;
            return false;
        }
        $stmt->close();
        return true;
    }

    // Method to get major attributes
    public function getMajorAttributes($conn, $product_id)
    {
        $major_features = ['Dolby Atmos', 'Wi-Fi', 'Bluetooth 5.3', 'Ultra 4K Ready', 'Storage', 'Color'];
        $major_features_placeholders = implode("','", array_map(function($feature) use ($conn) {
            return mysqli_real_escape_string($conn, $feature);
        }, $major_features));

        $attributes_query = "SELECT a.attribute_name, av.value 
                             FROM product_attributes pa 
                             JOIN attribute_values av ON pa.attribute_value_id = av.id 
                             JOIN attributes a ON av.attribute_id = a.id 
                             WHERE pa.product_id = ? 
                             AND a.attribute_name IN ('$major_features_placeholders')";

        $attributes_stmt = $conn->prepare($attributes_query);
        $attributes_stmt->bind_param("i", $product_id);
        $attributes_stmt->execute();
        $attributes_result = $attributes_stmt->get_result();

        $attributes = [];
        while ($attribute = $attributes_result->fetch_assoc()) {
            $attributes[] = $attribute;
        }

        return $attributes;
    }

    // Method to delete a product
    public function deleteProduct($product_id, $conn)
    {
        $conn->query("DELETE FROM product_categories WHERE product_id = $product_id");
        $conn->query("DELETE FROM product_attributes WHERE product_id = $product_id");

        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error deleting product: " . $stmt->error;
            return false;
        }
    }

    // Method to get all products
    public static function getAllProducts($conn)
    {
        $sql = "SELECT id, name, SKU, short_description, price, product_description, feature_product, main_image_url FROM products";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return [];
    }
}
?>


<!-- Product Image Carousel Section -->
<section class="product-section mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                        $isActive = 'active';
                        while ($image = $images_result->fetch_assoc()) {
                            echo '<div class="carousel-item ' . $isActive . '">';
                            echo '<img src="' . $image['image_path'] . '" class="d-block w-100" alt="Product Image">';
                            echo '</div>';
                            $isActive = ''; 
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev carousel-control-prev-circle" href="#productCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next carousel-control-next-circle" href="#productCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <?php
                    // Generate thumbnails
                    $images_result->data_seek(0); // Reset pointer to fetch again
                    while ($image = $images_result->fetch_assoc()) {
                        echo '<img src="' . $image['image_path'] . '" class="img-thumbnail mx-1" alt="Thumbnail" data-bs-target="#productCarousel" data-bs-slide-to="0">';
                    }
                    ?>
                </div>
            </div>

            <!-- Product details -->
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-house-door-fill me-2"></i>
                    <span class="mx-2">/</span>
                    <span class="text-danger fw-semibold">Shop</span>
                    <span class="mx-2">/</span>
                    <span class="fw-semibold"><?php echo $product['name']; ?></span>
                    <div class="d-flex align-items-center ms-auto">
                        <?php if ($prev_product): ?>
                            <a href="product_page.php?id=<?php echo $prev_product['id']; ?>" class="text-decoration-none">
                                <span style="color: red; font-size: 1rem;">&lt;</span>
                            </a>
                        <?php else: ?>
                            <!-- If no previous product, show disabled arrow or hide -->
                            <span style="color: gray; font-size: 1rem;">&lt;</span>
                        <?php endif; ?>

                        <i class="bi bi-grid text-danger mx-2" style="font-size: 1rem;"></i>

                        <?php if ($next_product): ?>
                            <a href="product_page.php?id=<?php echo $next_product['id']; ?>" class="text-decoration-none">
                                <span style="color: red; font-size: 1rem;">&gt;</span>
                            </a>
                        <?php else: ?>
                            <!-- If no next product, show disabled arrow or hide -->
                            <span style="color: gray; font-size: 1rem;">&gt;</span>
                        <?php endif; ?>
                    </div>
                </div>

                <h3 class="mb-2"><?php echo $product['name']; ?></h3>

                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-half text-warning me-2"></i>
                    <span>4.5 (200 reviews)</span>
                </div>

                <p class="mb-3"><?php echo $product['short_description']; ?></p>

                <div class="mb-3">
                    <span class="text-danger fw-bold fs-5 me-2">Original Price: $<?php echo number_format($product['original_price'], 2); ?></span>
                    <span class="text-muted text-decoration-line-through fs-5 me-2">$<?php echo number_format($product['price'], 2); ?></span>
                    <span class="text-success fw-semibold" style="color: orange;">(<?php echo round((($product['original_price'] - $product['price']) / $product['original_price']) * 100); ?>% off)</span>
                </div>

                <hr class="my-4">

                <div class="mb-3">
                <h5>Storage</h5>
                    <div class="d-flex gap-2">
                        <?php

                            foreach ($attributes as $attribute) {
                            if ($attribute['attribute_name'] === 'Storage') {
                                echo '<button class="btn btn-storage">' . htmlspecialchars($attribute['value']) . '</button>';
                            }
                        }
                        ?>
                    </div>

                <div class="mb-3">
                    <h5>Color</h5>
                    <div class="d-flex gap-2">
                        <?php
                        // Fetch color attributes dynamically
                        $attributes_result->data_seek(0); // Reset pointer to fetch again
                        while ($attribute = $attributes_result->fetch_assoc()) {
                            if ($attribute['attribute_name'] == 'Color') {
                                echo '<div class="color-option" style="background-color: ' . strtolower($attribute['value']) . ';"></div>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 text-start w-100">
                    <i class="bi bi-envelope-fill text-danger me-2"></i>
                    <span class="text-danger">Get notified when back in stock</span>
                </div>

                <button class="save-for-later-button">
                    <i class="bi bi-clock me-1"></i> Save for later
                </button>

                <hr class="my-4">


                <!-- Product Display Section -->
                <div class="product-info mt-2">
                    <div class="container">
                        <div class="row align-items-start">
                            <div class="col-4 col-md-2 text-center pe-3">
                                <img src="/tech_web/web/<?php echo htmlspecialchars($product['logo_url']); ?>" 
                                    alt="<?php echo htmlspecialchars($product['brand_name']); ?> Logo" style="max-height: 50px; width: auto;">
                            </div>
                            <div class="col-8 col-md-10 ps-4">
                                <p class="mb-1 mt-2"><strong><?php echo htmlspecialchars($product['brand_name']); ?></strong></p>
                                <p class="fw-normal"><?php echo htmlspecialchars($product['brand_description']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-gift" style="color: #e00; margin-right: 0.5rem;"></i>
                        <span>
                            <span style="color: #ff4d4d;">Special Offer:</span> Get a mi smart speaker on purchase of selected devices. 
                            <a href="#" style="color: #e00; text-decoration: none;">Details ></a>
                        </span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-bank" style="color: #e00; margin-right: 0.5rem;"></i>
                        <span>
                            <span style="color: #ff4d4d;">Bank Offer:</span> Extra 5% off on credit cards. 
                            <a href="#" style="color: #e00; text-decoration: none;">Details ></a>
                        </span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-person-badge" style="color: #e00; margin-right: 0.5rem;"></i>
                        <span>
                            <span style="color: #ff4d4d;">Membership:</span> Get prime membership for extra discount. 
                            <a href="#" style="color: #e00; text-decoration: none;">Details ></a>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="mb-1"><strong>SKU:</strong> <?php echo htmlspecialchars($product['SKU']); ?></p>
                    <p class="mb-1"><strong>Tags:</strong> <?php echo implode(', ', $tags); ?></p>
                </div>

                <div class="mb-4">
                    <span class="fw-semibold">Share:</span>
                    <a href="#" class="text-dark mx-1"><i class="bi bi-facebook" style="color: #3b5998;"></i></a>
                    <a href="#" class="text-dark mx-1"><i class="bi bi-twitter" style="color: #1da1f2;"></i></a>
                    <a href="#" class="text-dark mx-1"><i class="bi bi-pinterest" style="color: #e60023;"></i></a>
                    <a href="#" class="text-dark mx-1"><i class="bi bi-envelope" style="color: #000000;"></i></a>
                </div>

                <div class="mb-4">
                    <h5>Terms and Conditions:</h5>
                </div>

        <div class="container product-terms mt-4">
                    <div class="row">
                        <div class="col-12 term-image-column">
                            <img src="/tech_web/assets/term1.png" class="img-fluid term-image" alt="Term Image 1">
                            <img src="/tech_web/assets/term2.png" class="img-fluid term-image" alt="Term Image 2">
                            <img src="/tech_web/assets/term3.png" class="img-fluid term-image" alt="Term Image 3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- navigation bar-->
 <section class="product-navigation mt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
 
            <ul class="custom-nav-tabs">
        <li class="nav-item">
            <a class="custom-nav-link" href="#description">
            <i class="bi bi-file-text"></i> Description
            </a>
        </li>
        <li class="nav-item">
            <a class="custom-nav-link" href="#specifications">
            <i class="bi bi-gear"></i> Specifications
            </a>
        </li>
        <li class="nav-item">
            <a class="custom-nav-link" href="#documents">
            <i class="bi bi-file-earmark-text"></i> Documents
            </a>
        </li>
        <li class="nav-item">
            <a class="custom-nav-link" href="#reviews">
            <i class="bi bi-star"></i> Reviews & Rating
            </a>
        </li>
        <li class="nav-item">
            <a class="custom-nav-link" href="#shipping">
            <i class="bi bi-truck"></i> Shipping & Delivery
            </a>
        </li>
        </ul>

                <div class="row mt-5">
                    <div class="col-12 mb-5 text-center">
                        <a href="#" class="btn btn-danger text-white btn-sm mb-2 custom-discover">Discover</a>
                        <h2 class="fw-bold mb-2">Featured Products</h2>
                        <p class="text-muted">We add new products every day, Explore our great range of products.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container mb-4 mt-5">
    <div class="row">
        <?php
        // Assume $attributes contains the major features from the database
        $major_features = [
            "Dolby Atmos" => [
                "icon" => "bi-music-note-beamed",
                "description" => "Enjoy immersive sound with Dolby Atmos technology for a cinematic audio experience."
            ],
            "Wi-Fi" => [
                "icon" => "bi-wifi",
                "description" => "Fast and reliable Wi-Fi connectivity for seamless internet access."
            ],
            "Bluetooth 5.3" => [
                "icon" => "bi-bluetooth",
                "description" => "Latest Bluetooth technology for enhanced wireless connectivity and efficiency."
            ],
            "Ultra 4K Ready" => [
                "icon" => "bi-tv",
                "description" => "Supports Ultra HD 4K resolution for crisp and vibrant display quality."
            ]
        ];

        foreach ($major_features as $feature => $details) {
            echo '<div class="col-lg-3 col-md-6 text-center mb-4">';
            echo '<i class="bi ' . $details['icon'] . ' text-danger" style="font-size: 2rem;"></i>';
            echo '<h5 class="mt-2">' . htmlspecialchars($feature) . '</h5>';
            echo '<p class="text-muted">' . htmlspecialchars($details['description']) . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<section class="similar-products mt-4">
    <div class="container">
        <hr class="my-4">
        <div class="row mb-4">
            <div class="col-12 text-start">
                <h3 class="text-left">Similar Products</h3>
                <div class="underline"></div>
            </div>
        </div>
        <div class="row">
            <?php
            // Check if any similar products were found
            if ($similar_products_result && $similar_products_result->num_rows > 0) {
                // Loop through similar products
                while ($similar_product = $similar_products_result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($similar_product['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($similar_product['name']); ?>">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($similar_product['category_name']); ?></h6> 
                                <h5 class="card-title"><?php echo htmlspecialchars($similar_product['name']); ?></h5>
                                <p class="card-text mt-auto">
                                    <span class="text-danger">$<?php echo number_format($similar_product['price'], 2); ?></span> 
                                    <span class="text-muted text-decoration-line-through">$<?php echo number_format($similar_product['original_price'], 2); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No similar products found.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>
