<?php
include 'koneksi.php';

$search_query = "";
$is_search = false;

// cek apakah parameter search ada dan tidak kosong di URL 
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = $koneksi->real_escape_string($_GET['search']);
    $is_search = true;
    // query pencarian mahasiswa berdasarkan nama.
    $sql_mahasiswa = "SELECT m.nim, m.nama, m.angkatan, p.nama_prodi, p.id_prodi 
                      FROM mahasiswa m
                      JOIN prodi p ON m.id_prodi = p.id_prodi
                      WHERE m.nama LIKE '%$search_query%'";
} else {
    
    $sql_mahasiswa = "SELECT m.nim, m.nama, m.angkatan, p.nama_prodi, p.id_prodi
                      FROM mahasiswa m
                      JOIN prodi p ON m.id_prodi = p.id_prodi";
}

$result_mahasiswa = $koneksi->query($sql_mahasiswa); // jalankan query dan simpan hasil ke result_mahasiswa 
if (!$result_mahasiswa) {
    die("Query mahasiswa gagal: " . $koneksi->error . " | Query: " . $sql_mahasiswa);
}
?>