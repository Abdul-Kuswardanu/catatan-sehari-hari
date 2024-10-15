<?php
// Koneksi ke SQLite
$db = new SQLite3('database.db');

// Membuat tabel catatan jika belum ada
$db->exec("CREATE TABLE IF NOT EXISTS catatan (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    konten TEXT NOT NULL,
    tanggal DATE DEFAULT (DATE('now'))
)");

// Cek apakah form disubmit (menambah atau mengedit catatan)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $konten = trim($_POST['konten']); // Ambil konten dari form
    $word_count = str_word_count($konten); // Hitung jumlah kata

    // Validasi jumlah kata
    if ($word_count > 1000) {
        $_SESSION['error'] = "Catatan tidak boleh lebih dari 1000 kata. Saat ini ada $word_count kata.";
        header('location: tampilan.php');
        exit();
    } else {
        // Jika ada ID, berarti user mengedit catatan yang sudah ada
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Mengedit catatan yang sudah ada
            $id = $_POST['id'];
            $stmt = $db->prepare('UPDATE catatan SET konten = :konten WHERE id = :id');
            $stmt->bindValue(':konten', $konten, SQLITE3_TEXT);
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $stmt->execute();
            $_SESSION['success'] = "Catatan berhasil diperbarui!";
        } else {
            // Menambahkan catatan baru
            $stmt = $db->prepare('INSERT INTO catatan (konten) VALUES (:konten)');
            $stmt->bindValue(':konten', $konten, SQLITE3_TEXT);
            $stmt->execute();
        }
        // Redirect ke tampilan.php setelah berhasil
        header('location: tampilan.php');
        exit();
    }
}
?>
