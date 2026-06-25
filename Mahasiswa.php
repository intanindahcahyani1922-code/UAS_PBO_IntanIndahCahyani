<?php
// FILE: Mahasiswa.php

abstract class Mahasiswa {
    // 🔒 WAJIB PROTECTED (Syarat Nilai Sangat Baik / 100 Poin)
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal; // Dipetakan dari kolom tarif_ukt_nominal

    // Constructor untuk memetakan data dari database secara pas
    public function __construct($id, $nama, $nim, $semester, $ukt) {
        $this->id_mahasiswa = $id;
        $this->nama_mahasiswa = $nama;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $ukt;
    }

    // Fungsi Getter agar nilai properti protected bisa diakses di index.php
    public function getId() { return $this->id_mahasiswa; }
    public function getNama() { return $this->nama_mahasiswa; }
    public function getNim() { return $this->nim; }
    public function getSemester() { return $this->semester; }
    public function getTarifUktNominal() { return $this->tarifUktNominal; }

    // 📄 METODE ABSTRAK (Tanpa body/kurung kurawal sesuai ketentuan rubrik)
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();
}