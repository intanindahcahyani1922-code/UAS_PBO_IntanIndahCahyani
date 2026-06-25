<?php
// FILE: MahasiswaBidikmisi.php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan spesifik
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct($id, $nama, $nim, $semester, $ukt, $kip, $danaSaku) {
        parent::__construct($id, $nama, $nim, $semester, $ukt);
        $this->nomorKipKuliah = $kip;
        $this->danaSakuSubsidi = $danaSaku;
    }

    // Mengisi metode abstrak induk (Overriding awal)
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal; // Sementara mengembalikan UKT normal
    }

    public function tampilkanSpesifikasiAkademik() {
        return "💳 KIP: " . $this->nomorKipKuliah . " | 💰 Uang Saku: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    // 🗄️ METHOD QUERY INTERNAL SPESIFIK (Syarat Nilai 100)
    public static function getDaftarBidikmisi($db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'bidikmisi'";
        $result = $db->conn->query($query);
        $daftar = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $daftar[] = new self(
                    $row['id_mahasiswa'], 
                    $row['nama_mahasiswa'], 
                    $row['nim'], 
                    $row['semester'], 
                    $row['tarif_ukt_nominal'],
                    $row['nomor_kip_kuliah'],
                    $row['dana_saku_subsidi']
                );
            }
        }
        return $daftar;
    }
}