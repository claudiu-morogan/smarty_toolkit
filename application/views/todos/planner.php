<?php $title = 'Weekly Planner'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-10">
    <h3 class="mb-4">Weekly Planner</h3>
    <table class="table table-bordered text-center align-middle">
      <thead class="table-light">
        <tr>
          <?php
          $start = new DateTime('monday this week');
          for ($i = 0; $i < 7; $i++) {
              echo '<th>' . $start->format('l') . '<br>' . $start->format('Y-m-d') . '</th>';
              $start->modify('+1 day');
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
        <?php
        $start = new DateTime('monday this week');
        for ($i = 0; $i < 7; $i++) {
            $day = $start->format('Y-m-d');
            echo '<td style="min-width:180px;">';
            if (!empty($todos[$day])) {
                foreach ($todos[$day] as $todo) {
                    echo '<div class="card mb-2 p-2 '.($todo->is_done ? 'bg-success text-white' : '').'">';
                    echo '<div class="fw-bold">'.htmlspecialchars($todo->title).'</div>';
                    echo '<div>'.nl2br(htmlspecialchars($todo->description)).'</div>';
                    echo '<div class="small">Due: '.htmlspecialchars($todo->due_date).'</div>';
                    echo '<a href="'.site_url('todos/edit/'.$todo->id).'" class="btn btn-sm btn-light mt-1">Edit</a> ';
                    echo '<a href="'.site_url('todos/delete/'.$todo->id).'" class="btn btn-sm btn-danger mt-1" onclick="return confirm(\'Delete this todo?\');">Delete</a>';
                    echo '</div>';
                }
            } else {
                echo '<span class="text-muted">No todos</span>';
            }
            echo '</td>';
            $start->modify('+1 day');
        }
        ?>
        </tr>
      </tbody>
    </table>
    <div class="text-center mt-3">
      <a href="<?php echo site_url('todos'); ?>" class="btn btn-outline-primary">Back to List</a>
    </div>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
