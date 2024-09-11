<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
</head>
<body>

<?php
$pageTitle = 'Homepage'; 
include 'header.php'; 
?>

<!-- Product Introduction Section -->
<section class="container-fluid custom-bg-image py-5">
    <div class="container">
        <!-- Two Columns: Image and Product Details -->
        <div class="row align-items-center mb-5">
            <!-- Product Image Column -->
            <div class="col-md-6 order-md-2 text-center">
                <img src="/tech_web/assets/pixel-8.png" alt="Google Pixel 8" class="img-fluid rounded custom-image">
            </div>

            <!-- Product Details Column -->
            <div class="col-md-6 order-md-1 ps-md-5">
                <h2 class="display-3 fw-bolder fs-8 text-gradient mb-4 mt-4">Google Pixel 8</h2>
                <p class="lead text-dark">
                    Experience the future with the Google Pixel 8, featuring a vibrant 6.2-inch OLED display, cutting-edge Tensor G3 chip, and a powerful 50MP camera system.
                    Designed with a sleek, modern aesthetic and built to last with all-day battery life and 5G connectivity, the Pixel 8 delivers exceptional performance and seamless integration with Google Assistant.
                    Embrace a new era of technology with a device that combines style, power, and intelligent features for an unparalleled smartphone experience.
                </p>

                <!-- Product Features Section -->
                <div class="row text-start mt-4 g-3"> 
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-battery-charging text-gradient me-3" style="font-size: 2.5rem;"></i>
                            <div>
                                <h5 class="fw-bold">All-Day Battery</h5>
                                <p class="text-muted">Up to 24 hours of usage on a single charge.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-cpu text-gradient me-3" style="font-size: 2.5rem;"></i>
                            <div>
                                <h5 class="fw-bold">Tensor G3 Chip</h5>
                                <p class="text-muted">High-performance processor for seamless multitasking.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-motherboard text-gradient me-3" style="font-size: 2.5rem;"></i>
                            <div>
                                <h5 class="fw-bold">Sleek Design</h5>
                                <p class="text-muted">Modern, ergonomic design with premium materials.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-camera text-gradient me-3" style="font-size: 2.5rem;"></i>
                            <div>
                                <h5 class="fw-bold">50MP Camera</h5>
                                <p class="text-muted">Capture stunning photos with high-resolution clarity.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shop Now Button -->
                <div class="text-center text-md-start mt-4">
                    <a href="#" class="btn btn-red text-white px-4 py-2 fw-normal">Shop Now</a>
                </div>
            </div>
        </div>

        <!-- Six Columns: Additional Features -->
        <div class="row text-center py-3 bg-white d-none d-lg-flex">
            <div class="col-md-2">
                <div class="d-flex align-items-start justify-content-center">
                    <i class="bi bi-truck text-gradient me-3" style="font-size: 2.5rem;"></i>
                    <div>
                        <h6 class="fw-bold">Free Delivery</h6>
                        <p class="text-muted small">On all orders over $100</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 border-left">
                <div class="d-flex align-items-start justify-content-center">
                    <i class="bi bi-credit-card text-gradient me-3" style="font-size: 2.5rem;"></i>
                    <div>
                        <h6 class="fw-bold">Safe Payment</h6>
                        <p class="text-muted small">100% secure payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 border-left">
                <div class="d-flex align-items-start justify-content-center">
                    <i class="bi bi-telephone text-gradient me-3" style="font-size: 2.5rem;"></i>
                    <div>
                        <h6 class="fw-bold">Help Center</h6>
                        <p class="text-muted small">24 x 7 Support</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 border-left">
                <div class="d-flex align-items-start justify-content-center">
                    <i class="bi bi-arrow-return-left text-gradient me-3" style="font-size: 2.5rem;"></i>
                    <div>
                        <h6 class="fw-bold">Free Returns</h6>
                        <p class="text-muted small">No Questions Asked</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 border-left">
                <div class="d-flex align-items-start justify-content-center">
                    <i class="bi bi-rocket text-gradient me-3" style="font-size: 2.5rem;"></i>
                    <div>
                        <h6 class="fw-bold">Fast Shipping</h6>
                        <p class="text-muted small">In 2-3 days</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 border-left">
                <div class="d-flex align-items-start justify-content-center">
                    <i class="bi bi-emoji-smile text-gradient me-3" style="font-size: 2.5rem;"></i>
                    <div>
                        <h6 class="fw-bold">Happy Customers</h6>
                        <p class="text-muted small">12k+ Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Discover and Shop By Category Section -->
