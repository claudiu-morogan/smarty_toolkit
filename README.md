
# Smarty Toolkit

A modular CodeIgniter 3 productivity toolkit featuring a to-do app, debts tracker, monthly planner, authentication, and a modern theme system.

## Features
- User registration & login (authentication)
- CRUD for to-dos with due dates and completion status
- Debts module: track who owes you money, with reminders and payment status
- Dashboard: see all your todos, debts, and reminders in one place
- Monthly planner calendar: view todos and debts by date, with navigation and quick actions
- 10 modern, switchable color themes (see `assets/themes/`)
- Clean URLs (no index.php)
- Responsive Bootstrap 5 UI

## Installation
1. Clone this repository:
	```
	git clone https://github.com/claudiu-morogan/smarty_toolkit.git
	```
2. Place the folder in your XAMPP/htdocs directory.
3. Create a MySQL database named `tools`.
4. Configure your database settings in `application/config/database.php`.
5. Run migrations:
	- In your browser: `http://localhost/smarty_toolkit/migrate`
	- Or via CLI: `php index.php migrate`
6. Ensure `assets/themes/` is accessible by the web server.
7. Start XAMPP/Apache and go to `http://localhost/smarty_toolkit`.

## Usage
- **Dashboard**: See an overview of your todos, debts, and reminders (`/dashboard`)
- **Todos**: Add, edit, or delete to-dos with due dates and mark as done (`/todos`)
- **Debts**: Track who owes you money, set due dates, mark as paid, and get reminders (`/debts`)
- **Planner**: View all your todos and debts in a monthly calendar, with navigation and quick actions (`/todos/planner`)
- **Themes**: Instantly switch between 10 color themes using the Theme dropdown in the navbar

## Theme Customization
Edit or add CSS files in `assets/themes/` and use the theme dropdown in the navbar to select your preferred look.

## Navigation
- Dashboard
- Todos
- Planner
- Debts
- Theme switcher
- Logout/Login/Register

## Database Migrations
Migrations are provided for users, todos, and debts. Run all migrations before first use.

## License
MIT
