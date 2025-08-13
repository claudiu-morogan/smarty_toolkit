<?php $title = 'Dashboard'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <?php
        $unpaid_count = 0; $total_owed = 0;
        foreach ($debts as $d) { if (!$d->is_paid) { $unpaid_count++; $total_owed += $d->amount; } }
        $todo_count = count($todos);
        $todo_done = 0;
        foreach ($todos as $t) { if (!empty($t->is_done)) $todo_done++; }
        ?>
        <div class="row mb-3">
            <div class="col">
                <div class="alert alert-info mb-2">
                    <strong>To-Dos:</strong> <?php echo $todo_count; ?> total, <?php echo $todo_done; ?> done
                </div>
            </div>
            <div class="col">
                <div class="alert alert-warning mb-2">
                    <strong>Debts:</strong> <?php echo $unpaid_count; ?> unpaid, total owed: <b><?php echo number_format($total_owed,2); ?></b>
                </div>
            </div>
        </div>
        <?php if (!empty($reminders)): ?>
            <div class="alert alert-danger">
                <strong>Debt Reminders:</strong>
                <ul class="mb-0">
                    <?php foreach ($reminders as $rem): ?>
                        <li><?php echo htmlspecialchars($rem->debtor_name); ?> owes you <strong><?php echo number_format($rem->amount, 2); ?></strong> by <?php echo htmlspecialchars($rem->due_date); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>My To-Do List</h3>
            <a href="<?php echo site_url('todos/add'); ?>" class="btn btn-primary">Add New Todo</a>
        </div>
        <?php if (empty($todos)): ?>
            <div class="alert alert-info">No todos yet. Add your first one!</div>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($todos as $todo): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start <?php if ($todo->is_done) echo 'list-group-item-success'; ?>">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><?php echo htmlspecialchars($todo->title); ?>
                                <?php if ($todo->is_done): ?> <span class="badge bg-success ms-2">Done</span><?php endif; ?>
                            </div>
                            <div><?php echo nl2br(htmlspecialchars($todo->description)); ?></div>
                        </div>
                                                <div>
                                                        <a href="<?php echo site_url('todos/edit/'.$todo->id); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                                        <a href="<?php echo site_url('todos/delete/'.$todo->id); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this todo?');">Delete</a>
                                                        <?php if (empty($todo->is_done)): ?>
                                                            <form method="post" action="<?php echo site_url('dashboard/mark_done/'.$todo->id); ?>" style="display:inline;">
                                                                <input type="hidden" name="mark_done" value="1">
                                                                <button type="submit" class="btn btn-sm btn-success ms-1">Mark Completed</button>
                                                            </form>
                                                        <?php endif; ?>
                                                </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <hr class="my-5">
        <div class="mt-5">
            <h4>Who Owes Me Money</h4>
            <a href="<?php echo site_url('debts/add'); ?>" class="btn btn-primary btn-sm mb-3">Add Debt</a>
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
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
                        <tr><td colspan="6" class="text-center text-muted">No debts found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
