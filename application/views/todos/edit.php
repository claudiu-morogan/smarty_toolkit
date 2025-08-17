<?php $title = 'Edit Todo'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">Edit Todo</h3>
                <?php echo form_open(); ?>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($todo->title); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"><?php echo htmlspecialchars($todo->description); ?></textarea>
                    </div>
                                <div class="mb-3">
                                    <label class="form-label">Due Date</label>
                                    <input type="date" name="due_date" class="form-control" value="<?php echo htmlspecialchars($todo->due_date); ?>">
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="is_done" value="1" id="is_done" <?php if ($todo->is_done) echo 'checked'; ?>>
                                    <label class="form-check-label" for="is_done">Done</label>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Save</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="<?php echo site_url('todos'); ?>">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
