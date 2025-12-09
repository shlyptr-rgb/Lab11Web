<?php
// module/home/index.php

// Contoh inisiasi database
$db = new Database();
// Anda bisa menggunakan $db->getConnection() untuk melakukan query

echo '<h2>Selamat Datang di Halaman Utama!</h2>';
echo '<p>Ini dimuat dari file: <strong>module/home/index.php</strong></p>';
echo '<p>Sistem Modular Berhasil Bekerja.</p>';
echo '<p>Coba akses URL Bersih: <a href="' . BASE_URL . 'artikel/tambah">/artikel/tambah</a></p>';

// Jika Anda mengakses /artikel/tambah, index.php akan mencari file module/artikel/tambah.php
?>