<?php $this->load->view('header'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-warning mb-0">Habit: <?= htmlspecialchars($habit->name) ?></h2>
        <a href="<?= site_url('habits') ?>" class="btn btn-secondary">Back</a>
    </div>
    <div class="mb-3">
        <strong>Description:</strong> <?= nl2br(htmlspecialchars($habit->description)) ?><br>
        <strong>Target:</strong> <?= htmlspecialchars($habit->target) ?> per <?= htmlspecialchars($habit->period) ?>
    </div>
    <form method="post" action="<?= site_url('habits/complete/'.$habit->id) ?>">
        <button type="submit" class="btn btn-success mb-3">Mark as Completed for Today</button>
    </form>
    <h5 class="mt-4">Completions</h5>
    <?php if (empty($completions)): ?>
        <div class="alert alert-info">No completions yet.</div>
    <?php else: ?>
    <ul class="list-group mb-4">
        <?php foreach ($completions as $c): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($c->date) ?>
                <span class="badge bg-warning text-dark">x<?= $c->count ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <a href="<?= site_url('habits/edit/'.$habit->id) ?>" class="btn btn-outline-secondary">Edit</a>
    <a href="<?= site_url('habits/delete/'.$habit->id) ?>" class="btn btn-outline-danger" onclick="return confirm('Delete this habit?')">Delete</a>
</div>
<?php $this->load->view('footer'); ?>
