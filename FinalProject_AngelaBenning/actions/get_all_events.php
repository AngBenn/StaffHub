<?php
include "../settings/connection.php";

function getAllEvents() {
    global $con; // Access the global connection variable

    // Define the SELECT query to fetch all chores
    $sql = "SELECT * FROM events";

    // Execute the query
    $result = $con->query($sql);

    // Check if the query execution was successful
    if ($result) {
        // Check if any records were returned
        if ($result->num_rows > 0) {
            // Fetch all records and return them
            $events=mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $events;
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