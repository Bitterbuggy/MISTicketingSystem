<?php
include 'Includes/check_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Home</title>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['FirstName']; ?>!</h2>
<p>You are logged in as a regular user.</p>
<a href="auth/logout.php">Logout</a>

</body>
</html>