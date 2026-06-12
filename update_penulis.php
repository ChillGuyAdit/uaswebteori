<?php
// Set response selalu menjadi JSON
header('Content-Type: application/json');
require_once 'koneksi.php';

// Pastikan request adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'pesan' => 'Metode request tidak valid.']);
    exit;
}

// 1. Tangkap data dan sanitasi input (Wajib htmlspecialchars)
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$nama_depan = isset($_POST['nama_depan']) ? htmlspecialchars(trim($_POST['nama_depan'])) : '';
$nama_belakang = isset($_POST['nama_belakang']) ? htmlspecialchars(trim($_POST['nama_belakang'])) : '';
$username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validasi jika ada yang kosong
if ($id <= 0 || empty($nama_depan) || empty($nama_belakang) || empty($username)) {
    echo json_encode(['status' => 'error', 'pesan' => 'Data wajib (Nama dan Username) harus diisi.']);
    exit;
}

// 2. Ambil data penulis saat ini dari database (terutama untuk mengecek nama file foto lama)
$stmt_cek = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
$stmt_cek->bind_param('i', $id);
$stmt_cek->execute();
$stmt_cek->bind_result($foto_lama);
$stmt_cek->fetch();
$stmt_cek->close();

$nama_foto = $foto_lama; // Secara default, anggap foto tidak diganti

// 3. Logika untuk Foto (Jika user mengunggah foto baru)
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['foto']['tmp_name'];
    $ukuran = $_FILES['foto']['size'];

    // Validasi ukuran maksimal 2MB
    if ($ukuran > 2097152) {
        echo json_encode(['status' => 'error', 'pesan' => 'Ukuran foto maksimal 2 MB.']);
        exit;
    }

    // Validasi tipe file MURNI menggunakan finfo
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $tmp_name);
    finfo_close($finfo);

    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($mime_type, $allowed_types)) {
        echo json_encode(['status' => 'error', 'pesan' => 'Tipe file tidak valid. Harus gambar (JPG/PNG).']);
        exit;
    }

    // Buat nama file baru agar tidak bentrok
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nama_foto_baru = time() . '_' . uniqid() . '.' . $ext;
    $tujuan = 'uploads_penulis/' . $nama_foto_baru;

    if (move_uploaded_file($tmp_name, $tujuan)) {
        $nama_foto = $nama_foto_baru; // Pakai foto yang baru diupload
        
        // Hapus foto lama dari server, KECUALI foto lamanya adalah default.png
        if (!empty($foto_lama) && $foto_lama !== 'default.png' && file_exists('uploads_penulis/' . $foto_lama)) {
            unlink('uploads_penulis/' . $foto_lama);
        }
    } else {
        echo json_encode(['status' => 'error', 'pesan' => 'Gagal mengunggah foto ke server.']);
        exit;
    }
}

// 4. Siapkan query UPDATE (Beda query tergantung apakah password diisi atau kosong)
if (!empty($password)) {
    // Jika password diisi, enkripsi lalu update juga kolom password-nya
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE penulis SET nama_depan = ?, nama_belakang = ?, user_name = ?, password = ?, foto = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssssi", $nama_depan, $nama_belakang, $username, $password_hash, $nama_foto, $id);
} else {
    // Jika password kosong, biarkan password lama utuh
    $sql = "UPDATE penulis SET nama_depan = ?, nama_belakang = ?, user_name = ?, foto = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssi", $nama_depan, $nama_belakang, $username, $nama_foto, $id);
}

// 5. Eksekusi Query
if ($stmt->execute()) {
    echo json_encode(['status' => 'sukses', 'pesan' => 'Data penulis berhasil diperbarui!']);
} else {
    // Deteksi error duplikat username (1062)
    if ($koneksi->errno === 1062) {
        echo json_encode(['status' => 'error', 'pesan' => 'Username sudah digunakan, pilih yang lain.']);
    } else {
        error_log('[update_penulis] ' . $stmt->error);
        echo json_encode(['status' => 'error', 'pesan' => 'Gagal memperbarui data di database.']);
    }
}

$stmt->close();
$koneksi->close();
?>