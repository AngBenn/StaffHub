<?php
session_start();
include "../settings/connection.php";

if(isset($_POST["UPDATE"])){
    //Collecting form data
    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $Role=$_POST["role"];
    $phoneNumber=$_POST["phoneNumber"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $hashedPassword=password_hash($password, PASSWORD_DEFAULT);

    $userID=$_SESSION['user_id'];
   

    $sql="UPDATE users 
    SET FirstName='$firstName', LastName='$lastName', Email='$email', PhoneNumber='$phoneNumber', Role='$Role', Password='$hashedPassword' 
    WHERE userID='$userID'"; 
    
    //Executing the query
    $result= $con->query($sql);
   
   
    if ($result) {
       
    
        header("Location: ../view/welcome.php");
    }
        
        
    else {
        // Display error on register_view page
        echo "Error: Profile Update failed. Please try again.";
    }
}
?>