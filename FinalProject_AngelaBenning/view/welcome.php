<?php
include "../settings/core.php";
include "../functions/profile_fxn.php";
include "../functions/event_fxn.php";
$userId = return_userID();
$firstName = profile($userId);
$roleId = check_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
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

        .image {
            flex: 0.8;

            margin-top: 20px;
            margin-bottom: 0px;
            width: 320px;
            height: auto;

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



        .profile-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 5px;
        }

        .profile-img img {
            width: 100%;
            /* Makes sure the image fills the circle */
            margin-right: 0px;
            height: auto;
            /* Preserves aspect ratio */
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

        .content {
            flex: 1;
            padding: 20px;
        }

        .card {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .stats,
        .comments,
        .clocking-times {
            margin-bottom: 20px;
        }

        .welcome-message {
            margin-left: 20px;
        }

        .welcome-message h2 {
            font-size: 34px;
            margin-bottom: 5px;
        }

        .welcome-message p {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
    <header class="header">
        <div>
            <img src="../images/logo.png" alt="Logo" class="logo">
            <h1 class="header-title">StaffHub</h1>
        </div>
        <div class="profile">
            <div class="profile-img">
                <img src="../images/profile.jpeg" alt="Profile Image">
            </div>
            <div class="profile-dropdown">
                <span style="font-weight:bold;"><?php echo $firstName; ?></span>
            </div>
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
            <div class="card">
                <div class="container">
                    <img src="../images/people.png" alt="login_pic" class="image">
                    <div class="welcome-message">
                        <h2>Welcome Back!</h2>
                        <p>At StaffHub, we strive to create a supportive and collaborative environment where every member's contribution is valued and appreciated. Together, we can achieve great things!</p>
                    </div>
                </div>
            </div>
            <br>
            <br>





            <div class="clocking-times card">
                <h2>Upcoming events</h2>
                <?php
                // Check if there are any events
                if (!empty($var_data)) {
                    // Loop through each event and display them
                    foreach ($var_data as $event) {
                ?>
                        <div class="event">
                            <h3><?php echo $event['event_name']; ?></h3>
                            <p>Date: <?php echo $event['event_date']; ?></p>
                            <p>Location: <?php echo $event['event_location']; ?></p>
                            <!-- Add more event details as needed -->
                        </div>
                <?php
                    }
                } else {
                    // No events message
                    echo "<p>No events found</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src='../js/welcome.js'></script>

</body>

</html>