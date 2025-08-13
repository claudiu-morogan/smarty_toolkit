<?php $title = 'My Todos'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
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
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
