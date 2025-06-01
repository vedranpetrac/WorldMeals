# WorldMeals

🌍 **WorldMeals** is a Laravel API boilerplate designed to kickstart your next backend project with a clean, scalable structure and built-in localization support. Whether you're building a RESTful API for a web app, mobile app, or microservice, this starter kit provides the essentials to get you up and running quickly.

## ✨ Features

- **Laravel API Structure**: Organized and modular codebase following Laravel best practices.
- **Localization Support**: Easily manage multiple languages using Laravel's localization features.
- **RESTful API Ready**: Pre-configured routes and controllers for building RESTful APIs.
- **Authentication**: Ready to integrate with Laravel's authentication systems.
- **Environment Configuration**: `.env` setup for managing environment-specific settings.

## 🛠️ Technologies Used

- **Laravel**: PHP framework for web artisans.
- **PHP**: Server-side scripting language.
- **Composer**: Dependency management.
- **MySQL**: Relational database management system (or your preferred DB).

## 📂 Project Structure

- `app/`: Application core files
- `bootstrap/`: Application bootstrapping
- `config/`: Configuration files
- `database/`: Migrations and seeders
- `lang/`: Localization files
- `public/`: Publicly accessible files
- `resources/`: Views and raw assets
- `routes/`: Route definitions
- `storage/`: Compiled templates, caches, and logs
- `tests/`: Automated tests
- `.env.example`: Example environment configuration
- `composer.json`: Composer dependencies
- `README.md`: This file

## 🚀 Getting Started

```bash
# 1. Clone the Repository
git clone https://github.com/vedranpetrac/WorldMeals.git
cd WorldMeals

# 2. Install Dependencies
composer install

# 3. Copy .env and Generate App Key
cp .env.example .env
php artisan key:generate

# 4. Configure Your Database in the .env File

# 5. Run Migrations
php artisan migrate

# 6. Serve the Application
php artisan serve
