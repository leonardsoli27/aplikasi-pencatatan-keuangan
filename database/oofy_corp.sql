-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2021 at 04:42 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.3.24-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oofy_corp`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_karyawan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kelompok` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama_karyawan`, `no_hp`, `email`, `nama_kelompok`, `created_at`, `updated_at`) VALUES
(1, 'Leo', '08938247390', 'leonard.soli27@gmail.com', 'Admin', '2021-03-07 17:39:49', '2021-03-07 17:39:49'),
(2, 'Aldi', '083441312122', 'aldi@gmail.com', 'CS Adil', '2021-03-24 03:32:30', '2021-03-24 03:32:30'),
(3, 'Sara', '081234567890', 'sara@gmail.com', 'CS Adil', '2021-03-24 03:33:09', '2021-03-24 03:33:09'),
(4, 'Dodi', '089291219111', 'dodi@gmail.com', 'CS Adil', '2021-03-24 03:33:44', '2021-03-24 03:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_18_124859_create_pendapatan_table', 1),
(5, '2021_02_18_124935_create_pengeluaran_table', 1),
(6, '2021_02_20_165654_create_karyawan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suplier` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pembeli` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_produk` int NOT NULL,
  `kas_masuk` int NOT NULL,
  `kas_keluar` int NOT NULL,
  `total` int NOT NULL,
  `jenis_pembayaran` varchar(27) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_masuk` date NOT NULL,
  `no_resi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_pesanan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akun_shopee` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendapatan`
--

INSERT INTO `pendapatan` (`id`, `kode_kelompok`, `suplier`, `nama_pembeli`, `nama_produk`, `jml_produk`, `kas_masuk`, `kas_keluar`, `total`, `jenis_pembayaran`, `status`, `tgl_masuk`, `no_resi`, `no_pesanan`, `akun_shopee`, `created_at`, `updated_at`) VALUES
(11, 'admin', 'Leo', 'Dito', 'Sabun', 2, 30000, 1500, 28500, 'Transfer', 'Lunas', '2021-06-04', '423243244222242', NULL, NULL, '2021-03-04 06:47:35', '2021-03-07 16:55:46'),
(23, 'admin', NULL, 'sads', 'barang1', 2, 10000, 1000, 9000, 'Transfer', 'Lunas', '2021-03-05', 'd32d2dd242d', '232442343d2d23', 'asdaeadea', NULL, '2021-03-14 19:02:31'),
(24, 'admin', 'Leon', 'sads', 'barang2', 3, 20000, 2000, 19000, 'COD', 'Sampai', '2021-03-05', 'd32d2dd242d', NULL, NULL, NULL, '2021-03-07 17:52:47'),
(26, 'admin', 'Leon', 'sads', 'barang2', 3, 20000, 2000, 18000, 'Transfer', 'Lunas', '2021-03-05', 'd32d2dd242d', NULL, NULL, NULL, '2021-03-07 16:48:55'),
(42, 'admin', 'Leo', 'sasas', 'adasd', 2, 20000, 0, 20000, 'Transfer', 'Belum Sampai', '2021-03-07', '12131212342121', NULL, NULL, NULL, '2021-03-07 16:48:01'),
(43, 'admin', 'Leo', 'sasas', 'asdsda', 2, 20000, 2000, 18000, 'COD', 'Lunas', '2021-03-08', '12131212342121', NULL, NULL, NULL, '2021-03-24 03:35:45'),
(44, 'admin', 'asdada', 'Darby', 'asdsda', 2, 20000, 3000, 17000, 'COD', 'Gagal', '2021-03-09', '12131212342121', NULL, NULL, NULL, '2021-03-07 18:13:19'),
(47, 'admin', NULL, 'tomi', 'bibit apel', 1, 120000, 0, 120000, 'COD', 'Lunas', '2021-03-07', NULL, NULL, NULL, NULL, '2021-03-08 04:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya_iklan` int DEFAULT NULL,
  `pajak_iklan` int DEFAULT NULL,
  `total` int NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `kode_kelompok`, `keterangan`, `kategori`, `biaya_iklan`, `pajak_iklan`, `total`, `tgl_pengeluaran`, `created_at`, `updated_at`) VALUES
