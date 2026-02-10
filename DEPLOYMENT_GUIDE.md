# Panduan Deployment - Inventory Management System

## ⚠️ Penting: Mengapa Tidak Bisa di Vercel?

**Vercel TIDAK mendukung PHP tradisional** seperti aplikasi ini. Vercel dirancang untuk:

- Next.js, React, Vue
- Serverless Functions (Node.js, Python, Go)
- Static sites

Aplikasi IMS ini membutuhkan:

- ✅ PHP Server (Apache/Nginx)
- ✅ MySQL Database
- ✅ Session Management
- ✅ File Upload Support

## 🚀 Pilihan Platform Deployment untuk PHP

### Opsi 1: Hosting Tradisional (PALING MUDAH) ⭐ Recommended

#### A. Hosting Gratis:

1. **InfinityFree** (https://infinityfree.net)
   - ✅ PHP & MySQL gratis
   - ✅ Unlimited bandwidth
   - ✅ cPanel included
   - ❌ Ada iklan
   - ❌ Performa terbatas

2. **000webhost** (https://www.000webhost.com)
   - ✅ PHP & MySQL gratis
   - ✅ 300 MB storage
   - ✅ No ads
   - ❌ Bandwidth terbatas

3. **AwardSpace** (https://www.awardspace.com)
   - ✅ PHP & MySQL gratis
   - ✅ 1 GB storage
   - ❌ Performa terbatas

#### B. Hosting Berbayar (Lebih Stabil):

1. **Niagahoster** (Indonesia) - Rp 10rb-50rb/bulan
2. **Hostinger** - $2-5/bulan
3. **Rumahweb** (Indonesia) - Rp 15rb-100rb/bulan
4. **DomaiNesia** (Indonesia) - Rp 20rb-80rb/bulan

### Opsi 2: Cloud Platform

#### A. Railway.app (Mudah, Cocok untuk PHP)

- ✅ Mendukung PHP & MySQL
- ✅ Deploy via Git
- ✅ Free tier: $5 credit/bulan
- Link: https://railway.app

#### B. Heroku (Popular)

- ✅ Mendukung PHP
- ✅ Add-on untuk MySQL (ClearDB)
- ❌ No free tier lagi (mulai $5/bulan)
- Link: https://www.heroku.com

#### C. DigitalOcean App Platform

- ✅ Full control
- ✅ PHP & MySQL support
- ❌ Minimal $5/bulan
- Link: https://www.digitalocean.com

### Opsi 3: VPS (Untuk Advanced Users)

- **DigitalOcean Droplets** - $4-6/bulan
- **Vultr** - $3.5-6/bulan
- **Linode** - $5/bulan
- **AWS EC2** - Pay as you go

---

## 📋 Langkah Deployment ke Hosting Tradisional

### Persiapan:

1. **Export Database**
   - Sudah ada di: `Database/ims.sql`
   - Atau export ulang dari phpMyAdmin

2. **Compress Files**
   - Zip semua file project (kecuali folder `vendor` jika terlalu besar)

### Langkah Deploy:

#### 1️⃣ Upload Files via FTP/cPanel

**Via cPanel File Manager:**

```
1. Login ke cPanel hosting Anda
2. Buka "File Manager"
3. Masuk ke folder "public_html"
4. Upload file ZIP project
5. Extract ZIP file
6. Pastikan struktur folder benar (index.php di root)
```

**Via FTP (FileZilla):**

```
1. Download FileZilla Client
2. Connect ke FTP hosting (host, username, password dari email hosting)
3. Upload semua file ke public_html/
4. Tunggu sampai selesai
```

#### 2️⃣ Buat Database di cPanel

```
1. Login ke cPanel
2. Cari "MySQL Databases"
3. Buat database baru:
   - Database name: username_ims (contoh)
4. Buat user database:
   - Username: username_imsuser
   - Password: [buat password kuat]
5. Tambahkan user ke database
6. Berikan "All Privileges"
7. Catat: database name, username, password
```

#### 3️⃣ Import Database

```
1. Di cPanel, buka "phpMyAdmin"
2. Pilih database yang baru dibuat
3. Klik tab "Import"
4. Choose File → pilih "ims.sql"
5. Klik "Go"
6. Tunggu sampai success
```

#### 4️⃣ Update Configuration

Edit file `initialize.php`:

```php
<?php
$dev_data = array('id'=>'-1','firstname'=>'Developer','lastname'=>'','email'=>'dev_oretnom','password'=>'5da283a2d990e8d8512cf967df5bc0d0','last_login'=>'','date_updated'=>'','date_added'=>'');

// UPDATE INI dengan domain Anda
if(!defined('base_url')) define('base_url','https://yourdomain.com/');
if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );
if(!defined('dev_data')) define('dev_data',$dev_data);

// UPDATE INI dengan credentials database Anda
if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME',"username_imsuser"); // ganti
if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"your_password_here"); // ganti
if(!defined('DB_NAME')) define('DB_NAME',"username_ims"); // ganti
```

#### 5️⃣ Set Permissions

```bash
# Via File Manager atau FTP
Set folder permissions:
- assets/img/ → 755 atau 777
- assets/img/brand/ → 755 atau 777
```

#### 6️⃣ Test Application

```
Buka: https://yourdomain.com/login.php
```

---

## 📋 Langkah Deployment ke Railway.app

### Prerequisites:

- Git installed
- GitHub account
- Railway account

### Langkah:

#### 1️⃣ Prepare Repository

```powershell
# Di folder project
git init
git add .
git commit -m "Initial commit"

# Create GitHub repo dan push
git remote add origin https://github.com/username/ims.git
git branch -M main
git push -u origin main
```

#### 2️⃣ Create Railway Project

```
1. Login ke https://railway.app
2. New Project → Deploy from GitHub
3. Pilih repository "ims"
4. Railway akan auto-detect PHP
```

#### 3️⃣ Add MySQL Database

```
1. Di Railway dashboard, klik "New"
2. Pilih "Database" → "MySQL"
3. Tunggu deploy selesai
4. Klik MySQL service → Variables
5. Catat: MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE
```

#### 4️⃣ Create Nixpacks Configuration

Buat file `nixpacks.toml` di root project:

```toml
[phases.setup]
nixPkgs = ["php82", "php82Extensions.mysqli", "php82Extensions.pdo", "php82Extensions.pdo_mysql", "apache"]

[phases.install]
cmds = ["composer install --no-dev"]

[start]
cmd = "php -S 0.0.0.0:$PORT -t ."
```

#### 5️⃣ Update Environment Variables

Di Railway dashboard → PHP service → Variables:

```
DB_SERVER = [MYSQL_HOST from MySQL service]
DB_USERNAME = [MYSQL_USER from MySQL service]
DB_PASSWORD = [MYSQL_PASSWORD from MySQL service]
DB_NAME = [MYSQL_DATABASE from MySQL service]
```

#### 6️⃣ Update initialize.php

```php
<?php
// Use environment variables for production
if(!defined('base_url')) define('base_url', getenv('RAILWAY_STATIC_URL') ?: 'http://localhost/ims/');
if(!defined('DB_SERVER')) define('DB_SERVER', getenv('DB_SERVER') ?: "localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME', getenv('DB_USERNAME') ?: "root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', getenv('DB_PASSWORD') ?: "");
if(!defined('DB_NAME')) define('DB_NAME', getenv('DB_NAME') ?: "ims");
```

#### 7️⃣ Import Database

```
1. Connect ke MySQL Railway via Railway CLI atau MySQL client
2. Import ims.sql file
```

---

## 🔒 Security Checklist Sebelum Deploy

- [ ] Ganti semua password default
- [ ] Update `base_url` ke domain production
- [ ] Disable `display_errors` di production
- [ ] Set strong database password
- [ ] Remove test files (`testmd.php`, dll)
- [ ] Set proper file permissions (755 untuk folders, 644 untuk files)
- [ ] Enable HTTPS (force SSL)
- [ ] Update session security settings
- [ ] Remove atau protect phpMyAdmin access
- [ ] Backup database secara berkala

---

## 🛠️ Troubleshooting Deployment

### Error: "Cannot connect to database"

```
✅ Check: DB credentials di initialize.php
✅ Check: Database sudah di-import
✅ Check: MySQL service running
✅ Check: User database punya privileges
```

### Error: "Page not found" / 404

```
✅ Check: File structure (index.php location)
✅ Check: .htaccess file (jika ada)
✅ Check: base_url setting benar
```

### Error: "Images not loading"

```
✅ Check: Folder permissions (755/777)
✅ Check: Path di database correct
✅ Check: Upload folder writable
```

### Error: "Session not working"

```
✅ Check: Session folder writable
✅ Check: php.ini session settings
✅ Check: Cookie domain settings
```

---

## 📊 Comparison: Pilihan Platform

| Platform     | Harga     | Mudah?     | PHP Support | MySQL       | Recommended      |
| ------------ | --------- | ---------- | ----------- | ----------- | ---------------- |
| InfinityFree | Gratis    | ⭐⭐⭐⭐⭐ | ✅          | ✅          | Untuk testing    |
| Niagahoster  | 10rb/bln  | ⭐⭐⭐⭐⭐ | ✅          | ✅          | ⭐ BEST (ID)     |
| Hostinger    | $2/bln    | ⭐⭐⭐⭐⭐ | ✅          | ✅          | ⭐ BEST (Global) |
| Railway      | $5/bln    | ⭐⭐⭐     | ✅          | ✅          | Untuk developers |
| Heroku       | $5/bln    | ⭐⭐⭐     | ✅          | ✅ (add-on) | Untuk developers |
| VPS          | $4-10/bln | ⭐⭐       | ✅          | ✅          | Advanced users   |
| Vercel       | Gratis    | ❌         | ❌          | ❌          | ❌ TIDAK COCOK   |

---

## 🎯 Rekomendasi Saya

### Untuk Pemula / Testing:

1. **InfinityFree** (gratis) - Paling mudah, ada cPanel
2. **000webhost** (gratis) - Fast setup

### Untuk Production / Bisnis:

1. **Niagahoster** (Indonesia) - Support Bahasa Indonesia, cPanel
2. **Hostinger** (Global) - Murah, reliable, fast

### Untuk Developer:

1. **Railway** - Modern, Git deployment
2. **DigitalOcean** - Full control, scalable

---

## 📚 Resources

- **FileZilla (FTP Client):** https://filezilla-project.org
- **Railway Docs:** https://docs.railway.app
- **cPanel Tutorial:** https://cpanel.net/resources/
- **PHP Hosting Guide:** https://www.php.net/manual/en/install.php

---

## 💡 Tips Deployment

1. **Selalu backup database** sebelum deploy
2. **Test di local** dulu sebelum deploy
3. **Gunakan environment variables** untuk sensitive data
4. **Enable error logging** tapi disable error display
5. **Set up automated backups** untuk database
6. **Monitor uptime** dengan tools seperti UptimeRobot
7. **Use CDN** untuk asset static (opsional)
8. **Implement caching** untuk performance

---

**Need Help?**

- Check error logs di hosting
- Contact hosting support
- Google specific error messages

**Created:** February 10, 2026
