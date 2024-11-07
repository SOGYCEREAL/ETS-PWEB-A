<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM karyawan WHERE id_karyawan='$id'";
$result = $conn->query($query);
$karyawan = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $email = $_POST['email'];
    $fotoProfil = $_FILES['foto']['name'] ? $_FILES['foto']['name'] : $karyawan['foto_profil'];
    $targetDir = "uploads/";

    if ($_FILES['foto']['name']) {
        move_uploaded_file($_FILES['foto']['tmp_name'], $targetDir . $fotoProfil);
    }

    $query = "UPDATE karyawan SET nama='$nama', jabatan='$jabatan', email='$email', foto_profil='$fotoProfil' WHERE id_karyawan='$id'";
    if ($conn->query($query)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Gagal mengupdate karyawan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
    <link rel="stylesheet" href="stylesedit.css">
</head>
<body>

<div class="form-container">
    <h2>Edit Karyawan</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($karyawan['nama']); ?>" required>

        <label>Jabatan:</label>
        <input type="text" name="jabatan" value="<?= htmlspecialchars($karyawan['jabatan']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($karyawan['email']); ?>" required>

        <label>Foto Profil:</label>
        <div class="profile-pic">
            <?php if (!empty($karyawan['foto_profil'])): ?>
                <img src="uploads/<?= htmlspecialchars($karyawan['foto_profil']); ?>" alt="Current Profile Picture">
            <?php else: ?>
                <img src="uploads/default.png" alt="Default Profile Picture"> <!-- Adjust the path if necessary -->
            <?php endif; ?>
            <label>
                <input type="file" name="foto">
            </label>
        </div>
        <br>
        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
