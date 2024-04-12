
<?php
include "../settings/connection.php";

// Check if chore ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to chore_control_view
    header("Location: ../admin/courses.php");
    exit(); 
}

// Retrieve chore ID from the GET URL and store in a variable
$Id = $_GET['id'];

// Write the delete query using the chore ID
$sql = "DELETE FROM courses WHERE CourseID= '$Id'";

// Execute the query
if ($con->query($sql) === TRUE) {
    // Redirect to chore control view if successful
    header("Location: ../admin/courses.php");
    exit(); // Stop further execution
} else {
    // Display error if execution failed
    echo "Error: " . $con->error;
}

// Close the database connection
$con->close();
?>