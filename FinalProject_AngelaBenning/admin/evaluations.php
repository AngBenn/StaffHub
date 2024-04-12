<?php
include "../settings/core.php";
include "../functions/profile_fxn.php";
include "../functions/teacher_fxn.php";
include "../functions/class_fxn.php";
include "../functions/course_fxn.php";
$userId = return_userID();
$roleId = check_login();
$teachers = getAllTeachers();


$firstName = profile($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Page</title>
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

        .content {
            flex: 1;
            padding: 20px;
        }

        .card {
            width: 95%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: whitesmoke;
            margin-bottom: 20px;
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
            width: 50%;
            padding: 12px;
            box-sizing: border-box;

            background-color: lavender;
            border: none;
            border-radius: 20px;
        }

        .evaluation-form {
            display: none;
            width: 95%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: whitesmoke;
            margin-bottom: 20px;
        }

        .evaluation-form.show {
            display: block;
        }

        .evaluation-form label {
            display: block;
            margin-bottom: 10px;
        }

        .evaluation-form textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            background-color: lightblue;
            color: black;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: white;
            color: black;
        }

        .section {
            border-bottom: 1px solid #ccc;
            /* Add thin line below each section */
            padding-bottom: 20px;
            /* Add padding to separate sections */
            margin-bottom: 20px;
            /* Add margin to separate sections */
        }

        .satisfaction-options {
            display: flex;
            /* Display options horizontally */
            justify-content: space-between;
            /* Space them evenly */
            margin-bottom: 10px;
            /* Add margin for spacing */
            border-bottom: 1px solid #ccc;
        }

        .satisfaction-options span {
            flex: 1;
            margin: 20px;
            /* Each option takes equal space */
            text-align: center;
            /* Center text */
        }

        .satisfaction-radio {
            display: flex;
            /* Display radio buttons horizontally */
            justify-content: space-evenly;
            margin-bottom: 10px;
            text-align: center;


        }


        .clockingcontainer {
            display: flex;
            justify-content: space-between;
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
                <h2 style="font-size:40px;"><img src="..\images\evaluation.webp" alt="Evaluation Icon" style="vertical-align: middle; margin-right: 10px; width: 70px;"> Evaluations</h2>
                <div class="dropdown">
                    <label for="teacher">Select Teacher:</label>
                    <br>
                    <br>
                    <select name="teacher" id="teacher">
                        <option value="">Choose Teacher</option>
                        <?php

                        foreach ($teachers as $teacher) {
                            // Output an <option> element for each teacher
                            echo "<option value='" . $teacher["UserID"] . "'>" . $teacher["FullName"] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                </div>
                <div class="dropdown">
                    <label for="course">Select Class:</label>
                    <br>
                    <br>
                    <select name="class" id="class">
                        <option value="">Choose Class</option>
                        <?php

                        foreach ($classes as $class) {
                            // Output an <option> element for each teacher
                            echo "<option value='" . $class["ClassID"] . "'>" . $class["Class"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <br>


                <div class="dropdown">
                    <label for="course">Select Course:</label>
                    <br>
                    <br>
                    <select name="course" id="course">
                        <option value="">Choose Course</option>
                        <?php

                        foreach ($courses as $course) {
                            // Output an <option> element for each teacher
                            echo "<option value='" . $course['CourseName'] . "'>" . $course['CourseName'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <?php
            if ($roleId == 1) {
            ?>
                <div class="evaluation-form" id="evaluationForm">
                    <form action="../actions/evaluations_action.php" method="POST" name="evaluationForm" id="evaluationForm">
                        <input type="hidden" name="teacherId" id="teacherId">
                        <h2>TEACHER EVALUATION</h2>
                        <div class="section">
                            <h2>Overall Satisfaction</h2>
                            <div class="clockingcontainer">
                                <p>How satisfied are you with the overall teaching quality of the instructor?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="satisfaction1" name="satisfaction1" value="1">

                                        <input type="radio" id="satisfaction1" name="satisfaction1" value="2">

                                        <input type="radio" id="satisfaction1" name="satisfaction1" value="3">

                                        <input type="radio" id="satisfaction1" name="satisfaction1" value="4">

                                        <input type="radio" id="satisfaction1" name="satisfaction1" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">

                            <div class="clockingcontainer">
                                <p>Rate your overall experience in this course with this instructor.</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="satisfaction2" name="satisfaction2" value="1">

                                        <input type="radio" id="satisfaction2" name="satisfaction2" value="2">

                                        <input type="radio" id="satisfaction2" name="satisfaction2" value="3">

                                        <input type="radio" id="satisfaction2" name="satisfaction2" value="4">

                                        <input type="radio" id="satisfaction2" name="satisfaction2" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <h2>Teaching Effectiveness</h2>
                            <div class="clockingcontainer">
                                <p>Did the instructor effectively communicate course material?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="effectiveness1" name="effectiveness1" value="1">

                                        <input type="radio" id="effectiveness1" name="effectiveness1" value="2">

                                        <input type="radio" id="effectiveness1" name="effectiveness1" value="3">

                                        <input type="radio" id="effectiveness1" name="effectiveness1" value="4">

                                        <input type="radio" id="effectiveness1" name="effectiveness1" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">

                            <div class="clockingcontainer">
                                <p>Did the instructor provide clear explanations and examples?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="effectiveness2" name="effectiveness2" value="1">

                                        <input type="radio" id="effectiveness2" name="effectiveness2" value="2">

                                        <input type="radio" id="effectiveness2" name="effectiveness2" value="3">

                                        <input type="radio" id="effectiveness2" name="effectiveness2" value="4">

                                        <input type="radio" id="effectiveness2" name="effectiveness2" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">

                            <div class="clockingcontainer">
                                <p>Did the instructor stimulate your interest in the subject matter?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="effectiveness3" name="effectiveness3" value="1">

                                        <input type="radio" id="effectiveness3" name="effectiveness3" value="2">

                                        <input type="radio" id="effectiveness3" name="effectiveness3" value="3">

                                        <input type="radio" id="effectiveness3" name="effectiveness3" value="4">

                                        <input type="radio" id="effectiveness3" name="effectiveness3" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <h2>Engagement and Interaction</h2>
                            <div class="clockingcontainer">
                                <p>Did the instructor respond to questions and feedback effectively?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="engagement1" name="engagement1" value="1">

                                        <input type="radio" id="engagement1" name="engagement1" value="2">

                                        <input type="radio" id="engagement1" name="engagement1" value="3">

                                        <input type="radio" id="engagement1" name="engagement1" value="4">

                                        <input type="radio" id="engagement1" name="engagement1" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">

                            <div class="clockingcontainer">
                                <p>Did the instructor create a supportive and engaging learning environment?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="engagement2" name="engagement2" value="1">

                                        <input type="radio" id="engagement2" name="engagement2" value="2">

                                        <input type="radio" id="engagement2" name="engagement2" value="3">

                                        <input type="radio" id="engagement2" name="engagement2" value="4">

                                        <input type="radio" id="engagement2" name="engagement2" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="section">
                            <h2>Feedback and Assessment</h2>
                            <div class="clockingcontainer">
                                <p>Did the instructor provide timely and constructive feedback on assignments and assessments?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="feedback1" name="feedback1" value="1">

                                        <input type="radio" id="feedback1" name="feedback1" value="2">

                                        <input type="radio" id="feedback1" name="feedback1" value="3">

                                        <input type="radio" id="feedback1" name="feedback1" value="4">

                                        <input type="radio" id="feedback1" name="feedback1" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">

                            <div class="clockingcontainer">
                                <p>Did the instructor help you understand your strengths and areas for improvement?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="feedback2" name="feedback2" value="1">

                                        <input type="radio" id="feedback2" name="feedback2" value="2">

                                        <input type="radio" id="feedback2" name="feedback2" value="3">

                                        <input type="radio" id="feedback2" name="feedback2" value="4">

                                        <input type="radio" id="feedback2" name="feedback2" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="section">
                            <h2>Accessibility and Availability:</h2>
                            <div class="clockingcontainer">
                                <p>Did the instructor hold regular office hours or offer other means of communication for assistance?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="accessibility1" name="accessibility1" value="1">

                                        <input type="radio" id="accessibility1" name="accessibility1" value="2">

                                        <input type="radio" id="accessibility1" name="accessibility1" value="3">

                                        <input type="radio" id="accessibility1" name="accessibility1" value="4">

                                        <input type="radio" id="accessibility1" name="accessibility1" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">

                            <div class="clockingcontainer">
                                <p>Was the instructor responsive to emails or questions outside of class?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="accessibility2" name="accessibility2" value="1">

                                        <input type="radio" id="accessibility2" name="accessibility2" value="2">

                                        <input type="radio" id="accessibility2" name="accessibility2" value="3">

                                        <input type="radio" id="accessibility2" name="accessibility2" value="4">

                                        <input type="radio" id="accessibility2" name="accessibility2" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <h2>Course Materials and Resources</h2>
                            <div class="clockingcontainer">
                                <p>Were course materials (textbooks, handouts, online resources) helpful for learning?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="course1" name="course1" value="1">

                                        <input type="radio" id="course1" name="course1" value="2">

                                        <input type="radio" id="course1" name="course1" value="3">

                                        <input type="radio" id="course1" name="course1" value="4">

                                        <input type="radio" id="course1" name="course1" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section">

                            <div class="clockingcontainer">
                                <p>Did the instructor provide additional resources or support to enhance your learning experience?</p>
                                <div>
                                    <div class="satisfaction-options">
                                        <span>Very Dissatisfied</span>
                                        <span>Dissatisfied</span>
                                        <span>Neutral</span>
                                        <span>Satisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="satisfaction-radio">

                                        <input type="radio" id="course2" name="course2" value="1">

                                        <input type="radio" id="course2" name="course2" value="2">

                                        <input type="radio" id="course2" name="course2" value="3">

                                        <input type="radio" id="course2" name="course2" value="4">

                                        <input type="radio" id="course2" name="course2" value="5">
                                    </div>
                                </div>
                            </div>
                        </div>












                        <label for="comment"> Additional Comments:</label>
                        <textarea name="comment" id="comment" style="width:95%; "></textarea>
                        <br>
                        <br>

                        <button type="submit" type="evaluation button" name="evaluation" id="evaluation">Submit Evaluation</button>
                    </form>
                </div>
            <?php
            }
            ?>

            <?php
            if ($roleId == 3) {
            ?>
                <div class="evaluation-form" id="evaluationForm">
                    <form action="../actions/management_evaluations_action.php" method="POST" name="evaluationForm" id="evaluationForm">
                        <input type="hidden" name="teacherId" id="teacherId">
                        <form id="evaluationForm">
                            <h2>TEACHER EVALUATION</h2>
                            <div class="section">
                                <h2>Teaching Effectiveness</h2>
                                <div class="clockingcontainer">
                                    <p>Student engagement and participation levels.</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="effectiveness1" name="effectiveness1" value="1">

                                            <input type="radio" id="effectiveness1" name="effectiveness1" value="2">

                                            <input type="radio" id="effectiveness1" name="effectiveness1" value="3">

                                            <input type="radio" id="effectiveness1" name="effectiveness1" value="4">

                                            <input type="radio" id="effectiveness1" name="effectiveness1" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">

                                <div class="clockingcontainer">
                                    <p>Use of innovative teaching methods and instructional techniques</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="effectiveness2" name="effectiveness2" value="1">

                                            <input type="radio" id="effectiveness2" name="effectiveness2" value="2">

                                            <input type="radio" id="effectiveness2" name="effectiveness2" value="3">

                                            <input type="radio" id="effectiveness2" name="effectiveness2" value="4">

                                            <input type="radio" id="effectiveness2" name="effectiveness2" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">

                                <div class="clockingcontainer">
                                    <p>Ability to convey course content clearly and effectively.</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="effectiveness3" name="effectiveness3" value="1">

                                            <input type="radio" id="effectiveness3" name="effectiveness3" value="2">

                                            <input type="radio" id="effectiveness3" name="effectiveness3" value="3">

                                            <input type="radio" id="effectiveness3" name="effectiveness3" value="4">

                                            <input type="radio" id="effectiveness3" name="effectiveness3" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <h2>Student Learning Outcomes</h2>
                                <div class="clockingcontainer">
                                    <p>Student performance on assessments, exams, or assignments</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="SLO1" name="SLO1" value="1">

                                            <input type="radio" id="SLO1" name="SLO1" value="2">

                                            <input type="radio" id="SLO1" name="SLO1" value="3">

                                            <input type="radio" id="SLO1" name="SLO1" value="4">

                                            <input type="radio" id="SLO1" name="SLO1" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">

                                <div class="clockingcontainer">
                                    <p>Degree of improvement or growth demonstrated by students over the course of instruction.</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="SLO2" name="SLO2" value="1">

                                            <input type="radio" id="SLO2" name="SLO2" value="2">

                                            <input type="radio" id="SLO2" name="SLO2" value="3">

                                            <input type="radio" id="SLO2" name="SLO2" value="4">

                                            <input type="radio" id="SLO2" name="SLO2" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">

                                <div class="clockingcontainer">
                                    <p>Achievement of course learning objectives and outcomes.</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="SLO3" name="SLO3" value="1">

                                            <input type="radio" id="SLO3" name="SLO3" value="2">

                                            <input type="radio" id="SLO3" name="SLO3" value="3">

                                            <input type="radio" id="SLO3" name="SLO3" value="4">

                                            <input type="radio" id="SLO3" name="SLO3" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <h2>Professional Development</h2>
                                <div class="clockingcontainer">
                                    <p>Participation in ongoing professional development activities, workshops, or conferences.</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="PD1" name="PD1" value="1">

                                            <input type="radio" id="PD1" name="PD1" value="2">

                                            <input type="radio" id="PD1" name="PD1" value="3">

                                            <input type="radio" id="PD1" name="PD1" value="4">

                                            <input type="radio" id="PD1" name="PD1" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">

                                <div class="clockingcontainer">
                                    <p>Pursuit of training relevant to teaching responsibilities</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="PD2" name="PD2" value="1">

                                            <input type="radio" id="PD2" name="PD2" value="2">

                                            <input type="radio" id="PD2" name="PD2" value="3">

                                            <input type="radio" id="PD2" name="PD2" value="4">

                                            <input type="radio" id="PD2" name="PD2" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="section">
                                <h2>Teamwork</h2>
                                <div class="clockingcontainer">
                                    <p>Collaboration with colleagues on interdisciplinary projects or initiatives.</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="teamwork1" name="teamwork1" value="1">

                                            <input type="radio" id="teamwork1" name="teamwork1" value="2">

                                            <input type="radio" id="teamwork1" name="teamwork1" value="3">

                                            <input type="radio" id="teamwork1" name="teamwork1" value="4">

                                            <input type="radio" id="teamwork1" name="teamwork1" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">

                                <div class="clockingcontainer">
                                    <p>Ability to work effectively with peers, administrators, and support staff.</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="teamwork2" name="teamwork2" value="1">

                                            <input type="radio" id="teamwork2" name="teamwork2" value="2">

                                            <input type="radio" id="teamwork2" name="teamwork2" value="3">

                                            <input type="radio" id="teamwork2" name="teamwork2" value="4">

                                            <input type="radio" id="teamwork2" name="teamwork2" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="section">
                                <h2>Adherence to Policies and Procedures</h2>
                                <div class="clockingcontainer">
                                    <p>Compliance with institutional policies, procedures, and ethical standards</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="policy1" name="policy1" value="1">

                                            <input type="radio" id="policy1" name="policy1" value="2">

                                            <input type="radio" id="policy1" name="policy1" value="3">

                                            <input type="radio" id="policy1" name="policy1" value="4">

                                            <input type="radio" id="policy1" name="policy1" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">

                                <div class="clockingcontainer">
                                    <p>Timeliness and accuracy in grading, record-keeping, and administrative tasks</p>
                                    <div>
                                        <div class="satisfaction-options">
                                            <span>Very Dissatisfied</span>
                                            <span>Dissatisfied</span>
                                            <span>Neutral</span>
                                            <span>Satisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="satisfaction-radio">

                                            <input type="radio" id="policy2" name="policy2" value="1">

                                            <input type="radio" id="policy2" name="policy2" value="2">

                                            <input type="radio" id="policy2" name="policy2" value="3">

                                            <input type="radio" id="policy2" name="policy2" value="4">

                                            <input type="radio" id="policy2" name="policy2" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="comment"> Additional Comments:</label>
                            <textarea name="comment" id="comment" style="width:95%; "></textarea>
                            <br>
                            <br>
                            <button type="submit" name="evaluation">Submit Evaluation</button>
                        </form>
                </div>
            <?php
            }
            ?>

            <!-- Include jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Include SweetAlert library -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

            <script src="../js/evaluation.js"></script>



</body>

</html>