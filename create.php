<?php
include_once 'config/Database.php';
include_once 'src/Buku.php';

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $buku = new Buku($db);

    $buku->judul = $_POST['judul'];
    $buku->penulis = $_POST['penulis'];
    $buku->tahun_terbit = $_POST['tahun_terbit'];
    $buku->genre = $_POST['genre'];

    // Handle Upload
    $cover = $_FILES['cover'];
    $target_dir = "uploads/";
    $fileType = strtolower(pathinfo($cover['name'], PATHINFO_EXTENSION));
    $fileName = time() . "_" . basename($cover['name']);
    $targetFilePath = $target_dir . $fileName;

    // Validasi: Ukuran < 2MB dan Tipe File
    if($cover['size'] < 2000000 && in_array($fileType, ['jpg','png','jpeg'])) {
        if(move_uploaded_file($cover['tmp_name'], $targetFilePath)){
            $buku->cover = $fileName;
            if ($buku->create()) { header("Location: index.php"); }
        } else { echo "Gagal upload."; }
    } else { echo "File harus JPG/PNG dan maksimal 2MB."; }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h3>Tambah Buku</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul" required><br><br>
        <input type="text" name="penulis" placeholder="Penulis" required><br><br>
        <input type="number" name="tahun_terbit" placeholder="Tahun" required><br><br>
        <select name="genre">
            <option value="Novel">Novel</option>
            <option value="Komik">Komik</option>
            <option value="Edukasi">Edukasi</option>
        </select><br><br>
        <input type="file" name="cover" required><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>