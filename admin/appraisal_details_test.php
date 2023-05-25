<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!DOCTYPE html>
<html>
<head>
  <title>Generate PDF Report</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
</head>
<body>
  <?php
  // Connect to database
  $conn = new mysqli("localhost", "root", "", "evaluation_db");

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $faculty_id = isset($_GET['fid']) ? $_GET['fid'] : '';

  function ordinal_suffix($num){
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
  ?>

  <div class="col-lg-12">
      <div class="callout callout-info">
          <div class="d-flex w-100 justify-content-center align-items-center">
              <label for="faculty">Select Faculty</label>
              <div class=" mx-2 col-md-4">
                  <select name="" id="faculty_id" class="form-control form-control-sm select2">
                      <option value=""></option>
                      <?php
                      $faculty = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc");
                      $f_arr = array();
                      $fname = array();
                      while($row=$faculty->fetch_assoc()):
                          $f_arr[$row['id']]= $row;
                          $fname[$row['id']]= ucwords($row['name']);
                      ?>
                      <option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? "selected" : "" ?>><?php echo ucwords($row['name']) ?></option>
                      <?php endwhile; ?>
                  </select>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12 mb-1">
              <div class="d-flex justify-content-end w-100">
                  <button class="btn btn-sm btn-success bg-gradient-success" id="calculate-score-btn"><i class="fa fa-calculator"></i> Calculate Score</button>
                  <button class="btn btn-sm btn-success bg-gradient-success" style="display:none" id="print-btn"><i class="fa fa-print"></i> Print</button>
              </div>
          </div>
      </div>
  </div>

  <div id="score-container" style="display:none;">
      <div class="col-md-12" style="margin-top: 20px;">
          <div class="d-flex justify-content-end w-100">
              <p id="overall-score">Overall Score: <span id="score-value"></span></p>
              <button class="btn btn-sm btn-success bg-gradient-success" id="generate-pdf-btn" data-score=""><i class="fa fa-file-pdf"></i> Generate Report</button>

          </div>
      </div>
  </div>

  <?php
  // Check if teacher ID is set
  if (isset($_GET['fid'])) {
      $ftrid = $_GET['fid'];

      // Query to get tables from database
      $tables_query = "SHOW TABLES FROM evaluation_db WHERE Tables_in_evaluation_db IN ('teaching_hours', 'add_on_teaching', 'innovative_teaching', 'syllabus_enrichment')";

      // Execute query
      $tables_result = $conn->query($tables_query);

      // Check if query was successful
      if ($tables_result) {
          // Initialize overall score variable
          $overallScore = 0;

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
              $table_html .= '<th style="background-color:#eee; padding:10px; border:1px solid #ddd;">Action</th></tr>';
              // Query to get table data for the teacher ID
              $data_query = "SELECT * FROM $table_name WHERE teacher_id = $ftrid ";
              $data_result = $conn->query($data_query);
              while ($data_row = $data_result->fetch_array()) {
                  $table_html .= '<tr>';
                  for ($i = 0; $i < $data_result->field_count; $i++) {
                      $table_html .= '<td style="padding:10px; border:1px solid #ddd;">' . $data_row[$i] . '</td>';
                  }
                  $table_html .= '<td style="padding:10px; border:1px solid #ddd;"><a href="admin/approve.php?table=' . $table_name . '&teacher_id=' . $data_row[0] . '">Approve</a> | <a href="admin/reject.php?table=' . $table_name . '&teacher_id=' . $data_row[0] . '">Reject</a></td></tr>';

                  // Retrieve the score value from the 'score' field
                  $score = $data_row['score'];
                  // Add the score to the overall score
                  $overallScore += $score;
              }
              $table_html .= '</table>';
              // Display table HTML
              echo '<div class="col-md-12" style="margin-top:20px; margin-bottom:20px;">';
              echo '<div class="callout callout-info">';
              echo $table_html;
              echo '</div>';
              echo '</div>';
          }

          // Display the overall score
          echo '<script>document.getElementById("score-value").textContent = "' . $overallScore . '";</script>';
      } else {
          // Display error message if query failed
          echo 'Error getting tables from database: ' . $conn->error;
      }
  }

  // Close database connection
  $conn->close();
  ?>

  <script>
