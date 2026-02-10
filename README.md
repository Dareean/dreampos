# 📦 Inventory Management System (IMS)

Sistem Manajemen Inventori berbasis web yang dibangun dengan PHP dan MySQL. Aplikasi ini dirancang untuk membantu mengelola produk, brand, kategori, dan stok barang dengan mudah dan efisien.

![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange)
![License](https://img.shields.io/badge/License-MIT-green)

## ✨ Features

### 🎯 Core Features
- **Product Management** - Tambah, edit, hapus, dan kelola produk dengan mudah
- **Brand Management** - Kelola brand/merek produk
- **Category & Subcategory** - Organisasi produk dengan kategori dan subkategori
- **User Management** - Kelola pengguna dengan role Admin dan User
- **Barcode Generation** - Generate barcode untuk produk
- **Export to Excel** - Export data ke format Excel/Spreadsheet
- **Tax Rate Management** - Kelola tarif pajak
- **Product Details** - View detail lengkap produk dengan gambar

### 🔐 Security Features
- User Authentication & Authorization
- Role-based Access Control (Admin & User)
- Password Reset via Email
- Session Management
- SQL Injection Protection

### 📊 Dashboard
- Dashboard Admin dengan statistik lengkap
- Dashboard User untuk viewing data
- Real-time data updates

## 🛠️ Technology Stack

- **Backend:** PHP 7.4+
- **Database:** MySQL/MariaDB
- **Frontend:** HTML5, CSS3, Bootstrap 4
- **JavaScript:** jQuery, DataTables
- **Libraries:**
  - PHPMailer - Email functionality
  - PHPSpreadsheet - Excel export
  - Font Awesome - Icons
  - Select2 - Enhanced dropdowns

## 📋 Requirements

- XAMPP/WAMP/LAMP (Apache + MySQL + PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web Browser (Chrome, Firefox, Edge)
- Composer (untuk dependencies)

## 🚀 Installation

### 1. Clone atau Download Project

```bash
# Clone via Git
git clone https://github.com/yourusername/ims.git

# Atau download ZIP dan extract ke:
C:\xampp\htdocs\ims
```

### 2. Start XAMPP Services

```powershell
# Atau gunakan quick start script
.\start-ims.ps1
```

**Manual:**
- Buka XAMPP Control Panel
- Start **Apache**
- Start **MySQL**

### 3. Create Database

1. Buka browser: `http://localhost/phpmyadmin`
2. Klik **"New"** → Create database: `ims`
3. Klik **"Import"** tab
4. Pilih file: `Database/ims.sql`
5. Klik **"Go"**

### 4. Configuration

File konfigurasi sudah siap di `initialize.php`:

```php
// Database Configuration
DB_SERVER: localhost
DB_USERNAME: root
DB_PASSWORD: (kosong)
DB_NAME: ims

// Base URL
base_url: http://localhost/ims/
```

### 5. Access Application

Buka browser dan akses:
- **Main App:** http://localhost/ims/
- **Login:** http://localhost/ims/login.php
- **Admin Panel:** http://localhost/ims/admin/
- **User Panel:** http://localhost/ims/users/

## 👥 Default Credentials

Check database `tbl_users` untuk kredensial yang tersedia, atau buat akun baru melalui halaman registrasi.

## 📁 Project Structure

```
ims/
├── admin/                  # Admin dashboard & functions
│   ├── processor/          # Backend processing scripts
│   ├── sub_categories/     # Subcategory handlers
│   └── *.php              # Admin pages
│
├── users/                  # User dashboard & functions
│   └── *.php              # User pages
│
├── assets/                 # Static resources
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── img/               # Images & uploads
│   └── fonts/             # Font files
│
├── classes/                # PHP Classes
│   └── connect.php        # Database connection
│
├── inc/                    # Include files
│   ├── header.php         # Header component
│   ├── sidebar.php        # Sidebar navigation
│   ├── topnav.php         # Top navigation
│   └── initialize.php     # Initialization
│
├── Database/               # Database files
│   └── ims.sql           # Database schema & data
│
├── PHPMailer/             # Email library
├── vendor/                # Composer dependencies
│
├── config.php             # Main configuration
├── initialize.php         # Constants & settings
├── login.php              # Login page
├── register.php           # Registration page
└── README.md              # This file
```

## 🎮 Usage

### Admin Functions

1. **Dashboard** - View statistik dan ringkasan
2. **Products** - Kelola produk (CRUD operations)
3. **Brands** - Kelola brand/merek
4. **Categories** - Kelola kategori produk
5. **Subcategories** - Kelola subkategori
6. **Users** - Kelola pengguna sistem
7. **Tax Rates** - Set tarif pajak
8. **Export** - Export data ke Excel

### User Functions

1. **View Products** - Lihat daftar produk
2. **View Brands** - Lihat daftar brand
3. **View Categories** - Lihat kategori
4. **Product Details** - Detail produk lengkap
5. **Profile** - Update profile

## 🔧 Configuration

### Update Base URL

Edit `initialize.php`:

```php
if(!defined('base_url')) define('base_url','http://localhost/ims/');
```

### Update Database Credentials

Edit `initialize.php`:

```php
if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"");
if(!defined('DB_NAME')) define('DB_NAME',"ims");
```

### Email Configuration

Edit `PHPMailer` settings untuk password reset functionality.

## 🌐 Deployment

### Quick Deploy

```powershell
# Check kesiapan deployment
.\check-deploy.ps1

# Prepare deployment package
.\prepare-deploy.ps1
```

### Deployment Guide

Lihat dokumentasi lengkap di:
- **[DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)** - Panduan deployment lengkap
- **[SETUP_GUIDE.md](SETUP_GUIDE.md)** - Setup instructions
- **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** - Quick reference

### Recommended Hosting

- **Niagahoster** (Indonesia) - Mulai Rp 10rb/bulan
- **Hostinger** (Global) - Mulai $2/bulan
- **InfinityFree** - Gratis untuk testing

**Note:** Vercel TIDAK support PHP traditional. Gunakan PHP hosting.

## 🐛 Troubleshooting

### Cannot connect to database
- Check MySQL service running
- Verify credentials di `initialize.php`
- Pastikan database `ims` exists

### Page not found (404)
- Check Apache running
- Verify project di `C:\xampp\htdocs\ims\`
- Access via `http://localhost/ims/` bukan file path

### Blank page
- Enable error reporting di `config.php`
- Check PHP version (minimum 7.4)
- Check Apache error logs

### Images not loading
- Check folder permissions: `assets/img/`
- Verify image paths di database
- Set permissions to 755 or 777

## 📊 Database Schema

**Main Tables:**
- `tbl_users` - System users
- `tbl_brands` - Product brands
- `tbl_categories` - Product categories
- `tbl_sub_categories` - Product subcategories
- `tbl_products` - Product inventory
- `tbl_tax` - Tax rates

## 🔐 Security

### Production Checklist
- [ ] Change default passwords
- [ ] Update `base_url` to production domain
- [ ] Set `display_errors = Off`
- [ ] Enable HTTPS (force SSL)
- [ ] Update database credentials
- [ ] Remove test files
- [ ] Set proper file permissions
- [ ] Enable security headers in `.htaccess`
- [ ] Regular database backups
- [ ] Update session security settings

## 📦 Dependencies

Managed via Composer:
- `phpmailer/phpmailer` - Email functionality
- `phpoffice/phpspreadsheet` - Excel operations
- `ezyang/htmlpurifier` - HTML sanitization
- `maennchen/zipstream-php` - ZIP operations

## 🤝 Contributing

1. Fork the project
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

## 👨‍💻 Developer

Created with ❤️ for inventory management

## 📞 Support

Jika ada pertanyaan atau issue:
- Create issue di GitHub
- Check [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md) untuk troubleshooting
- Contact developer

## 📚 Documentation

- **[SETUP_GUIDE.md](SETUP_GUIDE.md)** - Complete setup instructions
- **[DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)** - Deployment guide (Bahasa Indonesia)
- **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** - Quick reference & commands
- **[.env.example](.env.example)** - Environment variables template

## 🎯 Roadmap

- [ ] REST API implementation
- [ ] Mobile responsive improvements
- [ ] Advanced reporting & analytics
- [ ] Multi-language support
- [ ] Inventory alerts & notifications
- [ ] Purchase order management
- [ ] Supplier management
- [ ] Stock movement history
- [ ] Advanced search & filters
- [ ] Dashboard customization

## 📈 Version History

- **v1.0.0** - Initial release
  - Product management
  - Brand management
  - Category management
  - User management
  - Excel export
  - Barcode generation

## 🙏 Acknowledgments

- Bootstrap team for the UI framework
- Font Awesome for icons
- PHPMailer contributors
- PHPSpreadsheet team
- All open source contributors

---

**Made with ☕ by Developer Team**

**⭐ Star this repo if you find it helpful!**
