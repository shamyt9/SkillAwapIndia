<?php
header('Content-Type: application/json');
include '../include/connection.php';
session_start();

$response = [];

// Check if user is logged in
if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
  $userid = $_SESSION['userid'];

  $stmt = $conn->prepare("SELECT full_name, username, email, phone, profile_photo, city, country, bio, created_at FROM users WHERE user_id = ?");
  $stmt->bind_param("i", $userid);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $response['status'] = 'success';
    $response['data'] = $user;
  } else {
    $response['status'] = 'error';
    $response['message'] = 'User not found';
  }
} else {
  $response['status'] = 'error';
  $response['message'] = 'User not logged in';
}

echo json_encode($response);
?>