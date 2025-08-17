<?php $title = 'Add Debt'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3 class="mb-4">Add Debt</h3>
  <?php if (validation_errors()): ?>
    <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
  <?php endif; ?>
  <?php echo form_open(); ?>
      <div class="mb-3">
      <div class="mb-3">
        <label class="form-label">Contact</label>
        <select name="contact_id" class="form-select">
          <option value="">-- None --</option>
          <?php if (isset($contacts)) foreach ($contacts as $contact): ?>
            <option value="<?php echo $contact->id; ?>"><?php echo htmlspecialchars($contact->name); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
        <label class="form-label">Debtor Name</label>
        <input type="text" name="debtor_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Amount</label>
        <input type="number" name="amount" class="form-control" step="0.01" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
      <a href="<?php echo site_url('debts'); ?>" class="btn btn-secondary">Cancel</a>
  </form>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
