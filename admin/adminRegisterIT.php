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

<?php include 'adminRegisterIT.php'; ?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Bootstrap JS (include before </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Register IT Modal -->
    <div class="modal fade" id="registerITModal" tabindex="-1" aria-labelledby="registerITModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form action="register.php" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="registerITModalLabel">Register a New IT Staff</h5>
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
                  <input type="select" name="role" id="role" class="form-control" rows="3"></input>
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register IT</button>
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
              <!--<label>Password:</label>
              <input type="password" name="password" required><br>

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
     
</body> -->



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