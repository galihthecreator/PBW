<?php
include 'db/db_connect.php';

$errors = array();
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Mengambil data dari formulir dan membersihkannya
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // 2. Validasi Input
    if (empty($username)) { array_push($errors, "Username tidak boleh kosong"); }
    if (empty($email)) { array_push($errors, "Email tidak boleh kosong"); }
    if (empty($password)) { array_push($errors, "Password tidak boleh kosong"); }
    if ($password != $confirm_password) { array_push($errors, "Konfirmasi password tidak cocok"); }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { array_push($errors, "Format email tidak valid"); }

    // Cek apakah email sudah terdaftar
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['email'] === $email) {
            array_push($errors, "Email sudah terdaftar, silakan gunakan email lain.");
        }
    }

    if (count($errors) == 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$hashed_password')";
        mysqli_query($conn, $query);

        $success_message = "Registrasi berhasil! Anda sekarang bisa login.";
    }
}
?>

<?php include 'templates/header.php';?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Daftar Akun Baru</h3>

                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) : ?>
                                <p class="mb-0"><?php echo $error; ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <?php if (!empty($success_message)) : ?>
                        <div class="alert alert-success">
                            <p class="mb-0"><?php echo $success_message; ?> <a href="login.php">Login di sini</a>.</p>
                        </div>
                    <?php else : ?>
                        <form method="post" action="register.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Daftar</button>
                            </div>
                        </form>
                    <?php endif; ?>

                    <p class="text-center mt-3 small">
                        Sudah punya akun? <a href="login.php">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php';?>