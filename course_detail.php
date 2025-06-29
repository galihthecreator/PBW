<?php
include 'db/db_connect.php';
include 'templates/header.php';

// 1. Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: courses.php');
    exit();
}
$course_id = $_GET['id'];

// 2. Ambil detail kelas
$stmt_course = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt_course->bind_param("i", $course_id);
$stmt_course->execute();
$result_course = $stmt_course->get_result();

if ($result_course->num_rows === 0) {
    header('Location: courses.php');
    exit();
}
$course = $result_course->fetch_assoc();
$stmt_course->close();

// 3. Ambil materi dan hitung kalkulasi
$stmt_materi = $conn->prepare("SELECT * FROM materi WHERE course_id = ? ORDER BY order_number ASC");
$stmt_materi->bind_param("i", $course_id);
$stmt_materi->execute();
$result_materi = $stmt_materi->get_result();

// --- Kalkulasi untuk ditampilkan ---
$total_materi = $result_materi->num_rows;
$total_menit = 0;
$total_artikel = 0;
// Reset pointer result set untuk bisa di-loop lagi nanti
$result_materi->data_seek(0); 
while($materi_calc = $result_materi->fetch_assoc()){
    $total_menit += $materi_calc['duration_minutes'];
    if($materi_calc['type'] == 'article'){
        $total_artikel++;
    }
}
$jam = floor($total_menit / 60);
$menit = $total_menit % 60;
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="courses.php">Course</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($course['title']); ?></li>
                </ol>
            </nav>

            <h1 class="fw-bold display-5"><?php echo htmlspecialchars($course['title']); ?></h1>
            <p class="lead text-muted"><?php echo htmlspecialchars($course['short_description']); ?></p>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold me-2"><?php echo htmlspecialchars($course['rating']); ?></span>
                <span class="text-warning me-2">★★★★★</span> 
                <span class="text-muted">(<?php echo number_format($course['participants']); ?> peserta)</span>
            </div>
            <p class="small">Dibuat oleh <a href="#"><?php echo htmlspecialchars($course['author']); ?></a></p>
            <p class="small text-muted"><i class="bi bi-globe"></i> Indonesia</p>
            
            <hr class="my-4">

            <div class="course-section">
                <h4 class="fw-bold">Deskripsi</h4>
                <p><?php echo nl2br(htmlspecialchars($course['details'])); ?></p>
            </div>

            <div class="course-section mt-5">
                <h4 class="fw-bold">Konten Kursus</h4>
                <p class="small text-muted"><?php echo $total_materi; ?> bagian • <?php echo "{$jam}j {$menit}m"; ?> total durasi</p>
                <ul class="list-group list-group-flush course-content-list">
                    <?php $result_materi->data_seek(0); // Reset pointer lagi ?>
                    <?php while ($materi = $result_materi->fetch_assoc()) : ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi <?php echo ($materi['type'] == 'video') ? 'bi-play-circle' : 'bi-file-text'; ?> me-2"></i>
                                <?php echo htmlspecialchars($materi['title']); ?>
                            </div>
                            <span class="text-muted small"><?php echo $materi['type'] == 'video' ? 'Video' : 'Teks'; ?> • <?php echo $materi['duration_minutes']; ?>m</span>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top course-sticky-card" >
                <img src="assets/img/thumbnails/<?php echo htmlspecialchars($course['thumbnail_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>">
                <div class="card-body">
                    <h2 class="card-title fw-bold mb-3">
                        <?php echo ($course['price'] == 0) ? 'Gratis' : 'Rp ' . number_format($course['price'], 0, ',', '.'); ?>
                    </h2>
                    <div class="d-grid gap-2">
                        <a href="cart_process.php?action=add&id=<?php echo $course['id']; ?>" class="btn btn-outline-dark">Tambahkan ke keranjang</a>
                        <a href="checkout.php?course_id=<?php echo $course['id']; ?>" class="btn btn-success btn-lg">Daftar Sekarang</a>
                    </div>
                    <p class="text-center text-muted small my-3">Jaminan uang kembali 30 hari</p>
                    <h6 class="fw-bold">Kursus ini mencakup:</h6>
                    <ul class="list-unstyled course-includes-list small">
                        <li><i class="bi bi-camera-video"></i> <?php echo "{$jam}j {$menit}m"; ?> total durasi video</li>
                        <li><i class="bi bi-file-earmark-text"></i> <?php echo $total_artikel; ?> artikel</li>
                        <li><i class="bi bi-phone"></i> Akses di perangkat seluler dan desktop</li>
                        <li><i class="bi bi-infinity"></i> Akses penuh seumur hidup</li>
                        <li><i class="bi bi-patch-check"></i> Sertifikat penyelesaian</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$stmt_materi->close();
include 'templates/footer.php';
?>