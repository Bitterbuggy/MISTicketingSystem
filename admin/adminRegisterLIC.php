<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}
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


                     <!-- Updated form with action to register.php -->
        <form action="../admin/register.php" method="POST" >
                    <label>First Name:</label>
                    <input type="text" name="first_name" required><br>
                    <label>Last Name:</label>
                    <input type="text" name="last_name" required><br>
                    <label>Email:</label>
                    <input type="email" name="email" required><br>
                    <label>Contact No:</label>
                    <input type="number" name="contactno" required><br>
                    <label>District ID:</label>
                    <input type="number" name="district_id" required><br>
                    <label>Branch ID:</label>
                    <input type="number" name="branch_id" required><br>
                    <label>Password:</label>
                    <input type="password" name="password" required><br>

                    <label>Role:</label>
                    <select name="role_id">
                    
                        <option value="2">BranchAdmin</option> 
                        


                    </select><br>

                    <div id="admin_fields" style="display:none;">
                        <label>Position:</label>
                        <input type="text" name="position"><br>
                        <label>Department:</label>
                        <input type="text" name="department"><br>
                    </div>

                    <button type="submit">Register</button>
                    <a href="../admin/ManageBranch.php"> Back</a>
                    </form>

                </div> <!-- Main Content Container End -->
            </div> <!-- Main Content End -->
        </div>
    </div>

    <script>
    document.querySelector('select[name="role_id"]').addEventListener('change', function () {
        if (this.value == 1) {
            document.getElementById('admin_fields').style.display = 'block';
        } else {
            document.getElementById('admin_fields').style.display = 'none';
        }
    });
</script>
</body>
</html>



     <!-- Main Content Container 
     <div class="main-content" style="margin-left: 260px; padding: 20px;">
        Updated form with action to register.php 
        <form action="../admin/register.php" method="POST" >
                    <label>First Name:</label>
                    <input type="text" name="first_name" required><br>
                    <label>Last Name:</label>
                    <input type="text" name="last_name" required><br>
                    <label>Email:</label>
                    <input type="email" name="email" required><br>
                    <label>Contact No:</label>
                    <input type="number" name="contactno" required><br>
                    <label>District ID:</label>
                    <input type="number" name="district_id" required><br>
                    <label>Branch ID:</label>
                    <input type="number" name="branch_id" required><br>
                    <label>Password:</label>
                    <input type="password" name="password" required><br>

                    <label>Role:</label>
                    <select name="role_id">
                        <option value="1">Admin</option>
                        <option value="2">BranchAdmin</option> 
                        <option value="3">ITstaff</option>
                        <option value="4"> UserEmp </option>


                    </select><br>

                    <div id="admin_fields" style="display:none;">
                        <label>Position:</label>
                        <input type="text" name="position"><br>
                        <label>Department:</label>
                        <input type="text" name="department"><br>
                    </div>

                    <button type="submit">Register</button>
                    <a href="../admin/ManageBranch.php"> Back</a>
                    </form>

     </div>-->

           

<!--<body>
    <div class="row align-items-center vh-100">
        <div class="col-5 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="text-center mb-5 logo">
                        <img src="asset/img/qcpl-logo.png" alt="Logo" class="logo" width="120px">
                        <p class="p-2 mb-5">QUEZON CITY PUBLIC LIBRARY</p>
                    </div>

                    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>

                   Updated form with action to register.php 
                    <form action="../admin/register.php" method="POST" >
                    <label>First Name:</label>
                    <input type="text" name="first_name" required><br>
                    <label>Last Name:</label>
                    <input type="text" name="last_name" required><br>
                    <label>Email:</label>
                    <input type="email" name="email" required><br>
                    <label>Contact No:</label>
                    <input type="number" name="contactno" required><br>
                    <label>District ID:</label>
                    <input type="number" name="district_id" required><br>
                    <label>Branch ID:</label>
                    <input type="number" name="branch_id" required><br>
                    <label>Password:</label>
                    <input type="password" name="password" required><br>

                    <label>Role:</label>
                    <select name="role_id">
                        <option value="1">Admin</option>
                        <option value="2">BranchAdmin</option> 
                        <option value="3">ITstaff</option>
                        <option value="4"> UserEmp </option>


                    </select><br>

                    <div id="admin_fields" style="display:none;">
                        <label>Position:</label>
                        <input type="text" name="position"><br>
                        <label>Department:</label>
                        <input type="text" name="department"><br>
                    </div>

                    <button type="submit">Register</button>
                    </form>

                   

    <script src="../assets/js/auth/admin/gen_login.js"></script>
</body>



<body>

<h2>Login</h2>
<form action="login.php" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<hr>

<h2>Register</h2>
<form action="register.php" method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" required><br>
    <label>Last Name:</label>
    <input type="text" name="last_name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Contact No:</label>
    <input type="number" name="contactno" required><br>
    <label>District ID:</label>
    <input type="number" name="district_id" required><br>
    <label>Branch ID:</label>
    <input type="number" name="branch_id" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Role:</label>
    <select name="role_id">
        <option value="1">Admin</option>
        <option value="2">BranchAdmin</option> 
        <option value="3">ITstaff</option>
        <option value="4"> UserEmp </option>


    </select><br>

    <div id="admin_fields" style="display:none;">
        <label>Position:</label>
        <input type="text" name="position"><br>
        <label>Department:</label>
        <input type="text" name="department"><br>
    </div>

    <button type="submit">Register</button>
</form>-->
