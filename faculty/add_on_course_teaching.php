<?php
$academicYear = $_SESSION['academic']['year'];
?>
<h3>Academic Year: <?php echo $academicYear; ?></h3>
<form action="" id="add_on_teaching">
  <div class="form-group">
    <div id="msg" class="form-group"></div>
    <label for="subject-1">Subject 1:</label>
    <input type="text" class="form-control" id="subject-1" name="subject_1" required value="<?php echo isset($subject_1) ? $subject_1 : '' ?>">
  </div>
  <div class="form-group">
    <label for="hours-planned-1">Hours Planned (Subject 1):</label>
    <input type="number" class="form-control" id="hours-planned-1" name="hours_planned_1" min="0" required value="<?php echo isset($hours_planned_1) ? $hours_planned_1 : '' ?>">
  </div>
  <div class="form-group">
    <label for="hours-taken-1">Hours Taken (Subject 1):</label>
    <input type="number" class="form-control" id="hours-taken-1" name="hours_taken_1" min="0" required value="<?php echo isset($hours_taken_1) ? $hours_taken_1 : '' ?>">
  </div>

  <div class="form-group">
    <label for="subject-2">Subject 2:</label>
    <input type="text" class="form-control" id="subject-2" name="subject_2" required value="<?php echo isset($subject_2) ? $subject_2 : '' ?>">
  </div>
    <div class="form-group">
    <label for="hours-planned-2">Hours Planned (Subject 2):</label>
    <input type="number" class="form-control" id="hours-planned-2" name="hours_planned_2" min="0" required value="<?php echo isset($hours_planned_2) ? $hours_planned_2 : '' ?>">
  </div>
  <div class="form-group">
    <label for="hours-taken-2">Hours Taken (Subject 2):</label>
    <input type="number" class="form-control" id="hours-taken-2" name="hours_taken_2" min="0" required value="<?php echo isset($hours_taken_2) ? $hours_taken_2 : '' ?>">
  </div>
  <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required value="<?php echo isset($proof) ? $proof : '' ?>">
  </div>

 <!-- Add a hidden input field for academic year -->
  <input type="hidden" name="academic_year" value="<?php echo $academicYear; ?>">

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>


  $('#add_on_teaching').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    start_load()
    $('#msg').html('')


    $.ajax({
      url:'ajax.php?action=save_add_on_teaching',
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
