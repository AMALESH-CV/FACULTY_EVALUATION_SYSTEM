<?php
?>
<form action="" id="manage_teaching">
  <div class="form-group">
    <div id="msg" class="form-group"></div>
    <label for="planned-theory-hours">Planned Theory Hours:</label>
    <input type="number" class="form-control" id="planned-theory-hours" name="theory_planned" required value="<?php echo isset($theory_planned) ? $theory_planned : '' ?>">
  </div>
  <div class="form-group">
    <label for="engaged-theory-hours">Engaged Theory Hours:</label>
    <input type="number" class="form-control" id="engaged-theory-hours" name="theory_engaged" required value="<?php echo isset($theory_engaged) ? $theory_engaged : '' ?>">
  </div>
  <div class="form-group">
    <label for="planned-practical-hours">Planned Practical Hours:</label>
    <input type="number" class="form-control" id="planned-practical-hours" name="practical_planned" required value="<?php echo isset($practical_planned) ? $practical_planned : '' ?>">
  </div>
  <div class="form-group">
    <label for="engaged-practical-hours">Engaged Practical Hours:</label>
    <input type="number" class="form-control" id="engaged-practical-hours" name="practical_engaged" required value="<?php echo isset($practical_engaged) ? $practical_engaged : '' ?>">
  </div>
  <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required value="<?php echo isset($proof) ? $proof : '' ?>">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


<script>


  $('#manage_teaching').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    start_load()
    $('#msg').html('')

    $.ajax({
      url:'ajax.php?action=save_teaching_hours',
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
            location.replace('index.php?page=teaching_hours')
          },750)
        }else if(resp == 2){
            $('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Data already exist.</div>')
            end_load()
          }
      }
    })
  })
</script>
