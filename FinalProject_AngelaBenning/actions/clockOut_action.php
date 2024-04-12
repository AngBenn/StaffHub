<?php
include "../settings/core.php";
include "../functions/profile_fxn.php";
$userId = return_userID();

include "../settings/connection.php";

if (isset($_POST["clockOut"])) {
    // Collecting form data
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Check if a record already exists for the current date and user
    $existingRecordQuery = "SELECT * FROM clocking WHERE DATE(date) = '$date' AND userID = '$userId'";
    $existingRecordResult = $con->query($existingRecordQuery);

    if ($existingRecordResult->num_rows > 0) {
        $existingRecord = $existingRecordResult->fetch_assoc();
        if ($existingRecord['ClockOutTime'] !== null) {
            echo "A clock-out entry already exists for today.";
        } else {
            // Update the existing clock-out entry
            $sql = "UPDATE clocking SET ClockOutTime = '$time' WHERE DATE(date) = '$date' AND UserID = '$userId'";

            // Execute the query
            if ($con->query($sql) === TRUE) {
                echo "Clock-out time updated successfully.";

                // Select all entries from the clocking table
                $sql = "SELECT * FROM clocking WHERE UserID = '$userId'";
                $result = $con->query($sql);

                // Iterate over each entry
                while ($row = $result->fetch_assoc()) {
                    // Retrieve ClockInTime and ClockOutTime for the current entry
                    $clockInTime = $row['ClockInTime'];
                    $clockOutTime = $row['ClockOutTime'];

                    // Calculate work hours for the current entry
                    $workHours = date_diff(new DateTime($clockOutTime), new DateTime($clockInTime))->format('%H:%i:%s');

                    // Update the workHours column in the database for the current entry
                    $entryId = $row['ClockingID'];
                    $updateSql = "UPDATE clocking SET TotalWorkHours = '$workHours' WHERE ClockingID = '$entryId'";
                    $con->query($updateSql); // Execute the update query
                }
            } else {
                echo "Error: " . $con->error;
            }
        }
    } else {
        echo "No clock-in entry found for today.";
    }
}
// Close database connection
$con->close();
?>
