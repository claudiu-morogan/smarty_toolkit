<?php $title = 'Edit Contact'; include APPPATH.'views/header.php'; ?>
<div class="container py-4">
    <h2>Edit Contact</h2>
    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?= form_open('contacts/edit/' . $contact->id) ?>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required maxlength="255" value="<?= set_value('name', $contact->name) ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" maxlength="255" value="<?= set_value('email', $contact->email) ?>">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" maxlength="50" value="<?= set_value('phone', $contact->phone) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= site_url('contacts') ?>" class="btn btn-secondary">Cancel</a>
    <?= form_close() ?>
</div>
<?php include APPPATH.'views/footer.php'; ?>
