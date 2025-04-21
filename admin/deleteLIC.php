<?php
session_start();
include '../Includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete from role-specific tables first
    $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
    foreach ($roleTables as $table) {
        $sql = "DELETE FROM $table WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Delete from t_users
    $sql = "DELETE FROM t_users WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $_SESSION['success_message'] = "Successfully deleted account!";
    header("Location: ../admin/ManageBranch.php");
    exit();
}
?>
