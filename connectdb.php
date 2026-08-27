<?php
// Dynamic environment variables with fallback defaults
$servername = getenv('MYSQLHOST')     ?: "mysql.railway.internal";
$username   = getenv('MYSQLUSER')     ?: "root";
$password   = getenv('MYSQLPASSWORD') ?: "AOUrkudaIYJYTZTCuSrXkcKfCOzYZWid";
$dbname     = getenv('MYSQLDATABASE') ?: "railway";
$port       = getenv('MYSQLPORT')     ?: 3306;

// Create connection including the $port parameter
$conn = new mysqli($servername, $username, $password, $dbname, (int)$port);

// Check connection
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}
?>
