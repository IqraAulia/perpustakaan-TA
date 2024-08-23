-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Agu 2024 pada 07.05
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pustaka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggotas`
--

CREATE TABLE `anggotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_induk` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `noHp` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar_buku` varchar(255) DEFAULT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `daftar_isi` text DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `pengarang_id` bigint(20) UNSIGNED NOT NULL,
  `penerbit_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_terbit` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('Tersedia','Kosong','Diajukan') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bukus`
--

INSERT INTO `bukus` (`id`, `gambar_buku`, `judul_buku`, `daftar_isi`, `kategori_id`, `pengarang_id`, `penerbit_id`, `tahun_terbit`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(3, 'gambar_buku/Cuplikan-layar-2024-06-27-080425.png', 'Harry Potter', 'test', 1, 1, 1, '2024', 111, 'Tersedia', '2024-08-06 19:08:36', '2024-08-19 23:12:26'),
(11, 'gambar_buku/7unXJ72puEL0qPytqEQZ3Entfv57wsBpfUY2vSm5.jpg', 'Kancil dan petani', 'test', 3, 3, 1, '2010', 100, 'Tersedia', '2024-08-12 05:51:00', '2024-08-16 01:27:23'),
(12, 'gambar_buku/Kz3AFdmk9UrsB8W2XzUBRs2rm7R9xEekDQJFX1Wi.jpg', 'Malin Kundang', 'test', 4, 2, 1, '2009', 99, 'Tersedia', '2024-08-12 05:51:36', '2024-08-19 00:52:22'),
(13, 'gambar_buku/9efy70OBl2Cz5s1Dc6GBBJZm25XXrMEILQhXgFNW.jpg', 'Danau Toba', 'tes', 3, 1, 1, '2023', 99, 'Tersedia', '2024-08-12 06:55:16', '2024-08-19 04:00:32'),
(14, NULL, 'bawang merah dan bawang putih', NULL, 4, 1, 2, '2020', 0, 'Diajukan', '2024-08-12 07:04:17', '2024-08-12 07:04:17'),
(15, 'img/KtfXLrcOsv6FKBWzfFP0UcCeAGzSqxd2FtJXQl9Y.jpg', 'Danau Ateh Danau Bawah', 'anjay', 3, 1, 1, '2004', 10, 'Tersedia', '2024-08-14 02:53:22', '2024-08-19 04:00:32'),
(17, 'img/6q1lVsKVVTmVsH1mjHz9vOHz0nfwjnE5t5PLxdZO.png', 'jhgj', 'jhvjyuy', 1, 1, 1, '222', 8, 'Tersedia', '2024-08-14 03:02:51', '2024-08-14 03:02:51'),
(19, 'img/9zy7jfV8Dxtj4ObvxJ2a7HUDeh3RP29rTyX8nQ4r.jpg', 'anjay', 'adsaasd', 2, 1, 1, '1009', 10, 'Tersedia', '2024-08-14 03:11:53', '2024-08-14 03:12:15'),
(20, 'img/kitsune.jpg', 'ANAK YANG DITUKAR', 'anjay', 1, 1, 1, '1998', 10, 'Tersedia', '2024-08-14 03:13:52', '2024-08-14 03:15:57'),
(21, 'img/icon-bad-buddy-1458.jpg', 'BAD BUDI', 'asdsad', 1, 1, 1, '2000', 10, 'Tersedia', '2024-08-14 03:14:48', '2024-08-14 03:18:56'),
(22, 'gambar_buku/icon-bad-buddy.jpg', 'Rubah ekor tujuh', 'fdhthgdg', 4, 1, 1, '2001', 100, 'Tersedia', '2024-08-14 20:34:47', '2024-08-14 20:36:51'),
(23, 'gambar_buku/Cuplikan-layar-2024-07-18-162829.png', 'tikus makan kabel', 'wwwwwwwwww\r\nwwwwwwww\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\nwwwwwwwwww            wwwwwwwwwwww\r\nwwwwwwwwww              \r\nwwwwwwwwwwww', 3, 1, 1, '2003', 10, 'Tersedia', '2024-08-14 22:07:05', '2024-08-14 22:07:05'),
(24, 'gambar_buku/Cuplikan-layar-2024-07-18-162829.png', 'tugas akir', 'daftar isi', 2, 1, 1, '2004', 100, 'Tersedia', '2024-08-15 01:51:03', '2024-08-15 01:51:03'),
(25, 'gambar_buku/kitsune.jpg', 'sistem informasi perpustakaan', 'daftar isi', 14, 6, 4, '2024', 100, 'Tersedia', '2024-08-20 03:53:20', '2024-08-20 03:55:16'),
(26, NULL, 'seni berbicara', NULL, 2, 2, 1, '2004', 0, 'Diajukan', '2024-08-20 03:56:18', '2024-08-20 03:56:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dendas`
--

