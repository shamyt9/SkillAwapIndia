<?php
header('Content-Type:application/json');
include '../include/connection.php';
session_start();

if ($SERVER['REQUEST_METHOD'] == 'POST') {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $response = [];
  $sql = "SELECT * FROM users WHERE email=? or username=?";

  try {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        $response['status'] = "success";
        $response['message'] = "Login successful";

        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['profile_photo'] = $user['profile_photo'];
        $_SESSION['city'] = $user['city'];
        $_SESSION['country'] = $user['country'];
        $_SESSION['bio'] = $user['bio'];
        $_SESSION['created_at'] = $user['created_at'];

      } else {
        $response['status'] = "error";
        $response['message'] = "Invalid password";
      }

    }
  } catch (Exception $e) {
    $response['status'] = "error";
    $response['message'] = "Server error: " . $e->getMessage();
  }

  echo json_encode($response);
}


?>