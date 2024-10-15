<?php
// Koneksi ke SQLite
$db = new SQLite3('database.db');

// Mengecek apakah ID ada dan valid
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // Query untuk menghapus catatan berdasarkan ID
    $stmt = $db->prepare('DELETE FROM catatan WHERE id = :id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
    header('location: tampilan.php');
} else{
    echo "<center><a href='tampilan.php'>Gagal Menghapus</center>";
}
