-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2022 at 02:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitsupplies_manpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telp` bigint(12) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `pk_id` int(11) DEFAULT NULL,
  `lead_time` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `no_telp`, `image`, `kategori_id`, `pk_id`, `lead_time`) VALUES
(1, 'Meliana', 'meliana', 'meli01@gmail.com', 6281251847746, 'Admin1.jpg', 1, 1, 1),
(2, 'Felicia', 'felicia', 'feli02@gmail.com', 6283755999643, 'Admin2.jpg', 3, 2, 0),
(3, 'Widya', 'widya', 'widya03@gmail.com', 6281259345667, 'Admin3.jpg', 2, 3, 1),
(4, 'Stienley', 'stienley', 'stienley04@gmail.com', 6285941746646, 'Admin4.jpg', 2, 4, 1),
(5, 'Michael', 'michael', 'mcdennis@gmail.com', 6285136995008, 'Admin5.jpg', 2, 4, 2),
(6, 'Chris', 'chris', 'christtt@gmail.com', 6285712465698, 'Admin6.jpg', 2, 4, 2),
(7, 'Aheng', 'aheng', 'ahengkuy@gmail.com', 6283151836662, 'Admin7.jpg', 2, 5, 1),
(9, 'Kusuma', 'kusuma', 'kusuma55@gmail.com', 6283175998857, 'Admin9.jpg', 2, 6, 1),
(10, 'Ronaldi', 'ronaldi', 'ronaldi24@gmail.com', 6283175665221, 'Admin10.jpg', 2, 7, 1),
(11, 'Arditanti', 'arditanti', 'adminwidya@gmail.com', 6283175223364, 'Admin1.jpg', 2, 8, 2),
(12, 'Nagata', 'nagata', 'nagatabisa@mail.com', 6281231131290, 'Admin2.jpg', 2, 6, 1),
(13, 'Dennis', 'dennis', 'dennis89@gmail.com', 6281213612465, 'Admin3.jpg', 2, 7, 1),
(17, 'Aryanto', 'aryanto', 'aryanto06@gmail.com', 6281278193113, 'Admin7.jpg', 2, 6, 1),
(18, 'Brian', 'brian', 'richbrian@gmail.com', 6281221381931, 'Admin8.jpg', 2, 5, 1),
(19, 'Hadi', 'hadi', 'hadikitchen@gmail.com', 6281241781489, 'Admin9.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `approval` varchar(255) DEFAULT NULL,
  `buy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_stock`, `jumlah`, `approval`, `buy`) VALUES
(1, 1, 1, 2, 'yes', 0),
(2, 2, 3, 4, 'yes', 1),
(3, 3, 6, 2, 'no', 1),
(4, 4, 8, 5, 'yes', 1),
(5, 5, 7, 100, 'no', 0),
(6, 6, 2, 50, 'no', 1),
(7, 7, 3, 50, 'yes', 0),
(8, 8, 3, 100, 'yes', 0),
(9, 9, 2, 200, 'no', 1),
(10, 10, 8, 100, 'no', 1),
(11, 11, 4, 50, 'yes', 1),
(12, 12, 8, 100, 'no', 0),
(13, 13, 4, 100, 'yes', 0),
(14, 14, 6, 2, 'yes', 1),
(15, 15, 2, 100, 'yes', 1),
(22, 48, 22, 33, 'yes', 0),
(25, 16, 15, 5, 'yes', 1),
(26, 17, 3, 3, 'yes', 0),
(27, 20, 13, 8, 'no', 0),
(28, 21, 8, 11, 'no', 0),
(29, 22, 10, 10, 'yes', 1),
(30, 23, 7, 5, 'yes', 1),
(31, 24, 4, 10, 'yes', 0),
(32, 25, 11, 7, 'yes', 0),
(33, 26, 15, 10, 'yes', 1),
(34, 27, 11, 2, 'yes', 0),
(35, 21, 2, 1, 'yes', 1),
(36, 39, 2, 1, 'yes', 1),
(37, 41, 2, 1, 'yes', 1),
(38, 42, 2, 1, 'yes', 1),
(39, 43, 2, 1, 'yes', 1),
(40, 74, 5, 1, 'yes', 0),
(41, 75, 5, 1, 'yes', 0),
(42, 76, 5, 1, 'yes', 0),
(43, 76, 5, 1, 'yes', 0),
(50, 86, NULL, 1, 'no', 0),
(51, 86, NULL, 1, 'no', 0),
(52, 87, NULL, 1, 'no', 0),
(53, 87, NULL, 1, 'no', 0),
(54, 88, NULL, 1, 'no', 0),
(55, 88, NULL, 1, 'no', 0),
(56, 89, NULL, 1, 'no', 0),
(57, 89, NULL, 1, 'no', 0),
(58, 90, NULL, 1, 'no', 0),
(59, 90, NULL, 1, 'no', 0),
(60, 91, NULL, 1, 'no', 0),
(61, 91, NULL, 1, 'no', 0),
(62, 93, NULL, 1, 'no', 0),
(63, 93, NULL, 1, 'no', 0),
(64, 93, 5, 1, 'yes', 0),
(65, 93, 5, 1, 'yes', 0),
(66, 94, 5, 1, 'yes', 0),
(68, 97, 32, 1, 'yes', 0),
(70, 98, 34, 1, 'denied', 0),
(82, 110, 37, 13, 'no', 0),
(83, 111, 38, 13, 'yes', 0),
(86, 114, 41, 1, 'yes', 0),
(87, 115, 41, 1, 'yes', 0),
(88, 116, 41, 1, 'yes', 0),
(89, 117, 42, 10, 'yes', 0),
(90, 118, 43, 33, 'yes', 0),
(92, 119, 45, 1, 'yes', 0),
(93, 120, 45, 1, 'yes', 0),
(94, 121, 45, 1, 'yes', 0),
(95, 122, 45, 1, 'yes', 0),
(96, 123, 45, 1, 'yes', 0),
(97, 124, 46, 1, 'no', 0),
(98, 124, 5, 1, 'yes', 0),
(99, 124, 5, 1, 'yes', 0),
(100, 124, 5, 1, 'yes', 0),
(101, 124, 5, 1, 'yes', 0),
(102, 124, 5, 1, 'yes', 0),
(103, 125, 5, 1, 'yes', 0),
(104, 126, 5, 1, 'yes', 0),
(105, 127, 5, 1, 'yes', 0),
(106, 128, 5, 1, 'yes', 0),
(107, 129, 5, 1, 'yes', 0),
(108, 130, 5, 1, 'yes', 0),
(109, 131, 5, 1, 'yes', 0),
(110, 132, 5, 1, 'yes', 0),
(111, 133, 5, 1, 'yes', 0),
(112, 134, 5, 1, 'yes', 0),
(113, 135, 47, 1, 'yes', 0),
(114, 135, 48, 1, 'yes', 0),
(115, 136, 22, 1, 'yes', 0),
(116, 137, 22, 1, 'yes', 0),
(117, 138, 22, 1, 'yes', 0),
(118, 139, 22, 1, 'yes', 0),
(119, 140, 22, 1, 'yes', 0),
(120, 141, 22, 1, 'yes', 0),
(121, 142, 22, 1, 'yes', 0),
(122, 143, 22, 1, 'yes', 0),
(123, 144, 22, 1, 'yes', 0),
(124, 145, 22, 1, 'yes', 0),
(125, 146, 22, 1, 'yes', 0),
(126, 147, 49, 1, 'yes', 0),
(127, 148, 50, 1, 'yes', 0),
(128, 149, 50, 1, 'yes', 0),
(129, 150, 50, 1, 'yes', 0),
(130, 151, 50, 1, 'yes', 0),
(131, 152, 51, 1, 'yes', 0),
(132, 153, 52, 1, 'yes', 0),
(133, 154, 53, 1, 'yes', 0),
(134, 155, 54, 1, 'yes', 0),
(135, 156, 54, 1, 'yes', 0),
(136, 157, 55, 1, 'yes', 0),
(137, 158, 56, 1, 'yes', 0),
(138, 159, 57, 1, 'yes', 0),
(139, 160, 58, 1, 'yes', 0),
(140, 161, 59, 1, 'yes', 0),
(141, 162, 60, 1, 'yes', 0),
(142, 163, 61, 1, 'no', 0),
(143, 164, 49, 1, 'yes', 0),
(144, 165, 51, 1, 'yes', 0),
(145, 166, 62, 1, 'yes', 0),
(146, 167, 63, 1, 'yes', 0),
(147, 169, 64, 1, 'yes', 0),
(148, 170, 65, 1, 'yes', 0),
(149, 173, 66, 1, 'yes', 0),
(150, 173, 67, 1, 'yes', 0),
(151, 173, 68, 1, 'yes', 0),
(152, 173, 69, 1, 'yes', 0),
(153, 173, 70, 1, 'yes', 0),
(154, 174, 71, 1, 'yes', 0),
(155, 174, 72, 1, 'yes', 0),
(156, 174, 73, 1, 'yes', 0),
(157, 174, 74, 1, 'yes', 0),
(158, 174, 75, 1, 'yes', 0),
(159, 174, 76, 1, 'yes', 0),
(160, 175, 77, 14, 'yes', 0),
(161, 175, 78, 1, 'yes', 0),
(162, 175, 79, 1, 'yes', 0),
(163, 175, 80, 1, 'yes', 0),
(164, 175, 81, 1, 'yes', 0),
(165, 175, 82, 1, 'yes', 0),
(166, 176, 83, 9, 'yes', 0),
(167, 177, 84, 15, 'yes', 0),
(168, 178, 85, 30, 'yes', 0),
(169, 179, 86, 9, 'yes', 0),
(170, 180, 87, 15, 'yes', 0),
(171, 181, 88, 7, 'no', 0),
(172, 182, 89, 10, 'yes', 0),
(173, 183, 90, 1, 'yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forecast`
--

