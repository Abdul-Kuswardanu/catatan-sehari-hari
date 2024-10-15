<?php
// Mulai sesi
session_start();

// Hapus semua sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login atau beranda
header("Location: tampilan.php");
exit;
?>