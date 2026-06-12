<?php
// hapus_penulis.php
header('Content-Type: application/json');
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'pesan' => 'Metode request tidak valid.']);
    exit;
}

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'pesan' => 'ID tidak valid.']);
    exit;
}

// Cek apakah penulis masih memiliki artikel
$stmt_cek = $koneksi->prepare("SELECT id FROM artikel WHERE id_penulis = ?");
$stmt_cek->bind_param('i', $id);
$stmt_cek->execute();
$stmt_cek->store_result();

if ($stmt_cek->num_rows > 0) {
    echo json_encode(['status' => 'error', 'pesan' => 'Gagal! Penulis masih memiliki artikel. Hapus artikel terkait terlebih dahulu.']);
    $stmt_cek->close();
    exit;
}
$stmt_cek->close();

// Ambil nama file foto sebelum dihapus
$foto = '';
$stmt_foto = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
$stmt_foto->bind_param('i', $id);
$stmt_foto->execute();
$stmt_foto->bind_result($foto);
$stmt_foto->fetch();
$stmt_foto->close();

// Eksekusi Hapus dari Database
$stmt_hapus = $koneksi->prepare("DELETE FROM penulis WHERE id = ?");
$stmt_hapus->bind_param('i', $id);

if ($stmt_hapus->execute()) {
    if (!empty($foto) && file_exists('uploads_penulis/' . $foto)) {
        unlink('uploads_penulis/' . $foto);
    }
    echo json_encode(['status' => 'sukses', 'pesan' => 'Data penulis berhasil dihapus!']);
} else {
    echo json_encode(['status' => 'error', 'pesan' => 'Gagal menghapus data dari database.']);
}

$stmt_hapus->close();
$koneksi->close();
?>