-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2024 at 06:17 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes_ptgc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pegawai` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_cuti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai_cuti` date NOT NULL,
  `tanggal_selesai_cuti` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `id_pegawai`, `alasan_cuti`, `tanggal_mulai_cuti`, `tanggal_selesai_cuti`, `created_at`, `updated_at`) VALUES
('99e0cd10-5b7b-4ce7-b2db-3fa2d410dcb1', '99e0b9f8-8b14-463c-aada-ca9f7e20303a', 'aaaaaaaaaaaaaa', '2023-08-13', '2023-08-14', NULL, NULL),
('99e0d5d3-810a-4f5b-9557-f464d48841b4', '99e0b9f8-8b14-463c-aada-ca9f7e20303a', 'asaaaaaaaaaaaaaaaaaaaaa', '2023-08-21', '2023-08-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_24_162532_create_permission_tables', 1),
(6, '2023_03_03_190326_create_kata_dasars_table', 2),
(7, '2023_03_10_220137_create_stopwords_table', 3),
(8, '2023_03_11_195029_create_kamus_orang_table', 4),
(9, '2023_03_11_222922_create_kamus_tempat_table', 5),
(10, '2023_03_11_223840_create_kamus_waktu_table', 6),
(11, '2023_03_12_192851_create_hadis_table', 7),
(12, '2023_03_15_211722_create_corpus_table', 8),
(13, '2023_03_17_004719_create_bigram_probabilitas_table', 9),
(14, '2023_03_17_214930_create_bigram_probabilitas_table', 10),
(15, '2023_03_17_215437_create_bigram_probabilitas_table', 11),
(16, '2023_08_13_115005_create_pegawai_table', 12),
(17, '2023_08_13_124403_create_cuti_table', 13),
(18, '2023_08_13_125359_create_cuti_table', 14),
(19, '2024_05_20_220951_create_produk_table', 15),
(20, '2024_05_20_232518_create_transaksi_table', 16),
(21, '2024_05_21_001416_create_transaksi_items_table', 16),
(22, '2024_05_21_192624_create_transaksi_items_table', 17),
(23, '2024_05_21_212004_add_nilai_tukar_voucher_to_transaksi_table', 18),
(24, '2024_05_21_213854_add_created_by_to_transaksi_table', 19),
(25, '2024_05_21_213916_add_created_by_to_transaksi_items_table', 20),
(26, '2024_05_21_214257_add_created_by_to_transaksi_items_table', 21),
(27, '2024_05_21_214300_add_created_by_to_transaksi_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `stock` int NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `created_at`, `updated_at`) VALUES
('9c16d87e-a89e-4578-9543-81e8d8a9adaa', 'jjj', 'asdas', '1000.00', 3, 33, NULL, NULL),
('9c18a979-7478-4418-a049-12972aa50dfc', 'botol minum', 'botol', '2000.00', 23, 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
('800a351e-b9e4-11ed-bf24-04d4c4781d33', 'admin', 'web', '2023-03-03 16:57:08', '2023-03-03 16:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `total_dibayar` decimal(10,2) DEFAULT NULL,
  `invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_voucher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_tukar_voucher` decimal(15,2) DEFAULT NULL,
  `status_voucher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `customer_name`, `customer_no_hp`, `customer_email`, `customer_address`, `total_harga`, `total_dibayar`, `invoice`, `kode_voucher`, `nilai_tukar_voucher`, `status_voucher`, `created_at`, `updated_at`, `created_by`) VALUES
('9c1bcfa4-9ee7-45b1-9eb3-beed2775e7f6', 'aa', '0895800770222', 'asdasd@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '10000.00', '12000.00', 'INV-6KkXPHAm73Wydflj', 'VC-k2WMod33PN21Vurn', '0.00', NULL, '2024-05-23 02:50:16', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd1f4-5a79-4373-97c3-d26b729f7f56', 'yjhkj', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '1000.00', '2000.00', 'INV-4cZ2EpaLjH8wPwK2', NULL, '0.00', NULL, '2024-05-23 02:56:45', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd27b-552d-4889-bef2-69779b921e48', 'aaaaa', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '1000000.00', '2000000.00', 'INV-RD9AaUDziFSYYEH5', 'VC-j7ejZatThLRdwK94', '10000.00', NULL, '2024-05-23 02:58:13', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd525-619f-4af3-8933-4f4162088ffe', 'bbbbbbbbbbbbbbbb', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '2100000.00', '3000000.00', 'INV-BTyrwF85OEXDkfHj', 'VC-w5O3yidRswb7fkeJ', '20000.00', NULL, '2024-05-23 03:05:40', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd6a8-9547-4736-b8ac-ef3ecd763613', 'indra', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '2002000.00', '3000000.00', 'INV-aEDQQA088Yb2QplG', 'VC-RlALXt3UTw6hgr3J', '20000.00', NULL, '2024-05-23 03:09:54', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd944-6a49-4565-8e6e-7e13883b6ced', 'indra', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '202000.00', '300000.00', 'INV-tpfvIzMz80jIQZt8', NULL, '0.00', NULL, '2024-05-23 03:17:11', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bdc8a-b8f2-44ac-b113-71ba04d6de4e', 'asdasd', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '1000000.00', '2000000.00', 'INV-FhEaI0zrS89sOKuM', 'VC-8yhLLxmbIBmEu2HP', '10000.00', NULL, '2024-05-23 03:26:21', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bde75-be68-4a7f-9aa5-5447acf0fd75', 'asdasd', '0895800770222', 'asdasd@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '2000000.00', '2000001.00', 'INV-1gl6XJfwRko8KRdD', 'VC-iwEgwIN9hqiq0wEs', '20000.00', NULL, '2024-05-23 03:31:43', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c0e82-da8d-4494-b4d7-1692e90bc44b', 'indra', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '1000000.00', '1200000.00', 'INV-6jwtG5tMmRLG0632', 'VC-F8jbCCJRUkE8Q4rK', '10000.00', NULL, '2024-05-23 05:46:04', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c101f-6ad6-4b9b-8c09-8d067be200ae', 'indra', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '1000000.00', '1200000.00', 'INV-GsEvifDKmOc1jqkj', 'VC-nlIjdGFfMVZ0JpjT', '10000.00', NULL, '2024-05-23 05:50:35', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c109c-8f54-4072-a053-56ec93f95cf8', 'indra', '0895800770222', 'indra@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '1000000.00', '1200000.00', 'INV-jVPzF8vouvWpcvCY', 'VC-yLISsYx3oPr8AMeE', '10000.00', NULL, '2024-05-23 05:51:57', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c11d8-a672-4a82-b97f-d216266568a5', 'indra', '0895800770222', 'admin@gmail.com', 'Jl. Rowobening No. 72 RT. 003 Rw. 010', '1200000.00', '1203000.00', 'INV-DQ1Q68RkbPNpVmBI', 'VC-R0n0wvCzojQk8c4z', '10000.00', NULL, '2024-05-23 05:55:24', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c1292-4970-403f-8e16-26d35bae48f0', 'indra', '0895800770222', 'admin@gmail.com', 'Jl. Rowobening No. 72 RT. 003 Rw. 010', '1220000.00', '1203000.00', 'INV-qIKYZvg9xrsgxqjX', 'VC-YaBIkYh1jTfiiztG', '10000.00', NULL, '2024-05-23 05:57:25', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c134b-9402-4be7-8b67-2865605a83b5', 'aaaa', '0895800770222', 'aaaaaaa@gmail.com', 'Gang REMAJA 1 Jatinegara kaum RT 10 Rw 04 no 33', '3440000.00', '4000000.00', 'INV-8lCsgR44l8MauXBM', 'VC-9leNs2dyqpdjZ1Rb', '30000.00', NULL, '2024-05-23 05:59:27', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_items`
--

CREATE TABLE `transaksi_items` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produk` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_transaksi` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal_harga` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_items`
--

INSERT INTO `transaksi_items` (`id`, `id_produk`, `id_transaksi`, `harga`, `jumlah`, `subtotal_harga`, `created_at`, `updated_at`, `created_by`) VALUES
('9c18b0f4-9a3f-4a3d-a284-ae903efff846', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c18b0f4-9836-4a94-8fbb-4f73617a8db7', 1000, 1, 1000, NULL, NULL, NULL),
('9c18b0f4-9ab0-41ce-8848-dd7d11ab3d1a', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18b0f4-9836-4a94-8fbb-4f73617a8db7', 4000, 2, 8000, NULL, NULL, NULL),
('9c18c909-d2b9-4cb0-9759-4c28abe66873', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c18c909-d108-4694-b8c6-1241d3ed69bd', 1000, 1023, 1023000, '2024-05-21 14:44:20', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18c909-d313-497e-97bb-f5e5bf394d3d', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18c909-d108-4694-b8c6-1241d3ed69bd', 2000, 200, 400000, '2024-05-21 14:44:20', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18cf25-6acf-4194-b665-503a9fba2e00', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18cf25-68ae-4e50-8e47-bac7a08115ce', 222222, 22, 4888884, '2024-05-21 15:01:24', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18d0e4-f53d-42d5-aa02-81f16a82eab5', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c18d0e4-f3b2-4f5d-b817-164bdfd89bdd', 10000, 222, 2220000, '2024-05-21 15:06:18', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18d146-eb54-42ad-866f-705597bbaa23', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c18d146-e9c7-4782-887f-564dcf381430', 10000, 222, 2220000, '2024-05-21 15:07:22', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18e780-6e45-4e64-948d-0a65f01bd907', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18e780-15b7-47ec-b75f-0dc57bb10cdb', 100000, 222, 22200000, '2024-05-21 16:09:31', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18ed19-ccd8-40e1-b7ff-ec4fe6c952c3', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18ed19-cb69-47e7-ac20-d060f1c72e4f', 200000, 22, 4400000, '2024-05-21 16:25:10', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18ede4-0c5f-4bfe-a769-8aa271cc2be6', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18ede4-0add-492d-981e-1b5cbf9096d8', 100000, 222, 22200000, '2024-05-21 16:27:22', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18ee75-eed1-46d4-9d1d-f41805c3e909', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18ee75-ed26-4b92-984c-b359bf5e546d', 1000, 1111, 1111000, '2024-05-21 16:28:58', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18ee80-4927-4bba-a798-f67ccbc38138', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18ee80-47a3-40e4-8d6e-b8b4604f57d7', 1000, 1111, 1111000, '2024-05-21 16:29:05', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18eeeb-4f10-4029-920d-814f79bb8a66', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18eeeb-4ddc-464d-b10e-34bbbbcf2ffe', 10000, 2222, 22220000, '2024-05-21 16:30:15', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f005-d5b0-44ab-964d-84b58da17e9f', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f005-d3f7-4541-ad70-7a0cf379afcd', 100000, 100, 10000000, '2024-05-21 16:33:20', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f0e1-bee6-496c-8c23-9cd1fe2fc4dd', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c18f0e1-bd91-4705-bf40-62f4781abfe1', 10000, 100, 1000000, '2024-05-21 16:35:44', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f7e6-1303-4e93-a78f-210972754771', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f7e6-1198-40c8-a909-bcdcb27de77c', 1000, 1000, 1000000, '2024-05-21 16:55:21', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f7ea-7cde-46e3-b004-d404ac0b9a15', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f7ea-7b85-4cee-854e-b779608241d3', 1000, 1000, 1000000, '2024-05-21 16:55:24', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f7f6-7725-46d6-a49a-14633a16e032', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f7f6-756d-4aad-add0-0f55a811c3f9', 100, 1000, 100000, '2024-05-21 16:55:32', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f7f8-3db6-4891-a74f-20e2ee5862a5', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f7f8-3bf6-4131-999c-806bbabc5729', 100, 1000, 100000, '2024-05-21 16:55:33', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f7f8-e211-432d-9c5c-46d7e1a169cb', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f7f8-e0d1-4c80-8517-6f5b7992c38b', 100, 1000, 100000, '2024-05-21 16:55:34', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f837-e8e9-4606-8ba3-abf1cff555b6', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f837-e7cd-4230-9942-1401e2a0a6d5', 100021, 10, 1000210, '2024-05-21 16:56:15', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f83a-3afe-4c0e-9515-723ed96338f5', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f83a-396c-40c3-a78f-5dc53093d3ba', 100021, 10, 1000210, '2024-05-21 16:56:17', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f85b-bbe9-4e41-a363-b1be95732be9', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f85b-b9fd-4169-9fbd-af9122eab0fe', 1400000, 1, 1400000, '2024-05-21 16:56:39', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f957-3389-4023-9fd5-8219b7eff30c', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f957-3219-4379-bc7b-732c9a5f2d99', 20000, 22, 440000, '2024-05-21 16:59:23', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c18f976-0e0f-4159-b96e-437927083aaf', '9c18a979-7478-4418-a049-12972aa50dfc', '9c18f976-0c7e-493d-bafe-9f41131f6286', 20000, 22, 0, '2024-05-21 16:59:44', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1aebc4-f0cb-4ef6-bc67-e3082d315301', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1aebc4-a58b-4165-be1e-b2691d7f519f', 10000, 100, 1000000, '2024-05-22 16:13:06', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1aebc4-f2b1-4a59-ae59-9fc2b1f7d819', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1aebc4-a58b-4165-be1e-b2691d7f519f', 2000, 20, 40000, '2024-05-22 16:13:06', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1aec34-0120-4f43-93de-4d4c217f2b82', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1aec34-0012-423c-8cc4-b9699c6f9026', 10000, 200, 2000000, '2024-05-22 16:14:19', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1aec34-0173-405a-986c-0dc0b34a8039', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1aec34-0012-423c-8cc4-b9699c6f9026', 100, 10, 1000, '2024-05-22 16:14:19', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1aee2d-faac-4ae8-ba82-250400c75874', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1aee2d-f954-4d52-9bd4-83c8572e71fc', 10000, 100, 1000000, '2024-05-22 16:19:50', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1aee2d-fb0a-498b-a15a-2115e40ff73a', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1aee2d-f954-4d52-9bd4-83c8572e71fc', 200, 200, 40000, '2024-05-22 16:19:50', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1af0d2-d3c1-48a1-8204-679375bd9c8e', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1af0d2-d284-408e-ac96-05c419dab559', 4444, 33, 146652, '2024-05-22 16:27:14', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1af351-5e8a-44ed-93ef-676b4a2fc6d8', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1af351-1291-4ed6-9edd-52721b717ade', 1000, 1000, 1000000, '2024-05-22 16:34:12', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1af351-5eea-411e-804a-af143636b74b', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1af351-1291-4ed6-9edd-52721b717ade', 2000, 1, 2000, '2024-05-22 16:34:12', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1af83c-ca7b-452f-bfc6-eedc6a15b2c8', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1af83c-c957-428a-b2b6-632d6bbc0056', 20000, 34, 680000, '2024-05-22 16:47:58', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1af83c-cabf-4e72-9738-e18e9f41940c', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1af83c-c957-428a-b2b6-632d6bbc0056', 500, 40, 20000, '2024-05-22 16:47:58', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1affa4-2141-46d5-86db-62906e9e03fb', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1affa4-1dea-423d-b58c-8ba0af85c112', 20000, 34, 680000, '2024-05-22 17:08:40', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1affa4-2192-484e-9eb7-3d803838d859', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1affa4-1dea-423d-b58c-8ba0af85c112', 500, 40, 20000, '2024-05-22 17:08:40', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1b0204-ac5d-4620-b82d-4168433c3a44', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1b0204-aa7c-4711-a7dd-2eeda3d4fc31', 1000, 1, 1000, '2024-05-22 17:15:19', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1b0259-a22c-461b-ab4a-86e6abbba218', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1b0259-a10d-4f62-9b53-68a9868abc74', 100, 4567, 456700, '2024-05-22 17:16:14', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1b031d-285b-41a5-9010-348ef8ccef59', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1b031d-2732-4a04-8c71-c07e9137abea', 100000, 100, 10000000, '2024-05-22 17:18:22', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1b039c-575e-4663-9a63-d333ef84a5a1', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1b039c-565e-4499-b914-60e76be442a3', 100, 1, 100, '2024-05-22 17:19:46', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bcdf5-dd92-4ce1-a262-477b0a148a21', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bcdf5-da4c-49c2-bc5a-78763cc27a9d', 1000, 1, 1000, '2024-05-23 02:45:34', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bcdf9-48c4-4f07-a53b-a5a4d7057c1a', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bcdf9-47e5-408f-ad17-fea006474a82', 1000, 1, 1000, '2024-05-23 02:45:37', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bcfa4-e66d-4b9e-ab0e-6dcdccfa438e', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bcfa4-9ee7-45b1-9eb3-beed2775e7f6', 10, 1000, 10000, '2024-05-23 02:50:17', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd1f4-5bfb-4934-a1d4-6269df53f8ca', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bd1f4-5a79-4373-97c3-d26b729f7f56', 1000, 1, 1000, '2024-05-23 02:56:45', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd27b-5665-4345-b27e-ad3224164ab6', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bd27b-552d-4889-bef2-69779b921e48', 1000000, 1, 1000000, '2024-05-23 02:58:13', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd525-6308-4396-af94-4613dbf66862', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bd525-619f-4af3-8933-4f4162088ffe', 100, 1000, 100000, '2024-05-23 03:05:40', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd525-6368-4c33-b972-587ec296f600', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1bd525-619f-4af3-8933-4f4162088ffe', 10000, 200, 2000000, '2024-05-23 03:05:40', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd6a8-968a-4bf3-9803-79e4d96b989c', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bd6a8-9547-4736-b8ac-ef3ecd763613', 1000, 2000, 2000000, '2024-05-23 03:09:54', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd6a8-96c9-4dbb-926f-86309b792981', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1bd6a8-9547-4736-b8ac-ef3ecd763613', 2000, 1, 2000, '2024-05-23 03:09:54', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd944-6bb0-4333-8517-f1317397736d', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bd944-6a49-4565-8e6e-7e13883b6ced', 100, 2000, 200000, '2024-05-23 03:17:11', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bd944-6c04-44d8-9419-dd3cc0b418ab', '9c18a979-7478-4418-a049-12972aa50dfc', '9c1bd944-6a49-4565-8e6e-7e13883b6ced', 2000, 1, 2000, '2024-05-23 03:17:11', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bdc8a-ba3f-4820-86b9-630e1729562f', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bdc8a-b8f2-44ac-b113-71ba04d6de4e', 10000, 100, 1000000, '2024-05-23 03:26:21', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1bde75-bfdd-488a-bcca-8da88f8f8243', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1bde75-be68-4a7f-9aa5-5447acf0fd75', 1000000, 2, 2000000, '2024-05-23 03:31:43', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c0e82-dc1f-4e4b-9e78-4b8ddc89f7f4', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1c0e82-da8d-4494-b4d7-1692e90bc44b', 10000, 100, 1000000, '2024-05-23 05:46:04', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c101f-6c12-4afe-8381-d30bf4e43f81', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1c101f-6ad6-4b9b-8c09-8d067be200ae', 10000, 100, 1000000, '2024-05-23 05:50:35', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c109c-90c4-404d-9ddc-9ddcdf16077a', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1c109c-8f54-4072-a053-56ec93f95cf8', 10000, 100, 1000000, '2024-05-23 05:51:57', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c11d8-a7ff-4c77-bfb8-803d1d592274', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1c11d8-a672-4a82-b97f-d216266568a5', 100000, 12, 1200000, '2024-05-23 05:55:24', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c1292-4aa1-4e78-aa3b-b88221a3b1d2', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1c1292-4970-403f-8e16-26d35bae48f0', 1000, 1220, 1220000, '2024-05-23 05:57:25', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33'),
('9c1c134b-9549-4aec-8fb3-ed8d3df2298e', '9c16d87e-a89e-4578-9543-81e8d8a9adaa', '9c1c134b-9402-4be7-8b67-2865605a83b5', 10000, 344, 3440000, '2024-05-23 05:59:27', NULL, '72ef05ec-b784-11ed-9e44-04d4c4781d33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_belakang` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `name_belakang`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('72ef05ec-b784-11ed-9e44-04d4c4781d33', 'admin', NULL, 'admin@gmail.com', NULL, '$2y$10$0f9eTQuKTxH1E7JYFBr54eXDGvgnwrMfkzyOW1b.8MH2pVNUC38nK', NULL, '2023-02-28 16:24:23', '2023-02-28 16:24:23'),
('98a72479-b3ab-424d-abe3-0f1585f59bde', 'indra', 'Kustiawan', 'indrakustiawan8@gmail.com', NULL, '$2y$10$kp7pI3ZZJTQHkapOwkw0uuFKBnroB.CwbAqFv1Cw.VhcCRAxQB7pG', NULL, '2023-03-10 08:19:49', '2024-05-20 14:49:56'),
('99e0a979-2b5c-4e3e-9a3d-bc3537f93759', 'windy', 'Amelia Putra', 'windy@gmail.com', NULL, '$2y$10$2E7FF13BeRtvXbJhsaPp5ewbF0p6EVHyRCvRuce9TMN0KcAFU40Gy', NULL, '2023-08-13 04:45:50', '2023-08-13 04:46:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_items`
--
ALTER TABLE `transaksi_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
