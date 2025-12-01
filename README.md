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
* **Arsitektur:** Modular (Pemisahan: `config/`, `src/`, View utama)

### Struktur Folder Inti
```text
tugas_buku/
├── config/           # Konfigurasi koneksi (Database.php)
├── src/              # Logika Bisnis (Buku.php)
├── uploads/          # Tempat penyimpanan file cover
├── index.php         # Tampilan Utama (READ)
└── schema.sql        # File struktur tabel