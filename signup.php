<?php
include "db.php";

// Get data
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate
if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "All fields required"]);
    exit();
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {

    // Check if email exists
    $check_mail = $conn->prepare("SELECT id FROM accounts WHERE email = ?");
    $check_mail->execute([$email]);

    if ($check_mail->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Email already exists"]);
        exit();
    }
    
      // Check if username exists
    $check_username = $conn->prepare("SELECT id FROM accounts WHERE username = ?");
    $check_username->execute([$email]);

    if ($check_username->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Username already exists"]);
        exit();
    }

    // Insert user
    $stmt = $conn->prepare("INSERT INTO accounts (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword]);

    echo json_encode(["status" => "success"]);

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>