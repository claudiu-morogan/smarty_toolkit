# Smarty Toolkit

A simple CodeIgniter 3 to-do app with authentication, weekly planner, and theme switcher.

## Features
- User registration & login
- CRUD for to-dos with due dates
- Weekly planner calendar view
- 10 modern, switchable themes
- Clean URLs (no index.php)


## Installation
1. Clone this repository:
	```
	git clone https://github.com/claudiu-morogan/smarty_toolkit.git
	```
2. Place the folder in your XAMPP/htdocs directory.
3. Create a MySQL database named `tools`.
4. Configure your database settings in `application/config/database.php`.
5. Run migrations by visiting `/smarty_toolkit/migrate` in your browser.
6. Ensure `assets/themes/` is accessible by the web server.
7. Start XAMPP/Apache and go to `http://localhost/smarty_toolkit`.

## Usage
- Register a new user or log in.
- Add, edit, or delete to-dos with optional due dates.
- View your tasks in a weekly planner (calendar) format.
- Use the Theme dropdown in the navbar to instantly switch between 10 color themes.

## Theme Customization
Edit or add CSS files in `assets/themes/` and use the theme dropdown in the navbar.

## Theme Customization
Edit or add CSS files in `assets/themes/` and use the theme dropdown in the navbar.
