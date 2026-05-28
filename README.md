# 📖 Hafalan Tracker
> Sistem Monitoring Hafalan Al-Quran berbasis Web

![Laravel](https://img.shields.io/badge/Laravel-13.x-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?style=flat-square&logo=mysql)
![Livewire](https://img.shields.io/badge/Livewire-3.x-pink?style=flat-square)

---

## 📋 Tentang Proyek

**Hafalan Tracker** adalah aplikasi web untuk memonitoring hafalan Al-Quran santri di lembaga tahfizh. Aplikasi ini dirancang untuk menggantikan buku monitoring hafalan fisik menjadi sistem digital yang lebih efisien dan transparan.

Sistem ini terinspirasi dari **Lembaran Monitor dan Evaluasi Halaqah Al-Quran & Tahfizh** yang biasa digunakan pada saat saya sedang bersekolah (Madrasah Aliyah Karakter (MAK) Imam An-Nawawi, Banda Aceh), yang mencakup pencatatan **Sabaq** (hafalan baru), **Sabqi** (murajaah hafalan baru), dan **Manzil** (murajaah hafalan lama di rumah).

---

## ✨ Fitur Utama

### 👑 Admin
- Manajemen user (tambah, edit, hapus)
- Kelola akun ustadz, santri, dan orang tua
- Hubungkan akun orang tua dengan santri
- Dashboard statistik pengguna

### 🎓 Ustadz
- Input setoran hafalan santri (Sabaq, Sabqi, Manzil)
- Paraf setoran langsung saat input
- Lihat riwayat setoran per santri
- Kirim catatan ke orang tua
- Dashboard statistik setoran

### 👨‍👦 Orang Tua
- Monitor perkembangan hafalan anak
- Paraf setoran anak secara digital
- Balas catatan dari ustadz
- Dashboard setoran terakhir anak

### 📖 Santri
- Lihat riwayat setoran sendiri
- Cek status paraf guru dan orang tua
- Lihat catatan dari ustadz
- Dashboard progress hafalan pribadi

---

## 🗃️ Struktur Database

```
users (id, name, email, role, password)
  │
  ├── ortu_santri (ortu_id, santri_id)
  │
  └── setoran (id, user_id, tanggal, paraf_guru, paraf_ortu)
        │
        ├── sabaq (id, setoran_id, surah_id, ayat_mulai, ayat_selesai, jumlah_baris, nilai)
        ├── sabqi (id, setoran_id, surah_id, ayat_mulai, ayat_selesai, jumlah_halaman, nilai)
        ├── manzil (id, setoran_id, surah_id, ayat_mulai, ayat_selesai, jumlah_halaman, nilai)
        └── catatan_setoran (id, setoran_id, user_id, role, isi_catatan)

surahs (id, nomor, nama_arab, nama_latin, jumlah_ayat) — 114 surah
```

**Keterangan Nilai:**
| Kode | Keterangan |
|------|-----------|
| L | Lancar |
| KL | Kurang Lancar |
| U | Harus Diulang |

---

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.4
- Composer
- MySQL
- Node.js & NPM

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/MuhammadShidqiHanifUSK/hafalan-tracker.git
cd hafalan-tracker
```

**2. Install dependencies**
```bash
composer install
npm install
npm run build
```

**3. Konfigurasi environment**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Konfigurasi database di `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hafalan_tracker
DB_USERNAME=root
DB_PASSWORD=
```

**5. Migrasi & seed database**
```bash
php artisan migrate
php artisan db:seed --class=SurahSeeder
```

**6. Buat akun admin pertama**
```bash
php artisan tinker
\App\Models\User::create(['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('password'), 'role' => 'admin']);
exit
```

**7. Jalankan server**
```bash
php artisan serve
```

Buka browser di `http://127.0.0.1:8000`

---

## 👥 Role & Akses

| Role | Akses Setelah Login | Kemampuan |
|------|-------------------|-----------|
| Admin | `/admin/users` | Kelola semua user |
| Ustadz | `/setoran` | Input & kelola setoran |
| Santri | `/riwayat` | Lihat riwayat sendiri |
| Ortu | `/setoran-anak` | Monitor & paraf setoran anak |

---

## 🛠️ Teknologi

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| Laravel | 13.x | Framework PHP |
| Livewire | 3.x | Frontend reaktif |
| Flux UI | - | Komponen UI |
| MySQL | 8.0 | Database |
| Tom Select | 2.3.1 | Dropdown pencarian surah |
| Laravel Fortify | - | Autentikasi |

---

## 📁 Struktur Folder Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── SetoranController.php
│   │   ├── SantriController.php
│   │   ├── OrtuController.php
│   │   └── CatatanSetoranController.php
│   └── Middleware/
│       └── RoleMiddleware.php
└── Models/
    ├── User.php
    ├── Setoran.php
    ├── Surah.php
    ├── Sabaq.php
    ├── Sabqi.php
    ├── Manzil.php
    ├── OrtuSantri.php
    └── CatatanSetoran.php

resources/views/
├── admin/        # Halaman admin
├── setoran/      # Halaman ustadz
├── santri/       # Halaman santri
├── ortu/         # Halaman orang tua
└── layouts/      # Layout utama

public/css/
└── hafalan.css   # Stylesheet utama
```

---

## 📸 Tampilan Aplikasi

| Halaman | Deskripsi |
|---------|-----------|
| Dashboard | Statistik berbeda per role |
| Manajemen User | Admin kelola semua akun |
| Daftar Santri | Ustadz lihat semua santri |
| Input Setoran | Form sabaq, sabqi, manzil |
| Detail Setoran | Lengkap dengan catatan |
| Riwayat Santri | Histori setoran per santri |

---

## 🔮 Rencana Pengembangan

- [ ] Manzil dengan range surah awal-akhir (multi-surah)
- [ ] Notifikasi/reminder jadwal murajaah
- [ ] Export laporan hafalan ke PDF
- [ ] Grafik progress hafalan santri
- [ ] Fitur pencarian & filter setoran

---

## 📝 Informasi Proyek

| | |
|--|--|
| **Mata Kuliah** | SINF2034 - Praktikum Pemrograman Berbasis Web A - Genap 2025/2026 |
| **Mahasiswa** | Muhammad Shidqi Hanif |
| **NPM** | 2408107010096 |
| **Institusi** | Universitas Syiah Kuala, Fakultas Matematika dan Ilmu Pengetahuan Alam, S1-Informatika — Banda Aceh |

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

Dibuat untuk keperluan akademik — **UAS Praktikum Pemrograman Berbasis Web (SINF2034)**,  
Universitas Syiah Kuala, Genap 2025/2026.

---

<div align="center">
  <p>Dibuat dengan ❤️ untuk memudahkan monitoring hafalan Al-Quran</p>
  <p><i>"Sebaik-baik kalian adalah yang mempelajari Al-Quran dan mengajarkannya."</i></p>
  <p><i>(HR. Bukhari)</i></p>
</div>
