<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (isset($_POST["ping"])) 
	{
		if ($_POST["ping"] == "WordMastery") 
			{

// Get data
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate
if (empty($username) || empty($email) || empty($password)) {
    echo json_encode([
			"status" => "success", 
			"code" => 50,
			"message" => "All fields required"
	]);
    exit();
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {

    // Check if email exists
    $check_mail = $conn->prepare("SELECT id FROM accounts WHERE email = ?");
    $check_mail->execute([$email]);

    if ($check_mail->rowCount() > 0) {
        echo json_encode([
			"status" => "success", 
			"code" => 100,
			"message" => "Email already exists"
		]);
        exit();
    }
    
      // Check if username exists
    $check_username = $conn->prepare("SELECT id FROM accounts WHERE username = ?");
    $check_username->execute([$email]);

    if ($check_username->rowCount() > 0) {
        echo json_encode([
			"status" => "success", 
			"code" => 150,
			"message" => "Username already exists"
		]);
        exit();
    }

    // Insert user
    $stmt = $conn->prepare("INSERT INTO accounts (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword]);

    echo json_encode([
			"status" => "success",
			"code" => 200
]);

} catch (PDOException $e) {
    echo json_encode([
			"status" => "success", 
			"code" => 400,
			"message" => $e->getMessage()]);
}

   } else {
  echo json_encode([
      "status" => "success",
      "code" => 500,
      "message" => $_POST["ping"] . "Isn't a valid ping attribute!"     
		 ]);
    }
 } else {
    echo json_encode([
        "status" => "success",
        "code" => 600,
        "message" => "Ping attribute value is missing for this request!"
        ]);    
    }

} else {
	echo json_encode([
      "status" => "success",
      "code" => 700,
      "message" => "You can only access this page with a POST request"     
		 ]);
    }
?>
