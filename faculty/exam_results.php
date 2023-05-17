<form action="submit-exam-results.php" method="post">
  <div class="form-group">
    <label for="department">Department:</label>
    <select class="form-control" id="department" name="department" required>
      <option value="">Select Department</option>
      <option value="MCA">MCA</option>
      <option value="MBA">MBA</option>
      <option value="CSE">CSE</option>
      <option value="ECE">ECE</option>
      <option value="EEE">EEE</option>
      <option value="ME">ME</option>
      <option value="CE">CE</option>
      <option value="NASB">NASB</option>
    </select>
  </div>
  <div class="form-group">
    <label for="total-appeared">Total Students Appeared:</label>
    <input type="number" class="form-control" id="total-appeared" name="total-appeared" required>
  </div>
  <div class="form-group">
    <label for="students-passed">Students Passed:</label>
    <input type="number" class="form-control" id="students-passed" name="students-passed" required>
  </div>
  <div class="form-group">
    <label for="students-failed">Students Failed:</label>
    <input type="number" class="form-control" id="students-failed" name="students-failed" required>
  </div>
  <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
