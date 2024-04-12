<?php
error_reporting(E_ALL);

include "../settings/connection.php";

include "../settings/core.php";

$userId = return_userID();


if (isset($_POST["evaluation"])) {
    //Collecting form data

    $satisfaction1 = $_POST["satisfaction1"];
    $satisfaction2 = $_POST["satisfaction2"];
    $effectiveness1 = $_POST["effectiveness1"];
    $effectiveness2 = $_POST["effectiveness2"];
    $effectiveness3 = $_POST["effectiveness3"];
    $engagement1 = $_POST["engagement1"];
    $engagement2 = $_POST["engagement2"];
    $feedback1 = $_POST["feedback1"];
    $feedback2 = $_POST["feedback2"];
    $accessibility1 = $_POST["accessibility1"];
    $accessibility2 = $_POST["accessibility2"];
    $course1 = $_POST["course1"];
    $course1 = $_POST["course2"];
    $comments = $_POST["comment"];
    $teacherId=$_POST["teacherId"];

    $satisfaction = 0;
    $effectiveness = 0;
    $engagement = 0;
    $feedback = 0;
    $accessibility = 0;
    $course = 0;

    // Check if each radio button is set and add its value to the corresponding variable
    if (isset($_POST["satisfaction1"])) {
        $satisfaction += intval($_POST["satisfaction1"]);
    }
    if (isset($_POST["satisfaction2"])) {
        $satisfaction += intval($_POST["satisfaction2"]);
    }

    if (isset($_POST["effectiveness1"])) {
        $effectiveness += intval($_POST["effectiveness1"]);
    }
    if (isset($_POST["effectiveness2"])) {
        $effectiveness += intval($_POST["effectiveness2"]);
    }
    if (isset($_POST["effectiveness3"])) {
        $effectiveness += intval($_POST["effectiveness3"]);
    }

    if (isset($_POST["engagement1"])) {
        $engagement += intval($_POST["engagement1"]);
    }
    if (isset($_POST["engagement2"])) {
        $engagement += intval($_POST["engagement2"]);
    }

    if (isset($_POST["feedback1"])) {
        $feedback += intval($_POST["feedback1"]);
    }
    if (isset($_POST["feedback2"])) {
        $feedback += intval($_POST["feedback2"]);
    }

    if (isset($_POST["accessibility1"])) {
        $accessibility += intval($_POST["accessibility1"]);
    }
    if (isset($_POST["accessibility2"])) {
        $accessibility += intval($_POST["accessibility2"]);
    }

    if (isset($_POST["course1"])) {
        $course += intval($_POST["course1"]);
    }
    if (isset($_POST["course2"])) {
        $course += intval($_POST["course2"]);
    }







    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO studentevaluations (
    UserID,
    CourseMaterials,
    Engagement,
    OverallSatisfaction,
    TeachingEffectiveness,
    Feedback,
    Availability,
    Comments,
    teacherId
) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

    // Prepare the statement
    $stmt = $con->prepare($sql);


    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("iiiiiiiis", $userId, $course, $engagement, $satisfaction, $effectiveness, $feedback, $accessibility, $comments,$teacherId);
    
        // Execute the statement
        $result = $stmt->execute();
    
        if ($result) {
            // Return success response
            //echo json_encode(array('success' => true));
            header("Location: ../admin/evaluations.php?msg=success");
            exit;
        } else {
            // Return error response
            //echo json_encode(array('success' => false));
            header("Location: ../admin/evaluations.php?msg=failed");
            exit;
        }
        // Close the statement
        $stmt->close();
    }
}
