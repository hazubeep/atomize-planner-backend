-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Mar 2026 pada 02.39
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
-- Database: `adhdd`
--

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
-- Struktur dari tabel `micro_steps`
--

CREATE TABLE `micro_steps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `estimated_duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `micro_steps`
--

INSERT INTO `micro_steps` (`id`, `task_id`, `title`, `is_completed`, `estimated_duration`, `created_at`, `updated_at`) VALUES
(4, 7, 'Learning HTML can be broken down into simple steps. Here\'s a step-by-step guide to help you get started:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(5, 7, '**Step 1: Introduction to HTML**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(6, 7, '1. Understand what HTML is: HTML (Hypertext Markup Language) is a standard markup language used to create web pages.', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(7, 7, '2. Learn the basic syntax: HTML uses tags (<> ) to define elements, and attributes to provide additional information.', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(8, 7, '3. Familiarize yourself with HTML versions: HTML has several versions, with HTML5 being the latest.', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(9, 7, '**Step 2: Setting up a coding environment**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(10, 7, '1. Choose a text editor: Select a text editor like Notepad, Sublime Text, or Atom to write your HTML code.', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(11, 7, '2. Create a new file: Create a new file with a .html extension (e.g., index.html).', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(12, 7, '3. Open a web browser: Choose a web browser like Google Chrome, Mozilla Firefox, or Safari to view your HTML pages.', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(13, 7, '**Step 3: Basic HTML elements**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(14, 7, '1. Learn basic tags:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(15, 7, '	* `h1`, `h2`, `h3`, etc. (headings)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(16, 7, '	* `p` (paragraph)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(17, 7, '	* `img` (image)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(18, 7, '	* `a` (anchor/link)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(19, 7, '2. Understand element structure:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(20, 7, '	* Opening tag (`<tag>`)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(21, 7, '	* Content', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(22, 7, '	* Closing tag (`</tag>`)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(23, 7, '**Step 4: HTML structure**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(24, 7, '1. Learn about the basic structure:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(25, 7, '	* `<!DOCTYPE html>` (declaration)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(26, 7, '	* `<html>` (root element)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(27, 7, '	* `<head>` (metadata)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(28, 7, '	* `<body>` (content)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(29, 7, '2. Understand the purpose of each section:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(30, 7, '	* `<head>`: contains metadata (title, CSS, JavaScript links)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(31, 7, '	* `<body>`: contains visible content', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(32, 7, '**Step 5: Creating your first HTML page**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(33, 7, '1. Create a basic HTML page:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(34, 7, '	* `<!DOCTYPE html>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(35, 7, '	* `<html>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(36, 7, '	* `<head>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(37, 7, '	* `<title>My First Page</title>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(38, 7, '	* `</head>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(39, 7, '	* `<body>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(40, 7, '	* `<h1>Hello World!</h1>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(41, 7, '	* `</body>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(42, 7, '	* `</html>`', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(43, 7, '2. Save and open the file in a web browser to see the result.', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(44, 7, '**Step 6: Adding more elements and attributes**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(45, 7, '1. Learn about:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(46, 7, '	* Lists (`ul`, `ol`, `li`)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(47, 7, '	* Tables (`table`, `tr`, `td`)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(48, 7, '	* Forms (`form`, `input`, `label`)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(49, 7, '	* Semantic elements (`header`, `footer`, `nav`, etc.)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(50, 7, '2. Understand how to add attributes:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(51, 7, '	* `id` and `class` attributes', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(52, 7, '	* `style` attribute for inline CSS', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(53, 7, '	* `href` attribute for links', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(54, 7, '**Step 7: Practice and build projects**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(55, 7, '1. Practice building simple web pages using the elements and attributes you\'ve learned.', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(56, 7, '2. Gradually move on to more complex projects, such as:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(57, 7, '	* Building a personal website', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(58, 7, '	* Creating a simple web application', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(59, 7, '	* Making a responsive website using CSS and media queries', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(60, 7, '**Step 8: Learning resources and next steps**', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(61, 7, '1. Find online resources:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(62, 7, '	* W3Schools (w3schools.com)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(63, 7, '	* Mozilla Developer Network (developer.mozilla.org)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(64, 7, '	* Codecademy (codecademy.com)', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(65, 7, '2. Explore related topics:', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(66, 7, '	* CSS (Cascading Style Sheets) for styling', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(67, 7, '	* JavaScript for dynamic functionality', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(68, 7, '	* Responsive web design and mobile-first development', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(69, 7, 'Remember, learning HTML is a continuous process. Start with the basics, practice regularly, and gradually move on to more advanced topics. Good luck!', 0, 10, '2026-03-16 23:18:57', '2026-03-16 23:18:57'),
(70, 8, 'Berikut langkah-langkahnya:', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(71, 8, '1. Belajar dasar tag HTML', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(72, 8, '2. Membuat struktur HTML', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(73, 8, '3. Menambahkan konten', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(74, 8, '4. Menggunakan atribut', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(75, 8, '5. Membuat link dan gambar', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(76, 8, '6. Belajar tentang tabel dan form', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(77, 8, '7. Menerapkan CSS dan JavaScript', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(78, 8, '8. Membuat project HTML sederhana', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(79, 8, '9. Menguji dan memperbaiki kode', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(80, 8, '10. Mengembangkan keterampilan dengan contoh proyek', 0, 10, '2026-03-16 23:24:52', '2026-03-16 23:24:52'),
(81, 9, '1. Mulai dengan dasar HTML', 0, 10, '2026-03-16 23:36:22', '2026-03-16 23:36:22'),
(82, 9, '2. Pelajari tag HTML', 0, 10, '2026-03-16 23:36:23', '2026-03-16 23:36:23'),
(83, 9, '3. Buat struktur halaman web', 0, 10, '2026-03-16 23:36:23', '2026-03-16 23:36:23'),
(84, 9, '4. Tambahkan konten teks dan gambar', 0, 10, '2026-03-16 23:36:23', '2026-03-16 23:36:23'),
(85, 9, '5. Pelajari atribut dan nilai', 0, 10, '2026-03-16 23:36:23', '2026-03-16 23:36:23'),
(86, 9, '6. Buat tautan dan formulir', 0, 10, '2026-03-16 23:36:23', '2026-03-16 23:36:23'),
(87, 9, '7. Pelajari tentang tabel dan daftar', 0, 10, '2026-03-16 23:36:23', '2026-03-16 23:36:23'),
(88, 9, '8. Praktik membuat halaman web sederhana', 0, 10, '2026-03-16 23:36:23', '2026-03-16 23:36:23');

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
(4, '2026_03_14_084540_create_personal_access_tokens_table', 1),
(5, '2026_03_14_085020_create_tasks_table', 2),
(6, '2026_03_14_085021_create_micro_steps_table', 2);

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
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'api', '2d31b378527ca52bb6ba1b2add004e2a373776ec664d00b0b6419a3d56919478', '[\"*\"]', NULL, NULL, '2026-03-14 02:25:21', '2026-03-14 02:25:21'),
(2, 'App\\Models\\User', 1, 'api', '3b5273c176f6504cdadd3ba966cefcddba75c96379b5c099b8e2e8754b6d29a4', '[\"*\"]', NULL, NULL, '2026-03-14 02:27:21', '2026-03-14 02:27:21'),
(3, 'App\\Models\\User', 1, 'api', 'c95cd08edcd0b7705275e7990aaf0e8979ba98f6227aa28e37eb2989a1495832', '[\"*\"]', '2026-03-16 23:36:20', NULL, '2026-03-14 02:36:50', '2026-03-16 23:36:20');

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
('nCfXsCYDrKv4wEfN86SIGHgPcfJkKyhBXABICvmI', NULL, '127.0.0.1', 'PostmanRuntime/7.52.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFhYMUlCeDRjWUtpcGR2TWlzVmtiZ2RtQXZiRjJTUU1abnVyRlc4cSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1773480211),
('x4pDpTCoVSwvvQFx3HwquS1ETWOdPLg2IGR2zHny', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVB1UmQyRjJnSU1aMmNKTnpzVjJIMVVFcjdmS0VkZ3g3SjE2YjRlSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1773479264);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `progress_percentage` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `progress_percentage`, `created_at`, `updated_at`) VALUES
(2, 1, 'learn html', 0, '2026-03-14 03:37:55', '2026-03-14 03:37:55'),
(3, 1, 'learn html', 0, '2026-03-14 03:40:32', '2026-03-14 03:40:32'),
(4, 1, 'learn html', 0, '2026-03-16 23:09:39', '2026-03-16 23:09:39'),
(5, 1, 'learn html', 0, '2026-03-16 23:15:41', '2026-03-16 23:15:41'),
(6, 1, 'learn html', 0, '2026-03-16 23:17:32', '2026-03-16 23:17:32'),
(7, 1, 'learn html', 0, '2026-03-16 23:18:53', '2026-03-16 23:18:53'),
(8, 1, 'learn html', 0, '2026-03-16 23:24:50', '2026-03-16 23:24:50'),
(9, 1, 'learn html', 0, '2026-03-16 23:36:21', '2026-03-16 23:36:21');

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
(1, 'enzo', 'enzo@gmail.com', NULL, '$2y$12$HOfGadb35kby.Z9H2UJ8Tu7uC3XotkUwE49qlbmN5IIZvkU8fZmoK', NULL, '2026-03-14 02:25:21', '2026-03-14 02:25:21');

--
-- Indexes for dumped tables
--

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
-- Indeks untuk tabel `micro_steps`
--
ALTER TABLE `micro_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `micro_steps_task_id_foreign` (`task_id`);

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
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT untuk tabel `micro_steps`
--
ALTER TABLE `micro_steps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `micro_steps`
--
ALTER TABLE `micro_steps`
  ADD CONSTRAINT `micro_steps_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
