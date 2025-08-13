<?php $title = 'Notes'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>My Notes</h3>
      <a href="<?php echo site_url('notes/add'); ?>" class="btn btn-primary">Add Note</a>
    </div>
    <?php if (empty($notes)): ?>
      <div class="alert alert-info">No notes yet. Add your first one!</div>
    <?php else: ?>
      <div class="row g-3">
        <?php foreach ($notes as $note): ?>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title mb-2"><?php echo htmlspecialchars($note->title); ?></h5>
                <div class="card-text text-truncate" style="max-height:4.5em;overflow:hidden;">
                  <?php echo nl2br(htmlspecialchars(mb_substr($note->content,0,180))); ?>
                </div>
              </div>
              <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                <a href="<?php echo site_url('notes/view/'.$note->id); ?>" class="btn btn-sm btn-outline-primary">View</a>
                <div>
                  <a href="<?php echo site_url('notes/edit/'.$note->id); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                  <a href="<?php echo site_url('notes/delete/'.$note->id); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this note?');">Delete</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
