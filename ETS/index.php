<?php
// Start the session
session_start();

// Redirect to login page if no admin session is set
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();  // Important to prevent further script execution
}

// Include your database connection and header files
include 'koneksi.php';

// Check if a search was submitted and sanitize the input
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Pagination setup
$results_per_page = 5; // Number of results per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$start_from = ($page - 1) * $results_per_page; // Calculate offset for SQL query

// Fetch total records to calculate total pages
$total_sql = "SELECT COUNT(*) AS total FROM karyawan WHERE nama LIKE '%$search%' OR jabatan LIKE '%$search%' OR email LIKE '%$search%'";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $results_per_page); // Total pages

// Fetch limited results based on current page
$sql = "SELECT * FROM karyawan WHERE nama LIKE '%$search%' OR jabatan LIKE '%$search%' OR email LIKE '%$search%' LIMIT $start_from, $results_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <h1 class="title">Daftar Karyawan</h1>
        <nav class="navbar-nav">
            <a href="newadmin.php" class="nav-link">Add New Admin</a>
            <a href="create.php" class="nav-link">Add New Employee</a>
            <a href="logout.php" class="nav-link">Log Out</a>
        </nav>
    </div>

    <br>

    <div class="main-content">
        <form action="index.php" method="GET">
            <input type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Search</button>
        </form>

        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"><?= $_SESSION['success']; ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Foto Profil</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_karyawan']; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['jabatan']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td>
                                <?php if ($row['foto_profil']): ?>
                                    <img src="uploads/<?= htmlspecialchars($row['foto_profil']); ?>" alt="Foto Profil" width="50">
                                <?php else: ?>
                                    No Photo Available
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="edit.php" method="GET" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $row['id_karyawan']; ?>">
                                    <button type="submit" class="action-btn edit-btn">Edit</button>
                                </form>
                                <form action="delete.php" method="GET" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $row['id_karyawan']; ?>">
                                    <button type="submit" class="action-btn delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No employees found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="index.php?page=<?= $page - 1; ?>&search=<?= urlencode($search); ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="index.php?page=<?= $i; ?>&search=<?= urlencode($search); ?>" <?= $i === $page ? 'class="active"' : ''; ?>><?= $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="index.php?page=<?= $page + 1; ?>&search=<?= urlencode($search); ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
