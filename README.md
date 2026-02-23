<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  
  <h1 align="center">KoKerU - Sistem Penitipan Barang Digital</h1>
  <p align="center">
    A Modern, Multi-Language Web Application for Digital Luggage Storage Management.
    <br />
    <a href="#-getting-started-installation-guide"><strong>Explore the docs »</strong></a>
    <br />
  </p>
</div>

<!-- BADGES -->
<div align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine JS">
</div>

---

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/circle-info.svg" width="20" height="20"> About The Project

**LokerKu** (PenitipanApp) is a comprehensive, enterprise-grade luggage and item storage management system built with **Laravel 9**. It aims to digitalize the traditional cloakroom/luggage deposit process by introducing QR code receipts, multi-language support, real-time activity tracking, and dynamic configuration via a Super Admin panel.

Designed with a premium Light Theme aesthetic, the application provides an excellent user experience (UI/UX) for both customers and administrators.

### Key Highlights
- <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/language.svg" width="16" height="16"> **Multi-Language Support**: Fully localized in English, Indonesian (Default), and Japanese.
- <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/qrcode.svg" width="16" height="16"> **Digital QR Receipts**: Auto-generated digital tickets for fast retrieval.
- <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/shield-halved.svg" width="16" height="16"> **Role-Based Access Control**: Granular permissions (Super Admin, Admin/Cashier, User/Customer).
- <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/chart-line.svg" width="16" height="16"> **Dynamic Settings CMS**: Configure UI texts, pricing, FAQs, and social links instantly from the dashboard.
- <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/receipt.svg" width="16" height="16"> **Thermal Print Ready**: Receipts are styled to print perfectly on 80mm thermal printers.
- <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/clock-rotate-left.svg" width="16" height="16"> **Comprehensive Audit Logs**: Automated logging for every item movement and user action.

---

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/layer-group.svg" width="20" height="20"> Built With (Tech Stack)

The application utilizes the following modern toolset:

### Backend
- **Framework**: <img src="https://img.shields.io/badge/-Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white"> Laravel 9.5
- **Language**: <img src="https://img.shields.io/badge/-PHP-777BB4?style=flat-square&logo=php&logoColor=white"> PHP 8.0+
- **Database**: <img src="https://img.shields.io/badge/-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white"> MySQL (Relational Database)
- **Security**: Laravel Breeze, CSRF Tokens, AES-256 (where applicable)

### Frontend
- **CSS Framework**: <img src="https://img.shields.io/badge/-TailwindCSS-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white"> Tailwind CSS
- **Interactivity**: <img src="https://img.shields.io/badge/-Alpine.js-8BC0D0?style=flat-square&logo=alpine.js&logoColor=white"> Alpine.js
- **Templating**: <img src="https://img.shields.io/badge/-Blade-FF2D20?style=flat-square&logo=laravel&logoColor=white"> Laravel Blade
- **SuperAdmin Theme**: <img src="https://img.shields.io/badge/-AdminLTE-343A40?style=flat-square&logo=bootstrap&logoColor=white"> AdminLTE 3 (via jeroennoten/laravel-adminlte)

### Tooling
- **Build Tool**: <img src="https://img.shields.io/badge/-Vite-646CFF?style=flat-square&logo=vite&logoColor=white"> Vite
- **Package Manager**: NPM & Composer

---

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/database.svg" width="20" height="20"> Database Architecture

The system utilizes a fully relational MySQL database architecture with the following core tables:

1. **`users`**: Manages authentication, profile data, and RBAC roles (`super_admin`, `admin`, `user`).
2. **`items`**: Core operational table. Stores deposited item details, estimated values, notes, generated tokens (`receipt_token`), and status (`pending`, `stored`, `retrieved`).
3. **`item_photos`**: Relational table (1-to-M with `items`) storing visual proof of the luggage conditions.
4. **`settings`**: Dynamic key-value store for global configuration (App Name, Pricing, Hero text, Contacts). Values are primarily stored as JSON to support Multi-Language localization.
5. **`user_logs`**: System audit table recording `action_type`, `description`, `ip_address`, and `user_agent` for rigorous security monitoring.
6. **`chat_messages`**: Facilitates the integrated real-time text consultation between users and admins.

