
# Laravel Todo App

A simple Todo list application built using **Laravel** (PHP) for the backend and **Bootstrap + JavaScript** for the frontend.

---

## 🧰 Requirements

Before you begin, make sure you have the following installed:

- PHP >= 8.1
- Composer
- Node.js & NPM (for frontend asset compilation, optional)
- MySQL / PostgreSQL / SQLite (or your preferred database)
- Laravel CLI (`composer global require laravel/installer`)

---

## 🚀 Getting Started

Follow these steps to get the project running locally.

### 1. Clone the Repository

```bash
git clone https://github.com/yashbhargava6740/Laravel-Todo-Application.git
cd todo-laravel
```

---

### 2. Install PHP Dependencies

```bash
composer install
```

---

### 3. Set Up Environment File

Create your `.env` file by copying the example:

```bash
cp .env.example .env
```

Then open `.env` and update the following settings:

```dotenv
APP_NAME=LaravelTodo
APP_URL=http://localhost:8000
APP_KEY=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Create and Configure Your Database

Create a database named `todo_app` (or whatever you set in `.env`):

```sql
CREATE DATABASE todo_app;
```

Make sure your DB user has appropriate privileges.

---

### 6. Run Migrations

```bash
php artisan migrate
```

If your app includes seeders (optional), run them:

```bash
php artisan db:seed
```

---

### 7. Serve the Application

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) to view the app.

---

## 🔁 Frontend Changes (Optional)

If you're compiling frontend assets:

```bash
npm install
npm run dev
```

To watch for changes:

```bash
npm run watch
```

---

## 📁 API Endpoints

| Method | Endpoint         | Description              |
|--------|------------------|--------------------------|
| GET    | /getTodos        | Fetch all todos          |
| POST   | /createTodo      | Create a new todo        |
| PUT    | /updateTodo/{id} | Update a todo            |
| DELETE | /deleteTodo/{id} | Delete a todo by ID      |

---

## ✅ Features

- Create / View / Delete todos
- Toggle completion
- Filter by completed status
- Avatar image with fallback
- Relative timestamps
- Todos With Duplicate Title are not allowed
---

## 📦 Deployment Notes

- Ensure `.env` is correctly configured in production.
- Run `php artisan config:cache` and `php artisan route:cache` after deployment.
- Use `php artisan migrate --force` for production DB changes.

---

## 🤝 Contributing

Pull requests are welcome! For major changes, open an issue first to discuss what you'd like to change.

---

## 📄 License

[MIT](LICENSE)
