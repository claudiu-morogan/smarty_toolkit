<?php $title = 'Edit Debt'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3 class="mb-4">Edit Debt</h3>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Debtor Name</label>
        <input type="text" name="debtor_name" class="form-control" value="<?php echo htmlspecialchars($debt->debtor_name); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Amount</label>
        <input type="number" name="amount" class="form-control" step="0.01" value="<?php echo htmlspecialchars($debt->amount); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"><?php echo htmlspecialchars($debt->description); ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control" value="<?php echo htmlspecialchars($debt->due_date); ?>">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="is_paid" class="form-check-input" id="is_paid" <?php if ($debt->is_paid) echo 'checked'; ?>>
        <label class="form-check-label" for="is_paid">Paid</label>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="<?php echo site_url('debts'); ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
