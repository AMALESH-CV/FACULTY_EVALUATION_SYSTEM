<?php
include('db_connect.php');

function ordinal_suffix1($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return $num.'st';
            case 2: return $num.'nd';
            case 3: return $num.'rd';
        }
    }
    return $num.'th';
}

// Retrieve the teacher's appraisal total score
$teacherId = $_SESSION['login_id']; // Assuming the teacher's ID is stored in the session
$scores_query = "SELECT * FROM final_score WHERE teacher_id = '$teacherId'";
$scores_result = $conn->query($scores_query);

if (!$scores_result) {
    echo 'Error retrieving scores from the database: ' . $conn->error;
} else {
    // Display the scores in a table
    echo '<table style="width: 100%; border-collapse: collapse;">';
    echo '<tr><th style="border: 1px solid #000; padding: 8px;">Academic Year</th><th style="border: 1px solid #000; padding: 8px;">Total Score</th></tr>';
    while ($score_row = $scores_result->fetch_assoc()) {
        $academicYear = $score_row['academic_year'];
        $totalScore = $score_row['total_score'];
        echo '<tr><td style="border: 1px solid #000; padding: 8px;">' . $academicYear . '</td><td style="border: 1px solid #000; padding: 8px;">' . $totalScore . '</td></tr>';
    }
    echo '</table>';
}
?>
