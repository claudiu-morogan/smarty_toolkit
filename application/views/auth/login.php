<?php $title = 'Login'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">Login</h3>
                <?php echo form_open(); ?>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="<?php echo site_url('auth/register'); ?>">Don't have an account? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
