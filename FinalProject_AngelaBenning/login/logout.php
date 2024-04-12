<?php
session_start();

// Unset session variables
unset($_SESSION['user_id']);
unset($_SESSION['role_id']);

// Redirect to the login page
header("Location: ../login/login_view.php");
exit;
?>