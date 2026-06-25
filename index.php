<?php
// FILE: index.php (Master Dashboard Template)
// Mengambil parameter page dari URL secara dinamis (contoh: index.php?page=mandiri)
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Registrasi UKT Mahasiswa</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f1f5f9; margin: 0; display: flex; height: 100vh; color: #1e293b; }
        /* SIDEBAR NAVIGASI */
        .sidebar { width: 260px; background-color: #1e293b; color: white; padding: 20px; box-sizing: border-box; }
        .sidebar h3 { margin-bottom: 25px; font-size: 1.2em; text-align: center; color: #3b82f6; }
        .sidebar a { display: block; color: #cbd5e1; padding: 12px 15px; text-decoration: none; border-radius: 6px; margin-bottom: 8px; font-weight: 500; }
        .sidebar a:hover { background-color: #334155; color: white; }
        .sidebar a.active { background-color: #3b82f6; color: white; }
        
        /* KONTEN UTAMA */
        .main-content { flex: 1; padding: 40px; box-sizing: border-box; overflow-y: auto; }
        .header-panel { background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .content-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        
        /* STYLE TABEL */
        h2 { border-left: 5px solid #3b82f6; padding-left: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 14px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background-color: #f8fafc; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.85em; }
        tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3>Menu Angkatan</h3>
        <a href="index.php?page=dashboard" class="<?= $page == 'dashboard' ? 'active' : ''; ?>">🏠 Dashboard</a>
        <a href="index.php?page=mandiri" class="<?= $page == 'mandiri' ? 'active' : ''; ?>">👤 Jalur Mandiri</a>
        <a href="index.php?page=bidikmisi" class="<?= $page == 'bidikmisi' ? 'active' : ''; ?>">💳 Jalur Bidikmisi</a>
        <a href="index.php?page=prestasi" class="<?= $page == 'prestasi' ? 'active' : ''; ?>">🏆 Jalur Prestasi</a>
    </div>

    <div class="main-content">
        <div class="header-panel">
            <h2 style="margin:0; border:none; padding:0; font-size: 1.5em;">🏥 Sistem Informasi Registrasi Pembayaran UKT</h2>
            <small style="color: #64748b;">Nama: Intan Indah Cahyani | Kelas: TI-1D</small>
        </div>

        <div class="content-box">
            <?php
            // ✨ PROSES INCLUDE VIEW DINAMIS YANG DIMAKSUD DOSEN
            switch ($page) {
                case 'mandiri':
                    include 'v_mandiri.php';
                    break;
                case 'bidikmisi':
                    include 'v_bidikmisi.php';
                    break;
                case 'prestasi':
                    include 'v_prestasi.php';
                    break;
                default:
                    include 'dashboard.php';
                    break;
            }
            ?>
        </div>
    </div>

</body>
</html>