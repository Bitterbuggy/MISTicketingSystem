<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}


//IT staff table 
$sql = "SELECT * FROM t_users WHERE RoleId=3 " ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//update IT staff
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
])


;

    $_SESSION['success_message'] = "Successfully updated account!";
    header("Location: ../admin/ManageIT.php ");
    exit();
}
?>


