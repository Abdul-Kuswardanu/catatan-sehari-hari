<?php
$db = new SQLite3('database.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $konten = trim($_POST['konten']);

    if (empty($konten)) {
        die("Konten catatan tidak boleh kosong.");
    }

    $stmt = $db->prepare('UPDATE catatan SET konten = :konten WHERE id = :id');
    $stmt->bindValue(':konten', $konten, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    session_start();
    // $_SESSION['success'] = "Catatan berhasil diperbarui!";
    header("Location: tampilan.php");
    exit();
} else {
    die("Permintaan tidak valid.");
}