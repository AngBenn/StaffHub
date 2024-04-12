<?php



    

    function profile($userId){
        include "../settings/connection.php";
    
        // Sanitize the user ID to prevent SQL injection
        $userId = mysqli_real_escape_string($con, $userId);
    
        $sql = "SELECT FirstName FROM users WHERE UserID = '$userId'";
    
        // Execute the query
        $result = $con->query($sql);
    
        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            // Fetch the first row from the result set
            $row = $result->fetch_assoc();
            // Return the first name
            return $row['FirstName'];
        } else {
            // Return null or handle the case where the user ID is not found
            return null;
        }
    }

?>

