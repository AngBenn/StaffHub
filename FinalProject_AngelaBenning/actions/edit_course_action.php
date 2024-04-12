<?php
include "../settings/connection.php";




if (isset($_POST['editCourse'])) {
    
    $name = $_POST["name"];
    $description=$_POST["description"];
    $classID=$_POST["class"];
    $Id=$_POST["Id"];


   

       //UPDATE QUERY
    $sql = "UPDATE courses SET CourseName = '$name', CourseDescription='$description',ClassID='$classID' WHERE CourseID ='$Id'";

    //Executing the query
    $result = $con->query($sql);

    if ($result) {
       
        header("Location: ../admin/courses.php");
    } else {
        // Display error on register_view page
        echo "Error: Adding Course failed. Please try again.";
    }
}