<?php
session_start();

include '../Includes/check_session.php';
include '../Includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST['otp'];

    // Get the stored OTP and expiry from session
    $storedOtp = $_SESSION['otp'] ?? '';
    $otpExpiry = $_SESSION['otp_expiry'] ?? 0;

    if (time() > $otpExpiry) {
        echo json_encode(["status" => "expired", "message" => "OTP has expired."]);
    } elseif ($enteredOtp == $storedOtp) {
        // Success - OTP is correct
        echo json_encode(["status" => "success", "message" => "OTP verified successfully."]);
        // You can now redirect to a reset password page, or set a session flag
        $_SESSION['otp_verified'] = true;
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect OTP. Please try again."]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-logo.png">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- External CSS -->
    <link rel="stylesheet" href="asset/css/verify-otp.css"> 
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-5 logo">
                    <img src="../asset/img/qcpl-logo.png" alt="QCPL Logo" class="logo" width="100px">
                    <h3 class="text-center mt-0">QCPL</h3>
                    <h4 class="text-center mt-0">Verify OTP</h4>
                </div>
                
                <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
                
                <form id="verify-otp-form">
                    <div class="form-group">
                        <input type="text" class="form-control custom-input" id="otp" name="otp" placeholder="Enter the 6-Digit One-Time Pin" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Verify OTP</button>
                    <button id="resend-otp-btn" class="btn btn-light w-100 mt-3"
                        style="background-color: #b9c5d7; color: #003194; border: none;" disabled>Send Another Code
                        (<span id="timer">60</span>s)
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="../asset/js/verify-otp.js"></script>

</body>
</html>