<?php
session_start();
include '../Includes/config.php';

// Handle form submission
if (isset($_POST['request_account'])) {
    $user_email = htmlspecialchars($_POST['user_email']);
    $contact_no = htmlspecialchars($_POST['contact_no']);
    $account_type = $_POST['account_type'];
    $branch_id = $_POST['branch_id'] ?? null;

    if (!$branch_id) {
        $_SESSION['error_message'] = "Please select a branch.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Get branch details
    $stmt = $conn->prepare("SELECT b.BranchName, d.DistrictName FROM t_branch b JOIN t_district d ON b.DistrictId = d.DistrictId WHERE b.BranchId = ?");
    $stmt->execute([$branch_id]);
    $branch_info = $stmt->fetch(PDO::FETCH_ASSOC);

    $branch_name = $branch_info['BranchName'] ?? 'Unknown Branch';
    $district_name = $branch_info['DistrictName'] ?? 'Unknown District';

    if ($account_type === "employee") {
        // Get Branch Admin email
        $stmt = $conn->prepare("SELECT Email FROM t_users WHERE RoleId = 2 AND BranchId = ?");
        $stmt->execute([$branch_id]);
        $branch_admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($branch_admin) {
            $recipient_email = $branch_admin['Email'];
        } else {
            $_SESSION['error_message'] = "No branch admin found for the selected branch.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        $subject = "Employee Account Request: QCPL STS";
        $message = "Hello Branch Admin,\n\nA user is requesting an employee account for QCPL STS.\n\nEmail: $user_email\nContact: $contact_no\nBranch: $branch_name\n\nPlease process this request accordingly.";
    } else {
        // Send to system admin for branchadmin or IT
        $recipient_email = "aldehalseymeows@gmail.com";
        $subject = strtoupper($account_type) . " Account Request: QCPL STS";
        $message = "Hello Admin,\n\nA user is requesting an account for QCPL STS.\n\nType: $account_type\nEmail: $user_email\nContact: $contact_no\nBranch: $branch_name\n\nPlease process accordingly.";
    }

    $headers = "From: noreply@qcplsts.com";

    if (mail($recipient_email, $subject, $message, $headers)) {
        $_SESSION['success_message'] = "Your request has been sent. Please wait for further instructions via email.";
    } else {
        $_SESSION['error_message'] = "Failed to send your request. Please try again later.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: hsla(208, 43.10%, 74.50%, 0.78);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .request-box {
            background: #fff;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: rgb(32, 32, 160);
        }
        p{
            text-align: center;
        }

        form > div {
            margin-bottom: 1em;
        }

        label {
            display: block;
            margin-bottom: 0.3em;
        }

        input, select {
            width: 100%;
            padding: 0.5em;
            border: 1px solid #999;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 0.7em;
            background: rgb(32, 32, 160);
            color: white;
            font-size: 1em;
            border: none;
            border-radius: 5px;
        }

        .success {
            color: green;
            margin-top: 1em;
            text-align: center;
        }

        .error {
            color: red;
            margin-top: 1em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="request-box">
    <h2>Login Failed</h2>
        <p>Please input proper credentials.</p>
        <p>If you don't have an account, you can request one here:</p>
        <form method="post">
            <div>
                <label for="user_email">Email</label>
                <input type="email" name="user_email" required>
            </div>

            <div>
                <label for="contact_no">Contact Number</label>
                <input type="text" name="contact_no" required>
            </div>

            <div>
                <label for="account_type">Account Type</label>
                <select name="account_type" id="account_type" required>
                    <option value="">-- Select Type --</option>
                    <option value="employee">Employee</option>
                    <option value="branchadmin">Branch Admin</option>
                    <option value="it">IT</option>
                </select>
            </div>

            <div>
                <label for="branch_id">Select Branch</label>
                <select name="branch_id" required>
                    <option value="">-- Select Branch --</option>
                    <?php
                    $stmt = $conn->query("SELECT b.BranchId, b.BranchName, d.DistrictName 
                                          FROM t_branch b
                                          JOIN t_district d ON b.DistrictId = d.DistrictId");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['BranchId'] . '">' .
                             $row['BranchName'] . ' (' . $row['DistrictName'] . ')</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="request_account">Request Account</button>
        </form>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>

        <br><br>
        <div style="text-align:center;">
            <a href="../index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
