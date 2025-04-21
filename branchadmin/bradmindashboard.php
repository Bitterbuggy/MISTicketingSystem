<?php

include '../Includes/config.php';
include '../Includes/check_session.php';
if ($_SESSION['RoleId'] != 2) {
    header('Location: home.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-logo.png">

    <!-- CSS Link/s -->
    <link rel="stylesheet" href="../asset/css/sidenavbar_admin.css">

    <!-- Bootstrap CSS -->
    <link href="../../vendor/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body style="background-color: #f3f2f7;">
    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include '../branchadmin/inc/LIC-sidebar.php'; ?>

        <!-- Main Content -->
        <div class="container-fluid p-0 cont" id="body">
             
            <nav class="navbar sticky-top">
                <div class="row no-gutters">
                    <div class="col-1">
                        <button type="button" class="toggler-btn">
                            <i class="fa-solid fa-align-justify"></i>
                        </button>
                    </div>
                    <!--<div class="col-8 sticky-top" style="width: 60rem; margin-left: 2rem; margin-top: -2.2rem;">
                        <h1 class="nav-title">Dashboard</h1>
                    </div>-->
                </div>
            </nav>
           

             <!-- Main Content Container -->
             <div class="main-content" style="margin-left: 260px; padding: 20px;">
                <h2>Welcome LIC, <?php echo $_SESSION['FirstName']; ?>!</h2>
                <p>You are now logged in as Library-In-Charge.</p>
                <br>
                
        </div>
    </div>
</body>
</html>