<?php
require_once 'koneksi.php';
// Variabel $koneksi langsung tersedia dan siap untuk prepared statement

// Contoh prepared statement INSERT penulis:
$stmt = $koneksi->prepare(
    "INSERT INTO penulis (nama, username, password, foto) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param('ssss', $nama, $username, $password_hash, $foto);
$stmt->execute();
$stmt->close();