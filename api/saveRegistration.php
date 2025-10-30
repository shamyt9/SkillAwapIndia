<?php
header('Content-Type:application/json');
include '../include/connection.php';

$response = [];

try {
  $fullName = $_POST['fullName'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $bio = $_POST['bio'];
  $terms = isset($_POST['terms']) ? 1 : 0;
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // PROFILE IMAGE UOPLOAD
  $profilePhotoPath = null;
  if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "../uploads/";

    $fileName = time() . "_" . basename($_FILES["profilePhoto"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFile)) {
      $profilePhotoPath = "uploads/" . $fileName;
    }
  }

  // Insert into database
  if (checkUsernameExists($conn, $username)) {
    $response['status'] = "error";
    $response['message'] = 'Username already exists';
    echo json_encode($response);
    exit();

  }

  if (checkEmailExists($conn, $email)) {
    $response = [
      "status" => "error",
      "message" => "Email already registered"
    ];
    echo json_encode($response);
    exit();
  }


  $sql = "INSERT INTO users (full_name, username, email, phone, password, profile_photo, city, country, bio, terms_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssssi", $fullName, $username, $email, $phone, $hashedPassword, $profilePhotoPath, $city, $country, $bio, $terms);

  if ($stmt->execute()) {
    $response = ["status" => "success", "message" => "User registered successfully"];
  } else {
    $response = ["status" => "error", "message" => "Database insert failed: " . $stmt->error];
  }



} catch (Exception $e) {
  $response['status'] = "error";
  $response['message'] = $e->getMessage();

}
echo json_encode($response);




function checkUsernameExists($conn, $username)
{
  $sql = "SELECT user_id FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();
  return $stmt->num_rows > 0;
}

function checkEmailExists($conn, $email)
{
  $sql = "SELECT user_id FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  return $stmt->num_rows > 0;
}





?>