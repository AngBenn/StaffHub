<?php
include "../settings/core.php";
include "../functions/profile_fxn.php";
include "../functions/select_time_fxn.php";
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

        .image {
            flex: 0.8;

            margin-top: 20px;
            margin-bottom: 0px;
            width: 320px;
            height: auto;

        }

        .clocking-in.card {
            width: 95%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .clocking-in h1 {
            display: block;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .clocking-image {
            flex: 1;

        }

        .clocking-image img {
            width: 60%;
            height: auto;
            flex: 1;

        }

        .clocking-details {
            flex: 1;
            padding-left: 20px;
            /* Adjust padding as needed */
        }

        .clocking-details>div {
            margin-bottom: 20px;
        }

        .clocking-details h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .calendar input {
            margin-bottom: 10px;
        }

        .calendar button {
            margin-top: 10px;
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

        .clockingcontainer {
            display: flex;
            margin-top: 30px;
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

        .clockcard {
            padding: 20px;
            background-color: rgba(6, 109, 212, 0.459);
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            height: auto;
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

        input {
            display: block;
            margin-top: 1rem;
            color: rgb(110, 106, 106);
            font-weight: bold;

            text-align: left;
        }

        input[type="date"],
        input[type="time"] {
            width: 60%;
            padding: 12px;
            box-sizing: border-box;
            background-color: lavender;
            border: none;
            border-radius: 20px;

        }

        button {
            padding: 5px 5px;
            font-size: 16px;
            font-weight: bold;
            background-color: lightblue;
            color: black;
            border: 2px solid lightblue;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 20px;
            width: 20%;
        }

        button:hover {
            background-color: white;
            color: black;
        }

        .recent-times {
            margin-top: 20px;
        }

        .recent-times table {
            width: 100%;
            border-collapse: collapse;
        }

        .recent-times th,
        .recent-times td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .recent-times th {
            background-color: rgba(6, 109, 212, 0.459);
            color: #fff;
        }

        .recent-times td {
            background-color: #f9f9f9;
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


            <!-- Clocking In Section -->
            <div class="container">
                <div class="clocking-in card">
                    <h1 style="margin-top: 0;">Record Time</h1>
                    <span style="font-style: italic; font-weight:lighter">Record your clocking in and clocking out times here!<span>
                            <br>
                            <div class="clockingcontainer">


                                <div class="clocking-image">
                                    <img src="../images/clocking.png" alt="login_pic" class="image">
                                </div>

                                <div class="clocking-details">
                                    <div>
                                        <h2>Clock In</h2>
                                        <form action="../actions/clockIn_action.php" method="POST" name="clockIn" id="clockInForm">
                                            <div class="calendar" id="clockInCalendar">
                                                <input type="date" name="date">
                                                <input type="time" name="time">
                                                <button type="submit" name="clockIn" id="clock in">Record</button> <!-- Placeholder button -->
                                            </div>
                                        </form>
                                    </div>
                                    <div>




                                        <h2>Clock Out</h2>
                                        <form action="../actions/clockOut_action.php" method="POST" name="clockOut" id="clockInForm">
                                            <div class="calendar" id="clockOutCalendar">
                                                <input type="date" name="date">
                                                <input type="time" name="time">
                                                <button type="submit" name="clockOut" id="clock Out">Record</button> <!-- Placeholder button -->
                                        </form>
                                    </div>

                                </div>
                            </div>
                </div>






            </div>

        </div>

        <div class="recent-times">
            <h2>Recent Clocking Times</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Clock In Time</th>
                        <th>Clock Out Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are chores fetched
                    if (!empty($time)) {
                        foreach ($time as $row) {
                            echo '<tr>'; // Start a new table row
                            echo '<td>' . $row['date'] . '</td>';
                            echo '<td>' . $row['ClockInTime'] . '</td>';
                            echo '<td>' . $row['ClockOutTime'] . '</td>';
                            echo '</tr>'; // End the table row
                        }
                    } else {
                        echo '<tr><td colspan="2">No time found.</td></tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>