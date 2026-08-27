<?php
$servername = getenv('MYSQLHOST')     ?: "mysql.railway.internal";
$username   = getenv('MYSQLUSER')     ?: "root";
$password   = getenv('MYSQLPASSWORD') ?: "AOUrkudaIYJYTZTCuSrXkcKfCOzYZWid";
$dbname     = getenv('MYSQLDATABASE') ?: "railway";
$port       = getenv('MYSQLPORT')     ?: 3306;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}
?>
