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

### 3. Struktur Folder Inti
```text
tugas_buku/
├── config/           # Konfigurasi koneksi (Database.php)
├── src/              # Logika Bisnis (Buku.php)
├── uploads/          # Tempat penyimpanan file cover
├── index.php         # Tampilan Utama (READ)
└── schema.sql        # File struktur tabel

## 4. Cara Kerja Aplikasi

Aplikasi ini memisahkan penyimpanan **data teks** dan **file gambar**:

1.  **Tambah Data (Upload):**
    Saat Anda menambah buku, foto fisik disimpan ke folder `uploads/`, sedangkan database hanya menyimpan **nama file**-nya saja (contoh: `foto1.jpg`).

2.  **Tampil Data (Read):**
    Aplikasi membaca nama file dari database, lalu mengambil gambar asli dari folder `uploads/` untuk ditampilkan di layar.

3.  **Edit Data (Update):**
    Sistem pintar mendeteksi:
    * Jika Anda **mengupload foto baru**: Foto lama otomatis dihapus dari folder dan diganti foto baru.
    * Jika **dikosongkan**: Aplikasi tetap memakai foto yang lama.

4.  **Hapus Data (Delete):**
    Saat menghapus buku, sistem tidak hanya menghapus tulisan di database, tapi juga **menghapus file foto** di folder `uploads/` agar server tidak penuh sampah.