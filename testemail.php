<?php
$to = "ashleydelacruzasc01@gmail.com"; // Gamitin mo ibang email para sa testing
$subject = "📧 Test Email from Localhost using Gmail SMTP";
$message = "Hello! This is a test email sent from XAMPP localhost via Gmail SMTP.";
$headers = "From: aldehalseymeows@gmail.com";

if(mail($to, $subject, $message, $headers)) {
    echo "✅ Email sent successfully!";
} else {
    echo "❌ Email sending failed.";
}
?>

    