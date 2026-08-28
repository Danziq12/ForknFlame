<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fork & Flame | Fine Dining Experience</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #0f0f0f;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Custom Navigation */
        .navbar {
            background-color: rgba(15, 15, 15, 0.95) !important;
            border-bottom: 1px solid #222;
            padding: 1rem 2rem;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 2px;
            color: #e5a93c !important;
            text-transform: uppercase;
        }
        .nav-link {
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.9rem;
            margin-left: 1rem;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #e5a93c !important;
        }

        /* Hero Section */
        .hero-section {
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(15,15,15,1)), 
                        url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 20px;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: 3px;
            color: #fff;
            margin-bottom: 1rem;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            color: #aaa;
            max-width: 600px;
            margin: 0 auto 2rem auto;
        }
        .btn-gold {
            background-color: #e5a93c;
            color: #000;
            font-weight: 700;
            border: none;
            padding: 12px 30px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            background-color: #c99028;
            color: #fff;
        }

        /* Feature Cards */
        .feature-card {
            background: #181818;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 30px;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: #e5a93c;
        }
        .feature-title {
            color: #e5a93c;
            font-weight: 600;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Fork & Flame</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Booking.php">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservations.php">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AboutUs.php">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div>
            <h1 class="hero-title">FORK & FLAME</h1>
            <p class="hero-subtitle">Experience wood-fired mastery and culinary craftsmanship tailored to your palate.</p>
            <a href="Booking.php" class="btn btn-gold btn-lg">Reserve a Table</a>
        </div>
    </section>

    <!-- Highlights Section -->
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
