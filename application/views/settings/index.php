<?php $title = 'User Settings'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3 class="mb-4">User Settings</h3>
    <?php if (isset($success)): ?>
      <div class="alert alert-success">Preferences updated!</div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="theme" class="form-label">Theme</label>
        <select name="theme" id="theme" class="form-select">
          <?php foreach ($theme_files as $i => $name): ?>
            <option value="<?php echo $i; ?>"<?php if ($theme == $i) echo ' selected'; ?>><?php echo $name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Save Preferences</button>
    </form>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
