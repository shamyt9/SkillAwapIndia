<?php
header('Content-Type: application/json');
include '../include/connection.php';

// Check if skill ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $skillId = intval($_GET['id']);
  $response = [];


  $stmt = $conn->prepare("SELECT id, role, skill_name, skill_level, preferred_mode, availability, description FROM user_skills WHERE id = ?");
  $stmt->bind_param("i", $skillId);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $skill = $result->fetch_assoc();

      echo json_encode([
        'id' => $skill['id'],
        'role' => $skill['role'],
        'skill_name' => $skill['skill_name'],
        'skill_level' => $skill['skill_level'],
        'preferred_mode' => $skill['preferred_mode'],
        'availability' => $skill['availability'],
        'description' => $skill['description']
      ]);
    } else {
      echo json_encode(['error' => 'Skill not found']);
    }
  } else {
    echo json_encode(['error' => $conn->error]);
  }
} else {
  echo json_encode(['error' => 'Invalid skill ID']);
}
?>