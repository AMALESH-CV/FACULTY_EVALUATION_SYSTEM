<form action="submit-admission.php" method="post">
  <div class="form-group">
    <label for="teacher-name">Teacher Name:</label>
    <input type="text" class="form-control" id="teacher-name" name="teacher-name" required>
  </div>
  <div class="form-group">
    <label for="student-ref">Student Reference Number:</label>
    <input type="text" class="form-control" id="student-ref" name="student-ref" required>
  </div>
  <div class="form-group">
    <label for="dept">Student Department:</label>
    <select class="form-control" id="dept" name="dept" required>
      <option value="">Select Student Department</option>
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
    <label for="service-type">Service Type:</label>
    <select class="form-control" id="service-type" name="service-type" required>
      <option value="">Select Service Type</option>
      <option value="Counseling">Counseling</option>
      <option value="Admission Process Assistance">Admission Process Assistance</option>
      <option value="Application Review">Application Review</option>
      <option value="Other">Other</option>
    </select>
  </div>
  <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
  </div>
  <button type="submit" class="btn btn-primary mx-auto d-block">Submit</button>
</form>
