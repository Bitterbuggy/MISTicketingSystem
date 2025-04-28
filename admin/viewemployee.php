<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}


//IT staff table 
$sql = "SELECT * FROM t_users WHERE RoleId=4 " ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/admin-sidebar.css">
    <link rel="stylesheet" href="../asset/css/admin-dashboard.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        td a {
            color: #007bff;
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }
        /* Add some padding to the container */
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        /* Style for the header */
        h2 {
            color: #343a40;
            font-size: 1.8rem;
        }
       /* Style for SubNavbar */
.SubNavbar ul {
    list-style: none; /* Remove default list bullets */
    padding: 0;
    margin: 0;
    display: flex; /* Flexbox for horizontal alignment */
}

.SubNavbar li {
    margin-right: 20px; /* Space between links */
}

.SubNavbar a {
    display: block;
    padding: 10px 20px;
    background-color: #f8f9fa;
    color: #007bff;
    text-decoration: none;
    border-radius: 5px;
}

.SubNavbar a:hover {
    background-color: #0056b3;
    color: white;
}

    </style>
</head>

<body>
    <div class="layout-container d-flex">
    
            <!-- Include Sidebar -->
            <?php include '../admin/inc/admin-sidebar.php'; ?>

             <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">

<!-- Main Content (separate from header) -->
<main class="px-4 py-5">
    <div class="row align-items-stretch">
                    <h2>Welcome Admin, <?php echo $_SESSION['FirstName']; ?>!</h2>
                    <p>Manage Branch</p>
                    <br>
                    <div class="SubNavbar">
                        <ul>
                            <li><a href="../admin/ManageBranchAdmin.php">Add Library-In-Charge</a></li>
                            <li><a href="../admin/viewemployee.php">View Employee</a></li>
                            <li><a href="#">Equipments</a></li>
                        </ul>
                    </div>


        <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact No.</th>
            <th>Role</th>
            
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['UserId']; ?></td>
                <td><?php echo $user['FirstName']; ?></td>
                <td><?php echo $user['LastName']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Contactno']; ?></td>
                <td><?php echo $user['RoleId']; ?></td>
           
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="../admin/ManageBranch.php"> Back</a>
        
     </div>

           
</body>
</html>