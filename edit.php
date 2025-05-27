<?php
include 'koneksi.php';

    $nim = $_GET['nim']; // ambil NIM dari URL
    // jalankan query utk ambil data mahasiswa based on nim
    $query = mysqli_query($koneksi, "select * from mahasiswa WHERE nim=$nim");
    $data = mysqli_fetch_array($query);

    //ambil data prodi
    $sql_prodi = "SELECT id_prodi, nama_prodi FROM prodi";
    $result_prodi = $koneksi->query($sql_prodi);

    if (!$result_prodi) {
        die("Query prodi gagal: " . $koneksi->error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
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
    <h2>Halaman edit mahasiswa</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="old_nim" value="<?=$data['nim']?>"> // menyimpan NIM lama untuk update
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?=$data['nim']?>">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?=$data['nama']?>">
        </div>
        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="number" class="form-control" id="angkatan" name="angkatan" value="<?=$data['angkatan']?>">
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi</label>
            <select class="form-select" id="prodi" name="prodi" value="<?=$data['id_prodi']?>">
            <option value="">Pilih Prodi</option>
            <?php
                if ($result_prodi->num_rows > 0) {
                $result_prodi->data_seek(0);
                    while ($row_prodi = $result_prodi->fetch_assoc()) {
                    $selected = ($row_prodi['id_prodi'] == $data['id_prodi']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($row_prodi['id_prodi']) . "' $selected>" . htmlspecialchars($row_prodi['nama_prodi']) . "</option>";
}

                } else { echo "<option value=''>Tidak ada prodi</option>";}?>
            </select>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>