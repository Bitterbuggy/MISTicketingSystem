<?php
include '../Includes/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Regenerate OTP
    $otp = rand(100000, 999999);  // Generate a 6-digit OTP
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expiry'] = time() + 300;  // OTP will expire in 5 minutes

    // Simulate sending OTP (add your actual email sending logic here)
    $email = $_SESSION['email'];  // Ensure email is stored in session
    $subject = "Your OTP for Password Reset";
    $message = "Your One-Time Password (OTP) is: $otp\n\nIt will expire in 5 minutes.";
    $headers = "From: aldehalseymeows@gmail.com";

    if (mail($email, $subject, $message, $headers)) {
        echo json_encode(["status" => "success", "message" => "OTP sent successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send OTP. Please try again later."]);
    }
}
?>