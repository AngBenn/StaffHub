<?php
include "../settings/connection.php";

function getAllCourses() {
    global $con; // Access the global connection variable

    // Define the SELECT query to fetch all chores
    $sql = "SELECT * FROM courses";

    // Execute the query
    $result = $con->query($sql);

    // Check if the query execution was successful
    if ($result) {
        // Check if any records were returned
        if ($result->num_rows > 0) {
            // Fetch all records and return them
            $courses=mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $courses;
            }
        else {
            // No records found
            return array(); // Return an empty array
        }
    } else {
        // Query execution failed
        return false;
    }

}