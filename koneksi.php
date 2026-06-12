<?php
/**
 * koneksi.php
 * Modul koneksi database untuk Sistem Manajemen Blog (CMS)
 * Menggunakan MySQLi dengan character set utf8mb4
 */

// ============================================================
// 1. KONFIGURASI KREDENSIAL DATABASE
//    Simpan nilai sensitif di sini (atau idealnya di file .env
//    yang tidak di-commit ke version control).
// ============================================================
define('DB_HOST',    'localhost');
define('DB_USER',    'root');
define('DB_PASS',    '');           // Default XAMPP: kosong
define('DB_NAME',    'db_blog');
define('DB_CHARSET', 'utf8mb4');

// ============================================================
// 2. INISIALISASI KONEKSI MySQLi
//    Menggunakan Object-Oriented style agar kompatibel penuh
//    dengan prepared statements di seluruh file CRUD.
// ============================================================
$koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// ============================================================
// 3. PENANGANAN ERROR KONEKSI
//    Pesan publik dibuat generik agar tidak membocorkan
//    detail server. Detail teknis hanya dicatat di error log.
// ============================================================
if ($koneksi->connect_error) {
    // Catat detail error ke log server (hanya terlihat admin)
    error_log('[CMS DB Error] ' . $koneksi->connect_errno . ': ' . $koneksi->connect_error);

    // Tampilkan pesan generik ke pengguna/browser
    die('<p style="font-family:sans-serif;color:#c0392b;padding:1rem;">
            ⚠️ Layanan sedang tidak tersedia. Silakan coba beberapa saat lagi.
         </p>');
}

// ============================================================
// 4. SET CHARACTER SET KE utf8mb4
//    Wajib dilakukan setelah koneksi berhasil agar karakter
//    multibyte (termasuk emoji & aksara khusus) tersimpan aman.
// ============================================================
if (!$koneksi->set_charset(DB_CHARSET)) {
    error_log('[CMS Charset Error] ' . $koneksi->error);
    die('<p style="font-family:sans-serif;color:#c0392b;padding:1rem;">
            ⚠️ Konfigurasi server bermasalah. Hubungi administrator.
         </p>');
}