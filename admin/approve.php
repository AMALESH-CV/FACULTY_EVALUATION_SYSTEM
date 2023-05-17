<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "evaluation_db");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if table and teacher ID are set
if (isset($_GET['table']) && isset($_GET['teacher_id'])) {
  $table_name = $_GET['table'];
  $teacher_id = $_GET['teacher_id'];

  // Query to update status column to "Approved" for teacher ID
  $update_query = "UPDATE $table_name SET status = 'Approved' WHERE teacher_id = $teacher_id";
  
  // Execute query
  if ($conn->query($update_query) === TRUE) {
    echo "Record updated successfully";

    // Query to calculate score for teacher ID based on table name
    $select_query = "";
    switch ($table_name) {
      case "teaching_hours":
        $select_query = "SELECT theory_engaged/theory_planned*70 + practical_engaged/practical_planned*30 AS score FROM $table_name WHERE teacher_id = $teacher_id";
        break;
      case "syllabus_enrichment":
        $select_query = "SELECT hours_engaged/hours_planned*50 AS score FROM $table_name WHERE teacher_id = $teacher_id";
        break;
      // Equation for add_on_teaching table
      case 'add_on_teaching':
        $select_query = "SELECT hours_taken_1/hours_planned_1*25 + hours_taken_2/hours_planned_2*25 AS score FROM $table_name WHERE teacher_id = $teacher_id";
        break;

      // add more cases for other tables here
      default:
        echo "Error: invalid table name";
        break;

    }

    // Execute query
    $result = $conn->query($select_query);

    // Update score column with calculated score for teacher ID
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $score = $row['score'];
      $update_query = "UPDATE $table_name SET score = $score WHERE teacher_id = $teacher_id";
      if ($conn->query($update_query) === TRUE) {
        echo "Score calculated and updated successfully";
        // Display success message and go back to previous page
        echo "<script>alert('Score generated successfully!');</script>";
        echo "<script>window.history.back();</script>";
        exit();
      } else {
        echo "Error updating score: " . $conn->error;
      }
    } else {
      echo "Error calculating score: no records found";
    }
  } else {
    echo "Error updating record: " . $conn->error;
  }
} else {
  // Display error message if table or teacher ID is not set
  echo 'Error: table or teacher ID not set.';
}

// Close database connection
$conn->close();
?>
