<?php
include "../settings/core.php";
include '../functions/select_role_fxn.php';
$roleId = check_login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightgrey;
            margin: 0;
            padding: 0;
        }

        .header {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            background-color: rgba(6, 109, 212, 0.459);
            color: white;
            padding: 5px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            z-index: 2;
        }

        .logo {
            width: 50px;
            height: auto;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .header-title {
            display: inline-block;
            text-align: left;
            font-size: 24px;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-right: 50px;
        }







        .container {
            display: flex;
            margin-top: 0px;
        }

        .menu {
            width: 250px;
            height: 130vh;
            /* Full height of viewport */
            background-color: rgba(6, 109, 212, 0.459);
            transition: width 0.3s;
            /* Transition effect */
            z-index: 1;
        }

        .menu.closed {
            width: 0;
            /* Collapsed state */
        }

        .menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu ul li {
            padding: 15px;
            transition: background-color 0.3s;
            /* Transition effect */
        }

        .menu ul li:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Hover background color */
        }

        .menu ul li a {
            color: whitesmoke;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: color 0.3s;
            /* Transition effect */
        }

        .menu ul li a i {
            margin-right: 10px;
        }

        .menu ul li a:hover {
            color: white;
            /* Hover color */
        }


        .formContainer {
            height: 100vh;
            max-width: 700px;
            margin-right: 90px;
            margin-left: 100px;
            /* Adjusted margin-left */
            margin-bottom: -90px;
            margin-top: 25px;
            /* Adjusted margin-top */
            padding: 50px 20px;
            background-color: transparent;
            /* Semi-transparent background */
            border-radius: 20px;
            text-align: center;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            /* Shadow effect */
        }

        label,
        input {
            display: block;
            margin-top: 1rem;
            color: rgb(110, 106, 106);
            font-weight: bold;
            margin-left: 130px;
            text-align: left;
        }

        input[type="email"],
        input[type="password"],
        input[type="firstName"],
        input[type="lastName"],
        input[type="role"],
        input[type="tel"] {
            width: 60%;
            padding: 12px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            border-radius: 20px;
            margin: 12px auto;

        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            background-color: rgba(6, 109, 212, 0.459);
            color: black;
            border: 2px solid rgba(6, 109, 212, 0.459);
            border-radius: 20px;
            cursor: pointer;
            margin-top: 20px;
            width: 60%;
        }

        button:hover {
            background-color: white;
            color: black;
        }








        .role {
            width: 60%;
            padding: 12px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            border-radius: 20px;
            margin: 12px auto;
        }

        .role select {
            width: 100%;
            /* Set width to 100% to match parent width */
            background-color: transparent;
            /* Background color */
            border: none;
            /* Remove border */
            border-radius: none;
            /* Inherit border radius from parent */
            padding: 0;
            /* Reset padding */
        }

        .content {
            flex: 3;
            padding: 20px;
        }
    </style>
</head>

<body>
    <header class="header">
        <div>
            <img src="../images/logo.png" alt="Logo" class="logo">
            <h1 class="header-title">StaffHub</h1>
        </div>
    </header>

    <div class="container">
        <div class="menu" id="menu">
            <ul>
          
                <li><a href="../view/welcome.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="../admin/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <?php if ($roleId == 1 || $roleId == 3) : ?>
                    <li><a href="../admin/evaluations.php"><i class="fas fa-poll"></i> Evaluations</a></li>
                <?php endif; ?>
                <?php if ($roleId == 2) : ?>
                    <li><a href="../admin/time.php"><i class="fas fa-clock"></i> Record Time</a></li>
                <?php endif; ?>
                <?php if ($roleId == 2|| $roleId==3) : ?>
                <li><a href="../admin/dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <?php endif; ?>
                <?php if ($roleId == 3) : ?>
                    <li><a href="../admin/courses.php"><i class="fas fa-book"></i> Manage Courses</a></li>
                    <li><a href="../admin/events.php"><i class="far fa-calendar-alt"></i> Manage Events</a></li>
                <?php endif; ?>
                <li><a href="../login/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="formContainer">
                <h2>Edit Profile</h2>
                <form action="../actions/profile_action.php" method="POST" name="profileForm" id="profileForm">
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



                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" placeholder="example@email.com">

                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" pattern="^\d{10}$">

                    <label for="password"> Change Password</label>
                    <input type="password" placeholder="10 characters minimum" id="password" name="password" minlength="10" required>



                    <button type="submit" type="update button" name="UPDATE" id="Update">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
    <script src='../js/welcome.js'></script>
</body>

</html>