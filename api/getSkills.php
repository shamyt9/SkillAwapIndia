<?php
header('Content-Type: application/json');
include '../include/connection.php';

$response = [];

$stmt = $conn->prepare("SELECT * FROM user_skills WHERE user_id = ?");
$stmt->bind_param("i", $_GET['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $skills = [];
  while ($row = $result->fetch_assoc()) {
    $skills[] = $row;
  }
  $response['status'] = "success";
  $response['data'] = $skills;
} else {
  $response['status'] = "error";
  $response['message'] = "No skills found";
}

echo json_encode($response);
?>