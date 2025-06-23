<?php
// Selalu mulai sesi di paling atas
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db/db_connect.php';

// Keamanan: Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Keamanan: Pastikan halaman ini diakses via metode POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('Location: index.php');
    exit();
}

// Keamanan: Pastikan data yang dibutuhkan ada
if (!isset($_POST['course_id']) || !isset($_POST['payment_method'])) {
    header('Location: courses.php');
    exit();
}

// Pengambilan Data
$user_id = $_SESSION['user_id'];
$course_id = $_POST['course_id'];
$payment_method = $_POST['payment_method'];
$enroll_id = 0; // Inisialisasi variabel enroll_id

// Cek dulu apakah pengguna sudah terdaftar
$check_stmt = $conn->prepare("SELECT id FROM pendaftar WHERE user_id = ? AND course_id = ?");
$check_stmt->bind_param("ii", $user_id, $course_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // --- JIKA PENGGUNA SUDAH TERDAFTAR ---
    $pendaftar = $check_result->fetch_assoc();
    $enroll_id = $pendaftar['id']; // Ambil ID pendaftaran yang sudah ada
} else {
    // --- JIKA INI PENDAFTARAN BARU ---
    $insert_stmt = $conn->prepare("INSERT INTO pendaftar (user_id, course_id) VALUES (?, ?)");
    $insert_stmt->bind_param("ii", $user_id, $course_id);
    $insert_stmt->execute();
    $enroll_id = $insert_stmt->insert_id; // Ambil ID pendaftaran yang BARU saja dibuat
    $insert_stmt->close();
}
$check_stmt->close();

// Ambil harga kelas untuk ditampilkan
$course_stmt = $conn->prepare("SELECT price FROM courses WHERE id = ?");
$course_stmt->bind_param("i", $course_id);
$course_stmt->execute();
$course = $course_stmt->get_result()->fetch_assoc();
$amount = $course['price'];
$course_stmt->close();

// Persiapan Info Pembayaran Dummy
$payment_details = [];
switch ($payment_method) {
    case 'BCA_VA':
        $payment_details['method'] = 'BCA Virtual Account';
        $payment_details['instructions'] = 'Silakan lakukan pembayaran ke nomor Virtual Account di bawah ini:';
        $payment_details['account_number'] = '8808 ' . rand(1000, 9999) . ' ' . rand(1000, 9999);
        break;
    case 'GOPAY':
        $payment_details['method'] = 'GoPay';
        $payment_details['instructions'] = 'Silakan scan QR Code di bawah ini menggunakan aplikasi Gojek Anda.';
        $payment_details['account_number'] = 'gopay.jpg';
        break;
    case 'OVO':
        $payment_details['method'] = 'OVO';
        $payment_details['instructions'] = 'Pembayaran akan muncul di aplikasi OVO Anda dalam 1 menit. Silakan buka aplikasi dan selesaikan pembayaran.';
        $payment_details['account_number'] = $_SESSION['username'];
        break;
}

$payment_details['enroll_id'] = $enroll_id;
$payment_details['amount'] = $amount;
$_SESSION['payment_details'] = $payment_details;

// Redirect ke halaman konfirmasi
header('Location: confirmation.php');
exit();
?>