<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Update Password Modal -->
<div class="modal fade" id="updatePassModal" tabindex="-1" aria-labelledby="updatePassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePassModalLabel">Password Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controller/cims/update_password.php" method="post">
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password" required>
                        <small id="password-strength-text" class="form-text mt-1"></small>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>