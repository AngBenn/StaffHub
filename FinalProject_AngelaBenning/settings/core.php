<?php
 // Start the session
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the function check_user() is not already defined
if (!function_exists('check_user')) {
    // Define the function check_user()
    function check_user() {
        // Check if user id session exists
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login_view page
            header("Location: ../login/Login_view.php");
            die(); // Stop further execution
        }
    }
}

// Define the function check_login() only if it doesn't already exist
if (!function_exists('check_login')) {
    function check_login() {
        // Check if role_id session exists
        if (!isset($_SESSION['role_id'])) {
            return false;
        } else {
            return $_SESSION['role_id'];
        }
    }
}



// Define the function return_userID() only if it doesn't already exist
if (!function_exists('return_userID')) {
    function return_userID() {
        // Check if user id session exists
        if (!isset($_SESSION['user_id'])) {
            return false;
        } else {
            return $_SESSION['user_id'];
        }
    }
}

?>