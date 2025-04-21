<?php
session_start();
if (!isset($_SESSION['UserId'])) {
    header('Location: index.php');
    exit();
}
?>