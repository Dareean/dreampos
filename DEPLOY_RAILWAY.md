# Deploy IMS ke Railway.app (Gratis)

## 🚂 Railway.app - Modern PHP Hosting (Seperti Vercel)

Railway adalah platform modern yang support PHP dengan pengalaman deploy seperti Vercel.

### ✨ Fitur:

- Git-based deployment
- Auto-deploy dari GitHub
- MySQL database included
- Environment variables
- Modern dashboard
- Free tier: $5 credit/bulan

---

## 📋 Langkah Deploy (15 menit)

### 1️⃣ Persiapan

#### A. Buat akun Railway

1. Buka: https://railway.app
2. **Sign Up** dengan GitHub (recommended)
3. Verify email

#### B. Pastikan code di GitHub

```bash
# Sudah selesai! Code Anda sudah di GitHub ✓
# Repository: https://github.com/Dareean/dreampos
```

### 2️⃣ Deploy Project

#### A. Create New Project

1. Login ke Railway dashboard
2. Klik **"New Project"**
3. Pilih **"Deploy from GitHub repo"**
4. Authorize Railway untuk access GitHub
5. Pilih repository: **"Dareean/dreampos"**
6. Klik **"Deploy Now"**

Railway akan otomatis detect PHP dan mulai deploy!

#### B. Add MySQL Database

1. Di Railway dashboard project Anda
2. Klik **"New"** → **"Database"** → **"Add MySQL"**
3. Tunggu MySQL service deploy
4. Klik MySQL service → Tab **"Variables"**
5. Catat credentials (akan dipakai nanti)

### 3️⃣ Configuration

#### A. Buat file `nixpacks.toml` (sudah dibuat otomatis di bawah)

File ini memberitahu Railway cara menjalankan PHP app:

```toml
[phases.setup]
nixPkgs = ["php82", "php82Extensions.mysqli", "php82Extensions.pdo", "php82Extensions.pdo_mysql"]

[phases.install]
cmds = ["composer install --no-dev --no-interaction"]

[start]
cmd = "php -S 0.0.0.0:$PORT -t ."
```

#### B. Update `initialize.php` untuk Railway

Tambahkan environment variable support:

```php
<?php
// Database configuration with Railway support
$db_host = getenv('MYSQLHOST') ?: getenv('DB_SERVER') ?: 'localhost';
$db_port = getenv('MYSQLPORT') ?: '3306';
$db_user = getenv('MYSQLUSER') ?: getenv('DB_USERNAME') ?: 'root';
$db_pass = getenv('MYSQLPASSWORD') ?: getenv('DB_PASSWORD') ?: '';
$db_name = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: 'ims';

// Add port to host if needed
if ($db_port && $db_port != '3306') {
    $db_host = $db_host . ':' . $db_port;
}

if(!defined('DB_SERVER')) define('DB_SERVER', $db_host);
if(!defined('DB_USERNAME')) define('DB_USERNAME', $db_user);
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', $db_pass);
if(!defined('DB_NAME')) define('DB_NAME', $db_name);

// Base URL - auto-detect Railway domain
$railway_url = getenv('RAILWAY_PUBLIC_DOMAIN');
$base_url = $railway_url ? "https://{$railway_url}/" : 'http://localhost/ims/';
if(!defined('base_url')) define('base_url', $base_url);
```

### 4️⃣ Import Database

#### Opsi A: Via Railway CLI (Recommended)

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link to your project
railway link

# Connect to MySQL
railway run mysql -h $MYSQLHOST -P $MYSQLPORT -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE

