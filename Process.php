<?php
header('Content-Type: application/json');

// Get Railway environment variables or fallback to defaults
$host     = $_ENV['MYSQLHOST']     ?? '127.0.0.1';
$user     = $_ENV['MYSQLUSER']     ?? 'root';
$password = $_ENV['MYSQLPASSWORD'] ?? '';
$database = $_ENV['MYSQLDATABASE'] ?? 'fork_and_flame';
$port     = $_ENV['MYSQLPORT']     ?? 3306;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullName = $_POST['full_name'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $email    = $_POST['email'] ?? '';
        $guests   = $_POST['guests'] ?? '';
        $date     = $_POST['booking_date'] ?? '';
        $time     = $_POST['booking_time'] ?? '';
        $requests = $_POST['special_requests'] ?? '';

        $stmt = $pdo->prepare("INSERT INTO bookings (full_name, phone, email, guests, booking_date, booking_time, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$fullName, $phone, $email, $guests, $date, $time, $requests]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
