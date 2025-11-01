<?php
header('Content-Type: application/json');
include '../include/connection.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $role = $_POST['role'];
  $skill_name = $_POST['skill_name'];
  $skill_level = $_POST['skill_level'];
  $preferred_mode = $_POST['preferred_mode'];
  $availability = $_POST['availability'];
  $description = $_POST['description'];

  $stmt = $conn->prepare("INSERT INTO user_skills (role, skill_name, skill_level, preferred_mode, availability, description,user_id)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssi", $role, $skill_name, $skill_level, $preferred_mode, $availability, $description, $username);

  if ($stmt->execute()) {
    $response['status'] = "success";
  } else {
    $response['status'] = "error";
    $response['message'] = 'Execute failed: ' . $stmt->error;
  }
} else {
  $response['status'] = "error";
  $response['message'] = "Invalid request";
}

echo json_encode($response);
?>