$(document).ready(function() {
  $('#calculate-score-btn').click(function() {
    var facultyId = $('#faculty_id').val();
    if (facultyId) {
      $.ajax({
        url: 'admin/fetch_scores.php',
        type: 'GET',
        data: { fid: facultyId },
        success: function(response) {
          var score = parseFloat(response).toFixed(2); // Limit float portion to 2 digits
          $('#overall-score').text('Overall Score: ' + score);
          $('#score-value').text(score);
          $('#score-container').show();
          $('#generate-pdf-btn').attr('data-score', score); // Update the data-score attribute
        },
        error: function() {
          alert('Error occurred while fetching the score.');
        }
      });
    }
  });

  $('#generate-pdf-btn').click(function() {
    var teacherId = $('#faculty_id').val();
    var score = $('#generate-pdf-btn').attr('data-score'); // Get the score from the data-score attribute
    var teacherName = $('#faculty_id option:selected').text();
    var hodName = 'Your HOD Name';
    var academicYear = '2023-2024';

    var docDefinition = {
      content: [
        { text: 'Teacher Name: ' + teacherName, style: 'header' },
        { text: 'HOD Name: ' + hodName, style: 'header' },
        { text: 'Current Academic Year: ' + academicYear, style: 'header' },
        { text: 'Score: ' + score, style: 'header' },
      ],
      styles: {
        header: {
          fontSize: 18,
          bold: true,
          margin: [0, 20, 0, 10]
        }
      }
    };

    pdfMake.createPdf(docDefinition).download('report.pdf');
  });

  $('#print-btn').click(function() {
    window.print();
  });
});


  </script>
</body>
</html>









<script>
  $(document).ready(function(){
    $('#faculty_id').change(function(){
      if($(this).val() > 0)
      window.history.pushState({}, null, './index.php?page=appraisal_details_test&fid='+$(this).val());
      load_class()
    })
    if($('#faculty_id').val() > 0)
      load_class()
  })
  function load_class(){
    start_load()
    var fname = <?php echo json_encode($fname) ?>;
    $('#fname').text(fname[$('#faculty_id').val()])
    $.ajax({
      url:"ajax.php?action=get_class",
      method:'POST',
      data:{fid:$('#faculty_id').val()},
      error:function(err){
        console.log(err)
        alert_toast("An error occured",'error')
        end_load()
      },
      success:function(resp){
        if(resp){
          resp = JSON.parse(resp)
          if(Object.keys(resp).length <= 0 ){
            $('#class-list').html('<a href="javascript:void(0)" class="list-group-item list-group-item-action disabled">No data to be display.</a>')
          }else{
            $('#class-list').html('')
            Object.keys(resp).map(k=>{
            $('#class-list').append('<a href="javascript:void(0)" data-json=\''+JSON.stringify(resp[k])+'\' data-id="'+resp[k].id+'" class="list-group-item list-group-item-action show-result">'+resp[k].class+' - '+resp[k].subj+'</a>')
            })

          }
        }
      },
      complete:function(){
        end_load()
        anchor_func()
        if('<?php echo isset($_GET['rid']) ?>' == 1){
          $('.show-result[data-id="<?php echo isset($_GET['rid']) ? $_GET['rid'] : '' ?>"]').trigger('click')
        }else{
          $('.show-result').first().trigger('click')
        }
      }
    })
  }
  function anchor_func(){
    $('.show-result').click(function(){
      var vars = [], hash;
      var data = $(this).attr('data-json')
        data = JSON.parse(data)
      var _href = location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < _href.length; i++)
        {
          hash = _href[i].split('=');
          vars[hash[0]] = hash[1];
        }
      window.history.pushState({}, null, './index.php?page=report&fid='+vars.fid+'&rid='+data.id);
      load_report(vars.fid,data.sid,data.id);
      $('#subjectField').text(data.subj)
      $('#classField').text(data.class)
      $('.show-result.active').removeClass('active')
      $(this).addClass('active')
    })
  }

</script>