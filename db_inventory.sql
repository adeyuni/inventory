-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2016 at 01:26 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(20) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `vendor` varchar(50) DEFAULT NULL,
  `no_po` varchar(30) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `no_it`, `no_asset`, `sn`, `type`, `merk`, `vendor`, `no_po`, `no_do`, `tgl_terima`, `pic`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(1, 'Printer', 15080262, '4010815-193', 'QWERTYUIO', 'DELL 2014', 'DELL', 'DELL', '', '', '2016-05-27', '9,12', 'Joshua', 4, '', 1, '2016-05-03 14:17:55', 1, '2016-05-17 11:16:49'),
(2, 'Kabel Server', 15080252, '4010815-193', 'Serial server', 'DELL 2014', 'DELL', 'DELL', '', '', '2016-05-27', '4,5', 'Joshua', 1, 'qweqwe', 1, '2016-05-03 14:58:23', 1, '2016-05-18 13:07:43'),
(3, 'Printer', 15080252, '4010815-193', 'QWERTYUIO', 'CANON', 'CANON MP240', 'CANON MP240', '', '', '2016-05-14', '1,2,3', 'Joshua', 1, '', 1, '2016-05-12 18:24:04', 0, '0000-00-00 00:00:00'),
(4, 'Scanner', 15080252, '4010815-193', 'scannerqwertyu', 'DELL 2014', 'DELL', 'DELL', '100100', '', '2016-05-27', '1,4', '', 1, '', 1, '2016-05-12 18:33:45', 1, '2016-05-13 10:53:49'),
(5, 'hardisk', 4445454, '15355454', '12345', '1542121', 'WD purple', 'WD purple', 'asdqwe', '1453221', '2016-05-19', '9', 'wina', 1, 'hardisk purple', 1, '2016-05-19 16:13:32', 1, '2016-05-19 16:16:23'),
(6, 'kabel', 44454, '15355', '1234', '154212', 'vga', 'vga', 'asdqwe', '1453221', '2016-05-19', '9', 'wina', 1, 'kabel vga', 1, '2016-05-19 16:14:24', 1, '2016-05-19 16:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `cpu`
--

CREATE TABLE IF NOT EXISTS `cpu` (
`id` int(11) NOT NULL,
  `no_po` varchar(30) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(20) NOT NULL,
  `service_tag` varchar(15) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `nama_pc` varchar(50) DEFAULT NULL,
  `id_mon1` int(11) DEFAULT NULL,
  `id_mon2` int(11) DEFAULT NULL,
  `id_keyboard` int(11) DEFAULT NULL,
  `id_mouse` int(11) DEFAULT NULL,
  `id_ups` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `vendor` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpu`
--

INSERT INTO `cpu` (`id`, `no_po`, `no_do`, `no_it`, `no_asset`, `service_tag`, `sn`, `nama_pc`, `id_mon1`, `id_mon2`, `id_keyboard`, `id_mouse`, `id_ups`, `type`, `merk`, `vendor`, `tgl_terima`, `pic`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(16, '', '', 15080215, '4010815-181', '16LD862', '', 'GDN-PC-001', 0, 0, 0, 0, 0, 'DELL 2014', 'DELL', 'DELL', '2016-05-11', '9,12', '', 4, '', 1, '2016-05-10 14:26:55', 1, '2016-05-18 13:03:09'),
(17, '', '', 15080257, '4010815-195', 'IUQYEI', 'IUQYWIEUYQIEWIQUEYIQ', 'GDN-PC-002', 7, 0, 4, 24, 3, 'DELL 2014', 'DELL', 'DELL', '2016-05-13', '2,3', '', 3, '', 1, '2016-05-10 14:35:31', 1, '2016-05-10 17:02:21'),
(18, '', '', 15080002, '4010815-193', 'AASDFG', '', 'GDN-PC-100', 13, 7, 3, 23, 5, 'OPTIPLEX 3020', 'DELL', 'DELL', '2016-05-13', '9', 'Joshua', 1, '', 1, '2016-05-13 13:45:00', 1, '2016-05-13 15:17:01'),
(19, '', '', 15080333, '', 'B5KQWE', '', 'GDN-PC-111', 0, 0, 0, 0, 0, 'DELL 2014', 'DELL', 'DELL', '2016-05-16', '9,12', '', 1, '', 1, '2016-05-16 15:49:55', 0, '0000-00-00 00:00:00'),
(20, '', 'dododo', 15080190, '', 'SDFSFDS', '', '', 9, 0, 0, 0, 0, 'DELL', 'DELL', 'DELL', '2016-05-24', '8,9', '', 2, '', 1, '2016-05-16 15:58:02', 1, '2016-05-16 16:12:54'),
(21, '', '', 123456789, '', 'ZXCASD', '', 'GDN-PC-190', 0, 0, 0, 0, 0, 'DELL 2014', 'DELL', 'DELL', '2016-05-18', '9,12', '', 1, 'testing', 1, '2016-05-17 11:29:01', 1, '2016-05-17 13:43:09'),
(22, '', '', 544446, '', 'ASDFGQWER', '', '', 0, 0, 0, 0, 0, 'DELL 2014', 'DELL', 'DELL', '2016-05-17', '9,12', '', 4, '', 1, '2016-05-17 13:45:35', 0, '0000-00-00 00:00:00'),
(23, '', '', 544446, '', 'ASDFGQWER', '', '', 0, 0, 0, 0, 0, 'DELL 2014', 'DELL', 'DELL', '2016-05-17', '9,12', '', 1, 'asdasd', 1, '2016-05-17 14:05:28', 1, '2016-05-17 14:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `imac`
--

CREATE TABLE IF NOT EXISTS `imac` (
`id` int(11) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(50) NOT NULL,
  `sn_imac` varchar(50) DEFAULT NULL,
  `sn_keyboard` varchar(50) DEFAULT NULL,
  `sn_mouse` varchar(50) DEFAULT NULL,
  `id_ups` int(50) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(100) NOT NULL,
  `nama_imac` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imac`
--

INSERT INTO `imac` (`id`, `no_it`, `no_asset`, `sn_imac`, `sn_keyboard`, `sn_mouse`, `id_ups`, `type`, `merk`, `vendor`, `no_po`, `no_do`, `tgl_terima`, `pic`, `nama_imac`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(1, 15080252, '4010815-193', 'QWERTYUIOP', 'QWERTYUIO', 'QWERTYU', 4, 'MAC', 'MAC', 'MACCC', '100100', '', '2016-05-12', '3', 'IMAC-27', '', 2, 'werw', 1, '2016-05-12 18:32:25', 1, '2016-05-17 15:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `keyboard`
--

CREATE TABLE IF NOT EXISTS `keyboard` (
`id` int(11) NOT NULL,
  `no_po` varchar(30) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(20) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `vendor` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keyboard`
--

INSERT INTO `keyboard` (`id`, `no_po`, `no_do`, `no_it`, `no_asset`, `sn`, `type`, `merk`, `vendor`, `tgl_terima`, `pic`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(3, '', '', 15080163, '', 'CN09RRC74872954G030M', 'DELL 2016', 'Dell', 'Dell', '2016-04-01', '1,2', 'Joshua', 1, '', 1, '2016-04-25 09:48:24', 1, '2016-05-18 12:52:33'),
(4, '', '', 15080166, '', 'CN09RRC74872954G02ZU', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '4,5,6', '', 0, '', 1, '2016-04-25 09:48:35', 0, '0000-00-00 00:00:00'),
(5, '', '', 15080169, '', 'CN09RRC74872954G07XE', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '4,5,6', NULL, 0, '', 1, '2016-04-25 09:48:44', 0, '0000-00-00 00:00:00'),
(6, '', '', 15080172, '', 'CN09RRC74872954G02Z0', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '4,5,6', NULL, 0, '', 1, '2016-04-25 09:48:55', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

CREATE TABLE IF NOT EXISTS `laptop` (
`id` int(11) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(50) NOT NULL,
  `sn_lp` varchar(50) NOT NULL,
  `sn_hd` varchar(50) NOT NULL,
  `sn_baterai` varchar(50) NOT NULL,
  `sn_charger` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(100) NOT NULL,
  `nama_laptop` varchar(50) NOT NULL,
  `kode_laptop` varchar(50) NOT NULL,
  `id_mon1` int(11) DEFAULT NULL,
  `id_mouse` int(11) DEFAULT NULL,
  `user` varchar(50) NOT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`id`, `no_it`, `no_asset`, `sn_lp`, `sn_hd`, `sn_baterai`, `sn_charger`, `type`, `merk`, `vendor`, `no_po`, `no_do`, `tgl_terima`, `pic`, `nama_laptop`, `kode_laptop`, `id_mon1`, `id_mouse`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(1, 15080500, '4010815-303', 'SNLAptop', 'SNHardisk', 'SNBaterai', 'SNCharger', 'HP 2016', 'HP', 'HP', '', '', '2016-05-27', '12', 'DEV LTP 001', 'DLTP 001', 9, 22, 'Joshua', 2, '					      						      						      						      						      					      					      					      ', 1, '2016-05-13 10:55:37', 1, '2016-05-17 14:35:45'),
(2, 15080503, '4010815-304', 'SNLaptop1', 'SNHardisk1', 'SNBaterai1', 'SNCharger1', 'HP 2016', 'HP', 'HP', '', '', '2016-05-27', '9', 'DEV LTP 002', 'DLTP 002', 0, 0, '', 0, '', 1, '2016-05-13 10:55:58', 0, '0000-00-00 00:00:00'),
(3, 15080154, '', 'AGSDJAS', '', '', '', 'HP', 'HP', 'HP', '', '', '2016-05-13', '9,12', '', '', 0, 0, '', 0, '', 1, '2016-05-13 15:21:20', 1, '2016-05-13 15:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `nama`) VALUES
(1, 'Tubun'),
(2, 'Cawang'),
(3, 'Jatibaru'),
(4, 'Ceper');

-- --------------------------------------------------------

--
-- Table structure for table `monitor`
--

CREATE TABLE IF NOT EXISTS `monitor` (
`id` int(11) NOT NULL,
  `no_po` varchar(30) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(20) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `vendor` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitor`
--

INSERT INTO `monitor` (`id`, `no_po`, `no_do`, `no_it`, `no_asset`, `sn`, `type`, `merk`, `vendor`, `tgl_terima`, `pic`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(7, '', '', 15080482, '4010815-265', 'CN022R0T7287255PA7UL', '2014Hc', 'Dell', 'Dell Indonesia', '2016-04-29', '9,12', 'Joshua', 4, '', 1, '2016-04-25 09:46:48', 1, '2016-05-18 13:07:58'),
(8, '', '', 15080464, '4010815-266', 'CN022R0T7287255PDGRL', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '1,2,3', NULL, 0, '', 1, '2016-04-25 09:47:02', 0, '0000-00-00 00:00:00'),
(9, '', '', 15080252, '4010815-193', 'CN09RRC74872954G030M', 'DELL 2014', 'DELL', 'DELL', '2016-04-01', '1,2,3', 'Joshua', 0, '', 1, '2016-04-25 11:23:33', 0, '0000-00-00 00:00:00'),
(12, '1324679', '', 16010099, '', 'QWERTYUIO123456', '', 'DELL', 'DELL', '2016-05-20', '1,2,3', NULL, 0, '', 1, '2016-05-11 12:34:51', 1, '2016-05-11 12:37:47'),
(13, '', '', 15080157, '', '213', 'DELL 2014', 'DELL', 'DELL', '2016-05-13', '9,12', NULL, 3, '', 1, '2016-05-16 18:14:50', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mouse`
--

CREATE TABLE IF NOT EXISTS `mouse` (
`id` int(11) NOT NULL,
  `no_po` varchar(30) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(20) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `vendor` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mouse`
--

INSERT INTO `mouse` (`id`, `no_po`, `no_do`, `no_it`, `no_asset`, `sn`, `type`, `merk`, `vendor`, `tgl_terima`, `pic`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(22, '100100', '', 15080165, '', 'CN09RRC74872954G030M', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '7,8', 'Joshua', 4, '', 1, '2016-04-25 09:51:46', 1, '2016-05-18 12:57:43'),
(23, '', '', 15080166, '', 'CN09RRC74872954G02ZU', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '4,5,6', 'Joshua', 0, '', 1, '2016-04-25 09:51:57', 0, '0000-00-00 00:00:00'),
(24, '', '', 15080169, '', 'CN09RRC74872954G07XE', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '4,5,6', '', 0, '', 1, '2016-04-25 09:52:06', 0, '0000-00-00 00:00:00'),
(25, '', '', 15080172, '', 'CN09RRC74872954G02Z0', 'DELL 2014', 'Dell', 'Dell', '2016-04-01', '4,5,6', NULL, 0, '', 1, '2016-04-25 09:52:30', 0, '0000-00-00 00:00:00'),
(26, 'daad', '', 132646, '', 'dsadas', '', '', '', '2016-05-13', '8,9', '', 0, '', 1, '2016-05-13 16:25:39', 1, '2016-05-13 16:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE IF NOT EXISTS `pic` (
`id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`id`, `nama`) VALUES
(1, 'Ade'),
(2, 'Bagus'),
(3, 'Candra'),
(4, 'Fachrizal'),
(5, 'Ivan'),
(6, 'Joshua'),
(7, 'Jovian'),
(8, 'Kevin'),
(9, 'Lidwina'),
(12, 'Yacob');

-- --------------------------------------------------------

--
-- Table structure for table `rekap`
--

CREATE TABLE IF NOT EXISTS `rekap` (
`rekap_id` int(11) NOT NULL,
  `rekap_no_po` varchar(100) NOT NULL,
  `rekap_cp` varchar(20) DEFAULT NULL,
  `rekap_vendor` varchar(255) DEFAULT NULL,
  `rekap_lokasi` varchar(100) DEFAULT NULL,
  `rekap_diterima_supplier` varchar(100) DEFAULT NULL,
  `rekap_invoice` varchar(100) DEFAULT NULL,
  `rekap_tgl_terima` date NOT NULL,
  `rekap_id_creator` int(11) NOT NULL,
  `rekap_time_create` datetime NOT NULL,
  `rekap_id_editor` int(11) DEFAULT NULL,
  `rekap_time_edit` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap`
--

INSERT INTO `rekap` (`rekap_id`, `rekap_no_po`, `rekap_cp`, `rekap_vendor`, `rekap_lokasi`, `rekap_diterima_supplier`, `rekap_invoice`, `rekap_tgl_terima`, `rekap_id_creator`, `rekap_time_create`, `rekap_id_editor`, `rekap_time_edit`) VALUES
(21, 'PO/001/ITA', '088888888', 'Vendor Dell', '2', 'Ya', 'INVOICE/ITA/2016', '2016-05-14', 1, '2016-05-20 15:26:50', NULL, NULL),
(22, 'PO/ABC', '085725', 'Vendor Dell', '4', 'Ya', 'INVOICE/ITA/2016', '2016-05-13', 1, '2016-05-20 17:47:38', NULL, NULL),
(23, 'PoLaptop', NULL, 'Vendor Dell', '2', 'Ya', 'sudah ada', '2016-05-12', 1, '2016-05-20 18:03:27', NULL, NULL),
(24, 'PO/ABCD/ABC', '085725667500', 'Vendor Dell', '2', 'Ya', 'sudah ada', '2016-05-13', 1, '2016-05-20 18:17:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekap_dtl`
--

CREATE TABLE IF NOT EXISTS `rekap_dtl` (
`rekap_dtl_id` int(11) NOT NULL,
  `rekap_dtl_id_rekap` int(11) NOT NULL,
  `rekap_dtl_nama` varchar(255) NOT NULL,
  `rekap_dtl_harga` varchar(100) NOT NULL,
  `rekap_dtl_jml` int(11) NOT NULL,
  `rekap_dtl_beredar` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap_dtl`
--

INSERT INTO `rekap_dtl` (`rekap_dtl_id`, `rekap_dtl_id_rekap`, `rekap_dtl_nama`, `rekap_dtl_harga`, `rekap_dtl_jml`, `rekap_dtl_beredar`) VALUES
(9, 21, 'Optiplex 3020', '5.000.000', 30, NULL),
(12, 22, 'Scanner', '1.000.000', 10, NULL),
(13, 23, 'HP', '1.000.000', 1, NULL),
(14, 24, 'Printer Canon', '5.000.000', 1, NULL),
(15, 24, 'Printer HP', '5.000.000', 2, NULL),
(16, 24, 'Printer Zebra', '3.0000.0000', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smartphone`
--

CREATE TABLE IF NOT EXISTS `smartphone` (
`id` int(11) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `no_asset` varchar(50) NOT NULL,
  `no_it` int(11) NOT NULL,
  `sn_smartphone` varchar(50) NOT NULL,
  `imei1` varchar(50) NOT NULL,
  `imei2` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smartphone`
--

INSERT INTO `smartphone` (`id`, `no_po`, `no_do`, `no_asset`, `no_it`, `sn_smartphone`, `imei1`, `imei2`, `type`, `merk`, `vendor`, `tgl_terima`, `pic`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(2, '1231', '', '4010815-193', 15080252, '', 'imei phone', 'imei phone 2', 'DELL 2014', 'DELL', 'DELL', '2016-04-15', '1,2,7,8', 'Tes', 4, 'testing ada apa			      						      						      						      						      						      						      						      						      						      					      					      					      					      					      					      					      					      					      					      ', 1, '2016-04-22 06:25:07', 1, '2016-05-17 15:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `type_barang`
--

CREATE TABLE IF NOT EXISTS `type_barang` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_barang`
--

INSERT INTO `type_barang` (`id`, `nama`) VALUES
(1, 'CPU'),
(2, 'Monitor'),
(3, 'Keyboard'),
(4, 'Mouse'),
(5, 'UPS'),
(6, 'Printer'),
(7, 'Scanner'),
(100, 'Laptop'),
(200, 'Smartphone'),
(300, 'IMAC'),
(999, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `ups`
--

CREATE TABLE IF NOT EXISTS `ups` (
`id` int(11) NOT NULL,
  `no_po` varchar(30) NOT NULL,
  `no_do` varchar(100) NOT NULL,
  `no_it` int(11) NOT NULL,
  `no_asset` varchar(20) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `vendor` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `location` int(11) NOT NULL,
  `ket` text NOT NULL,
  `id_creator` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `id_editor` int(11) NOT NULL,
  `time_editor` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ups`
--

INSERT INTO `ups` (`id`, `no_po`, `no_do`, `no_it`, `no_asset`, `sn`, `type`, `merk`, `vendor`, `tgl_terima`, `pic`, `user`, `location`, `ket`, `id_creator`, `time_create`, `id_editor`, `time_editor`) VALUES
(3, '', '', 15080176, '4010815-156', '3B1447X22809', 'APC 123', 'APC', 'APC', '2016-04-01', '8,12', NULL, 3, '', 1, '2016-04-25 09:53:34', 1, '2016-05-17 10:18:36'),
(4, '', '', 15080154, '4010815-153', '3B1447X25489', 'APC 123', 'APC', 'APC', '2016-04-01', '4,5,6', '', 0, '', 1, '2016-04-25 09:53:53', 0, '0000-00-00 00:00:00'),
(5, '', '', 15080999, '4010815-993', 'ASDFG', 'APC 123', 'APC', 'APC', '2016-06-03', '1,3', 'Joshua', 2, '', 1, '2016-05-10 14:56:47', 1, '2016-05-18 12:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpu`
--
ALTER TABLE `cpu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imac`
--
ALTER TABLE `imac`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `no_it` (`no_it`);

--
-- Indexes for table `keyboard`
--
ALTER TABLE `keyboard`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laptop`
--
ALTER TABLE `laptop`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `no_it` (`no_it`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mouse`
--
ALTER TABLE `mouse`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap`
--
ALTER TABLE `rekap`
 ADD PRIMARY KEY (`rekap_id`);

--
-- Indexes for table `rekap_dtl`
--
ALTER TABLE `rekap_dtl`
 ADD PRIMARY KEY (`rekap_dtl_id`);

--
-- Indexes for table `smartphone`
--
ALTER TABLE `smartphone`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `no_it` (`no_it`);

--
-- Indexes for table `type_barang`
--
ALTER TABLE `type_barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ups`
--
ALTER TABLE `ups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cpu`
--
ALTER TABLE `cpu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `imac`
--
ALTER TABLE `imac`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keyboard`
--
ALTER TABLE `keyboard`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `laptop`
--
ALTER TABLE `laptop`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `mouse`
--
ALTER TABLE `mouse`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `rekap`
--
ALTER TABLE `rekap`
MODIFY `rekap_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `rekap_dtl`
--
ALTER TABLE `rekap_dtl`
MODIFY `rekap_dtl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `smartphone`
--
ALTER TABLE `smartphone`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_barang`
--
ALTER TABLE `type_barang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `ups`
--
ALTER TABLE `ups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
