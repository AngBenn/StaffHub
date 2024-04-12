<?php

include "../settings/connection.php";
//check connection:

//Executing select query on family_name
$sql= "SELECT * from clocking";
$result= $con->query($sql);


    if($result->num_rows >0){
       return $time = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
   

//Close the database connection
$con -> close();
?>