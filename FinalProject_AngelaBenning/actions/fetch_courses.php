<?php
// Include the database connection file
include "../settings/connection.php";

// Check if the class parameter is set in the request
if (isset($_GET['class'])) {
    // Get the selected class ID from the request
    $selectedClassID = $_GET['class'];

    // Prepare and execute a query to fetch courses for the selected class from the database
    $sql = "SELECT CourseName FROM courses WHERE ClassID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $selectedClassID); // Assuming class_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch courses from the result set
    $courses = array();
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row['CourseName'];
    }

    // Close the prepared statement
    $stmt->close();

    // Return the courses as JSON data
    header('Content-Type: application/json');
    echo json_encode($courses);
} else {
    // Class parameter not set in the request
    echo "Error: Class parameter not set.";
}
?>
