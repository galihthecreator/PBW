<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db/db_connect.php';

// Keamanan: pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Keamanan: pastikan enroll_id ada dan valid
if (!isset($_GET['enroll_id']) || !is_numeric($_GET['enroll_id'])) {
    header('Location: index.php');
    exit();
}

$enroll_id = $_GET['enroll_id'];
$user_id = $_SESSION['user_id'];

// Update status pembayaran menjadi 'completed'
$stmt = $conn->prepare("UPDATE pendaftar SET status_pembayaran = 'completed' WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $enroll_id, $user_id);
$stmt->execute();
$stmt->close();

// Siapkan pesan notifikasi sukses untuk ditampilkan di halaman selanjutnya
$_SESSION['flash_message'] = "Pembayaran berhasil! Selamat belajar.";

// Arahkan pengguna ke halaman "Kelas Saya"
header('Location: dashboard.php');
exit();
?>