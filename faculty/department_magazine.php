<form action="submit-services.php" method="post">
  <div class="form-group">
    <label for="teacher-name">Teacher Name:</label>
    <input type="text" class="form-control" id="teacher-name" name="teacher-name" required>
  </div>
  <div class="form-group">
    <label for="magazine-name">Magazine Name:</label>
    <input type="text" class="form-control" id="magazine-name" name="magazine-name" required>
  </div>
  <div class="form-group">
    <label for="article-title">Article Title:</label>
    <input type="text" class="form-control" id="article-title" name="article-title" required>
  </div>
  <div class="form-group">
    <label for="service-type">Service Type:</label>
    <select class="form-control" id="service-type" name="service-type" required>
      <option value="">Select Service Type</option>
      <option value="Writing">Writing</option>
      <option value="Editing">Editing</option>
      <option value="Designing">Designing</option>
      <option value="Other">Other</option>
    </select>
  </div>
    <div class="form-group">
    <label for="proof">Proof Document:</label>
    <input type="file" class="form-control-file" id="proof" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
