<?php


function returnEvent($id) {
    include "../settings/connection.php";  

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM events WHERE id = '$id'";
    $result = $con->query($sql);

    // Check if the query execution was successful
    if ($result) {
        // Check if any record was returned
        if ($result->num_rows > 0) {
            // Fetch the record and assign it to a variable
            $record = $result->fetch_assoc();
            return $record;
        } else {
            // No record found
            return null;
        }
    } else {
        // Query execution failed
        return null;
    }
}
?>