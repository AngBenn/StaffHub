<?php

include "../settings/connection.php";

include "../settings/core.php";

$userId = return_userID();




if (isset($_POST["evaluation"])) {
    //Collecting form data

    $effectiveness1 = $_POST["effectiveness1"];
    $effectiveness2 = $_POST["effectiveness2"];
    $effectiveness3 = $_POST["effectiveness3"];
    $SLO1 = $_POST["SLO1"];
    $SLO2 = $_POST["SLO2"];
    $SLO3 = $_POST["SLO3"];
    $PD1 = $_POST["PD1"];
    $PD2 = $_POST["PD2"];
    $teamwork1 = $_POST["teamwork1"];
    $teamwork2 = $_POST["teamwork2"];
    $policy1 = $_POST["policy1"];
    $policy2 = $_POST["policy2"];
    $comments = $_POST["comment"];
    $teacherId=$_POST["teacherId"];

    $effectiveness = 0;
    $SLO = 0;
    $PD = 0;
    $teamwork = 0;
    $policy = 0;


    // Check if each radio button is set and add its value to the corresponding variable
    if (isset($_POST["effectiveness1"])) {
        $effectiveness += intval($_POST["effectiveness1"]);
    }
    if (isset($_POST["effectiveness2"])) {
        $effectiveness += intval($_POST["effectiveness2"]);
    }

    if (isset($_POST["effectiveness3"])) {
        $effectiveness += intval($_POST["effectiveness3"]);
    }
    if (isset($_POST["SLO1"])) {
        $SLO += intval($_POST["SLO1"]);
    }
    if (isset($_POST["SLO2"])) {
        $SLO += intval($_POST["SLO2"]);
    }

    if (isset($_POST["SLO3"])) {
        $SLO += intval($_POST["SLO3"]);
    }
    if (isset($_POST["PD1"])) {
        $PD += intval($_POST["PD1"]);
    }

    if (isset($_POST["PD2"])) {
        $PD += intval($_POST["PD2"]);
    }
    if (isset($_POST["teamwork1"])) {
        $teamwork += intval($_POST["teamwork1"]);
    }

    if (isset($_POST["teamwork2"])) {
        $teamwork += intval($_POST["teamwork2"]);
    }


    if (isset($_POST["policy1"])) {
        $policy += intval($_POST["policy1"]);
    }
    if (isset($_POST["policy2"])) {
        $policy += intval($_POST["policy2"]);
    }







    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO managementevaluations (
    UserID,
    Effectiveness,
    SLO,
    Teamwork,
    ProfessionalDevelopment,
    PolicyAdherence,
    Comments, 
    teacherId
) VALUES (?, ?, ?, ?, ?, ?, ?,?)";

    // Prepare the statement
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("iiiiiiis", $userId, $effectiveness, $SLO, $teamwork, $PD, $policy, $comments,$teacherId);

        // Execute the statement
        $result = $stmt->execute();

        if ($result) {
            // Return success response
            header("Location: ../admin/evaluations.php?msg=success");
            exit;
        } else {
            // Return error response
            header("Location: ../admin/evaluations.php?msg=failed");
            exit;
        }
        // Close the statement
        $stmt->close();
    }
}
