<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Collect form data
$name    = htmlspecialchars(trim($_POST["name"]));
$email   = htmlspecialchars(trim($_POST["email"]));
$message = htmlspecialchars(trim($_POST["message"]));

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your@gmail.com'; // Your Gmail
    $mail->Password   = 'your-app-password'; // Your Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($email, $name); // From user input
    $mail->addAddress('your@gmail.com', 'Your Name'); // Where to send

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Neue Nachricht von deiner Website';
    $mail->Body    = "
        <h3>Neue Nachricht von der Website</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Nachricht:</strong><br>" . nl2br($message) . "</p>
    ";

    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
