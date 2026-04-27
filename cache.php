<?php
// Fungsi untuk membersihkan cache browser
function clearBrowserCache() {
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // HTTP/1.0
    header("Expires: 0"); // Mengatur expired ke waktu lalu
    return "Cache browser berhasil dibersihkan.";
}

// Fungsi untuk membersihkan cache file di server
function clearServerCache() {
    // Menyaring file cache di folder cache (sesuaikan dengan kebutuhan)
    $cacheDir = './cache/'; // Kamu bisa ganti folder ini jika perlu
    if (is_dir($cacheDir)) {
        $files = glob($cacheDir . '*'); // Mendapatkan semua file di dalam folder cache
        if ($files) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Menghapus file cache
                }
            }
            return "Cache server berhasil dibersihkan.";
        } else {
            return "Tidak ada file cache untuk dibersihkan di server.";
        }
    }
    return "Direktori cache tidak ditemukan.";
}

// Fungsi untuk membersihkan OPcache (PHP OPcache)
function clearOpCache() {
    if (function_exists('opcache_reset')) {
        opcache_reset(); // Menghapus cache OPcache
        return "Cache OPcache berhasil dibersihkan.";
    }
    return "Fungsi OPcache tidak tersedia.";
}

// Menjalankan semua fungsi pembersihan cache
$browserCacheStatus = clearBrowserCache();
$serverCacheStatus = clearServerCache();
$opCacheStatus = clearOpCache();

// Menampilkan status
echo "<p>$browserCacheStatus</p>";
echo "<p>$serverCacheStatus</p>";
echo "<p>$opCacheStatus</p>";

?>