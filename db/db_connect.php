<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'database_botany';

    // Connection to the database
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    // Check connection
    if (!$conn) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }
?>
