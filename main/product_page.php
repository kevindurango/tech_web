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
$pageTitle = 'product_page'; 
include 'header.php'; 
?>

<!-- Product Image Carousel Section -->
<section class="product-section mt-4">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/tech_web/assets/iphone13.png" class="d-block w-100" alt="Product Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/tech_web/assets/iphone13-2.png" class="d-block w-100" alt="Product Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="/tech_web/assets/iphone13-3.png" class="d-block w-100" alt="Product Image 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <img src="/tech_web/assets/iphone13.png" class="img-thumbnail mx-1" alt="Thumbnail 1" data-bs-target="#productCarousel" data-bs-slide-to="0">
                    <img src="/tech_web/assets/iphone13-2.png" class="img-thumbnail mx-1" alt="Thumbnail 2" data-bs-target="#productCarousel" data-bs-slide-to="1">
                    <img src="/tech_web/assets/iphone13-3.png" class="img-thumbnail mx-1" alt="Thumbnail 3" data-bs-target="#productCarousel" data-bs-slide-to="2">
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-house-door-fill me-2"></i>
                    <span class="mx-2">/</span>
                    <span class="text-danger fw-semibold">Shop</span>
                    <span class="mx-2">/</span>
                    <span class="fw-semibold">Apple iPhone 13</span>

                    <div class="d-flex align-items-center ms-auto">
                        <span style="color: red; font-size: 1rem;">&lt;</span>
                        <i class="bi bi-grid text-danger mx-2" style="font-size: 1rem;"></i>
                        <span style="color: red; font-size: 1rem;">&gt;</span>
                    </div>

                </div>

                <h3 class="mb-2">Apple iPhone 13</h3>

                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <span>4.5 (200 reviews)</span>
                </div>

                <p class="mb-3">The iPhone 13 features a stunning display, advanced camera system, and powerful A15 Bionic chip. It offers a sleek design, improved battery life, and a range of exciting colors.</p>

                <div class="mb-3">
                    <span class="text-danger fw-bold fs-5 me-2">Original Price: $999</span>
                    <span class="text-muted text-decoration-line-through fs-5 me-2">$899</span>
                    <span class="text-success fw-semibold" style="color: orange;">(8% off)</span>
                </div>

                <hr class="my-4">
                <div class="mb-3">
                    <h5>Storage</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-storage">8 GB + 128 GB</button>
                        <button class="btn btn-storage">16 GB + 256 GB</button>
                    </div>
                </div>

                <div class="mb-3">
                    <h5>Color</h5>
                    <div class="d-flex gap-2">
                        <div class="color-option bg-danger"></div>
                        <div class="color-option bg-purple"></div>
                        <div class="color-option bg-dark"></div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 text-start w-100">
                    <i class="bi bi-envelope-fill text-danger me-2"></i>
                    <span>Get notified when back in stock</span>
                </div>
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-clock me-1"></i> Save for later
                </button>

                <div class="mt-4">

                    <hr class="my-4">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-gift text-danger me-2"></i>
                            <span>Special Offer: Get mi smart speaker on purchase of selected devices. <a href="#" class="text-danger">Details ></a></span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-bank text-danger me-2"></i>
                            <span>Bank Offer: Extra 5% off on credit cards. <a href="#" class="text-danger">Details ></a></span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-badge text-danger me-2"></i>
                            <span>Membership: Get prime membership for extra discount. <a href="#" class="text-danger">Details ></a></span>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="mb-4">
                        <p class="mb-1"><strong>SKU:</strong> Prime244400</p>
                        <p class="mb-1"><strong>Tags:</strong> Gadget, Exclusive, Storage, Best, Device, Electric.</p>
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
                        <p>Here are the terms and conditions related to the purchase and usage of the product.</p>
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
        </div>
    </div>
</section>
 <!-- navigation bar-->
<section class="product-navigation mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs justify-content-center border-bottom border-gray">
                    <li class="nav-item">
                        <a class="nav-link active" href="#description" data-bs-toggle="tab">
                            <i class="bi bi-file-text"></i> Description
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#specifications" data-bs-toggle="tab">
                            <i class="bi bi-gear"></i> Specifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#documents" data-bs-toggle="tab">
                            <i class="bi bi-file-earmark-text"></i> Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews" data-bs-toggle="tab">
                            <i class="bi bi-star"></i> Reviews & Rating
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#shipping" data-bs-toggle="tab">
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
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <i class="bi bi-music-note-beamed text-danger" style="font-size: 2rem;"></i>
            <h5 class="mt-2">Dolby Atmos</h5>
            <p class="text-muted">Enjoy immersive sound with Dolby Atmos technology for a cinematic audio experience.</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <i class="bi bi-wifi text-danger" style="font-size: 2rem;"></i>
            <h5 class="mt-2">Wi-Fi</h5>
            <p class="text-muted">Fast and reliable Wi-Fi connectivity for seamless internet access.</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <i class="bi bi-bluetooth text-danger" style="font-size: 2rem;"></i>
            <h5 class="mt-2">Bluetooth 5.3</h5>
            <p class="text-muted">Latest Bluetooth technology for enhanced wireless connectivity and efficiency.</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <i class="bi bi-tv text-danger" style="font-size: 2rem;"></i>
            <h5 class="mt-2">Ultra 4K Ready</h5>
            <p class="text-muted">Supports Ultra HD 4K resolution for crisp and vibrant display quality.</p>
        </div>
    </div>
</div>

<section class="similar-products mt-4 mb-3" >
    <div class="container-fluid">
        <hr class="my-4">
        <div class="row mb-4">
            <div class="col-12 text-start">
                <h3 class="text-left">Similar Products</h3>
                <div class="underline"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="/tech_web/assets/product-ipad-7thgen.png" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Tablet</h6> 
                        <h5 class="card-title">Apple iPad 7th Gen</h5>
                        <p class="card-text">
                            <span class="text-danger">$334</span> 
                            <span class="text-muted text-decoration-line-through">$364</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="/tech_web/assets/apple-iphone-11.png" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6> 
                        <h5 class="card-title">Apple iPhone 11</h5>
                        <p class="card-text">
                            <span class="text-danger">$349</span> 
                            <span class="text-muted text-decoration-line-through">$449</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                        <h5 class="card-title">Samsung Galaxy A16</h5>
                        <p class="card-text">
                            <span class="text-danger">$299</span> 
                            <span class="text-muted text-decoration-line-through">$399</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>
