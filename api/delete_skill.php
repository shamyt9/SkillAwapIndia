<?php
header('Content-Type: application/json');
include '../include/connection.php';

$id = $_POST['id'] ?? 0;
$response = [];

$stmt = $conn->prepare("DELETE FROM user_skills WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  $response['status'] = "success";
} else {
  $response['status'] = "error";
  $response['message'] = "Failed to delete skill";
}

echo json_encode($response);
?>