<?php
include '../include/connection.php';
header('Content-Type: application/json');

// Join user_skills with users table
$sql = "SELECT 
            u.full_name, 
            u.profile_photo, 
            us.role, 
            us.skill_name, 
            us.id 
        FROM user_skills us
        INNER JOIN users u ON us.user_id = u.user_id
        ORDER BY us.id DESC
        LIMIT 20";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  $skills = [];
  while ($row = $result->fetch_assoc()) {
    // Ensure full profile photo path
    $row['profile_photo'] = !empty($row['profile_photo']) ? '../' . $row['profile_photo'] : '';
    $skills[] = $row;
  }
  echo json_encode(["status" => "success", "data" => $skills]);
} else {
  echo json_encode(["status" => "error", "message" => "No skills found"]);
}
?>