<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Header with Search and Icons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
</head>
<body>
<!-- First Header Section: Country Dropdown and Social Links -->
<header class="bg-dark py-1 px-4">
    <div class="container-fluid">
        <div class="row align-items-center">

            <div class="col d-flex align-items-center">
                <div class="dropdown me-3 ps-4 pe-5">
                    <button class="btn btn-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="countryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/us.svg');"></div>
                        <span class="text-white">US</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="countryDropdown">

                    </ul>
                </div>
                <span class="text-white ps-5">Free returns. Standard shipping. Orders $99</span>
            </div>

            <div class="col d-flex justify-content-between align-items-center">

                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link text-white small" href="#">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">Terms</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">FAQ</a></li>
                    </ul>
                </nav>

                <div>
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-github"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Second Header Section: Search Bar and Icons -->
<header class="bg-white py-2 border-bottom">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <!-- Search Form Column -->
            <div class="col-md-6 d-flex justify-content-end">
                <form class="d-flex w-50">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-light d-flex align-items-center border-0" type="submit">
                        <i class="bi bi-search text-gray"></i>
                    </button>
                </form>
            </div>
            <!-- Icons and Texts Column -->
            <div class="col-md-6 d-flex justify-content-end">
                <!-- My Cart -->
                <div class="d-flex align-items-center mx-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-cart"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">My Cart</div>
                        <div class="fs-6 fw-bold">$0.00</div>
                    </div>
                </div>
                <!-- My Wishlist -->
                <div class="d-flex align-items-center mx-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">My Wishlist</div>
                        <div class="fs-6 fw-bold">View Wishlist</div>
                    </div>
                </div>
                <!-- Guest Account -->
                <div class="d-flex align-items-center ms-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">Guest</div>
                        <div class="fs-6 fw-bold">My Account</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Navigation Section -->
<section class="container-fluid py-3 bg-white border-bottom">
    <div class="row text-center align-items-center">

        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-grid me-1"></i> Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <li><a class="dropdown-item" href="#">Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Category 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Home</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Shop</a>
        </div>

        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="popularDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Popular
                </a>
                <ul class="dropdown-menu" aria-labelledby="popularDropdown">
                    <li><a class="dropdown-item" href="#">Popular Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="trendingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Trending
                </a>
                <ul class="dropdown-menu" aria-labelledby="trendingDropdown">
                    <li><a class="dropdown-item" href="#">Trending Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Trending Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Trending Item 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="collectionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Collection
                </a>
                <ul class="dropdown-menu" aria-labelledby="collectionDropdown">
                    <li><a class="dropdown-item" href="#">Collection Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Collection Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Collection Item 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">All Brands</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Contact Us</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Top Deals</a>
        </div>
    </div>
