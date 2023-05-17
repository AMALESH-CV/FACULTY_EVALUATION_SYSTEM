<form action="submit-contribution.php" method="post">
  <div class="form-group">
    <label for="teacher-name">Teacher Name:</label>
    <input type="text" class="form-control" id="teacher-name" name="teacher-name" required>
  </div>
  <div class="form-group">
    <label for="contribution-type">Contribution Type:</label>
    <div class="checkbox">
      <label><input type="checkbox" name="contribution-type[]" value="Coordinator College Level Committee">Coordinator College Level Committee</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="contribution-type[]" value="Coordination Department Level Committee">Coordination Department Level Committee</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="contribution-type[]" value="Member College Level Committee">Member College Level Committee</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="contribution-type[]" value="Member Department Level Committee">Member Department Level Committee</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="contribution-type[]" value="Student Training Coordinator">Student Training Coordinator</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="contribution-type[]" value="Tech Talks">Tech Talks</label>
    </div>
       <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
  </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
