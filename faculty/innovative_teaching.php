<?php
$academicYear = $_SESSION['academic']['year'];
?>
<h3>Academic Year: <?php echo $academicYear; ?></h3>
<form action="" id="manage_innovative">
  <div class="form-group">
    <div id="msg" class="form-group"></div>
    <label for="methodology-name">Methodology Name:</label>
    <input type="text" class="form-control" id="methodology-name" name="methodology_name" required value="<?php echo isset($methodology_name) ? $methodology_name : '' ?>">
  </div>
  <div class="form-group">
    <label for="description">Methodology Description:</label>
    <textarea class="form-control" id="description" name="m_description" rows="5" required value="<?php echo isset($m_description) ? $m_description : '' ?>"></textarea>
  </div>
  <div class="form-group">
    <label for="improvements">Improvements Measured:</label>
    <textarea class="form-control" id="improvements" name="improvements" rows="5" required value="<?php echo isset($improvements) ? $improvements : '' ?>"></textarea>
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


  $('#manage_innovative').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    start_load()
    $('#msg').html('')

    $.ajax({
      url:'ajax.php?action=save_innovative',
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

