<?php
include 'koneksi.php'; // Ensure the database connection is correct

$upload_dir = 'uploads/';
$defaultImagePath = 'default.png'; // Path to the default profile picture

// Create the uploads directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $email = $_POST['email'];
    $fotoProfil = $defaultImagePath; // Default image if none uploaded

    if (!empty($_FILES['foto']['name'])) {
        $fotoProfil = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        $upload_path = $upload_dir . basename($fotoProfil);

        // Move the uploaded file
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // File uploaded successfully
        } else {
            echo "Failed to upload photo! Using default photo.";
            $fotoProfil = $defaultImagePath; // Use default image if upload fails
        }
    }

    // Prepare and bind parameters to prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO karyawan (nama, jabatan, email, foto_profil) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $jabatan, $email, $fotoProfil);
    
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Failed to add employee: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="stylescreate.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Employee</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>Jabatan:</label>
            <input type="text" name="jabatan" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Foto Profil:</label>
            <div class="profile-pic">
                <img src="uploads/default.png" alt="Default Profile Picture"> <!-- Display default profile picture initially -->
                <label>
                    <input type="file" name="foto">
                </label>
            </div>

            <br>
            <button type="submit">Add</button>
        </form>
    </div>
</body>
</html>
