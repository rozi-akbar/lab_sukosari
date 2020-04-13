-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2020 pada 21.35
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hasil_lab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_antrian`
--

CREATE TABLE `tbl_antrian` (
  `id_antrian` varchar(30) NOT NULL,
  `no_rk` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasil_lab`
--

CREATE TABLE `tbl_hasil_lab` (
  `id_hasil_lab` varchar(30) NOT NULL,
  `no_rm` varchar(30) NOT NULL,
  `umur` int(5) NOT NULL,
  `diagnosa` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `permintaan` varchar(100) NOT NULL,
  `sampel_diterima` datetime NOT NULL,
  `selesai_dikerjakan` datetime NOT NULL,
  `hemoglobin` varchar(12) NOT NULL,
  `LED` int(3) NOT NULL,
  `hitung_eritrosit` varchar(9) NOT NULL,
  `hitung_leukosit` int(5) NOT NULL,
  `hitung_trombosit` int(8) NOT NULL,
  `hematocrit` varchar(7) NOT NULL,
  `hitung_jenis_leukosit` varchar(19) NOT NULL,
  `MCV` int(5) NOT NULL,
  `MCH` int(4) NOT NULL,
  `MCHC` int(4) NOT NULL,
  `masa_pendarahan` varchar(5) NOT NULL,
  `masa_pembekuan` varchar(5) NOT NULL,
  `protein` int(1) NOT NULL,
  `glukosa` int(1) NOT NULL,
  `urobilinogen` int(1) NOT NULL,
  `billirubin` int(1) NOT NULL,
  `nitrit` int(1) NOT NULL,
  `keton` int(1) NOT NULL,
  `berat_jenis` int(5) NOT NULL,
  `PH` int(5) NOT NULL,
  `eritrosit` int(2) NOT NULL,
  `leukosit` int(2) NOT NULL,
  `epithel` int(2) NOT NULL,
  `silinder` int(1) NOT NULL,
  `kristal` int(1) NOT NULL,
  `lain_lain` int(1) NOT NULL,
  `billirubin_direct` varchar(5) NOT NULL,
  `billirubin_total` varchar(5) NOT NULL,
  `SGOT` int(3) NOT NULL,
  `SGPT` int(3) NOT NULL,
  `alkali_phospatase` varchar(9) NOT NULL,
  `total_protein` varchar(5) NOT NULL,
  `albumin` varchar(5) NOT NULL,
  `globulin` varchar(5) NOT NULL,
  `gula_darah_puasa` varchar(5) NOT NULL,
  `gula_darah_2_jam_pp` varchar(5) NOT NULL,
  `gula_darah_sewaktu` varchar(5) NOT NULL,
  `kreatinin` varchar(5) NOT NULL,
  `ureum` int(3) NOT NULL,
  `uric_acid` varchar(5) NOT NULL,
  `cholesterol_total` int(3) NOT NULL,
  `trigliserida` int(3) NOT NULL,
  `HDL` int(3) NOT NULL,
  `LDL` int(3) NOT NULL,
  `golongan_darah` char(2) NOT NULL,
  `golongan_darah_rhesus` varchar(3) NOT NULL,
  `widal_o` int(1) NOT NULL,
  `widal_h` int(1) NOT NULL,
  `widal_bo` int(1) NOT NULL,
  `widal_ao` int(1) NOT NULL,
  `AD_IgG` int(1) NOT NULL,
  `AD_IgM` int(1) NOT NULL,
  `VDRL` int(1) NOT NULL,
  `anti_HIV` int(1) NOT NULL,
  `HBs_Ag` int(1) NOT NULL,
  `anti_HBs` varchar(20) NOT NULL,
  `mycobacterium_tuberculosis` int(1) NOT NULL,
  `mycobacterium_leprae` int(1) NOT NULL,
  `neisseria_gonnorrhoae` int(1) NOT NULL,
  `trichomonas_vaginalis` int(1) NOT NULL,
  `candida_albicans` int(1) NOT NULL,
  `bacterial_vaginosis` int(1) NOT NULL,
  `jamur_permukaan` int(1) NOT NULL,
  `natrium` int(3) NOT NULL,
  `kalium` varchar(4) NOT NULL,
  `chlorida` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hasil_lab`
--

INSERT INTO `tbl_hasil_lab` (`id_hasil_lab`, `no_rm`, `umur`, `diagnosa`, `tanggal`, `permintaan`, `sampel_diterima`, `selesai_dikerjakan`, `hemoglobin`, `LED`, `hitung_eritrosit`, `hitung_leukosit`, `hitung_trombosit`, `hematocrit`, `hitung_jenis_leukosit`, `MCV`, `MCH`, `MCHC`, `masa_pendarahan`, `masa_pembekuan`, `protein`, `glukosa`, `urobilinogen`, `billirubin`, `nitrit`, `keton`, `berat_jenis`, `PH`, `eritrosit`, `leukosit`, `epithel`, `silinder`, `kristal`, `lain_lain`, `billirubin_direct`, `billirubin_total`, `SGOT`, `SGPT`, `alkali_phospatase`, `total_protein`, `albumin`, `globulin`, `gula_darah_puasa`, `gula_darah_2_jam_pp`, `gula_darah_sewaktu`, `kreatinin`, `ureum`, `uric_acid`, `cholesterol_total`, `trigliserida`, `HDL`, `LDL`, `golongan_darah`, `golongan_darah_rhesus`, `widal_o`, `widal_h`, `widal_bo`, `widal_ao`, `AD_IgG`, `AD_IgM`, `VDRL`, `anti_HIV`, `HBs_Ag`, `anti_HBs`, `mycobacterium_tuberculosis`, `mycobacterium_leprae`, `neisseria_gonnorrhoae`, `trichomonas_vaginalis`, `candida_albicans`, `bacterial_vaginosis`, `jamur_permukaan`, `natrium`, `kalium`, `chlorida`) VALUES
('5e6a1032d0d6f', 'RK002', 45, 'dbd', '0000-00-00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', 0, 0, '', '', 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '', 0, '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('873hd78h', '', 0, '', '0000-00-00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', 0, 0, '', '', 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '', 0, '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket_param`
--

CREATE TABLE `tbl_paket_param` (
  `id_paket` varchar(10) NOT NULL,
  `nama_paket` varchar(20) NOT NULL,
  `harga` int(7) NOT NULL,
  `lab_terkait` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_param`
--

CREATE TABLE `tbl_param` (
  `id_param` varchar(10) NOT NULL,
  `nama_param` varchar(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `nilai_rujukan` varchar(30) NOT NULL,
  `metoda` varchar(20) NOT NULL,
  `harga` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penanggungjawab_lab`
--

CREATE TABLE `tbl_penanggungjawab_lab` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penanggungjawab_lab`
--

INSERT INTO `tbl_penanggungjawab_lab` (`nip`, `nama`) VALUES
('19750204 2006 04 1 009', 'dr. Fery Rudytio C.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`nip`, `nama`) VALUES
('19670309 1991 02 1 001', 'KARSONO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rm`
--

CREATE TABLE `tbl_rm` (
  `no_rm` varchar(30) NOT NULL,
  `no_ktp` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rm`
--

INSERT INTO `tbl_rm` (`no_rm`, `no_ktp`, `nama`, `alamat`) VALUES
('RK001', '3511087676250001', 'Rika Endalova', 'Jl. Cempaka Putih'),
('RK002', '3511081678730003', 'Roni Pranata', 'Jl. Cempaka Putih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `ID` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `username`, `nama`, `password`) VALUES
('USR001', 'ojanx', 'Ahmad Fauzan', 'ojan123'),
('USR002', 'jannah06', 'Ahmad Nurul Jannah', 'jannah123'),
('USR003', 'ahmad652', 'Ahmad Nurul Haq', 'haq453'),
('USR004', 'nurul26', 'Nurul Ramadhan', 'janjan231');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  ADD PRIMARY KEY (`id_antrian`);

--
-- Indeks untuk tabel `tbl_hasil_lab`
--
ALTER TABLE `tbl_hasil_lab`
  ADD PRIMARY KEY (`id_hasil_lab`);

--
-- Indeks untuk tabel `tbl_penanggungjawab_lab`
--
ALTER TABLE `tbl_penanggungjawab_lab`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `tbl_rm`
--
ALTER TABLE `tbl_rm`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
