<?php
// Set header agar mengembalikan response dalam format JSON
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// Panggil koneksi database
require_once 'koneksi.php';

// REVISI: Gunakan nama kolom yang sesuai dengan db_blog tabel penulis
// Termasuk mengambil password karena wajib ditampilkan di tabel UI
$sql    = "SELECT id, nama_depan, nama_belakang, user_name, password, foto FROM penulis ORDER BY id ASC";
$result = $koneksi->query($sql);

// Penanganan error jika query gagal
if (!$result) {
    error_log('[ambil_penulis] Query error: ' . $koneksi->error);
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'pesan'   => 'Gagal mengambil data penulis.'
    ]);
    exit;
}

// Ambil baris data dan susun ke dalam array
$data = [];
while ($row = $result->fetch_assoc()) {
    // Gabungkan nama depan dan belakang agar siap pakai di Javascript (index.php)
    $row['nama_lengkap'] = $row['nama_depan'] . ' ' . $row['nama_belakang'];
    $data[] = $row;
}

$result->free();
$koneksi->close();

// Kembalikan response JSON sukses
http_response_code(200);
echo json_encode([
    'status' => 'sukses',
    'jumlah' => count($data),
    'data'   => $data
]); 