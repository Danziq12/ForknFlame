<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Featured Items</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <style>
      /* Filter helper class */
      .menu-item.hide {
        display: none !important;
      }
    </style>
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
        </div>
      </div>
    </nav>

    <section id="menu" class="menu-section">
      <div class="container">
        
        <div class="section-header">
          <span class="sub-heading">100% Halal Certified</span>
          <h2>Our Featured Menu</h2>
          <p>Crafted with fresh halal ingredients and extraordinary passion.</p>
        </div>

        <!-- Category Filter Buttons -->
        <div class="menu-filters">
          <button class="filter-btn active" data-filter="all">All</button>
          <button class="filter-btn" data-filter="starters">Starters</button>
          <button class="filter-btn" data-filter="mains">Mains</button>
          <button class="filter-btn" data-filter="desserts">Desserts</button>
          <button class="filter-btn" data-filter="drinks">Drinks</button>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid">
          
          <!-- Item 1: Mains -->
          <div class="menu-item mains">
            <img src="https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&w=600&q=80" alt="Pan-Seared Salmon" class="menu-img" />
            <div class="menu-details">
              <div class="menu-title-price">
                <h3>Pan-Seared Salmon</h3>
                <span class="price">RM 38.00</span>
              </div>
              <p class="description">Fresh Atlantic salmon served with roasted asparagus, dill cream sauce, and lemon zest.</p>
              <span class="tag">Gluten-Free</span>
            </div>
          </div>

          <!-- Item 2: Starters -->
          <div class="menu-item starters">
            <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?auto=format&fit=crop&w=600&q=80" alt="Truffle Parmesan Fries" class="menu-img" />
            <div class="menu-details">
              <div class="menu-title-price">
                <h3>Truffle Parmesan Fries</h3>
                <span class="price">RM 18.00</span>
              </div>
              <p class="description">Hand-cut fries tossed in white truffle oil, grated parmesan cheese, and fresh parsley.</p>
              <span class="tag">Vegetarian</span>
            </div>
          </div>

          <!-- Item 3: Desserts -->
          <div class="menu-item desserts">
            <img src="https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&w=600&q=80" alt="Molten Chocolate Cake" class="menu-img" />
            <div class="menu-details">
              <div class="menu-title-price">
                <h3>Molten Chocolate Cake</h3>
                <span class="price">RM 22.00</span>
              </div>
              <p class="description">Warm dark chocolate cake with a molten center, served with vanilla bean gelato.</p>
            </div>
          </div>

          <!-- Item 4: Mocktail (Drinks) -->
          <div class="menu-item drinks">
            <img src="https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=600&q=80" alt="Smoked Rosemary Sparkler Mocktail" class="menu-img" />
            <div class="menu-details">
              <div class="menu-title-price">
                <h3>Rosemary Citrus Mocktail</h3>
                <span class="price">RM 16.00</span>
              </div>
              <p class="description">Non-alcoholic sparkling blend with fresh orange juice, smoked rosemary syrup, and soda.</p>
              <span class="tag">Halal Mocktail</span>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- JavaScript for Category Filtering -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const menuItems = document.querySelectorAll('.menu-item');

        filterBtns.forEach(btn => {
          btn.addEventListener('click', () => {
            // Remove active class from all buttons and set active on the clicked button
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            // Show or hide items based on filter category
            menuItems.forEach(item => {
              if (filterValue === 'all' || item.classList.contains(filterValue)) {
                item.classList.remove('hide');
              } else {
                item.classList.add('hide');
              }
            });
          });
        });
      });
    </script>
  </body>
</html>
