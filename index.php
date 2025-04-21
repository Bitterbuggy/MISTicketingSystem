<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS Login</title>
    <link rel="icon" type="image/x-icon"  alt="qcpl_logo" href="asset/img/qcpl-logo.png">

    <!-- Link for Bootstrap -->
    <!--<link href="../vendor/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->

    <!-- CSS Link -->
    <!--<link rel="stylesheet" href="forms.css">-->
     <!-- Bootstrap 5 CDN -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- External CSS -->
    <link rel="stylesheet" href="asset/css/login.css"> 
    
</head>

<div class="overlay">
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="row login-container shadow-lg">
            <!-- Left Side: Image -->
            <div class="col-lg-6 d-none d-lg-block image-container">
                <h3 class="text-center mt-0">Quezon City Public Library</h3>
                <h4 class="text-center mt-0">Support Ticketing System</h4>
                <img src="asset/img/qclib1.png" class="img-fluid" alt="QCPL Main">
            </div>

            <!-- Right Side: Login Form -->
            <div class="col-lg-6 p-5 d-flex flex-column justify-content-center">
                <h2 class="mb-3"><span class="dot"></span> Log In</h2>
                <p class="text-muted">Welcome back! Please enter your credentials:</p>

                <form action="auth/login.php" method="POST" id="login-form">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control custom-input" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                        <!--<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>-->
                        <input type="password" class="form-control custom-input" id="password-input" name="password" placeholder="Enter your password" required>
                            <span class="input-group-text custom-icon">
                                <i class="fa-solid fa-eye-slash" id="toggle-password" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Log in</button>
                </form>
                <div class="text-center mt-3">
                    <a href="auth/forgot-password.php" class="links">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<body>
    <div class="row align-items-center vh-100">
        <div class="col-5 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="text-center mb-5 logo">
                        <img src="asset/qcpl-logo.png" alt="Logo" class="logo" width="120px">
                        <p class="p-2 mb-5">QUEZON CITY PUBLIC LIBRARY</p>
                    </div>

                    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>

                    <!-Updated form with action to login.php 
                    <form action="login.php" method="POST" id="login-form">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Sign in</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="gen_forgot_password.html" class="links">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/auth/admin/gen_login.js"></script>
                    </body>-->



<!--<body>

<h2>Login</h2>
<form action="login.php" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<hr>

<h2>Register</h2>
<form action="register.php" method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" required><br>
    <label>Last Name:</label>
    <input type="text" name="last_name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Contact No:</label>
    <input type="number" name="contactno" required><br>
    <label>District ID:</label>
    <input type="number" name="district_id" required><br>
    <label>Branch ID:</label>
    <input type="number" name="branch_id" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Role:</label>
    <select name="role_id">
        <option value="1">Admin</option>
        <option value="2">BranchAdmin</option> 
        <option value="3">ITstaff</option>
        <option value="4"> UserEmp </option>


    </select><br>

    <div id="admin_fields" style="display:none;">
        <label>Position:</label>
        <input type="text" name="position"><br>
        <label>Department:</label>
        <input type="text" name="department"><br>
    </div>

    <button type="submit">Register</button>
</form>-->



<script>
    document.querySelector('select[name="role_id"]').addEventListener('change', function () {
        if (this.value == 1) {
            document.getElementById('admin_fields').style.display = 'block';
        } else {
            document.getElementById('admin_fields').style.display = 'none';
        }
    });
</script>

<script>
    document.getElementById("toggle-password").addEventListener("click", function() {
    let passwordInput = document.getElementById("password-input");
    let icon = this;
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
    });
</script>


</body>
</html>