(11, 'admin', 'sasas', 'Iklan', 32000, 3200, 35200, '2021-03-04', '2021-03-04 06:50:32', '2021-03-07 17:33:20'),
(12, 'admin', 'edww', 'Iklan', 25000, 2500, 27500, '2021-06-04', '2021-03-04 06:51:45', '2021-03-14 18:22:57'),
(13, 'admin', 'sddfs', 'Iklan', 45000, 4500, 49500, '2021-03-04', '2021-03-04 06:52:06', '2021-03-14 18:22:40'),
(14, 'admin', 'Marketplace Terbaik', 'Operasional', NULL, NULL, 10000, '2021-03-08', '2021-03-07 17:33:45', '2021-03-07 17:33:55'),
(16, 'admin', 'Biaya Iklan 1-7 Maret', 'Iklan', 50987, 5099, 56085, '2021-03-07', '2021-03-08 04:33:28', '2021-03-08 04:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `kode_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`kode_kelompok`, `password`, `nama_kelompok`, `remember_token`, `created_at`, `updated_at`) VALUES
('admin', '$2y$10$pgc6c4xDF9HPwgXcmj/0cOlHsxau3dxxHDwIhiwUx1AkFCQa82kYy', 'Admin', 'kwNUBpGEnwUaGoWACaYKm0cVsjzKZ9jdFRWleM71DgXWweKDROURgr0ySyPr', NULL, '2021-03-24 03:38:28'),
('csadib', '$2y$10$5T5CA2L67RM4qVoXHb7T8.jGqtmFYWHI4F6fMkYUyLmac2Jsd0UL.', 'CS Adib', NULL, '2021-03-08 06:46:55', '2021-03-08 06:46:55'),
('csadil', '$2y$10$4AMvwcH4Xe82rUrEG/0fpOvZey8DMYBb7ubIgAKW3eHRWarRCIcI.', 'CS Adil', NULL, '2021-03-08 06:43:50', '2021-03-08 06:43:50'),
('csani', '$2y$10$M0uRSkvC546tuaFN681TgOQ/.sr.Tn7OrG14JyMbbubzaGrlBA9na', 'CS Ani', NULL, '2021-03-08 06:44:36', '2021-03-08 06:44:36'),
('csayak', '$2y$10$KG4mBA1l8IWNPSM51z/qweZCYu4YcdmTAb5.oKlsigndaTK9teVfS', 'CS Ayak', NULL, '2021-03-08 06:43:59', '2021-03-08 06:43:59'),
('csaziz', '$2y$10$N5UaF8KV3JGEoEh1QkR9qO3WzmTXopBXjQGOVAfWF4Wc1/TIuexBu', 'CS Aziz', NULL, '2021-03-08 06:43:19', '2021-03-08 06:43:19'),
('csbahul', '$2y$10$F6b0XCb0skKBu3KtdvJPHe4dRI6tgAgdlxjQBrP5Mb01CuI/Q0xSm', 'CS Bahul', NULL, '2021-03-08 06:44:23', '2021-03-08 06:44:23'),
('csedo', '$2y$10$Lm043acGNhsanH2KcZRm8ekUN3zXNBivdRjTqbCyGWFmbejOnqQs6', 'CS Edo', NULL, '2021-03-08 06:46:34', '2021-03-08 06:46:34'),
('csfarah', '$2y$10$N3i.SDYQy3TcGuBhoMdLR.WgR5bBf0iRAHJ7Q6bNHoT.oizSOqdFO', 'CS Farah', NULL, '2021-03-08 06:42:58', '2021-03-08 06:42:58'),
('cshimayatus', '$2y$10$2yYGumOATSWM6EgR6mRd6.VhGo0Mb9i8UzfnZGRD/ino4eP98XU3e', 'CS Himayatus', NULL, '2021-03-08 06:45:00', '2021-03-08 06:45:00'),
('csiksan', '$2y$10$Zp79e7QRM8p.yrbv02OP2uJDh0uCHHkp3m/RmfuORRJ/mQg.1AoJi', 'CS Iksan', NULL, '2021-03-08 06:46:43', '2021-03-08 06:46:43'),
('csilham', '$2y$10$OeQWLrg.ycYh6t0dUveoG.mhAqTJLxqnaVDiEQIqeXLHJNj6AiYvu', 'CS Ilham', NULL, '2021-03-08 06:47:46', '2021-03-08 06:47:46'),
('csindira', '$2y$10$u6eWDu3MOcK59nVCgPnfdOJZuLgFhMW10dwJrmQKvCUo3hX9H4qx2', 'CS Indira', NULL, '2021-03-08 06:42:19', '2021-03-08 06:42:19'),
('csirvan', '$2y$10$flcJfjGVEl.e8YOlByuzo.krqMSdoY8rFzMqdl4cIk1x2/y4yNoKu', 'CS Irvan', NULL, '2021-03-08 06:46:24', '2021-03-08 06:46:24'),
('cskarin', '$2y$10$KYaeT7KkVLBTS4pmsqsvOO6DbXjHMelkjLzsQFC836yj67pPmOq5u', 'CS Karin', NULL, '2021-03-08 06:42:34', '2021-03-08 06:42:34'),
('cslily', '$2y$10$ykolUH6bhLlMh.aHFqVLReoRxyoXN3guItoA64p9D6MbrrmQGyGMW', 'CS Lily', NULL, '2021-03-08 06:45:39', '2021-03-08 06:45:39'),
('csmay', '$2y$10$bzjLTwbgPPixPdOATica0Old6TDuYKqxvB78YWtLFbnIggMPdQvQq', 'CS May', NULL, '2021-03-08 06:47:29', '2021-03-08 06:47:29'),
('csnadhila', '$2y$10$uWD6zyT6vQSk.yPpk4mVtunT.v6fqZ32lu5yKGlRHK0w4gyAq8oXO', 'CS Nadhila', NULL, '2021-03-08 06:42:08', '2021-03-08 06:42:08'),
('csnadya', '$2y$10$kYwTlS1zDxmPHSXrkSaKA.8j9u3.PgTKkaRQVf6ZPVt/TbQtK2f0m', 'CS Nadya', NULL, '2021-03-08 06:44:46', '2021-03-08 06:44:46'),
('csqueensa', '$2y$10$pQg.34QVH62KDeMfH2CbPO0rx4bFqZT9Uk01LDlgX/HIxgOFJNO/C', 'CS Queensa', NULL, '2021-03-08 06:45:27', '2021-03-08 06:45:27'),
('csrafa', '$2y$10$FZ44xA0TiuQBC5i43bNKBe7XNPpSvIPk/2tXiS1WI/l4kZE/DG/oS', 'CS Rafa', NULL, '2021-03-08 06:47:19', '2021-03-08 06:47:19'),
('csrobi', '$2y$10$9ZKWfoUzDmBlR5C6Hc.jUO4pZKeLFk0DBWTKwsX5bs1tgvau3Ij9W', 'CS Robi', NULL, '2021-03-08 06:45:12', '2021-03-08 06:45:12'),
('cssubhan', '$2y$10$391FZevmnlRebbxdWQwPLOKJH0UL9fcD5j0A4OsJanpqjh9EAAzhm', 'CS Subhan', NULL, '2021-03-08 06:45:51', '2021-03-08 06:45:51'),
('cssulis', '$2y$10$HHwWG6nsfB3AfgNnf.Mzp.g1kWDK36rMhuODrVt11VEMt4JdeVjhm', 'CS Sulis', NULL, '2021-03-08 06:42:46', '2021-03-08 06:42:46'),
('csvanca', '$2y$10$Lj7L/30bbmpgu0OLhL0J4OOi1VhQQhePGtg7cVcU8mycUKVB/V7Qa', 'CS Vanca', NULL, '2021-03-08 06:46:10', '2021-03-08 06:46:10'),
('cszen', '$2y$10$.5EbOaxatpTZca3jm3ztguDPqjrzm7r4GaT49Cga/SY5w5ztJ71bC', 'CS Zen', NULL, '2021-03-08 06:47:07', '2021-03-08 06:47:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendapatan_kode_kelompok_foreign` (`kode_kelompok`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengeluaran_kode_kelompok_foreign` (`kode_kelompok`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`kode_kelompok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD CONSTRAINT `pendapatan_kode_kelompok_foreign` FOREIGN KEY (`kode_kelompok`) REFERENCES `users` (`kode_kelompok`) ON DELETE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_kode_kelompok_foreign` FOREIGN KEY (`kode_kelompok`) REFERENCES `users` (`kode_kelompok`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
