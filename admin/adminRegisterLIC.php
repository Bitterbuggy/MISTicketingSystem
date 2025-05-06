<?php
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}
?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Register LIC Modal -->
    <div class="modal fade" id="registerLICModal" tabindex="-1" aria-labelledby="registerLICModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form action="register.php" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="registerLICModalLabel">Register a New LIC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="adminRegisterAsset.php" method="POST">
                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="branchId" class="form-label">First Name</label>
                    <input type="text" name="Branch" id="branch" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="assetTypeId" class="form-label">Last Name</label>
                    <input type="text" name="AssetType" id="assetType" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="assetName" class="form-label">Email</label>
                    <input type="text" name="AssetName" id="assetName" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="serialNumber" class="form-label">Contact Number</label>
                    <input type="text" name="SerialNumber" id="serialNumber" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="purchasedDate" class="form-label">District ID</label>
                    <input type="number" name="PurchasedDate" id="purchasedDate" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="assetStatus" class="form-label">Branch ID</label>
                    <input type="number" name="AssetStatus" id="assetStatus" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <input type="select" name="Role" id="role" class="form-control rounded-pill" rows="3"></input>
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register LIC</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        </div>
    </div>

<!-- [DRAFT] Updated form with action to register.php 
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

</div> 
</div> 
</div>
</div -->

<!--script>
document.querySelector('select[name="role_id"]').addEventListener('change', function () {
if (this.value == 1) {
document.getElementById('admin_fields').style.display = 'block';
} else {
document.getElementById('admin_fields').style.display = 'none';
}
});
</!--script>
</body>
</html> -->

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
