<?php $title = 'Share Contact'; include APPPATH.'views/header.php'; ?>
<div class="container py-4">
    <h2>Share Contact: <?= htmlspecialchars($contact->name) ?></h2>
    <?php if (isset($success) && $success): ?>
        <div class="alert alert-success">Contact shared successfully!</div>
    <?php endif; ?>
    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?= form_open('contacts/share/' . $contact->id) ?>
        <div class="mb-3">
            <label for="shared_with" class="form-label">Share with (select users)</label>
            <select multiple class="form-select" id="shared_with" name="shared_with[]">
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user->id ?>" <?= (isset($shared_with) && in_array($user->id, $shared_with)) ? 'selected' : '' ?>><?= htmlspecialchars($user->username) ?> (<?= htmlspecialchars($user->email) ?>)</option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple users.</small>
        </div>
        <button type="submit" class="btn btn-primary">Share</button>
        <a href="<?= site_url('contacts') ?>" class="btn btn-secondary">Cancel</a>
    <?= form_close() ?>
</div>
<?php include APPPATH.'views/footer.php'; ?>
