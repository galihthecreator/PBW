<?php
// Kita pindahkan include db_connect.php ke sini untuk memastikan $conn tersedia jika dibutuhkan
include 'db/db_connect.php'; 
include 'templates/header.php';

// Periksa apakah ada detail pembayaran di sesi.
if (!isset($_SESSION['payment_details'])) {
    header('Location: index.php');
    exit();
}

$details = $_SESSION['payment_details'];
unset($_SESSION['payment_details']);

// Tombol Saya Sudah Membayar
$payment_checker_url = "payment_checker.php?enroll_id=" . htmlspecialchars($details['enroll_id']);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Pendaftaran Berhasil!</h4>
                </div>
                <div class="card-body p-4">
                    <p class="lead">Terima kasih telah mendaftar. Mohon selesaikan pembayaran Anda.</p>
                    <hr>
                    <h5 class="mt-4">Instruksi Pembayaran</h5>
                    <p class="text-muted"><?php echo htmlspecialchars($details['instructions']); ?></p>

                    <div class="alert alert-light mt-3">
                        <h4 class="fw-bold"><?php echo htmlspecialchars($details['method']); ?></h4>
                        <?php if ($details['method'] == 'GoPay'): ?>
                            <img src="assets/img/payment/gopay.jpg" alt="Scan QR Code GoPay" width="200">
                        <?php else: ?>
                            <h3 class="display-6 fw-bold my-3"><?php echo htmlspecialchars($details['account_number']); ?></h3>
                        <?php endif; ?>
                        
                        <p class="mb-0">Total Pembayaran</p>
                        <p class="fs-4 fw-bold"><?php echo 'Rp ' . number_format($details['amount'], 0, ',', '.'); ?></p>
                    </div>

                    <a href="courses.php" class="btn btn-outline-primary mt-4">Lihat Kelas Lainnya</a>
                    <a href="<?php echo $payment_checker_url; ?>" class="btn btn-primary mt-4">Saya Sudah Membayar</a>
                </div>
                <div class="card-footer text-muted small">
                    Pembayaran akan diverifikasi secara otomatis dalam 1x24 jam.
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>