<?php
require_once '../Includes/config.php';

$loggedInEmployeeId = $_SESSION['UserId'] ?? null;

if (!$loggedInEmployeeId) {
    // redirect to login or show error
    exit('User not logged in');
}

// Fetch employee info with district and branch
$stmt = $conn->prepare("
    SELECT 
        ue.EmployeeId,
        u.UserId,
        u.FirstName,
        u.LastName,
        u.Email,
        u.ContactNo,
        u.DistrictId,
        u.BranchId,
        d.DistrictName,
        b.BranchName
    FROM t_users u
    INNER JOIN t_useremp ue ON u.UserId = ue.UserId
    LEFT JOIN t_district d ON u.DistrictId = d.DistrictId
    LEFT JOIN t_branch b ON u.BranchId = b.BranchId
    WHERE u.UserId = ?
");
$stmt->execute([$loggedInEmployeeId]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch other dropdown data for form (issue types, subtypes, assets)
$issues = $conn->query("SELECT * FROM t_issuedtype")->fetchAll(PDO::FETCH_ASSOC);
$subtypes = $conn->query("SELECT * FROM t_issuedsubtype")->fetchAll(PDO::FETCH_ASSOC);
$assets = $conn->query("SELECT * FROM t_asset")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Bootstrap CSS (required) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- External CSS Link/s -->
<link rel="stylesheet" href="asset/css/modals.css">
<link rel="stylesheet" href="asset/css/buttons.css">

<!-- Bootstrap JS (required for modal to function) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Submit Ticket Modal -->
<div class="modal-fade" id="submitTicketModal" tabindex="-1" aria-labelledby="submitTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="submitTicketModalLabel">Submit A Ticket</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form action="../employee/create_ticket.php" method="POST">
                <div class="form-container">
                    <div class="form-row">
                        <label for="asset">Asset:</label>
                        <input type="text" id="assetSearch" placeholder="Search Asset" required/>
                    </div>

                    <div class="form-row issue-row">
                        <label for="issueType">Issue Type:</label>
                        <select name="IssueId[]" id="issueType" required>
                            <option value="">Select Issue</option>
                                <?php foreach ($issues as $issue): ?>
                                    <option value="<?= $issue['IssueId'] ?>"><?= htmlspecialchars($issue['IssueType']) ?></option>
                                <?php endforeach; ?>
                        </select>

                        <label for="issueSubtype">Issue Subtype:</label>
                        <select name="SubtypeId[]" id="issueSubtype" required>
                            <option value="">Select Subtype</option>
                                <?php foreach ($subtypes as $sub): ?>
                                    <option value="<?= $sub['SubtypeId'] ?>"><?= htmlspecialchars($sub['SubtypeName']) ?></option>
                                <?php endforeach; ?>
                        </select>


                        <label for="description">Description:</label>
                        <input type="text" id="description" required></input>

                        <div class="btn-group">
                            <button type="button"><i class="fa fa-circle-plus"></i></button>
                            <button type="button"><i class="fa fa-circle-minus"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-submit">Submit</button>
        </div>
    </div>
</div>