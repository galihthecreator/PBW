<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fungsi kecil untuk membuat inisial dari nama
function getInitials($name) {
    $words = explode(" ", $name);
    $initials = "";
    if (isset($words[0])) {
        $initials .= strtoupper($words[0][0]);
    }
    if (isset($words[1])) {
        $initials .= strtoupper($words[1][0]);
    }
    return $initials ?: 'U'; // Default 'U' jika nama kosong
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Botany Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/LogoTeks.png" alt="Botany Academy Logo" width="120" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="courses.php">Course</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <a href="#" class="text-dark me-3"><i class="bi bi-cart fs-5"></i></a>
                        <a href="#" class="text-dark me-4"><i class="bi bi-bell fs-5"></i></a>
                        
                        <div class="dropdown">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar">
                                    <?php echo getInitials($_SESSION['username']); ?>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-small shadow">
                                <li>
                                    <div class="px-3 py-2">
                                        <strong class="d-block"><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                                        <small class="text-muted"> </small>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="dashboard.php">Pembelajaran Saya</a></li>
                                <li><a class="dropdown-item" href="#">Keranjang Saya</a></li>
                                <li><a class="dropdown-item" href="#">Notifikasi</a></li>
                                <li><a class="dropdown-item" href="#">Pengaturan Akun</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                            </ul>
                        </div>

                    <?php else : ?>
                        <a href="login.php" class="btn btn-green-outline me-2">Log In</a>
                        <a href="register.php" class="btn btn-green">Sign Up</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>