CREATE TABLE `forecast` (
  `forecast_id` int(11) NOT NULL,
  `forecast_day` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forecast`
--

INSERT INTO `forecast` (`forecast_id`, `forecast_day`, `item_id`, `pk_id`) VALUES
(16, 10, 1, 1),
(17, 0, 2, 2),
(18, 10, 3, 1),
(19, 0, 4, 1),
(20, 0, 5, 3),
(21, 48, 6, 4),
(22, 0, 7, 5),
(23, 1, 8, 6),
(24, 10, 8, 2),
(25, 10, 22, 5),
(26, 10, 5, 4),
(27, 10, 3, 6),
(28, 10, 15, 4),
(29, 10, 9, 2),
(30, 10, 13, 1),
(31, 0, 7, 3),
(32, 10, 1, 6),
(33, 10, 14, 3),
(34, 10, 4, 3),
(49, 10, 1, 10),
(50, 10, 5, 21),
(51, 10, 2, 1),
(52, 10, 3, 1),
(53, 10, 3, 21),
(54, 10, 2, 21),
(55, -1, 6, 3),
(56, 10, 6, 8),
(57, 0, 1, 3),
(58, 10, 5, 9),
(59, 10, 6, 9),
(60, 10, 3, 9),
(61, 10, 29, 3),
(62, 10, 15, 3),
(63, 10, 11, 3),
(64, 10, 9, 4),
(65, 10, 1, 4),
(66, 10, 2, 4),
(67, 10, 7, 4),
(68, 10, 8, 4),
(69, 0, 7, 3),
(70, 10, 22, 3),
(71, 10, 8, 3),
(72, 10, 8, 3),
(73, 10, 22, 3),
(74, -1, 6, 3),
(75, 0, 1, 3),
(76, 0, 5, 3),
(77, 0, 5, 3),
(78, 0, 5, 3),
(79, 0, 5, 3),
(80, 0, 5, 3),
(81, 10, 11, 3),
(82, -1, 6, 3),
(83, 0, 7, 3),
(84, 10, 9, 3),
(85, 10, 22, 3),
(86, 10, 3, 3),
(87, 10, 8, 3),
(88, 10, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `gudang_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`gudang_id`, `nama`, `alamat`, `no_telp`, `pk_id`) VALUES
(1, 'Tarunajaya', 'Jl. Taruna I no 3', 6281354547790, 1),
(2, 'Kertamanu', 'Jl. Kertamanu II no 45', 6281666755220, 2),
(3, 'Joyoboyo', 'Jl. Joyoboyo IV no 1', 6281232398472, 3),
(4, 'Siwamangu', 'Jl. Siwamangu V no 34', 6281664866000, 4),
(5, 'Pakuwon', 'Jl. Pakuwon VII no 30', 6281332573890, 5),
(6, 'Siwalankerto', 'Jl. Siwalankerto I no 34', 6281924837583, 6),
(7, 'Gudang Merah', 'Jl. Siwalankerto 100', 6281251724443, 2),
(8, 'Gudang Kuning', 'Jl. Ahmad Yani 201', 6281587668846, 4),
(9, 'Gudang Hijau', 'Jl. Patung Kuda 44', 6282158356664, 5),
(10, 'Gudang Biru', 'Jl. Kuningan oren 90', 6281261932381, 6),
(21, 'Gudang Baru', 'Jl Baru Barat block B no 35-49', 6282151739448, 4),
(25, 'Simbabue', 'Jl. Sulawesi 5 no 7', 6285144877877, 5),
(36, 'Bramanta', 'Jl. Kaliwaron 33', 6281232534631, 9),
(37, 'Tarumanegara', 'Jl. Ahmad Yani no 32', 6281265193893, 8),
(38, 'Norwegia', 'Jl. Jawa no 12', 6281281239523, 12);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_jenis_tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nama`, `jumlah`, `satuan`, `deskripsi`, `image`, `id_jenis_tipe`) VALUES
(1, 'Paramex', 1, 'tablet', 'minum setelah makan', 'paramex.jpg', 3),
(2, 'Darah A+', 100, 'ml', 'rhesus +', 'kantongdarah.jpg', 1),
(3, 'Meja AXD', 1, 'buah', 'ukuran 150x80', 'mejaaxd.jpg', 5),
(4, 'Kursi Kayu', 1, 'buah', 'ukuran 80x60', 'kursikayu.jpg', 6),
(5, 'Darah O', 100, 'ml', 'rhesus +', 'kantongdarah.jpg', 1),
(6, 'Darah B+', 100, 'ml', 'rhesus -', 'kantongdarah.jpg', 1),
(7, 'Panadol', 1, 'tablet', 'minum setelah makan', 'panadol.jpg', 3),
(8, 'Mylanta', 1, 'dus', 'minum setelah buang air besar', 'milanta.jpg', 3),
(9, 'Aspirin', 150, 'ml', 'obat pengencer darah atau obat yang digunakan untuk mencegah penggumpalan darah.', 'aspirin.jpg', 3),
(10, 'Betadine', 100, 'ml', 'obat antiseptik dengan kandungan aktif povidone iodine 10%', 'betadine.jpg', 3),
(11, 'Meja Plastik', 5, 'buah', 'ukuran 100x70', 'mejaplastik.jpg', 5),
(13, 'Ranjang Panjang', 20, 'buah', 'ukuran 180x70', 'ranjangpanjang.jpg', 7),
(14, 'Kursi Boss', 5, 'buah', 'ukuran 60x40 cm', 'kursiboss.jpg', 6),
(15, 'Printer Epson', 3, 'buah', 'warna Hitam', 'printerepson.jpg', 81),
(22, 'Tirofiban', 100, 'ml', 'Digunakan untuk mencegah gumpalan darah atau serangan jantung', 'tirofiban.jpg', 3),
(27, 'TermoQ', 10, 'buah', 'Termometer', 'termoq.jpg', 81),
(28, 'P3K', 5, 'buah', 'rak ukuran 100 cm', 'p3k.jpg', 81),
(29, 'Senter Elektrik', 20, 'buah', 'full set + baterai', 'senterelektrik.jpg', 81),
(30, 'Sutera', 15, 'buah', 'Sekat tempat tidur UGD', 'sutera.jpg', 10),
(31, 'Kamar Mayat', 4, 'Ruang', 'Ukuran 4x6 Meter', 'mayat.jpg', 4),
(32, 'mushola', 2, 'ruang', 'Ukuran: 14 x 14 meter', 'mushola', 15),
(33, 'labotorium', 4, 'ruang', 'Ukuran: 40 x 15 m', 'labotorium', 4),
(34, 'Ruang Isolasi', 10, 'Kamar', 'Ukuran 5x5 M', 'ruangisolasi.jpg', 4),
(37, 'Darah B', 100, 'ml', 'Rhesus +', 'kantong darah.jpg', 1),
(38, 'Darah B', 100, 'ml', 'Rhesus +', 'kantong darah.jpg', 1),
(39, 'Darah B', 100, 'ml', 'Rhesus +', 'kantong darah.jpg', 1),
(40, 'Darah B', 100, 'ml', 'Rhesus +', 'kantong darah.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tipe`
--

