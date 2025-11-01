<?php
header('Content-Type: application/json');
include '../include/connection.php';

$response = [];

// Get POST data safely
$user_id = $_POST['user_id'] ?? '';
$full_name = $_POST['full_name'] ?? '';
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';
$bio = $_POST['bio'] ?? '';

// Simple validation
if (empty($user_id) || empty($full_name) || empty($username) || empty($email)) {
  $response['status'] = 'error';
  $response['message'] = 'Required fields are missing!';
  echo json_encode($response);
  exit;
}

// Update query
$stmt = $conn->prepare("
    UPDATE users 
    SET full_name = ?, username = ?, email = ?, phone = ?, city = ?, country = ?, bio = ? 
    WHERE user_id = ?
");
$stmt->bind_param("sssssssi", $full_name, $username, $email, $phone, $city, $country, $bio, $user_id);

if ($stmt->execute()) {
  $response['status'] = 'success';
} else {
  $response['status'] = 'error';
  $response['message'] = $conn->error;
}

echo json_encode($response);
