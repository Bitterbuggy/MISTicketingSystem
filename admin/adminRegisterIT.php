<?php
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

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

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
            <form action="register.php" method="POST">
                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" name="firstName" id="Firstname" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" name="lastName" id="Lastname" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="emailAddress" class="form-label">Email</label>
                    <input type="text" name="emailAddress" id="Emailaddress" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="contactNumber" class="form-label">Contact Number</label>
                    <input type="text" name="contactNumber" id="Contactnumber" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="branchID" class="form-label">Branch ID</label>
                    <select name="branch_ID" id="BranchiD" class="form-control rounded-pill" required>
                        <option value="">-- Select Branch --</option>
                        <?php
                        // This query joins branch with district to get names
                        $stmt = $conn->query("SELECT b.BranchId, b.BranchName, b.DistrictId, d.DistrictName 
                                            FROM t_branch b
                                            JOIN t_district d ON b.DistrictId = d.DistrictId");

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['BranchId'] . '" data-district="' . $row['DistrictId'] . '">' .
                                    $row['BranchName'] . ' (' . $row['DistrictName'] . ')' .
                                '</option>';
                        }
                        ?>
                    </select> 
                </div>
                <div class="col-md-6">
                    <!-- Hidden district_id field to be set using JS -->
                    <label for="districtID" class="form-label">District ID</label>
                    <input type="hidden" name="district_id" id="district_id" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <select name="Role" id="role" class="form-control rounded-pill" rows="3">
                      <option value="3">IT Staff</option>
                  </select>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Register IT</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        </div>
    </div>

<script>
    const branchSelect = document.querySelector('select[name="branch_id"]');
    const districtInput = document.getElementById('district_id');

    branchSelect.addEventListener('change', function () {
        const selectedOption = branchSelect.options[branchSelect.selectedIndex];
        const districtId = selectedOption.getAttribute('data-district');
        districtInput.value = districtId;
    });
</script>

<!--script>
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
</!--script>-->