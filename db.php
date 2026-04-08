<?php
$host = "mysql.railway.internal";
$username = "root";
$password = "PLbnPzefguAWuAJoFSyiHsPgcDxNYDjG";
$database = "railway";
$port = "3306";

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	echo "connected successfully!";
?>