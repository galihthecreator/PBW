<?php
// 1. Definisikan sebuah variabel sederhana
$test_id = 123;
$test_url = "halaman_tujuan.php?id=" . $test_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tes Link PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container mt-5">
        <h1>Halaman Tes Link</h1>
        <p>Di bawah ini adalah tombol yang dibuat dengan PHP di dalam `href`.</p>

        <a href="<?php echo $test_url; ?>" class="btn btn-primary">Ini Tombol Tes</a>

        <p class="mt-3">Jika tombol di atas muncul dengan benar, berarti tidak ada masalah dengan PHP Anda.</p>
    </div>
</body>
</html>