<section class="container py-5">
    <div class="row mb-4">
        <div class="col-12 mb-5 text-center">

            <a href="#" class="btn btn-danger text-white btn-sm mb-2 custom-discover">Discover</a>
            <h2 class="fw-bold mb-2">SHOP BY CATEGORY</h2>
            <p class="text-muted">We add new products every day, Explore our great range of products.</p>
        </div>
    </div>
    <div class="row mt-4">

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="/tech_web/assets/com_acc.png" class="card-img-top" alt="Category 1">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Computers and Accessories</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Subtitle 1</h6>
                    <a href="#" class="btn btn-custom-outline">View Products</a>                
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="/tech_web/assets/sma_tab.png" class="card-img-top" alt="Category 2">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Smartphones and Tablets</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Subtitle 2</h6>
                    <a href="#" class="btn btn-custom-outline">View Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="/tech_web/assets/tv_audio.png" class="card-img-top" alt="Category 3">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">TV, Video & Audio</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Subtitle 3</h6>
                    <a href="#" class="btn btn-custom-outline">View Products</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- New Section with Product Image -->
<section class="container-fluid bg-image-section py-5">
    <div class="container">
        <div class="row">

            <div class="col-md-6 d-flex align-items-center justify-content-center order-1 order-md-2 mb-4 mb-md-0">
                <img src="/tech_web/assets/smartwatch.png" alt="Smart Fitness Band" class="img-fluid rounded">
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center order-2 order-md-1">
                <div class="text-white">
                    <h5 class="fw-bold text-white mb-3">New Features</h5>
                    
                    <h2 class="display-4 fw-bold">Smart Fitness Band</h2>
                    <p class="lead">The smartwatch features a 1.4-inch AMOLED display, offering vibrant clarity and up to 10 days of battery life. It includes comprehensive health monitoring with heart rate, SpO2, and sleep tracking, plus support for over 100 workout modes. With Bluetooth 5.0, GPS, and compatibility with Android and iOS, it keeps you connected with notifications and offers NFC for payments.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <p><i class="bi bi-check-circle text-white"></i> 24x7 customer support</p>
                            <p><i class="bi bi-check-circle text-white"></i> Cash on delivery</p>
                            <p><i class="bi bi-check-circle text-white"></i> 30 days replacement</p>
                            <p><i class="bi bi-check-circle text-white"></i> Fast delivery</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="bi bi-check-circle text-white"></i> 12k+ happy customers</p>
                            <p><i class="bi bi-check-circle text-white"></i> 100% secure payment</p>
                            <p><i class="bi bi-check-circle text-white"></i> Quality products</p>
                            <p><i class="bi bi-check-circle text-white"></i> Easy returns</p>
                        </div>
                    </div>
                    
                    <div class="text-center text-md-start mt-4">
                        <a href="#" class="btn-red text-white px-4 py-2 fw-normal" >Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid py-4">
    <!-- New Container with Icon and Shop By Category Section -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 mb-5 text-center">
                <div class="d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background-color: #ff4d4d;">
                    <i class="bi bi-people-fill" style="font-size: 2rem; color: #ffffff;"></i>
                </div>
                <h2 class="fw-bold mb-2 mt-3">Shop at <span class="custom-red">Best Price</span></h2>
                <p class="text-muted">Experience the future of technology with our revolutionary device.</p>
            </div>
        </div>

        <div class="container py-5">
    <div class="d-flex overflow-auto">
        <div class="d-flex flex-nowrap mx-auto">
            <div class="col-auto me-2">
                <button class="btn btn-custom-rec mb-3">Computers and Accessories</button>
            </div>
            <div class="col-auto me-2">
                <button class="btn btn-custom-rec mb-3">Smartphones and Tablets</button>
            </div>
            <div class="col-auto me-2">
                <button class="btn btn-custom-rec mb-3">TV, Video, and Audio</button>
            </div>
        </div>
    </div>
