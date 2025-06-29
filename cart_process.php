<?php
// Selalu mulai sesi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Pastikan ada action dan id yang dikirim
if (isset($_GET['action']) && isset($_GET['id'])) {
    
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'add') {
        // Tambahkan item ke keranjang jika belum ada
        if (!in_array($id, $_SESSION['cart'])) {
            $_SESSION['cart'][] = $id;
        }
    } 

    elseif ($action == 'remove') {
        // 1. Cari 'posisi' (key) dari ID item di dalam array keranjang
        $key = array_search($id, $_SESSION['cart']);
        
        // 2. Jika item ditemukan (key-nya tidak false)
        if ($key !== false) {
            // 3. Hapus item tersebut dari array sesi
            unset($_SESSION['cart'][$key]);
        }
    }
    
}

header('Location: keranjang.php');
exit();
?>