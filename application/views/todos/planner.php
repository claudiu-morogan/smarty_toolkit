<?php
$now = new DateTime();
$month = isset($_GET['month']) ? intval($_GET['month']) : intval($now->format('m'));
$year = isset($_GET['year']) ? intval($_GET['year']) : intval($now->format('Y'));
// Only include header/footer if not embedded (standalone view)
if (!isset($embedded) || !$embedded) {
  $title = 'Monthly Planner';
  include APPPATH.'views/header.php';
}
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
  // Normalize $todos: if it's a flat array, group by due_date
  $all_todos = [];
  if (!empty($todos)) {
    $first = reset($todos);
    if (is_object($first) && property_exists($first, 'due_date')) {
      // Flat array, group by due_date
      foreach ($todos as $todo) {
        if (!empty($todo->due_date)) {
          $all_todos[] = $todo;
        }
      }
    } else {
      // Already grouped by date
      foreach ($todos as $day => $day_todos) {
        foreach ($day_todos as $todo) {
          $all_todos[] = $todo;
        }
      }
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
  <?php include APPPATH.'views/todos/calendar_table.php'; ?>
    <?php if (!isset($embedded) || !$embedded): ?>
    <div class="text-center mt-3">
      <a href="<?php echo site_url('todos'); ?>" class="btn btn-outline-primary">Back to List</a>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php
if (!isset($embedded) || !$embedded) {
  include APPPATH.'views/footer.php';
}
?>
