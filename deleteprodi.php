<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id_prodi'])) {
    $id = $_GET['id_prodi'];

    // jalankan query DELETE
    $query = mysqli_query($koneksi, "DELETE FROM prodi WHERE id_prodi = '$id'");

    if ($query) {
        $_SESSION['success_message'] = "Berhasil hapus data prodi";
    } else {
        $_SESSION['error_message'] = "Gagal menghapus data: " . mysqli_error($koneksi);
    }

    header("Location: prodi.php");
    exit();
} else {
    $_SESSION['error_message'] = "Data tidak ditemukan.";
    header("Location: prodi.php");
    exit();
}
?>
