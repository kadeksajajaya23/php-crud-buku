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

    $cover = $_FILES['cover'];
    $target_dir = "uploads/";
    $fileType = strtolower(pathinfo($cover['name'], PATHINFO_EXTENSION));
    $fileName = time() . "_" . basename($cover['name']);
    $targetFilePath = $target_dir . $fileName;

    if($cover['size'] < 2000000 && in_array($fileType, ['jpg','png','jpeg'])) {
        if(move_uploaded_file($cover['tmp_name'], $targetFilePath)){
            $buku->cover = $fileName;
            if ($buku->create()) { 
                // Redirect dengan parameter sukses
                header("Location: index.php?status=success"); 
                exit;
            }
        }
    }
    // Jika gagal (Logic sederhana untuk demo)
    echo "<script>alert('Gagal Upload/Simpan');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Tambah Buku Baru</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label">Judul Buku</label>
                                <input type="text" name="judul" class="form-control" placeholder="Contoh: Laskar Pelangi" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Penulis</label>
                                    <input type="text" name="penulis" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" class="form-control" min="1900" max="2099" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <select name="genre" class="form-select">
                                    <option value="Novel">Novel</option>
                                    <option value="Komik">Komik</option>
                                    <option value="Edukasi">Edukasi</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Upload Cover</label>
                                <input type="file" name="cover" id="coverInput" class="form-control" accept="image/*" onchange="previewImage()" required>
                                <div class="mt-3 text-center">
                                    <img id="preview" src="#" alt="Preview Cover" class="img-thumbnail d-none" style="max-height: 200px;">
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">Simpan Buku</button>
                                <a href="index.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const file = document.getElementById("coverInput").files[0];
            const preview = document.getElementById("preview");
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove("d-none");
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>