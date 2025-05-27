<?php
$hostname = "localhost"; 
$username = "root";
$password = "";
$database = "responsi";

$koneksi = new mysqli($hostname, $username, $password, $database);

// utk cek koneksi berhasil atau tidak
if($koneksi->connect_error){
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>