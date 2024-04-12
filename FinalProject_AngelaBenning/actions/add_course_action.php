<?php
include "../settings/connection.php";
include "../settings/core.php";
include "../functions/profile_fxn.php";
$userId=return_userID();




if (isset($_POST['addCourse'])) {
    
    $name = $_POST["name"];
    $description=$_POST["description"];
    $classID=$_POST["class"];
    


    $sql = "INSERT INTO courses(CourseName, UserID, CourseDescription,ClassID)
       VALUES('$name','$userId','$description','$classID')";

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