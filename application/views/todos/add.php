<?php $title = 'Add Todo'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">Add Todo</h3>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                                <div class="mb-3">
                                    <label class="form-label">Due Date</label>
                                    <input type="date" name="due_date" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Add</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="<?php echo site_url('todos'); ?>">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
