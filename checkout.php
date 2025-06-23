<?php
include 'db/db_connect.php';
include 'templates/header.php';

// 1. Periksa apakah pengguna sudah login, jika belum, lempar ke login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect_url=checkout.php?course_id=' . $_GET['id']);
    exit();
}

// 2. Validasi & ambil course_id dari URL
if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    header('Location: courses.php');
    exit();
}
$course_id = $_GET['course_id'];

// 3. Ambil detail kelas dari database
$stmt = $conn->prepare("SELECT title, price FROM courses WHERE id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header('Location: courses.php');
    exit();
}
$course = $result->fetch_assoc();
$stmt->close();
?>

<nav class="navbar bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/img/LogoTeks.png" alt="Botany Logo" width="100">
    </a>
    <a href="course_detail.php?id=<?php echo $course_id; ?>" class="text-muted text-decoration-none">Batal</a>
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
                    
                    <form action="payment_process.php" method="POST">
                        <div class="list-group">
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="payment_method" value="BCA_VA" checked>
                                Transfer Virtual Account (BCA)
                            </label>
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="payment_method" value="GOPAY">
                                GoPay
                            </label>
                             <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="payment_method" value="OVO">
                                OVO
                            </label>
                        </div>
                        
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        
                        </div>
            </div>
            
            <h5 class="mt-4">Detail pesanan <span class="text-muted">(1 kursus)</span></h5>
            <div class="d-flex justify-content-between align-items-center p-3 border rounded mt-3">
                <span><?php echo htmlspecialchars($course['title']); ?></span>
                <span class="fw-bold"><?php echo 'Rp ' . number_format($course['price'], 0, ',', '.'); ?></span>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Ringkasan pesanan</h4>
                    <div class="d-flex justify-content-between my-3">
                        <span>Harga Asli:</span>
                        <span><?php echo 'Rp ' . number_format($course['price'], 0, ',', '.'); ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span><?php echo 'Rp ' . number_format($course['price'], 0, ',', '.'); ?></span>
                    </div>
                    <div class="d-grid mt-4">
                         <button type="submit" class="btn btn-success btn-lg">Daftar Sekarang</button>
                    </div>
                    </form> </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>