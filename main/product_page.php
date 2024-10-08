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
include 'header.php';
include '../web/db_connection.php'; 

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Default to 1 if not set

// Fetch product details
$product_query = "SELECT * FROM products WHERE id = ?";
$product_stmt = $conn->prepare($product_query);
$product_stmt->bind_param("i", $product_id);
$product_stmt->execute();
$product_result = $product_stmt->get_result();
$product = $product_result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Fetch product images
$images_query = "SELECT * FROM images WHERE product_id = ?";
$images_stmt = $conn->prepare($images_query);
$images_stmt->bind_param("i", $product_id);
$images_stmt->execute();
$images_result = $images_stmt->get_result();

// Fetch major attributes including storage and color options
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

// Fetch categories for the current product
$categories_query = "SELECT c.id, c.category_name 
                     FROM product_categories pc 
                     JOIN categories c ON pc.category_id = c.id 
                     WHERE pc.product_id = ?";
$categories_stmt = $conn->prepare($categories_query);
$categories_stmt->bind_param("i", $product_id);
$categories_stmt->execute();
$categories_result = $categories_stmt->get_result();

// Fetch tags from the attributes if applicable
$tags = [];
foreach ($attributes as $attribute) {
    if ($attribute['attribute_name'] === 'tags') {
        $tags[] = htmlspecialchars($attribute['value']);
    }
}

// Fetch similar products
$similar_products_query = "
    SELECT p.id, p.name, p.price, p.original_price, c.category_name, i.image_path 
    FROM products p 
    JOIN product_categories pc ON p.id = pc.product_id 
    JOIN categories c ON pc.category_id = c.id 
    JOIN images i ON p.id = i.product_id 
    WHERE pc.category_id IN (
        SELECT category_id 
        FROM product_categories 
        WHERE product_id = ?)
    AND p.id != ? 
    GROUP BY p.id
    LIMIT 3";

$similar_products_stmt = $conn->prepare($similar_products_query);
$similar_products_stmt->bind_param("ii", $product_id, $product_id);
$similar_products_stmt->execute();
$similar_products_result = $similar_products_stmt->get_result();

// Close the database connection
$conn->close();
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
                            $isActive = ''; // Set to empty after the first iteration
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
                        <span style="color: red; font-size: 1rem;">&lt;</span>
                        <i class="bi bi-grid text-danger mx-2" style="font-size: 1rem;"></i>
                        <span style="color: red; font-size: 1rem;">&gt;</span>
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
                        // Display storage attributes dynamically
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

                <div class="product-info mt-2">
                    <div class="container">
                        <div class="row align-items-start">
                            <div class="col-4 col-md-2 text-center pe-3">
                                <img src="/tech_web/assets/apple-logo.png" alt="Apple Logo" class="apple-logo">
                            </div>
                            <div class="col-8 col-md-10 ps-4">
                                <p class="mb-1 mt-2"><strong>Apple</strong></p>
                                <p class="fw-normal">This is a genuine product of Brand. The product comes with a standard brand warranty of 1 year.</p>
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
            <?php if ($similar_products_result->num_rows > 0): ?>
                <?php while ($product = $similar_products_result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card"> <!-- Added h-100 to make cards equal height -->
                            <img src="<?php echo htmlspecialchars($product['image_path']); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 style="object-fit: cover; height: 200px;"> <!-- Set image height -->
                            <div class="card-body d-flex flex-column"> <!-- Use flex column to manage space -->
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($product['category_name']); ?></h6> 
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text mt-auto"> <!-- Use mt-auto to push pricing to the bottom -->
                                    <span class="text-danger">$<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></span> 
                                    <span class="text-muted text-decoration-line-through">$<?php echo htmlspecialchars(number_format($product['original_price'], 2)); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-muted">No similar products found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>
