-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2019 at 09:37 PM
-- Server version: 10.3.13-MariaDB-2
-- PHP Version: 7.2.19-0ubuntu0.19.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama_departemen` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
(1, 'Finishing'),
(2, 'Maintenance Mesin'),
(3, 'Maintenance Listrik'),
(4, 'Gudang Bahan'),
(6, 'Gudang Barang Jadi'),
(7, 'Personalia'),
(8, 'Pabrik Umum'),
(9, 'Akutansi'),
(10, 'Extruder Benang'),
(11, 'Circular Loom'),
(12, 'Bengkel'),
(13, 'Gudang Sparepart');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `nama_gudang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `id_gudang`, `nama_gudang`) VALUES
(1, 'GBB', 'Gudang Bahan Baku'),
(5, 'GSH', 'Gudang Sparepart Holding'),
(2, 'GSJ', 'Gudang Setengah Jadi'),
(3, 'GSP', 'Gudang Sparepart Msn'),
(4, 'SPU', 'Gudang Sparepart Karung');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`) VALUES
(1, 'SPAREPART'),
(2, 'BAHAN BAKU'),
(3, 'BARANG 1/2 JADI'),
(4, 'BARANG JADI'),
(6, 'BARANG BEKAS'),
(7, 'BARANG JUAL');

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `id_satuan` int(2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id`, `kode_barang`, `nama_barang`, `id_kategori`, `id_satuan`, `deskripsi`, `status_aktif`) VALUES
(46, 'BAN-001', 'Ban Luar 6.50', 1, 5, 'ban forklift', 1),
(35, 'BIJ-0002', 'Biji warna merah', 2, 6, 'ASDASD', 1),
(21, 'BIJ-001', 'Biji plastik PP PE', 2, 6, '', 1),
(41, 'BIJ-003', 'Biji Agus', 2, 6, 'Bijilu agus', 1),
(45, 'BIJ-005', 'biji kumis', 2, 5, 'asda', 1),
(19, 'CL-ROL-001', 'Karet roll ks', 1, 1, '', 1),
(17, 'LS-ACC-001', 'Accu NS 12V', 1, 5, 'aki forklift', 1),
(48, 'LS-CAP-001', 'Caping Lampu', 1, 5, '', 1),
(47, 'LS-FIT-001', 'Fitting HPL 125W', 1, 5, '', 1),
(29, 'LS-KAB-001', 'Kabel NNYHY 2x0,75mm', 1, 1, '', 1),
(32, 'LS-KAB-002', 'Kabel NYYHY 4X4', 1, 1, '', 1),
(27, 'LS-LAM-001', 'Lampu LED 24W', 1, 5, 'philips', 1),
(51, 'LS-LAM-002', 'Lampu TL 18W philips', 1, 5, '', 1),
(28, 'LS-LAM-020', 'LAMPU 40W', 1, 5, '', 1),
(20, 'LS-LIM-001', 'Limit Switch', 1, 5, '000', 1),
(49, 'LS-SAK-001', 'Saklar Inbow isi 2', 1, 5, 'broco', 1),
(50, 'LS-TER-001', 'Terminal plastik 6mm', 1, 5, '', 1),
(16, 'SP-BEA-001', 'Bearing 6001 ZZ FAG', 1, 5, '', 1),
(18, 'SP-BEA-005', 'Bearing 6005', 1, 5, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `nama_pegawai` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `id_departemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `id_pegawai`, `nama_pegawai`, `jabatan`, `id_departemen`) VALUES
(1, 'TAG01', 'Wibowanto', 'Pimpinan', 8),
(3, 'TGA02', 'Juli Arianto', 'Penyelia', 3),
(2, 'TGA701', 'Isnu Sindang Suraya', 'Administrasi', 13);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_barang`
--

CREATE TABLE `pembelian_barang` (
  `no_po` varchar(15) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_barang`
--

INSERT INTO `pembelian_barang` (`no_po`, `id_supplier`, `tanggal`, `keterangan`, `id_kategori`, `total_harga`) VALUES
('PO-GMS-1901-002', 3, '2019-03-07', 'zzz', 1, '1550000'),
('PO-GMS-1901-003', 2, '2019-02-03', 'woyowoyo', 1, '1880000'),
('PO-GMS-1902-001', 4, '2019-02-03', '', 1, '784000'),
('PO-GMS-1902-002', 2, '2019-02-12', 'z', 1, '62500');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_barang_detail`
--

CREATE TABLE `pembelian_barang_detail` (
  `no_po_detail` int(11) NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `no_ppb` varchar(16) NOT NULL,
  `no_ppb_detail` int(11) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(11,0) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_barang_detail`
--

INSERT INTO `pembelian_barang_detail` (`no_po_detail`, `no_po`, `no_ppb`, `no_ppb_detail`, `kode_barang`, `jumlah`, `harga`, `deskripsi`) VALUES
(32, 'PO-GMS-1902-001', 'PPB-GSH-1902-001', 58, 'LS-LAM-020', 5, '150000', ''),
(33, 'PO-GMS-1902-001', 'PPB-GSH-1902-001', 60, 'LS-LAM-002', 2, '10000', ''),
(34, 'PO-GMS-1902-001', 'PPB-GSP-1902-001', 64, 'SP-BEA-005', 1, '14000', ''),
(35, 'PO-GMS-1901-003', 'PPB-SPU-1901-001', 55, 'BAN-001', 1, '5000', 'zzz'),
(36, 'PO-GMS-1901-003', 'PPB-SPU-1901-001', 56, 'CL-ROL-001', 25, '75000', ''),
(37, 'PO-GMS-1902-002', 'PPB-GSH-1902-001', 70, 'LS-LAM-020', 5, '5000', ''),
(38, 'PO-GMS-1902-002', 'PPB-GSH-1902-001', 71, 'LS-TER-001', 5, '7500', ''),
(39, 'PO-GMS-1901-002', 'PPB-SPU-1901-001', 56, 'CL-ROL-001', 25, '50000', 'tesss'),
(40, 'PO-GMS-1901-002', 'PPB-GSP-1902-001', 64, 'SP-BEA-005', 3, '50000', ''),
(41, 'PO-GMS-1901-002', 'PPB-GSH-1902-001', 72, 'LS-FIT-001', 10, '15000', '');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barang`
--

CREATE TABLE `penerimaan_barang` (
  `no_bpb` varchar(16) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimaan_barang`
--

INSERT INTO `penerimaan_barang` (`no_bpb`, `id_supplier`, `id_gudang`, `no_po`, `tanggal`, `keterangan`) VALUES
('BPB-GSH-1903-001', 3, 'GSH', 'PO-GMS-1901-002', '2019-03-22', ''),
('BPB-SPU-1903-001', 2, 'SPU', 'PO-GMS-1901-003', '2019-03-20', 'azz'),
('BPB-SPU-1903-002', 2, 'SPU', 'PO-GMS-1901-003', '2019-03-22', ''),
('BPB-SPU-1903-003', 4, 'SPU', 'PO-GMS-1902-001', '2019-03-22', ''),
('BPB-SPU-1906-001', 2, 'SPU', 'PO-GMS-1902-002', '2019-06-13', 'stock');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barang_detail`
--

CREATE TABLE `penerimaan_barang_detail` (
  `no_bpb_detail` int(11) NOT NULL,
  `no_bpb` varchar(16) NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `no_po_detail` int(11) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimaan_barang_detail`
--

INSERT INTO `penerimaan_barang_detail` (`no_bpb_detail`, `no_bpb`, `no_po`, `no_po_detail`, `kode_barang`, `jumlah`, `deskripsi`) VALUES
(25, 'BPB-SPU-1903-001', 'PO-GMS-1901-003', 35, 'BAN-001', 1, ''),
(26, 'BPB-SPU-1903-002', 'PO-GMS-1901-003', 36, 'CL-ROL-001', 25, ''),
(27, 'BPB-GSH-1903-001', 'PO-GMS-1901-002', 41, 'LS-FIT-001', 10, ''),
(28, 'BPB-GSH-1903-001', 'PO-GMS-1901-002', 39, 'CL-ROL-001', 25, ''),
(29, 'BPB-GSH-1903-001', 'PO-GMS-1901-002', 40, 'SP-BEA-005', 3, ''),
(30, 'BPB-SPU-1903-003', 'PO-GMS-1902-001', 32, 'LS-LAM-020', 5, ''),
(31, 'BPB-SPU-1903-003', 'PO-GMS-1902-001', 33, 'LS-LAM-002', 2, ''),
(32, 'BPB-SPU-1903-003', 'PO-GMS-1902-001', 34, 'SP-BEA-005', 1, ''),
(33, 'BPB-SPU-1906-001', 'PO-GMS-1902-002', 37, 'LS-LAM-020', 5, ''),
(34, 'BPB-SPU-1906-001', 'PO-GMS-1902-002', 38, 'LS-TER-001', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_barang`
--

CREATE TABLE `pengeluaran_barang` (
  `no_bstb` varchar(17) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran_barang`
--

INSERT INTO `pengeluaran_barang` (`no_bstb`, `id_gudang`, `id_pegawai`, `id_departemen`, `id_kategori`, `tanggal`, `keterangan`) VALUES
('BSTB-SPU-1903-002', 'SPU', 'TGA701', 8, 1, '2019-06-13', ''),
('BSTB-SPU-1906-001', 'SPU', 'TAG01', 1, 1, '2019-06-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_barang_detail`
--

CREATE TABLE `pengeluaran_barang_detail` (
  `no_bstb_detail` int(11) NOT NULL,
  `no_bstb` varchar(17) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `no_PB` varchar(16) NOT NULL,
  `no_PB_detail` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran_barang_detail`
--

INSERT INTO `pengeluaran_barang_detail` (`no_bstb_detail`, `no_bstb`, `kode_barang`, `jumlah`, `no_PB`, `no_PB_detail`, `deskripsi`) VALUES
(39, 'BSTB-SPU-1906-001', 'LS-LAM-020', 5, 'SPB-SPU-1902-002', 8, 'penerangan gedung'),
(40, 'BSTB-SPU-1903-002', 'CL-ROL-001', 25, 'SPB-SPU-1903-001', 161, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `pengguna_id` varchar(30) NOT NULL,
  `pengguna_nama` varchar(25) DEFAULT NULL,
  `pengguna_sandi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `pengguna_id`, `pengguna_nama`, `pengguna_sandi`) VALUES
(1, 'admin', 'Isnu', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang`
--

CREATE TABLE `permintaan_barang` (
  `no_PB` varchar(16) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `id_departemen` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_barang`
--

INSERT INTO `permintaan_barang` (`no_PB`, `id_gudang`, `id_pegawai`, `id_departemen`, `tanggal`, `keterangan`, `id_kategori`) VALUES
('SPB-GSH-1902-001', 'GSH', 'TAG01', '2', '2019-02-02', 'instalasi listrik', 1),
('SPB-SPU-1902-001', 'SPU', 'TGA02', '3', '2019-02-17', 'instalasi mesin', 1),
('SPB-SPU-1902-002', 'SPU', 'TGA701', '10', '2019-02-25', '', 1),
('SPB-SPU-1903-001', 'SPU', 'TGA701', '2', '2019-03-05', 'zz', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang_detail`
--

CREATE TABLE `permintaan_barang_detail` (
  `no_PB_detail` int(11) NOT NULL,
  `no_PB` varchar(16) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_barang_detail`
--

INSERT INTO `permintaan_barang_detail` (`no_PB_detail`, `no_PB`, `kode_barang`, `jumlah`, `keterangan`) VALUES
(1, 'SPB-GSH-1902-001', 'LS-FIT-001', 5, ''),
(2, 'SPB-GSH-1902-001', 'LS-KAB-001', 50, ''),
(3, 'SPB-SPU-1902-001', 'LS-KAB-001', 50, ''),
(4, 'SPB-SPU-1902-001', 'LS-TER-001', 2, ''),
(5, 'SPB-SPU-1902-001', 'LS-FIT-001', 6, ''),
(6, 'SPB-SPU-1902-001', 'LS-LAM-001', 6, ''),
(7, 'SPB-SPU-1902-002', 'LS-FIT-001', 2, ''),
(8, 'SPB-SPU-1902-002', 'LS-LAM-020', 5, ''),
(158, 'SPB-SPU-1903-001', 'BAN-001', 39, ''),
(159, 'SPB-SPU-1903-001', 'LS-KAB-002', 10000, ''),
(160, 'SPB-SPU-1903-001', 'LS-SAK-001', 20, ''),
(161, 'SPB-SPU-1903-001', 'CL-ROL-001', 10000, ''),
(162, 'SPB-SPU-1903-001', 'LS-SAK-001', 20, ''),
(163, 'SPB-SPU-1903-001', 'LS-CAP-001', 5, ''),
(164, 'SPB-SPU-1903-001', 'LS-ACC-001', 2, ''),
(165, 'SPB-SPU-1903-001', 'LS-LIM-001', 25, ''),
(166, 'SPB-SPU-1903-001', 'LS-KAB-001', 410100, ''),
(167, 'SPB-SPU-1903-001', 'LS-KAB-001', 20, ''),
(168, 'SPB-SPU-1903-001', 'LS-FIT-001', 10, ''),
(169, 'SPB-SPU-1903-001', 'LS-SAK-001', 12, ''),
(170, 'SPB-SPU-1903-001', 'LS-LAM-020', 11111, ''),
(171, 'SPB-SPU-1903-001', 'CL-ROL-001', 10, ''),
(172, 'SPB-SPU-1903-001', 'LS-TER-001', 2000, ''),
(173, 'SPB-SPU-1903-001', 'LS-LAM-002', 255, ''),
(174, 'SPB-SPU-1903-001', 'LS-LIM-001', 20, ''),
(175, 'SPB-SPU-1903-001', 'SP-BEA-005', 200, ''),
(176, 'SPB-SPU-1903-001', 'CL-ROL-001', 40, ''),
(177, 'SPB-SPU-1903-001', 'LS-LAM-002', 255, ''),
(178, 'SPB-SPU-1903-001', 'LS-LIM-001', 200, ''),
(179, 'SPB-SPU-1903-001', 'LS-LAM-020', 25, ''),
(180, 'SPB-SPU-1903-001', 'LS-LAM-020', 2, ''),
(181, 'SPB-SPU-1903-001', 'LS-ACC-001', 25, ''),
(182, 'SPB-SPU-1903-001', 'LS-LAM-001', 1, ''),
(183, 'SPB-SPU-1903-001', 'SP-BEA-001', 100, ''),
(184, 'SPB-SPU-1903-001', 'LS-LAM-020', 2, ''),
(185, 'SPB-SPU-1903-001', 'SP-BEA-001', 21, ''),
(186, 'SPB-SPU-1903-001', 'LS-TER-001', 1, ''),
(187, 'SPB-SPU-1903-001', 'LS-CAP-001', 1, ''),
(188, 'SPB-SPU-1903-001', 'LS-TER-001', 21, ''),
(189, 'SPB-SPU-1903-001', 'LS-SAK-001', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pembelian`
--

CREATE TABLE `permintaan_pembelian` (
  `no_ppb` varchar(16) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `id_departemen` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_pembelian`
--

INSERT INTO `permintaan_pembelian` (`no_ppb`, `id_gudang`, `id_pegawai`, `id_departemen`, `tanggal`, `keterangan`, `id_kategori`) VALUES
('PPB-GSH-1902-001', 'GSH', 'TAG01', '2', '2019-02-02', 'instalasi mesin extruder', 1),
('PPB-GSP-1902-001', 'GSP', 'TGA701', '10', '2019-02-01', 'perbaikan mesin no. 2', 1),
('PPB-SPU-1901-001', 'SPU', 'TAG01', '1', '2019-01-31', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pembelian_detail`
--

CREATE TABLE `permintaan_pembelian_detail` (
  `no_ppb_detail` int(11) NOT NULL,
  `no_ppb` varchar(16) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_pembelian_detail`
--

INSERT INTO `permintaan_pembelian_detail` (`no_ppb_detail`, `no_ppb`, `kode_barang`, `jumlah`, `keterangan`) VALUES
(55, 'PPB-SPU-1901-001', 'BAN-001', 2, 'swallow'),
(56, 'PPB-SPU-1901-001', 'CL-ROL-001', 50, ''),
(57, 'PPB-SPU-1901-001', 'LS-ACC-001', 2, 'incoe'),
(63, 'PPB-GSP-1902-001', 'SP-BEA-001', 50, ''),
(64, 'PPB-GSP-1902-001', 'SP-BEA-005', 6, ''),
(70, 'PPB-GSH-1902-001', 'LS-LAM-020', 5, 'philips'),
(71, 'PPB-GSH-1902-001', 'LS-TER-001', 5, ''),
(72, 'PPB-GSH-1902-001', 'LS-FIT-001', 10, ''),
(73, 'PPB-GSH-1902-001', 'LS-LAM-002', 6, ''),
(74, 'PPB-GSH-1902-001', 'LS-LAM-001', 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `return_penerimaan_barang`
--

CREATE TABLE `return_penerimaan_barang` (
  `no_rpb` varchar(16) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `no_bpb` varchar(16) NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_penerimaan_barang`
--

INSERT INTO `return_penerimaan_barang` (`no_rpb`, `id_gudang`, `id_supplier`, `no_bpb`, `no_po`, `keterangan`, `tanggal`) VALUES
('RPB-SPU-1902-001', 'SPU', 2, 'BPB-GSH-1902-001', 'PO-GMS-1901-003', 'tes tis', '2019-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `return_penerimaan_barang_detail`
--

CREATE TABLE `return_penerimaan_barang_detail` (
  `no_rpb_detail` int(11) NOT NULL,
  `no_rpb` varchar(16) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `no_bpb` varchar(16) NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_bpb_detail` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_penerimaan_barang_detail`
--

INSERT INTO `return_penerimaan_barang_detail` (`no_rpb_detail`, `no_rpb`, `id_gudang`, `no_bpb`, `no_po`, `kode_barang`, `jumlah`, `deskripsi`, `no_bpb_detail`, `tanggal`) VALUES
(16, 'RPB-SPU-1902-001', 'SPU', 'BPB-GSH-1902-001', 'PO-GMS-1901-003', 'BAN-001', 1, '', 11, '2019-03-07'),
(17, 'RPB-SPU-1902-001', 'SPU', 'BPB-GSH-1902-001', 'PO-GMS-1901-003', 'CL-ROL-001', 20, '', 12, '2019-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `return_pengeluaran_barang`
--

CREATE TABLE `return_pengeluaran_barang` (
  `no_rebstb` varchar(19) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `no_bstb` varchar(17) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_pengeluaran_barang`
--

INSERT INTO `return_pengeluaran_barang` (`no_rebstb`, `id_gudang`, `id_departemen`, `id_pegawai`, `no_bstb`, `tanggal`, `keterangan`) VALUES
('REBSTB-GSJ-1902-001', 'GSJ', 8, 'TAG01', 'BSTB-SPU-1902-002', '2019-03-09', 'sisa'),
('REBSTB-GSP-1902-002', 'GSP', 1, 'TAG01', 'BSTB-GSH-1902-001', '2019-02-25', ''),
('REBSTB-GSP-1902-003', 'GSP', 2, 'TGA02', 'BSTB-SPU-1902-001', '2019-03-09', 'yeah'),
('REBSTB-SPU-1906-001', 'SPU', 3, 'TGA02', 'BSTB-SPU-1906-001', '2019-06-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `return_pengeluaran_barang_detail`
--

CREATE TABLE `return_pengeluaran_barang_detail` (
  `no_rebstb_detail` int(11) NOT NULL,
  `no_rebstb` varchar(19) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_bstb` varchar(20) NOT NULL,
  `no_bstb_detail` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_pengeluaran_barang_detail`
--

INSERT INTO `return_pengeluaran_barang_detail` (`no_rebstb_detail`, `no_rebstb`, `kode_barang`, `jumlah`, `deskripsi`, `no_bstb`, `no_bstb_detail`, `tanggal`) VALUES
(21, 'REBSTB-GSP-1902-002', 'LS-FIT-001', 5, '', 'BSTB-GSH-1902-001', 19, '2019-02-25'),
(38, 'REBSTB-GSP-1902-003', 'LS-FIT-001', 6, '', 'BSTB-SPU-1902-001', 18, '2019-03-09'),
(39, 'REBSTB-GSP-1902-003', 'LS-TER-001', 2, '', 'BSTB-SPU-1902-001', 16, '2019-03-09'),
(40, 'REBSTB-GSP-1902-003', 'LS-KAB-001', 50, '', 'BSTB-SPU-1902-001', 14, '2019-03-09'),
(41, 'REBSTB-GSJ-1902-001', 'LS-FIT-001', 1, '', 'BSTB-SPU-1902-002', 21, '2019-03-09'),
(42, 'REBSTB-GSJ-1902-001', 'LS-LAM-020', 3, '', 'BSTB-SPU-1902-002', 22, '2019-03-09'),
(43, 'REBSTB-SPU-1906-001', 'LS-LAM-020', 2, '', 'BSTB-SPU-1906-001', 39, '2019-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id_satuan`, `nama_satuan`) VALUES
(5, 'BUAH'),
(7, 'DRUM'),
(8, 'KALENG'),
(6, 'KG'),
(9, 'LITER'),
(1, 'METER');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `id_gudang` varchar(3) NOT NULL,
  `no_ref` varchar(25) NOT NULL,
  `jumlah` decimal(10,0) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `kode_barang`, `id_gudang`, `no_ref`, `jumlah`, `tanggal`) VALUES
(8, 'BAN-001', 'SPU', 'BPB-SPU-1903-001', '1', '2019-03-01 19:08:08'),
(15, 'CL-ROL-001', 'SPU', 'BPB-SPU-1903-002', '25', '2019-03-22 19:10:08'),
(16, 'LS-FIT-001', 'GSH', 'BPB-GSH-1903-001', '10', '2019-03-22 19:11:13'),
(17, 'CL-ROL-001', 'GSH', 'BPB-GSH-1903-001', '25', '2019-03-22 19:11:13'),
(18, 'SP-BEA-005', 'GSH', 'BPB-GSH-1903-001', '3', '2019-03-22 19:11:13'),
(19, 'LS-LAM-020', 'SPU', 'BPB-SPU-1903-003', '5', '2019-03-22 19:11:36'),
(20, 'LS-LAM-002', 'SPU', 'BPB-SPU-1903-003', '2', '2019-03-22 19:11:36'),
(21, 'SP-BEA-005', 'SPU', 'BPB-SPU-1903-003', '1', '2019-03-22 19:11:36'),
(24, 'LS-LAM-020', 'SPU', 'BPB-SPU-1906-001', '5', '2019-06-13 21:23:30'),
(25, 'LS-TER-001', 'SPU', 'BPB-SPU-1906-001', '5', '2019-06-13 21:23:31'),
(26, 'LS-LAM-020', 'SPU', 'BSTB-SPU-1906-001', '-5', '2019-06-13 21:25:23'),
(27, 'LS-LAM-020', 'SPU', 'REBSTB-SPU-1906-001', '2', '2019-06-13 21:26:04'),
(28, 'CL-ROL-001', 'SPU', 'BSTB-SPU-1903-002', '-25', '2019-06-13 21:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` text NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`, `provinsi`, `email`) VALUES
(2, 'Pancamanunggal Jaya Tehnik', '024 7475522', 'MT haryono semarang', 'Jawa Tengah', 'pancamanunggal@gmail.com'),
(3, 'Sutindo Raya Mulia', '024200224', 'Kawasan Candi Industri Semarang', 'Jawa Tengah', 'sutindo@sutindo.com'),
(4, 'Bintang Jaya', '0271 223344', 'Sidoharjo', 'Jawa Timur', 'bintangjaya@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  ADD PRIMARY KEY (`no_po`);

--
-- Indexes for table `pembelian_barang_detail`
--
ALTER TABLE `pembelian_barang_detail`
  ADD PRIMARY KEY (`no_po_detail`);

--
-- Indexes for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD PRIMARY KEY (`no_bpb`);

--
-- Indexes for table `penerimaan_barang_detail`
--
ALTER TABLE `penerimaan_barang_detail`
  ADD PRIMARY KEY (`no_bpb_detail`);

--
-- Indexes for table `pengeluaran_barang`
--
ALTER TABLE `pengeluaran_barang`
  ADD PRIMARY KEY (`no_bstb`);

--
-- Indexes for table `pengeluaran_barang_detail`
--
ALTER TABLE `pengeluaran_barang_detail`
  ADD PRIMARY KEY (`no_bstb_detail`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`no_PB`);

--
-- Indexes for table `permintaan_barang_detail`
--
ALTER TABLE `permintaan_barang_detail`
  ADD PRIMARY KEY (`no_PB_detail`),
  ADD KEY `no_PB` (`no_PB`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `permintaan_pembelian`
--
ALTER TABLE `permintaan_pembelian`
  ADD PRIMARY KEY (`no_ppb`);

--
-- Indexes for table `permintaan_pembelian_detail`
--
ALTER TABLE `permintaan_pembelian_detail`
  ADD PRIMARY KEY (`no_ppb_detail`);

--
-- Indexes for table `return_penerimaan_barang`
--
ALTER TABLE `return_penerimaan_barang`
  ADD PRIMARY KEY (`no_rpb`);

--
-- Indexes for table `return_penerimaan_barang_detail`
--
ALTER TABLE `return_penerimaan_barang_detail`
  ADD PRIMARY KEY (`no_rpb_detail`);

--
-- Indexes for table `return_pengeluaran_barang`
--
ALTER TABLE `return_pengeluaran_barang`
  ADD PRIMARY KEY (`no_rebstb`);

--
-- Indexes for table `return_pengeluaran_barang_detail`
--
ALTER TABLE `return_pengeluaran_barang_detail`
  ADD PRIMARY KEY (`no_rebstb_detail`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id_satuan`),
  ADD UNIQUE KEY `nama_satuan` (`nama_satuan`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `nama_supplier` (`nama_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pembelian_barang_detail`
--
ALTER TABLE `pembelian_barang_detail`
  MODIFY `no_po_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `penerimaan_barang_detail`
--
ALTER TABLE `penerimaan_barang_detail`
  MODIFY `no_bpb_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `pengeluaran_barang_detail`
--
ALTER TABLE `pengeluaran_barang_detail`
  MODIFY `no_bstb_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permintaan_barang_detail`
--
ALTER TABLE `permintaan_barang_detail`
  MODIFY `no_PB_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `permintaan_pembelian_detail`
--
ALTER TABLE `permintaan_pembelian_detail`
  MODIFY `no_ppb_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `return_penerimaan_barang_detail`
--
ALTER TABLE `return_penerimaan_barang_detail`
  MODIFY `no_rpb_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `return_pengeluaran_barang_detail`
--
ALTER TABLE `return_pengeluaran_barang_detail`
  MODIFY `no_rebstb_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
