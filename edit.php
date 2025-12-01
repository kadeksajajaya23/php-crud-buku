<?php
include_once 'config/Database.php';
include_once 'src/Buku.php';

$database = new Database();
$db = $database->getConnection();
$buku = new Buku($db);
$buku->id = isset($_GET['id']) ? $_GET['id'] : die('ID Error');
$buku->readOne();

if ($_POST) {
    $buku->judul = $_POST['judul'];
    $buku->penulis = $_POST['penulis'];
    $buku->tahun_terbit = $_POST['tahun_terbit'];
    $buku->genre = $_POST['genre'];
    $cover_lama = $_POST['cover_lama'];

    if(!empty($_FILES['cover']['name'])) {
        $fileName = time() . "_" . basename($_FILES['cover']['name']);
        move_uploaded_file($_FILES['cover']['tmp_name'], "uploads/" . $fileName);
        $buku->cover = $fileName;
        if(file_exists("uploads/".$cover_lama)) unlink("uploads/".$cover_lama);
    } else {
        $buku->cover = $cover_lama;
    }

    if ($buku->update()) header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<body>
    <h3>Edit Buku</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cover_lama" value="<?= $buku->cover ?>">
        <input type="text" name="judul" value="<?= $buku->judul ?>" required><br><br>
        <input type="text" name="penulis" value="<?= $buku->penulis ?>" required><br><br>
        <input type="number" name="tahun_terbit" value="<?= $buku->tahun_terbit ?>" required><br><br>
        <select name="genre">
            <option value="Novel" <?= ($buku->genre == 'Novel')?'selected':'' ?>>Novel</option>
            <option value="Komik" <?= ($buku->genre == 'Komik')?'selected':'' ?>>Komik</option>
            <option value="Edukasi" <?= ($buku->genre == 'Edukasi')?'selected':'' ?>>Edukasi</option>
        </select><br><br>
        <img src="uploads/<?= $buku->cover ?>" width="50"><br>
        <input type="file" name="cover"><small>(Biarkan kosong jika tidak ganti)</small><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>