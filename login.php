<?php
session_start();
include 'db/db_connect.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Mengambil data dari formulir
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // 2. Validasi sederhana
    if (empty($email)) { array_push($errors, "Email tidak boleh kosong"); }
    if (empty($password)) { array_push($errors, "Password tidak boleh kosong"); }

    if (count($errors) == 0) {
        // 3. Cari pengguna di database berdasarkan email
        $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // 4. Verifikasi password yang diinput dengan hash di database
            if (password_verify($password, $user['password'])) {
                // Password cocok! Buat session untuk pengguna.
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // var_dump($_SESSION);
                // die();

                header('location: index.php');
                exit();
            } else {
                // Password tidak cocok
                array_push($errors, "Kombinasi email/password salah");
            }
        } else {
            // Email tidak ditemukan
            array_push($errors, "Kombinasi email/password salah");
        }
        $stmt->close();
    }
}
?>

<?php include 'templates/header.php';?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>

                    <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                        <div class="alert alert-success">
                            Registrasi berhasil! Silakan login dengan akun Anda.
                        </div>
                    <?php endif; ?>

                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) : ?>
                                <p class="mb-0"><?php echo $error; ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <form method="post" action="login.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>

                    <p class="text-center mt-3 small">
                        Belum punya akun? <a href="register.php">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php';?>