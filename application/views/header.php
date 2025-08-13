<?php $compact_mode = false; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($title) ? $title : 'To-Do App'; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/themes/_dropdown-fix.css'); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <?php
    $CI =& get_instance();
    $theme = $CI->session->userdata('theme');
    if (!$theme) {
      $theme = 4; // Set default to Theme 4: Purple Dream
      $CI->session->set_userdata('theme', $theme);
    }
  ?>
  <?php
    $theme_files = [
      1 => ['file' => 'blue-gradient.css', 'name' => 'Blue Gradient'],
      2 => ['file' => 'dark-mode.css', 'name' => 'Dark Mode'],
      3 => ['file' => 'green-pastel.css', 'name' => 'Green Pastel'],
      4 => ['file' => 'purple-dream.css', 'name' => 'Purple Dream'],
      5 => ['file' => 'sunset-orange.css', 'name' => 'Sunset Orange'],
      6 => ['file' => 'aqua-blue.css', 'name' => 'Aqua Blue'],
      7 => ['file' => 'pink-candy.css', 'name' => 'Pink Candy'],
      8 => ['file' => 'yellow-lemonade.css', 'name' => 'Yellow Lemonade'],
      9 => ['file' => 'teal-ocean.css', 'name' => 'Teal Ocean'],
      10 => ['file' => 'classic-white.css', 'name' => 'Classic White'],
    ];
    $theme_file = isset($theme_files[$theme]) ? $theme_files[$theme]['file'] : $theme_files[1]['file'];
  ?>
  <link rel="stylesheet" href="<?php echo base_url('assets/themes/' . $theme_file); ?>">
  <?php if ($compact_mode): ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/compact-mode.css'); ?>">
  <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<?php
  $compact_mode = false;
  if (isset($CI) && method_exists($CI, 'load') && $this->session->userdata('user_id')) {
    if (!isset($CI->User_model)) {
      $CI->load->model('User_model');
    }
    if (isset($CI->User_model)) {
      $prefs = $CI->User_model->get_preferences($this->session->userdata('user_id'));
      $compact_mode = !empty($prefs['compact_mode']);
    }
  }
?>
<body<?php if ($compact_mode) echo ' class="compact-mode"'; ?>>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo site_url('todos'); ?>">To-Do App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <?php if ($this->session->userdata('user_id')): ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('dashboard'); ?>">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('todos'); ?>">Todos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('todos/planner'); ?>">Planner</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('debts'); ?>">Debts</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('notes'); ?>">Notes</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('habits'); ?>">Habits</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('settings'); ?>">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/login'); ?>">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/register'); ?>">Register</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-xl">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
