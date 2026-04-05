<?php
header("Content-Type: application/json");

if (isset($_POST["ping"])) 
	{
		if ($_POST["ping"] == "WordMastery") 
			{
			
// Get POST data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];

// Simple validation
if (empty($username) || empty($email) || empty($password)) {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit();
}

echo json_encode([
    "status" => "success",
    "code" => 100,
    "message" => "User registered successfully",
    "username" => $username,
    "email" => $email,
    "password" => $password,
    "gender" => $gender
]);
            
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
        "message" => "Ping attribute value is missing for tthishis request!"
        ]);
    
    }
?>