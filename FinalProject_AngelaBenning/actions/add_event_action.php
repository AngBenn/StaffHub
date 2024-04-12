<?php
include "../settings/connection.php";




if (isset($_POST["addEvent"])) {
    $name = $_POST["name"];
    $date = $_POST["date"];
    $location = $_POST["location"];



    $sql = "INSERT INTO events(event_name, event_date,event_location)
       VALUES('$name','$date','$location')";

    //Executing the query
    $result = $con->query($sql);
  
    if ($result) {
        // Return success response
        echo json_encode(array('success' => true));
    } else {
        // Return error response
        echo json_encode(array('success' => false));
    }
}
