# Inventory Management System (IMS) - Setup Guide

## Project Overview

This is a PHP-based Inventory Management System with features for managing products, brands, categories, and users.

## Prerequisites

- ✅ XAMPP (Apache + MySQL + PHP)
- PHP 7.4 or higher
- MySQL/MariaDB
- Web browser

## Setup Instructions

### Step 1: Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Start **Apache** server
3. Start **MySQL** server

### Step 2: Create Database

1. Open your web browser and go to: `http://localhost/phpmyadmin`
2. Click on **"New"** in the left sidebar to create a new database
3. Name it: `ims`
4. Click **"Create"**

### Step 3: Import Database

1. In phpMyAdmin, select the `ims` database you just created
2. Click on the **"Import"** tab
3. Click **"Choose File"** and navigate to: `c:\xampp\htdocs\ims\Database\ims.sql`
4. Click **"Go"** at the bottom to import the database
5. Wait for the success message

### Step 4: Configure Database Connection

The database configuration is already set in `initialize.php`:

- **Host:** localhost
- **Username:** root
- **Password:** (empty)
- **Database:** ims

If your MySQL has a different username/password, edit these values in:

- `initialize.php` (lines 6-9)
- Update the DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME constants

### Step 5: Verify File Permissions

Ensure the following folders have write permissions:

- `assets/img/brand/`
- `assets/img/` (and all subfolders)

### Step 6: Access the Application

1. Open your web browser
2. Navigate to: `http://localhost/ims/`
3. You should see the login page

## Default Login Credentials

Check the database `tbl_users` table for existing users, or create a new account via the registration page.

Common default credentials (check database):

- **Username/Email:** admin@admin.com (or check database)
- **Password:** (check database)

To access:

- **Admin Panel:** `http://localhost/ims/admin/`
- **User Panel:** `http://localhost/ims/users/`
- **Login Page:** `http://localhost/ims/login.php`

## Project Structure

```
ims/
├── admin/          # Administrator dashboard and functions
├── users/          # User dashboard and functions
├── assets/         # CSS, JS, images, fonts
├── classes/        # Database connection classes
├── inc/            # Include files (headers, navigation)
├── Database/       # SQL database file
├── PHPMailer/      # Email functionality
├── vendor/         # Composer dependencies
└── config.php      # Main configuration file
```

## Features

- Product Management (Add, Edit, Delete, Export)
- Brand Management
- Category & Subcategory Management
- User Management
- Barcode Generation
- Export to Excel
- Tax Rate Management
- User Authentication & Authorization
- Password Reset Functionality

## Troubleshooting

### Issue: "Cannot connect to database"

**Solution:**

1. Make sure MySQL is running in XAMPP
2. Verify database credentials in `initialize.php`
3. Ensure database `ims` exists
4. Check if database is properly imported

### Issue: "Page not found" or 404 errors

**Solution:**

1. Check that Apache is running
2. Verify the project is in `c:\xampp\htdocs\ims`
3. Access via `http://localhost/ims/` not `file://`

### Issue: Images not loading

**Solution:**

1. Check folder permissions for `assets/img/`
2. Verify image paths in database

### Issue: Blank page or PHP errors

**Solution:**

1. Enable error reporting by adding to `config.php`:
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```
2. Check PHP version compatibility (requires PHP 7.4+)
3. Check Apache error logs in `c:\xampp\apache\logs\error.log`

## Dependencies (Already Included)

- PHPMailer - Email functionality
- PHPSpreadsheet - Excel export
- ZipStream - File compression
- Various PSR libraries

## Next Steps

1. ✅ Start XAMPP services
2. ✅ Create and import database
3. ✅ Access the application
4. 🔐 Login or create an account
5. 📊 Start managing your inventory!

## Security Notes

⚠️ **For Production Deployment:**

- Change default database password
- Update `base_url` in `initialize.php`
- Remove or secure phpMyAdmin access
- Enable HTTPS
- Set proper file permissions
- Update default user passwords
- Enable proper error logging (disable display_errors)

## Support

If you encounter any issues during setup, check:

1. XAMPP error logs
2. Browser console for JavaScript errors
3. PHP error logs
4. Apache access/error logs

---

**Last Updated:** February 10, 2026
