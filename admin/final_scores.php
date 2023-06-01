<?php
// Fetch the faculty ID from the request
$facultyId = $_GET['fid'];

// Fetch the academic year from the session
$academicYear = $_SESSION['academic']['year'];

// Query to fetch the previous year's scores for the faculty
// Query to fetch the previous year's scores for the faculty
// Query to fetch the previous year's scores for the faculty
$scores_query = "SELECT * FROM final_score WHERE teacher_id = '$facultyId' AND (LEFT(academic_year, 4) + 1) < LEFT('$academicYear', 4)";


// Execute the query
$scores_result = $conn->query($scores_query);

// Check if query was successful
if ($scores_result) {
  $previousScores = array();
  while ($score_row = $scores_result->fetch_assoc()) {
    $previousScores[] = array(
      'year' => $score_row['academic_year'],
      'score' => $score_row['total_score']
    );
  }
  // Convert the scores to JSON and return the response
  echo json_encode($previousScores);
} else {
  // Display error message if query failed
  echo 'Error fetching previous year scores: ' . $conn->error;
}
?>
