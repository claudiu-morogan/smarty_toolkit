<?php $title = 'User Settings'; include APPPATH.'views/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3 class="mb-4">User Settings</h3>
    <?php if (isset($success)): ?>
      <div class="alert alert-success">Preferences updated!</div>
    <?php endif; ?>
  <?php echo form_open(); ?>
      <div class="mb-3">
        <label for="theme" class="form-label">Theme</label>
        <select name="theme" id="theme" class="form-select">
          <?php foreach ($theme_files as $i => $name): ?>
            <option value="<?php echo $i; ?>"<?php if ($theme == $i) echo ' selected'; ?>><?php echo is_array($name) ? (isset($name['name']) ? $name['name'] : reset($name)) : $name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="start_page" class="form-label">Default Start Page</label>
        <select name="start_page" id="start_page" class="form-select">
          <option value="dashboard"<?php if (isset($start_page) && $start_page == 'dashboard') echo ' selected'; ?>>Dashboard</option>
          <option value="todos"<?php if (isset($start_page) && $start_page == 'todos') echo ' selected'; ?>>Todos</option>
          <option value="planner"<?php if (isset($start_page) && $start_page == 'planner') echo ' selected'; ?>>Planner</option>
          <option value="debts"<?php if (isset($start_page) && $start_page == 'debts') echo ' selected'; ?>>Debts</option>
        </select>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="compact_mode" id="compact_mode" value="1"<?php if (!empty($compact_mode)) echo ' checked'; ?>>
        <label class="form-check-label" for="compact_mode">Enable Compact Mode</label>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="show_completed" id="show_completed" value="1"<?php if (!empty($show_completed)) echo ' checked'; ?>>
        <label class="form-check-label" for="show_completed">Show Completed Todos</label>
      </div>
      <div class="mb-3">
        <label for="language" class="form-label">Language</label>
        <select name="language" id="language" class="form-select">
          <option value="en"<?php if (empty($language) || $language == 'en') echo ' selected'; ?>>English</option>
          <option value="es"<?php if (isset($language) && $language == 'es') echo ' selected'; ?>>Español</option>
          <option value="fr"<?php if (isset($language) && $language == 'fr') echo ' selected'; ?>>Français</option>
          <option value="de"<?php if (isset($language) && $language == 'de') echo ' selected'; ?>>Deutsch</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Dashboard Modules</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="dashboard_cards[todos]" id="card_todos" value="1"<?php if (empty($dashboard_cards) || !isset($dashboard_cards['todos']) || $dashboard_cards['todos']) echo ' checked'; ?>>
          <label class="form-check-label" for="card_todos">To-Dos</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="dashboard_cards[debts]" id="card_debts" value="1"<?php if (empty($dashboard_cards) || !isset($dashboard_cards['debts']) || $dashboard_cards['debts']) echo ' checked'; ?>>
          <label class="form-check-label" for="card_debts">Debts</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="dashboard_cards[notes]" id="card_notes" value="1"<?php if (empty($dashboard_cards) || !isset($dashboard_cards['notes']) || $dashboard_cards['notes']) echo ' checked'; ?>>
          <label class="form-check-label" for="card_notes">Notes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="dashboard_cards[habits]" id="card_habits" value="1"<?php if (empty($dashboard_cards) || !isset($dashboard_cards['habits']) || $dashboard_cards['habits']) echo ' checked'; ?>>
          <label class="form-check-label" for="card_habits">Habits & Goals</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="dashboard_cards[calendar]" id="card_calendar" value="1"<?php if (empty($dashboard_cards) || !isset($dashboard_cards['calendar']) || $dashboard_cards['calendar']) echo ' checked'; ?>>
          <label class="form-check-label" for="card_calendar">Calendar</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save Preferences</button>
  </form>
  </div>
</div>
<?php include APPPATH.'views/footer.php'; ?>
