<?php $title = 'View Note'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h3 class="card-title mb-3"><?php echo htmlspecialchars($note->title); ?></h3>
        <div class="card-text" style="white-space:pre-line;">
          <?php echo htmlspecialchars($note->content); ?>
        </div>
      </div>
      <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
        <a href="<?php echo site_url('notes/edit/'.$note->id); ?>" class="btn btn-outline-secondary">Edit</a>
        <a href="<?php echo site_url('notes'); ?>" class="btn btn-outline-primary">Back to Notes</a>
      </div>
    </div>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
