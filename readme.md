# Aplikasi Pencatatan Sederhana

Aplikasi ini adalah sistem pencatatan sederhana berbasis PHP dan SQLite yang memungkinkan pengguna untuk membuat, mengedit, dan menghapus catatan. Aplikasi ini juga membatasi jumlah kata untuk setiap catatan (maksimal 1000 kata) dan menggunakan antarmuka berbasis web dengan dashboard yang responsif.

## Fitur Utama

- **Buat Catatan Baru**: Pengguna dapat menambahkan catatan baru. Setiap catatan disimpan dengan tanggal pembuatan.
- **Edit Catatan**: Pengguna dapat mengedit catatan yang sudah ada.
- **Hapus Catatan**: Pengguna dapat menghapus catatan yang tidak lagi diperlukan.
- **Validasi Jumlah Kata**: Setiap catatan dibatasi hingga 1000 kata. Jika catatan melebihi batas ini, pengguna akan mendapat pesan error.
- **Tampilan Responsif**: Menggunakan CSS sederhana untuk menjaga antarmuka tetap rapi dan mudah digunakan.
- **Database SQLite**: Data catatan disimpan dalam database SQLite lokal.

## Struktur Proyek

Berikut adalah struktur file dalam proyek ini:

0. /
1. ├── database.db # File database SQLite 
2. ├── db.php # File proses penyimpanan catatan baru 
3. ├── proses_edit.php # File proses penyimpanan catatan setelah diedit 
4. ├── edit.php # Halaman untuk mengedit catatan 
5. ├── hapus.php # File proses penghapusan catatan 
5. ├── index.php # Halaman utama (sama dengan tampilan.php) 
6. ├── tampilan.php # Halaman tampilan utama (daftar catatan) 
7. ├── style.css # File CSS untuk mengatur tampilan aplikasi 
8. └── README.md # Penjelasan proyek (file ini)

## File Penting

### 1. **database.db**

File ini adalah database SQLite yang menyimpan semua catatan yang dibuat oleh pengguna. Setiap catatan disimpan dengan kolom:
- **id** (Primary Key)
- **konten** (Teks catatan)
- **tanggal** (Tanggal pembuatan, format `YYYY-MM-DD`)

### 2. **db.php**

File ini menangani proses penambahan catatan baru. Saat pengguna menulis catatan di form pada halaman utama (`tampilan.php`), file ini akan:
- Memvalidasi apakah catatan berisi kurang dari 1000 kata.
- Menyimpan catatan ke database jika valid.
- Mengembalikan pengguna ke halaman utama setelah catatan ditambahkan.

### 3. **proses_edit.php**

File ini menangani proses penyimpanan perubahan setelah pengguna mengedit catatan. Prosesnya hampir sama dengan `db.php`:
- Mengambil konten catatan yang diedit oleh pengguna.
- Memperbarui catatan di database berdasarkan **id** catatan yang diterima dari form.

### 4. **edit.php**

Halaman ini memungkinkan pengguna untuk mengedit catatan yang sudah ada. Saat pengguna membuka halaman ini dengan mengklik tombol edit di samping catatan, form dengan isi catatan saat ini akan muncul dan bisa diedit. Setelah diedit, data dikirim ke `proses_edit.php` untuk disimpan kembali.

### 5. **hapus.php**

File ini bertanggung jawab untuk menghapus catatan. Saat pengguna mengklik tombol "Hapus", file ini menerima **id** catatan yang ingin dihapus dan menghapus catatan tersebut dari database.

### 6. **tampilan.php (atau index.php)**

Halaman ini adalah halaman utama dari aplikasi. Di sini, pengguna bisa:
- Membuat catatan baru.
- Melihat daftar semua catatan yang sudah ada dalam bentuk tabel.
- Mengedit atau menghapus catatan melalui tombol yang tersedia.

### 7. **style.css**

File ini memuat semua aturan CSS untuk menjaga tampilan aplikasi tetap bersih dan rapi. Beberapa gaya utama yang digunakan:
- **Header**: Menampilkan judul aplikasi dan tombol logout.
- **Form**: Mengatur tampilan form untuk menulis dan mengedit catatan.
- **Tabel**: Untuk menampilkan daftar catatan yang sudah ada dalam bentuk tabel.
- **Tombol**: Mengatur gaya tombol untuk tindakan seperti simpan, edit, dan hapus.

## Cara Menggunakan

1. **Setup Database**: Pastikan file `database.db` sudah ada di folder proyek. Jika belum, Anda bisa membuatnya secara otomatis saat aplikasi pertama kali dijalankan.
2. **Akses Halaman Utama**: Buka `tampilan.php` atau `index.php` di browser untuk mulai menggunakan aplikasi.
3. **Buat Catatan Baru**: Di halaman utama, tulis catatan di form dan klik tombol "Simpan Catatan".
4. **Edit atau Hapus Catatan**: Setiap catatan yang sudah tersimpan akan muncul dalam tabel. Gunakan tombol "Edit" untuk mengedit atau "Hapus" untuk menghapus catatan.

## Validasi dan Notifikasi

- Jika pengguna mencoba menambahkan catatan yang lebih dari 1000 kata, pesan error akan muncul di halaman.
- Jika catatan berhasil disimpan, pengguna akan mendapatkan notifikasi sukses.

## Persyaratan

- **PHP**: Pastikan server Anda mendukung PHP versi 7.0 atau lebih baru.
- **SQLite**: Aplikasi menggunakan SQLite sebagai basis datanya. SQLite sudah termasuk dalam distribusi PHP secara default.

## Lisensi

Proyek ini adalah open-source dan bisa digunakan atau dimodifikasi sesuai dengan kebutuhan Anda.
