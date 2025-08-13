<?php
$now = new DateTime();
$month = isset($_GET['month']) ? intval($_GET['month']) : intval($now->format('m'));
$year = isset($_GET['year']) ? intval($_GET['year']) : intval($now->format('Y'));
$title = 'Monthly Planner';
include APPPATH.'views/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-12">
    <?php
    // Calendar navigation logic
    $prevMonth = $month - 1;
    $prevYear = $year;
    if ($prevMonth < 1) { $prevMonth = 12; $prevYear--; }
    $nextMonth = $month + 1;
    $nextYear = $year;
    if ($nextMonth > 12) { $nextMonth = 1; $nextYear++; }
    ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
      <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>" class="btn btn-outline-secondary">&laquo; Prev</a>
      <h3 class="mb-0"><?php echo date('F Y', strtotime("$year-$month-01")); ?> Monthly Planner</h3>
      <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>" class="btn btn-outline-secondary">Next &raquo;</a>
    </div>
    <?php
    // Load Debt_model and get debts for this user
    $CI =& get_instance();
    $CI->load->model('Debt_model');
    $debts = $CI->Debt_model->get_all($CI->session->userdata('user_id'));
    // Get all todos for this user (already passed as $todos, but may need to reformat)
    $all_todos = [];
    foreach ($todos as $day => $day_todos) {
        foreach ($day_todos as $todo) {
            $all_todos[] = $todo;
        }
    }
    // Calendar calculations
    $now = new DateTime();
    $month = isset($_GET['month']) ? intval($_GET['month']) : intval($now->format('m'));
    $year = isset($_GET['year']) ? intval($_GET['year']) : intval($now->format('Y'));
    $firstOfMonth = new DateTime("$year-$month-01");
    $startDayOfWeek = intval($firstOfMonth->format('w')); // 0=Sun, 1=Mon, ...
    $daysInMonth = intval($firstOfMonth->format('t'));
    // Start from Monday (ISO-8601), so adjust if first day is not Monday
    $isoStart = $firstOfMonth->format('N'); // 1=Mon, 7=Sun
    $calendarStart = clone $firstOfMonth;
    if ($isoStart > 1) $calendarStart->modify('-'.($isoStart-1).' days');
    $weeks = [];
    $current = clone $calendarStart;
    for ($w = 0; $w < 6; $w++) {
        $week = [];
        for ($d = 0; $d < 7; $d++) {
            $dateStr = $current->format('Y-m-d');
            $week[] = [
                'date' => $dateStr,
                'is_current_month' => ($current->format('m') == $month),
                'todos' => [],
                'debts' => []
            ];
            $current->modify('+1 day');
        }
        $weeks[] = $week;
    }
    // Assign todos and debts to days
    foreach ($weeks as &$week) {
        foreach ($week as &$day) {
            foreach ($all_todos as $todo) {
                if ($todo->due_date == $day['date']) $day['todos'][] = $todo;
            }
            foreach ($debts as $debt) {
                if ($debt->due_date == $day['date']) $day['debts'][] = $debt;
            }
        }
    }
    unset($week, $day);
    ?>
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
                <div class="card mb-1 p-1 <?php if ($todo->is_done) echo 'bg-success text-white'; ?>">
                  <div class="fw-bold"><?php echo htmlspecialchars($todo->title); ?></div>
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
                <div class="card mb-1 p-1 border-danger">
                  <div class="fw-bold text-danger">Debt: <?php echo htmlspecialchars($debt->debtor_name); ?></div>
                  <div>Owes you <b><?php echo number_format($debt->amount,2); ?></b></div>
                  <div class="small">Due: <?php echo htmlspecialchars($debt->due_date); ?></div>
                  <div class="mt-1">
                    <a href="<?php echo site_url('debts/edit/'.$debt->id); ?>" class="btn btn-sm btn-outline-danger">View</a>
                    <?php if (!$debt->is_paid): ?>
                      <a href="<?php echo site_url('debts/mark_paid/'.$debt->id); ?>" class="btn btn-sm btn-success">Mark Paid</a>
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
    <div class="text-center mt-3">
      <a href="<?php echo site_url('todos'); ?>" class="btn btn-outline-primary">Back to List</a>
    </div>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
