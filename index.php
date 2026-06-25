<?php
// FILE: index.php

require_once 'database.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

$db = new Database();

// 1. SATU QUERY UNTUK SEMUA: Mengambil seluruh data mahasiswa secara dinamis
$query = "SELECT * FROM tabel_mahasiswa";
$result = $db->conn->query($query);

// 2. SATU ARRAY TUNGGAL: Semua jenis mahasiswa disatukan di sini (Prinsip Polimorfisme)
$daftarMahasiswa = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Objek dibuat secara dinamis berdasarkan kolom jenis_pembayaran
        if ($row['jenis_pembayaran'] == 'mandiri') {
            $daftarMahasiswa[] = new MahasiswaMandiri(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'],
                $row['golongan_ukt'], $row['nama_wali']
            );
        } elseif ($row['jenis_pembayaran'] == 'bidikmisi') {
            $daftarMahasiswa[] = new MahasiswaBidikmisi(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'],
                $row['nomor_kip_kuliah'], $row['dana_saku_subsidi']
            );
        } elseif ($row['jenis_pembayaran'] == 'prestasi') {
            $daftarMahasiswa[] = new MahasiswaPrestasi(
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
    <title>Sistem Registrasi Pembayaran UKT - Polimorfisme Murni</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f8fafc; padding: 30px; margin: 0; color: #1e293b; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #0f172a; margin-bottom: 5px; }
        .identitas { text-align: center; color: #64748b; font-size: 1.1em; margin-bottom: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #ffffff; }
        th, td { padding: 14px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background-color: #1e293b; color: white; font-weight: 600; }
        tr:hover { background-color: #f8fafc; }
        
        /* Badge badge penanda kategori otomatis */
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 0.85em; font-weight: bold; text-transform: uppercase; }
        .badge-mandiri { background-color: #dbeafe; color: #1e40af; }
        .badge-bidikmisi { background-color: #fef3c7; color: #92400e; }
        .badge-prestasi { background-color: #dcfce7; color: #166534; }
        
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

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Kategori Skema (Dinamis)</th>
                <th>Tarif UKT Asli</th>
                <th>Spesifikasi Akademik (Polimorfik)</th>
                <th>Total Tagihan Akhir (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($daftarMahasiswa)): ?>
                <tr><td colspan="7" style="text-align:center;">Tidak ada data mahasiswa di database.</td></tr>
            <?php else: ?>
                <?php foreach ($daftarMahasiswa as $m): ?>
                    <?php 
                        // Mendeteksi nama Class secara dinamis untuk menentukan warna badge
                        $namaKelas = get_class($m); 
                        $badgeClass = 'badge-mandiri';
                        $labelKategori = 'Mandiri';
                        
                        if ($namaKelas === 'MahasiswaBidikmisi') {
                            $badgeClass = 'badge-bidikmisi';
                            $labelKategori = 'Bidikmisi';
                        } elseif ($namaKelas === 'MahasiswaPrestasi') {
                            $badgeClass = 'badge-prestasi';
                            $labelKategori = 'Prestasi';
                        }
                    ?>
                    <tr>
                        <td><?= $m->getId(); ?></td>
                        <td><?= $m->getNim(); ?></td>
                        <td><strong><?= htmlspecialchars($m->getNama()); ?></strong></td>
                        <td>
                            <span class="badge <?= $badgeClass; ?>"><?= $labelKategori; ?></span>
                        </td>
                        <td>Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.'); ?></td>
                        
                        <td><?= $m->tampilkanSpesifikasiAkademik(); ?></td>
                        
                        <td class="<?= $m->hitungTagihanSemester() == 0 ? 'gratis' : 'tagihan'; ?>">
                            Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.'); ?>
                            <?= $m->hitungTagihanSemester() == 0 ? ' (Gratis)' : ''; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>