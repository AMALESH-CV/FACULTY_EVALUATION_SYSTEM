<?php
?>
<form action="" method="post" id="manage_fdp">
  <div class="form-group">
    <div id="msg" class="form-group"></div>
    <label for="paper-conferences">Paper Publications in Conferences:</label>
   <input type="checkbox" id="paper-conferences" name="conference_publication" value="1">
  </div>
  <div class="form-group">
    <label for="paper-journals">Paper Publications in Indexed Journals:</label>
    <input type="checkbox" id="paper-journals" name="indexed_journal_publication" value="1">
  </div>
  <div class="form-group">
    <label for="short-courses">Short Term Courses Attended:</label>
    <input type="checkbox" id="short-courses" name="short_term_courses_attended" value="1">
  </div>
  <div class="form-group">
    <label for="certificate-programs">Certificate Programs Attended:</label>
    <input type="checkbox" id="certificate-programs" name="certificate_programs_attended" value="1">
  </div>
  <div class="form-group">
    <label for="seminars-attended">Seminars Attended:</label>
    <input type="checkbox" id="seminars-attended" name="seminars_attended" value="1">
  </div>
  <div class="form-group">
    <label for="seminars-conducted">Seminars Conducted to Other Departments:</label>
    <input type="checkbox" id="seminars-conducted" name="seminars_conducted" value="1">
  </div>
  <div class="form-group">
    <label for="projects-suggested">New Projects Suggested to Students:</label>
    <input type="checkbox" id="projects-suggested" name="projects_suggested" value="1">
  </div>
  <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
  $('#manage_fdp').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    start_load()
    $('#msg').html('')

    $.ajax({
      url:'ajax.php?action=save_fdp',
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      success:function(resp){
        if(resp == 1){
          alert_toast('Data successfully saved.',"success");
          setTimeout(function(){
            location.replace('index.php?page=upload')
          },750)
        }else if(resp == 2){
            $('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Data already exist.</div>')
            end_load()
          }
      }
    })
  })
</script>
