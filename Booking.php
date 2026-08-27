<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fork & Flame - Menu & Booking</title>

  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Booking Form Adjustments */
    .booking-section {
      padding: 60px 0;
    }

    .booking-card {
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06) !important;
      border: none;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #c97a3e;
      box-shadow: 0 0 0 0.25rem rgba(201, 122, 62, 0.25);
    }

    .btn-primary-custom {
      background-color: #1a1a1a;
      border-color: #1a1a1a;
      color: #fff;
    }

    .btn-primary-custom:hover {
      background-color: #c97a3e;
      border-color: #c97a3e;
      color: #fff;
    }

    
  </style>
</head>
<body>

  <!-- Navigation Bar -->
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

  <!-- Table Reservation Section -->
  <section id="booking" class="booking-section">
    <div class="container">
      
      <div class="section-header text-center mb-4">
        <span class="sub-heading">Reserve A Table</span>
        <h2>Book Your Dining Experience</h2>
        <p>Join us for an unforgettable meal at Fork & Flame.</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card booking-card bg-white p-4 p-md-5">
            
            <form id="bookingForm" action="Process.php" method="POST">
              <div class="row g-3">
                
                <!-- Full Name -->
                <div class="col-md-6">
                  <label for="fullName" class="form-label fw-semibold">Full Name</label>
                  <input type="text" class="form-control" id="fullName" name="full_name" placeholder="e.g. Ahmad Razak" required>
                </div>

                <!-- Phone Number -->
                <div class="col-md-6">
                  <label for="phone" class="form-label fw-semibold">Phone Number</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g. +60 12-345 6789" required>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                  <label for="email" class="form-label fw-semibold">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                </div>

                <!-- Guests Dropdown -->
                <div class="col-md-6">
                  <label for="guests" class="form-label fw-semibold">Number of Guests</label>
                  <select class="form-select" id="guests" name="guests" required>
                    <option value="" selected disabled>Select guests</option>
                    <option value="1">1 Person</option>
                    <option value="2">2 Persons</option>
                    <option value="3">3 Persons</option>
                    <option value="4">4 Persons</option>
                    <option value="5">5 Persons</option>
                    <option value="6+">6+ Persons (Large Group)</option>
                  </select>
                </div>

                <!-- Date Picker -->
                <div class="col-md-6">
                  <label for="bookingDate" class="form-label fw-semibold">Reservation Date</label>
                  <input type="date" class="form-control" id="bookingDate" name="booking_date" required>
                </div>

                <!-- Time Slot -->
                <div class="col-md-6">
                  <label for="bookingTime" class="form-label fw-semibold">Reservation Time</label>
                  <select class="form-select" id="bookingTime" name="booking_time" required>
                    <option value="" selected disabled>Select time slot</option>
                    <option value="12:00 PM">12:00 PM (Lunch)</option>
                    <option value="01:00 PM">01:00 PM (Lunch)</option>
                    <option value="02:00 PM">02:00 PM (Lunch)</option>
                    <option value="06:00 PM">06:00 PM (Dinner)</option>
                    <option value="07:00 PM">07:00 PM (Dinner)</option>
                    <option value="08:00 PM">08:00 PM (Dinner)</option>
                    <option value="09:00 PM">09:00 PM (Dinner)</option>
                  </select>
                </div>

                <!-- Special Requests -->
                <div class="col-12">
                  <label for="specialRequests" class="form-label fw-semibold">Special Requests (Optional)</label>
                  <textarea class="form-control" id="specialRequests" name="special_requests" rows="3" placeholder="Dietary requirements, seating preferences, or special celebrations..."></textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-center mt-4">
                  <button type="submit" class="btn btn-primary-custom btn-lg px-5">Confirm Reservation</button>
                </div>

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Reservation Confirmation Modal -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="confirmationModalLabel">Booking Request Received</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <p class="mb-2">Thank you, <strong id="summaryName"></strong>!</p>
          <p class="text-muted">We have logged your reservation details for <strong>Fork & Flame</strong>:</p>
          
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between"><span>Date:</span> <strong id="summaryDate"></strong></li>
            <li class="list-group-item d-flex justify-content-between"><span>Time:</span> <strong id="summaryTime"></strong></li>
            <li class="list-group-item d-flex justify-content-between"><span>Guests:</span> <strong id="summaryGuests"></strong></li>
          </ul>
          <p class="text-muted small mb-0">A confirmation update will be sent to <span id="summaryEmail" class="text-primary"></span>.</p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Page Interactivity Scripts -->
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    // Disable past dates
    const dateInput = document.getElementById('bookingDate');
    if (dateInput) {
      const today = new Date().toISOString().split('T')[0];
      dateInput.setAttribute('min', today);
    }

    // Handle form submission via AJAX
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
      bookingForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(bookingForm);

        try {
          const response = await fetch('Process.php', {
            method: 'POST',
            body: formData
          });

          const result = await response.json();

          if (result.success) {
            // Populate Modal Fields
            document.getElementById('summaryName').textContent = document.getElementById('fullName').value;
            document.getElementById('summaryDate').textContent = document.getElementById('bookingDate').value;
            document.getElementById('summaryTime').textContent = document.getElementById('bookingTime').value;
            document.getElementById('summaryGuests').textContent = document.getElementById('guests').value + ' Person(s)';
            document.getElementById('summaryEmail').textContent = document.getElementById('email').value;

            // Display Modal
            const modalElement = document.getElementById('confirmationModal');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            // Clear form inputs
            bookingForm.reset();
          } else {
            alert('Error: ' + result.message);
          }
          } catch (error) {
            console.error('Submission error:', error);
            alert('Error details: ' + error.message);
          }
        /*} catch (error) {
          console.error('Submission error:', error);
          alert('An error occurred while submitting your booking.');
        }*/
      });
    }
  });
</script>
</body>
</html>
