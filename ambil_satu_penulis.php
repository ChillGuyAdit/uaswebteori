<?php
// ambil_satu_penulis.php
header('Content-Type: application/json');
require_once 'koneksi.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    echo json_encode(['status' => 'error', 'pesan' => 'ID tidak valid.']);
    exit;
}

$stmt = $koneksi->prepare("SELECT id, nama_depan, nama_belakang, user_name, foto FROM penulis WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();
$koneksi->close();

if ($data) {
    // Sanitasi output
    $data['nama_depan']    = htmlspecialchars($data['nama_depan']);
    $data['nama_belakang'] = htmlspecialchars($data['nama_belakang']);
    $data['user_name']     = htmlspecialchars($data['user_name']);
    echo json_encode(['status' => 'sukses', 'data' => $data]);
} else {
    echo json_encode(['status' => 'error', 'pesan' => 'Data penulis tidak ditemukan.']);
}
?>