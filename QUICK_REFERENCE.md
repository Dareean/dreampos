# IMS Quick Reference

## 🔗 Application URLs

- **Main Login:** http://localhost/ims/login.php
- **Admin Panel:** http://localhost/ims/admin/
- **User Panel:** http://localhost/ims/users/
- **phpMyAdmin:** http://localhost/phpmyadmin

## 🗄️ Database Configuration

- **Host:** localhost
- **Username:** root
- **Password:** (empty)
- **Database Name:** ims

## 📁 Important Files & Folders

- **Database File:** `Database/ims.sql`
- **Configuration:** `initialize.php`, `config.php`
- **Database Class:** `classes/connect.php`
- **Admin Files:** `admin/` directory
- **User Files:** `users/` directory
- **Upload Folders:** `assets/img/brand/`

## ⚙️ Quick Commands

### Start IMS Application

```powershell
.\start-ims.ps1
```

### Start XAMPP Control Panel

```powershell
C:\xampp\xampp-control.exe
```

### Open Application

```powershell
Start-Process "http://localhost/ims/login.php"
```

### Check if Services are Running

```powershell
# Check Apache (port 80)
netstat -ano | findstr ":80" | findstr "LISTENING"

# Check MySQL (port 3306)
netstat -ano | findstr ":3306" | findstr "LISTENING"
```

## 🔧 Common Tasks

### Update Base URL

Edit `initialize.php` line 3:

```php
if(!defined('base_url')) define('base_url','http://localhost/ims/');
```

### Update Database Credentials

Edit `initialize.php` lines 6-9:

```php
if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"");
if(!defined('DB_NAME')) define('DB_NAME',"ims");
```

## 📊 Database Tables

- `tbl_brands` - Brand management
- `tbl_categories` - Product categories
- `tbl_sub_categories` - Product subcategories
- `tbl_products` - Product inventory
- `tbl_users` - System users
- `tbl_tax` - Tax rates

## 🎯 Features

- ✅ Product Management (CRUD)
- ✅ Brand Management
- ✅ Category & Subcategory Management
- ✅ User Management
- ✅ Barcode Generation
- ✅ Excel Export
- ✅ Tax Rate Management
- ✅ User Authentication
- ✅ Password Reset

## 🐛 Troubleshooting

### Can't connect to database

1. Check MySQL is running in XAMPP
2. Verify credentials in `initialize.php`
3. Ensure database `ims` exists in phpMyAdmin

### Page not found (404)

1. Ensure Apache is running
2. Check URL: should be `http://localhost/ims/` not file path
3. Verify project is in `C:\xampp\htdocs\ims\`

### Blank page

1. Enable error reporting in `config.php`
2. Check Apache error log: `C:\xampp\apache\logs\error.log`
3. Verify PHP version (needs 7.4+)

### Images not loading

1. Check folder permissions for `assets/img/`
2. Verify image paths in database

## 📚 File Structure

```
ims/
├── admin/              # Admin dashboard
│   ├── processor/      # Backend processors
│   └── sub_categories/ # Subcategory handlers
├── users/              # User dashboard
├── assets/             # Static files (CSS, JS, images)
├── classes/            # PHP classes (DB connection)
├── inc/                # Include files (header, sidebar, etc.)
├── Database/           # SQL files
├── PHPMailer/          # Email library
├── vendor/             # Composer dependencies
├── config.php          # Main config
├── initialize.php      # Constants & DB config
└── *.php               # Public pages (login, signup, etc.)
```

## 🔐 Security Checklist (Production)

- [ ] Change default database password
- [ ] Update base_url to production domain
- [ ] Disable phpMyAdmin in production
- [ ] Enable HTTPS
- [ ] Set proper file permissions
- [ ] Change all default passwords
- [ ] Disable error display (enable logging only)
- [ ] Remove test files
- [ ] Set secure session settings

---

**Created:** February 10, 2026
