<?php
include '../Includes/config.php'; 
?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php if (isset($_SESSION['success_message'])): ?>
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-success text-white">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="successModalLabel">Success</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><?php echo nl2br($_SESSION['success_message']); ?></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var successModal = new bootstrap.Modal(document.getElementById('successModal'));
      successModal.show();
    });
  </script>
  <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>


<!-- Register IT Modal -->
<div class="modal fade" id="registerITModal" tabindex="-1" aria-labelledby="registerITModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4" style="background-color:#f9f9f9; border-radius: 8px;">
      <form action="../admin/register.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="registerITModalLabel">Register a New IT Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">
              <label>First Name:</label>
              <input type="text" class="form-control" name="first_name" required>
            </div>
            <div class="col">
              <label>Last Name:</label>
              <input type="text" class="form-control" name="last_name" required>
            </div>
          </div>

          <div class="mb-3">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="mb-3">
            <label>Contact No:</label>
            <input type="number" class="form-control" name="contactno" required>
          </div>

          <div class="mb-3">
            <label>Branch:</label>
            <select class="form-select" name="branch_id" required>
              <option value="">-- Select Branch --</option>
              <?php
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
            <input type="hidden" name="district_id" id="district_id">
          </div>

          <div class="mb-3">
            <label>Role:</label>
            <select class="form-select" name="role_id">
              <option value="3">ITstaff</option>
            </select>
          </div>

          <div id="admin_fields" style="display:none;">
            <div class="mb-3">
              <label>Position:</label>
              <input type="text" class="form-control" name="position">
            </div>
            <div class="mb-3">
              <label>Department:</label>
              <input type="text" class="form-control" name="department">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JS Scripts -->
<script>
  const branchSelect = document.querySelector('select[name="branch_id"]');
  const districtInput = document.getElementById('district_id');

  if (branchSelect) {
    branchSelect.addEventListener('change', function () {
      const selectedOption = branchSelect.options[branchSelect.selectedIndex];
      const districtId = selectedOption.getAttribute('data-district');
      districtInput.value = districtId;
    });
  }

  document.querySelector('select[name="role_id"]').addEventListener('change', function () {
    if (this.value == "1") {
      document.getElementById('admin_fields').style.display = 'block';
    } else {
      document.getElementById('admin_fields').style.display = 'none';
    }
  });

  // Modal closing
  document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('successModal');
    var span = document.querySelector('.modal .close');

    if (span) {
      span.onclick = function () {
        modal.style.display = "none";
      }
    }

    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  });
</script>
