<?php
session_start();
include '../Includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST['otp'];

    $storedOtp = $_SESSION['otp'] ?? '';
    $otpExpiry = $_SESSION['otp_expiry'] ?? 0;

    if (time() > $otpExpiry) {
        echo json_encode(["status" => "expired", "message" => "OTP has expired."]);
    } elseif ($enteredOtp == $storedOtp) {
        $_SESSION['otp_verified'] = true;
        echo json_encode(["status" => "success", "message" => "OTP verified successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect OTP. Please try again."]);
    }
}
?>