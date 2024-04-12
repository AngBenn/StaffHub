<?php
include "../settings/core.php";
include "../settings/connection.php";



if (isset($_POST["editEvent"])) {
    $name = $_POST["name"];
    $date=$_POST["date"];
    $location=$_POST["location"];
    $Id=$_POST["Id"];
    
    
    //UPDATE QUERY
    $sql = "UPDATE events SET event_name = '$name', event_date='$date',event_location='$location' WHERE Id ='$Id'";

    //Executing the query
    $result = $con->query($sql);

    

    if ($result) {
        header("Location: ../admin/events.php");
    } else {
        // Display error on edit_chore_view page
        echo "Error: Editing failed. Please try again.";
    }
    
}