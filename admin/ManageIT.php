<script>
  var pageTitle = "IT Staff Management";
</script>

<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}


//IT Staff table 
$sql = "SELECT * FROM t_users 
        JOIN t_roles ON t_users.RoleId = t_roles.RoleId
        WHERE t_users.RoleId=3" ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Update IT staff
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM t_users WHERE UserId = :id and RoleId=3";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];

    $sql = "UPDATE t_users SET FirstName = :firstName, LastName = :lastName, Email = :email, Contactno = :contactno WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'contactno' => $contactno,
        'id' => $id
    ]);

    $_SESSION['success_message'] = "Successfully updated account!";
    header("Location: ../admin/ManageIT.php ");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Staff Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/admin-sidebar.css">
    <link rel="stylesheet" href="../asset/css/admin-dashboard.css">
    <link rel="stylesheet" href="../asset/css/admin-staff-mgmt.css">
    <link rel ="stylesheet" href="../asset/css/pagination.css">
    <link rel ="stylesheet" href="../asset/css/modals.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../admin/inc/admin-sidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
        <!-- Main Content -->
        <main class="px-4 py-5">
            <div class="col-12">
                 <div class="d-flex flex-wrap align-items-center justify-content-between mt-2">
                    <!-- Left: Add New Staff Button -->
                    <div style="flex: 0 0 auto;">
                        <div class="div-mods active" data-bs-toggle="modal" data-bs-target="#registerITModal">
                            <span class="mods">Register an IT Staff</span>
                        </div>
                    </div>

                  <!-- Right: Table Controls -->
                  <div class="d-flex flex-wrap align-items-center gap-3" style="flex: 1 1 auto; justify-content: flex-end;">
                    <?php
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT * FROM t_users 
        JOIN t_roles ON t_users.RoleId = t_roles.RoleId
        WHERE t_users.RoleId = 3";

if (!empty($search)) {
    $sql .= " AND (FirstName LIKE :search OR LastName LIKE :search OR Email LIKE :search)";
}

$stmt = $conn->prepare($sql);

if (!empty($search)) {
    $searchParam = "%" . $search . "%";
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
}

$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
                    <!-- Search Bar -->
<form method="GET" action="" class="d-flex mb-3" style="max-width: 380px;">
  <div class="input-group">
    <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" aria-label="Search" aria-describedby="search-icon">
    <button class="input-group-text control-btn" id="search-icon">
      <i class="fa fa-search"></i>
    </button>
  </div>
</form>


                    
                    <!-- Sort Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                            <i class="fa fa-sort me-1"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-arrow-down-short-wide me-2"></i>Ascending</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-arrow-up-short-wide me-2"></i>Descending</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
                </div>

        <!-- Table for displaying staff -->
            <div class="row no-gutters mt-3">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Staff ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                        <!-- <th>Role</th> -->
                                        <th>Actions</th>
                                    </tr>

                                    
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?php echo $user['UserId']; ?></td>
                                            <td><?php echo $user['FirstName']; ?></td>
                                            <td><?php echo $user['LastName']; ?></td>
                                            <td><?php echo $user['Email']; ?></td>
                                            <td><?php echo $user['Contactno']; ?></td>
                                            <!-- <td><?php echo $user['RoleName']; ?></td> -->
                                            <td>
                                            <button 
                                                class="btn btn-edit btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal<?php echo $user['UserId']; ?>">
                                                Edit
                                            </button>

                                                <a href="../admin/deleteITstaff.php?id=<?php echo $user['UserId']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="modal fade" id="editModal<?php echo $user['UserId']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <form method="POST" action="updateITacc.php">
                                <div class="modal-header">
                                <h5 class="modal-title">Edit IT Staff</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $user['UserId']; ?>">
                                <label>First Name:</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user['FirstName']; ?>" required>
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user['LastName']; ?>" required>
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $user['Email']; ?>" required>
                                <label>Contact No:</label>
                                <input type="text" name="contactno" class="form-control" value="<?php echo $user['Contactno']; ?>" required>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>

    

    <!-- Register IT Staff Modal -->
    <?php include 'addITstaff.php'; ?>
    <!-- Update IT Staff Modal -->
    <!--?php include 'adminUpdateIT.php'; ?-->
    <!-- Delete IT Staff Modal -->
    <!--?php include 'adminDeleteIT.php'; ?-->
    
    <!-- External JS Files -->
    <script src="../asset/js/admin-sidebar.js"></script>
</body>
</html>