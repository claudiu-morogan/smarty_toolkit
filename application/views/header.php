<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($title) ? $title : 'To-Do App'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
      <div class="container">
        <a class="navbar-brand" href="<?php echo site_url('todos'); ?>">To-Do App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <?php if ($this->session->userdata('user_id')): ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo site_url('todos'); ?>">My Todos</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo site_url('todos/planner'); ?>">Weekly Planner</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/login'); ?>">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/register'); ?>">Register</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
<div class="container">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
