<?php
// config.php

// ===================================
// KONFIGURASI DATABASE
// ===================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
// Password default XAMPP adalah kosong ('').
// Jika Anda sudah mengatur password, GANTI ' ' dengan password Anda.
define('DB_PASS', ''); 
// Port MySQL/MariaDB yang Anda gunakan (3307)
define('DB_PORT', '3307'); 
// Ganti 'lab11_project_db' dengan nama database yang sudah Anda buat di phpMyAdmin
define('DB_NAME', 'lab11_project_db'); 

// ===================================
// KONFIGURASI APLIKASI
// ===================================
// Base URL proyek, harus sesuai dengan nama folder di htdocs
define('BASE_URL', '/lab11_php_oop/');
?>