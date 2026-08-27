<?php
// Set response type to JSON for the AJAX request
header('Content-Type: application/json');

// Database configuration
$host     = "localhost";
$username = "root";       // Replace with your DB username
$password = "";           // Replace with your DB password
$dbname   = "forkandflame";

// 1. Establish database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// 2. Process POST data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name        = trim($_POST['full_name'] ?? '');
    $phone            = trim($_POST['phone'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $guests           = trim($_POST['guests'] ?? '');
    $booking_date     = trim($_POST['booking_date'] ?? '');
    $booking_time     = trim($_POST['booking_time'] ?? '');
    $special_requests = !empty($_POST['special_requests']) ? trim($_POST['special_requests']) : null;

    // Basic validation
    if (empty($full_name) || empty($phone) || empty($email) || empty($guests) || empty($booking_date) || empty($booking_time)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit();
    }

    // 3. Insert record using Prepared Statement
    $sql = "INSERT INTO reservations (full_name, phone, email, guests, booking_date, booking_time, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssss", $full_name, $phone, $email, $guests, $booking_date, $booking_time, $special_requests);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Reservation saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to execute query: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare query: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>