</div>
<!-- New Row with four columns for products -->
<div class="container-fluid py-5">
  <div class="row">

      <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 position-relative">
        <div class="position-relative">
          <img src="/tech_web/assets/applecore15.png" class="card-img-top" alt="Device Image">
          <button class="btn btn-danger btn-cart-custom">
            <i class="bi bi-cart-plus"></i>
          </button>
        </div>
        <div class="card-body">
          <h6 class="text-muted">Desktop PC's</h6>
          <h5 class="card-title">Apple Core 15</h5>
          <div class="d-flex justify-content-between align-items-center">
            <p class="card-text mb-0">$Price: 600.00</p>
            <div class="star-rating">★★★★☆</div>
          </div>

          <div class="d-flex mt-2">
            <div class="rounded-circle bg-primary" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-secondary" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-danger" style="width: 20px; height: 20px;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 position-relative">
        <div class="position-relative">
          <img src="/tech_web/assets/procore15.png" class="card-img-top" alt="Device Image">
          <button class="btn btn-danger btn-cart-custom">
            <i class="bi bi-cart-plus"></i>
          </button>
        </div>
        <div class="card-body">
          <h6 class="text-muted">Laptops</h6>
          <h5 class="card-title">Apple Macbook Pro Core i5</h5>
          <div class="d-flex justify-content-between align-items-center">
            <p class="card-text mb-0">$Price</p>
            <div class="star-rating">★★★★☆</div>
          </div>

          <div class="d-flex mt-2">
            <div class="rounded-circle bg-primary" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-secondary" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-warning" style="width: 20px; height: 20px;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 position-relative">
        <div class="position-relative">
          <img src="/tech_web/assets/imac_pro.png" class="card-img-top" alt="Device Image">
          <button class="btn btn-danger btn-cart-custom">
            <i class="bi bi-cart-plus"></i>
          </button>
        </div>
        <div class="card-body">
          <h6 class="text-muted">Desktop Pc'</h6>
          <h5 class="card-title">Apple iMac Pro</h5>
          <div class="d-flex justify-content-between align-items-center">
            <p class="card-text mb-0">$Price: 600</p>
            <div class="star-rating">★★★★☆</div>
          </div>

          <div class="d-flex mt-2">
            <div class="rounded-circle bg-dark" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-light" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-info" style="width: 20px; height: 20px;"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fourth Column -->
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 position-relative">
        <div class="position-relative">
          <img src="/tech_web/assets/hp_printer.png" class="card-img-top" alt="Device Image">
          <button class="btn btn-danger btn-cart-custom">
            <i class="bi bi-cart-plus"></i>
          </button>
        </div>
        <div class="card-body">
          <h6 class="text-muted">Printers</h6>
          <h5 class="card-title">Hp Multi-Function Printer</h5>
          <div class="d-flex justify-content-between align-items-center">
            <p class="card-text mb-0">$Price: 200</p>
            <div class="star-rating">★★★★☆</div>
          </div>
          <!-- Color Scheme Circles -->
          <div class="d-flex mt-2">
            <div class="rounded-circle bg-primary" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-danger" style="width: 20px; height: 20px; margin-right: 5px;"></div>
            <div class="rounded-circle bg-success" style="width: 20px; height: 20px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- Sale Section -->
<div class="container-fluid sale-section position-relative">
  <div class="row text-center text-dark py-5 position-absolute top-0 start-50 translate-middle-x">
    <div class="col-12 mt-4">
      <p class="h5 mb-2">Hurry up!</p>
      <h1 class="display-4 fw-bold">HUGE SALE!</h1>
      <p class="h5 mb-4 fw-bold">Up to 20% off on all products.</p>
      <a href="#" class="btn btn-red text-white px-4 py-2 mt-4 fw-normal" >Shop Now</a>
    </div>
  </div>
</div>

<!-- On Sale Products Section -->
        <div class="container">
          <div class="row">
         <!-- Super Deals Section -->
