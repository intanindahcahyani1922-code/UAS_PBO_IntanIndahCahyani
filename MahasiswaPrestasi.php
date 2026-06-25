<?php
// FILE: MahasiswaPrestasi.php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct($id, $nama, $nim, $semester, $ukt, $instansi, $ipk) {
        parent::__construct($id, $nama, $nim, $semester, $ukt);
        $this->namaInstansiBeasiswa = $instansi;
        $this->minimalIpkSyarat = $ipk;
    }

    // 🔥 TAHAP 5 OVERRIDING: Tagihan = Potongan Beasiswa 25% dari UKT asli
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "🏆 Beasiswa: " . $this->namaInstansiBeasiswa . " (Min IPK: " . $this->minimalIpkSyarat . ")";
    }

    // 🗄️ TAHAP 4: METHOD QUERY INTERNAL SPESIFIK
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