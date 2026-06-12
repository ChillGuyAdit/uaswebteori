<?php
// simpan_penulis.php
header('Content-Type: application/json');
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'pesan' => 'Metode request tidak valid.']);
    exit;
}

// Sanitasi input teks menggunakan htmlspecialchars sesuai ketentuan UTS
$nama_depan = htmlspecialchars(trim($_POST['nama_depan'] ?? ''));
$nama_belakang = htmlspecialchars(trim($_POST['nama_belakang'] ?? ''));
$user_name = htmlspecialchars(trim($_POST['username'] ?? ''));
$password_raw = $_POST['password'] ?? '';

if (empty($nama_depan) || empty($nama_belakang) || empty($user_name) || empty($password_raw)) {
    echo json_encode(['status' => 'error', 'pesan' => 'Semua kolom teks wajib diisi!']);
    exit;
}

// Enkripsi password menggunakan PASSWORD_BCRYPT
$password_hash = password_hash($password_raw, PASSWORD_BCRYPT);

$nama_foto = ''; 

// Validasi dan Upload Foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['foto']['tmp_name'];
    $ukuran = $_FILES['foto']['size'];

    // Batas maksimal 2MB
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

    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nama_foto = time() . '_' . uniqid() . '.' . $ext;
    $tujuan = 'uploads_penulis/' . $nama_foto;

    if (!move_uploaded_file($tmp_name, $tujuan)) {
        echo json_encode(['status' => 'error', 'pesan' => 'Gagal mengunggah foto ke server.']);
        exit;
    }
}

// Prepared Statement
$sql = "INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto) VALUES (?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssss", $nama_depan, $nama_belakang, $user_name, $password_hash, $nama_foto);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'sukses', 'pesan' => 'Data penulis berhasil ditambahkan!']);
    } else {
        if (!empty($nama_foto) && file_exists('uploads_penulis/' . $nama_foto)) {
            unlink('uploads_penulis/' . $nama_foto);
        }
        if ($koneksi->errno === 1062) {
             echo json_encode(['status' => 'error', 'pesan' => 'Username sudah digunakan.']);
        } else {
             echo json_encode(['status' => 'error', 'pesan' => 'Gagal menyimpan ke database.']);
        }
    }
    $stmt->close();
}
$koneksi->close();
?>