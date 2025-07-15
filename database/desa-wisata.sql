-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2025 pada 15.59
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
-- Database: `desa-wisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `batiks`
--

CREATE TABLE `batiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `batiks`
--

INSERT INTO `batiks` (`id`, `nama`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Pesan', 'Tidak Pesan', 0, NULL, NULL),
(2, 'Paket Batik Satu', 'Gantungan Kunci', 20000, NULL, NULL),
(3, 'Paket Batik Dua', 'Centong, Solet', 30000, NULL, NULL),
(4, 'Paket Batik Tiga', 'Topeng S, Wayang Mini, Tempat Pensil, Telenan', 40000, NULL, NULL),
(5, 'Paket Batik Empat', 'Topeng M, Box Tissue, Wayang S', 60000, NULL, NULL),
(6, 'Paket Batik Lima', 'Topeng L, Wayang M, Nampan S', 75000, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `organisasi` varchar(255) NOT NULL,
  `noTelpPIC` varchar(255) NOT NULL,
  `visitor` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `tagihan` int(11) NOT NULL,
  `guide_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `cocok_tanams`
--

CREATE TABLE `cocok_tanams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cocok_tanams`
--

INSERT INTO `cocok_tanams` (`id`, `nama`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Pesan', 'Tidak Pesan', 0, NULL, NULL),
(2, 'Pohon', 'Bibit dan alat dan bahan tanaman, Pendamping (Petani), Tanaman menjadi milik/hak pemilik lahan', 30000, NULL, NULL),
(3, 'Sayuran', 'Bibit dan alat dan bahan tanaman, Pendamping (Petani), Tanaman menjadi milik/hak pemilik lahan', 30000, NULL, NULL),
(4, 'Biji-bijian', 'Bibit dan alat dan bahan tanaman, Pendamping (Petani), Tanaman menjadi milik/hak pemilik lahan', 30000, NULL, NULL);

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
-- Struktur dari tabel `guides`
--

CREATE TABLE `guides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guides`
--

INSERT INTO `guides` (`id`, `name`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Guide Satu', '08123456789', NULL, NULL),
(2, 'Guide Dua', '08987654321', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `homestays`
--

CREATE TABLE `homestays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `homestays`
--

INSERT INTO `homestays` (`id`, `nama`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Pesan', 'Tidak Pesan', 0, NULL, NULL),
(2, 'Homestay', '1 kamar untuk 2 orang', 200000, NULL, NULL);

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
-- Struktur dari tabel `kesenians`
--

CREATE TABLE `kesenians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga_belajar` int(11) NOT NULL,
  `harga_pementasan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kesenians`
--

INSERT INTO `kesenians` (`id`, `nama`, `deskripsi`, `harga_belajar`, `harga_pementasan`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Pesan', 'Tidak Pesan', 0, 0, NULL, NULL),
(2, 'Tari', 'Deskripsi Tari', 40000, 150000, NULL, NULL),
(3, 'Kethoprak', 'Deskripsi Kethoprak', 40000, 150000, NULL, NULL),
(4, 'Jathilan', 'Deskripsi Jathilan', 40000, 150000, NULL, NULL),
(5, 'Karawitan', 'Deskripsi Karawitan', 40000, 150000, NULL, NULL),
(6, 'Gendring', 'Deskripsi Gendring', 40000, 150000, NULL, NULL),
(7, 'Macapat', 'Deskripsi Macapat', 40000, 150000, NULL, NULL),
(8, 'Hadroh', 'Deskripsi Hadroh', 40000, 150000, NULL, NULL),
(9, 'Sholawatan', 'Deskripsi Sholawatan', 40000, 150000, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuliners`
--

CREATE TABLE `kuliners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kuliners`
--

INSERT INTO `kuliners` (`id`, `nama`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Pesan', 'Tidak Pesan', 0, NULL, NULL),
(2, 'Paket Nasi Box I', 'Nasi Putih, Telur Semur, Oseng-oseng, Kerupuk, Buah, Air Minum Kemasan', 12000, NULL, NULL),
(3, 'Paket Nasi Box II', 'Nasi Putih, Ayam Suwir, Oseng-oseng, Kerupuk, Buah, Air Minum Kemasan', 15000, NULL, NULL),
(4, 'Paket Dhaharan I', 'Nasi Putih, Bobor Kelor, Sambel Jenggot, Tahu/Tempe Goreng, Kerupuk, Buah, Air Minum Kemasan/Teh', 20000, NULL, NULL),
(5, 'Paket Dhaharan II', 'Nasi Putih, Tetelan, Sayur Brongkos, Mie Lethek Goreng, Kerupuk, Buah, Air Minum Kemasan/Teh', 25000, NULL, NULL),
(6, 'Paket Dhaharan III', 'Nasi Putih, Ayam Goreng, Sup, Tahu/Tempe Goreng, Sambal, Kerupuk, Buah, Air Minum Kemasan/Teh', 30000, NULL, NULL),
(7, 'Paket Dhaharan IV', 'Nasi Putih, Ikan Filet Asam Manis, 1/2 Telur Semur, Sup Jagung Muda, Sambal, Kerupuk, Buah, Air Minum Kemasan/Teh', 40000, NULL, NULL),
(8, 'Paket Dhaharan V', 'Nasi Putih, Gudeng Manggar, Ayam Suwir, Oseng-oseng, Trancam, Buah, Air Mineral', 50000, NULL, NULL);

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
(4, '2024_06_14_033430_desa-wisata-krebet', 1),
(5, '2024_06_14_143826_create_admins_table', 1),
(6, '2024_07_03_213303_create_batiks_table', 1),
(7, '2024_07_03_213304_create_kesenians_table', 1),
(8, '2024_07_03_213305_create_cocok_tanams_table', 1),
(9, '2024_07_03_213306_create_kuliners_table', 1),
(10, '2024_07_03_213306_create_permainans_table', 1),
(11, '2024_07_03_213308_create_guides_table', 1),
(12, '2024_07_03_213309_create_study_bandings_table', 1),
(13, '2024_07_03_213310_create_homestays_table', 1),
(14, '2024_07_03_213311_create_pakets_table', 1),
(15, '2024_07_03_213312_create_bookings_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakets`
--

CREATE TABLE `pakets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batik_id` bigint(20) UNSIGNED NOT NULL,
  `kesenian_id` bigint(20) UNSIGNED NOT NULL,
  `ketKesenian` varchar(255) DEFAULT NULL,
  `study_banding_id` bigint(20) UNSIGNED NOT NULL,
  `cocok_tanam_id` bigint(20) UNSIGNED NOT NULL,
  `permainan_id` bigint(20) UNSIGNED NOT NULL,
  `homestay_id` bigint(20) UNSIGNED NOT NULL,
  `kuliner_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `permainans`
--

CREATE TABLE `permainans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permainans`
--

INSERT INTO `permainans` (`id`, `nama`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Pesan', 'Tidak Pesan', 0, NULL, NULL),
(2, 'Cublak2 Suweng', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(3, 'Gobaksodor', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(4, 'Jek-jekan', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(5, 'Mul-mulan', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(6, 'Bas-basan', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(7, 'Jongjling', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(8, 'Benthik', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(9, 'Dakom', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(10, 'Yoyo', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(11, 'Yeye', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL),
(12, 'Gatheng', 'Area Permainan, Alat/Bahan Permainan, Air Minum Kemasan', 12500, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `study_bandings`
--

CREATE TABLE `study_bandings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `study_bandings`
--

INSERT INTO `study_bandings` (`id`, `nama`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Pesan', 'Tidak Pesan', 0, NULL, NULL),
(2, 'Paket Study Banding', 'Materi Desa Wisata Krebet, Diskusi dan tanya jawab, Melihat Proses produksi dan kerajinan, Membatik Batik Paket III', 75000, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2025-06-11 06:59:20', '$2y$12$17Wad03dPk3tXZEAe0MGCOuA6h5AyySGJ9xcbfcBr/0z5dj7U30Di', 'kzHO7rMsa9', '2025-06-11 06:59:20', '2025-06-11 06:59:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `batiks`
--
ALTER TABLE `batiks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_paket_id_foreign` (`paket_id`),
  ADD KEY `bookings_guide_id_foreign` (`guide_id`);

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
-- Indeks untuk tabel `cocok_tanams`
--
ALTER TABLE `cocok_tanams`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `homestays`
--
ALTER TABLE `homestays`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `kesenians`
--
ALTER TABLE `kesenians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuliners`
--
ALTER TABLE `kuliners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pakets_batik_id_foreign` (`batik_id`),
  ADD KEY `pakets_kesenian_id_foreign` (`kesenian_id`),
  ADD KEY `pakets_study_banding_id_foreign` (`study_banding_id`),
  ADD KEY `pakets_cocok_tanam_id_foreign` (`cocok_tanam_id`),
  ADD KEY `pakets_permainan_id_foreign` (`permainan_id`),
  ADD KEY `pakets_homestay_id_foreign` (`homestay_id`),
  ADD KEY `pakets_kuliner_id_foreign` (`kuliner_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permainans`
--
ALTER TABLE `permainans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `study_bandings`
--
ALTER TABLE `study_bandings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `batiks`
--
ALTER TABLE `batiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cocok_tanams`
--
ALTER TABLE `cocok_tanams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guides`
--
ALTER TABLE `guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `homestays`
--
ALTER TABLE `homestays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kesenians`
--
ALTER TABLE `kesenians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kuliners`
--
ALTER TABLE `kuliners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permainans`
--
ALTER TABLE `permainans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `study_bandings`
--
ALTER TABLE `study_bandings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_guide_id_foreign` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`id`),
  ADD CONSTRAINT `bookings_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`);

--
-- Ketidakleluasaan untuk tabel `pakets`
--
ALTER TABLE `pakets`
  ADD CONSTRAINT `pakets_batik_id_foreign` FOREIGN KEY (`batik_id`) REFERENCES `batiks` (`id`),
  ADD CONSTRAINT `pakets_cocok_tanam_id_foreign` FOREIGN KEY (`cocok_tanam_id`) REFERENCES `cocok_tanams` (`id`),
  ADD CONSTRAINT `pakets_homestay_id_foreign` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`),
  ADD CONSTRAINT `pakets_kesenian_id_foreign` FOREIGN KEY (`kesenian_id`) REFERENCES `kesenians` (`id`),
  ADD CONSTRAINT `pakets_kuliner_id_foreign` FOREIGN KEY (`kuliner_id`) REFERENCES `kuliners` (`id`),
  ADD CONSTRAINT `pakets_permainan_id_foreign` FOREIGN KEY (`permainan_id`) REFERENCES `permainans` (`id`),
  ADD CONSTRAINT `pakets_study_banding_id_foreign` FOREIGN KEY (`study_banding_id`) REFERENCES `study_bandings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
