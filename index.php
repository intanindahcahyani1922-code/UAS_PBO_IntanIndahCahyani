<?php
// FILE: index.php

require_once 'database.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

$db = new Database();

// 1. QUERY ALL: Ambil SEMUA data dari satu tabel secara dinamis (Ini yang diminta dosen)
$query = "SELECT * FROM tabel_mahasiswa";
$result = $db->conn->query($query);

// Wadah penampung objek terkelompok
$listMandiri = [];
$listBidikmisi = [];
$listPrestasi = [];

// 2. PROSES DINAMIS & POLIMORFISME: Mengubah data database menjadi Objek Class Anak secara otomatis
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        // Memeriksa jenis_pembayaran langsung dari database
        if ($row['jenis_pembayaran'] == 'mandiri') {
            $listMandiri[] = new MahasiswaMandiri(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'],
                $row['golongan_ukt'], $row['nama_wali']
            );
        } elseif ($row['jenis_pembayaran'] == 'bidikmisi') {
            $listBidikmisi[] = new MahasiswaBidikmisi(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'],
                $row['nomor_kip_kuliah'], $row['dana_saku_subsidi']
            );
        } elseif ($row['jenis_pembayaran'] == 'prestasi') {
            $listPrestasi[] = new MahasiswaPrestasi(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'],
                $row['nama_instansi_beasiswa'], $row['minimal_ipk_bersyarat']
            );
        }
    }
}
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
    <h1>🏥 Sistem Registrasi Pembayaran UKT Mahasiswa (Dinamis Sejati)</h1>
    <div class="identitas">
        <strong>Nama:</strong> Intan Indah Cahyani | <strong>Kelas:</strong> TI-1D | <strong>Database:</strong> DB_UAS_PBO_TI1D_IntanIndahCahyani
    </div>

    <h2>📊 Kategori: Mahasiswa Mandiri</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>NIM</th><th>Nama Mahasiswa</th><th>Semester</th><th>Tarif UKT Asli</th><th>Spesifikasi Akademik (Polimorfik)</th><th>Total Tagihan Akhir (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listMandiri as $m): ?>
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
        </tbody>
    </table>

    <h2>📊 Kategori: Mahasiswa Bidikmisi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>NIM</th><th>Nama Mahasiswa</th><th>Semester</th><th>Tarif UKT Asli</th><th>Spesifikasi Akademik (Polimorfik)</th><th>Total Tagihan Akhir (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listBidikmisi as $m): ?>
                <tr>
                    <td><?= $m->getId(); ?></td>
                    <td><?= $m->getNim(); ?></td>
                    <td><strong><?= htmlspecialchars($m->getNama()); ?></strong></td>
                    <td>Semester <?= $m->getSemester(); ?></td>
                    <td>Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.'); ?></td>
                    <td><?= $m->tampilkanSpesifikasiAkademik(); ?></td>
                    <td class="gratis">Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.'); ?> (Gratis)</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>📊 Kategori: Mahasiswa Prestasi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>NIM</th><th>Nama Mahasiswa</th><th>Semester</th><th>Tarif UKT Asli</th><th>Spesifikasi Akademik (Polimorfik)</th><th>Total Tagihan Akhir (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listPrestasi as $m): ?>
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
        </tbody>
    </table>
</div>

</body>
</html>