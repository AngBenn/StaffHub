<?php
// Include necessary files and retrieve user data
include "../settings/core.php";
include "../functions/profile_fxn.php";
include "../actions/get_total_hours.php";
include "../functions/course_fxn.php";
include "../functions/class_fxn.php";
include "../functions/evaluation_fxn.php";
include "../actions/bestTeacherAction.php";
include "../actions/teacherperformance.php";



$userId = return_userID();
$firstName = profile($userId);
$roleId = check_login();



// Query the database to fetch total hours worked for each day
$totalHoursWorkedData = getTotalHours(); // Example function

// Prepare data for the total hours per day bar graph
$totalHoursLabels = [];
$totalHoursData = [];
foreach ($totalHoursWorkedData as $row) {
    $totalHoursLabels[] = $row['day']; // Assuming the database query returns 'Day' and 'Hours' columns
    $totalHoursData[] = $row['TotalWorkHours'];
}
$totalHoursLabels = json_encode($totalHoursLabels);
$totalHoursData = json_encode($totalHoursData);

// Query the database to fetch total evaluation score for each teacher
$totalEvaluationScoreData = getTeacherPerformance(); // Example function

// Prepare data for the total evaluation score pie chart
$teacherNames = [];
$evaluationScores = [];
foreach ($totalEvaluationScoreData as $row) {
    $teacherNames[] = $row['teachername']; // Assuming the database query returns 'TeacherName' and 'Score' columns
    $evaluationScores[] = $row['teacherscore'];
}
$teacherNames = json_encode($teacherNames);
$evaluationScores = json_encode($evaluationScores);

// Query the database to fetch the best teacher name and score
$bestTeacherData = getBestTeacherPerformance(); // Example function
$bestTeacherName = $bestTeacherData['teachername'];
$bestTeacherScore = $bestTeacherData['teacherscore'];
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<head>
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
            width: 80%;
            margin: 20px auto;
            /* Center the card horizontally and provide some spacing */
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
        input[type="date"],
        input[type="location"] {
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


    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <!-- Header and menu -->
        <!-- Content section -->
        <div class="content">

            <!-- Best teacher card -->
            <div class="card stats">
                <h1>Best Teacher</h1>
                <p>Name: <?php echo $bestTeacherName; ?></p>
                <p>Score: <?php echo $bestTeacherScore; ?></p>
            </div>

            <!-- Total hours per day bar graph -->
            <div class="card stats">
                <h2>Total Hours Worked per Day (Bar Graph)</h2>
                <canvas id="barGraph" width="200" height="100"></canvas>
            </div>



        </div>

        <!-- JavaScript and additional scripts -->
        <script>
            // Convert PHP data to JavaScript variables
            var totalHoursLabels = <?php echo $totalHoursLabels; ?>;
            var totalHoursData = <?php echo $totalHoursData; ?>;
            var teacherNames = <?php echo $teacherNames; ?>;
            var evaluationScores = <?php echo $evaluationScores; ?>;

            // Render Total Hours Worked per Day Bar Graph
            var barCtx = document.getElementById('barGraph').getContext('2d');
            var barGraph = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: totalHoursLabels,
                    datasets: [{
                        label: 'Total Hours Worked',
                        data: totalHoursData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
</body>

</html>