<div class="col-lg-6 mb-4">
  <div class="text-center mb-3">
    <img src="/tech_web/assets/superdeal.png" class="img-fluid" alt="Super Deals">
  </div>
  <div class="border rounded p-3">
    <div class="d-flex flex-column flex-md-row">
      <!-- Image Container -->
      <div class="col-md-5 mb-3 me-2 mb-md-0">
        <img src="/tech_web/assets/galaxys10.png" class="img-fluid fixed-size-img" alt="Product Image">
      </div>
      <!-- Text Content -->
      <div class="col-md-7 position-relative">
        <button class="btn-add-to-cart btn btn-primary position-absolute top-0 end-0">
          <i class="bi bi-cart"></i>
        </button>
        <h6 class="text-muted">SMARTPHONES</h6>
        <h5 class="fw-bold">Samsung Galaxy S10</h5>
        <div class="d-flex align-items-center mb-2">
          <div class="star-rating me-2">★★★★☆</div>
          <p class="mb-0 fw-bold">$320.00</p>
        </div>
        <p class="text-muted">
          The Samsung Galaxy S10 offers a stunning 6.1-inch QHD+ AMOLED display and a powerful Exynos 9820 processor. With a triple-camera system and an all-day battery, it’s designed to deliver top-notch performance and an exceptional user experience. Ideal for capturing high-quality photos and enjoying immersive multimedia content.
        </p>
        <p class="fw-bold">Hurry up! Limited time offer.</p>
        <!-- Countdown Timer -->
        <div class="countdown-timer d-flex justify-content-between mt-3 mb-3">
          <div class="countdown-item text-center">
            <div class="circle">00</div>
            <div class="label">Days</div>
          </div>
          <div class="countdown-item text-center">
            <div class="circle">00</div>
            <div class="label">Hours</div>
          </div>
          <div class="countdown-item text-center">
            <div class="circle">00</div>
            <div class="label">Minutes</div>
          </div>
          <div class="countdown-item text-center">
            <div class="circle">00</div>
            <div class="label">Seconds</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

            <!-- Featured Products Section -->
            <div class="col-lg-6">
              <div class="text-center mb-3">
                <img src="/tech_web/assets/featured_products.png" class="img-fluid" alt="Featured Products">
              </div>
              <div class="row">
              <!-- Product Card 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 text-center">
            <img src="/tech_web/assets/home_theater.png" class="card-img-top fixed-size-img" alt="Product Image">
            <div class="card-body d-flex flex-column justify-content-between">
            <div class="fixed-height-div">
                <p class="text-muted fixed-height-text">HOME THEATERS</p>
                <h5 class="fw-bold">120 W Home Theater</h5>
                <p class="text-danger">$248.00</p>
              </div>
              <button class="btn btn-red mt-1">
                <i class="bi bi-cart-plus me-2"></i>Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Product Card 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 text-center">
            <img src="/tech_web/assets/galaxy_fit.png" class="card-img-top fixed-size-img img-fluid" alt="Product Image">
            <div class="card-body d-flex flex-column justify-content-between">
            <div class="fixed-height-div">
                <p class="text-muted">FITNESS TRACKERS</p>
                <h5 class="fw-bold">Galaxy Fit e Smart Band</h5>
                <p class="text-danger">$140.65</p>
              </div>
              <button class="btn btn-red mt-1">
                <i class="bi bi-cart-plus me-2"></i>Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Product Card 3 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 text-center">
            <img src="/tech_web/assets/ipad_7th_gen.png" class="card-img-top fixed-size-img" alt="Product Image">
            <div class="card-body d-flex flex-column justify-content-between">
            <div class="fixed-height-div">
              <p class="text-muted">TABLETS</p>
              <h5 class="fw-bold">Apple iPad 7th Gen</h5>
              <p class="text-danger">$334.88</p>
            </div>
              <button class="btn btn-red mt-1">
                <i class="bi bi-cart-plus me-2"></i>Add to Cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Shop by brand -->
<section class="container my-5">
    <div class="text-center mb-3">
        <img src="/tech_web/assets/shop_by_brand.png" class="img-fluid" alt="Shop by Brand">
    </div> 

    <div class="row text-center">
        <div class="col-6 col-md-3 mb-4">
            <img src="/tech_web/assets/canon.png" alt="Canon" class="img-fluid rounded">
        </div>
        <div class="col-6 col-md-3 mb-4">
            <img src="/tech_web/assets/micromax.png" alt="Micromax" class="img-fluid rounded">
        </div>
        <div class="col-6 col-md-3 mb-4">
            <img src="/tech_web/assets/samsung.png" alt="Samsung" class="img-fluid rounded">
        </div>
        <div class="col-6 col-md-3 mb-4">
            <img src="/tech_web/assets/sennheiser.png" alt="Sennheiser" class="img-fluid rounded">
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>