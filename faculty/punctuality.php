<form action="submit-punctuality.php" method="post">
  <div class="form-group">
    <label for="teacher-name">Teacher Name:</label>
    <input type="text" class="form-control" id="teacher-name" name="teacher-name" required>
  </div>
  <div class="form-group">
    <label for="semester">Semester:</label>
    <input type="text" class="form-control" id="semester" name="semester" required>
  </div>
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
    <label for="total-punches">Total Punches:</label>
    <input type="number" class="form-control" id="total-punches" name="total-punches" required>
  </div>
  <div class="form-group">
    <label for="late-punches">Late Punches:</label>
    <input type="number" class="form-control" id="late-punches" name="late-punches" required>
  </div>
  <div class="form-group">
    <label for="absent-punches">Absent Punches:</label>
    <input type="number" class="form-control" id="absent-punches" name="absent-punches" required>
  </div>
  <div class="form-group">
    <label for="late-notes">Late Notes:</label>
    <input type="number" class="form-control" id="late-notes" name="late-notes" required>
  </div>
  <div class="form-group">
    <label for="other-notes">Other Notes:</label>
    <input type="number" class="form-control" id="other-notes" name="other-notes" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
