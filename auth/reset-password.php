<?php
include '../Includes/config.php';
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['otp'])) {
    header("Location: ../auth/forgot-password.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        try {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $email = $_SESSION['email'];
            $query = "UPDATE t_users SET password = :password WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                // Clear the OTP session
                unset($_SESSION['otp']);
                unset($_SESSION['email']);

                // Set success message and redirect to login page
                $_SESSION['success_message'] = "Password successfully updated! You may now log in.";
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Error updating password. Please try again.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="asset/img/qcpl-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-5">
                    <h4>Reset Your Password</h4>
                </div>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form action="../auth/reset-password.php" method="POST">
                    <div class="form-group">
                        <input type="password" id="new_password" class="form-control custom-input" name="new_password" placeholder="Enter New Password" required>
                        <small id="password-strength-text" class="form-text mt-1"></small>
                    </div>
                    <div class="form-group mt-3">
                        <input type="password" class="form-control custom-input" name="confirm_password" placeholder="Confirm New Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Reset Password</button>
                </form>
                <div class="text-center mt-3">
                    <a href="../auth/login.php" class="links">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../asset/js/reset-password.js"></script>
</body>
</html>