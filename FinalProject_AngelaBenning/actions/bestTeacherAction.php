<?php

function getBestTeacherPerformance() {
    global $con; // Access the global connection variable

    // Define the SELECT query to fetch the teacher with the highest score
    $sql = "SELECT teachername, teacherscore FROM teacherperformance ORDER BY teacherscore DESC LIMIT 1";

    // Execute the query
    $result = $con->query($sql);

    // Check if the query execution was successful
    if ($result) {
        // Check if any records were returned
        if ($result->num_rows > 0) {
            // Fetch the record with the highest score
            $bestTeacher = $result->fetch_assoc();
            return $bestTeacher; // Return the best teacher record
        } else {
            // No records found
            return null; // Return null if no records are found
        }
    } else {
        // Query execution failed
        return false;
    }
}
