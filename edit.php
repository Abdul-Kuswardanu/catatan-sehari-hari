<?php
$db = new SQLite3('database.db');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $db->prepare('SELECT * FROM catatan WHERE id = :id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if (!$result) {
        die("Catatan tidak ditemukan.");
    }
} else {
    die("ID catatan tidak valid.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan</title>
    <link rel="stylesheet" href="tampilan.css">
</head>
<body>

    <header>
        <div class="judul">Edit Catatan</div>
        <div class="keluar"><a href="logout.php">Keluar</a></div>
    </header>

    <div class="container">
        <h2>Edit Catatan</h2><br>

        <form action="proses_edit.php" method="POST">
            <label for="konten">Catatan:</label>
            <textarea name="konten" rows="10" cols="50" required><?php echo htmlspecialchars($result['konten']); ?></textarea><br>
            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <button type="submit">Simpan Perubahan</button><br><br>
        </form>

        <p><a href="tampilan.php">Kembali ke Halaman Utama</a></p>
    </div>

</body>
</html>
