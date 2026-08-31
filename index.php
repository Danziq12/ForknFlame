<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fork & Flame | Fine Dining Experience</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="mainpage.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Fork & Flame</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="Menu.php">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Booking.php">Booking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AboutUs.php">About us</a>
            </li>
          </ul>
          <div class="d-flex gap-2">
            <a href="login.php" class="btn btn-outline-light">Login</a>
            <a href="register.php" class="btn btn-warning">Sign Up</a>
          </div>
        </div>
      </div>
    </nav>

    <section class="hero-section">
        <div>
            <h1 class="hero-title">FORK & FLAME</h1>
            <p class="hero-subtitle">Experience wood-fired mastery and culinary craftsmanship tailored to your palate.</p>
            <a href="Booking.php" class="btn btn-gold btn-lg">Reserve a Table</a>
        </div>
    </section>

    <section class="container my-5 py-4">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <h4 class="feature-title">Artisan Cuisine</h4>
                    <p class="text-muted">Handcrafted dishes sourced from locally harvested organic ingredients and prime cuts.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <h4 class="feature-title">Wood-Fired Grill</h4>
                    <p class="text-muted">Authentic flame-seared steaks, seafood, and vegetables infused with smoked oak flavor.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <h4 class="feature-title">Exclusive Atmosphere</h4>
                    <p class="text-muted">Designed for memorable evenings, date nights, and private group gatherings.</p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
