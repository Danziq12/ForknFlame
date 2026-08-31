<?php
// Retrieve Railway environment variables or fallback to defaults
$host     = getenv('MYSQLHOST')     ?: "mysql.railway.internal";
$user     = getenv('MYSQLUSER')     ?: "root";
$password = getenv('MYSQLPASSWORD') ?: "AOUrkudaIYJYTZTCuSrXkcKfCOzYZWid";
$database = getenv('MYSQLDATABASE') ?: "railway";
$port     = getenv('MYSQLPORT')     ?: 3306;

// Enable strict MySQLi error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $password, $database, (int)$port);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
