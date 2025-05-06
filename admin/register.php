<?php
session_start();
$_SESSION['success_message'] = "Successfully added an account!";
include '../Includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $districtId = $_POST['district_id'];
    $branchId = $_POST['branch_id'];
    $roleId = $_POST['role_id']; // 1 for Admin, 2 for Staff, etc.
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rawPassword = bin2hex(random_bytes(4)); // Generates an 8-character secure random password
    $password = password_hash($rawPassword, PASSWORD_DEFAULT);

    // Insert into t_users
    $sql = "INSERT INTO t_users (FirstName, LastName, Email, Contactno, DistrictId, BranchId, Password, RoleId)
            VALUES (:firstName, :lastName, :email, :contactno, :districtId, :branchId, :password, :roleId)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'contactno' => $contactno,
        'districtId' => $districtId,
        'branchId' => $branchId,
        'password' => $password,
        'roleId' => $roleId
    ]);

    // Get the last inserted UserId
    $userId = $conn->lastInsertId();

    // If role is Admin, insert into t_admin
    if ($roleId == 1) {
        $adminId = uniqid('admin_');
        $position = $_POST['position'];
        $department = $_POST['department'];

        $sql = "INSERT INTO t_admin (AdminId, UserId, Position, Department) 
                VALUES (:adminId, :userId, :position, :department)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'adminId' => $adminId,
            'userId' => $userId,
            'position' => $position,
            'department' => $department
        ]);
    }

    if ($roleId == 2) {
        $branchadminId = uniqid('branchadmin_');
        $position = $_POST['position'];
        $department = $_POST['department'];
    
        $sql = "INSERT INTO t_branchadmin (BranchAdminId, UserId, Position, Department) 
                VALUES (:branchadminId, :userId, :position, :department)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'branchadminId' => $branchadminId,
            'userId' => $userId,
            'position' => $position,
            'department' => $department
        ]);
    }
    

    // If role is ITstaff, insert into t_branchadmin
    if ($roleId == 3) {
        $itstaffId = uniqid('itstaff_');
        $position = $_POST['position'];
        $department = $_POST['department'];

        $sql = "INSERT INTO t_itstaff (ITstaffId, UserId, Position, Department) 
                VALUES (:itstaffId, :userId, :position, :department)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'itstaffId' => $itstaffId,
            'userId' => $userId,
            'position' => $position,
            'department' => $department
        ]);
    }

    // If role is userEmployee, insert into t_useremp
    if ($roleId == 4) {
        $employeeId = uniqid('employee_');
        $position = $_POST['position'];
        $department = $_POST['department'];

        $sql = "INSERT INTO t_useremp (employeeId, UserId, Position, Department) 
                VALUES (:employeeId, :userId, :position, :department)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'employeeId' => $employeeId,
            'userId' => $userId,
            'position' => $position,
            'department' => $department
        ]);
    }

     // Send email to the user
     $subject = "Your QCPL STS Account Credentials";
     $message = "Hello $firstName $lastName,\n\n".
                "Your account has been successfully created.\n".
                "Here are your login credentials:\n\n".
                "Email: $email\n".
                "Password: $rawPassword\n\n".
                "Please keep this information secure and change your password after logging in.\n\n".
                "Best regards,\nQCPL STS Admin";
     $headers = "From:  aldehalseymeows@gmail.com";
 
     mail($email, $subject, $message, $headers); // Make sure mail service is configured

 // Set success message in session with email and password
 $_SESSION['success_message'] = "Successfully added an account!<br>Email: $email<br>Temporary Password: $rawPassword";
  


    header("Location: " . $_SERVER['HTTP_REFERER']); 
    exit();
}
?>
