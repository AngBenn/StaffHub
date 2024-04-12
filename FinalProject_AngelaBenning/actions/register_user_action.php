<?php

include "../settings/connection.php";

if(isset($_POST["REGISTER"])){
    //Collecting form data
    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $Role=$_POST["role"];
    $phoneNumber=$_POST["phoneNumber"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $hashedPassword=password_hash($password, PASSWORD_DEFAULT);

   

    $sql="INSERT INTO users(FirstName,LastName,Email,PhoneNumber, Role,Password)
       VALUES('$firstName','$lastName','$email','$phoneNumber','$Role','$hashedPassword')" ;
    
    //Executing the query
    $result= $con->query($sql);
   
    
    if ($result) {
       
    
        header("Location: ../login/login_view.php");
    }
        
        
    else {
        // Display error on register_view page
        echo "Error: Registration failed. Please try again.";
    }
}
?>