</section>
<!-- Product Introduction Section -->
<section class="container-fluid bg-image">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 ps-5">
            <h2 class="display-3 fw-bolder fs-8 text-gradient mb-4">Google Pixel 8</h2>
            <p class="lead text-dark">Experience the future with the Google Pixel 8, featuring a vibrant 6.2-inch OLED display, cutting-edge Tensor G3 chip, and a powerful 50MP camera system. Designed with a sleek, modern aesthetic and built to last with all-day battery life and 5G connectivity, the Pixel 8 delivers exceptional performance and seamless integration with Google Assistant. Embrace a new era of technology with a device that combines style, power, and intelligent features for an unparalleled smartphone experience.</p>
  
            <!-- Specifications Section -->
            <div class="row text-start mt-4 g-3"> 
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-battery-charging text-gradient" style="font-size: 2.5rem;"></i> 
                        </div>
                        <div>
                            <h5 class="fw-bold">All-Day Battery</h5>
                            <p class="text-muted">Up to 24 hours of usage on a single charge.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-cpu text-gradient" style="font-size: 2.5rem;"></i> 
                        </div>
                        <div>
                            <h5 class="fw-bold">Tensor G3 Chip</h5>
                            <p class="text-muted">High-performance processor for seamless multitasking.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-motherboard text-gradient" style="font-size: 2.5rem;"></i> 
                        </div>
                        <div>
                            <h5 class="fw-bold">Sleek Design</h5>
                            <p class="text-muted">Modern, ergonomic design with premium materials.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-camera text-gradient" style="font-size: 2.5rem;"></i> 
                        </div>
                        <div>
                            <h5 class="fw-bold">50MP Camera</h5>
                            <p class="text-muted">Capture stunning photos with high-resolution clarity.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center text-md-start mt-4">
                <a href="#" class="btn btn-pink text-white px-4 py-2 fw-bold" style="background-color: #e91e63;">Shop Now</a>
            </div>
        </div>

        <div class="col-md-6 text-center">
            <img src="/tech_web/assets/pixel-8.png" alt="Google Pixel 8" class="img-fluid rounded custom-image">
        </div>
        <!-- New container for the six columns -->
        <div class="container-md py-3 bg-white custom-container">
            <div class="row text-center">
                <div class="col-12 col-md-2 mb-4 vertical-bar">
                    <div class="d-flex align-items-start justify-content-center">
                        <i class="bi bi-truck text-gradient me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h6 class="fw-bold">Free Delivery</h6>
                            <p class="text-muted small">On all orders over $100</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 mb-4 vertical-bar">
                    <div class="d-flex align-items-start justify-content-center">
                        <i class="bi bi-credit-card text-gradient me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h6 class="fw-bold">Safe Payment</h6>
                            <p class="text-muted small">100% secure payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 mb-4 vertical-bar">
                    <div class="d-flex align-items-start justify-content-center">
                        <i class="bi bi-telephone text-gradient me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h6 class="fw-bold">Help Center</h6>
                            <p class="text-muted small">24 x 7 Support</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 mb-4 vertical-bar">
                    <div class="d-flex align-items-start justify-content-center">
                        <i class="bi bi-arrow-return-left text-gradient me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h6 class="fw-bold">Free Returns</h6>
                            <p class="text-muted small">No Questions Asked</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 mb-4 vertical-bar">
                    <div class="d-flex align-items-start justify-content-center">
                        <i class="bi bi-rocket text-gradient me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h6 class="fw-bold">Fast Shipping</h6>
                            <p class="text-muted small">In 2-3 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 mb-4 vertical-bar">
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
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="text-white">

                    <h5 class="fw-bold text-white mb-3">New Features</h5>
                    
                    <h2 class="display-4 fw-bold">Smart Fitness Band</h2>
                    <p class="lead">The smartwatch features a 1.4-inch AMOLED display, offering vibrant clarity and up to 10 days of battery life. It includes comprehensive health monitoring with heart rate, SpO2, and sleep tracking, plus support for over 100 workout modes. With Bluetooth 5.0, GPS, and compatibility with Android and iOS, it keeps you connected with notifications and offers NFC for payments</p>
                    
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
                        <a href="#" class="btn btn-pink text-white px-4 py-2 fw-bold" style="background-color: #e91e63;">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="/tech_web/assets/smartwatch.png" alt="Smart Fitness Band" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<section class="container-fluid py-4">
    <!-- New Container with Icon and Shop By Category Section -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 mb-5 text-center">
                <div class="d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background-color: #e91e63;">
                    <i class="bi bi-people-fill" style="font-size: 2rem; color: #ffffff;"></i>
                </div>
                <h2 class="fw-bold mb-2 mt-3">Shop at <span class="custom-red">Best Price</span></h2>
                <p class="text-muted">Experience the future of technology with our revolutionary device.</p>
            </div>
        </div>
        <!-- New Row with Buttons -->
    <div class="container py-5">
        <div class="row justify-content-center gx-0">
            <div class="col-auto">
                <button class="btn btn-custom-rec mb-3 ms-2 me-2">Computers and Accessories</button>
            </div>
            <div class="col-auto">
                <button class="btn btn-custom-rec mb-3 ms-2 me-2">Smartphones and Tablets</button>
            </div>
            <div class="col-auto">
                <button class="btn btn-custom-rec mb-3 ms-2 me-2">TV, Video, and Audio</button>
            </div>
        </div>
    </div>
<!-- New Row with four card for products -->
<div class="container-fluid py-5">
  <div class="row">
    <!-- First Column -->
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
          <p class="text-muted">Color Scheme</p>
        </div>
      </div>
    </div>
    <!-- Second Column -->
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
          <p class="text-muted">Color Scheme</p>
        </div>
      </div>
    </div>
    <!-- Third Column -->
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
          <p class="text-muted">Color Scheme</p>
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
          <p class="text-muted">Color Scheme</p>
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
      <a href="#" class="btn btn-pink text-white px-4 py-2 mt-4 fw-bold" style="background-color: #e91e63;">Shop Now</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>
