<?php
?>
<form form action="" id="manage_syllabus">
  <div id="msg" class="form-group"></div>
  <div class="form-group">
    <label for="additional-topics">Additional Topics Covered:</label>
    <textarea class="form-control" id="additional-topics" name="additional_topics" rows="3" required value="<?php echo isset($additional_topics) ? $additional_topics : '' ?>"></textarea>
  </div>
  <div class="form-group">
    <label for="experiments">Experiments Conducted:</label>
    <textarea class="form-control" id="experiments" name="experiments" rows="3" required value="<?php echo isset($experiments) ? $experiments : '' ?>"></textarea>
  </div>
  <div class="form-group">
    <label for="hours-planned">Hours Planned:</label>
    <input type="number" class="form-control" id="hours-planned" name="hours_planned" required value="<?php echo isset($hours_planned) ? $hours_planned : '' ?>">
  </div>
  <div class="form-group">
    <label for="hours-engaged">Hours Engaged:</label>
    <input type="number" class="form-control" id="hours-engaged" name="hours_engaged" required value="<?php echo isset($hours_engaged) ? $hours_engaged : '' ?>">
  </div>
 <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required value="<?php echo isset($proof) ? $proof : '' ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>

  $('#manage_syllabus').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    start_load()
    $('#msg').html('')

    $.ajax({
      url:'ajax.php?action=save_syllabus',
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
