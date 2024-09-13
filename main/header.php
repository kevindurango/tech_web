<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Header </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">  
    <link rel="stylesheet" href="/tech_web/styles/product.css">
</head>
<body>

<!-- First Header Section: Country Dropdown and Social Links -->
<header class="bg-dark py-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col d-none d-md-flex align-items-center">
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

            <div class="col d-none d-md-flex justify-content-between align-items-center">
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link text-white small" href="#">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">Terms</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">FAQ</a></li>
                    </ul>
                </nav>

                <div class="d-none d-md-block">
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-github"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <div class="col d-md-none text-center">
                <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-github"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-youtube"></i></a>
                <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>
</header>
<!-- Hamburger Menu for Smaller Screens -->
<div class="d-md-none d-flex justify-content-between align-items-center">
    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavigation" aria-controls="offcanvasNavigation">
        <i class="bi bi-list"></i>
    </button>
    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
        <i class="bi bi-cart"></i>
    </button>
</div>
<!-- Offcanvas Menu For Nav Links -->

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavigation" aria-labelledby="offcanvasNavigationLabel">
    <div class="offcanvas-header">
        <div class="profile-container">
            <div class="profile-icon">
                <img src="/tech_web/assets/profile_icon.png" alt="Profile Icon">
            </div>
            <a href="#" class="profile-text">Login • Register</a>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" style="position: absolute; top: 10px; right: 10px;"></button>
    </div>

    <div class="offcanvas-body">
        <a href="#" class="nav-link-red-offcanvas fw-semibold d-block py-3 ps-3"> 
            <i class="bi bi-grid me-1"></i> Shop by Categories
        </a>

        <div class="dropdown">
            <a class="nav-link text-white fw-semibold d-block py-3" href="#" id="offcanvasCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-grid me-1"></i> Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasCategoriesDropdown">
                <li><a class="dropdown-item" href="#">Category 1</a></li>
                <li><a class="dropdown-item" href="#">Category 2</a></li>
                <li><a class="dropdown-item" href="#">Category 3</a></li>
            </ul>
        </div>

        <a href="#" class="nav-link-red-offcanvas text-dark fw-semibold d-block py-3">Home</a>
        <a href="#" class="nav-link-red-offcanvas text-dark fw-semibold d-block py-2">
            Shop
            <span class="offcanvas-badge bg-hot-green">HOT</span>
        </a>

        <a class="nav-link-red-offcanvas text-dark fw-semibold d-block py-3" href="#" id="offcanvasPopularDropdown">
            Popular
            <span class="offcanvas-badge bg-new-yellow">NEW</span>
        </a>

        <a class="nav-link-red-offcanvas text-dark fw-semibold d-block py-3" href="#" id="offcanvasTrendingDropdown">
            Trending
        </a>

        <a class="nav-link-red-offcanvas text-dark fw-semibold d-block py-3" href="#" id="offcanvasCollectionDropdown">
            Collection
            <span class="offcanvas-badge bg-best-blue">BEST</span>
        </a>

        <a href="#" class="nav-link-red-offcanvas text-dark fw-semibold d-block py-3">
            Top Deals
            <span class="offcanvas-badge bg-black">5% OFF</span>
        </a>

        <div class="offcanvas-separator"></div>

        <a href="#" class="nav-link-red-offcanvas text-dark fw-semibold d-block py-3">
            <i class="bi bi-cart me-1"></i> My Cart (0)
        </a>
        <a href="#" class="nav-link-red-offcanvas text-dark fw-semibold d-block py-3">
            <i class="bi bi-heart me-1"></i> My Wishlist (0)
        </a>

        <div class="offcanvas-separator"></div>

        <div class="dropdown d-flex justify-content-center ps-4 pe-5">
        <button class="btn btn-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="countryDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
            <div class="country-logo rounded-circle" style="background-image: url('https://flagcdn.com/us.svg'); width: 20px; height: 20px; background-size: cover;"></div>
            <span class="text-black ms-2">EUR</span>
            <span class="caret" style="color: black;"></span> <!-- Caret is set to black -->
        </button>
        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="countryDropdown">
            <li><a class="dropdown-item text-black" href="#">Country 1</a></li>
            <li><a class="dropdown-item text-black" href="#">Country 2</a></li>
            <li><a class="dropdown-item text-black" href="#">Country 3</a></li>
        </ul>
    </div>
    </div>
