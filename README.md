# 📚 Book Management System

A Laravel 10 application with **Breeze** scaffolding and **TailwindCSS** UI that allows users to manage a library of books with features such as CRUD, check-in/check-out, and search functionality.

---

## 🚀 Features

- 📖 Add, edit, and delete books
- 🔍 Search books by title or author
- 📥 Check-in (return) / 📤 Check-out (borrow) books
- ✅ Fully responsive UI using TailwindCSS
- 🔐 Authentication using Laravel Breeze

---

## 🧰 Tech Stack

- [Laravel 10](https://laravel.com/)
- [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#breeze)
- [Tailwind CSS](https://tailwindcss.com/)
- [Blade Templates](https://laravel.com/docs/10.x/blade)

---

## 📦 Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL or any supported database

---

## 🛠️ Installation

1. **Clone the repository**

```bash
git clone https://github.com/your-username/book-management.git
cd book-management
```

2. **Install Dependencies**

```bash
composer install
npm install
```

3. **Copy and configure `.env`**

```bash
cp .env.example .env
php artisan key:generate
```

Edit .env and set your database credentials:

```bash
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=your_password
```

Edit .env and set your openai api key

```bash
OPENAI_API_KEY=your-open-api-key
```

4. Run Migrations

```bash
php artisan migrate
```

5. Compile Frontend Assets

```bash
npm run dev
```

6. Start the development server

```bash
php artisan serve
```

Visit http://localhost:8000 in your browser.
