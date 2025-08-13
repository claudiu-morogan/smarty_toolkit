<?php $this->load->view('header'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-warning">Habits & Goals</h2>
        <a href="<?= site_url('habits/add') ?>" class="btn btn-warning">Add Habit</a>
    </div>
    <?php if (empty($habits)): ?>
        <div class="alert alert-info">No habits yet. Start by adding one!</div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-warning">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Target</th>
                    <th>Period</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($habits as $habit): ?>
                <tr>
                    <td><?= htmlspecialchars($habit->name) ?></td>
                    <td><?= htmlspecialchars($habit->description) ?></td>
                    <td><?= htmlspecialchars($habit->target) ?></td>
                    <td><?= htmlspecialchars(ucfirst($habit->period)) ?></td>
                    <td>
                        <a href="<?= site_url('habits/view/'.$habit->id) ?>" class="btn btn-sm btn-outline-warning">View</a>
                        <a href="<?= site_url('habits/edit/'.$habit->id) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="<?= site_url('habits/delete/'.$habit->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this habit?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php $this->load->view('footer'); ?>
