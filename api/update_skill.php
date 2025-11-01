<?php
header('Content-Type: application/json');
include '../include/connection.php';

// Get POST data safely
$id = $_POST['id'] ?? 0;
$role = $_POST['role'] ?? '';
$skill_name = $_POST['skill_name'] ?? '';
$skill_level = $_POST['skill_level'] ?? '';
$preferred_mode = $_POST['preferred_mode'] ?? '';
$availability = $_POST['availability'] ?? '';
$description = $_POST['description'] ?? '';

$response = [];

// Prepare update statement
$stmt = $conn->prepare("UPDATE user_skills 
                        SET role = ?, skill_name = ?, skill_level = ?, preferred_mode = ?, availability = ?, description = ? 
                        WHERE id = ?");
$stmt->bind_param("ssssssi", $role, $skill_name, $skill_level, $preferred_mode, $availability, $description, $id);

// Execute and respond
if ($stmt->execute()) {
  $response['status'] = "success";
} else {
  $response['status'] = "error";
  $response['message'] = $conn->error;
}

echo json_encode($response);
?>