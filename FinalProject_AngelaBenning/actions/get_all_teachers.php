<?php
include "../settings/connection.php";

function getAllTeachers() {
    global $con;

    // Define the SELECT query to fetch full names of teachers
    $sql = "SELECT UserID, CONCAT(FirstName, ' ', LastName) AS FullName FROM users WHERE Role = 'teacher'";


    // Execute the query
    $result = $con->query($sql);

    // Check if the query execution was successful
    if ($result) {
        // Check if any records were returned
        if ($result->num_rows > 0) {
            // Fetch all full names and return them
           
            return $result;
        } else {
            // No records found
            return array(); // Return an empty array
        }
    } else {
        // Query execution failed
        return false;
    }
}
