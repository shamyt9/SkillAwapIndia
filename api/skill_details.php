<?php
include '../include/connection.php';
header('Content-Type: application/json');

$skill_id = isset($_GET['skill_id']) ? intval($_GET['skill_id']) : 0;

if ($skill_id <= 0) {
  echo json_encode(['status' => 'error', 'message' => 'Invalid skill ID']);
  exit;
}

$sql = "
SELECT 
    us.id,
  
    us.skill_name,
    us.skill_level,
    us.preferred_mode,
    us.availability,
    us.description,
    us.created_at,
    u.full_name,
    u.profile_photo,
    us.role,
    u.city,
    u.country
FROM user_skills us
JOIN users u ON us.user_id = u.user_id
WHERE us.id = ?
LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $skill_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
  $data = $result->fetch_assoc();
  echo json_encode(['status' => 'success', 'data' => $data]);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Skill not found']);
}
?>