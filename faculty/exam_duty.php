<form action="submit-duty.php" method="post">
  <div class="form-group">
    <label for="teacher-name">Teacher Name:</label>
    <input type="text" class="form-control" id="teacher-name" name="teacher-name" required>
  </div>
  <div class="form-group">
    <label for="duty-type">Duty Type:</label>
    <select class="form-control" id="duty-type" name="duty-type" required>
      <option value="">Select Duty Type</option>
      <option value="Invigilation">Invigilation</option>
      <option value="Question Paper Creation">Question Paper Creation</option>
    </select>
  </div>
  <div class="form-group">
    <label for="duty-details">Duty Details:</label>
    <input type="text" class="form-control" id="duty-details" name="duty-details" placeholder="Enter Qn Paper Set Number or Invigilation Duty Hours Assigned and Completed">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
