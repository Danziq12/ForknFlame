<?php
// Set response type to JSON for the AJAX request
header('Content-Type: application/json');

// Enable error reporting for debugging output inside JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Include database connection
require_once 'connectdb.php';

// Verify database connection variable exists
if (!isset($conn) || $conn->connect_error) {
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection variable not available.'
    ]);
    exit();
}

// Process POST data
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

    // Insert record using Prepared Statement
    $sql = "INSERT INTO reservations (full_name, phone, email, guests, booking_date, booking_time, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssss", $full_name, $phone, $email, $guests, $booking_date, $booking_time, $special_requests);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Reservation saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Query execution error: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Query preparation error: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
