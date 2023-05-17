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

  // Query to update status column to "Rejected" for teacher ID
  $update_query = "UPDATE $table_name SET status = 'Rejected' WHERE teacher_id = $teacher_id";
  
  // Execute query
  if ($conn->query($update_query) === TRUE) {
    // Display pop-up message
    echo "<script>alert('Record updated successfully')</script>";
    // Go back to previous page
    echo "<script>window.history.back()</script>";
  } else {
    // Display error message if query fails
    echo "Error updating record: " . $conn->error;
  }
} else {
  // Display error message if table or teacher ID is not set
  echo 'Error: table or teacher ID not set.';
}

// Close database connection
$conn->close();
?>
