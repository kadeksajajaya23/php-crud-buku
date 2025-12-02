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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Data Buku</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="cover_lama" value="<?= $buku->cover ?>">

                            <div class="mb-3">
                                <label class="form-label">Judul Buku</label>
                                <input type="text" name="judul" class="form-control" value="<?= $buku->judul ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Penulis</label>
                                    <input type="text" name="penulis" class="form-control" value="<?= $buku->penulis ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" class="form-control" value="<?= $buku->tahun_terbit ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <select name="genre" class="form-select">
                                    <option value="Novel" <?= ($buku->genre == 'Novel')?'selected':'' ?>>Novel</option>
                                    <option value="Komik" <?= ($buku->genre == 'Komik')?'selected':'' ?>>Komik</option>
                                    <option value="Edukasi" <?= ($buku->genre == 'Edukasi')?'selected':'' ?>>Edukasi</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Cover Saat Ini</label>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="uploads/<?= $buku->cover ?>" class="img-thumbnail" style="height: 100px;">
                                    <div class="flex-grow-1">
                                        <label class="form-label small text-muted">Ganti Cover (Opsional)</label>
                                        <input type="file" name="cover" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning btn-lg">Update Data</button>
                                <a href="index.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>