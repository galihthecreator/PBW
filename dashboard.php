<?php
include 'db/db_connect.php';
include 'templates/header.php';

// Hanya user yang sudah login yang bisa mengakses halaman ini
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT c.id, c.title, c.author, c.short_description, c.thumbnail_image 
        FROM courses c
        JOIN pendaftar p ON c.id = p.course_id
        WHERE p.user_id = ? AND p.status_pembayaran = 'completed'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container my-5">
    <h1 class="fw-bold mb-4">Pembelajaran saya</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Semua kursus</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Sertifikat</a>
        </li>
    </ul>

    <div class="row mb-4">
        <div class="col-md-3">
            <select class="form-select">
                <option selected>Filter menurut</option>
                <option value="1">Terakhir Diakses</option>
                <option value="2">A-Z</option>
                <option value="3">Z-A</option>
            </select>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari kursus saya...">
                <button class="btn btn-success" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card course-card-dashboard h-100 shadow-sm">
                        <a href="learning.php?course_id=<?php echo $row['id']; ?>">
                            <img src="assets/img/thumbnails/<?php echo htmlspecialchars($row['thumbnail_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text text-muted small">Oleh <?php echo htmlspecialchars($row['author']); ?></p>
                            
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="small text-muted mt-1">0% selesai</p>
                        </div>
                        <div class="card-footer bg-white border-0 p-3">
                             <a href="learning.php?course_id=<?php echo $row['id']; ?>" class="btn btn-success w-100">Mulai Belajar</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-info">
                    Anda belum terdaftar di kelas manapun. <a href="courses.php">Jelajahi kelas sekarang!</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$stmt->close();
include 'templates/footer.php';
?>