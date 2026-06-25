<?php
// FILE: MahasiswaMandiri.php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik
    private $golonganUkt;
    private $namaWali;

    public function __construct($id, $nama, $nim, $semester, $ukt, $golongan, $wali) {
        parent::__construct($id, $nama, $nim, $semester, $ukt);
        $this->golonganUkt = $golongan;
        $this->namaWali = $wali;
    }

    // Mengisi metode abstrak induk (Overriding awal)
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal; // Sementara mengembalikan UKT normal
    }

    public function tampilkanSpesifikasiAkademik() {
        return "👤 Wali: " . $this->namaWali . " | " . $this->golonganUkt;
    }

    // 🗄️ METHOD QUERY INTERNAL SPESIFIK (Syarat Nilai 100)
    public static function getDaftarMandiri($db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'mandiri'";
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
                    $row['golongan_ukt'],
                    $row['nama_wali']
                );
            }
        }
        return $daftar;
    }
}