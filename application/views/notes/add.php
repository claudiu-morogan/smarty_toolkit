<?php $title = 'Add Note'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3 class="mb-4">Add Note</h3>
    <form method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control" rows="7" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save Note</button>
      <a href="<?php echo site_url('notes'); ?>" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
