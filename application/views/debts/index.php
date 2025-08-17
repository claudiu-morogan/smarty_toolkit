<?php $title = 'Debts'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-10">
    <h3 class="mb-4">Who Owes Me Money</h3>
    <a href="<?php echo site_url('debts/add'); ?>" class="btn btn-primary mb-3">Add Debt</a>
    <?php if (!empty($reminders)): ?>
      <div class="alert alert-warning">
        <strong>Reminders:</strong>
        <ul class="mb-0">
          <?php foreach ($reminders as $rem): ?>
            <li><?php echo htmlspecialchars($rem->debtor_name); ?> owes you <strong><?php echo number_format($rem->amount, 2); ?></strong> by <?php echo htmlspecialchars($rem->due_date); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>Name</th>
          <th>Amount</th>
          <th>Contact</th>
          <th>Description</th>
          <th>Due Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($debts as $debt): ?>
          <tr>
            <td><?php echo htmlspecialchars($debt->debtor_name); ?></td>
            <td><?php echo number_format($debt->amount, 2); ?></td>
            <td>
              <?php if (!empty($debt->contact_name)) {
                echo '<span class="badge bg-info">' . htmlspecialchars($debt->contact_name) . '</span>';
              } else {
                echo '<span class="text-muted">-</span>';
              } ?>
            </td>
            <td><?php echo nl2br(htmlspecialchars($debt->description)); ?></td>
            <td><?php echo htmlspecialchars($debt->due_date); ?></td>
            <td><?php echo $debt->is_paid ? '<span class="badge bg-success">Paid</span>' : '<span class="badge bg-warning text-dark">Unpaid</span>'; ?></td>
            <td>
              <a href="<?php echo site_url('debts/edit/'.$debt->id); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
              <a href="<?php echo site_url('debts/delete/'.$debt->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this debt?');">Delete</a>
              <?php if (!$debt->is_paid): ?>
                <a href="<?php echo site_url('debts/mark_paid/'.$debt->id); ?>" class="btn btn-sm btn-success">Mark Paid</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (empty($debts)): ?>
          <tr><td colspan="7" class="text-center text-muted">No debts found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
