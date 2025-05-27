<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'tambah_prodi') {
    // ambil data dari form
    $nama_prodi = $_POST['nama'];

    // query insert data prodi baru
    $query = "INSERT INTO prodi (nama_prodi) VALUES ('$nama_prodi')";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success_message'] = "Berhasil insert data prodi.";
        header("Location: prodi.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Gagal menambahkan data prodi : " . mysqli_error($koneksi);
        header("Location: prodi.php");
        exit();
    }
}
?>