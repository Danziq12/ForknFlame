<?php
// Get Railway environment variables or fallback to defaults
$host     = getenv('MYSQLHOST')     ?: "mysql.railway.internal";
$user     = getenv('MYSQLUSER')     ?: "root";
$password = getenv('MYSQLPASSWORD') ?: "AOUrkudaIYJYTZTCuSrXkcKfCOzYZWid";
$database = getenv('MYSQLDATABASE') ?: "railway";
$port     = getenv('MYSQLPORT')     ?: 3306;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}
?>
