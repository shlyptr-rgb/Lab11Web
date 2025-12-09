<?php
// module/artikel/tambah.php

// Inisiasi database
$db = new Database(); 
$form = new Form(); // Class Form untuk helper input

$message = '';

// Cek apakah formulir disubmit (metode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Ambil dan bersihkan data
    $title = isset($_POST['title']) ? $db->getConnection()->real_escape_string($_POST['title']) : '';
    $content = isset($_POST['content']) ? $db->getConnection()->real_escape_string($_POST['content']) : '';

    // 2. Validasi sederhana
    if (empty($title) || empty($content)) {
        $message = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24;">Judul dan Konten tidak boleh kosong!</div>';
    } else {
        // 3. Buat Query INSERT
        $sql = "INSERT INTO articles (title, content) VALUES ('$title', '$content')";
        
        // 4. Eksekusi Query
        if ($db->query($sql)) {
            $message = '<div style="padding: 10px; background-color: #d4edda; color: #155724;">Artikel berhasil ditambahkan!</div>';
            
            // Redirect ke halaman daftar setelah berhasil
            header("Location: " . BASE_URL . "artikel");
            exit();
        } else {
            $message = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24;">Gagal menyimpan artikel ke database.</div>';
        }
    }
}

// ==========================================================
// TAMPILAN FORMULIR
// ==========================================================
?>
<h2>Form Tambah Artikel Baru</h2>

<?php echo $message; // Tampilkan pesan feedback ?>

<form method="POST" action="<?php echo BASE_URL; ?>artikel/tambah">
    <label for="title">Judul Artikel:</label><br>
    <?php echo $form->input('text', 'title', '', 'Masukkan Judul Artikel'); ?><br><br>
    
    <label for="content">Isi Artikel:</label><br>
    <textarea name="content" rows="10" cols="50" placeholder="Tulis isi artikel di sini"></textarea><br><br>
    
    <button type="submit" name="submit">Simpan Artikel</button>
</form>