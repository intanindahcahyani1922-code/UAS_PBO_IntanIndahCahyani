<?php
// FILE: MahasiswaPrestasi.php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan spesifik
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct($id, $nama, $nim, $semester, $ukt, $instansi, $ipk) {
        parent::__construct($id, $nama, $nim, $semester, $ukt);
        $this->namaInstansiBeasiswa = $instansi;
        $this->minimalIpkSyarat = $ipk;
    }

    // Mengisi metode abstrak induk (Overriding awal)
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal; // Sementara mengembalikan UKT normal
    }

    public function tampilkanSpesifikasiAkademik() {
        return "🏆 Beasiswa: " . $this->namaInstansiBeasiswa . " (Min IPK: " . $this->minimalIpkSyarat . ")";
    }

    // 🗄️ METHOD QUERY INTERNAL SPESIFIK (Syarat Nilai 100)
    public static function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'prestasi'";
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
                    $row['nama_instansi_beasiswa'],
                    $row['minimal_ipk_bersyarat']
                );
            }
        }
        return $daftar;
    }
}