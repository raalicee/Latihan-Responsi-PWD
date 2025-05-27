<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'tambah_mahasiswa') {
    // ambil data dari form
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $angkatan = $_POST['angkatan'];
    $id_prodi = $_POST['prodi'];

    // cek apakah NIM sudah ada (validasi)
    $check_nim_sql = "SELECT nim FROM mahasiswa WHERE nim = '$nim'";
    $check_nim_result = $koneksi->query($check_nim_sql);

    if ($check_nim_result->num_rows > 0) {
        $_SESSION['error_message'] = "NIM $nim sudah terdaftar. Tidak bisa menambahkan data.";
        header("Location: home.php");
        exit();
    }

    // query utk insert data mhs baru
    $insert_query = "INSERT INTO mahasiswa (nim, nama, angkatan, id_prodi) VALUES ('$nim', '$nama', '$angkatan', '$id_prodi')";

    if ($koneksi->query($insert_query) === TRUE) {
        $_SESSION['success_message'] = "Berhasil insert data mahasiswa.";
        header("Location: home.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error saat menambahkan data mahasiswa: " . $koneksi->error . " | Query: " . $insert_sql;
        header("Location: home.php");
        exit();
    }
}
?>