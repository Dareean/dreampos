# Platform Deploy Gratis untuk PHP

Perbandingan platform gratis untuk deploy aplikasi PHP seperti IMS.

## 🏆 Rekomendasi Platform

### 1. **Railway.app** ⭐⭐⭐⭐⭐ (BEST - Mirip Vercel)

**Website:** https://railway.app

**Kelebihan:**
- ✅ Modern dashboard (seperti Vercel)
- ✅ Git-based deployment otomatis
- ✅ Support PHP & MySQL native
- ✅ Environment variables
- ✅ Custom domains
- ✅ HTTPS otomatis
- ✅ Easy database import
- ✅ CLI tools

**Kekurangan:**
- ⚠️ Free tier terbatas: $5 credit/bulan (~500 jam)
- ⚠️ Setelah credit habis, app akan sleep

**Setup Time:** 15 menit  
**Difficulty:** ⭐⭐  
**Panduan:** [DEPLOY_RAILWAY.md](DEPLOY_RAILWAY.md)

---

### 2. **Render.com** ⭐⭐⭐⭐

**Website:** https://render.com

**Kelebihan:**
- ✅ Free tier permanent (dengan batasan)
- ✅ Git-based deployment
- ✅ Support PHP via Docker
- ✅ PostgreSQL gratis (bukan MySQL)
- ✅ Auto-deploy
- ✅ Custom domains

**Kekurangan:**
- ⚠️ Tidak support MySQL gratis (hanya PostgreSQL)
- ⚠️ Perlu Docker configuration
- ⚠️ Free tier: app sleep setelah 15 menit idle
- ⚠️ Cold start lambat (50 detik)

**Setup Time:** 30 menit  
**Difficulty:** ⭐⭐⭐

**Cara Deploy:**
```dockerfile
# Perlu buat Dockerfile
FROM php:8.2-apache
COPY . /var/www/html/
# ... setup lainnya
```

---

### 3. **InfinityFree** ⭐⭐⭐⭐

**Website:** https://infinityfree.net

**Kelebihan:**
- ✅ 100% gratis (unlimited)
- ✅ PHP & MySQL included
- ✅ cPanel (mudah digunakan)
- ✅ Unlimited bandwidth
- ✅ Email accounts
- ✅ No credit card needed

**Kekurangan:**
- ❌ Ada iklan di website Anda
- ❌ Performa terbatas
- ❌ Tidak ada Git deployment
- ❌ Manual upload via FTP/cPanel
- ❌ Daily hits limit

**Setup Time:** 20 menit  
**Difficulty:** ⭐⭐

**Cara Deploy:**
1. Sign up di InfinityFree
2. Create account & domain
3. Upload via File Manager atau FTP
4. Create MySQL database
5. Import `ims.sql`
6. Update `initialize.php`

---

### 4. **000webhost** ⭐⭐⭐

**Website:** https://www.000webhost.com

**Kelebihan:**
- ✅ Gratis permanent
- ✅ PHP & MySQL
- ✅ 300 MB storage
- ✅ No ads
- ✅ cPanel-like interface

**Kekurangan:**
- ❌ Bandwidth terbatas (3 GB/bulan)
- ❌ Sleep jika tidak ada traffic 1 jam
- ❌ Performa lambat
- ❌ Manual upload

**Setup Time:** 20 menit  
**Difficulty:** ⭐⭐

---

### 5. **Vercel** ❌ (TIDAK COCOK)

**Website:** https://vercel.com

**Kenapa tidak cocok:**
- ❌ Tidak support PHP tradisional
- ❌ Hanya support Serverless Functions (Node.js, Python, Go)
- ❌ Tidak ada MySQL
- ❌ Butuh rewrite app ke Next.js/React

**Alternatif:** Gunakan Railway atau Render untuk experience serupa

---

### 6. **Netlify** ❌ (TIDAK COCOK)

**Website:** https://netlify.com

**Kenapa tidak cocok:**
- ❌ Hanya static sites
- ❌ Tidak support PHP server-side
- ❌ Tidak ada MySQL

---

## 📊 Perbandingan Lengkap

