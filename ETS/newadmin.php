<?php
include 'koneksi.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the query to insert only `username` and `password`
    $query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($query) === TRUE) {
        $message = "Admin registered successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="stylesnewadmin.css">
</head>
<body>

<div class="form-container">
    <h2>Register Admin</h2>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <br>
        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
