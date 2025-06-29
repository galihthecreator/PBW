<?php
// Selalu mulai sesi di paling atas
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db/db_connect.php';

// --- VALIDASI & KEAMANAN ---

// 1. Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// 2. Pastikan halaman ini diakses via metode POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('Location: index.php');
    exit();
}

// 3. Pastikan keranjang tidak kosong dan metode pembayaran dipilih
if (empty($_SESSION['cart']) || !isset($_POST['payment_method'])) {
    header('Location: keranjang.php');
    exit();
}

// --- PENGAMBILAN DATA ---
$user_id = $_SESSION['user_id'];
$cart_items = $_SESSION['cart']; // Ini adalah array ID kelas
$payment_method = $_POST['payment_method'];
$total_price = 0;

// --- PROSES PENDAFTARAN SEMUA KELAS DI KERANJANG ---

// Kita gunakan perulangan untuk mendaftarkan setiap kelas satu per satu
foreach ($cart_items as $course_id) {
    // Cek dulu apakah pengguna sudah terdaftar di kelas ini
    $check_stmt = $conn->prepare("SELECT id FROM pendaftar WHERE user_id = ? AND course_id = ?");
    $check_stmt->bind_param("ii", $user_id, $course_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    // Jika belum terdaftar, baru kita daftarkan
    if ($check_result->num_rows === 0) {
        $insert_stmt = $conn->prepare("INSERT INTO pendaftar (user_id, course_id) VALUES (?, ?)");
        $insert_stmt->bind_param("ii", $user_id, $course_id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }
    $check_stmt->close();
}

// --- PERSIAPAN INFO PEMBAYARAN DUMMY ---

// Hitung ulang total harga untuk keamanan
$placeholders = implode(',', array_fill(0, count($cart_items), '?'));
$types = str_repeat('i', count($cart_items));
$sql = "SELECT SUM(price) as total FROM courses WHERE id IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$cart_items);
$stmt->execute();
$total_price = $stmt->get_result()->fetch_assoc()['total'];
$stmt->close();


$payment_details = [];
switch ($payment_method) {
    case 'BCA_VA':
        $payment_details['method'] = 'BCA Virtual Account';
        $payment_details['instructions'] = 'Silakan lakukan pembayaran ke nomor Virtual Account di bawah ini untuk total tagihan Anda:';
        $payment_details['account_number'] = '8808 ' . rand(1000, 9999) . ' ' . rand(1000, 9999);
        break;
    case 'GOPAY':
        $payment_details['method'] = 'GoPay';
        $payment_details['instructions'] = 'Silakan scan QR Code di bawah ini menggunakan aplikasi Gojek Anda untuk total tagihan Anda.';
        $payment_details['account_number'] = 'gopay.jpg';
        break;
}
$payment_details['amount'] = $total_price;

$_SESSION['payment_details'] = $payment_details;

unset($_SESSION['cart']);

header('Location: confirmation_multiple.php');
exit();
?>