| Platform | Gratis? | PHP | MySQL | Git Deploy | HTTPS | Dashboard | Like Vercel? |
|----------|---------|-----|-------|------------|-------|-----------|--------------|
| **Railway** | $5/mo | ✅ | ✅ | ✅ | ✅ | Modern | ⭐⭐⭐⭐⭐ |
| **Render** | Yes* | ✅ | ❌† | ✅ | ✅ | Modern | ⭐⭐⭐⭐ |
| **InfinityFree** | Yes | ✅ | ✅ | ❌ | ✅ | cPanel | ⭐⭐ |
| **000webhost** | Yes | ✅ | ✅ | ❌ | ✅ | Basic | ⭐⭐ |
| **Heroku** | No | ✅ | Add-on | ✅ | ✅ | Good | ⭐⭐⭐⭐ |
| **Vercel** | Yes | ❌ | ❌ | ✅ | ✅ | Modern | ❌ |
| **Netlify** | Yes | ❌ | ❌ | ✅ | ✅ | Modern | ❌ |

*Render free tier: app sleep setelah idle  
†Render: PostgreSQL only (gratis)

---

## 🎯 Rekomendasi Berdasarkan Kebutuhan

### Untuk Developer (Modern Experience):
**→ Railway.app** ([Panduan](DEPLOY_RAILWAY.md))
- Git-based deployment
- Auto-deploy
- Modern dashboard
- Worth it untuk $5/bulan

### Untuk Testing/Demo (100% Gratis):
**→ InfinityFree**
- Unlimited (dengan batasan performa)
- Mudah digunakan
- Toleransi iklan

### Untuk Production (Bayar):
**→ Hostinger** ($2/mo)
**→ Niagahoster** (Rp 10rb/mo)
- Reliable
- Support bagus
- No sleep time

---

## 🚀 Quick Start - Railway (Recommended)

```bash
# 1. Pastikan code di GitHub (✓ sudah)

# 2. Deploy ke Railway
# - Buka https://railway.app
# - Sign up with GitHub
# - New Project → Deploy from GitHub
# - Pilih repository "Dareean/dreampos"
# - Add MySQL database
# - Generate domain
# - Done!

# Panduan lengkap: DEPLOY_RAILWAY.md
```

---

## 💡 Tips Memilih Platform

### Pilih Railway jika:
- ✅ Mau experience seperti Vercel
- ✅ Git-based deployment
- ✅ Rela bayar sedikit ($5/mo)
- ✅ Butuh MySQL
- ✅ Auto-deploy

### Pilih InfinityFree jika:
- ✅ 100% gratis mutlak
- ✅ Tidak masalah dengan iklan
- ✅ Untuk portfolio/testing
- ✅ Tidak butuh performa tinggi

### Pilih Hosting Berbayar jika:
- ✅ Production app
- ✅ Butuh reliability
- ✅ No downtime
- ✅ Support customer

---

## 📚 Resources

- **Railway Tutorial:** [DEPLOY_RAILWAY.md](DEPLOY_RAILWAY.md)
- **Traditional Hosting:** [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)
- **Setup Local:** [SETUP_GUIDE.md](SETUP_GUIDE.md)

---

## ❓ FAQ

**Q: Kenapa Vercel tidak support PHP?**  
A: Vercel dirancang untuk serverless/JAMstack (JavaScript, Next.js, React). PHP butuh persistent server.

**Q: Apakah Railway benar-benar gratis?**  
A: Ya, Railway memberikan $5 credit/bulan. Cukup untuk ~500 jam execution (sekitar 20 hari 24/7).

**Q: Platform mana yang paling mudah?**  
A: Railway paling mudah untuk developer. InfinityFree paling mudah untuk non-developer.

**Q: Bisa dapat domain gratis?**  
A: Railway, Render, InfinityFree semua berikan subdomain gratis. Custom domain perlu beli.

**Q: Database gratis di mana?**  
A: Railway (MySQL), Render (PostgreSQL), InfinityFree (MySQL), 000webhost (MySQL).

---

Created: February 10, 2026
