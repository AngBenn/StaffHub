<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "../settings/connection.php";
include "../settings/core.php";
include "../functions/profile_fxn.php";
$userId=return_userID();



if (isset($_POST["clockIn"]) ) {
    global $con; 
    
    // Collecting form data
    $date = $_POST["date"];
    $time = $_POST["time"];
   
    // Check if a record already exists for the current date and user
    $existingRecordQuery = "SELECT * FROM clocking WHERE DATE(date) = '$date' AND UserID = '$userId'";
    $existingRecordResult = $con->query($existingRecordQuery);
    
    if ($existingRecordResult->num_rows > 0) {
       // Return error response
            //echo json_encode(array('success' => false));
            header("Location: ../admin/time.php?msg=failed");
            exit;
    } else {
        // Insert the new clock-in or clock-out entry
       
        $sql = "INSERT INTO clocking (UserID, ClockInTime, date) VALUES ('$userId', '$time', '$date')";

        // Executing the query
        $result = $con->query($sql);
        
        
        if ($result) {
            // Return success response
            //echo json_encode(array('success' => true));
            header("Location: ../admin/time.php?msg=success");
            exit;
        } else {
            // Return error response
            //echo json_encode(array('success' => false));
            header("Location: ../admin/time.php?msg=failed");
            exit;
        }
      
    }
}
?>

