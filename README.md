# Tugas 1: Aplikasi CRUD Perpustakaan Sederhana

**Nama :** [I KADEK SAJA JAYA]
**NIM:** [240030215]

---

## 1. Deskripsi Aplikasi

Aplikasi ini adalah implementasi back-end sederhana untuk **Manajemen Data Buku** dengan Entitas Domain: `Buku`.

### Entitas Domain: Buku
* **Text Field:** Judul, Penulis
* **Numeric Field:** Tahun Terbit
* **Select/Option:** Genre (`Novel`, `Komik`, `Edukasi`)
* **File Upload:** Cover Buku (`.jpg`/`.png`)

## 2. Spesifikasi Teknis

* **Bahasa Pemrograman:** PHP 8.x (Native)
* **Basis Data:** MySQL / MariaDB
* **Driver Basis Data:** PDO (PHP Data Objects)

## 3. Cara Kerja Aplikasi (Alur Logika)


### A. Create (Tambah Data)
1.  Saat pengguna mengunggah cover, sistem memvalidasi ekstensi (JPG/PNG) dan ukuran file (< 2MB).
2.  File fisik dipindahkan ke folder `uploads/` dengan nama unik.
3.  Nama file dan data teks disimpan ke tabel database menggunakan .

### B. Read (Tampil Data)
1.  Sistem mengambil data dari database.
2.  Untuk menampilkan cover, HTML memanggil path `src="uploads/[nama_file_dari_db]"`.

### C. Update (Ubah Data)
Sistem menggunakan logika kondisional untuk penggantian file:
* **Jika ada file baru diunggah:** File lama dihapus fisik dari server, file baru diunggah, dan nama file di database diperbarui.
* **Jika file kosong:** Sistem mempertahankan nama file lama yang ada di database.

### D. Delete (Hapus Data)
1.  Sistem mencari nama file berdasarkan ID buku.
2.  Record data dihapus dari database.
3.  File fisik gambar dihapus secara otomatis dari folder.

## 4. Struktur Folder


```text
Project_1/
├── config/
│   └── Database.php      # Class khusus untuk koneksi PDO ke DB
├── src/
│   └── Buku.php          # Class Entity berisi properti dan method CRUD
├── database/
│   └── schema.sql        # File SQL untuk membuat tabel database
├── uploads/              # Folder penyimpanan cover buku
├── index.php             # Halaman Utama 
├── tambah.php            # Halaman Form untuk menambah data
├── edit.php              # Halaman Form untuk mengubah data
├── hapus.php             # untuk menghapus data
└── README.md             # Dokumentasi proyek ini