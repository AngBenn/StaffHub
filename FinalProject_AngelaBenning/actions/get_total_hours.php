<?php
include "../settings/connection.php";
include "../settings/core.php";




function getTotalHours() {
    global $con; // Access the global connection variable
    $userId = return_userID();

    // Define the SELECT query to fetch all clocking data for a specific UserID using a parameterized query
    $sql = "SELECT * FROM clocking WHERE UserID = ?";

    // Prepare the statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId); // Assuming UserID is an integer. If it's a string, use "s" instead of "i".

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any records were returned
    if ($result->num_rows > 0) {
        // Fetch all records and return them
        $hours = $result->fetch_all(MYSQLI_ASSOC);
        return $hours;
    } else {
        // No records found
        return array(); // Return an empty array
    }
}
