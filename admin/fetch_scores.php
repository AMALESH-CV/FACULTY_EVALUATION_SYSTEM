<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "evaluation_db");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if faculty ID is set
if (isset($_GET['fid'])) {
  $facultyId = $_GET['fid'];
  
  // Query to calculate the overall score
  $score_query = "SELECT SUM(score) AS total_score FROM (
                    SELECT score FROM teaching_hours WHERE teacher_id = $facultyId
                    UNION ALL
                    SELECT score FROM add_on_teaching WHERE teacher_id = $facultyId
                    UNION ALL
                    SELECT score FROM innovative_teaching WHERE teacher_id = $facultyId
                    UNION ALL
                    SELECT score FROM syllabus_enrichment WHERE teacher_id = $facultyId
                  ) AS combined_scores";

  // Execute query
  $score_result = $conn->query($score_query);

  // Check if query was successful
  if ($score_result) {
    $score_row = $score_result->fetch_assoc();
    $totalScore = $score_row['total_score'];

    // Return the total score as the response
    echo $totalScore;
  } else {
    // Return an error message if query fails
    echo 'Error calculating score: ' . $conn->error;
  }
} else {
  // Return an error message if faculty ID is not set
  echo 'Error: faculty ID not set.';
}

// Close database connection
$conn->close();
?>
