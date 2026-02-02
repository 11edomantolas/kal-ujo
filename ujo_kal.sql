-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2026 at 01:31 AM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujo_kal`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkutan`
--

CREATE TABLE `angkutan` (
  `id` int(11) NOT NULL,
  `tipe_angkutan` varchar(50) NOT NULL,
  `nomor_polisi` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `angkutan`
--

INSERT INTO `angkutan` (`id`, `tipe_angkutan`, `nomor_polisi`, `created_at`, `updated_at`) VALUES
(1, 'Dumptruck', 'A 9296 TY', '2025-12-15 06:54:49', '2025-12-15 09:00:26'),
(2, 'Dumptruck', 'A 9293 TY', '2025-12-15 06:54:49', '2025-12-15 09:00:31'),
(3, 'Dumptruck', 'A 9289 TY', '2025-12-15 06:54:49', '2025-12-15 09:00:35'),
(4, 'Dumptruck', 'A 9295 TY', '2025-12-15 06:54:49', '2025-12-15 09:00:39'),
(5, 'Dumptruck', 'A 9303 TY', '2025-12-15 06:54:49', '2025-12-15 09:00:43'),
(6, 'Dumptruck', 'A 9302 TY', '2025-12-15 06:54:49', '2025-12-15 09:00:51'),
(7, 'Dumptruck', 'A 9290 TY', '2025-12-15 06:54:49', '2025-12-15 09:01:06'),
(8, 'Dumptruck', 'A 9291 TY', '2025-12-15 06:54:49', '2025-12-15 09:01:11'),
(9, 'Dumptruck', 'A 9301 TY', '2025-12-15 06:54:49', '2025-12-15 09:01:17'),
(10, 'Dumptruck', 'A 9294 TY', '2025-12-15 06:54:49', '2025-12-15 09:01:24'),
(11, 'Old Quester', 'A 9661 TX', '2025-12-15 08:16:36', '2025-12-15 08:16:36'),
(12, 'Old Quester', 'A 9662 TX', '2025-12-15 08:16:36', '2025-12-15 08:16:36'),
(13, 'Old Quester', 'A 9663 TX', '2025-12-15 08:16:36', '2025-12-15 08:16:36'),
(14, 'Old Quester', 'A 9664 TX', '2025-12-15 08:16:36', '2025-12-15 08:16:36'),
(15, 'Old Quester', 'A 9665 TX', '2025-12-15 08:17:41', '2025-12-15 08:17:41'),
(16, 'New Quester', 'A 9668 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(17, 'New Quester', 'A 9670 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(18, 'New Quester', 'A 9672 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(19, 'New Quester', 'A 9673 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(20, 'New Quester', 'A 9674 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(21, 'New Quester', 'A 9675 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(22, 'New Quester', 'A 9676 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(23, 'New Quester', 'A 9677 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(24, 'New Quester', 'A 9678 S', '2025-12-15 08:18:55', '2025-12-15 08:18:55'),
(25, 'Scania', 'B 9575 SEH', '2025-12-15 08:20:22', '2025-12-15 09:02:19'),
(26, 'Scania', 'B 9578 SEH', '2025-12-15 08:20:22', '2025-12-15 09:02:19'),
(27, 'Scania', 'B 9583 SEH', '2025-12-15 08:20:22', '2025-12-15 09:02:19'),
(28, 'Scania', 'B 9584 SEH', '2025-12-15 08:20:22', '2025-12-15 09:02:19'),
(29, 'Scania', 'B 9585 SEH', '2025-12-15 08:20:22', '2025-12-15 09:02:19'),
(30, 'Scania', 'B 9587 SEH', '2025-12-15 08:20:22', '2025-12-15 09:02:19'),
(31, 'Scania', 'B 9577 SEH', '2025-12-15 08:20:22', '2025-12-15 09:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `kode_bank` varchar(20) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `kode_bank`, `nama_bank`, `created_at`, `updated_at`) VALUES
(2, '008', 'MANDIRI', '2025-11-17 01:40:43', '2026-01-07 06:43:02'),
(6, '014', 'BCA', '2025-11-17 06:10:40', '2026-01-07 08:42:55'),
(7, '002', 'BRI', '2025-11-17 06:13:01', '2026-01-07 06:42:57'),
(12, '009', 'BNI', '2025-12-15 06:26:18', '2026-01-07 06:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`id`, `cargo`, `created_at`, `updated_at`) VALUES
(1, 'Coil', '2025-11-21 08:26:01', '2025-11-21 08:26:09'),
(2, 'Plate', '2025-11-21 08:26:14', '2025-11-21 08:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `nomor_rekening` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `nama`, `no_telepon`, `nama_bank`, `nomor_rekening`, `created_at`, `updated_at`) VALUES
(1, 'Ichwana', '082321180105', 'Mandiri', '1630004017680', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(2, 'Adi Sunardi', '082124088020', 'Mandiri', '1630006331139', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(3, 'Isna', '081908228530', 'Mandiri', '1630005643492', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(4, 'Saeful Bahri', '083824306630', 'Mandiri', '1630005093417', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(5, 'Ma\'ruf', '087881491931', 'Mandiri', '1630004085521', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(6, 'Milup', '081233708652', 'Mandiri', '1630004016567', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(7, 'M. Susanto', '081906264843', 'Mandiri', '1630004046333', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(8, 'Rokhman', '087830587830', 'Mandiri', '1630004206424', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(9, 'Dadan', '085891160146', 'Mandiri', '1630004014919', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(10, 'Rowiyan', '083856654251', 'Mandiri', '1630004089671', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(11, 'Romli', '085280010354', 'Mandiri', '1630004014893', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(12, 'Rudiyanto', '081646080256', 'Mandiri', '1630004046101', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(13, 'Iwan Setiawan', '087884016018', 'Mandiri', '1630004016484', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(14, 'Ade. Supriyadi', '087774445533', 'Mandiri', '1630000633233', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(15, 'Agung Rival', '087876544830', 'Mandiri', '1630005567592', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(16, 'Ari Purnomo', '082310314494', 'Mandiri', '1630005604718', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(17, 'Adi Subakti', '081289207972', 'Mandiri', '1630006582392', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(18, 'Samudi', '083827273072', 'Mandiri', '1760003756424', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(19, 'Yudha Kurniawan', '081944209982', 'Mandiri', '1630003200261', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(24, 'Ade Supriadi', '081212214417', 'Mandiri', '1630003794107', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(25, 'Haerul Badri', '089603936084', 'Mandiri', '1630004572098', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(26, 'Kurniawan', '081223757542', 'Mandiri', '1630003793604', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(27, 'Rizki Hermawan', '087811277649', 'Mandiri', '1630005570695', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(28, 'Ade Septian', '083812775669', 'Mandiri', '1630009818777', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(29, 'Samsul Bahri', '087813243254', 'Mandiri', '1630010149659', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(30, 'Amat Ali', '081399607879', 'Mandiri', '1630005917573', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(31, 'Mugni', '083821428793', 'Mandiri', '1140029120949', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(32, 'Sumadi', '083854612956', 'Mandiri', '1630011380048', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(33, 'Haerul Anwar', '087871440515', 'BNI', '1630010223876', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(34, 'Agus Arifandi', '087772226541', 'Mandiri', '1630014567013', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(35, 'Samsul Bahri', '085965821589', 'Mandiri', '0489193856', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(36, 'Solihin', '087849521748', 'Mandiri', '1630002018615', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(37, 'Achmad Achibulloh', '087876159967', 'Mandiri', '1630002006172', '2025-12-15 06:31:24', '2025-12-18 02:13:17'),
(38, 'Suneni', '085929856518', 'Mandiri', '1630002013798', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(39, 'Lamri', '081315444100', 'Mandiri', '1630002020868', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(40, 'Udi', '085218519504', 'Mandiri', '1630002018375', '2025-12-15 06:31:24', '2025-12-16 02:48:39'),
(41, 'Ahmad Taufikulloh', '087852877308', 'Mandiri', '1630002009234', '2025-12-15 06:31:24', '2025-12-18 02:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `created_at`) VALUES
(11, 40, '4c25e75897acca2524896392711da80585484d2c3eeb35a40347dac7ebf8f31af694652c0cbdfba481e2f09c3801bf57ae2a', '2024-09-28 09:12:16'),
(12, 139, '262562c101f6e3243140bee385a16aedfdcb3725b233c4feb22ccf05b8d2f48406e2cbcf18222117ee00a1c71c01047bc62d', '2025-07-07 22:32:23'),
(13, 223, 'a92869a44218ad2aff9afc64f8423bf3009fd77414fe1d89c913bccaa111cdac350e5754e37b0d7d2ac9b83898afb81b4115', '2025-12-30 06:25:05'),
(14, 223, 'd15efc47797bcbf368fe8b2420cafe3833319deb84143c4ad9c0e8b3e513f057e35839ed9fa28e4f37a93eb0d195000e7d64', '2025-12-30 06:34:24'),
(15, 223, '758d6652d1c8a812a19fca1b91ad2f367fb5f7a6585089aaca5f9ce37af3e0ea', '2025-12-30 06:47:53'),
(16, 223, '1434bc0f8b05483dc05589387cd005e9f782221baabfdb51826eae958f9eb522', '2025-12-30 06:52:17'),
(17, 224, 'ba6c4ffd1b052d6a3415bcec06aa34609a1bee3d6ecd980799502e2c28bf8d59', '2025-12-30 06:54:57'),
(18, 223, '4294cad9f6db431fff8758b67c63273857d06f2bd291b37c5d406304a9af7965', '2025-12-30 06:58:14'),
(19, 223, '0940ebc7c5d47dea829267188628a478b023fd55dbab59a13afe3ee3ec574856', '2025-12-30 07:09:05'),
(20, 223, '9a671bd57ccd57c7b878de588e127443c0604bae91d6cbc653bcc4c661829a06', '2025-12-30 07:09:23'),
(21, 223, '6df1a7b2fa5fcca621b35eaa9b4314d08c980b62a51c39ebe067f93f7da38932', '2026-01-02 01:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_angkutan`
--

CREATE TABLE `tipe_angkutan` (
  `id` int(11) NOT NULL,
  `nama_tipe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipe_angkutan`
--

INSERT INTO `tipe_angkutan` (`id`, `nama_tipe`) VALUES
(1, 'Old Quester'),
(4, 'New Quester'),
(18, 'Dumptruck'),
(19, 'Scania');

-- --------------------------------------------------------

--
-- Table structure for table `uang_jalan`
--

CREATE TABLE `uang_jalan` (
  `id` int(11) NOT NULL,
  `no_cs` varchar(20) DEFAULT NULL,
  `rit_ke` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `tipe_pekerjaan` varchar(50) NOT NULL,
  `no_unit` varchar(20) NOT NULL,
  `driver` varchar(100) NOT NULL,
  `nomor_rekening` varchar(50) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `no_surat_jalan` varchar(50) NOT NULL,
  `tonase` decimal(10,2) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `ritase` int(11) DEFAULT NULL,
  `tipe_angkutan` varchar(100) NOT NULL,
  `vesel` varchar(100) DEFAULT NULL,
  `additional` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `alasan` text DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `ujo` int(15) NOT NULL,
  `ujo_terbayar` int(15) NOT NULL DEFAULT 0,
  `ujo_sisa` int(15) NOT NULL DEFAULT 0,
  `status` enum('Pending','Approved','Revision','Rejected') NOT NULL DEFAULT 'Pending',
  `status_pekerjaan` enum('Uncompleted','Completed') DEFAULT 'Uncompleted',
  `catatan` text DEFAULT NULL,
  `status_pembayaran` enum('Unpaid','Partial','Paid') NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uang_jalan`
--

INSERT INTO `uang_jalan` (`id`, `no_cs`, `rit_ke`, `tanggal`, `tipe_pekerjaan`, `no_unit`, `driver`, `nomor_rekening`, `nama_bank`, `no_surat_jalan`, `tonase`, `cargo`, `origin`, `destination`, `ritase`, `tipe_angkutan`, `vesel`, `additional`, `alasan`, `jumlah`, `ujo`, `ujo_terbayar`, `ujo_sisa`, `status`, `status_pekerjaan`, `catatan`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(7, 'CS2025-00015', 1, '2026-01-08', 'Domestik', 'A 9665 TX', '	Ahmad Taufikulloh\n', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'CILEGON', 'KENDAL', 1, 'Old Quester', NULL, 'tidak', '', 0, 5906600, 0, 5906600, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-08 03:09:42', '2026-01-19 02:43:41'),
(9, 'CS2025-00021', 1, '2026-01-09', 'Export/Import', 'B 9587 SEH', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 3, 'Scania', 'MV. LUCKY STAR', 'tidak', '', 0, 127387, 0, 127387, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-09 01:49:14', '2026-01-19 02:43:41'),
(10, 'CS2025-00021', 2, '2026-01-09', 'Export/Import', 'B 9587 SEH', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 3, 'Scania', 'MV. LUCKY STAR', 'tidak', '', 0, 127387, 0, 127387, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-09 01:49:14', '2026-01-19 02:43:41'),
(27, 'CS2025-00021', 3, '2026-01-09', 'Export/Import', 'B 9587 SEH', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 3, 'Scania', 'MV. LUCKY STAR', 'tidak', '', 0, 127387, 0, 127387, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-09 07:38:19', '2026-01-19 02:43:41'),
(28, 'CS2025-0002113', 1, '2026-01-12', 'Export/Import', 'A 9663 TX', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'PELINDO', 4, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 344280, 0, 344280, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-12 00:52:26', '2026-01-19 02:43:41'),
(29, 'CS2025-0002113', 2, '2026-01-12', 'Export/Import', 'A 9663 TX', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'PELINDO', 4, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 344280, 0, 344280, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-12 00:52:26', '2026-01-19 02:43:41'),
(30, 'CS2025-0002113', 3, '2026-01-12', 'Export/Import', 'A 9663 TX', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'PELINDO', 4, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 344280, 0, 344280, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-12 00:52:26', '2026-01-19 02:43:41'),
(31, 'CS2025-0002113', 4, '2026-01-12', 'Export/Import', 'A 9663 TX', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'PELINDO', 4, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 344280, 0, 344280, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-12 00:52:26', '2026-01-19 02:43:41'),
(32, 'CS2025-00021123', 1, '2026-01-12', 'Domestik', 'A 9672 S', 'Agung Rival', '1630005567592', 'Mandiri', '', '0.00', 'Coil', 'CILEGON', 'CILEGON', 1, 'New Quester', NULL, 'tidak', '', 0, 292600, 0, 292600, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-12 06:50:39', '2026-01-19 02:43:41'),
(33, 'CS2025-0002122', 1, '2026-01-13', 'Domestik', 'A 9677 S', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'CILEGON', 'CILEGON', 1, 'New Quester', NULL, 'tidak', '', 0, 292600, 234080, 58520, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-13 01:57:25', '2026-01-19 02:43:41'),
(34, 'CS2025-000212312', 1, '2026-01-14', 'Domestik', 'A 9670 S', 'Rudiyanto', '1630004046101', 'Mandiri', 'abc', '20.00', 'Coil', 'CILEGON', 'CILEGON', 1, 'New Quester', NULL, 'tidak', '', 0, 292600, 234080, 58520, 'Approved', 'Completed', NULL, 'Partial', '2026-01-14 01:32:48', '2026-01-28 06:22:29'),
(35, 'CS2025-0002256', 1, '2026-01-15', 'Export/Import', 'A 9668 S', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'KBS', 5, 'New Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 205560, 164448, 41112, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-15 02:18:06', '2026-01-19 02:43:41'),
(36, 'CS2025-0002256', 2, '2026-01-15', 'Export/Import', 'A 9668 S', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'KBS', 5, 'New Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 205560, 164448, 41112, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-15 02:18:06', '2026-01-19 02:43:41'),
(37, 'CS2025-0002256', 3, '2026-01-15', 'Export/Import', 'A 9668 S', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'KBS', 5, 'New Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 205560, 164448, 41112, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-15 02:18:06', '2026-01-19 02:43:41'),
(38, 'CS2025-0002256', 4, '2026-01-15', 'Export/Import', 'A 9668 S', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'KBS', 5, 'New Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 205560, 164448, 41112, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-15 02:18:06', '2026-01-19 02:43:41'),
(39, 'CS2025-0002256', 5, '2026-01-15', 'Export/Import', 'A 9668 S', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'KRAKATAU POSCO', 'KBS', 5, 'New Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 205560, 164448, 41112, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-15 02:18:06', '2026-01-19 00:39:41'),
(40, 'CS2025-000212314', 1, '2026-01-20', 'Domestik', 'A 9672 S', 'Rudiyanto', '1630004046101', 'Mandiri', '', '0.00', 'Coil', 'CILEGON', 'CILEGON', 1, 'New Quester', NULL, 'tidak', '', 0, 292600, 0, 292600, 'Approved', 'Uncompleted', NULL, 'Unpaid', '2026-01-20 06:35:42', '2026-01-20 06:37:23'),
(41, 'CS2025-000221', 1, '2026-01-21', 'Domestik', 'A 9672 S', 'Dadan', '1630004014919', 'Mandiri', '', '0.00', 'Coil', 'CILEGON', 'CILEGON', 1, 'New Quester', NULL, 'tidak', '', 0, 292600, 0, 292600, 'Pending', 'Uncompleted', NULL, 'Unpaid', '2026-01-21 03:20:22', '2026-01-21 03:20:22'),
(42, 'CS2025-000212335', 1, '2026-01-27', 'Export/Import', 'A 9661 TX', 'Samudi', '1760003756424', 'Mandiri', 'abc', '90.00', 'Coil', 'PLB KBS', 'KBS', 6, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 123960, 99168, 24792, 'Approved', 'Completed', NULL, 'Partial', '2026-01-27 08:57:11', '2026-01-27 09:02:01'),
(43, 'CS2025-000212335', 2, '2026-01-27', 'Export/Import', 'A 9661 TX', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 6, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 123960, 99168, 24792, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-27 08:57:11', '2026-01-27 08:58:21'),
(44, 'CS2025-000212335', 3, '2026-01-27', 'Export/Import', 'A 9661 TX', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 6, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 123960, 99168, 24792, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-27 08:57:11', '2026-01-27 08:58:21'),
(45, 'CS2025-000212335', 4, '2026-01-27', 'Export/Import', 'A 9661 TX', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 6, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 123960, 99168, 24792, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-27 08:57:11', '2026-01-27 08:58:21'),
(46, 'CS2025-000212335', 5, '2026-01-27', 'Export/Import', 'A 9661 TX', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 6, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 123960, 99168, 24792, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-27 08:57:11', '2026-01-27 08:58:21'),
(47, 'CS2025-000212335', 6, '2026-01-27', 'Export/Import', 'A 9661 TX', 'Samudi', '1760003756424', 'Mandiri', '', '0.00', 'Coil', 'PLB KBS', 'KBS', 6, 'Old Quester', 'MV. LUCKY STAR', 'tidak', '', 0, 123960, 99168, 24792, 'Approved', 'Uncompleted', NULL, 'Partial', '2026-01-27 08:57:11', '2026-01-27 08:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `uang_jalan_pokok`
--

CREATE TABLE `uang_jalan_pokok` (
  `id` int(11) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `tipe_angkutan` varchar(50) NOT NULL,
  `uang_jalan_pokok` int(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uang_jalan_pokok`
--

INSERT INTO `uang_jalan_pokok` (`id`, `origin`, `destination`, `tipe_angkutan`, `uang_jalan_pokok`, `created_at`, `updated_at`) VALUES
(1, 'CILEGON', 'CILEGON', 'Old Quester', 319800, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(2, 'CILEGON', 'CILEGON', 'New Quester', 292600, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(3, 'CILEGON', 'CILEGON', 'Scania', 336936, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(4, 'CILEGON', 'MERAK', 'Old Quester', 442200, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(5, 'CILEGON', 'MERAK', 'New Quester', 401400, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(6, 'CILEGON', 'MERAK', 'Scania', 467904, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(7, 'CILEGON', 'KRAMATWATU', 'Old Quester', 527880, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(8, 'CILEGON', 'KRAMATWATU', 'New Quester', 477560, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(9, 'CILEGON', 'KRAMATWATU', 'Scania', 559582, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(10, 'CILEGON', 'BOJONEGARA', 'Old Quester', 418760, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(11, 'CILEGON', 'BOJONEGARA', 'New Quester', 353480, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(12, 'CILEGON', 'BOJONEGARA', 'Scania', 439323, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(13, 'CILEGON', 'CIKANDE (JAWILAN)', 'Old Quester', 940440, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(14, 'CILEGON', 'CIKANDE (JAWILAN)', 'New Quester', 788120, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(15, 'CILEGON', 'CIKANDE (JAWILAN)', 'Scania', 988421, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(16, 'CILEGON', 'CIKANDE (MODERN)', 'Old Quester', 940440, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(17, 'CILEGON', 'CIKANDE (MODERN)', 'New Quester', 788120, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(18, 'CILEGON', 'CIKANDE (MODERN)', 'Scania', 988421, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(19, 'CILEGON', 'BALARAJA / TANGERANG', 'Old Quester', 1459760, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(20, 'CILEGON', 'BALARAJA / TANGERANG', 'New Quester', 1224480, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(21, 'CILEGON', 'BALARAJA / TANGERANG', 'Scania', 1533873, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(22, 'CILEGON', 'JAKARTA BARAT', 'Old Quester', 1948120, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(23, 'CILEGON', 'JAKARTA BARAT', 'New Quester', 1606760, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(24, 'CILEGON', 'JAKARTA BARAT', 'Scania', 2055648, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(25, 'CILEGON', 'JAKARTA TIMUR', 'Old Quester', 2010120, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(26, 'CILEGON', 'JAKARTA TIMUR', 'New Quester', 1668760, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(27, 'CILEGON', 'JAKARTA TIMUR', 'Scania', 2117648, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(28, 'CILEGON', 'JAKARTA UTARA', 'Old Quester', 2010120, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(29, 'CILEGON', 'JAKARTA UTARA', 'New Quester', 1668760, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(30, 'CILEGON', 'JAKARTA UTARA', 'Scania', 2117648, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(31, 'CILEGON', 'BEKASI', 'Old Quester', 2249680, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(32, 'CILEGON', 'BEKASI', 'New Quester', 1856640, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(33, 'CILEGON', 'BEKASI', 'Scania', 2373488, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(34, 'CILEGON', 'CIKARANG', 'Old Quester', 1985200, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(35, 'CILEGON', 'CIKARANG', 'New Quester', 1767600, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(36, 'CILEGON', 'CIKARANG', 'Scania', 2053744, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(37, 'CILEGON', 'KARAWANG', 'Old Quester', 2860140, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(38, 'CILEGON', 'KARAWANG', 'New Quester', 2354220, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(39, 'CILEGON', 'KARAWANG', 'Scania', 3019505, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(40, 'CILEGON', 'BOGOR', 'Old Quester', 2451640, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(41, 'CILEGON', 'BOGOR', 'New Quester', 2013720, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(42, 'CILEGON', 'BOGOR', 'Scania', 2589585, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(43, 'CILEGON', 'PURWAKARTA', 'Old Quester', 3064900, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(44, 'CILEGON', 'PURWAKARTA', 'New Quester', 2527700, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(45, 'CILEGON', 'PURWAKARTA', 'Scania', 3234118, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(46, 'CILEGON', 'MAJALENGKA', 'Old Quester', 4390880, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(47, 'CILEGON', 'MAJALENGKA', 'New Quester', 3576240, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(48, 'CILEGON', 'MAJALENGKA', 'Scania', 4647492, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(49, 'CILEGON', 'INDRAMAYU', 'Old Quester', 4546480, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(50, 'CILEGON', 'INDRAMAYU', 'New Quester', 3725040, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(51, 'CILEGON', 'INDRAMAYU', 'Scania', 4805234, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(52, 'CILEGON', 'KENDAL', 'Old Quester', 5906600, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(53, 'CILEGON', 'KENDAL', 'New Quester', 4811800, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(54, 'CILEGON', 'KENDAL', 'Scania', 6251462, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(55, 'CILEGON', 'SURABAYA', 'Old Quester', 10918080, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(56, 'CILEGON', 'SURABAYA', 'New Quester', 8491840, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(57, 'CILEGON', 'SURABAYA', 'Scania', 12307346, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(58, 'CILEGON', 'LAMPUNG - SAEPI', 'Old Quester', 12000240, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(59, 'CILEGON', 'LAMPUNG - SAEPI', 'New Quester', 11283520, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(60, 'CILEGON', 'LAMPUNG - SAEPI', 'Scania', 12226007, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(61, 'CILEGON', 'LAMPUNG - PANJANG', 'Old Quester', 12000240, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(62, 'CILEGON', 'LAMPUNG - PANJANG', 'New Quester', 11283520, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(63, 'CILEGON', 'LAMPUNG - PANJANG', 'Scania', 12226007, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(64, 'CILEGON', 'BEKASI - PALEMBANG', 'Old Quester', 20302680, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(65, 'CILEGON', 'BEKASI - PALEMBANG', 'New Quester', 18957640, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(66, 'CILEGON', 'BEKASI - PALEMBANG', 'Scania', 20726368, '2026-01-07 01:26:38', '2026-01-07 09:48:09'),
(67, 'KRAKATAU POSCO', 'PELINDO', 'Old Quester', 344280, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(68, 'KRAKATAU POSCO', 'PELINDO', 'New Quester', 314360, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(69, 'KRAKATAU POSCO', 'PELINDO', 'Scania', 363130, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(70, 'KAWASAN KIEC 1', 'PELINDO', 'Old Quester', 381000, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(71, 'KAWASAN KIEC 1', 'PELINDO', 'New Quester', 347000, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(72, 'KAWASAN KIEC 1', 'PELINDO', 'Scania', 402420, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(73, 'KAWASAN KIEC 2', 'PELINDO', 'Old Quester', 160680, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(74, 'KAWASAN KIEC 2', 'PELINDO', 'New Quester', 151160, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(75, 'KAWASAN KIEC 2', 'PELINDO', 'Scania', 166678, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(76, 'PT. KS HSM 1', 'PELINDO', 'Old Quester', 344280, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(77, 'PT. KS HSM 1', 'PELINDO', 'New Quester', 314360, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(78, 'PT. KS HSM 1', 'PELINDO', 'Scania', 363130, '2026-01-07 01:30:34', '2026-01-07 09:48:09'),
(79, 'KRAKATAU POSCO', 'KBS', 'Old Quester', 221880, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(80, 'KRAKATAU POSCO', 'KBS', 'New Quester', 205560, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(81, 'KRAKATAU POSCO', 'KBS', 'Scania', 232162, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(82, 'KAWASAN KIEC 1', 'KBS', 'Old Quester', 258600, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(83, 'KAWASAN KIEC 1', 'KBS', 'New Quester', 238200, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(84, 'KAWASAN KIEC 1', 'KBS', 'Scania', 271452, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(85, 'KAWASAN KIEC 2', 'KBS', 'Old Quester', 197400, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(86, 'KAWASAN KIEC 2', 'KBS', 'New Quester', 183800, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(87, 'KAWASAN KIEC 2', 'KBS', 'Scania', 205968, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(88, 'PLB KBS', 'KBS', 'Old Quester', 123960, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(89, 'PLB KBS', 'KBS', 'New Quester', 118520, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(90, 'PLB KBS', 'KBS', 'Scania', 127387, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(91, 'PT. KS HSM 1', 'KBS', 'Old Quester', 221880, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(92, 'PT. KS HSM 1', 'KBS', 'New Quester', 205560, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(93, 'PT. KS HSM 1', 'KBS', 'Scania', 232162, '2026-01-07 01:33:38', '2026-01-07 09:48:09'),
(94, 'PLATE MILL', 'BLOK TO BLOK', 'Old Quester', 99480, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(95, 'PLATE MILL', 'BLOK TO BLOK', 'New Quester', 96760, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(96, 'PLATE MILL', 'BLOK TO BLOK', 'Scania', 101194, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(97, 'ISY', 'HRP', 'Old Quester', 111720, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(98, 'ISY', 'HRP', 'New Quester', 107640, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(99, 'ISY', 'HRP', 'Scania', 114290, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(100, 'HRP', 'GUDANG LUAR', 'Old Quester', 160680, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(101, 'HRP', 'GUDANG LUAR', 'New Quester', 151160, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(102, 'HRP', 'GUDANG LUAR', 'Scania', 166678, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(103, 'KBK', 'KIEC 1', 'Old Quester', 381000, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(104, 'KBK', 'KIEC 1', 'New Quester', 347000, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(105, 'KBK', 'KIEC 1', 'Scania', 402420, '2026-01-07 02:09:27', '2026-01-07 09:48:09'),
(106, 'CIKUPA', 'BENGKULU', 'Old Quester', 23000000, '2026-01-07 02:12:05', '2026-01-07 09:48:09'),
(107, 'CIKUPA', 'BENGKULU', 'New Quester', 23000000, '2026-01-07 02:12:05', '2026-01-07 09:48:09'),
(108, 'CIKUPA', 'BENGKULU', 'Scania', 23000000, '2026-01-07 02:12:05', '2026-01-07 09:48:09'),
(109, 'CIKUPA', 'JAMBI', 'Old Quester', 23500000, '2026-01-07 02:12:05', '2026-01-07 09:48:09'),
(110, 'CIKUPA', 'JAMBI', 'New Quester', 23500000, '2026-01-07 02:12:05', '2026-01-07 09:48:09'),
(111, 'CIKUPA', 'JAMBI', 'Scania', 23500000, '2026-01-07 02:12:05', '2026-01-07 09:48:09'),
(112, 'KBS', 'PLNBB', 'Dumptruck', 105000, '2026-01-07 02:15:42', '2026-01-07 09:48:09'),
(113, 'KBS', 'KNAUF', 'Dumptruck', 190000, '2026-01-07 02:15:42', '2026-01-07 09:48:09'),
(114, 'KBS', 'PDSU', 'Dumptruck', 140000, '2026-01-07 02:15:42', '2026-01-07 09:48:09'),
(115, 'CSI', 'CIKANDE', 'Dumptruck', 1120000, '2026-01-07 02:15:42', '2026-01-07 09:48:09'),
(116, 'IKPP MERAK', 'RANGKAS', 'Dumptruck', 950000, '2026-01-07 02:15:42', '2026-01-07 09:48:09'),
(117, 'KBK', 'MOVING INTERNAL KBK', 'Dumptruck', 350000, '2026-01-07 02:15:42', '2026-01-07 09:48:09'),
(118, 'POSCO', 'KBS', 'Dumptruck', 170000, '2026-01-07 02:15:42', '2026-01-07 09:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','operasional','team_leader','finance','super_admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `role`, `password`, `created_at`, `foto`, `is_active`) VALUES
(1, 'Admin Ujo', 'adminujo', 'edomantolas@gmail.com', 'super_admin', '$2y$10$8MCMi1uY4EBFM.hUUXJiYeOGk0oZ71ypCkPUUd5go56Gp/vrtvOES', 1726733871, 'foto.png', 1),
(226, 'finance', 'finance', 'finance@gmail.com', 'finance', '$2y$10$ftst18DFvUV/1GklXz6tO.tMv8NSEOkW0Mzfx3ipOLcmducwXDosW', 1769048835, 'user.png', 1),
(227, 'Team Leader', 'teamleader', 'team_leader@gmail.com', 'team_leader', '$2y$10$V71BdlcDT3QMSNlbJ9q6oOrhlolNuNYXirvtWPNMKI/0l5.D.JjKq', 1769049450, 'user.png', 1),
(228, 'operasional', 'operasional', 'operasional@gmail.com', 'operasional', '$2y$10$tGysmmpIYwpDnO/Br4OFvONKnZvKVpmiPDEPENwj15Yq4Zk0Pmi06', 1769049489, 'user.png', 1),
(229, 'admin', 'admin', 'admin@gmail.com', 'admin', '$2y$10$kv3KmEdTgLYogGQifDKCWuW/LZx2InRLHtYPNzRC.jrOnWrxrEdxS', 1769049509, 'user.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkutan`
--
ALTER TABLE `angkutan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_polisi` (`nomor_polisi`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_angkutan`
--
ALTER TABLE `tipe_angkutan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uang_jalan`
--
ALTER TABLE `uang_jalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_no_unit` (`no_unit`),
  ADD KEY `idx_driver` (`driver`),
  ADD KEY `idx_tanggal` (`tanggal`);

--
-- Indexes for table `uang_jalan_pokok`
--
ALTER TABLE `uang_jalan_pokok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkutan`
--
ALTER TABLE `angkutan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tipe_angkutan`
--
ALTER TABLE `tipe_angkutan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `uang_jalan`
--
ALTER TABLE `uang_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `uang_jalan_pokok`
--
ALTER TABLE `uang_jalan_pokok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
