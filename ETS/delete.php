<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
    $stmt->bind_param("i", $id);  // 'i' specifies the variable type => 'integer'

    // Execute the statement
    if ($stmt->execute()) {
        echo "Karyawan berhasil di hapus";
        header('Location: index.php');
        exit();
    } else {
        echo "Gagal menghapus karyawan: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "ID karyawan tidak ditemukan.";
}

// Close connection
$conn->close();
?>