CREATE TABLE `dendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dendas`
--

INSERT INTO `dendas` (`id`, `peminjaman_id`, `denda`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 10, 2000, 'test', '2024-08-12 06:46:52', '2024-08-12 06:46:52'),
(2, 11, 200, 'hilang', '2024-08-14 22:28:39', '2024-08-14 22:28:39'),
(3, 12, 1233, 'hilang', '2024-08-14 23:23:12', '2024-08-14 23:23:12'),
(4, 13, 12334, 'hilang', '2024-08-14 23:24:59', '2024-08-14 23:24:59'),
(5, 16, 0, 'tidak ada denda', '2024-08-14 23:47:28', '2024-08-14 23:47:28'),
(6, 15, 2000, 'rusak', '2024-08-15 01:49:15', '2024-08-15 01:49:15'),
(7, 19, 0, 'hilang', '2024-08-16 01:27:23', '2024-08-16 01:27:23'),
(8, 20, 0, 'tidak ada denda', '2024-08-16 01:29:32', '2024-08-16 01:29:32'),
(9, 22, 222, 'dfdf', '2024-08-19 01:50:30', '2024-08-19 01:50:30'),
(10, 23, 0, 'rfrg', '2024-08-19 04:00:32', '2024-08-19 04:00:32'),
(11, 25, 0, '2100159', '2024-08-20 03:55:16', '2024-08-20 03:55:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', 'aktif', '2024-07-28 23:32:34', '2024-08-12 05:45:50'),
(2, 'Ilmiah', 'aktif', '2024-08-07 20:19:53', '2024-08-12 05:45:58'),
(3, 'Dongeng', 'aktif', '2024-08-07 20:19:54', '2024-08-12 05:46:13'),
(4, 'Cerpen', 'aktif', '2024-08-07 20:20:05', '2024-08-12 05:46:18'),
(14, 'Laporan Tugas Akhir', 'aktif', '2024-08-20 03:51:17', '2024-08-20 03:51:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_24_083154_create_kategoris_table', 1),
(5, '2024_07_24_090424_create_bukus_table', 1),
(6, '2024_07_25_045815_create_anggotas_table', 1),
(7, '2024_07_25_080534_create_peminjamen_table', 1),
(8, '2024_07_28_033408_create_peminjaman_details_table', 1),
(9, '2024_07_28_033843_create_pengarangs_table', 1),
(10, '2024_07_28_034007_create_penerbits_table', 1),
(11, '2024_07_28_040242_create_dendas_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_kembalikan` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `created_by`, `user_id`, `tgl_pinjam`, `tgl_kembali`, `tgl_kembalikan`, `status`, `created_at`, `updated_at`) VALUES
(8, 5, 6, '2024-08-12', '2024-08-19', NULL, 'selesai', '2024-08-12 06:40:09', '2024-08-12 06:45:03'),
(9, 3, 6, '2024-08-12', '2024-08-19', NULL, 'selesai', '2024-08-12 06:45:37', '2024-08-12 06:45:51'),
(10, 5, 6, '2024-08-12', '2024-08-19', NULL, 'selesai', '2024-08-12 06:46:23', '2024-08-12 06:46:52'),
(11, 4, 4, '2024-08-13', '2024-08-20', NULL, 'selesai', '2024-08-13 00:12:24', '2024-08-14 22:28:39'),
(12, 4, 4, '2024-08-13', '2024-08-20', NULL, 'selesai', '2024-08-13 00:17:16', '2024-08-14 23:23:12'),
(13, 4, 4, '2024-08-15', '2024-08-22', NULL, 'selesai', '2024-08-14 23:24:14', '2024-08-14 23:24:59'),
(14, 4, 4, '2024-08-15', '2024-08-22', NULL, 'dipinjam', '2024-08-14 23:26:19', '2024-08-14 23:34:19'),
(15, 4, 4, '2024-08-15', '2024-08-22', NULL, 'selesai', '2024-08-14 23:33:48', '2024-08-15 01:49:15'),
(16, 3, 7, '2024-08-15', '2024-08-22', NULL, 'selesai', '2024-08-14 23:46:09', '2024-08-14 23:47:28'),
(17, 4, 6, '2024-08-15', '2024-08-22', NULL, 'dipinjam', '2024-08-15 00:37:34', '2024-08-19 00:52:22'),
(18, 4, 4, '2024-08-15', '2024-08-22', NULL, 'dipinjam', '2024-08-15 01:48:18', '2024-08-19 00:56:24'),
(19, 5, 6, '2024-08-16', '2024-08-23', NULL, 'selesai', '2024-08-16 01:26:14', '2024-08-16 01:27:23'),
(20, 5, 6, '2024-08-16', '2024-08-23', NULL, 'selesai', '2024-08-16 01:28:43', '2024-08-16 01:29:32'),
(21, 4, 4, '2024-08-19', '2024-08-26', NULL, 'dipinjam', '2024-08-19 00:59:41', '2024-08-19 01:00:01'),
(22, 4, 4, '2024-08-19', '2024-08-26', NULL, 'selesai', '2024-08-19 01:01:07', '2024-08-19 01:50:30'),
(23, 4, 4, '2024-08-19', '2024-08-26', NULL, 'selesai', '2024-08-19 03:59:58', '2024-08-19 04:00:32'),
(24, 4, 4, '2024-08-20', '2024-08-27', NULL, 'dipinjam', '2024-08-19 23:12:09', '2024-08-19 23:12:26'),
(25, 4, 4, '2024-08-20', '2024-08-27', NULL, 'selesai', '2024-08-20 03:54:11', '2024-08-20 03:55:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_details`
--

CREATE TABLE `peminjaman_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `buku_kode` varchar(255) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman_details`
--

INSERT INTO `peminjaman_details` (`id`, `peminjaman_id`, `buku_id`, `buku_kode`, `jumlah`, `created_at`, `updated_at`) VALUES
(12, 8, 3, NULL, 1, '2024-08-12 06:40:09', '2024-08-12 06:40:09'),
(13, 8, 11, NULL, 1, '2024-08-12 06:40:09', '2024-08-12 06:40:09'),
(14, 9, 3, NULL, 1, '2024-08-12 06:45:37', '2024-08-12 06:45:37'),
(15, 9, 11, NULL, 1, '2024-08-12 06:45:37', '2024-08-12 06:45:37'),
(16, 10, 11, NULL, 1, '2024-08-12 06:46:23', '2024-08-12 06:46:23'),
(17, 11, 3, NULL, 1, '2024-08-13 00:12:24', '2024-08-13 00:12:24'),
(18, 12, 3, NULL, 1, '2024-08-13 00:17:16', '2024-08-13 00:17:16'),
(19, 13, 15, NULL, 1, '2024-08-14 23:24:14', '2024-08-14 23:24:14'),
(20, 14, 13, NULL, 1, '2024-08-14 23:26:19', '2024-08-14 23:26:19'),
(21, 15, 15, NULL, 1, '2024-08-14 23:33:48', '2024-08-14 23:33:48'),
(22, 16, 13, NULL, 1, '2024-08-14 23:46:09', '2024-08-14 23:46:09'),
(23, 17, 12, '20340', 1, '2024-08-15 00:37:34', '2024-08-19 00:52:22'),
(24, 17, 3, '4594', 1, '2024-08-15 00:37:34', '2024-08-19 00:52:22'),
(25, 18, 3, 'asdasd', 1, '2024-08-15 01:48:18', '2024-08-19 00:56:24'),
(26, 19, 3, NULL, 1, '2024-08-16 01:26:14', '2024-08-16 01:26:14'),
(27, 19, 12, NULL, 1, '2024-08-16 01:26:14', '2024-08-16 01:26:14'),
(28, 19, 11, NULL, 1, '2024-08-16 01:26:14', '2024-08-16 01:26:14'),
(29, 20, 3, NULL, 1, '2024-08-16 01:28:43', '2024-08-16 01:28:43'),
(30, 21, 3, '2132434', 1, '2024-08-19 00:59:41', '2024-08-19 01:00:01'),
(31, 22, 3, '10000202', 1, '2024-08-19 01:01:07', '2024-08-19 01:01:24'),
(32, 23, 15, '1000', 1, '2024-08-19 03:59:58', '2024-08-19 04:00:16'),
(33, 23, 13, '1000', 1, '2024-08-19 03:59:58', '2024-08-19 04:00:16'),
(34, 24, 3, '1000', 1, '2024-08-19 23:12:09', '2024-08-19 23:12:26'),
(35, 25, 25, '2100159', 1, '2024-08-20 03:54:11', '2024-08-20 03:54:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbits`
--

CREATE TABLE `penerbits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penerbits`
--

INSERT INTO `penerbits` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Gramedia', 'jakarta', '2024-07-28 23:33:02', '2024-07-28 23:33:02'),
(2, 'Lintasarta', 'jakarta', '2024-08-07 20:20:24', '2024-08-07 20:20:24'),
(4, 'bukupedia', 'padang', '2024-08-20 03:52:16', '2024-08-20 03:52:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengarangs`
--

CREATE TABLE `pengarangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengarangs`
--

INSERT INTO `pengarangs` (`id`, `nama`, `tgl_lahir`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'dimas', '2024-07-22', 'padang', '2024-07-28 23:32:48', '2024-07-28 23:32:48'),
(2, 'andi', '2014-09-19', 'padang', '2024-08-07 20:20:15', '2024-08-07 20:20:15'),
(3, 'budi', '2024-08-12', 'padang', '2024-08-12 05:46:47', '2024-08-12 05:46:47'),
(6, 'iqra', '2024-08-06', 'padang', '2024-08-20 03:51:36', '2024-08-20 03:51:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2KsvSPas1q5IOGRKs2IcV06piU8NY6qe7neBAida', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkRmV0NlSjNKUzc1ZGx2U0RTMmFGYmluVkNVV1c4NE1VTUNzR05XMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1724041056),
('3reeyLnHfcqSIWIsMZIGdJO5eP0JnYYnuaSLTSqG', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnR2UU1xelFUWFA5ckZaY0Y2SkdmbnVQaUF3dUpzWXlDUVRGQkRhMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leHBvcnQtcGRmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1724151396),
('DDci0ZVb4nr7PUxq0wFNkTXHckulR4Wcc71YuJTh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnBpZDcxNmtWZ1dyQnpXcFFHZmczd2Qzbm5oRURqem1rMUZSQ1EyMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1723810013),
('HyYwsFLCfI3nsNhvFnbJNkaZdTBJOC2awbmMDsJJ', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3JLcWN5VFN2Vmh6a29IZTJ6d1lDdEcxb1NZRkhFRVh6Zkp5N0pleCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1724042094),
('pt2Zz5rktULdSIBg7mbu4qD8qXCGyQCyVdKiS58H', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR0JZUTZHUHZVMGlNYVo0RkxXMGk2SHpDdGUwYXlKSHJadWgwQW4xbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1724135366),
('TLy5c2UX5Hj1PH3vW9hKS0Oj4WFLs6sr2yrmQKFO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1FKWGVxZ3BMV0ZtN1hYZ2xmQkNhaUg2a3VMZVlBY1NaUlhSaHNqVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1724207599),
('ylLVzz314lsZFYMrNcjxL0CpsxOA6XMFdd5akAsc', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicDlvb1MyY2I4YlJpdFdEWTVYbVIyZzBxRzVOcGprTUNqQ2dqZThxOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yaXdheWF0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1724065238),
('Z3mS8v11RBn6ylXeyBuVo8cNWAh34G7aVlJdWLVC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGlnaVVseHQ3cmFLdkxXWWZZemw2UmtmVk1OdTVBTjJoYjZweUczWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leHBvcnQtcGRmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1723960384);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('Kaprodi','Super admin','Admin','Dosen','Mahasiswa','Petugas') NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'cipto', 'Kaprodi', 'kaprodi@gmail.com', NULL, '$2y$12$unTQMB74gdX71h17NKuNL.eQ8jYydwkt76f6.mebMwm32M0HFDGmK', NULL, '2024-07-29 01:13:51', '2024-08-11 06:14:24'),
(3, 'admin 1', 'Admin', 'admin@gmail.com', NULL, '$2y$12$VAMo5OzQs.tnZAo4mXAiWub3mYsHFJYPJPj9etZiH8COaqCR0/aAu', NULL, '2024-07-29 21:27:34', '2024-08-09 00:15:00'),
(4, 'iqra', 'Super admin', 'superadmin@gmail.com', NULL, '$2y$12$wnyjdOZ8Lp24tDXfCQe5HuNKBgl64cqUWHZBr/MYLgvYBBVSrtfY2', NULL, '2024-07-29 21:39:10', '2024-08-11 06:23:14'),
(5, 'petugas 1', 'Petugas', 'petugas@gmail.com', NULL, '$2y$12$lYnM0r/Piu..ZVsuLviUmO29tqOEIV/eiGRYfF5CM//66I1F4CgGO', NULL, '2024-07-29 21:40:22', '2024-08-11 06:27:13'),
(6, 'dosen 1', 'Dosen', 'dosen@gmail.com', NULL, '$2y$12$1Rmziv7yF1NtgXznDaJCD.k.M60R1es6y1XvjTynBAFEi4JmTMd7u', NULL, '2024-07-29 21:40:47', '2024-08-09 00:26:43'),
(7, 'mahasiswa 1', 'Mahasiswa', 'mahasiswa@gmail.com', NULL, '$2y$12$//dcD0yccb/GjlMmV99S2.xwTiF80EF5YAxBWcdxDJ/xpElyRfKp2', NULL, '2024-08-11 06:30:01', '2024-08-11 06:30:01'),
(8, 'bobi', 'Mahasiswa', 'bobi@gmail.com', NULL, '$2y$12$aQlgYJ7U5DtsMI6YXCKwxOA3Rq6PGI2MvW1whRv.tPHvEmBqaJvES', NULL, '2024-08-12 07:27:26', '2024-08-12 07:27:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggotas`
--
ALTER TABLE `anggotas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `dendas`
--
ALTER TABLE `dendas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman_details`
--
ALTER TABLE `peminjaman_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penerbits`
--
ALTER TABLE `penerbits`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengarangs`
--
ALTER TABLE `pengarangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggotas`
--
ALTER TABLE `anggotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `dendas`
--
ALTER TABLE `dendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_details`
--
ALTER TABLE `peminjaman_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `penerbits`
--
ALTER TABLE `penerbits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengarangs`
--
ALTER TABLE `pengarangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
