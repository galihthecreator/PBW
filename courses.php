<?php
include 'db/db_connect.php';
include 'templates/header.php';
?>

<section class="py-5 section-bg-accent">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img src="assets/img/cewekcourse1.png" alt="Mahasiswa Botany Academy" class="img-fluid" style="max-width: 350px;" />
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold mb-3">Course yang Memberi Hasil Fokus Praktik & Perawatan.</h1>
                <p class="text-muted mb-4">
                    Full Online dan Dipandu oleh Praktisi Senior. Praktikal, lebih dari sekadar Webinar. Fokus Bantu Kembangkan Skill Anda.
                </p>
                <div class="d-flex align-items-center mt-3">
                    <div class="me-3">
                        <img src="assets/img/oranglulus/Frame 1000003708.png" alt="Alumni" class="img-fluid" style="height: 40px" />
                    </div>
                    <span class="text-muted">10 Orang Telah Lulus</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="testimoni">
    <div class="container text-center" style="max-width: 800px">
        <h3 class="fw-bold mb-5">Testimoni Alumni Botany</h3>
        <div class="row justify-content-center g-4">
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card border-0 shadow-sm p-1 rounded-4">
                    <img src="assets/img/course/Background+Border+Shadow.png" alt="Testimoni alumni 1" style="max-width: 200px" />
                    <a href="#" class="btn btn-success mx-3 my-2 rounded-pill">Baca Cerita</a>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card border-0 shadow-sm p-1 rounded-4">
                    <img src="assets/img/course/cw1.png" alt="Testimoni alumni 2" style="max-width: 200px" />
                    <a href="#" class="btn btn-success mx-3 my-2 rounded-pill">Baca Cerita</a>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card border-0 shadow-sm p-1 rounded-4">
                    <img src="assets/img/course/cw2.png" alt="Testimoni alumni 3" style="max-width: 200px" />
                    <a href="#" class="btn btn-success mx-3 my-2 rounded-pill">Baca Cerita</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <h2 class="fw-bold mb-4 text-center">Jelajahi Semua Kelas Kami</h2>
        <div class="row g-4">
            <?php
            // 1. Buat Query SQL untuk mengambil SEMUA data kelas
            $sql = "SELECT id, title, short_description, price, thumbnail_image FROM courses ORDER BY id ASC";
            $result = mysqli_query($conn, $sql);

            // 2. Periksa apakah ada data kelas
            if (mysqli_num_rows($result) > 0) {
                // 3. Looping untuk menampilkan setiap kelas
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                        <div class="card shadow-sm w-100">
                            <a href="course_detail.php?id=<?php echo $row['id']; ?>">
                                <img src="assets/img/thumbnails/<?php echo htmlspecialchars($row['thumbnail_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['title']); ?>" style="height: 200px; object-fit: cover;">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">
                                    <a href="course_detail.php?id=<?php echo $row['id']; ?>" class="text-dark text-decoration-none">
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </a>
                                </h5>
                                <p class="card-text flex-grow-1 small text-muted"><?php echo htmlspecialchars($row['short_description']); ?></p>
                                <div class="mt-auto">
                                    <p class="card-text fw-bold fs-5">
                                        <?php
                                        if ($row['price'] == 0) {
                                            echo '<span class="text-success">Gratis</span>';
                                        } else {
                                            echo 'Rp ' . number_format($row['price'], 0, ',', '.');
                                        }
                                        ?>
                                    </p>
                                    <a href="course_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-dark w-100 mt-2">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-12'><p class='text-center'>Saat ini belum ada kelas yang tersedia.</p></div>";
            }
            ?>
        </div>
    </div>
</section>

<?php
// Memuat footer
include 'templates/footer.php';
?>