---

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/gears.svg" width="20" height="20"> Features & Modules breakdown

### 1. Landing Page & Localization
- Sticky, transparent-glass navbar with Live Language Switcher (`ID`, `EN`, `JA`).
- Dynamic pricing cards, location embedded maps, and frequently asked questions populated from the database.
- Modern CSS Blob animations and Light Cream aesthetic.

### 2. Multi-tier Dashboard
- **Super Admin**: Has access to Global Data, App Configuration (Settings CMS with Live Preview), and System Activity Logs.
- **Admin (Cashier)**: Focused interface for processing incoming/outgoing luggage, scanning QR Codes, and printing Thermal Receipts.
- **Customer**: Clean interface to view current active storage, estimated costs, and historical activities. 

### 3. Settings CMS
Super Admins can modify landing page text without editing code. JSON-powered data structures allow seamless text modifications for all three supported languages at once.

---

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/rocket.svg" width="20" height="20"> Getting Started (Installation Guide)

Follow these instructions to set up the project locally.

### Prerequisites
Before you begin, ensure you have met the following requirements:
- **PHP** >= 8.0
- **Composer** (PHP Package Manager)
- **Node.js** & **NPM** (For Vite and Frontend Assets)
- **MySQL** / MariaDB (Database Server)

### Step-by-Step Installation

**1. Clone the repository**
```bash
git clone https://github.com/Nugraa21/Laravel-Web-penitipan-barang.git
cd Laravel-Web-penitipan-barang
```

**2. Install PHP Dependencies**
```bash
composer install
```

**3. Install Frontend Dependencies**
```bash
npm install
```

**4. Environment Setup**
Duplicate the `.env.example` file to create your own `.env` configuration file:
```bash
cp .env.example .env
```
Generate the application encryption key:
```bash
php artisan key:generate
```
**Important:** Open your `.env` file and update your Database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=penitipan_barang
DB_USERNAME=root
DB_PASSWORD=your_password
```

**5. Database Migration & Data Seeding**
Create the necessary tables and populate the system with default Settings, FAQs, and Admin accounts:
```bash
php artisan migrate:fresh --seed
```

**6. Symlink Storage**
Link the storage directory so uploaded item photos are publicly accessible:
```bash
php artisan storage:link
```

**7. Compile Frontend Assets**
Run Vite to bundle CSS and Javascript:
```bash
npm run dev
# Or run "npm run build" for production-ready assets
```

**8. Run the Development Server**
Start the Laravel local development server:
```bash
php artisan serve
```
Application is now live at: [http://localhost:8000](http://localhost:8000)

---

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/book-open.svg" width="20" height="20"> Usage Guide

How to use the application after installation:

### Available Default Accounts (From Database Seeder)
You can log in using the following credentials generated by the seeder:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Super Admin** | `superadmin@admin.com` | `password` |
| **Admin (Cashier)** | `admin@admin.com` | `password` |
| **User (Customer)** | `user@user.com` | `password` |

### Changing Languages
Navigate to the root URL (`/`). In the top-right corner of the navigation bar, click the Language Dropdown (e.g., 🇮🇩 ID) to toggle the interface between Indonesian, English, and Japanese.

### Managing Super Admin Settings
1. Login with the **Super Admin** account.
2. Select **"Pengaturan Core"** (Core Settings) from the AdminLTE sidebar.
3. Edit the desired fields (App Name, Landing Page Promos, Pricing Rates, Social Links, or FAQs).
4. Forms are categorized dynamically. Ensure you update the text for the respective language tabs.
5. Click **"Simpan Perubahan"** (Save). Changes will reflect instantly on the public Landing Page.

---

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/file-contract.svg" width="20" height="20"> License

This project is open-source and available under the MIT License.

## <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/user-group.svg" width="20" height="20"> Contact & Author

Created by [**Nugra21**](https://github.com/Nugraa21). 
Feel free to reach out or contribute by opening an issue on the repository!
