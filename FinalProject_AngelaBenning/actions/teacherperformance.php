<?php


include "../functions/teacher_fxn.php";



$teachers = getAllTeachers();



// Include the connection file
include "../settings/connection.php";

foreach ($teachers as $teacher) {
    $teacherName = $teacher["FullName"];

    // Initialize variables
    $student_eval = 0;
    $management_eval = 0;

    // Query student evaluations
    $sql = "SELECT * FROM studentevaluations WHERE teacherId='" . $teacher["UserID"] . "'";
    $result = $con->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $student_eval += $row["TotalSum"];
        }
    }

    // Query management evaluations
    $sql = "SELECT * FROM managementevaluations WHERE teacherId='" . $teacher["UserID"] . "'";
    $result = $con->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $management_eval += $row["TotalSum"];
        }
    }

    // Calculate total score
    $total_score = $student_eval + $management_eval;

    // Insert into teacherperformance table
    $insert_sql = "INSERT INTO teacherperformance (teachername, teacherscore) VALUES (?, ?)";
    $stmt = $con->prepare($insert_sql);

    if ($stmt) {
        $stmt->bind_param("si", $teacherName, $total_score);
        $stmt->execute();
        $stmt->close();
    } else {
        // Handle the case where the insert statement preparation fails
        die("Insert statement preparation failed: " . $con->error);
    }
}


?>
