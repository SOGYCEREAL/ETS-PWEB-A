<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'manajemen_karyawan';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>