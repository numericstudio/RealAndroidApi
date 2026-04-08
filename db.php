<?php
$host = "mysql-production";
$username = "root";
$password = "PLbnPzefguAWuAJoFSyiHsPgcDxNYDjG";
$dbname = "railway";
$port = "3306";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected!";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
