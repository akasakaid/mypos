-- Adminer 4.8.1 MySQL 8.0.31 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `mypos`;
CREATE DATABASE `mypos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mypos`;

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `no` int unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_beli` int unsigned NOT NULL,
  `harga_jual` int unsigned NOT NULL,
  `stok` int unsigned NOT NULL,
  `keterangan` text NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`no`),
  UNIQUE KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `barang` (`no`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `keterangan`, `updated_at`, `created_at`) VALUES
(1,	'8992931025011',	'Tisu Wajah MULTI',	19000,	20000,	100,	'',	'2023-01-09 00:02:51',	'2022-12-29 23:13:05'),
(3,	'8992796011518',	'Air Mawar',	9000,	10000,	100,	'',	'2023-01-08 23:59:34',	'2022-12-29 23:14:49'),
(4,	'8991038110514',	'Selection Facial Cotton',	11100,	12000,	100,	'',	'2023-01-07 17:11:24',	'2022-12-29 20:44:45'),
(36,	'8991002102163',	'Kopi Excelso Robusta Gold',	18000,	20000,	100,	'',	'2023-01-09 00:02:57',	'2022-12-30 05:29:04'),
(37,	'8991002105300',	'Kopi Kapal Api Special 20 x 6.5g',	11100,	12000,	100,	'',	'2023-01-08 21:41:31',	'2022-12-30 05:41:21'),
(38,	'8993014730112',	'Madurasa sachet',	1500,	1700,	100,	'',	'2023-01-08 01:18:56',	'2022-12-30 05:46:59'),
(39,	'8997241370103',	'Kecal Ikan Lele 50ml',	1900,	2000,	100,	'',	'2023-01-08 01:19:10',	'2022-12-30 05:48:30'),
(40,	'8994096221505',	'Indomaret Web Tissue Baby 50\'S Non Alcohol',	11600,	12000,	100,	'',	'2023-01-08 01:19:23',	'2022-12-30 05:50:30'),
(41,	'8998898101447',	'Tolak Angin Cair Sido Muncul 12x15ml',	47900,	48000,	100,	'',	'2023-01-07 17:19:03',	'2022-12-30 05:52:25'),
(42,	'8993137710428',	'Kahf Face Wash Oil & Acne Care 100ml',	40000,	41000,	100,	'',	'2023-01-07 17:18:56',	'2022-12-30 05:55:56'),
(43,	'8998866200318',	'Mie Sedap Instant Ayam Bawang',	3000,	3500,	100,	'',	'2023-01-07 16:03:12',	'2022-12-30 05:58:47'),
(44,	'8992388145027',	'NU Yougurt Tea Pet 450 ml',	7000,	7500,	100,	'',	'2023-01-08 01:19:31',	'2023-01-07 16:02:17');

DROP TABLE IF EXISTS `barang_transaksi`;
CREATE TABLE `barang_transaksi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` int unsigned NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah` int unsigned NOT NULL,
  `subtotal` int unsigned NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `kode_barang` (`kode_barang`),
  CONSTRAINT `barang_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_transaksi_ibfk_3` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` int unsigned NOT NULL,
  `uang_client` int unsigned NOT NULL,
  `kembalian` int unsigned NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `barang_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `total` int unsigned NOT NULL,
  `keuntungan` int unsigned NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(80) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `update_at`, `create_at`) VALUES
(1,	'admin',	'admin@admin.com',	'$2y$10$jcO24M7tHjvtvT90AXpqSu7ynMfzOJmRzUDRyhcM6.g7EGJv1CmnO',	'admin',	NULL,	'2022-12-17 20:28:08');

-- 2023-01-08 17:21:43
