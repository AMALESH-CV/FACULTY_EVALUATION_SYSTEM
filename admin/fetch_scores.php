<?php
// Start the session
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "evaluation_db");

// Check the database connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the faculty ID is set
if (isset($_GET['fid'])) {
  $facultyId = $_GET['fid'];
  
  // Retrieve the current academic year from the session
  $academicYear = $_SESSION['academic']['year']; // Update this line based on your session variable

  // ...

  // Query to calculate the overall score for the current academic year
  $score_query = "SELECT COALESCE(SUM(score), 0) AS total_score FROM (
                    SELECT score FROM teaching_hours WHERE teacher_id = $facultyId AND academic_year = '$academicYear'
                    UNION ALL
                    SELECT score FROM add_on_teaching WHERE teacher_id = $facultyId AND academic_year = '$academicYear'
                    UNION ALL
                    SELECT score FROM innovative_teaching WHERE teacher_id = $facultyId AND academic_year = '$academicYear'
                    UNION ALL
                    SELECT score FROM syllabus_enrichment WHERE teacher_id = $facultyId AND academic_year = '$academicYear'
                ) AS combined_scores";

  // ...

  // Execute the query
  $score_result = $conn->query($score_query);

  // Check if the query was successful
  if ($score_result) {
    $score_row = $score_result->fetch_assoc();
    $totalScore = $score_row['total_score'];

    // Return the total score as the response
    echo $totalScore;
  } else {
    // Return an error message if the query fails
    echo 'Error calculating score: ' . $conn->error;
  }
} else {
  // Return an error message if the faculty ID is not set
  echo 'Error: faculty ID not set.';
}

// Close the database connection
$conn->close();
?>
