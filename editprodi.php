<?php
include 'koneksi.php';
    if (!isset($_GET['id_prodi']) || empty($_GET['id_prodi'])) {
    die("ID Prodi tidak ditemukan.");
}

$id_prodi = $_GET['id_prodi'];

// ambil data prodi dari database
$query = mysqli_query($koneksi, "SELECT id_prodi, nama_prodi FROM prodi WHERE id_prodi = $id_prodi");
$data = mysqli_fetch_array($query);

if (!$data) {
    die("Data prodi tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <h3 class="navbar-brand" style="padding-top: 10px;">Dashboard Mahasiswa</h3>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Home</a> </li>
                    <li class="nav-item">
                        <a class="nav-link" href="prodi.php">Prodi</a> </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link logout-link" style="color: red !important;" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="form" >
    <h2>Halaman edit prodi</h2>
    <form action="updateprodi.php" method="POST">
    <input type="hidden" name="id_prodi" value="<?= $data['id_prodi'] ?>"> // simpan ID Prodi untuk update
    
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama_prodi'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>