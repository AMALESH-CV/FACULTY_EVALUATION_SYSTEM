<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "evaluation_db");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to get tables from database
$tables_query = "SHOW TABLES WHERE Tables_in_evaluation_db IN ('teaching_hours', 'add_on_teaching', 'innovative_teaching', 'syllabus_enrichment')";

// Execute query
$tables_result = $conn->query($tables_query);

// Check if query was successful
if ($tables_result) {
  // Loop through tables and display them
  while ($table_row = $tables_result->fetch_array()) {
    $table_name = $table_row[0];
    // Query to get table columns
    $columns_query = "SHOW COLUMNS FROM $table_name";
    $columns_result = $conn->query($columns_query);
    // Build table HTML
    $table_html = '<table>';
    $table_html .= '<tr><th colspan="' . $columns_result->num_rows . '"><h3 style="font-family: Arial, sans-serif; font-weight: bold; margin-top: 20px; margin-bottom: 20px;">' . $table_name . '</h3></th></tr>';
    $table_html .= '<tr>';
    while ($column_row = $columns_result->fetch_array()) {
      $table_html .= '<th style="background-color:#eee; padding:10px; border:1px solid #ddd;">' . $column_row[0] . '</th>';
    }
    $table_html .= '</tr>';
    // Query to get table data
    $data_query = "SELECT * FROM $table_name";
    $data_result = $conn->query($data_query);
    while ($data_row = $data_result->fetch_array()) {
      $table_html .= '<tr>';
      for ($i = 0; $i < $data_result->field_count; $i++) {
        $table_html .= '<td style="padding:10px; border:1px solid #ddd;">' . $data_row[$i] . '</td>';
      }
      $table_html .= '</tr>';
    }
    $table_html .= '</table>';
    // Display table HTML
    echo '<div class="col-md-12" style="margin-top:20px; margin-bottom:20px;">';
    echo '<div class="callout callout-info">';
    echo $table_html;
    echo '</div>';
    echo '</div>';
  }
} else {
  // Display error message if query failed
  echo 'Error getting tables from database: ' . $conn->error;
}

// Close database connection
$conn->close();
?>
