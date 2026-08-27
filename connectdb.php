<?php
$servername = "maglev.proxy.rlwy.net";
$username   = "root";
$password   = "AOUrkudaIYJYTZTCuSrXkcKfCOzYZWid";
$dbname     = "railway";
$port       = 23881;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    // Return JSON error if connection fails instead of die()
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}
?>