CREATE TABLE `jenis_tipe` (
  `id_jenis_tipe` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `id_tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_tipe`
--

INSERT INTO `jenis_tipe` (`id_jenis_tipe`, `nama`, `id_tipe`) VALUES
(1, 'Darah', 3),
(3, 'Obat', 3),
(4, 'Ruangan', 1),
(5, 'Meja', 2),
(6, 'Kursi', 2),
(7, 'Tempat Tidur', 2),
(8, 'Suntik', 3),
(10, 'Kain', 3),
(15, 'Mushola', 1),
(43, 'Database Server', 2),
(73, 'Lemari Obat', 2),
(78, 'Washing Machine', 2),
(81, 'Equipment', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_admin`
--

CREATE TABLE `kategori_admin` (
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_admin`
--

INSERT INTO `kategori_admin` (`kategori_id`, `nama`) VALUES
(1, 'Master'),
(2, 'Lokasimedis'),
(3, 'Pusat');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pk`
--

CREATE TABLE `kategori_pk` (
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_pk`
--

INSERT INTO `kategori_pk` (`kategori_id`, `nama`) VALUES
(1, 'Hospital'),
(2, 'Apotek'),
(3, 'Clinic'),
(4, 'Dukun'),
(5, 'Puskesmas'),
(6, 'posyandu'),
(7, 'PMI');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_transaksi`
--

CREATE TABLE `kategori_transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_transaksi`
--

INSERT INTO `kategori_transaksi` (`id`, `nama`) VALUES
(1, 'Request'),
(2, 'Move'),
(3, 'Use');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `mutasi_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(255) NOT NULL,
  `prev_loc` int(255) NOT NULL,
  `next_loc` int(255) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`mutasi_id`, `tanggal`, `jumlah`, `prev_loc`, `next_loc`, `stock_id`, `transaksi_id`) VALUES
(1, '2020-10-13 20:48:29', 5, 1, 2, 1, 1),
(2, '2020-10-20 20:50:11', 4, 3, 2, 3, 2),
(3, '2020-10-23 17:22:47', 50, 4, 9, 7, 4),
(4, '2020-10-28 17:24:03', 100, 8, 9, 4, 6),
(5, '2020-10-29 17:24:24', 30, 2, 8, 2, 7),
(6, '2020-12-11 17:25:47', 100, 2, 1, 3, 9),
(7, '2020-11-20 17:26:47', 100, 1, 6, 7, 11),
(8, '2020-10-23 17:27:08', 100, 7, 2, 6, 12),
(9, '2020-12-17 17:27:32', 50, 7, 6, 8, 13),
(10, '2020-11-20 17:28:03', 50, 4, 8, 6, 14),
(11, '2020-10-24 17:28:27', 100, 1, 9, 10, 15),
(18, '2020-12-24 14:37:07', 50, 25, 1, 15, 168),
(19, '2020-12-28 14:38:10', 30, 9, 2, 12, 149),
(20, '2020-12-07 14:38:33', 30, 4, 5, 63, 150),
(21, '2020-12-12 14:38:57', 4, 5, 21, 30, 151);

-- --------------------------------------------------------

--
-- Table structure for table `pusat_kesehatan`
--

CREATE TABLE `pusat_kesehatan` (
  `pk_id` int(11) NOT NULL,
  `no_telp` bigint(12) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pusat_kesehatan`
--

INSERT INTO `pusat_kesehatan` (`pk_id`, `no_telp`, `nama`, `alamat`, `image`, `kategori_id`) VALUES
(1, 6282359138557, 'Siloam', 'Jl. Ngagel Jaya 99', 'Hospital1.jpg', 1),
(2, 6281257446556, 'Ibu dan Anak', 'Jl. Penjaringan Timur 40', 'Hospital2.jpg', 1),
(3, 6281527556559, 'Pos Yandu Mantap', 'Jl. Kendalsari 20', 'Puskesmas1.jpg', 6),
(4, 6282151009995, 'Kimia Farma', 'Jl. Ngagel 89', 'Apotek1.jpg', 2),
(5, 6281253448556, 'Klinik Medis', 'Jl. Jambangan 90', 'Clinic1.jpg', 3),
(6, 6283759667768, 'Klinik 24', 'Jl. Darmo 12', 'Clinic2.jpg', 3),
(7, 6281257667776, 'RS Ulin', 'Jl. Banda Aceh 31', 'Hospital3.jpg', 1),
(8, 6284741277889, 'RS Terkenal', 'Jl. Terkenal 3', 'Hospital4.jpg', 1),
(9, 6281257365558, 'Klinik Petra', 'Jl. Siwalankerto Permai 2', 'Clinic3.jpg', 3),
(10, 6281259338558, 'Rumah Sakit Abu Abu', 'Jl. Siwalankerto 8', 'Hospital5.jpg', 1),
(11, 6285728447447, 'Apotek Nasi Padang', 'Jl. Jemur Andayani 10', 'Apotek2.jpg', 2),
(12, 6282175885557, 'Posyandu Pak Lim', 'Jl. Siwalankerto Timur 12', 'Dukun.jpg', 6),
(13, 6282175885557, 'Pondok Indah', 'Jl. Ahmad Yani 365', 'Puskesmas2.jpg', 5),
(14, 6282195585557, 'Rumah Sakit Blue', 'Jl. Ahmad Yani 339', 'Hospital6.jpg', 1),
(15, 6283274477444, 'Kimia Guardian', 'Jl. Siwalankerto Timur 90', 'Apotek3.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `id_item` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `gudang_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `jumlah`, `satuan`, `id_item`, `exp_date`, `gudang_id`) VALUES
(1, 5, 'Dus', 1, '2021-09-30', 1),
(2, 3, 'Buah', 2, '2021-09-30', 2),
(3, 0, 'Buah', 3, '2021-09-30', 2),
(4, 7, 'Buah', 4, '2020-11-30', 1),
(5, 1, 'Kantong', 5, '2021-09-30', 3),
(6, 97, 'Kantong', 6, '2020-11-30', 4),
(7, 2, 'Dus', 7, '2021-06-30', 5),
(8, 8, 'Dus', 8, '2021-06-30', 6),
(9, 2, 'Buah', 8, '2020-11-19', 7),
(10, 20, 'Tablet', 22, '2021-02-17', 9),
(11, 0, 'Kantong', 5, '2020-12-05', 8),
(12, 25, 'Buah', 3, '2025-12-31', 10),
(13, 7, 'Buah', 15, '2024-02-15', 8),
(14, 15, 'Buah', 9, '2021-08-19', 7),
(15, 50, 'Buah', 13, '2026-01-01', 1),
(22, 0, 'tablet', 7, '2021-04-09', 3),
(24, 0, 'ml', 9, '2020-12-12', 6),
(26, 0, 'Dus', 7, '2020-12-10', 3),
(28, 0, 'Dus', 7, '2020-12-10', 3),
(30, 0, 'Dus', 7, '2020-12-10', 3),
(32, 0, 'Dus', 7, '2020-12-10', 3),
(34, 0, 'Dus', 7, '2020-12-10', 3),
(37, 0, 'tablet', 1, '2020-12-10', 10),
(38, 13, 'tablet', 1, '2020-12-10', 10),
(41, 6, 'Kantong', 5, '2020-12-05', 21),
(42, 0, 'ml', 2, '2020-12-10', 1),
(43, 0, 'buah', 3, '2020-12-10', 1),
(45, 0, 'Dus', 7, '2020-12-10', 3),
(46, -1, 'buah', 3, '2020-12-10', 21),
(47, 0, 'buah', 3, '2020-12-10', 21),
(48, 0, 'Buah', 2, '2020-12-10', 21),
(49, -1, 'Kantong', 6, '2020-12-10', 3),
(50, 8, 'Kantong', 6, '2020-11-30', 8),
(51, 0, 'Dus', 1, '2020-12-10', 3),
(52, 1, 'Dus', 7, '2021-06-30', 3),
(53, 1, 'Kantong', 6, '2021-11-30', 3),
(54, 2, 'Kantong', 6, '2020-12-10', 3),
(55, 1, 'Kantong', 5, '2021-12-12', 9),
(56, 2, 'Kantong', 6, '2021-12-12', 9),
(57, 1, 'buah', 3, '2021-12-01', 9),
(58, 0, 'buah', 29, '2020-12-10', 3),
(59, 1, 'buah', 15, '2021-12-03', 3),
(60, 1, 'buah', 14, '2021-12-12', 3),
(61, 0, 'buah', 4, '2020-12-10', 3),
(62, 1, 'buah', 11, '2021-12-02', 3),
(63, 0, 'buah', 3, '2020-12-10', 8),
(64, 1, 'buah', 15, '2024-02-15', 4),
(65, 1, 'buah', 3, '2020-12-10', 4),
(66, 1, 'Buah', 9, '2021-12-03', 21),
(67, 0, 'Dus', 1, '0000-00-00', 21),
(68, 0, 'Buah', 2, '0000-00-00', 21),
(69, 0, 'Dus', 7, '0000-00-00', 21),
(70, 0, 'Dus', 8, '0000-00-00', 21),
(71, 1, 'Dus', 7, '2021-12-03', 3),
(72, 0, 'Tablet', 22, '0000-00-00', 3),
(73, 0, 'Dus', 8, '0000-00-00', 3),
(74, 0, 'Dus', 8, '0000-00-00', 3),
(75, 0, 'Tablet', 22, '0000-00-00', 3),
(76, 0, 'Kantong', 6, '0000-00-00', 3),
(77, 14, 'Dus', 1, '2021-12-03', 3),
(78, 0, 'Kantong', 5, '0000-00-00', 3),
(79, 0, 'Kantong', 5, '0000-00-00', 3),
(80, 0, 'Kantong', 5, '0000-00-00', 3),
(81, 0, 'Kantong', 5, '0000-00-00', 3),
(82, 0, 'Kantong', 5, '0000-00-00', 3),
(83, 9, 'buah', 11, '2021-12-03', 3),
(84, 15, 'Kantong', 6, '2021-12-03', 3),
(85, 30, 'Dus', 7, '2021-12-03', 3),
(86, 9, 'Buah', 9, '2021-12-03', 3),
(87, 0, 'Tablet', 22, '0000-00-00', 3),
(88, 0, 'buah', 3, '0000-00-00', 3),
(89, 10, 'Dus', 8, '2020-11-19', 3),
(90, 1, 'Dus', 1, '2021-12-12', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `id_tipe` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`id_tipe`, `nama`) VALUES
(1, 'Prasarana'),
(2, 'Sarana'),
(3, 'Supply');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `trans_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `pk_provider` int(255) DEFAULT NULL,
  `pk_penyumbang` int(11) DEFAULT NULL,
  `kategori_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`trans_id`, `tanggal`, `status`, `admin_id`, `pk_provider`, `pk_penyumbang`, `kategori_transaksi`) VALUES
