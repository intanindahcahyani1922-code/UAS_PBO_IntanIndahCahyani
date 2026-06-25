<?php
// FILE: index.php

// Memanggil semua berkas yang diperlukan
require_once 'database.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// Inisialisasi koneksi database
$db = new Database();

// Mengambil data terkelompok menggunakan method query internal masing-masing subclass
$dataMandiri = MahasiswaMandiri::getDaftarMandiri($db);
$dataBidikmisi = MahasiswaBidikmisi::getDaftarBidikmisi($db);
$dataPrestasi = MahasiswaPrestasi::getDaftarPrestasi($db);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Registrasi Pembayaran Kuliah UAS PBO</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f8fafc; padding: 30px; margin: 0; color: #1e293b; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #0f172a; margin-bottom: 5px; }
        .identitas { text-align: center; color: #64748b; font-size: 1.1em; margin-bottom: 40px; }
        h2 { border-left: 5px solid #3b82f6; padding-left: 10px; margin-top: 40px; color: #1e293b; font-size: 1.4em; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 10px; background: #ffffff; }
        th, td { padding: 14px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background-color: #1e293b; color: white; font-weight: 600; }
        tr:hover { background-color: #f8fafc; }
        .tagihan { font-weight: bold; color: #16a34a; }
        .gratis { font-weight: bold; color: #dc2626; font-style: italic; }
    </style>
</head>
<body>

<div class="container">
    <h1>🏥 Sistem Registrasi Pembayaran UKT Mahasiswa</h1>
    <div class="identitas">
        <strong>Nama:</strong> Intan Indah Cahyani | <strong>Kelas:</strong> TI-1D | <strong>Database:</strong> DB_UAS_PBO_TI1D_IntanIndahCahyani
    </div>

    <h2>📊 Kategori: Mahasiswa Mandiri</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Semester</th>
                <th>Tarif UKT Asli</th>
                <th>Spesifikasi Akademik (Polimorfik)</th>
                <th>Total Tagihan Akhir (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dataMandiri)): ?>
                <tr><td colspan="7" style="text-align:center;">Tidak ada data mahasiswa mandiri.</td></tr>
            <?php else: ?>
                <?php foreach ($dataMandiri as $m): ?>
                    <tr>
                        <td><?= $m->getId(); ?></td>
                        <td><?= $m->getNim(); ?></td>
                        <td><strong><?= htmlspecialchars($m->getNama()); ?></strong></td>
                        <td>Semester <?= $m->getSemester(); ?></td>
                        <td>Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.'); ?></td>
                        <td><?= $m->tampilkanSpesifikasiAkademik(); ?></td>
                        <td class="tagihan">Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>📊 Kategori: Mahasiswa Bidikmisi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Semester</th>
                <th>Tarif UKT Asli</th>
                <th>Spesifikasi Akademik (Polimorfik)</th>
                <th>Total Tagihan Akhir (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dataBidikmisi)): ?>
                <tr><td colspan="7" style="text-align:center;">Tidak ada data mahasiswa bidikmisi.</td></tr>
            <?php else: ?>
                <?php foreach ($dataBidikmisi as $m): ?>
                    <tr>
                        <td><?= $m->getId(); ?></td>
                        <td><?= $m->getNim(); ?></td>
                        <td><strong><?= htmlspecialchars($m->getNama()); ?></strong></td>
                        <td>Semester <?= $m->getSemester(); ?></td>
                        <td>Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.'); ?></td>
                        <td><?= $m->tampilkanSpesifikasiAkademik(); ?></td>
                        <td class="gratis">
                            <?= $m->hitungTagihanSemester() == 0 ? "Gratis (Rp 0)" : "Rp " . number_format($m->hitungTagihanSemester(), 0, ',', '.'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>📊 Kategori: Mahasiswa Prestasi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Semester</th>
                <th>Tarif UKT Asli</th>
                <th>Spesifikasi Akademik (Polimorfik)</th>
                <th>Total Tagihan Akhir (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dataPrestasi)): ?>
                <tr><td colspan="7" style="text-align:center;">Tidak ada data mahasiswa prestasi.</td></tr>
            <?php else: ?>
                <?php foreach ($dataPrestasi as $m): ?>
                    <tr>
                        <td><?= $m->getId(); ?></td>
                        <td><?= $m->getNim(); ?></td>
                        <td><strong><?= htmlspecialchars($m->getNama()); ?></strong></td>
                        <td>Semester <?= $m->getSemester(); ?></td>
                        <td>Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.'); ?></td>
                        <td><?= $m->tampilkanSpesifikasiAkademik(); ?></td>
                        <td class="tagihan">Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>