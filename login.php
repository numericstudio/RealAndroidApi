<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (isset($_POST["ping"])) 
	{
		if ($_POST["ping"] == "WordMastery") 
			{

// Get data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode([
		"status" => "error", 
		"code" => 50,
		"message" => "All fields required"
	]);
    exit();
}

try {
    $stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {

            echo json_encode([
                "status" => "success",
                "code" => 200,
                "id" => $user['id'],
                "username" => $user['username'],
                "email" => $user['email']
            ]);

        } else {
            echo json_encode([
			"status" => "success", 
			"code" => 300,
			"message" => "Wrong password"
	]);
        }
    } else {
        echo json_encode([
		"status" => "success", 
		"code" => 400,
		"message" => "User not found"
	]);
    }

} catch (PDOException $e) {
    echo json_encode([
		"status" => "success", 
		"code" => 500,
		"message" => $e->getMessage()
	]);
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