<?php
include "../settings/core.php";
include "../functions/profile_fxn.php";
$userId=return_userID();

include "../settings/connection.php";

if (isset($_POST["clockIn"]) ) {
    // Collecting form data
    $date = $_POST["date"];
    $time = $_POST["time"];
   
    // Check if a record already exists for the current date and user
    $existingRecordQuery = "SELECT * FROM clocking WHERE DATE(date) = '$date' AND userID = '$userId'";
    $existingRecordResult = $con->query($existingRecordQuery);

    if ($existingRecordResult->num_rows > 0) {
        echo "A clock-in entry already exists for today.";
    } else {
        // Insert the new clock-in or clock-out entry
        $sql = "INSERT INTO clocking (UserID, ClockInTime, date) VALUES ('$userId', '$time', '$date')";

        // Executing the query
        if ($con->query($sql) === TRUE) {
            echo "Clock-in  time inserted successfully.";
        } else {
            echo "Error: " . $con->error;
        }
    }
}
?>

