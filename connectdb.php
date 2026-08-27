<?php
$servername = "mysql.railway.internal";
$username   = "root";
$password   = "AOUrkudaIYJYTZTCuSrXkcKfCOzYZWid";
$dbname     = "railway";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Return JSON error if connection fails instead of die()
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}
?>
