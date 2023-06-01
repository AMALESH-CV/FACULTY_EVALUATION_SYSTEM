<?php
// Start the session
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "evaluation_db");

// Check the database connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['fid'])) {
    $facultyId = $_GET['fid'];
    
    // Retrieve the previous academic year
    $previousAcademicYear = $academicYear - 1;
    
    // Query to retrieve the previous year's scores for the teacher
    $previousScoresQuery = "SELECT total_score FROM final_score WHERE teacher_id = '$facultyId' AND academic_year = '$previousAcademicYear'";
    $previousScoresResult = $conn->query($previousScoresQuery);
    
    // Array to store the previous year's scores
    $previousScores = array();
    
    if ($previousScoresResult) {
        if ($previousScoresResult->num_rows > 0) {
            while ($row = $previousScoresResult->fetch_assoc()) {
                $previousScores[] = $row['total_score'];
            }
        } else {
            // No previous scores found
            $previousScores = array("No previous records available");
        }
    } else {
        // Error executing the query
        $previousScores = array("Error occurred while fetching previous scores");
    }
    
    // Convert the previous scores array to JSON format
    $previousScoresJSON = json_encode($previousScores);
    
    // Send the JSON response
    header('Content-Type: application/json');
    echo $previousScoresJSON;
}
?>
