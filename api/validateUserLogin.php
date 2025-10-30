<?php
header('Content-Type: application/json');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$response = [];

try {
  // Simulate form data
  $fullName = $_POST['fullName'] ?? 'Test User';
  $email = $_POST['email'] ?? 'akmission369@gmail.com';

  // Generate a test verification token
  $token = bin2hex(random_bytes(16)); // 32-character random string

  // Send verification email
  sendVerificationEmail($email, $token, $fullName);

  $response = [
    "status" => "success",
    "message" => "Test email sent successfully to $email. Check your inbox!"
  ];

} catch (Exception $e) {
  $response = [
    "status" => "error",
    "message" => $e->getMessage()
  ];
}

echo json_encode($response);


// Function to send email
function sendVerificationEmail($userEmail, $token, $fullName)
{
  $mail = new PHPMailer(true);

  try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gagansingh56sa@gmail.com'; // your Gmail
    $mail->Password = '12401240sa';   // app password if 2FA enabled
    $mail->SMTPSecure = 'ssl';  // or 'ssl' with port 465
    $mail->Port = 465;

    $mail->setFrom('gagansingh56sa@gmail.com', 'SkillSwap');
    $mail->addAddress($userEmail, $fullName);

    $mail->isHTML(true);
    $mail->Subject = 'Test Verify Your SkillSwap Account';
    $mail->Body = "Hi $fullName,<br><br>Click the link below to verify your email:<br>
                       <a href='http://localhost/skillswap/verify.php?token=$token'>Verify Email</a>";

    $mail->send();
  } catch (Exception $e) {
    throw new Exception("Mailer Error: " . $mail->ErrorInfo);
  }
}
?>