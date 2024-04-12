<?php
include '../functions/select_role_fxn.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>STAFF MANAGEMENT SYSTEM</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="../css/login.css">

</head>
<body>
<header class="header">
    <img src="../images/logo.png" alt="Logo" class="logo">
    <h1 class="header-title">StaffHub</h1>
</header>
<div class="container-wrapper">
<img src="../images/login.png" alt="login_pic" class="image1">
    <div class="register">
        <h1 style="font-size: 35px; color: blue; font-weight:lighter;">Register With StaffHub!</h1>
        <form action="../actions/register_user_action.php" method="POST" name="registerForm" id="registerForm">
            <div>
                <label for="firstName">First Name</label>
                <input type="firstName" name="firstName" id="firstName" placeholder="First Name" required>
                
                <label for="lastName">Last Name</label>
                <input type="lastName" name="lastName" id="lastName" placeholder="Last Name" required>

                
                <label for="role">Choose your role:</label>
                <div class="role">
                    <select id="role" name="role">
                        <?php
                        foreach ($roles as $role) {
                             echo "<option value='" . $role['RoleName'] . "'>" . $role['RoleName'] . "</option>";
                            }
                            ?>
                            </select>
                        </div>

                </div>

                <label for="email">Email address</label>
                <input type="email" name="email" id="email" placeholder="example@email.com">

                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" pattern="^\d{10}$">
                
                <label for="password">Password</label>
                <input type="password" placeholder="10 characters minimum" id="password" name="password" minlength="10" required>

                <label for="password">Confirm Password</label>
                <input type="password" placeholder="10 characters minimum" id="confirmPassword" name="password" minlength="10" required>
                
                <button type="submit" type="register button" name="REGISTER" id="Register">REGISTER</button>
                <br>
                <br>
                <br>
                <a href="../login/register_view.php">Have an account? Click here to log in</a>
            </div>
        </form> 

    </div>
   
</div>
    <!-- Link to external JavaScript file -->
    <script src='../js/index.js'></script>

</body>
</html>