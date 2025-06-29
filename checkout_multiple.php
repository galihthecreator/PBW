<?php
include 'db/db_connect.php';
include 'templates/header.php';

// Keamanan: Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect_url=keranjang.php');
    exit();
}

// Ambil item dari sesi keranjang
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Jika keranjang kosong, tidak ada yang bisa di-checkout. Arahkan kembali.
if (empty($cart_items)) {
    header('Location: keranjang.php');
    exit();
}

$courses_in_cart = [];
$total_price = 0;

// Buat placeholder untuk query IN (...)
$placeholders = implode(',', array_fill(0, count($cart_items), '?'));
$types = str_repeat('i', count($cart_items));

// Query untuk mengambil detail semua kelas yang ID-nya ada di dalam keranjang
$sql = "SELECT id, title, price FROM courses WHERE id IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$cart_items);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $courses_in_cart[] = $row;
    $total_price += $row['price'];
}
$stmt->close();

// Menggunakan variabel $body_class untuk membuat background putih di halaman ini
$body_class = 'bg-white';
?>

<nav class="navbar bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/img/LogoTeks.png" alt="Botany Logo" width="100">
    </a>
    <a href="keranjang.php" class="text-muted text-decoration-none">Batal</a>
  </div>
</nav>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-7">
            <h3>Checkout</h3>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Pilih Metode Pembayaran :</h5>
                    <p class="card-text text-muted small">Silahkan pilih metode pembayaran untuk melakukan pendaftaran kelas Botany.</p>
                    
                    <form action="payment_process_multiple.php" method="POST">
                        <div class="list-group">
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="payment_method" value="BCA_VA" checked>
                                Transfer Virtual Account (BCA)
                            </label>
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="payment_method" value="GOPAY">
                                GoPay
                            </label>
                        </div>
                </div>
            </div>
            
            <h5 class="mt-4">Detail pesanan <span class="text-muted">(<?php echo count($courses_in_cart); ?> kursus)</span></h5>
            <?php foreach ($courses_in_cart as $item): ?>
            <div class="d-flex justify-content-between align-items-center p-3 border rounded mt-3">
                <span><?php echo htmlspecialchars($item['title']); ?></span>
                <span class="fw-bold"><?php echo 'Rp ' . number_format($item['price'], 0, ',', '.'); ?></span>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Ringkasan pesanan</h4>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span><?php echo 'Rp ' . number_format($total_price, 0, ',', '.'); ?></span>
                    </div>
                    <div class="d-grid mt-4">
                         <button type="submit" class="btn btn-success btn-lg">Bayar Sekarang</button>
                    </div>
                    </form> </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>