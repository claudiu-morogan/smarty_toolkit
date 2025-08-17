

<?php $title = 'Dashboard'; include APPPATH.'views/header.php'; ?>
<style>
.spinner-overlay {
    position: fixed;
    top: 0; left: 0; width: 100vw; height: 100vh;
    background: rgba(255,255,255,0.7);
    z-index: 9999;
    display: flex; align-items: center; justify-content: center;
}
</style>
<div id="dashboard-spinner" class="spinner-overlay">
    <div class="spinner-border text-primary" style="width:3rem;height:3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<script>
window.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.getElementById('dashboard-spinner').style.display = 'none';
    }, 500); // Simulate load, remove spinner after 0.5s
});
</script>
<div class="container py-4">
    <?php if (!empty($dashboard_cards['calendar'])): ?>
    <div class="mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="bi bi-calendar-event me-2"></i>Calendar</span>
                <a href="<?php echo site_url('todos/planner'); ?>" class="btn btn-sm btn-outline-dark">Full View</a>
            </div>
            <div class="card-body p-2">
                <?php $embedded = true; include APPPATH.'views/todos/planner.php'; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row g-4">
        <!-- Todos Card -->
        <?php if (!empty($dashboard_cards['todos'])): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">To-Dos</h5>
                    <p class="card-text">
                        <strong><?php echo count($todos); ?></strong> total<br>
                        <?php $done = 0; foreach ($todos as $t) { if (!empty($t->is_done)) $done++; } ?>
                        <strong><?php echo $done; ?></strong> completed
                    </p>
                    <a href="<?php echo site_url('todos'); ?>" class="btn btn-primary btn-sm">View Todos</a>
                    <a href="<?php echo site_url('todos/add'); ?>" class="btn btn-outline-primary btn-sm">Add</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- Debts Card -->
        <?php if (!empty($dashboard_cards['debts'])): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Debts</h5>
                    <?php $unpaid = 0; $total_owed = 0; foreach ($debts as $d) { if (!$d->is_paid) { $unpaid++; $total_owed += $d->amount; } } ?>
                    <p class="card-text">
                        <strong><?php echo $unpaid; ?></strong> unpaid<br>
                        <strong><?php echo number_format($total_owed,2); ?></strong> owed
                    </p>
                    <a href="<?php echo site_url('debts'); ?>" class="btn btn-secondary btn-sm">View Debts</a>
                    <a href="<?php echo site_url('debts/add'); ?>" class="btn btn-outline-secondary btn-sm">Add</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- Notes Card -->
        <?php if (!empty($dashboard_cards['notes'])): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Notes</h5>
                    <?php $notes_count = isset($notes) ? count($notes) : 0; ?>
                    <p class="card-text">
                        <strong><?php echo $notes_count; ?></strong> notes
                    </p>
                    <a href="<?php echo site_url('notes'); ?>" class="btn btn-info btn-sm">View Notes</a>
                    <a href="<?php echo site_url('notes/add'); ?>" class="btn btn-outline-info btn-sm">Add</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- Habits Card -->
        <?php if (!empty($dashboard_cards['habits'])): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Habits & Goals</h5>
                    <?php $habits_count = isset($habits) ? count($habits) : 0; ?>
                    <p class="card-text">
                        <strong><?php echo $habits_count; ?></strong> habits
                    </p>
                    <a href="<?php echo site_url('habits'); ?>" class="btn btn-warning btn-sm">View Habits</a>
                    <a href="<?php echo site_url('habits/add'); ?>" class="btn btn-outline-warning btn-sm">Add</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- Contacts Card -->
        <?php if (!empty($dashboard_cards['contacts'])): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Contacts</h5>
                    <?php $contacts_count = isset($contacts) ? count($contacts) : 0; ?>
                    <p class="card-text">
                        <strong><?php echo $contacts_count; ?></strong> contacts
                    </p>
                    <a href="<?php echo site_url('contacts'); ?>" class="btn btn-success btn-sm">View Contacts</a>
                    <a href="<?php echo site_url('contacts/add'); ?>" class="btn btn-outline-success btn-sm">Add</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Reminders Section -->
    <div class="row mt-4">
        <div class="col-md-12">
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
        </div>
    </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
