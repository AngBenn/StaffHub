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
<img src="../images/login.png" alt="login_pic" class="image">
    <div class="container">
        <h1 style="font-size: 35px; color: blue; font-weight:lighter;">Welcome To StaffHub</h1>
        <form action="../actions/login_user_action.php" method="POST" name="loginForm" id="loginForm">
            <div>
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" placeholder="example@email.com">
                
                <label for="password">Password</label>
                <input type="password" placeholder="10 characters minimum" id="password" name="password" minlength="10" required>

                
                <button type="submit" name="LOGIN" id="sign in">SIGN IN</button>

                
                <br>
                <br>
                <br>
                <a href="../login/register_view.php">Not a member? Click here to register</a>
            </div>
        </form> 

    </div>
   
</div>
    <!-- Link to external JavaScript file -->
    <script src='../js/index.js'></script>

</body>
</html>
