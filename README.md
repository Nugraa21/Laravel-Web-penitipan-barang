# Laravel Bag Deposit System

A professional, multi-language web application built with Laravel 9 for managing item deposits, tracking lockers, and generating digital receipts. Designed with a clean SaaS aesthetic and optimized for high-performance inventory management.

---

## [ Features ]

- **Multi-Language Support**: Seamlessly switch between **English**, **Indonesian**, and **Japanese**.
- **Role-Based Access Control (RBAC)**:
    - **Super Admin**: Full control over system settings, core configurations, and detailed audit logs.
    - **Admin (Cashier)**: Manage user accounts, verify item deposits, and process retrievals.
    - **User (Customer)**: Register items, track deposit status, and access digital receipts.
- **Item Lifecycle Management**: Complete tracking from "Pending" to "Stored" and finally "Retrieved".
- **Visual Verification**: Support for multiple photo uploads per item for condition verification.
- **Digital Receipts**: Auto-generated tokens and QR codes for quick scanning during item retrieval.
- **Audit & Activity Logs**:
    - **Item History**: Track every status change and edit made to an item.
    - **User Activity Logs**: Security tracking for logins, account updates, and administrative actions (IP & User Agent included).
- **Modern UI/UX**: Premium light theme design with a focus on usability and responsive layouts.

---

## [ Tech Stack ]

- **Backend**: PHP 8.0+ | Laravel 9 | MySQL
- **Frontend**: TailwindCSS | Alpine.js | Blade Templates
- **Builders**: Vite | PostCSS
- **Admin Theme**: AdminLTE (Integrated for Super Admin Panel)
- **Security**: Laravel Breeze (Authentication), CSRF Protection, and Role-based Middleware.

---

## [ Installation ]

### Prerequisites
- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL

### Steps
1. **Clone the repository**:
   ```bash
   git clone https://github.com/Nugraa21/Laravel-Web-penitipan-barang.git
   cd Laravel-Web-penitipan-barang
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Update your database credentials and `APP_URL` in `.env`.*

4. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate --seed
   ```

5. **Symlink Storage**:
   ```bash
   php artisan storage:link
   ```

6. **Compile Assets**:
   ```bash
   npm run dev
   # OR for production
   npm run build
   ```

7. **Serve the Application**:
   ```bash
   php artisan serve
   ```

---

## [ Project Structure ]

```text
├── app/
│   ├── Http/Controllers/      # Logic for Items, Profiles, and Admin flows
│   ├── Models/                # Eloquent entities (Item, User, UserLog, etc.)
│   └── Providers/             # Service providers
├── database/
│   ├── migrations/            # DB Schema (Items, Logs, Settings)
│   └── seeders/               # Initial data for Super Admin
├── lang/                      # Translation files (en.json, id.json, ja.json)
├── resources/
│   ├── views/                 # Blade templates (Dashboard, Items, SuperAdmin)
│   └── css/js/                # Vite assets
└── public/                    # Compiled assets & storage symlink
```

---

## [ Screenshots ]

> [!NOTE]
> You can add your own screenshots by placing them in the `screenshots/` directory and updating the links below.

| Dashboard Overview | Item Details | Admin Panel |
| :--- | :--- | :--- |
| ![Dashboard](screenshots/dashboard.png) | ![Item Details](screenshots/item_details.png) | ![Admin](screenshots/admin_panel.png) |

---

## [ License ]

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## [ Contact ]

Created by [Nugra21](https://github.com/Nugraa21)
