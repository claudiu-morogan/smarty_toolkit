<?php $this->load->view('header'); ?>
<div class="container py-4">
    <h2 class="text-warning mb-4">Add Habit</h2>
    <?php echo form_open('', ['class'=>'bg-white p-4 rounded shadow-sm']); ?>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Target (per period)</label>
            <input type="number" name="target" class="form-control" value="1" min="1">
        </div>
        <div class="mb-3">
            <label class="form-label">Period</label>
            <select name="period" class="form-select">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Save</button>
        <a href="<?= site_url('habits') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $this->load->view('footer'); ?>
