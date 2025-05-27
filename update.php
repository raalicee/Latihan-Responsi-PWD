<?php
session_start();
include 'koneksi.php';

// ambil data yang dikirim dari form edit
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$angkatan = $_POST['angkatan'];
$id_prodi = $_POST['prodi'];
$old_nim = $_POST['old_nim'];
// memperbarui data pada baris mahasiswa yg nimn ya sama dengan old nim
$query = mysqli_query($koneksi, "UPDATE mahasiswa SET nim='$nim', nama='$nama', angkatan='$angkatan', id_prodi='$id_prodi' WHERE nim='$old_nim'");

if ($query) {
    $_SESSION['success_message'] = "Berhasil edit data mahasiswa.";
} else {
    $_SESSION['error_message'] = "Gagal mengupdate data mahasiswa: " . mysqli_error($koneksi);
}

header("Location: home.php");
exit();
?>
