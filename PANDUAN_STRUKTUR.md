# Panduan Struktur Folder Proyek Suja Mobilindo

Selamat datang di kode sumber (source code) aplikasi Dealer Suja Mobilindo!
Panduan ini dibuat khusus agar kamu (atau teman timmu) mudah memahami bagaimana kode ini disusun. Seluruh kode yang penting sudah diberikan komentar dalam bahasa Indonesia.

---

## 📂 Struktur Utama (Yang Perlu Kamu Ketahui)

Aplikasi ini menggunakan kerangka kerja (framework) **Laravel**. Berikut adalah lokasi-lokasi penting tempat kamu bisa menemukan logika program:

### 1. `app/Http/Controllers/`
Di sinilah letak **Logika Aplikasi (Otak Aplikasi)**. Folder ini dibagi menjadi dua bagian agar tidak tercampur:
- **`Admin/`**: Berisi kode untuk panel admin (Dashboard, Kelola Kendaraan). 
  - *Contoh: `VehicleController.php` (untuk menyimpan, mengedit, dan menghapus kendaraan).*
- **`Website/`**: Berisi kode untuk website publik yang dilihat oleh pengunjung (Katalog Mobil/Motor).
  - *Contoh: `HomeController.php` (untuk halaman depan website).*

### 2. `app/Models/`
Di sinilah letak **Penghubung ke Database**. Setiap tabel di database memiliki satu file Model di sini.
- *Contoh: `Vehicle.php` (menghubungkan aplikasi ke tabel kendaraan di database).*

### 3. `resources/views/`
Di sinilah letak **Tampilan Antarmuka (HTML/CSS)**. Kami menggunakan Blade (sistem template Laravel). Folder ini juga dibagi dua:
- **`admin/`**: Semua desain tampilan untuk halaman panel admin (seperti form tambah kendaraan, tabel stok).
  - *Contoh: `admin/vehicles/create.blade.php` (tampilan halaman tambah kendaraan).*
- **`website/`**: Semua desain tampilan untuk website publik (seperti halaman beranda dan detail mobil).
  - *Contoh: `website/home.blade.php` (tampilan katalog website).*

### 4. `routes/web.php`
Di sinilah letak **Peta Jalan (Routing)**. File ini mendaftarkan semua URL yang ada di aplikasi dan mengarahkannya ke Controller yang tepat. Jika kamu ingin menambah halaman baru, kamu harus mendaftarkan URL-nya di sini.
- *Semua rute sudah dikelompokkan dengan komentar bahasa Indonesia (contoh: rute untuk admin dikumpulkan jadi satu grup).*

---

## 🛠️ Penjelasan Tambahan

- **Database Migrations (`database/migrations/`)**: Berisi sejarah pembuatan tabel database. Jika kamu butuh menambah kolom baru di tabel, buat file migrasi baru.
- **Database Seeders (`database/seeders/`)**: Berisi data contoh. Sangat berguna untuk mengisi database kosong secara otomatis dengan data kendaraan dan admin (menggunakan `php artisan db:seed`).
- **Penyimpanan Foto (`storage/app/public/`)**: Saat admin mengupload foto kendaraan, fotonya akan disimpan di sini dan dapat diakses melalui folder `public/storage`.

---

## 💡 Tips Belajar Alur Kodenya
Jika kamu bingung mulai dari mana saat ingin mempelajari fitur tertentu, gunakan alur ini:

1. Buka **`routes/web.php`** (Cari URL fiturnya ke mana arahnya).
2. Buka **`Controller`** yang terhubung (Baca logika apa yang dilakukan, misalnya mengambil data dari database).
3. Buka **`resources/views/...`** (Lihat bagaimana data tersebut ditampilkan ke dalam HTML).

Selamat mempelajari dan memodifikasi aplikasi!
