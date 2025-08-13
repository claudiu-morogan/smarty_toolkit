<?php $title = 'Register'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">Register</h3>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="<?php echo site_url('auth/login'); ?>">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
