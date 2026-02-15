# 📚 Fitur Pembelajaran - Filament Admin

## ✅ Fitur yang Sudah Dibuat

### 1. **Program Pembelajaran**
Kelola program pembelajaran yang tersedia di platform.

**Fitur:**
- ✅ CRUD (Create, Read, Update, Delete) Program
- ✅ Judul & Deskripsi Program
- ✅ Status Aktif/Nonaktif (untuk kontrol akses member)
- ✅ Menampilkan jumlah materi per program
- ✅ Filter berdasarkan status aktif

**Akses:** `/admin/programs`

---

### 2. **Materi Pembelajaran**
Kelola konten pembelajaran (Video & PDF/E-Book).

**Fitur:**
- ✅ CRUD Materi Pembelajaran
- ✅ 2 Tipe Materi:
  - 🎥 **Video Pembelajaran** - Upload video atau embed URL
  - 📄 **E-Book/PDF** - Upload dokumen pembelajaran
- ✅ Upload File (Max 100MB)
- ✅ Relasi dengan Program
- ✅ Urutan materi (untuk struktur pembelajaran)
- ✅ Filter berdasarkan Program & Tipe
- ✅ Deskripsi materi

**Akses:** `/admin/materials`

---

## 📋 Struktur Database

### Tabel: `programs`
```
- id
- title
- description
- is_active (boolean) - Mengontrol akses member
- created_at
- updated_at
```

### Tabel: `materials`
```
- id
- program_id (foreign key)
- title
- type (enum: 'video', 'pdf')
- content_url (path file atau URL)
- description
- order (urutan tampilan)
- created_at
- updated_at
```

---

## 🎯 Fitur Akses Khusus Member

### Yang Sudah Tersedia:
- ✅ Flag `is_active` pada Program untuk mengontrol visibility
- ✅ Relasi Program → Materials terstruktur
- ✅ Model `UserMaterialProgress` untuk tracking progress user

### Model Terkait:
1. **Program** - Program pembelajaran utama
2. **Material** - Konten pembelajaran (video/pdf)
3. **UserMaterialProgress** - Tracking progress user

---

## 🚀 Cara Menggunakan

### 1. Login ke Admin Panel
```
URL: http://localhost/admin
Email: admin@aksaka.com
Password: password
```

### 2. Buat Program Pembelajaran
1. Klik menu "Pembelajaran" → "Program Pembelajaran"
2. Klik tombol "New Program"
3. Isi:
   - Judul Program
   - Deskripsi
   - Status Aktif (toggle untuk mengaktifkan)
4. Klik "Create"

### 3. Tambah Materi ke Program
1. Klik menu "Pembelajaran" → "Materi Pembelajaran"
2. Klik tombol "New Material"
3. Isi:
   - Pilih Program
   - Judul Materi
   - Tipe: Video atau PDF
   - Upload File atau masukkan URL
   - Deskripsi (opsional)
   - Urutan (untuk mengurutkan materi)
4. Klik "Create"

---

## 📁 File Storage

Semua file materi disimpan di:
```
storage/app/public/materials/
```

Pastikan sudah menjalankan:
```bash
php artisan storage:link
```

---

## 🎨 Tampilan Admin

### Program Table
- Kolom: Judul, Deskripsi, Status, Jumlah Materi
- Filter: Status Aktif/Nonaktif
- Action: Edit, Delete

### Material Table
- Kolom: Program, Judul, Tipe (badge), Urutan
- Filter: Program, Tipe Materi
- Action: Edit, Delete
- Default Sort: Berdasarkan urutan (asc)

---

## 🔐 Logika Akses Member

```php
// Cek apakah program aktif
$activePrograms = Program::where('is_active', true)->get();

// Ambil materi dari program yang aktif
$materials = Material::whereHas('program', function($q) {
    $q->where('is_active', true);
})->orderBy('order')->get();

// Track progress user
UserMaterialProgress::create([
    'user_id' => auth()->id(),
    'material_id' => $material->id,
    'status' => 'in_progress',
    'started_at' => now(),
]);
```

---

## 📝 Next Steps / Enhancement Ideas

### Frontend Member Area:
1. Halaman daftar program pembelajaran
2. Detail program dengan list materi
3. Video player untuk materi video
4. PDF viewer untuk materi PDF
5. Progress tracking per user
6. Certificateatau badge completion

### Admin Enhancement:
1. Bulk upload materi
2. Preview materi sebelum publish
3. Analytics: berapa user yang menyelesaikan materi
4. Quiz integration (sudah ada tabel `quizzes`)
5. Comments/diskusi per materi

---

## 🐛 Troubleshooting

### Error saat upload file
- Pastikan `php.ini` sudah set `upload_max_filesize` dan `post_max_size` minimal 100M
- Cek permission folder `storage/app/public`

### Material tidak muncul
- Cek apakah Program dalam status aktif
- Cek apakah file sudah ter-upload dengan benar

### Cache issues
```bash
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
```

---

**Created:** 2026-02-15  
**Filament Version:** 4.6.3  
**Laravel Version:** Check `composer.json`