(1, '2020-10-13', 'done', 1, 1, 1, 2),
(2, '2020-10-14', 'on going', 2, 2, 6, 1),
(3, '2020-10-15', 'on going', 3, 3, 4, 1),
(4, '2020-10-16', 'done', 4, 4, 4, 3),
(5, '2020-10-09', 'done', 2, 2, 2, 3),
(6, '2020-10-12', 'done', 1, 1, 1, 2),
(7, '2020-10-30', 'done', 3, 3, 1, 1),
(8, '2020-10-12', 'done', 5, 4, 2, 1),
(9, '2020-10-18', 'done', 3, 3, 3, 3),
(10, '2020-10-18', 'done', 5, 4, 8, 1),
(11, '2020-10-31', 'done', 5, 4, 4, 2),
(12, '2020-10-18', 'done', 2, 2, 2, 2),
(13, '2020-10-04', 'done', 5, 4, 4, 2),
(14, '2020-10-11', 'done', 4, 4, 4, 3),
(15, '2020-10-12', 'done', 6, 4, 2, 1),
(16, '2020-10-19', 'waiting', 11, 8, NULL, 1),
(17, '2020-10-19', 'done', 2, 2, 3, 1),
(20, '2020-11-06', 'cancel', 1, 1, 5, 1),
(21, '2020-11-06', 'done', 2, 2, 4, 1),
(22, '2020-11-06', 'waiting', 5, 4, NULL, 1),
(23, '2020-11-06', 'on going', 10, 7, 5, 1),
(24, '2020-11-07', 'done', 1, 1, 1, 3),
(25, '2020-11-07', 'done', 13, 7, 2, 1),
(26, '2020-11-08', 'done', 17, 6, 2, 1),
(27, '2020-11-08', 'done', 11, 8, 4, 1),
(28, '2020-11-09', 'done', 1, 1, 1, 2),
(29, '2020-11-09', 'waiting', 6, 4, NULL, 1),
(30, '2020-11-10', 'done', 9, 6, 3, 1),
(32, '2020-11-11', 'waiting', 13, 7, NULL, 1),
(33, '2020-11-11', 'done', 19, 1, 1, 3),
(34, '2020-11-12', 'on going', 3, 3, 8, 1),
(35, '2020-11-12', 'waiting', 7, 5, NULL, 1),
(36, '2020-11-12', 'done', 9, 6, 6, 3),
(37, '2020-11-13', 'done', 18, 5, 3, 1),
(38, '2020-11-13', 'waiting', 12, 6, NULL, 1),
(39, '2020-11-06', 'done', 2, 2, 7, 1),
(40, '2020-11-06', 'done', 2, 2, 6, 1),
(41, '2020-11-06', 'done', 2, 2, 3, 1),
(42, '2020-11-06', 'done', 2, 2, 4, 1),
(43, '2020-11-06', 'done', 2, 2, 1, 1),
(48, '2020-10-14', 'done', 2, 2, NULL, 1),
(50, '2020-10-14', 'waiting', 2, 2, NULL, 1),
(61, '0000-00-00', 'done', 3, 3, 3, 3),
(62, '2020-11-16', 'done', 3, 3, 3, 3),
(63, '2020-11-16', 'done', 3, 3, 3, 3),
(64, '2020-11-16', 'done', 3, 3, 3, 3),
(65, '2020-11-16', 'done', 3, 3, 3, 3),
(66, '2020-11-16', 'done', 3, 3, 3, 3),
(68, '2020-11-16', 'done', 3, 3, 3, 3),
(69, '2020-11-16', 'done', 3, 3, 3, 3),
(70, '2020-11-16', 'done', 3, 3, 3, 3),
(71, '2020-11-16', 'done', 3, 3, 3, 3),
(72, '2020-11-16', 'done', 3, 3, 3, 3),
(73, '2020-11-16', 'done', 3, 3, 3, 3),
(74, '2020-11-16', 'done', 3, 3, 3, 3),
(75, '2020-11-16', 'done', 3, 3, 3, 3),
(76, '2020-11-16', 'done', 3, 3, 3, 3),
(77, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(78, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(79, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(80, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(81, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(82, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(83, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(84, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(85, '2020-11-16', 'waiting', 2, 2, NULL, 1),
(86, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(87, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(88, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(89, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(90, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(91, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(92, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(93, '2020-11-17', 'done', 2, 2, 1, 1),
(94, '2021-11-17', 'done', 4, 4, 4, 3),
(95, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(96, '2020-11-17', 'waiting', 2, 2, NULL, 1),
(97, '2020-11-17', 'done', 2, 2, NULL, 1),
(98, '2020-11-17', 'cancel', 2, 2, NULL, 1),
(99, '2020-11-19', 'done', 4, 4, NULL, 2),
(100, '2020-11-19', 'done', 4, 4, NULL, 2),
(101, '2020-11-19', 'done', 4, 4, NULL, 2),
(102, '2020-11-19', 'done', 4, 4, NULL, 2),
(103, '2020-11-19', 'done', 4, 4, NULL, 2),
(104, '2020-11-19', 'done', 4, 4, NULL, 2),
(105, '2020-11-19', 'done', 4, 4, NULL, 2),
(106, '2020-11-19', 'done', 4, 4, NULL, 2),
(107, '2020-11-19', 'done', 4, 4, NULL, 2),
(108, '2020-11-19', 'done', 4, 4, NULL, 2),
(109, '2020-11-19', 'done', 4, 4, NULL, 2),
(110, '2020-10-20', 'on going', 2, 2, NULL, 1),
(111, '2020-10-20', 'done', 2, 2, 4, 1),
(112, '2020-11-19', 'done', 4, 4, NULL, 2),
(113, '2020-11-19', 'done', 4, 4, NULL, 2),
(114, '2020-11-19', 'done', 4, 4, 4, 2),
(115, '2020-11-19', 'done', 4, 4, 4, 2),
(116, '2020-11-19', 'done', 4, 4, 4, 2),
(117, '2020-10-21', 'done', 2, 2, 2, 1),
(118, '2020-10-21', 'done', 2, 2, 3, 1),
(119, '2020-11-26', 'done', 2, 2, 6, 1),
(120, '2020-11-26', 'done', 4, 4, 6, 1),
(121, '2020-11-26', 'done', 4, 4, 3, 1),
(122, '2020-11-26', 'done', 4, 4, 3, 1),
(123, '2020-11-26', 'done', 4, 4, 3, 1),
(124, '2020-11-26', 'done', 4, 4, NULL, 1),
(125, '2020-11-27', 'done', 3, 3, 3, 3),
(126, '2020-11-27', 'done', 3, 3, 3, 3),
(127, '2020-11-27', 'done', 3, 3, 3, 3),
(128, '2020-11-27', 'done', 3, 3, 3, 3),
(129, '2020-11-27', 'done', 3, 3, 3, 3),
(130, '2020-11-27', 'done', 3, 3, 3, 3),
(131, '2020-11-27', 'done', 3, 3, 3, 3),
(132, '2020-11-27', 'done', 3, 3, 3, 3),
(133, '2020-11-27', 'done', 3, 3, 3, 3),
(134, '2020-11-27', 'done', 3, 3, 3, 3),
(135, '2020-11-30', 'done', 4, 4, 2, 1),
(136, '0000-00-00', ' ', 3, 3, 3, 3),
(137, '2020-11-30', ' ', 3, 3, 3, 3),
(138, '2020-11-30', ' ', 3, 3, 3, 3),
(139, '2020-11-30', ' ', 3, 3, 3, 3),
(140, '2020-11-30', ' ', 3, 3, 3, 3),
(141, '2020-11-30', ' ', 3, 3, 3, 3),
(142, '2020-11-30', ' ', 3, 3, 3, 3),
(143, '2020-11-30', ' ', 3, 3, 3, 3),
(144, '2020-11-30', ' ', 3, 3, 3, 3),
(145, '2020-11-30', ' ', 3, 3, 3, 3),
(146, '2020-11-30', ' ', 3, 3, 3, 3),
(147, '2020-11-30', 'done', 3, 3, 4, 1),
(148, '2020-11-30', 'done', 4, 4, 4, 2),
(149, '2020-11-30', 'done', 4, 4, 4, 2),
(150, '2020-11-30', 'done', 4, 4, 4, 2),
(151, '2020-11-30', 'done', 4, 4, 4, 2),
(152, '2020-12-01', 'done', 3, 3, 5, 1),
(153, '2020-12-01', 'done', 3, 3, 5, 1),
(154, '2020-12-01', 'done', 3, 3, 4, 1),
(155, '2020-12-01', 'done', 3, 3, 2, 1),
(156, '2020-12-01', 'done', 11, 8, 4, 1),
(157, '2020-12-01', 'done', 7, 5, 2, 1),
(158, '2020-12-01', 'done', 7, 5, 2, 1),
(159, '2020-12-01', 'done', 7, 5, NULL, 1),
(160, '2020-12-01', 'waiting', 3, 3, NULL, 1),
(161, '2020-12-01', 'done', 3, 3, NULL, 1),
(162, '2020-12-01', 'done', 3, 3, 2, 1),
(163, '2020-12-01', 'waiting', 3, 3, NULL, 1),
(164, '2020-12-02', ' ', 3, 3, 3, 3),
(165, '2020-12-02', ' ', 3, 3, 3, 3),
(166, '2020-12-02', 'done', 3, 3, NULL, 1),
(167, '2020-12-02', 'waiting', 4, 4, 4, 2),
(168, '2020-12-02', 'waiting', 4, 4, 4, 2),
(169, '2020-12-02', 'waiting', 4, 4, 4, 2),
(170, '2020-12-02', 'waiting', 4, 4, 4, 2),
(171, '2020-12-02', 'waiting', 4, 4, 4, 2),
(172, '2020-12-02', 'waiting', 4, 4, 4, 2),
(173, '2020-12-03', 'done', 6, 4, NULL, 1),
(174, '2020-12-03', 'done', 3, 3, NULL, 1),
(175, '2020-12-03', 'done', 3, 3, NULL, 1),
(176, '2020-12-03', 'done', 3, 3, NULL, 1),
(177, '2020-12-03', 'done', 3, 3, NULL, 1),
(178, '2020-12-03', 'done', 3, 3, NULL, 1),
(179, '2020-12-03', 'done', 3, 3, NULL, 1),
(180, '2020-12-03', 'waiting', 3, 3, NULL, 1),
(181, '2020-12-03', 'waiting', 3, 3, NULL, 1),
(182, '2020-12-03', 'done', 3, 3, 2, 1),
(183, '2020-12-12', 'done', 4, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `nama`, `no_telp`, `alamat`, `email`) VALUES
(1, 'Juna Vendor', 6281251728667, 'Jl. Kusuma Bangsa 5 no 7', 'junavendor@gmail.com'),
(2, 'PT Kursi Indo', 6281757375255, 'Jl. Kembang Jepun 3 no 6', 'kursiindo@yahoo.com'),
(3, 'Toko Ganteng', 6281918401920, 'Jl. Siwalankerto VIII C16', 'tokoganteng@gmail.com'),
(4, 'Handsome Store', 6281284179840, 'Jl. Siwalankerto VIII C17', 'handsomestore@gmail.com'),
(5, 'Arnold Vendor', 6281059580369, 'Jl. Kertajaya no 34', 'arnoldvendor@gmail.com'),
(6, 'Renata Vendor', 6281259239446, 'Jl. Klampis Jaya V no 12', 'renatavendor@gmail.com'),
(7, 'Toko Cantik', 6281920001945, 'Jl. Siwalankerto VIII C18', 'cantik@gmail.com'),
(8, 'Beautiful Store', 1628123971298, 'Jl. Siwalankerto VIII C20', 'beautiful@gmail.com'),
(9, 'Stinli Vendor', 6281312466290, 'Jl. Darmo Indah Timur V no 2', 'stinlivendor@gmail.com'),
(10, 'PetraQ', 6281461746150, 'Jl. Ahmad Yani 100', 'petraQ@gmail.com'),
(11, 'UPH Jaya', 6281641649210, 'Jl. Jagir Sidoresmo no 24', 'uphj@gmail.com'),
(12, 'Sahda Vendor', 6281302995523, 'Jl. Panjang Jiwo Permai III no 29', 'sahdavendor@gmail.com'),
(13, 'Dave', 6281252835557, 'Jl. Pemuda no 33-35', 'dave@gmail.com'),
(14, 'Guy Sander', 6283176555678, 'Jl. Ngagel Jaya no 23', 'guysander@gmail.com'),
(15, 'Idris Elba', 6283617465568, 'Jl. Pucang Anom Timur III no 11', 'idriselba@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `pk_id2` (`pk_id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`,`id_stock`),
  ADD KEY `id_stock` (`id_stock`);

--
-- Indexes for table `forecast`
--
ALTER TABLE `forecast`
  ADD PRIMARY KEY (`forecast_id`),
  ADD KEY `item_id` (`item_id`,`pk_id`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`gudang_id`),
  ADD KEY `pk_id` (`pk_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_jenis_tipe` (`id_jenis_tipe`);

--
-- Indexes for table `jenis_tipe`
--
ALTER TABLE `jenis_tipe`
  ADD PRIMARY KEY (`id_jenis_tipe`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indexes for table `kategori_admin`
--
ALTER TABLE `kategori_admin`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_pk`
--
ALTER TABLE `kategori_pk`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_transaksi`
--
ALTER TABLE `kategori_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`mutasi_id`),
  ADD KEY `stock_id` (`stock_id`,`transaksi_id`),
  ADD KEY `stock_id_2` (`stock_id`,`transaksi_id`),
  ADD KEY `prev_loc` (`prev_loc`,`next_loc`),
  ADD KEY `next_loc` (`next_loc`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `pusat_kesehatan`
--
ALTER TABLE `pusat_kesehatan`
  ADD PRIMARY KEY (`pk_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `gudang_id` (`gudang_id`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `vendor_id` (`pk_provider`),
  ADD KEY `kategori_transaksi` (`kategori_transaksi`),
  ADD KEY `pengirim_id` (`pk_penyumbang`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `forecast`
--
ALTER TABLE `forecast`
  MODIFY `forecast_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `jenis_tipe`
--
ALTER TABLE `jenis_tipe`
  MODIFY `id_jenis_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `kategori_admin`
--
ALTER TABLE `kategori_admin`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_pk`
--
ALTER TABLE `kategori_pk`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_transaksi`
--
ALTER TABLE `kategori_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `mutasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pusat_kesehatan`
--
ALTER TABLE `pusat_kesehatan`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_admin` (`kategori_id`),
  ADD CONSTRAINT `pk_id2` FOREIGN KEY (`pk_id`) REFERENCES `pusat_kesehatan` (`pk_id`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `id_stock` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`),
  ADD CONSTRAINT `id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`trans_id`);

--
-- Constraints for table `gudang`
--
ALTER TABLE `gudang`
  ADD CONSTRAINT `pk_id` FOREIGN KEY (`pk_id`) REFERENCES `pusat_kesehatan` (`pk_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `id_jenis_tipe` FOREIGN KEY (`id_jenis_tipe`) REFERENCES `jenis_tipe` (`id_jenis_tipe`);

--
-- Constraints for table `jenis_tipe`
--
ALTER TABLE `jenis_tipe`
  ADD CONSTRAINT `id_tipe` FOREIGN KEY (`id_tipe`) REFERENCES `tipe` (`id_tipe`);

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `next_loc` FOREIGN KEY (`next_loc`) REFERENCES `gudang` (`gudang_id`),
  ADD CONSTRAINT `prev_loc` FOREIGN KEY (`prev_loc`) REFERENCES `gudang` (`gudang_id`),
  ADD CONSTRAINT `stock_id` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id_stock`),
  ADD CONSTRAINT `transaksi_id` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`trans_id`);

--
-- Constraints for table `pusat_kesehatan`
--
ALTER TABLE `pusat_kesehatan`
  ADD CONSTRAINT `pusat_kesehatan_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_pk` (`kategori_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `gudang_id` FOREIGN KEY (`gudang_id`) REFERENCES `gudang` (`gudang_id`),
  ADD CONSTRAINT `id_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `kategori_transaksi` FOREIGN KEY (`kategori_transaksi`) REFERENCES `kategori_transaksi` (`id`),
  ADD CONSTRAINT `pengirim_id` FOREIGN KEY (`pk_penyumbang`) REFERENCES `pusat_kesehatan` (`pk_id`),
  ADD CONSTRAINT `vendor_id` FOREIGN KEY (`pk_provider`) REFERENCES `pusat_kesehatan` (`pk_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