# Import (setelah connect)
mysql> source C:/xampp/htdocs/ims/Database/ims.sql
```

#### Opsi B: Via PHPMyAdmin (Mudah)

1. Deploy PHPMyAdmin di Railway:
   - New Service → Deploy from Template → Search "phpmyadmin"
2. Connect ke MySQL Anda
3. Import `ims.sql` seperti biasa

#### Opsi C: Via MySQL Client

1. Download MySQL Workbench atau DBeaver
2. Connect dengan credentials dari Railway
3. Import `ims.sql`

### 5️⃣ Configure Environment Variables (Optional)

Di Railway Dashboard → Your Service → Variables:

```env
DB_NAME=railway
DB_USERNAME=(auto dari MySQL service)
DB_PASSWORD=(auto dari MySQL service)
DB_SERVER=(auto dari MySQL service)
```

Railway sudah auto-inject MySQL variables, jadi biasanya tidak perlu manual!

### 6️⃣ Generate Domain

1. Klik PHP service Anda
2. Tab **"Settings"**
3. Section **"Networking"**
4. Klik **"Generate Domain"**
5. Copy URL (contoh: `ims-production-1a2b.up.railway.app`)

### 7️⃣ Test Application

Buka URL Railway Anda dan test:

```
https://your-app.up.railway.app/login.php
```

---

## 🔧 Troubleshooting

### Error: "Cannot connect to database"

**Fix 1: Check Connection**
Railway MySQL menggunakan private network. Pastikan menggunakan variables yang benar:

```php
// Di initialize.php, gunakan Railway variables
$db_host = getenv('MYSQLHOST');
$db_port = getenv('MYSQLPORT');
```

**Fix 2: Railway Service Connection**
Di Railway dashboard:

1. Klik PHP service
2. Tab "Settings" → "Services"
3. Pastikan MySQL service ter-connected

### Error: "Port already in use"

Railway menyediakan $PORT variable. Pastikan `nixpacks.toml` menggunakan `$PORT`:

```toml
cmd = "php -S 0.0.0.0:$PORT -t ."
```

### Database tidak ter-import

Gunakan Railway CLI untuk import langsung:

```bash
railway run mysql -h $MYSQLHOST -P $MYSQLPORT -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE < Database/ims.sql
```

### Assets/Images tidak load

Check `base_url` setting. Pastikan auto-detect Railway domain:

```php
$railway_url = getenv('RAILWAY_PUBLIC_DOMAIN');
$base_url = $railway_url ? "https://{$railway_url}/" : 'http://localhost/ims/';
```

---

## 💰 Free Tier Limits

Railway Free Tier:

- ✅ $5 credit per bulan
- ✅ ~500 execution hours
- ✅ Unlimited projects
- ✅ 100GB bandwidth
- ⚠️ Setelah credit habis, service akan sleep

**Tips menghemat credit:**

- Remove unused services
- Deploy hanya saat perlu
- Gunakan untuk development/testing

---

## 🚀 Auto-Deploy dari GitHub

Setelah setup selesai, setiap `git push` akan otomatis deploy!

```bash
# Edit code
git add .
git commit -m "Update feature"
git push

# Railway akan auto-deploy! 🎉
```

---

## 📊 Monitoring

Railway dashboard menyediakan:

- ✅ Deployment logs
- ✅ Resource usage
- ✅ Metrics
- ✅ Cost tracking

Access via: https://railway.app/dashboard

---

## ⚡ Performance Tips

1. **Enable Caching**

   ```php
   // Tambahkan caching untuk query
   ```

2. **Optimize Images**
   - Compress images sebelum upload
   - Gunakan WebP format

3. **Database Indexing**
   - Add indexes untuk query yang sering dipakai

---

## 🔐 Security untuk Production

1. **Environment Variables**
   - Simpan semua credentials di Railway Variables
   - Jangan hardcode di code

2. **HTTPS**
   - Railway auto menyediakan HTTPS ✓

3. **Database Security**
   - Railway MySQL ada di private network ✓

4. **Update .htaccess**
   - Enable security headers
   - Force HTTPS

---

## 📚 Resources

- **Railway Docs:** https://docs.railway.app
- **Railway CLI:** https://docs.railway.app/develop/cli
- **Community:** https://discord.gg/railway
- **Status:** https://status.railway.app

---

## ✅ Checklist

- [ ] Akun Railway dibuat
- [ ] Project deployed dari GitHub
- [ ] MySQL database ditambahkan
- [ ] Environment variables configured
- [ ] Database di-import
- [ ] Domain generated
- [ ] Test login & features
- [ ] Monitor usage & costs

---

**Estimated Time:** 15-30 menit
**Difficulty:** ⭐⭐ (Medium)
**Cost:** Free ($5 credit/month)

---

Created: February 10, 2026
