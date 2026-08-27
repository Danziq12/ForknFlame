<?php
header('Content-Type: application/json');

// Include database connection
require_once 'connectdb.php';

if (!isset($conn)) {
    echo json_encode(['success' => false, 'message' => 'Database connection variable not available.']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name        = trim($_POST['full_name'] ?? '');
    $phone            = trim($_POST['phone'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $guests           = trim($_POST['guests'] ?? '');
    $booking_date     = trim($_POST['booking_date'] ?? '');
    $booking_time     = trim($_POST['booking_time'] ?? '');
    $special_requests = !empty($_POST['special_requests']) ? trim($_POST['special_requests']) : null;

    if (empty($full_name) || empty($phone) || empty($email) || empty($guests) || empty($booking_date) || empty($booking_time)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit();
    }

    try {
        $sql = "INSERT INTO reservations (full_name, phone, email, guests, booking_date, booking_time, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$full_name, $phone, $email, $guests, $booking_date, $booking_time, $special_requests]);

        echo json_encode(['success' => true, 'message' => 'Reservation saved successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
