<?php
$body_class = 'bg-white';

include 'db/db_connect.php';
include 'templates/header.php';

// Pastikan pengguna sudah login untuk melihat keranjang
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect_url=keranjang.php');
    exit();
}

// Inisialisasi keranjang jika belum ada
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$courses_in_cart = [];
$total_price = 0;

if (!empty($cart_items)) {
    // Buat placeholder untuk query IN (...) sejumlah item di keranjang
    $placeholders = implode(',', array_fill(0, count($cart_items), '?'));
    
    // Siapkan tipe data untuk bind_param (satu 'i' untuk setiap item)
    $types = str_repeat('i', count($cart_items));

    // Query untuk mengambil detail semua kelas yang ID-nya ada di dalam keranjang
    $sql = "SELECT * FROM courses WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$cart_items);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $courses_in_cart[] = $row;
        $total_price += $row['price'];
    }
    $stmt->close();
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="fw-bold">Keranjang Belanja</h2>
            <p class="text-muted"><?php echo count($courses_in_cart); ?> Kelas dalam Keranjang</p>
            <hr>
            
            <?php if (!empty($courses_in_cart)): ?>
                <?php foreach ($courses_in_cart as $item): ?>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <img src="assets/img/thumbnails/<?php echo htmlspecialchars($item['thumbnail_image']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($item['title']); ?>">
                        </div>
                        <div class="col-md-7">
                            <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($item['title']); ?></h5>
                            <p class="small text-muted">Oleh <?php echo htmlspecialchars($item['author']); ?></p>
                            </div>
                        <div class="col-md-3 text-end">
                            <p class="fw-bold mb-1"><?php echo 'Rp ' . number_format($item['price'], 0, ',', '.'); ?></p>
                            <a href="cart_process.php?action=remove&id=<?php echo $item['id']; ?>" class="small text-danger text-decoration-none">Hapus</a>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info">Keranjang belanja Anda kosong.</div>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Total:</h4>
                    <h2 class="fw-bold my-3"><?php echo 'Rp ' . number_format($total_price, 0, ',', '.'); ?></h2>
                    <div class="d-grid">
                        <a href="checkout_multiple.php" class="btn btn-success btn-lg">Lanjutkan ke Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>