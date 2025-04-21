<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}


//IT staff table 
$sql = "SELECT * FROM t_users 
        JOIN t_roles ON t_users.RoleId = t_roles.RoleId 
        WHERE t_users.RoleId = 2";

$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//update IT staff
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM t_users WHERE UserId = :id and RoleId=2";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];

    $sql = "UPDATE t_users SET FirstName = :firstName, LastName = :lastName, Email = :email, Contactno = :contactno WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'contactno' => $contactno,
        'id' => $id
    ]);

    $_SESSION['success_message'] = "Successfully updated account!";
    header("Location: ../admin/ManageBranch.php ");
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

    <!-- CSS Link -->
    <link rel="stylesheet" href="forms.css">

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
    <div class="row align-items-center vh-100">
        <div class="col-5 mx-auto">
            <!-- Include Sidebar -->
            <?php include '../admin/inc/admin-sidebar.php'; ?>

            <!-- Main Content -->
            <div class="container-fluid p-0 cont" id="body">
                <nav class="navbar sticky-top">
                    <div class="row no-gutters">
                        <div class="col-1">
                            <button type="button" class="toggler-btn">
                                <i class="fa-solid fa-align-justify"></i>
                            </button>
                        </div>
                    </div>
                </nav>

                <!-- Main Content Container -->
                <div class="main-content">
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


                    <!-- User Table -->
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user['UserId']; ?></td>
                                    <td><?php echo $user['FirstName']; ?></td>
                                    <td><?php echo $user['LastName']; ?></td>
                                    <td><?php echo $user['Email']; ?></td>
                                    <td><?php echo $user['Contactno']; ?></td>
                                    <td><?php echo $user['RoleName']; ?></td>
                                    <td>
                                       <a href="../admin/updateLICacc.php?id=<?php echo $user['UserId']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                       <a href="deleteLIC.php?id=<?php echo $user['UserId']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- Main Content Container End -->
            </div> <!-- Main Content End -->
        </div>
    </div>
</body>
</html>