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
  `no` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `total` int NOT NULL,
  `keterangan` text NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`no`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `barang` (`no`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `total`, `keterangan`, `updated_at`, `created_at`) VALUES
(1,	'8992931025011',	'Tisu Wajah MULTI',	19000,	20000,	10,	'',	NULL,	'2022-12-29 23:13:05'),
(3,	'8992796011518',	'Air Mawar',	9000,	1000,	10,	'',	NULL,	'2022-12-29 23:14:49'),
(4,	'8991038110514',	'Selection Facial Cotton',	11100,	12000,	100,	'',	'2022-12-30 16:20:18',	'2022-12-29 20:44:45'),
(36,	'8991002102163',	'Kopi Excelso Robusta Gold',	18000,	20000,	10,	'',	NULL,	'2022-12-30 05:29:04'),
(37,	'8991002105300',	'Kopi Kapal Api Special 20 x 6.5g',	11100,	12000,	10,	'',	NULL,	'2022-12-30 05:41:21'),
(38,	'8993014730112',	'Madurasa sachet',	1500,	1700,	10,	'',	NULL,	'2022-12-30 05:46:59'),
(39,	'8997241370103',	'Kecal Ikan Lele 50ml',	1900,	2000,	10,	'',	NULL,	'2022-12-30 05:48:30'),
(40,	'8994096221505',	'Indomaret Web Tissue Baby 50\'S Non Alcohol',	11600,	12000,	10,	'',	NULL,	'2022-12-30 05:50:30'),
(41,	'8998898101447',	'Tolak Angin Cair Sido Muncul 12x15ml',	47900,	48000,	10,	'',	NULL,	'2022-12-30 05:52:25'),
(42,	'8993137710428',	'Kahf Face Wash Oil & Acne Care 100ml',	40000,	41000,	10,	'',	NULL,	'2022-12-30 05:55:56'),
(43,	'8998866200318',	'Mie Sedap Instant Ayam Bawang',	3000,	3500,	10,	'',	NULL,	'2022-12-30 05:58:47');

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

-- 2022-12-31 05:59:47