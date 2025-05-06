<?php
session_start();
include '../Includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete from role-specific tables first
    $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
    foreach ($roleTables as $table) {
        $sql = "DELETE FROM $table WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Delete from t_users
    $sql = "DELETE FROM t_users WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $_SESSION['success_message'] = "Successfully deleted account!";
    header("Location: ../admin/adminStaffMgmt.php");
    exit();
}
?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Font Awesome CDN Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Bootstrap JS (include before </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Confirm Deletion Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="adminDeleteIT.php" method="POST" class="modal-content md-cont p-3">
      <div class="modal-body text-center">
        <i class="fa-solid fa-trash md-icon"></i>
        <h2 class="modal-title">Confirm Deletion</h2>
        <p>Are you sure you want to delete this IT Staff account?</p>
        <input type="hidden" name="deleteUserId" id="deleteUserId">
        <button type="submit" class="btn btn-primary">Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Deletion Success Modal -->
<div class="modal fade" id="deletionSuccessModal" tabindex="-1" aria-labelledby="deletionSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content md-cont p-3">
      <div class="modal-body text-center">
        <i class="fa-regular fa-circle-check md-icon"></i>
        <h2 class="modal-title">Successfully Deleted</h2>
        <p>You have successfully deleted an IT Staff Account.</p>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
