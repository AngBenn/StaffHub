<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "../settings/connection.php";

if (isset($_POST["LOGIN"])) {
    
    // Collecting form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Selecting records from the People table using email
    $sql = "SELECT * FROM users WHERE Email='$email'";
    
    // Executing the query
    $result = $con->query($sql);
  
    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        
        // Verifying the password
        if (password_verify($password, $record["Password"])) {
            // Password is correct
            $_SESSION['user_id'] = $record["UserID"];

            // Fetching role ID from Roles table
            $roleName = $record["Role"];
            $roleIdSql = "SELECT id FROM roles WHERE RoleName='$roleName'";
            $roleResult = $con->query($roleIdSql);
            if ($roleResult->num_rows > 0) {
                $roleRecord = $roleResult->fetch_assoc();
                $_SESSION['role_id'] = $roleRecord["id"];
            } else {
                echo "Error: Role not found.";
            }

            // Redirect to login page
            include "../view/welcome.php";
            exit(); // Exit script after redirection
        } else {
            echo "Password not correct";
        }
    } else {
        echo "Record not found. User not registered";
    }
}

?>
