# Archive Library Management System

A clean, modern library cataloging system built with **PHP**, **MySQL**, and **Bootstrap 5**. It focuses on secure CRUD operations, a professional UI, and consistent theming (light/dark) suitable for production-ready demos or portfolios.

## ✨ Features

- **Modern UI + Typography**: Professional styling with consistent spacing, clean typography, and balanced color contrast.
- **Light / Dark Mode**: One-click theme toggle with persistent preference.
- **Secure CRUD**: MySQLi prepared statements to prevent SQL injection.
- **Live Search**: Instant filtering of titles/authors on the main table.
- **Stats Overview**: Total entries and collection value at a glance.
- **Responsive Layout**: Optimized for mobile, tablet, and desktop.
- **User Feedback**: SweetAlert2 confirmations and success/error messaging.

## 🧰 Tech Stack

- **PHP 8.x**
- **MySQL**
- **Bootstrap 5.3**
- **JavaScript (ES6+)**
- **SweetAlert2**
- **Google Fonts**: Manrope + Sora
- **Bootstrap Icons**

## 🚀 Getting Started

1. **Requirements**: Install XAMPP, WAMP, or Laragon.
2. **Clone** this repository into your `htdocs` or `www` folder.
3. **Database Setup**:
   - Open phpMyAdmin.
   - Create a database named `library_management`.
   - Import `db/books.sql`.
4. **Configure DB**:
   - Copy `db_connect.example.php` to `db_connect.php`.
   - Update host/user/password settings as needed.
5. **Run**:
   - Go to `http://localhost/library_management/view_books.php`.

## 📁 Project Structure

```text
├── db/                # Database schema
├── includes/          # Shared header/footer
├── add_book.php       # Add new record
├── delete.php         # Delete record
├── edit.php           # Edit record
├── insert.php         # Insert handler
├── update.php         # Update handler
├── view_books.php     # Dashboard + table + search
├── db_connect.php     # Database connection
└── style.css          # Theme and UI styling
```

## 🖥️ Screens

- **Home / View Books**: Dashboard, search, and table actions
- **Add Book**: Clean form with validation
- **Edit Book**: Live preview and update workflow

## ✅ Notes

- The theme toggle stores preference in `localStorage`.
- All UI styles are centralized in `style.css` for easy customization.

---
**Author:** Bakhtawar1910
