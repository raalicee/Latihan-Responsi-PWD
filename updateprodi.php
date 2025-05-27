<?php 
session_start();
include 'koneksi.php';

// ambil data dari form
$id_prodi = $_POST['id_prodi'];
$nama_prodi = $_POST['nama'];

// query update
$query = mysqli_query($koneksi, "UPDATE prodi SET nama_prodi='$nama_prodi' WHERE id_prodi='$id_prodi'");

if ($query) {
    $_SESSION['success_message'] = "Berhasil edit data prodi.";
} else {
    $_SESSION['error_message'] = "Gagal mengupdate data prodi: " . mysqli_error($koneksi);
}

header("Location: prodi.php");
exit();
?>
