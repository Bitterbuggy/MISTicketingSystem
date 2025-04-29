<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

//if (isset($_SESSION['success_message'])) {
   // echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
   // unset($_SESSION['success_message']); // Remove the message after displaying
//}
if (isset($_SESSION['success_message'])): ?>
    <div id="successModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <p><?php echo $_SESSION['success_message']; ?></p>
      </div>
    </div>
    <?php unset($_SESSION['success_message']); ?>
    <?php endif; 
    
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
/* The Modal (background) */
.modal {
  display: block; /* Show the modal by default if it exists */
  position: fixed;
  z-index: 1000;
  padding-top: 150px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 30px;
  border: 1px solid #888;
  width: 400px;
  border-radius: 10px;
  position: relative;
  text-align: center;
}

/* The Close Button */
.close {
  color: #aaa;
  position: absolute;
  right: 15px;
  top: 10px;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
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
        <p>You are now logged in as Admin.</p>
        <br>
        <div class="card shadow-lg">
                <div class="card-body">
                    <div class="text-center mb-5 logo">
                        <img src="../asset/img/qcpl-logo.png" alt="Logo" class="logo" width="120px">
                        <p class="p-2 mb-5">QUEZON CITY PUBLIC LIBRARY</p>
                    </div>

                    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>

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
                    <!--<label>Password:</label>
                    <input type="password" name="password" required><br>-->

                    <label>Role:</label>
                    <select name="role_id">
                       
                        <option value="3">ITstaff</option>
                      


                    </select><br>

                    <div id="admin_fields" style="display:none;">
                        <label>Position:</label>
                        <input type="text" name="position"><br>
                        <label>Department:</label>
                        <input type="text" name="department"><br>
                    </div>

                    <button type="submit">Register</button>
                    </form>

                    <a href="../admin/ManageIT.php">Back</a>              

    <script src="../assets/js/auth/admin/gen_login.js"></script>
    
</div>

           
</body>



<!--<body>

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



<script>
    document.querySelector('select[name="role_id"]').addEventListener('change', function () {
        if (this.value == 1) {
            document.getElementById('admin_fields').style.display = 'block';
        } else {
            document.getElementById('admin_fields').style.display = 'none';
        }
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('successModal');
  var span = document.getElementsByClassName('close')[0];

  span.onclick = function() {
    modal.style.display = "none";
  }

  // Optional: Close modal when clicking outside the modal content
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});
</script>


</body>
</html>