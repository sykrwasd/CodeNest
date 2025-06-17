<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NazaCorp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">NazaCorp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#features">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
      <div class="d-flex">
        <a href="login.php" class="btn btn-light text-primary fw-bold">Login</a>
      </div>
    </div>
  </div>
</nav>



<header class="bg-light py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 text-center text-lg-start">
        <h1 class="display-5 fw-bold">Welcome to NazaCorp</h1>
        <p class="lead">Driving Innovation Across Industries</p>
      </div>
      <div class="col-lg-6 mt-4 mt-lg-0">
        <div class="row g-3">
          <div class="col-6">
            <img src="img/logo.png" alt="NazaCorp Dashboard" class="img-fluid rounded shadow">
          </div>
          
        </div>
      </div>
    </div>
  </div>
</header>


<section class="py-5" id="about">
  <div class="container">
    <h2 class="mb-4">About Us</h2>
    <p class="fs-5">
      NazaCorp is a leading Malaysian conglomerate with roots in motor trading since 1975. Our core businesses span automotive, property, hospitality, education, and services. We proudly represent major global brands and continue to drive innovation across all sectors.
    </p>
  </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light" id="features">
  <div class="container">
    <h2 class="text-center mb-5">Our Features</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="fas fa-car fa-3x text-primary mb-3"></i>
            <h4 class="card-title">Automotive Excellence</h4>
            <p class="card-text">Leading distributor of premium automotive brands with comprehensive sales and service solutions.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="fas fa-building fa-3x text-primary mb-3"></i>
            <h4 class="card-title">Property Development</h4>
            <p class="card-text">Creating innovative and sustainable real estate solutions across Malaysia.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="fas fa-hotel fa-3x text-primary mb-3"></i>
            <h4 class="card-title">Hospitality</h4>
            <p class="card-text">World-class hotels and resorts offering exceptional guest experiences.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
            <h4 class="card-title">Education</h4>
            <p class="card-text">Providing quality education and training programs for future leaders.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="fas fa-cogs fa-3x text-primary mb-3"></i>
            <h4 class="card-title">Integrated Services</h4>
            <p class="card-text">Comprehensive business solutions and support services for all sectors.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
            <h4 class="card-title">Innovation</h4>
            <p class="card-text">Continuously driving innovation and excellence across all business units.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="py-5 bg-light" id="contact">
  <div class="container">
    <h2 class="mb-4">Contact Us</h2>
    <div class="row">
      <div class="col-md-6 mb-4">
        <iframe 
          src="https://www.google.com/maps?q=NAZA%20Tower,%20Platinum%20Park,%20Persiaran%20KLCC,%2050088%20Kuala%20Lumpur&output=embed" 
          width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>
      <div class="col-md-6">
        <h5>NAZA TOWER</h5>
        <p>
          Platinum Park, Persiaran KLCC,<br>
          50088 Kuala Lumpur,<br>
          Malaysia.
        </p>
        <p><strong>Tel:</strong> +603-2386 8000</p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-3">
  <div class="container">
    <small>&copy; 2025 NazaCorp. All rights reserved.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
