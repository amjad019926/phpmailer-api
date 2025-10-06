<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header('Content-Type: application/json');

$email = $_POST['email'] ?? null;
$text  = $_POST['text'] ?? null;

if (!$email || !$text) {
    echo json_encode(["status" => "error", "message" => "Email or text missing"]);
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // FIXED
    $mail->SMTPAuth   = true;
    $mail->Username   = 'amjad019926@gmail.com';
    $mail->Password   = 'snqi roxk gwkv rtmq'; // Use App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('amjad019926@gmail.com', 'Mailer API');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Test Mail from API';
    $mail->Body    = $text;

    $mail->send(); // ACTUALLY SENDS THE EMAIL

    echo json_encode(["status" => "success", "message" => "Mail sent"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $mail->ErrorInfo]);
}
