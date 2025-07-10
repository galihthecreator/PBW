<?php 
include '_includes/db_connect.php';
include '_includes/header.php';


?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Hubungi Kami</h2>
            <p>Jika Anda memiliki pertanyaan atau butuh bantuan, silakan isi formulir di bawah ini:</p>
            <form action="_actions/contact_submit.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>