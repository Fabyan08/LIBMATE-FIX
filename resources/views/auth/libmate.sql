-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 11:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-fabyanpermana25@gmail.com|127.0.0.1', 'i:1;', 1779010653),
('laravel-cache-fabyanpermana25@gmail.com|127.0.0.1:timer', 'i:1779010653;', 1779010653);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_ruangan`
--

CREATE TABLE `fasilitas_ruangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruangan_id` bigint(20) UNSIGNED NOT NULL,
  `fasilitas_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Suspended','Cuti','Lulus') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`, `fakultas`, `email`, `foto`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Fabyan Yastika Permana', '232410101041', 'Ilmu Komputer', 'fabyan@student.unej.ac.id', 'mahasiswa/SEaAdChVW4ZQf9aN8qXdLlhYJ34gTRfOemninaik.png', 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:57:22', NULL),
(2, 'Nadia Salsabila', '242410101088', 'Ekonomi dan Bisnis', 'nadia.s@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(3, 'Bima Arya Putra', '222410101021', 'Teknik', 'bima.arya@student.unej.ac.id', NULL, 'Suspended', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(4, 'Rina Melati', '232410102011', 'Keperawatan', 'rina.m@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(5, 'Ahmad Fauzi', '212410103055', 'Pertanian', 'fauzi.a@student.unej.ac.id', NULL, 'Lulus', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(6, 'Siti Aminah', '242410101099', 'Ilmu Budaya', 'siti@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(7, 'Deni Setiawan', '232410101044', 'Ilmu Komputer', 'deni@student.unej.ac.id', NULL, 'Cuti', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(8, 'Ayu Lestari', '222410101077', 'Hukum', 'ayu.l@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(9, 'Reza Aditya', '242410101012', 'Ilmu Komputer', 'reza.a@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(10, 'Dita Paramita', '222410103099', 'Kedokteran Gigi', 'dita.p@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(17, 'Ayu Dwi', '232410102089', 'Sistem Informasi', 'ayu.d@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(18, 'Reza Udin', '242410101001', 'Ilmu Komputer', 'reza.u@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(19, 'Dita Ditu', '222410103005', 'Kedokteran Gigi', 'dita.d@student.unej.ac.id', NULL, 'Aktif', '2026-05-08 15:04:52', '2026-05-08 15:04:52', NULL),
(23, 'Delectus nihil moll', '242410101009', 'Ekonomi dan Bisnis', 'gazy@mailinator.com', '', 'Suspended', '2026-05-08 08:51:41', '2026-05-08 15:57:18', NULL),
(24, 'Eum veritatis ab non', '242410101034', 'Ekonomi dan Bisnis', 'fofinom@mailinator.com', 'mahasiswa/CbLMTkGbl54RZdJFo5HfDDaLZSjMOmneG5ZHicBB.jpg', 'Cuti', '2026-05-08 09:59:10', '2026-05-08 09:59:10', 1),
(25, 'Ryan', '242410101020', 'Kedokteran', 'ryan@gmail.com', 'mahasiswa/sb4v9obfWhCJAQDgQpruoIRvOcT0VjUDm9eRxRsE.jpg', 'Aktif', '2026-05-17 20:40:04', '2026-05-17 20:41:29', 2),
(26, 'Cipet', '242410101021', 'Ekonomi dan Bisnis', 'cipet@gmail.com', 'mahasiswa/QrK0HaOe4ufBPcrIzD5Iq3CdJohSLsv7fEXuVavJ.jpg', 'Aktif', '2026-05-17 20:42:07', '2026-05-17 20:42:07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_05_051502_create_ruangans_table', 2),
(5, '2026_05_05_053058_create_fasilitas_table', 3),
(6, '2026_05_05_053136_create_fasilitas_ruangan__table', 3),
(7, '2026_05_08_165615_add_user_id_to_mahasiswa_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruang` varchar(255) NOT NULL,
  `lantai` varchar(255) NOT NULL,
  `kapasitas` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `nama_ruang`, `lantai`, `kapasitas`, `kategori`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Ruang Tenang A', '1', '4', 'Ruang Diskusi', 'ruang1.jpeg', '2026-04-26 07:35:20', '2026-04-26 07:35:20'),
(2, 'Ruang Tenang B', '1', '6', 'Ruang Diskusi', 'ruang2.jpeg', '2026-04-26 07:35:20', '2026-04-26 07:35:20'),
(3, 'Ruang Meeting 1', '2', '10', 'Ruang Meeting', 'ruang3.jpg', '2026-04-26 07:35:20', '2026-04-26 07:35:20'),
(4, 'Ruang Meeting 2', '2', '12', 'Ruang Meeting', 'ruang5.jpg', '2026-04-26 07:35:20', '2026-04-26 07:35:20'),
(5, 'Ruang Seminar', '3', '30', 'Ruang Seminar', 'ruang6.webp', '2026-04-26 07:35:20', '2026-04-26 07:35:20'),
(6, 'Ruang Diskusi A1', '1', '6', 'Diskusi Kelompok', 'ruang-a1.jpg', '2026-05-04 22:25:53', '2026-05-04 22:25:53'),
(7, 'Ruang Multimedia', '1', '12', 'Fasilitas Digital', 'multimedia.jpg', '2026-05-04 22:25:53', '2026-05-04 22:25:53'),
(8, 'Ruang Literasi 1', '2', '4', 'Ruang Tenang', 'literasi-1.jpg', '2026-05-04 22:25:53', '2026-05-04 22:25:53'),
(9, 'Ruang Kolaborasi B2', '2', '8', 'Diskusi Kelompok', 'kolaborasi-b2.jpg', '2026-05-04 22:25:53', '2026-05-04 22:25:53'),
(10, 'Ruang Referensi VIP', '3', '2', 'Privat', 'vip-3.jpg', '2026-05-04 22:25:53', '2026-05-04 22:25:53'),
(11, 'Corner Inovasi', '3', '15', 'Workshop', 'inovasi.jpg', '2026-05-04 22:25:53', '2026-05-04 22:25:53'),
(12, 'Ruang Kajian Mandiri', '2', '1', 'Individu', 'mandiri.jpg', '2026-05-04 22:25:53', '2026-05-04 22:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jF4skzgdU0xm7eEsR2rl3E59qdRpzy6zziRpTQ0A', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.120.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'eyJfdG9rZW4iOiJoOUUwc05CWFlFSnNFaENRRnpwWm5RWmIwTHBaNFRHZklibFhSSmpWIiwidmlzaXRfY291bnQiOjEsImZpcnN0X3Zpc2l0IjoiMjEgTWF5IDIwMjYsIDE1OjQ0OjU4IiwibGFzdF92aXNpdCI6IjIxIE1heSAyMDI2LCAxNTo0NDo1OCIsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1779353100),
('r7IZ9V7bVbfLpp68FEVDstzYw8FC2QcAlvgOijLN', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJsMENsc3N4SWZWd3NVVE9UVEFVQ2NoZzhTMGFROGVQSGhIZXA1RFkyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9tYW5hamVtZW4tcnVhbmciLCJyb3V0ZSI6Im1hbmFqZW1lbi1ydWFuZyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInZpc2l0X2NvdW50IjoxNCwiZmlyc3RfdmlzaXQiOiIyMSBNYXkgMjAyNiwgMTU6NDk6MDUiLCJsYXN0X3Zpc2l0IjoiMjEgTWF5IDIwMjYsIDE1OjUyOjMyIiwidXJsIjpbXSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1779354257);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fabyan', 'fabyanpermana25@gmail.com', 'admin', NULL, '$2y$12$yD/4R1yvKSUtRfvzdsv60OqvMi1heK5KPAfhDrMmptvBb7UwhbpLu', NULL, '2026-05-08 09:38:19', '2026-05-08 09:38:19'),
(2, 'user', 'user@gmail.com', 'admin', NULL, '$2y$12$ApWV8tM0Tk6aU672AAOCW.PjTmDbUHdy/BPTWNlWvZqu2XUpAe97u', NULL, '2026-05-17 02:43:37', '2026-05-17 02:43:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fasilitas_ruangan_ruangan_id_foreign` (`ruangan_id`),
  ADD KEY `fasilitas_ruangan_fasilitas_id_foreign` (`fasilitas_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `mahasiswa_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD CONSTRAINT `fasilitas_ruangan_fasilitas_id_foreign` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fasilitas_ruangan_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
