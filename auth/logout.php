<?php
include '../Includes/check_session.php'; // Already contains session_start()
include '../Includes/config.php'; // Required for $conn

if (isset($_SESSION['UserId'])) {
    $userId = $_SESSION['UserId'];

    // Insert logout activity
    $sql = "INSERT INTO t_activitylogs (UserId, activity_type) VALUES (:UserId, 'logout')";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['UserId' => $userId]);

    // Clear session data
    session_unset();
    session_destroy();

    // Redirect with logout message
    header('Location: ../index.php?msg=loggedout');
    exit();
} else {
    // No user logged in, just redirect
    header('Location: ../index.php');
    exit();
}
?>
