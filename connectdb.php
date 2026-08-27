<?php
$servername = "maglev.proxy.rlwy.net";
$username = "root";
$password = "AOUrkudaIYJYTZTCuSrXkcKfCOzYZWid";
$dbname = "railway";
$port = "23881";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $23881);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
