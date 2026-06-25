<?php
// FILE: v_bidikmisi.php
require_once 'database.php';
require_once 'MahasiswaBidikmisi.php';

$db = new Database();
$data = MahasiswaBidikmisi::getDaftarBidikmisi($db);
?>
<h2>📊 Kategori: Mahasiswa Bidikmisi</h2>
<table>
    <thead>
        <tr><th>ID</th><th>NIM</th><th>Nama Mahasiswa</th><th>Semester</th><th>Tarif UKT Asli</th><th>Spesifikasi</th><th>Tagihan Akhir</th></tr>
    </thead>
    <tbody>
        <?php foreach ($data as $m): ?>
            <tr>
                <td><?= $m->getId(); ?></td>
                <td><?= $m->getNim(); ?></td>
                <td><strong><?= htmlspecialchars($m->getNama()); ?></strong></td>
                <td>Semester <?= $m->getSemester(); ?></td>
                <td>Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.'); ?></td>
                <td><?= $m->tampilkanSpesifikasiAkademik(); ?></td>
                <td style="font-weight:bold; color:#dc2626; font-style:italic;">Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.'); ?> (Gratis)</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>