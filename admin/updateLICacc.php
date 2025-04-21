<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}


//IT staff table 
$sql = "SELECT * FROM t_users WHERE RoleId=2" ;
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
    header("Location: ../admin/ManageIT.php ");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
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
            <!--<div class="col-8 sticky-top" style="width: 60rem; margin-left: 2rem; margin-top: -2.2rem;">
                <h1 class="nav-title">Dashboard</h1>
            </div>-->
        </div>
    </nav>
   

     <!-- Main Content Container -->
     <div class="main-content" style="margin-left: 260px; padding: 20px;">
       
       
        <form method="POST">
        <input type="hidden" name="id" value="<?php echo $user['UserId']; ?>">
        First Name: <input type="text" name="first_name" value="<?php echo $user['FirstName']; ?>" required><br>
        Last Name: <input type="text" name="last_name" value="<?php echo $user['LastName']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $user['Email']; ?>" required><br>
        Contact No: <input type="text" name="contactno" value="<?php echo $user['Contactno']; ?>" required><br>
        <button type="submit">Update</button>
        <a href="../admin/ManageBranch.php"> Back</a>
    </form>

        
        
     </div>

           
</body>