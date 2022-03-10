-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Agu 2021 pada 06.08
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assessment`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, 'Kedisiplinan Kerja', '2021-08-01 20:39:50', '2021-08-01 20:39:50'),
(6, 'Komitmen Terhadap Kewajiban', '2021-08-01 20:40:12', '2021-08-01 20:40:12'),
(7, 'Kepatuhan Terhadap Larangan', '2021-08-01 20:40:34', '2021-08-01 20:40:34'),
(8, 'Produktifitas', '2021-08-01 20:40:53', '2021-08-01 21:16:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_details`
--

CREATE TABLE `category_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category_details`
--

INSERT INTO `category_details` (`id`, `category_id`, `name`, `quality`, `created_at`, `updated_at`) VALUES
(5, 5, 'Jumlah hari masuk kantor yang dibuktikan dengan absen datang dan absen pulang', 4, '2021-08-02 01:04:09', '2021-08-02 01:33:05'),
(6, 5, 'Jumlah hari penugasan dinas yang dibuktikan dengan Surat Perintah Perjalanan Dinas', 4, '2021-08-02 01:04:35', '2021-08-02 01:34:08'),
(7, 5, 'Jumlah hari Ganti Libur sebagai kompensasi lembur yang dibuktikan dengan Surat Perintah Kerja Lembur', 4, '2021-08-02 01:04:57', '2021-08-02 01:34:23'),
(8, 5, 'Jumlah hari penugasan lembur pada hari libur yang dibuktikan dengan surat Perintah Kerja Lembur', 4, '2021-08-02 01:05:17', '2021-08-02 01:34:34'),
(9, 5, 'Ketidakhadiran karena musibah tanpa keterangan tertulis', -2, '2021-08-02 01:05:51', '2021-08-02 01:05:51'),
(10, 5, 'Ketidakhadiran bukan karena musibah tanpa ijin tertulis', -5, '2021-08-02 01:06:08', '2021-08-02 01:06:08'),
(11, 5, 'Terlambat masuk kerja lebih dari 30 menit', -2, '2021-08-02 01:06:28', '2021-08-02 01:06:28'),
(12, 5, 'Pulang kerja tanpa ijin sebelum jam pulang', -2, '2021-08-02 01:06:43', '2021-08-02 01:06:43'),
(13, 5, 'Keluar kantor tanpa ijin lebih dari 2 (dua) jam', -2, '2021-08-02 01:07:04', '2021-08-02 01:07:04'),
(15, 5, 'Jumlah hari kerja dalam satu bulan', 100, '2021-08-02 01:33:43', '2021-08-02 01:46:42'),
(17, 6, 'Mengangkat, mentaati dan melaksanakan sumpah / janji pegawai dan atau sumpah / janji jabatan berdasarkan ketentuan Perusahaan dan Perundang-undangan yang berlaku', 10, '2021-08-02 01:47:48', '2021-08-02 01:47:48'),
(18, 6, 'Menyimpan Rahasia Perusahaan dan atau Rahasia Jabatan dengan sebaik-baiknya', 10, '2021-08-02 01:48:09', '2021-08-02 01:48:09'),
(19, 6, 'Melaksanakan dan mentaati segala ketentuan Perundang-undangan dan Peraturan Perusahaan yang berlaku', 10, '2021-08-02 01:48:34', '2021-08-02 01:48:34'),
(20, 6, 'Melaksanakan Pedoman Etika Bisnis dan Tata Perilaku (Code of Conduct) Perusahaan', 10, '2021-08-02 01:48:51', '2021-08-02 01:48:51'),
(21, 6, 'Melaporkan dengan segera kepada atasan dan atau langsung kepada Direksi  Perusahaan apabila mengetahui ada hal yang membahayakan keamanan dan merugikan Perusahaan', 10, '2021-08-02 01:49:17', '2021-08-02 01:50:34'),
(22, 6, 'Bersikap, bertingkah laku, bertindak, dan bekerja dengan jujur, tertib, cermat, sesuai norma dan peraturan kepegawaian yang diatur Perusahaan maupun norma hidup masyarakat lingkungan Perusahaan', 10, '2021-08-02 01:49:39', '2021-08-02 01:49:39'),
(23, 6, 'Melaksanakan tugas kedinasan dengan sebaik-baiknya dengan penuh pengabdian dan kesadaran serta tanggung jawab', 10, '2021-08-02 01:49:57', '2021-08-02 01:49:57'),
(24, 6, 'Memberikan pelayanan sebaik-baiknya kepada para client perusahaan sesuai dengan bidang tugas masing-masing', 10, '2021-08-02 01:50:11', '2021-08-02 02:46:58'),
(25, 6, 'Saling bekerjasama dengan pegawai lainnya untuk pekerjaan yang penyelesaiannya harus diselesaikan bersama', 10, '2021-08-02 01:50:26', '2021-08-02 02:47:11'),
(26, 6, 'Mendukung aktif penggunaan produk perusahaan baik untuk diri pegawai maupun untuk client perusahaan', 10, '2021-08-02 01:50:59', '2021-08-02 01:50:59'),
(27, 7, 'Menyalahgunakan dan atau mengalihkan password kepada siapapun juga baik kepada Pengurus, atasannya, sesama pegawai atau pihak lain yang terafiliasi maupun tidak terafiliasi', 10, '2021-08-02 01:52:13', '2021-08-02 02:48:38'),
(29, 7, 'Melakukan perbuatan pidana korupsi atau tindakan lain yang mengurangi, mengganti, dan atau merusak asset Perusahaan', 10, '2021-08-02 02:49:07', '2021-08-02 02:49:07'),
(30, 7, 'Menerima hadiah atau sesuatu pemberian berupa apa saja dan dari siapapun juga yang diketahui atau patut dapat diduga bahwa pemberian itu bersangkutan atau mungkin bersangkutan dengan jabatan atau pekerjaan Pegawai yang bersangkutan, tanpa diketahui oleh Pengurus', 10, '2021-08-02 02:51:08', '2021-08-02 02:51:08'),
(31, 7, 'Melakukan pekerjaan diluar tanggungjawab dan kewenangannya tanpa seizin atasan', 10, '2021-08-02 02:51:38', '2021-08-02 02:51:38'),
(32, 7, 'Merusak asset Perusahaan secara sengaja dan memanfaatkannnya bukan untuk kepentingan pelaksanaan tugas Perusahaan', 10, '2021-08-02 02:51:56', '2021-08-02 02:51:56'),
(33, 7, 'Melakukan hal-hal yang dapat menurunkan kehormatan dan martabat Perusahaan di hadapan lingkungan bisnisnya maupun publik secara luas', 10, '2021-08-02 02:52:12', '2021-08-02 02:52:12'),
(34, 7, 'Melakukan tindakan tercela di dalam maupun di luar lingkungan kerjanya', 10, '2021-08-02 02:52:30', '2021-08-02 02:52:30'),
(35, 7, 'Menjadi pegawai atau bekerja untuk Perusahaan lain atau instansi lain tanpa seizin Pengurus', 10, '2021-08-02 02:52:49', '2021-08-02 02:52:49'),
(36, 7, 'Melakukan tindakan langsung maupun tidak langsung yang merugikan Perusahaan', 10, '2021-08-02 02:53:04', '2021-08-02 02:53:04'),
(37, 7, 'Menyalahgunakan wewenang dan jabatan serta asset Perusahaan untuk keuntungan diri sendiri atau orang lain', 10, '2021-08-02 02:53:19', '2021-08-02 02:53:19'),
(38, 5, 'Melakukan tindakan negatif dengan maksud balas dendam terhadap Pengurus, atasannya, sesama pegawai ataupun orang lain di dalam maupun di luar lingkungan kerjanya', 10, '2021-08-02 02:53:34', '2021-08-02 02:53:34'),
(39, 7, 'Memberi atau menyanggupi akan memberikan sesuai kepada siapapun juga secara langsung atau tidak langsung dengan dalih apapun untuk kepentingan pribadi dan yang berdampak merugikan Perusahaan', 10, '2021-08-02 02:54:02', '2021-08-02 02:54:02'),
(40, 7, 'Memberikan informasi dalam bentuk tertulis, lesan atau digital tentang rahasia Perusahaan', 10, '2021-08-02 02:54:16', '2021-08-02 02:54:16'),
(41, 7, 'Melibatkan istri / suami / anak atau siapapun juga untuk menyelesaikan tugas pekerjaan Perusahaan', 10, '2021-08-02 02:54:40', '2021-08-02 02:54:50'),
(42, 7, 'Sewenang-wenang serta melakukan tindakan dan ucapan yang menganiaya, atau mengancam Pengurus, atasannya, sesama pegawai dan pihak yang teraflasi dengan Perusahaan', 10, '2021-08-02 02:55:13', '2021-08-02 02:55:13'),
(43, 7, 'Terlibat dalam kegiatan politik praktis dalam bentuk menjadi pengurus partai politik serendah-rendahnya di tingkat kabupaten atau kota atau mencalonkan diri menjadi Kepada Desa, Anggota Legislatif, Kepada Daerah dan atau Presiden / Wakil Presiden', 10, '2021-08-02 02:55:30', '2021-08-02 02:55:30'),
(44, 7, 'Menyuruh melakukan, turut melakukan atau membujuk pegawai lain untuk melakukan pelanggaran disiplin pegawai', 10, '2021-08-02 02:55:44', '2021-08-02 02:55:44'),
(45, 7, 'Tidak melakukan tindakan pencegahan atau melakukan pembiaran atas terjadinya pelanggaran disiplin pegawai', 10, '2021-08-02 02:55:59', '2021-08-02 02:55:59'),
(46, 7, 'Memperbanyak, mengedarkan, mempertontonkan, menempelkan, menawarkan, menyimpan atau memiliki tulisan, rekaman, gambar dengan segala bentuk dan sifatnya yang berisi : Anjuran atau hasutan untuk tidak mentaati kewajiban dan atau melanggar larangan', 10, '2021-08-02 02:56:14', '2021-08-02 02:56:14'),
(47, 7, 'Memperbanyak, mengedarkan, mempertontonkan, menempelkan, menawarkan, menyimpan atau memiliki tulisan, rekaman, gambar dengan segala bentuk dan sifatnya yang berisi Kebencian, fitnah, atau bentuk lain yang dipersamakan dengan itu, yang berkaitan dengan suku, agama, ras dan antar golongan', 10, '2021-08-02 02:56:34', '2021-08-02 02:56:34'),
(48, 8, 'Pelaporan Bulanan', 100, '2021-08-02 02:57:02', '2021-08-02 02:57:02'),
(49, 8, 'Kontribusi terhadap efisiensi kerja', 50, '2021-08-02 02:57:18', '2021-08-02 02:57:18'),
(50, 8, 'Kontribusi terhadap kualitas pelayanan / produk', 50, '2021-08-02 02:57:33', '2021-08-02 02:57:33'),
(51, 8, 'Kontribusi terhadap efisiensi kerja', 100, '2021-08-02 02:57:55', '2021-08-02 02:57:55'),
(52, 8, 'Kontribusi terhadap kualitas pelayanan / produk', 200, '2021-08-11 21:51:06', '2021-08-11 21:51:06'),
(53, 8, 'Tugas pribadi dari Kepala Divisi', 50, '2021-08-11 21:51:37', '2021-08-11 21:51:37'),
(54, 8, 'Tugas pribadi dari Direksi', 50, '2021-08-11 21:51:59', '2021-08-11 21:51:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Umum/Keuangan', '2021-08-08 19:15:13', '2021-08-08 19:36:25'),
(2, 'Digital Banking', '2021-08-08 19:15:56', '2021-08-08 19:36:36'),
(3, 'Support', '2021-08-08 19:16:20', '2021-08-08 19:16:20'),
(4, 'Core Banking', '2021-08-08 19:16:34', '2021-08-08 19:16:34'),
(6, 'Non Regular', '2021-08-08 19:42:05', '2021-08-08 19:42:05'),
(8, 'All Division', '2021-08-12 01:53:03', '2021-08-12 01:53:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('head of division','staff') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_date` date NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2021_07_29_035921_create_sessions_table', 1),
(11, '2021_07_29_094623_create_categories_table', 1),
(13, '2021_08_02_043855_create_category_details_table', 1),
(14, '2021_08_09_015656_create_divisions_table', 1),
(18, '2021_08_09_032839_create_employees_table', 1),
(20, '2021_08_12_042213_add_status_to_employeess_table', 1),
(23, '2014_10_12_000000_create_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('itdTlzuCUSFyYUxgnwbpVbQy3ovYV0BF8QGP8W9T', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36', 'YTo3OntzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ikc4eTNqZ3ZpcEtqOURSbmJrd29rckQ2Z3BUWHJEVDJyNU9CekF6RXEiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ3QkFYeENmMTdHdU5iV0Y3dS9YMTFPaXYuZERZYjMzSG96TEhVeGlkSGdmL3FRcFdFWkp3RyI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkN0JBWHhDZjE3R3VOYldGN3UvWDExT2l2LmREWWIzM0hvekxIVXhpZEhnZi9xUXBXRVpKd0ciO30=', 1628827610);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('director','head of division','staff') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `division_id`, `id_number`, `gender`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Site Administrator', 'admin@performance-assessment.test', NULL, '$2y$10$7BAXxCf17GuNbWF7u/X11Oiv.dDYb33HozLHUxidHgf/qQpWEZJwG', NULL, NULL, '20210813021603.png', 8, '-', 'male', 'director', 'active', '2021-08-12 01:33:28', '2021-08-12 19:22:12'),
(5, 'Adam Amirudin', 'adam@mail.test', NULL, '$2y$10$O5n2EFfN1cbn8nbGF5faE./N/HloU3IFjFoK1cHBOPjhcodiLbR8C', NULL, NULL, '20210813024037.png', 2, '01.10.00001', 'male', 'head of division', 'active', '2021-08-12 19:40:37', '2021-08-12 19:40:37'),
(6, 'Arief Riyanto', 'arif@mail.test', NULL, '$2y$10$ceNlQW8vsmBkmk0SjD8wmeo2u3QF2JdSvknYhd4bQpl/C.r94hpgO', NULL, NULL, '20210813024117.png', 2, '01.10.00076', 'male', 'staff', 'active', '2021-08-12 19:41:18', '2021-08-12 19:41:18'),
(7, 'Susi Susanti', 'susi@gmail.com', NULL, '$2y$10$r4xbo3lYwlNrcYDUdamsu.S9m1Z53Lo8yAs4n.zZ6a2m.zjmVgSH6', NULL, NULL, '20210813024455.jpg', 3, '01.10.00074', 'female', 'staff', 'active', '2021-08-12 19:44:55', '2021-08-12 19:44:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_details_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_division_id_foreign` (`division_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `category_details`
--
ALTER TABLE `category_details`
  ADD CONSTRAINT `category_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
