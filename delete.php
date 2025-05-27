<?php
session_start();
include 'koneksi.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // jalankan query delete by nim
    $query = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim = '$nim'");

    if ($query) {
        $_SESSION['success_message'] = "Berhasil hapus data mahasiswa";
    } else {
        $_SESSION['error_message'] = "Gagal menghapus data: " . mysqli_error($koneksi);
    }

    header("Location: home.php");
    exit();
} else {
    $_SESSION['error_message'] = "Data tidak ditemukan.";
    header("Location: home.php");
    exit();
}
?>
