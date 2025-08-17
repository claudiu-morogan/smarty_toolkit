<?php
// This partial expects $weeks (calendar data), $month, $year, $all_todos, $debts to be set by the parent view.
$today = date('Y-m-d');
?>
<style>
.calendar-overdue {
  background: #fff3cd !important;
  color: #856404 !important;
}
.calendar-overdue .btn,
.calendar-overdue a,
.calendar-overdue .fw-bold {
  color: #856404 !important;
  border-color: #ffeeba !important;
}
</style>
<div class="table-responsive">
<table class="table table-bordered text-center align-middle">
  <thead class="table-light">
    <tr>
      <th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($weeks as $week): ?>
    <tr>
      <?php foreach ($week as $day): ?>
        <td style="min-width:160px;<?php if (!$day['is_current_month']) echo 'background:#f8f9fa;color:#bbb;'; ?>">
          <div class="fw-bold mb-1"><?php echo date('j', strtotime($day['date'])); ?></div>
          <?php foreach ($day['todos'] as $todo): ?>
            <?php
              $is_overdue = empty($todo->is_done) && $todo->due_date && $todo->due_date < $today;
            ?>
            <div class="card mb-1 p-1 <?php if ($todo->is_done) echo 'bg-success text-white'; else if ($is_overdue) echo 'calendar-overdue'; ?>">
              <div class="fw-bold">
                <?php if ($is_overdue): ?><i class="bi bi-exclamation-triangle-fill me-1"></i><?php endif; ?>
                <?php echo htmlspecialchars($todo->title); ?>
              </div>
              <div class="small">Due: <?php echo htmlspecialchars($todo->due_date); ?></div>
              <div class="mt-1">
                <a href="<?php echo site_url('todos/edit/'.$todo->id); ?>" class="btn btn-sm btn-outline-primary">View</a>
                <?php if (empty($todo->is_done)): ?>
                  <a href="<?php echo site_url('todos/edit/'.$todo->id); ?>" class="btn btn-sm btn-success" onclick="event.preventDefault(); document.getElementById('mark-done-<?php echo $todo->id; ?>').submit();">Mark Done</a>
                  <form id="mark-done-<?php echo $todo->id; ?>" action="<?php echo site_url('todos/edit/'.$todo->id); ?>" method="post" style="display:none;">
                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($todo->title, ENT_QUOTES); ?>">
                    <input type="hidden" name="description" value="<?php echo htmlspecialchars($todo->description, ENT_QUOTES); ?>">
                    <input type="hidden" name="due_date" value="<?php echo htmlspecialchars($todo->due_date, ENT_QUOTES); ?>">
                    <input type="hidden" name="is_done" value="1">
                  </form>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
          <?php foreach ($day['debts'] as $debt): ?>
            <?php
              $is_overdue = !$debt->is_paid && $debt->due_date && $debt->due_date < $today;
            ?>
            <div class="card mb-1 p-1 border-danger <?php if ($is_overdue) echo 'calendar-overdue'; ?>">
              <div class="fw-bold text-danger">
                <?php if ($is_overdue): ?><i class="bi bi-exclamation-triangle-fill me-1"></i><?php endif; ?>
                Debt: <?php echo htmlspecialchars($debt->debtor_name); ?>
              </div>
              <div>Owes you <b><?php echo number_format($debt->amount,2); ?></b></div>
              <div class="small">Due: <?php echo htmlspecialchars($debt->due_date); ?></div>
              <div class="mt-1">
                <a href="<?php echo site_url('debts/edit/'.$debt->id); ?>" class="btn btn-sm btn-outline-danger">View</a>
                <?php if (!$debt->is_paid): ?>
                  <a href="<?php echo site_url('debts/mark_paid/'.$debt->id); ?>" class="btn btn-sm btn-outline-warning">Mark Paid</a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
          <?php if (empty($day['todos']) && empty($day['debts'])): ?>
            <span class="text-muted">&nbsp;</span>
          <?php endif; ?>
        </td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
