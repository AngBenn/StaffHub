<?php
include "../settings/core.php";
include "../functions/profile_fxn.php";
include "../functions/select_time_fxn.php";
include "../functions/course_fxn.php";
include "../functions/class_fxn.php";
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
            width: 40%;
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

        .dropdown {
            margin-bottom: 20px;
            display: block;
            margin-top: 1rem;
            color: rgb(110, 106, 106);
            font-weight: bold;


        }

        .dropdown select {
            padding: 10px;
            font-size: 16px;
            width: 60%;
            padding: 12px;
            box-sizing: border-box;

            background-color: lavender;
            border: none;
            border-radius: 20px;
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
            background-color: rgba(6, 1094, 212, 0.459);
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

        label,
        input {
            display: block;
            margin-top: 1rem;
            color: rgb(110, 106, 106);
            font-weight: bold;

            text-align: left;
        }

        input[type="name"],
        input[type="description"],
        input[type="class"] {
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
                <li><a href="../admin/time.php"><i class="fas fa-clock"></i> Record Time</a></li>
                <li><a href="../admin/evaluations.php"><i class="fas fa-poll"></i> Evaluations</a></li>
                <li><a href="../admin/dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="../admin/courses.php"><i class="fas fa-book"></i> Manage Courses</a></li>

                <li><a href="../login/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="content">


            <!-- Clocking In Section -->
            <div class="container">
                <div class="clocking-in card">

                    <h1 style="font-size:40px;"><img src="../images/event.jpg" alt="Event Icon" style="vertical-align: middle; margin-right: 10px; width: 70px;">Course Management</h2>


                        <br>
                        <div class="clockingcontainer">




                            <div class="clocking-details">
                                <div>
                                    <h2>Add Courses</h2>
                                    <form action="../actions/add_course_action.php" method="POST" name="addCourse" id="addCourseForm">
                                        <div class="calendar" id="clockInCalendar">
                                            <label for="courseName">Course Name</label>
                                            <input type="name" name="name" id="name" placeholder="Course Name" required>

                                            <label for="description">Course Description</label>
                                            <input type="description" name="description" id="description">

                                            <div class="dropdown">
                                                <label for="class">Select Class:</label>
                                                <br>
                                                <br>
                                                <select name="class" id="class">
                                                    <?php
                                                    foreach ($classes as $class) {
                                                        echo "<option value='" . $class['ClassID'] . "'>" . $class['Class'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <button type="submit" name="addCourse" id="addCourse">Add Course</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                </div>






            </div>

        </div>

        <div class="recent-times">
            <h2>Courses</h2>
            <table>
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are chores fetched
                    if (!empty($courses)) {
                        foreach ($courses as $row) {
                            echo '<tr>'; // Start a new table row
                            echo '<td>' . $row['CourseName'] . '</td>';
                            echo '<td>' . $row['CourseDescription'] . '</td>';

                            echo '<td>';
                            for ($i = 0; $i < 20; $i++) {
                                echo '&nbsp;&nbsp;';
                            }
                            echo '<a href="../admin/edit_course_view.php?id=' . $row['CourseID'] . '"><i class="fas fa-edit"></i></a>';
                            echo '&nbsp;&nbsp;'; // Add some space between the icons
                            echo '<a href="../actions/delete_course_action.php?id=' . $row['CourseID'] . '"><i class="fas fa-trash-alt"></i></a>';


                            echo '</td>';
                            echo '</tr>'; // End the table row
                        }
                    } else {
                        echo '<tr><td colspan="2">No course found.</td></tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="../js/add_course.js"></script>


</body>

</html>