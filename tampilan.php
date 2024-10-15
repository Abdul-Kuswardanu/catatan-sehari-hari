<?php
$db = new SQLite3('database.db');

$results = $db->query('SELECT * FROM catatan ORDER BY tanggal DESC');

$catatan = [];
if ($results) {
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $catatan[] = $row; 
    }
}
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Catatan</title>
    <link rel="stylesheet" href="tampilan.css">
    <link rel="stylesheet" href="table.css">
</head>
<body>

    <header>
        <div class="judul">Saatnya Mencatat</div>
        <div class="keluar"><a href="logout.php">Keluar</a></div>
    </header>

    <div class="container">
        <h2>Buat Catatan Baru</h2><br>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red;"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <p style="color:green;"><?php echo $_SESSION['success']; ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="db.php" method="POST">
            <textarea name="konten" rows="10" placeholder="Tulis catatan Anda di sini..." required></textarea>
            <button type="submit">Simpan Catatan</button><br><br>
        </form>
        <h3>Catatan Tersimpan</h3><br>
        <?php if (empty($catatan)): ?>
            <p>Belum ada catatan yang tersimpan.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Konten Catatan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($catatan as $index => $row): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($row['konten']); ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td>
                                <!-- Link untuk mengedit catatan -->
                                <a href="edit.php?id=<?php echo $row['id']; ?>">
                                    <button>Edit</button>
                                </a>
                                <!-- Form untuk menghapus catatan -->
                                <form action="hapus.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>