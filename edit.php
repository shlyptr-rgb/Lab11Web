<?php
// module/artikel/edit.php

$db = new Database(); 
$form = new Form(); 
$message = '';

// 1. AMBIL ID DARI URL (SEGMENT KE-3)
// Segments: [0] artikel, [1] edit, [2] ID
$id = isset($segments[2]) ? (int)$segments[2] : 0; 

// Jika ID tidak valid, kembalikan ke halaman daftar
if ($id === 0) {
    header("Location: " . BASE_URL . "artikel");
    exit();
}

// ==========================================================
// 2. LOGIKA UPDATE (POST REQUEST)
// ==========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? $db->getConnection()->real_escape_string($_POST['title']) : '';
    $content = isset($_POST['content']) ? $db->getConnection()->real_escape_string($_POST['content']) : '';

    if (empty($title) || empty($content)) {
        $message = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24;">Judul dan Konten tidak boleh kosong!</div>';
    } else {
        // Query UPDATE
        $sql_update = "UPDATE articles SET title = '$title', content = '$content' WHERE id = $id";
        
        if ($db->query($sql_update)) {
            $message = '<div style="padding: 10px; background-color: #d4edda; color: #155724;">Artikel berhasil diperbarui!</div>';
            
            // Redirect ke halaman daftar setelah berhasil
            header("Location: " . BASE_URL . "artikel");
            exit();
        } else {
            $message = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24;">Gagal memperbarui artikel.</div>';
        }
    }
}

// ==========================================================
// 3. AMBIL DATA LAMA (GET REQUEST)
// ==========================================================
$sql_select = "SELECT id, title, content FROM articles WHERE id = $id";
$result = $db->query($sql_select);

if (!$result || $result->num_rows === 0) {
    // Jika artikel tidak ditemukan di DB
    echo '<div style="padding: 15px; background-color: #f8d7da; color: #721c24;">Artikel dengan ID ' . $id . ' tidak ditemukan.</div>';
    include "template/footer.php"; // Ini mungkin perlu diatur tergantung router Anda
    exit();
}

// Ambil data lama sebagai array asosiatif
$article_data = $result->fetch_assoc();

// Tentukan nilai awal formulir dari data yang diambil
$old_title = htmlspecialchars($article_data['title']);
$old_content = htmlspecialchars($article_data['content']);

?>
<h2>Form Edit Artikel (ID: <?php echo $id; ?>)</h2>

<?php echo $message; // Tampilkan pesan feedback ?>

<form method="POST" action="<?php echo BASE_URL . 'artikel/edit/' . $id; ?>">
    <label for="title">Judul Artikel:</label><br>
    <?php echo $form->input('text', 'title', $old_title, 'Masukkan Judul Artikel'); ?><br><br>
    
    <label for="content">Isi Artikel:</label><br>
    <textarea name="content" rows="10" cols="50" placeholder="Tulis isi artikel di sini"><?php echo $old_content; ?></textarea><br><br>
    
    <button type="submit" name="submit">Perbarui Artikel</button>
</form>