</div>

<!-- Offcanvas Menu for Smaller Screens -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasMenuLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="d-flex mb-3">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light d-flex align-items-center border-0" type="submit">
                <i class="bi bi-search text-gray"></i>
            </button>
        </form>
        <div class="d-flex flex-column">
            <!-- My Cart -->
            <div class="d-flex align-items-center mb-3 text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">My Cart</div>
                    <div class="fs-6 fw-bold">$0.00</div>
                </div>
            </div>
            <!-- My Wishlist -->
            <div class="d-flex align-items-center mb-3 text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-heart"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">My Wishlist</div>
                    <div class="fs-6 fw-bold">View Wishlist</div>
                </div>
            </div>
            <!-- Guest Account -->
            <div class="d-flex align-items-center text-dark">
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

<!-- Second Header Section: Search Bar and Icons -->
<header class="custom-header bg-white py-2 border-bottom d-none d-md-block">
  <div class="container">
    <div class="row align-items-center">
     
        <div class="col-md-6 d-flex justify-content-between align-items-center">
            <!-- Image Container Column -->
            <div class="image-container me-3"> <!-- Add some margin to the right for spacing -->
                <img src="/tech_web/assets/tech-logo.png" alt="Your Image" class="img-fluid" style="max-width: 100px;"> <!-- Adjust width as needed -->
            </div>

            <!-- Search Form Column -->
            <form class="custom-search-form w-75"> <!-- Adjusted width to 75% -->
                <div class="input-group">
                <input type="text" class="form-control custom-search-input" placeholder="Search" aria-label="Search">
                <span class="input-group-text custom-search-btn">
                    <i class="bi bi-search"></i>
                </span>
                </div>
            </form>
            </div>

      <!-- Icons and Texts Column -->
      <div class="col-md-6 d-flex justify-content-end">
        <!-- My Cart -->
        <div class="custom-header-item d-flex align-items-center mx-2 text-dark">
          <div class="icon-container me-2">
            <div class="custom-icon-circle">
              <i class="bi bi-cart"></i>
            </div>
            <span class="icon-badge badge-cart fw-bold">0</span> 
          </div>
          <div class="text-start">
            <div class="fs-7 fw-normal">My Cart</div>
            <div class="fs-6 fw-bold">$0.00</div>
          </div>
        </div>
        <!-- My Wishlist -->
        <div class="custom-header-item d-flex align-items-center mx-2 text-dark">
          <div class="icon-container me-2">
            <div class="custom-icon-circle">
              <i class="bi bi-heart"></i>
            </div>
            <span class="icon-badge badge-wishlist fw-bold">0</span>
          </div>
          <div class="text-start">
            <div class="fs-7 fw-normal">My Wishlist</div>
            <div class="fs-6 fw-bold">View Wishlist</div>
          </div>
        </div>
        <!-- Guest Account -->
        <div class="custom-header-item d-flex align-items-center mx-2 text-dark">
          <div class="icon-container me-2">
            <div class="custom-icon-circle">
              <i class="bi bi-person"></i>
            </div>
          </div>
          <div class="text-start">
            <div class="fs-7 fw-normal">Guest</div>
            <div class="fs-6 fw-bold">My Account</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Navigation Section -->
<section class="container bg-white border-bottom d-none d-md-block">
    <div class="row text-center align-items-center">
        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle fw-semibold nav-item-wrapper" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-grid me-1"></i> Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <li><a class="dropdown-item" href="#">Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Category 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-hot-green position-absolute">HOT</span>
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Shop</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Home</a>
        </div>

        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-new-yellow position-absolute">NEW</span>
            <div class="dropdown">
                <a class="nav-link-red dropdown-toggle text-dark fw-semibold nav-item-wrapper" href="#" id="popularDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Popular
                </a>
                <ul class="dropdown-menu" aria-labelledby="popularDropdown">
                    <li><a class="dropdown-item" href="#">Popular Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-best-blue position-absolute">BEST</span>
            <div class="dropdown">
                <a class="nav-link-red dropdown-toggle text-dark fw-semibold nav-item-wrapper" href="#" id="collectionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">All Brands</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Contact Us</a>
        </div>

        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-black position-absolute">5% OFF</span>
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Top Deals</a>
        </div>
    </div>
</section>
