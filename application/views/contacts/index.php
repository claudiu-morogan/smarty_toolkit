<?php $title = 'Contacts'; include APPPATH.'views/header.php'; ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Contacts</h2>
        <a href="<?= site_url('contacts/add') ?>" class="btn btn-primary">Add Contact</a>
    </div>
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Shared</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= htmlspecialchars($contact->name) ?></td>
                <td><?= htmlspecialchars($contact->email) ?></td>
                <td><?= htmlspecialchars($contact->phone) ?></td>
                <td><?= $contact->is_shared ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="<?= site_url('contacts/edit/' . $contact->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= site_url('contacts/delete/' . $contact->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this contact?')">Delete</a>
                    <?php if (!$contact->is_shared): ?>
                        <a href="<?= site_url('contacts/share/' . $contact->id) ?>" class="btn btn-sm btn-info">Share</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include APPPATH.'views/footer.php'; ?>
