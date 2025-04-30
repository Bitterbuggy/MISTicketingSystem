<?php
session_start();
include 'Includes/config.php'; // PDO connection ($conn)

$userId = $_SESSION['UserId']; // Current logged-in UserId

// 1. Fetch FirstName, LastName, Email, Contactno from t_users
$stmt = $conn->prepare("SELECT FirstName, LastName, Email, Contactno, BranchId, DistrictId FROM t_users WHERE UserId = :userId LIMIT 1");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);  // Fetch one user

// 2. Fetch EmployeeId from t_useremp where FK is UserId
$stmtEmp = $conn->prepare("SELECT EmployeeId FROM t_useremp WHERE UserId = :userId LIMIT 1");
$stmtEmp->bindParam(':userId', $userId);
$stmtEmp->execute();
$userEmp = $stmtEmp->fetch(PDO::FETCH_ASSOC);  // Fetch one employee

if ($userEmp) {
    $employeeId = $userEmp['EmployeeId'];
} else {
    $employeeId = null; // or handle error: employee not found
}

$branchId = $user['BranchId'] ?? null;
$districtId = $user['DistrictId'] ?? null;

if (isset($_POST['submit_ticket'])) {
    $issueId = $_POST['issue_type'];
    $subtypeId = $_POST['subtype_id'];
    $description = $_POST['description'];
    $assetId = $_POST['asset_id'];
    $priority = $_POST['priority']; // dapat may priority input sa form mo
    $ticketStatus = 'Pending'; // or default value you want
    $timeSubmitted = date('Y-m-d H:i:s'); // current datetime
    $timeResolved = null; // NULL kasi hindi pa resolved

    if ($employeeId && $branchId && $districtId && $assetId) {
        try {
            $query = "INSERT INTO t_tickets 
                    (EmployeeId, BranchId, DistrictId, AssetId, IssueId, SubtypeId, Description, TicketStatus, Priority, TimeSubmitted, TimeResolved)
                    VALUES 
                    (:employeeId, :branchId, :districtId, :assetId, :issueId, :subtypeId, :description, :ticketStatus, :priority, :timeSubmitted, :timeResolved)";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':employeeId', $employeeId);
            $stmt->bindParam(':branchId', $branchId);
            $stmt->bindParam(':districtId', $districtId);
            $stmt->bindParam(':assetId', $assetId);
            $stmt->bindParam(':issueId', $issueId);
            $stmt->bindParam(':subtypeId', $subtypeId);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':ticketStatus', $ticketStatus);
            $stmt->bindParam(':priority', $priority);
            $stmt->bindParam(':timeSubmitted', $timeSubmitted);
            $stmt->bindParam(':timeResolved', $timeResolved);

            if ($stmt->execute()) {
                echo "<script>alert('Ticket successfully submitted!'); window.location.href='your_redirect_page.php';</script>";
                exit();
            } else {
                echo "<script>alert('Failed to submit ticket. Please try again.');</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Error: Missing EmployeeId, BranchId, DistrictId or AssetId.');</script>";
    }
}
?>


<!-- === HTML FORM === -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Ticket</title>
</head>
<body>

<h2>Create New Ticket</h2>

<form method="POST" action="">
    <!-- Auto-Display Information -->
    <input type="hidden" name="employee_id" value="<?php echo htmlspecialchars($employeeId); ?>">
    <input type="hidden" name="branch_id" value="<?php echo htmlspecialchars($branchId); ?>">
    <input type="hidden" name="district_id" value="<?php echo htmlspecialchars($districtId); ?>">

    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['FirstName']) . ' ' . htmlspecialchars($user['LastName']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
<p><strong>Contact No:</strong> <?php echo htmlspecialchars($user['Contactno']); ?></p>


    <!-- Issue Type (Radio Buttons) -->
    <p><strong>Issue Type:</strong></p>
    <label><input type="radio" name="issue_type" value="1" required> Hardware</label><br>
    <label><input type="radio" name="issue_type" value="2" required> Software</label><br>
    <label><input type="radio" name="issue_type" value="3" required> Network</label><br>

    <!-- Sub-Issue Type (Dropdown) -->
    <p><strong>Sub-Issue Type:</strong></p>
    <select name="subtype_id" id="subtype-dropdown" required>
        <option value="">-- Select Issue Type First --</option>
    </select>

    <!-- Description -->
    <p><strong>Description:</strong></p>
    <textarea name="description" rows="5" cols="40" placeholder="Describe your issue..." required></textarea>

    <br><br>
    <button type="submit" name="submit_ticket">Submit Ticket</button>
</form>

<script>
// Change the sub-issue dropdown based on selected issue type
const subtypeDropdown = document.getElementById('subtype-dropdown');

const subIssueOptions = {
    1: ['Keyboard', 'Mouse', 'Monitor', 'Printer', 'System Unit'],
    2: ['System Error', 'Installation Issue', 'Application Crash', 'License Expiration'],
    3: ['No Internet', 'Slow Connection', 'VPN Issue', 'Network Cable Problem']
};

document.querySelectorAll('input[name="issue_type"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const issueId = this.value;
        let options = '<option value="">-- Select Sub-Issue --</option>';
        if (subIssueOptions[issueId]) {
            subIssueOptions[issueId].forEach((subissue, index) => {
                options += `<option value="${index + 1}">${subissue}</option>`;
            });
        }
        subtypeDropdown.innerHTML = options;
    });
});
</script>

</body>
</html>
