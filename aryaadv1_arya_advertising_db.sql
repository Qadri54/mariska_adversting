-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Jun 2026 pada 20.29
-- Versi server: 10.6.27-MariaDB
-- Versi PHP: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aryaadv1_arya_advertising_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`customer_id`, `email`, `avatar`, `password`, `nama_lengkap`, `phone_number`, `created_at`, `updated_at`, `remember_token`) VALUES
(10, 'gadaimas@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'GADAI MAS', NULL, '2026-01-01 01:00:00', '2026-01-01 01:00:00', NULL),
(11, 'umum@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'UMUM (Guest)', NULL, '2026-01-01 01:00:00', '2026-01-01 01:00:00', NULL),
(12, 'paragon@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'PARAGON', NULL, '2026-01-01 01:00:00', '2026-01-01 01:00:00', NULL),
(13, 'djarum@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'DJARUM', NULL, '2026-01-01 01:00:00', '2026-01-01 01:00:00', NULL),
(14, 'ikmas@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'IKMAS', NULL, '2026-01-01 01:00:00', '2026-01-01 01:00:00', NULL),
(15, 'indofood@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'INDOFOOD', NULL, '2026-05-01 01:00:00', '2026-05-01 01:00:00', NULL),
(16, 'assi@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'ASSI', NULL, '2026-05-01 01:00:00', '2026-05-01 01:00:00', NULL),
(17, 'adv@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'ADV', NULL, '2026-05-01 01:00:00', '2026-05-01 01:00:00', NULL),
(20, 'kormi@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'KORMI', NULL, '2026-01-12 01:00:00', '2026-01-12 01:00:00', NULL),
(21, 'varcos@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'VARCOS', NULL, '2026-01-20 01:00:00', '2026-01-20 01:00:00', NULL),
(22, 'pocari@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'POCARI', NULL, '2026-02-01 01:00:00', '2026-02-01 01:00:00', NULL),
(23, 'arya@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'ARYA', NULL, '2026-02-01 01:00:00', '2026-02-01 01:00:00', NULL),
(24, 'keind@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'KEIND', NULL, '2026-02-01 01:00:00', '2026-02-01 01:00:00', NULL),
(25, 'jhsf@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'JHSF', NULL, '2026-02-01 01:00:00', '2026-02-01 01:00:00', NULL),
(26, 'suntone@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'SUNTONE', NULL, '2026-02-01 01:00:00', '2026-02-01 01:00:00', NULL),
(27, 'als@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'ALS', NULL, '2026-02-01 01:00:00', '2026-02-01 01:00:00', NULL),
(28, 'sulthon@example.com', NULL, '$2y$10$6KEA.XnMhTS1bi22pyVHiOkIZL6e2cEW6w9iuPYzgUYEZVLY0pYwm', 'SULTHON', NULL, '2026-02-01 01:00:00', '2026-02-01 01:00:00', NULL),
(29, 'mariskasiagian7@gmail.com', '1782335068_passfoto.png', '$2y$10$xCJKM.uAgCCphxB9d3IVpeqpbletE/iz4CEQl4v12C0xzpwAPlIXK', 'Mariska Siagian', '082180532600', '2026-06-24 14:03:30', '2026-06-24 14:04:28', 'JDiwjPrv3rqgiv30roQQBXNWY6jvhG3qyqbFjtoAlyisQVD2lKUggve0LAXJ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `service_id`, `title`, `image_url`, `description`, `created_at`, `updated_at`) VALUES
(4, 2, 'BOOTH MAKEOVER SUMUT FASHION WEEK', 'gallery/booth-makeover-sumut-fashion-week-1766317026.jpg', NULL, '2025-12-21 04:37:06', '2025-12-21 04:37:06'),
(5, 3, 'BOOTH KAFH ACEH', 'gallery/booth-kafh-aceh-1766317130.jpg', NULL, '2025-12-21 04:38:50', '2025-12-21 04:38:50'),
(6, 2, 'Pemasangan Booth The White Cooffe', 'gallery/pemasangan-booth-the-white-cooffe-1766317190.jpg', NULL, '2025-12-21 04:39:50', '2025-12-21 04:39:50'),
(7, 3, 'BOOTH WARDAH KAJIAN HANAN ATAKI', 'gallery/booth-wardah-kajian-hanan-ataki-1766317302.jpg', NULL, '2025-12-21 04:41:42', '2025-12-21 04:41:42'),
(8, 2, 'BOOTH KAFH CERIA KOSMETIK', 'gallery/booth-kafh-ceria-kosmetik-1766317343.jpg', NULL, '2025-12-21 04:42:23', '2025-12-21 04:42:23'),
(9, 2, 'Pemasangan Booth Di Sun Plaza', 'gallery/pemasangan-booth-di-sun-plaza-1766317426.jpg', NULL, '2025-12-21 04:43:46', '2025-12-21 04:43:46'),
(10, 2, 'BOOTH OMG RANTAU PARAPAT', 'gallery/booth-omg-rantau-parapat-1766317513.jpg', NULL, '2025-12-21 04:45:13', '2025-12-21 04:45:13'),
(11, 2, 'BOOTH PARAGON DI PKKMB USU', 'gallery/booth-paragon-di-pkkmb-usu-1766317575.jpg', NULL, '2025-12-21 04:46:15', '2025-12-21 04:46:15'),
(12, 2, 'BOOTH EMINA', 'gallery/booth-emina-1766317650.jpg', NULL, '2025-12-21 04:47:30', '2025-12-21 04:47:30'),
(13, 2, 'BACKWALL OMG KIM KOSMETIK', 'gallery/backwall-omg-kim-kosmetik-1766317817.jpg', NULL, '2025-12-21 04:50:17', '2025-12-21 04:50:17'),
(14, 2, 'BACKWALL SKINTIFIC BRASTAGI', 'gallery/backwall-skintific-brastagi-1766317863.jpg', NULL, '2025-12-21 04:51:03', '2025-12-21 04:51:03'),
(15, 2, 'BALIHO PANCA BUDI', 'gallery/baliho-panca-budi-1766317918.jpg', NULL, '2025-12-21 04:51:58', '2025-12-21 04:51:58'),
(16, 2, 'BOBOCABIN', 'gallery/bobocabin-1766318248.JPG', NULL, '2025-12-21 04:57:28', '2025-12-21 04:57:28'),
(17, 2, 'BRANDING PERCEFT 10, Header Rak', 'gallery/branding-perceft-10-header-rak-1766318358.jpg', NULL, '2025-12-21 04:59:18', '2025-12-21 04:59:18'),
(18, 2, 'NEON BOX OUTDOOR', 'gallery/neon-box-outdoor-1766318451.jpg', NULL, '2025-12-21 05:00:51', '2025-12-21 05:00:51'),
(19, 2, 'LETTER TIMBUL MIE KARI DELI PARK', 'gallery/letter-timbul-mie-kari-deli-park-1766318721.jpg', NULL, '2025-12-21 05:05:21', '2025-12-21 05:05:21'),
(20, 2, 'LETTER TIMBUL USU', 'gallery/letter-timbul-usu-1766318745.JPG', NULL, '2025-12-21 05:05:45', '2025-12-21 05:05:45'),
(21, 2, 'NEON BOX TOKO ACUN', 'gallery/neon-box-toko-acun-1766318846.jpg', NULL, '2025-12-21 05:07:26', '2025-12-21 05:07:26'),
(22, 2, 'PNT DJARUM', 'gallery/pnt-djarum-1766318918.jpg', NULL, '2025-12-21 05:08:38', '2025-12-21 05:08:38'),
(23, 2, 'LANDMARK FT USU', 'gallery/landmark-ft-usu-1766318971.jpg', NULL, '2025-12-21 05:09:31', '2025-12-21 05:09:31'),
(24, 2, 'SPANDUK DJARUM', 'gallery/spanduk-djarum-1766319143.jpg', NULL, '2025-12-21 05:12:23', '2025-12-21 05:12:23'),
(25, 2, 'VERTICAL BANNER', 'gallery/vertical-banner-1766319226.jpg', NULL, '2025-12-21 05:13:46', '2025-12-21 05:13:46'),
(26, 2, 'VITRIN WARDAH DAN EMINA', 'gallery/vitrin-wardah-dan-emina-1766319280.jpg', NULL, '2025-12-21 05:14:40', '2025-12-21 05:14:40');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_11_12_023028_create_users_table', 1),
(3, '2025_11_12_023148_create_customers_table', 1),
(4, '2025_11_12_023241_create_services_table', 1),
(5, '2025_11_12_023327_create_gallery_table', 1),
(6, '2025_11_12_023432_create_partners_table', 1),
(7, '2025_11_12_023521_create_sph_headers_table', 1),
(8, '2025_11_12_023629_create_sph_details_table', 1),
(9, '2025_11_12_023726_create_products_table', 1),
(10, '2025_11_12_023820_create_orders_table', 1),
(11, '2025_11_12_023920_create_order_items_table', 1),
(12, '2025_11_20_132745_add_image_to_sph_headers_table', 1),
(13, '2025_11_20_140400_add_design_image_to_sph_headers', 1),
(14, '2025_11_24_094308_create_customer_secrets_table', 1),
(15, '2025_11_25_073711_add_shipping_info_to_orders_table', 1),
(16, '2025_12_03_043727_add_description_to_products_table', 1),
(17, '2025_12_03_053132_add_profit_margin_to_products_table', 1),
(18, '2025_12_03_061004_add_new_fields_to_products_table', 1),
(19, '2025_12_03_125534_add_missing_fields_to_order_items_table', 1),
(20, '2025_12_03_130312_add_order_number_to_orders_table', 1),
(21, '2025_12_04_015035_add_missing_statuses_to_orders_enum', 2),
(22, '2026_06_24_182938_add_remember_token_to_customers_table', 3),
(23, '2026_06_24_184851_add_avatar_to_customers_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(15,2) NOT NULL,
  `payment_proof_url` varchar(500) DEFAULT NULL,
  `status` enum('Pending','Awaiting Approval','Verified','Processing','Ready_for_pickup','Completed','Rejected','Cancelled') NOT NULL DEFAULT 'Pending',
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_method` varchar(255) NOT NULL DEFAULT 'pickup',
  `shipping_address` text DEFAULT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `receiver_phone` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `customer_id`, `order_date`, `total_amount`, `payment_proof_url`, `status`, `verified_by`, `created_at`, `updated_at`, `shipping_method`, `shipping_address`, `receiver_name`, `receiver_phone`, `notes`) VALUES
(1, 'ORD-20260109-0001', 10, '2026-01-09 03:00:00', 13200000.00, NULL, 'Completed', 2, '2026-01-09 03:00:00', '2026-01-09 03:00:00', 'pickup', 'Diambil di Toko', 'Gadai Mas', NULL, 'Bon 1'),
(2, 'ORD-20260109-0002', 11, '2026-01-09 04:30:00', 120000.00, NULL, 'Completed', 2, '2026-01-09 04:30:00', '2026-01-09 04:30:00', 'pickup', 'Diambil di Toko', 'Isma', NULL, 'Bon 2'),
(3, 'ORD-20260109-0003', 11, '2026-01-09 06:15:00', 118750.00, NULL, 'Completed', 2, '2026-01-09 06:15:00', '2026-01-09 06:15:00', 'pickup', 'Diambil di Toko', 'Pak Hasan', NULL, 'Bon 3'),
(4, 'ORD-20260112-0004', 12, '2026-01-12 02:00:00', 150000.00, NULL, 'Processing', 2, '2026-01-12 02:00:00', '2026-01-12 02:00:00', 'pickup', 'Diambil di Toko', 'Sarah', NULL, 'Bon 4'),
(5, 'ORD-20260112-0006', 11, '2026-01-12 07:00:00', 380000.00, NULL, 'Completed', 2, '2026-01-12 07:00:00', '2026-01-12 07:00:00', 'pickup', 'Diambil di Toko', 'Umum', NULL, 'Bon 6'),
(6, 'ORD-20260121-0012', 13, '2026-01-21 03:20:00', 900000.00, NULL, 'Processing', 2, '2026-01-21 03:20:00', '2026-01-21 03:20:00', 'pickup', 'Diambil di Toko', 'Erwin', NULL, 'Bon 12'),
(7, 'ORD-20260202-0027', 12, '2026-02-02 04:00:00', 5000000.00, NULL, 'Processing', 2, '2026-02-02 04:00:00', '2026-02-02 04:00:00', 'pickup', 'Diambil di Toko', 'Vina', NULL, 'Bon 27'),
(8, 'ORD-20260210-0035', 14, '2026-02-10 02:30:00', 412100.00, NULL, 'Processing', 2, '2026-02-10 02:30:00', '2026-02-10 02:30:00', 'pickup', 'Diambil di Toko', 'Pak Hasan', NULL, 'Bon 35'),
(9, 'ORD-20260218-0052', 12, '2026-02-18 03:45:00', 8000000.00, NULL, 'Verified', 2, '2026-02-18 03:45:00', '2026-02-18 03:45:00', 'pickup', 'Diambil di Toko', 'Vina', NULL, 'Bon 52A (PO Terbit)'),
(10, 'ORD-20260223-0065', 11, '2026-02-23 08:00:00', 15000000.00, NULL, 'Pending', NULL, '2026-02-23 08:00:00', '2026-02-23 08:00:00', 'pickup', 'Diambil di Toko', 'Bpk Frans', NULL, 'Bon 65'),
(11, 'ORD-20260331-108A', 13, '2026-03-31 02:10:00', 2415000.00, NULL, 'Completed', 2, '2026-03-31 02:10:00', '2026-03-31 02:10:00', 'pickup', 'Diambil di Toko', 'Ammar', NULL, 'Bon 108A'),
(12, 'ORD-20260331-108B', 13, '2026-03-31 03:15:00', 1680000.00, NULL, 'Completed', 2, '2026-03-31 03:15:00', '2026-03-31 03:15:00', 'pickup', 'Diambil di Toko', 'Ammar', NULL, 'Bon 108B'),
(13, 'ORD-20260331-0112', 13, '2026-03-31 04:30:00', 600000.00, NULL, 'Completed', 2, '2026-03-31 04:30:00', '2026-03-31 04:30:00', 'pickup', 'Diambil di Toko', 'Ammar', NULL, 'Bon 112'),
(14, 'ORD-20260505-148A', 13, '2026-05-05 06:00:00', 3500000.00, NULL, 'Verified', 2, '2026-05-05 06:00:00', '2026-05-05 06:00:00', 'pickup', 'Diambil di Toko', 'Amar', NULL, 'Bon 148A (PO Terbit)'),
(15, 'ORD-20260505-148B', 13, '2026-05-05 06:10:00', 3500000.00, NULL, 'Verified', 2, '2026-05-05 06:10:00', '2026-05-05 06:10:00', 'pickup', 'Diambil di Toko', 'Amar', NULL, 'Bon 148B (PO Terbit)'),
(16, 'ORD-20260505-148C', 13, '2026-05-05 06:20:00', 3500000.00, NULL, 'Verified', 2, '2026-05-05 06:20:00', '2026-05-05 06:20:00', 'pickup', 'Diambil di Toko', 'Amar', NULL, 'Bon 148C'),
(17, 'ORD-20260505-148D', 13, '2026-05-05 06:30:00', 3500000.00, NULL, 'Verified', 2, '2026-05-05 06:30:00', '2026-05-05 06:30:00', 'pickup', 'Diambil di Toko', 'Amar', NULL, 'Bon 148D'),
(18, 'ORD-20260506-0149', 13, '2026-05-06 03:00:00', 500000.00, NULL, 'Processing', 2, '2026-05-06 03:00:00', '2026-05-06 03:00:00', 'pickup', 'Diambil di Toko', 'Amar', NULL, 'Bon 149'),
(19, 'ORD-20260507-0150', 15, '2026-05-07 02:00:00', 3774720.00, NULL, 'Processing', 2, '2026-05-07 02:00:00', '2026-05-07 02:00:00', 'pickup', 'Diambil di Toko', 'Indofood Rep', NULL, 'Bon 150'),
(20, 'ORD-20260507-0151', 11, '2026-05-07 04:30:00', 70000.00, NULL, 'Completed', 2, '2026-05-07 04:30:00', '2026-05-07 04:30:00', 'pickup', 'Diambil di Toko', 'Umum', NULL, 'Bon 151'),
(21, 'ORD-20260508-0152', 12, '2026-05-08 07:00:00', 850000.00, NULL, 'Processing', 2, '2026-05-08 07:00:00', '2026-05-08 07:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 152'),
(22, 'ORD-20260511-0153', 15, '2026-05-11 03:15:00', 23454750.00, NULL, 'Processing', 2, '2026-05-11 03:15:00', '2026-05-11 03:15:00', 'pickup', 'Diambil di Toko', 'Indofood Rep', NULL, 'Bon 153'),
(23, 'ORD-20260519-0154', 11, '2026-05-19 02:30:00', 3500000.00, NULL, 'Completed', 2, '2026-05-19 02:30:00', '2026-05-19 02:30:00', 'pickup', 'Diambil di Toko', 'Umum', NULL, 'Bon 154'),
(24, 'ORD-20260513-0155', 12, '2026-05-13 06:45:00', 500000.00, NULL, 'Processing', 2, '2026-05-13 06:45:00', '2026-05-13 06:45:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 155'),
(25, 'ORD-20260513-0158', 12, '2026-05-13 08:00:00', 350000.00, NULL, 'Completed', 2, '2026-05-13 08:00:00', '2026-05-13 08:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 158'),
(26, 'ORD-20260519-0159', 11, '2026-05-19 04:20:00', 4000000.00, NULL, 'Processing', 2, '2026-05-19 04:20:00', '2026-05-19 04:20:00', 'pickup', 'Diambil di Toko', 'Umum', NULL, 'Bon 159'),
(27, 'ORD-20260510-0160', 12, '2026-05-10 02:00:00', 500000.00, NULL, 'Processing', 2, '2026-05-10 02:00:00', '2026-05-10 02:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 160'),
(28, 'ORD-20260520-0162', 16, '2026-05-20 03:30:00', 35000.00, NULL, 'Processing', 2, '2026-05-20 03:30:00', '2026-05-20 03:30:00', 'pickup', 'Diambil di Toko', 'Assi Rep', NULL, 'Bon 162'),
(29, 'ORD-20260520-0164', 17, '2026-05-20 07:00:00', 22400.00, NULL, 'Processing', 2, '2026-05-20 07:00:00', '2026-05-20 07:00:00', 'pickup', 'Diambil di Toko', 'Adv Rep', NULL, 'Bon 164'),
(30, 'ORD-20260520-0165', 12, '2026-05-20 09:15:00', 230000.00, NULL, 'Processing', 2, '2026-05-20 09:15:00', '2026-05-20 09:15:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 165'),
(46, 'ORD-20260112-0005', 20, '2026-01-12 03:00:00', 150000.00, NULL, 'Completed', 2, '2026-01-12 03:00:00', '2026-01-12 03:00:00', 'pickup', 'Diambil di Toko', 'Kormi Rep', NULL, 'Bon 5'),
(47, 'ORD-20260115-0007', 11, '2026-01-15 03:00:00', 118750.00, NULL, 'Completed', 2, '2026-01-15 03:00:00', '2026-01-15 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 7'),
(48, 'ORD-20260115-0008', 11, '2026-01-15 04:00:00', 160000.00, NULL, 'Completed', 2, '2026-01-15 04:00:00', '2026-01-15 04:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 8'),
(49, 'ORD-20260115-0009', 13, '2026-01-15 05:00:00', 900000.00, NULL, 'Completed', 2, '2026-01-15 05:00:00', '2026-01-15 05:00:00', 'pickup', 'Diambil di Toko', 'Djarum Rep', NULL, 'Bon 9'),
(50, 'ORD-20260115-0010', 20, '2026-01-15 06:00:00', 50000.00, NULL, 'Completed', 2, '2026-01-15 06:00:00', '2026-01-15 06:00:00', 'pickup', 'Diambil di Toko', 'Kormi Rep', NULL, 'Bon 10'),
(51, 'ORD-20260119-0011', 11, '2026-01-19 03:00:00', 400000.00, NULL, 'Completed', 2, '2026-01-19 03:00:00', '2026-01-19 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 11'),
(52, 'ORD-20260119-0013', 11, '2026-01-19 04:00:00', 600000.00, NULL, 'Processing', 2, '2026-01-19 04:00:00', '2026-01-19 04:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 13'),
(53, 'ORD-20260120-0014', 12, '2026-01-20 03:00:00', 30000000.00, NULL, 'Completed', 2, '2026-01-20 03:00:00', '2026-01-20 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 14'),
(54, 'ORD-20260120-014B', 21, '2026-01-20 04:00:00', 3000000.00, NULL, 'Completed', 2, '2026-01-20 04:00:00', '2026-01-20 04:00:00', 'pickup', 'Diambil di Toko', 'Varcos Rep', NULL, 'Bon 14B'),
(55, 'ORD-20260120-0015', 11, '2026-01-20 05:00:00', 120000.00, NULL, 'Completed', 2, '2026-01-20 05:00:00', '2026-01-20 05:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 15'),
(56, 'ORD-20260121-0016', 13, '2026-01-21 03:00:00', 525000.00, NULL, 'Completed', 2, '2026-01-21 03:00:00', '2026-01-21 03:00:00', 'pickup', 'Diambil di Toko', 'Djarum Rep', NULL, 'Bon 16'),
(57, 'ORD-20260122-0017', 11, '2026-01-22 03:00:00', 485000.00, NULL, 'Completed', 2, '2026-01-22 03:00:00', '2026-01-22 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 17'),
(58, 'ORD-20260123-0018', 12, '2026-01-23 03:00:00', 47000000.00, NULL, 'Completed', 2, '2026-01-23 03:00:00', '2026-01-23 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 18'),
(59, 'ORD-20260120-0019', 11, '2026-01-20 03:30:00', 70000.00, NULL, 'Completed', 2, '2026-01-20 03:30:00', '2026-01-20 03:30:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 19'),
(60, 'ORD-20260126-0020', 11, '2026-01-26 03:00:00', 5250000.00, NULL, 'Completed', 2, '2026-01-26 03:00:00', '2026-01-26 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 20'),
(61, 'ORD-20260126-0021', 11, '2026-01-26 04:00:00', 365500.00, NULL, 'Processing', 2, '2026-01-26 04:00:00', '2026-01-26 04:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 21'),
(62, 'ORD-20260128-0022', 11, '2026-01-28 03:00:00', 125000.00, NULL, 'Completed', 2, '2026-01-28 03:00:00', '2026-01-28 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 22'),
(63, 'ORD-20260128-0023', 11, '2026-01-28 04:00:00', 145000.00, NULL, 'Completed', 2, '2026-01-28 04:00:00', '2026-01-28 04:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 23'),
(64, 'ORD-20260128-0024', 20, '2026-01-28 05:00:00', 9500000.00, NULL, 'Completed', 2, '2026-01-28 05:00:00', '2026-01-28 05:00:00', 'pickup', 'Diambil di Toko', 'Kormi Rep', NULL, 'Bon 24'),
(65, 'ORD-20260128-0025', 11, '2026-01-28 06:00:00', 30000.00, NULL, 'Completed', 2, '2026-01-28 06:00:00', '2026-01-28 06:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 25'),
(66, 'ORD-20260120-026A', 12, '2026-01-20 07:00:00', 3000000.00, NULL, 'Completed', 2, '2026-01-20 07:00:00', '2026-01-20 07:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 26A'),
(67, 'ORD-20260120-026B', 12, '2026-01-20 08:00:00', 6000000.00, NULL, 'Completed', 2, '2026-01-20 08:00:00', '2026-01-20 08:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 26B'),
(68, 'ORD-20260120-026C', 12, '2026-01-20 09:00:00', 3000000.00, NULL, 'Processing', 2, '2026-01-20 09:00:00', '2026-01-20 09:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 26C'),
(69, 'ORD-20260203-028', 12, '2026-02-03 03:00:00', 47000000.00, NULL, 'Completed', 2, '2026-02-03 03:00:00', '2026-02-03 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 28'),
(70, 'ORD-20260205-029', 11, '2026-02-05 03:00:00', 8240000.00, NULL, 'Completed', 2, '2026-02-05 03:00:00', '2026-02-05 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 29'),
(71, 'ORD-20260205-030', 20, '2026-02-05 03:00:00', 8500000.00, NULL, 'Completed', 2, '2026-02-05 03:00:00', '2026-02-05 03:00:00', 'pickup', 'Diambil di Toko', 'Kormi Rep', NULL, 'Bon 30'),
(72, 'ORD-20260205-031', 11, '2026-02-05 03:00:00', 22000.00, NULL, 'Processing', 2, '2026-02-05 03:00:00', '2026-02-05 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 31'),
(73, 'ORD-20260206-032', 11, '2026-02-06 03:00:00', 22000.00, NULL, 'Completed', 2, '2026-02-06 03:00:00', '2026-02-06 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 32'),
(74, 'ORD-20260209-033', 12, '2026-02-09 03:00:00', 3000000.00, NULL, 'Processing', 2, '2026-02-09 03:00:00', '2026-02-09 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 33'),
(75, 'ORD-20260209-034', 22, '2026-02-09 03:00:00', 735000.00, NULL, 'Processing', 2, '2026-02-09 03:00:00', '2026-02-09 03:00:00', 'pickup', 'Diambil di Toko', 'Pocari Rep', NULL, 'Bon 34'),
(76, 'ORD-20260210-036', 23, '2026-02-10 03:00:00', 1084602.00, NULL, 'Completed', 2, '2026-02-10 03:00:00', '2026-02-10 03:00:00', 'pickup', 'Diambil di Toko', 'Arya Rep', NULL, 'Bon 36'),
(77, 'ORD-20260210-037', 23, '2026-02-10 03:00:00', 97000.00, NULL, 'Completed', 2, '2026-02-10 03:00:00', '2026-02-10 03:00:00', 'pickup', 'Diambil di Toko', 'Arya Rep', NULL, 'Bon 37'),
(78, 'ORD-20260210-038', 11, '2026-02-10 03:00:00', 100000.00, NULL, 'Completed', 2, '2026-02-10 03:00:00', '2026-02-10 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 38'),
(81, 'ORD-20260211-041', 23, '2026-02-11 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-11 03:00:00', '2026-02-11 03:00:00', 'pickup', 'Diambil di Toko', 'Arya Rep', NULL, 'Bon 41'),
(82, 'ORD-20260211-042', 20, '2026-02-11 03:00:00', 500000.00, NULL, 'Completed', 2, '2026-02-11 03:00:00', '2026-02-11 03:00:00', 'pickup', 'Diambil di Toko', 'Kormi Rep', NULL, 'Bon 42'),
(83, 'ORD-20260211-043', 11, '2026-02-11 03:00:00', 30000.00, NULL, 'Completed', 2, '2026-02-11 03:00:00', '2026-02-11 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 43'),
(84, 'ORD-20260211-044', 24, '2026-02-11 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-11 03:00:00', '2026-02-11 03:00:00', 'pickup', 'Diambil di Toko', 'Keind Rep', NULL, 'Bon 44'),
(85, 'ORD-20260211-045', 25, '2026-02-11 03:00:00', 27280.00, NULL, 'Completed', 2, '2026-02-11 03:00:00', '2026-02-11 03:00:00', 'pickup', 'Diambil di Toko', 'Jhsf Rep', NULL, 'Bon 45'),
(86, 'ORD-20260212-046', 12, '2026-02-12 03:00:00', 6500000.00, NULL, 'Completed', 2, '2026-02-12 03:00:00', '2026-02-12 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 46'),
(87, 'ORD-20260218-047', 26, '2026-02-18 03:00:00', 3000000.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Suntone Rep', NULL, 'Bon 47'),
(89, 'ORD-20260218-049', 13, '2026-02-18 03:00:00', 1800000.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Djarum Rep', NULL, 'Bon 49'),
(90, 'ORD-20260218-050', 12, '2026-02-18 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 50'),
(91, 'ORD-20260218-051A', 12, '2026-02-18 03:00:00', 8000000.00, NULL, 'Completed', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 51A'),
(92, 'ORD-20260218-052B', 12, '2026-02-18 03:00:00', 6000000.00, NULL, 'Completed', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 52B'),
(93, 'ORD-20260218-053', 12, '2026-02-18 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 53'),
(94, 'ORD-20260218-054A', 12, '2026-02-18 03:00:00', 4000000.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 54A'),
(95, 'ORD-20260218-054B', 12, '2026-02-18 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 54B'),
(96, 'ORD-20260218-055A', 12, '2026-02-18 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 55A'),
(97, 'ORD-20260218-055B', 12, '2026-02-18 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 55B'),
(98, 'ORD-20260218-056', 12, '2026-02-18 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 56'),
(99, 'ORD-20260218-057', 12, '2026-02-18 03:00:00', 4000000.00, NULL, 'Completed', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 57'),
(100, 'ORD-20260213-058', 27, '2026-02-13 03:00:00', 450000.00, NULL, 'Processing', 2, '2026-02-13 03:00:00', '2026-02-13 03:00:00', 'pickup', 'Diambil di Toko', 'Als Rep', NULL, 'Bon 58'),
(101, 'ORD-20260218-059', 28, '2026-02-18 03:00:00', 1350000.00, NULL, 'Completed', 2, '2026-02-18 03:00:00', '2026-02-18 03:00:00', 'pickup', 'Diambil di Toko', 'Sulthon Rep', NULL, 'Bon 59'),
(102, 'ORD-20260220-061', 12, '2026-02-20 03:00:00', 1450000.00, NULL, 'Processing', 2, '2026-02-20 03:00:00', '2026-02-20 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 61'),
(103, 'ORD-20260220-062', 26, '2026-02-20 03:00:00', 1000000.00, NULL, 'Processing', 2, '2026-02-20 03:00:00', '2026-02-20 03:00:00', 'pickup', 'Diambil di Toko', 'Suntone Rep', NULL, 'Bon 62'),
(104, 'ORD-20260220-063', 12, '2026-02-20 03:00:00', 6000000.00, NULL, 'Processing', 2, '2026-02-20 03:00:00', '2026-02-20 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 63'),
(105, 'ORD-20260223-064', 12, '2026-02-23 03:00:00', 13000000.00, NULL, 'Processing', 2, '2026-02-23 03:00:00', '2026-02-23 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 64'),
(106, 'ORD-20260223-066', 12, '2026-02-23 03:00:00', 4000000.00, NULL, 'Completed', 2, '2026-02-23 03:00:00', '2026-02-23 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 66'),
(107, 'ORD-20260223-067', 11, '2026-02-23 03:00:00', 60000.00, NULL, 'Completed', 2, '2026-02-23 03:00:00', '2026-02-23 03:00:00', 'pickup', 'Diambil di Toko', 'Umum Rep', NULL, 'Bon 67'),
(108, 'ORD-20260224-068', 12, '2026-02-24 03:00:00', 0.00, NULL, 'Processing', 2, '2026-02-24 03:00:00', '2026-02-24 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 68'),
(109, 'ORD-20260225-069', 12, '2026-02-25 03:00:00', 2800000.00, NULL, 'Completed', 2, '2026-02-25 03:00:00', '2026-02-25 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 69'),
(110, 'ORD-20260225-070', 12, '2026-02-25 03:00:00', 30000.00, NULL, 'Completed', 2, '2026-02-25 03:00:00', '2026-02-25 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 70'),
(111, 'ORD-20260226-071', 12, '2026-02-26 03:00:00', 37000000.00, NULL, 'Processing', 2, '2026-02-26 03:00:00', '2026-02-26 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 71'),
(112, 'ORD-20260226-072', 12, '2026-02-26 03:00:00', 700000.00, NULL, 'Completed', 2, '2026-02-26 03:00:00', '2026-02-26 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 72'),
(114, 'ORD-20260227-074', 12, '2026-02-27 03:00:00', 1450000.00, NULL, 'Processing', 2, '2026-02-27 03:00:00', '2026-02-27 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 74'),
(115, 'ORD-20260213-098', 12, '2026-02-13 03:00:00', 210000.00, NULL, 'Processing', 2, '2026-02-13 03:00:00', '2026-02-13 03:00:00', 'pickup', 'Diambil di Toko', 'Paragon Rep', NULL, 'Bon 98'),
(118, 'ORD-202606242243297779', 29, '2026-06-24 15:43:29', 540000.00, NULL, 'Pending', NULL, '2026-06-24 15:43:29', '2026-06-24 15:43:29', 'pickup', 'Diskusi via WhatsApp / Ambil di Toko', 'Mariska Siagian', '082180532600', NULL),
(119, 'ORD-202606242338141351', 29, '2026-06-24 16:38:14', 90000.00, 'payment_proofs/payment-29-1782346050.png', 'Processing', 2, '2026-06-24 16:38:14', '2026-06-24 20:34:17', 'pickup', 'Diskusi via WhatsApp / Ambil di Toko', 'Mariska Siagian', '082180532600', NULL),
(120, 'ORD-202606250230584062', 29, '2026-06-24 19:30:58', 21600.00, 'payment_proofs/payment-29-1782354840.png', 'Verified', 2, '2026-06-24 19:30:58', '2026-06-28 19:29:03', 'pickup', 'Diskusi via WhatsApp / Ambil di Toko', 'Mariska Siagian', '082180532600', NULL),
(121, 'ORD-202606250736533231', 29, '2026-06-25 00:36:53', 21600.00, NULL, 'Pending', NULL, '2026-06-25 00:36:53', '2026-06-25 00:36:53', 'pickup', 'Diskusi via WhatsApp / Ambil di Toko', 'Mariska Siagian', '082180532600', NULL),
(122, 'ORD-202606250737509338', 29, '2026-06-25 00:37:50', 129600.00, 'payment_proofs/payment-29-1782373089.jpg', 'Completed', 2, '2026-06-25 00:37:50', '2026-06-25 00:41:48', 'pickup', 'Diskusi via WhatsApp / Ambil di Toko', 'Mariska Siagian', '082180532600', NULL),
(123, 'ORD-202606272319404889', 29, '2026-06-27 16:19:40', 129600.00, 'payment_proofs/payment-29-1782619792.jpeg', 'Completed', 2, '2026-06-27 16:19:40', '2026-06-28 16:05:21', 'pickup', 'Diskusi via WhatsApp / Ambil di Toko', 'Mariska Siagian', '082180532600', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `calculated_price` decimal(15,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `specifications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `custom_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `calculated_price`, `subtotal`, `specifications`, `custom_details`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 'MMT 340GSM', 1.00, 13200000.00, 13200000.00, 13200000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 340GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi Baliho Gadai Mas Simpang Limun\\\"}\"', '2026-01-08 20:00:00', '2026-01-08 20:00:00'),
(2, 2, 11, 'MMT 280GSM', 1.00, 120000.00, 120000.00, 120000.00, '\"{\\\"length\\\":1.5,\\\"width\\\":3,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1,5x3 1x1 PERINGATAN ISRAK MIKRAJ\\\"}\"', '2026-01-08 21:30:00', '2026-01-08 21:30:00'),
(3, 3, 11, 'MMT 280GSM', 1.00, 118750.00, 118750.00, 118750.00, '\"{\\\"length\\\":1.25,\\\"width\\\":1.2,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1m25x 1m20 SPANDUK JADWAL KHOTIB\\\"}\"', '2026-01-08 23:15:00', '2026-01-08 23:15:00'),
(4, 4, 17, 'STICKER INDOOR', 1.00, 150000.00, 150000.00, 150000.00, '\"{\\\"length\\\":17,\\\"width\\\":20,\\\"material\\\":\\\"STICKER INDOOR\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Stiker Print And Cut 17X20 lip 6x6 Spray 20x20 Bedak\\\"}\"', '2026-01-11 19:00:00', '2026-01-11 19:00:00'),
(5, 5, 11, 'MMT 280GSM', 1.00, 380000.00, 380000.00, 380000.00, '\"{\\\"length\\\":5,\\\"width\\\":10,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Bilboard titikuning Brodkest 5x10 6x4\\\"}\"', '2026-01-12 00:00:00', '2026-01-12 00:00:00'),
(6, 6, 11, 'MMT 280GSM', 1.00, 900000.00, 900000.00, 900000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk djarum brand D (15PCS)\\\"}\"', '2026-01-20 20:20:00', '2026-01-20 20:20:00'),
(7, 7, 8, 'MMT 280GSM', 1.00, 5000000.00, 5000000.00, 5000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth Makeover Mastershade Meja Sun Plaza\\\"}\"', '2026-02-01 21:00:00', '2026-02-01 21:00:00'),
(8, 8, 11, 'MMT 280GSM', 1.00, 412100.00, 412100.00, 412100.00, '\"{\\\"length\\\":1,\\\"width\\\":3,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk Ikmas Milad uk.1x3, 3x2, 3x150, 1x4 dll\\\"}\"', '2026-02-09 19:30:00', '2026-02-09 19:30:00'),
(9, 9, 8, 'MMT 280GSM', 1.00, 8000000.00, 8000000.00, 8000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth Emina Irian Marelan\\\"}\"', '2026-02-17 20:45:00', '2026-02-17 20:45:00'),
(10, 10, 8, 'MMT 280GSM', 1.00, 15000000.00, 15000000.00, 15000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi Photo Box Bpk Frans\\\"}\"', '2026-02-23 01:00:00', '2026-02-23 01:00:00'),
(11, 11, 17, 'STICKER INDOOR', 1.00, 2415000.00, 2415000.00, 2415000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"STICKER INDOOR\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"revisual stiker pnt djarum 76 mangga royal 23 pcs\\\"}\"', '2026-03-30 19:10:00', '2026-03-30 19:10:00'),
(12, 12, 17, 'STICKER INDOOR', 1.00, 1680000.00, 1680000.00, 1680000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"STICKER INDOOR\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"revisual stiker pnt djarum insta watermelon 16 pcs\\\"}\"', '2026-03-30 20:15:00', '2026-03-30 20:15:00'),
(13, 13, 14, 'BACKLITE', 1.00, 600000.00, 600000.00, 600000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"BACKLITE\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Revisual Neon Box Djarum LA BOLD 5pcs\\\"}\"', '2026-03-30 21:30:00', '2026-03-30 21:30:00'),
(14, 14, 11, 'MMT 280GSM', 1.00, 3500000.00, 3500000.00, 3500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi vbanner djarum Semi Permanen 20 unit ZONA LUBUK PAKAM 1\\\"}\"', '2026-05-04 23:00:00', '2026-05-04 23:00:00'),
(15, 15, 11, 'MMT 280GSM', 1.00, 3500000.00, 3500000.00, 3500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi vbanner djarum Semi Permanen 20 unit ZONA LUBUK PAKAM 2\\\"}\"', '2026-05-04 23:10:00', '2026-05-04 23:10:00'),
(16, 16, 11, 'MMT 280GSM', 1.00, 3500000.00, 3500000.00, 3500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi vbanner djarum Semi Permanen 20 unit ZONA PERBAUNGAN\\\"}\"', '2026-05-04 23:20:00', '2026-05-04 23:20:00'),
(17, 17, 11, 'MMT 280GSM', 1.00, 3500000.00, 3500000.00, 3500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi vbanner djarum Semi Permanen 20 unit ZONA SEI RAMPAH\\\"}\"', '2026-05-04 23:30:00', '2026-05-04 23:30:00'),
(18, 18, 11, 'MMT 280GSM', 1.00, 500000.00, 500000.00, 500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Pemasangan vb apel royal 5 unit (malam-malam)\\\"}\"', '2026-05-05 20:00:00', '2026-05-05 20:00:00'),
(19, 19, 1, 'MMT 280GSM', 1.00, 3774720.00, 3774720.00, 3774720.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Rebranding PNT Toko Serasi dan Toko Jona Indofood\\\"}\"', '2026-05-06 19:00:00', '2026-05-06 19:00:00'),
(20, 20, 11, 'MMT 280GSM', 1.00, 70000.00, 70000.00, 70000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk uk 4mx75cm (1pcs) Qurban mesjid\\\"}\"', '2026-05-06 21:30:00', '2026-05-06 21:30:00'),
(21, 21, 8, 'MMT 280GSM', 1.00, 850000.00, 850000.00, 850000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Maintenance Backwall Wardah Berastagi Cemara\\\"}\"', '2026-05-08 00:00:00', '2026-05-08 00:00:00'),
(22, 22, 1, 'MMT 280GSM', 1.00, 23454750.00, 23454750.00, 23454750.00, '\"{\\\"length\\\":7,\\\"width\\\":1.2,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi PNT AGAM NYAK WELL Indofood uk. 7x1,2 m\\\"}\"', '2026-05-10 20:15:00', '2026-05-10 20:15:00'),
(23, 23, 5, 'MMT 280GSM', 1.00, 3500000.00, 3500000.00, 3500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi Akrilik Nama PT.WAHANATAMA HIJAU MUTIARA MANDIRI\\\"}\"', '2026-05-18 19:30:00', '2026-05-18 19:30:00'),
(24, 24, 8, 'MMT 280GSM', 1.00, 500000.00, 500000.00, 500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Maintenance Sis Wardah dan OMG Perfect 10\\\"}\"', '2026-05-12 23:45:00', '2026-05-12 23:45:00'),
(25, 25, 11, 'MMT 280GSM', 1.00, 350000.00, 350000.00, 350000.00, '\"{\\\"length\\\":5,\\\"width\\\":280,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk UK.5x280:1pc welcome to Paragon day\\\"}\"', '2026-05-13 01:00:00', '2026-05-13 01:00:00'),
(26, 26, 5, 'MMT 280GSM', 1.00, 4000000.00, 4000000.00, 4000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi Logo Suit En Flor\\\"}\"', '2026-05-18 21:20:00', '2026-05-18 21:20:00'),
(27, 27, 8, 'MMT 280GSM', 1.00, 500000.00, 500000.00, 500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Maintenance Backwall Wardah Skincare Underprice Jamin Ginting\\\"}\"', '2026-05-09 19:00:00', '2026-05-09 19:00:00'),
(28, 28, 11, 'MMT 280GSM', 1.00, 35000.00, 35000.00, 35000.00, '\"{\\\"length\\\":1,\\\"width\\\":3,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk UK 1x3: 1lbr Pelantikan ASSI Sumut\\\"}\"', '2026-05-19 20:30:00', '2026-05-19 20:30:00'),
(29, 29, 11, 'MMT 280GSM', 1.00, 22400.00, 22400.00, 22400.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk UK 80x,2:1pc Rekreasi Karyawan Advertising\\\"}\"', '2026-05-20 00:00:00', '2026-05-20 00:00:00'),
(30, 30, 11, 'MMT 280GSM', 1.00, 230000.00, 230000.00, 230000.00, '\"{\\\"length\\\":80,\\\"width\\\":450,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk UK.80x450:1lbr( Kenzi kosmetik) UK.80x4:1lbr( Kiky kosmetik)  UK.80x2,5: 1lbr ( sarafina beauty)\\\"}\"', '2026-05-20 02:15:00', '2026-05-20 02:15:00'),
(31, 58, 8, 'MMT 280GSM', 1.00, 47000000.00, 47000000.00, 47000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Repair Booth Wardah 2026\\\"}\"', '2026-01-22 20:00:00', '2026-01-22 20:00:00'),
(32, 59, 11, 'MMT 280GSM', 1.00, 70000.00, 70000.00, 70000.00, '\"{\\\"length\\\":120,\\\"width\\\":90,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 120x90 Private Les 2PCS\\\"}\"', '2026-01-19 20:30:00', '2026-01-19 20:30:00'),
(33, 60, 14, 'BACKLITE', 1.00, 5250000.00, 5250000.00, 5250000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"BACKLITE\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi Neon Box Toko Mas Karo-Karo\\\"}\"', '2026-01-25 20:00:00', '2026-01-25 20:00:00'),
(34, 61, 11, 'MMT 280GSM', 1.00, 365500.00, 365500.00, 365500.00, '\"{\\\"length\\\":1.25,\\\"width\\\":1.2,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1m25x 1m20 SPANDUK JADWAL KHOTIB 1m25x3m50 (3pcs) (DABEL DENGAN BON 17)\\\"}\"', '2026-01-25 21:00:00', '2026-01-25 21:00:00'),
(35, 62, 11, 'MMT 280GSM', 1.00, 125000.00, 125000.00, 125000.00, '\"{\\\"length\\\":1,\\\"width\\\":5,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1x5 SELAMAT MENUNAIKAN IBADAH PUASA\\\"}\"', '2026-01-27 20:00:00', '2026-01-27 20:00:00'),
(36, 63, 11, 'MMT 280GSM', 1.00, 145000.00, 145000.00, 145000.00, '\"{\\\"length\\\":1,\\\"width\\\":4,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1x4 MAE.FLOO BOUQET AND GIFT\\\"}\"', '2026-01-27 21:00:00', '2026-01-27 21:00:00'),
(37, 64, 8, 'MMT 280GSM', 1.00, 9500000.00, 9500000.00, 9500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi backdrop & gate KORMI SUMUT\\\"}\"', '2026-01-27 22:00:00', '2026-01-27 22:00:00'),
(38, 65, 11, 'MMT 280GSM', 1.00, 30000.00, 30000.00, 30000.00, '\"{\\\"length\\\":50,\\\"width\\\":2,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk UK.50x2m OBAT HERBAL\\\"}\"', '2026-01-27 23:00:00', '2026-01-27 23:00:00'),
(39, 66, 8, 'MMT 280GSM', 1.00, 3000000.00, 3000000.00, 3000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth EMINA Medan Beauty Week TIARA CONVENTION\\\"}\"', '2026-01-20 00:00:00', '2026-01-20 00:00:00'),
(40, 67, 8, 'MMT 280GSM', 1.00, 6000000.00, 6000000.00, 6000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth Makeover Medan Beauty Week TIARA CONVENTION\\\"}\"', '2026-01-20 01:00:00', '2026-01-20 01:00:00'),
(41, 68, 8, 'MMT 280GSM', 1.00, 3000000.00, 3000000.00, 3000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth OMG Medan Beauty Week TIARA CONVENTION\\\"}\"', '2026-01-20 02:00:00', '2026-01-20 02:00:00'),
(42, 58, 8, 'MMT 280GSM', 1.00, 47000000.00, 47000000.00, 47000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Repair Booth Wardah 2026\\\"}\"', '2026-01-22 20:00:00', '2026-01-22 20:00:00'),
(43, 59, 11, 'MMT 280GSM', 1.00, 70000.00, 70000.00, 70000.00, '\"{\\\"length\\\":120,\\\"width\\\":90,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 120x90 Private Les 2PCS\\\"}\"', '2026-01-19 20:30:00', '2026-01-19 20:30:00'),
(44, 60, 14, 'BACKLITE', 1.00, 5250000.00, 5250000.00, 5250000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"BACKLITE\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi Neon Box Toko Mas Karo-Karo\\\"}\"', '2026-01-25 20:00:00', '2026-01-25 20:00:00'),
(45, 61, 11, 'MMT 280GSM', 1.00, 365500.00, 365500.00, 365500.00, '\"{\\\"length\\\":1.25,\\\"width\\\":1.2,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1m25x 1m20 SPANDUK JADWAL KHOTIB 1m25x3m50 (3pcs) (DABEL DENGAN BON 17)\\\"}\"', '2026-01-25 21:00:00', '2026-01-25 21:00:00'),
(46, 62, 11, 'MMT 280GSM', 1.00, 125000.00, 125000.00, 125000.00, '\"{\\\"length\\\":1,\\\"width\\\":5,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1x5 SELAMAT MENUNAIKAN IBADAH PUASA\\\"}\"', '2026-01-27 20:00:00', '2026-01-27 20:00:00'),
(47, 63, 11, 'MMT 280GSM', 1.00, 145000.00, 145000.00, 145000.00, '\"{\\\"length\\\":1,\\\"width\\\":4,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk 1x4 MAE.FLOO BOUQET AND GIFT\\\"}\"', '2026-01-27 21:00:00', '2026-01-27 21:00:00'),
(48, 64, 8, 'MMT 280GSM', 1.00, 9500000.00, 9500000.00, 9500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi backdrop & gate KORMI SUMUT\\\"}\"', '2026-01-27 22:00:00', '2026-01-27 22:00:00'),
(49, 65, 11, 'MMT 280GSM', 1.00, 30000.00, 30000.00, 30000.00, '\"{\\\"length\\\":50,\\\"width\\\":2,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk UK.50x2m OBAT HERBAL\\\"}\"', '2026-01-27 23:00:00', '2026-01-27 23:00:00'),
(50, 66, 8, 'MMT 280GSM', 1.00, 3000000.00, 3000000.00, 3000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth EMINA Medan Beauty Week TIARA CONVENTION\\\"}\"', '2026-01-20 00:00:00', '2026-01-20 00:00:00'),
(51, 67, 8, 'MMT 280GSM', 1.00, 6000000.00, 6000000.00, 6000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth Makeover Medan Beauty Week TIARA CONVENTION\\\"}\"', '2026-01-20 01:00:00', '2026-01-20 01:00:00'),
(52, 68, 8, 'MMT 280GSM', 1.00, 3000000.00, 3000000.00, 3000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth OMG Medan Beauty Week TIARA CONVENTION\\\"}\"', '2026-01-20 02:00:00', '2026-01-20 02:00:00'),
(100, 69, 8, 'MMT 280GSM', 1.00, 47000000.00, 47000000.00, 47000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Repair Booth Wardah Sun Plaza ( 1 UNIT )\\\"}\"', '2026-02-02 20:00:00', '2026-02-02 20:00:00'),
(101, 70, 11, 'MMT 280GSM', 1.00, 8240000.00, 8240000.00, 8240000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi PNT Apotek Simpang Kampus\\\"}\"', '2026-02-04 20:00:00', '2026-02-04 20:00:00'),
(102, 71, 8, 'MMT 280GSM', 1.00, 8500000.00, 8500000.00, 8500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Sewa backdrop+gate KORMI SUMUT\\\"}\"', '2026-02-04 20:00:00', '2026-02-04 20:00:00'),
(103, 72, 11, 'MMT 280GSM', 1.00, 22000.00, 22000.00, 22000.00, '\"{\\\"length\\\":2,\\\"width\\\":0.5,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"SPANDUK U. 2X0.5 (1lbr)\\\"}\"', '2026-02-04 20:00:00', '2026-02-04 20:00:00'),
(207, 73, 11, 'MMT 280GSM', 1.00, 22000.00, 22000.00, 22000.00, '\"{\\\"length\\\":1,\\\"width\\\":70,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"SPanduk 1x70 Ulang Tahun\\\"}\"', '2026-02-05 20:00:00', '2026-02-05 20:00:00'),
(208, 74, 11, 'MMT 280GSM', 1.00, 3000000.00, 3000000.00, 3000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth MakeOver Citraland\\\"}\"', '2026-02-08 20:00:00', '2026-02-08 20:00:00'),
(209, 75, 11, 'MMT 280GSM', 1.00, 735000.00, 735000.00, 735000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk uk.1x1 IMLEK POCARI\\\"}\"', '2026-02-08 20:00:00', '2026-02-08 20:00:00'),
(210, 76, 11, 'MMT 280GSM', 1.00, 412100.00, 412100.00, 412100.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk Ikmas Milad\\\"}\"', '2026-02-09 20:00:00', '2026-02-09 20:00:00'),
(211, 77, 11, 'MMT 280GSM', 1.00, 1084602.00, 1084602.00, 1084602.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Spanduk Arya\\\"}\"', '2026-02-09 20:00:00', '2026-02-09 20:00:00'),
(212, 81, 17, 'STICKER INDOOR', 1.00, 20000.00, 20000.00, 20000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"STICKER INDOOR\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Stiker 30cmx13 MAKEOVER\\\"}\"', '2026-02-10 20:00:00', '2026-02-10 20:00:00'),
(213, 82, 11, 'MMT 280GSM', 1.00, 0.00, 0.00, 0.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Kalender Arya 25pcs\\\"}\"', '2026-02-10 20:00:00', '2026-02-10 20:00:00'),
(216, 83, 11, 'MMT 280GSM', 1.00, 500000.00, 500000.00, 500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Produksi Spanduk Promo Maret\\\"}\"', '2026-02-28 20:00:00', '2026-02-28 20:00:00'),
(217, 84, 8, 'MMT 280GSM', 1.00, 3500000.00, 3500000.00, 3500000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth EMINA Kim Kosmetik\\\"}\"', '2026-03-08 20:00:00', '2026-03-08 20:00:00'),
(218, 85, 8, 'MMT 280GSM', 1.00, 2000000.00, 2000000.00, 2000000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":null}\"', '\"{\\\"catatan\\\":\\\"Aktivasi Booth KAHF BARBER\\\"}\"', '2026-03-08 20:00:00', '2026-03-08 20:00:00'),
(221, 118, 18, 'STICKER OUTDOOR', 6.00, 90000.00, 540000.00, 540000.00, '\"{\\\"length\\\":2,\\\"width\\\":3,\\\"material\\\":\\\"STICKER OUTDOOR\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":\\\"designs\\\\\\/BDKQ3tPCvW897OseJ9l5uI3NFkPaf5Drxe8EBHlk.png\\\"}\"', '\"[]\"', '2026-06-24 15:43:29', '2026-06-24 15:43:29'),
(222, 119, 18, 'STICKER OUTDOOR', 1.00, 90000.00, 90000.00, 90000.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"STICKER OUTDOOR\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":\\\"designs\\\\\\/Gqm13nDqJzwBnyk7EFhctLAAlRo7bhhOlWkbm2yF.png\\\"}\"', '\"[]\"', '2026-06-24 16:38:14', '2026-06-24 16:38:14'),
(223, 120, 11, 'MMT 280GSM', 1.00, 21600.00, 21600.00, 21600.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":\\\"designs\\\\\\/NYu1lxMgrjtfN3l2lpV9yKy9ujUb1sOdCV25fVgW.png\\\"}\"', '\"[]\"', '2026-06-24 19:30:58', '2026-06-24 19:30:58'),
(224, 121, 11, 'MMT 280GSM', 1.00, 21600.00, 21600.00, 21600.00, '\"{\\\"length\\\":1,\\\"width\\\":1,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":\\\"designs\\\\\\/EDsnxDw1MOlpgk7Iq30zr18juPxvJoN5WPFXMcRu.jpg\\\"}\"', '\"[]\"', '2026-06-25 00:36:53', '2026-06-25 00:36:53'),
(225, 122, 11, 'MMT 280GSM', 6.00, 21600.00, 129600.00, 129600.00, '\"{\\\"length\\\":2,\\\"width\\\":3,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":\\\"designs\\\\\\/JJsbifdnwYLDQe9U4Dhw77UG3fyWrVUpWOhfres2.jpg\\\"}\"', '\"[]\"', '2026-06-25 00:37:50', '2026-06-25 00:37:50'),
(226, 123, 11, 'MMT 280GSM', 6.00, 21600.00, 129600.00, 129600.00, '\"{\\\"length\\\":2,\\\"width\\\":3,\\\"material\\\":\\\"MMT 280GSM\\\",\\\"finishing\\\":\\\"\\\",\\\"design_file\\\":\\\"designs\\\\\\/xczDC0R2GubMGZxQbAJYMohzYnxFWKh6YdXuduUL.jpg\\\"}\"', '\"[]\"', '2026-06-27 16:19:40', '2026-06-27 16:19:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `partners`
--

CREATE TABLE `partners` (
  `partner_id` bigint(20) UNSIGNED NOT NULL,
  `partner_name` varchar(255) NOT NULL,
  `logo_url` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `partners`
--

INSERT INTO `partners` (`partner_id`, `partner_name`, `logo_url`, `created_at`, `updated_at`) VALUES
(17, 'EMINA', 'partners/emina-1766577542.png', '2025-12-24 04:59:02', '2025-12-24 04:59:02'),
(19, 'Kahf', 'partners/kahf-1766577835.jpg', '2025-12-24 05:03:55', '2025-12-24 05:03:55'),
(24, 'Mandiri', 'partners/mandiri-1766578578.webp', '2025-12-24 05:16:18', '2025-12-24 05:16:18'),
(25, 'Bobocabin', 'partners/bobocabin-1766578714.webp', '2025-12-24 05:18:34', '2025-12-24 05:18:34'),
(26, 'OMG', 'partners/omg-1766578800.png', '2025-12-24 05:20:00', '2025-12-24 05:20:00'),
(27, 'Skintific', 'partners/skintific-1766578874.png', '2025-12-24 05:21:14', '2025-12-24 05:21:14'),
(30, 'Glad2Glow', 'partners/glad2glow-1766579056.jpg', '2025-12-24 05:24:16', '2025-12-24 05:24:16'),
(31, 'Wardah', 'partners/wardah-1766579133.png', '2025-12-24 05:25:33', '2025-12-24 05:25:33'),
(32, 'Instaperfect', 'partners/instaperfect-1766579291.webp', '2025-12-24 05:28:11', '2025-12-24 05:28:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `base_price` decimal(15,2) NOT NULL,
  `profit_margin` int(11) NOT NULL DEFAULT 20,
  `unit_type` varchar(255) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `finishing_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `material_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `service_id`, `nama_produk`, `description`, `base_price`, `profit_margin`, `unit_type`, `image_url`, `finishing_options`, `material_options`, `created_at`, `updated_at`) VALUES
(1, 3, 'Neon Box Backlite Grade C', 'Spesifikasi:\r\n- Rangka Hollow 30\r\n- Lampu TL LED\r\n- Visual Flexy 440', 850000.00, 30, 'm2', 'products/neon-box-backlite-grade-c-1764921886.png', NULL, NULL, '2025-12-03 06:38:11', '2026-06-28 19:31:13'),
(3, 3, 'Neon Box Backlite Grade A', 'Spesifikasi:\r\n- Rangka Hollow 30\r\n- Lampu TL LED\r\n- Visual Backlite UV (Premium Quality)', 1200000.00, 20, 'm2', 'products/neon-box-backlite-grade-a-1764921965.png', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 01:06:05'),
(4, 3, 'Neon Box Akrilik', 'Spesifikasi:\r\n- Rangka Hollow 30\r\n- Lampu LED Strip\r\n- Visual Sticker Cutting', 1000000.00, 20, 'm2', 'products/neon-box-akrilik-1764921944.png', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 01:05:44'),
(5, 3, 'Letter Timbul Akrilik', 'Spesifikasi:\r\n- Acrylic 3mm\r\n- LED Strip\r\n- Adaptor', 15000.00, 20, 'm2', 'products/letter-timbul-akrilik-1764921799.png', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 01:03:19'),
(6, 3, 'Letter Timbul Stainless', 'Material Stainless Steel (Anti Karat, Kilap/Doff).', 10000.00, 20, 'm2', 'products/letter-timbul-stainless-1764921777.png', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 01:02:57'),
(7, 3, 'Letter Timbul Galvanil', 'Material Galvanil dengan Finishing Cat Duco (Warna Bebas).', 10000.00, 20, 'm2', 'products/letter-timbul-galvanil-1764921746.png', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 01:02:26'),
(8, 3, 'Tottem (Custom)', 'Pembuatan Tottem Sign Custom.', 0.00, 20, 'unit', 'products/tottem-custom-1764921646.jpeg', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 01:00:46'),
(9, 3, 'Landmark (Custom)', 'Pembuatan Landmark / Signage Kota.', 0.00, 20, 'unit', 'products/landmark-custom-1764921611.jpeg', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 01:00:11'),
(10, 3, 'Facade (Custom)', 'Pelapis Fasad Gedung (ACP).', 0.00, 20, 'unit', 'products/facade-custom-1764921591.jpeg', NULL, NULL, '2025-12-03 06:38:11', '2025-12-05 00:59:51'),
(11, 2, 'MMT 280GSM', 'Cetak Spanduk Outdoor (Frontlite) Ekonomis. Ketebalan 280gr.', 18000.00, 20, 'm2', 'products/mmt-280gsm-1764921387.png', '[{\"nama\":\"Mata Ayam (Per Sudut)\",\"harga\":0},{\"nama\":\"Selongsong (Kanan-Kiri)\",\"harga\":5000},{\"nama\":\"Selongsong (Atas-Bawah)\",\"harga\":5000},{\"nama\":\"Lipat Saja (Tanpa Lubang)\",\"harga\":0}]', NULL, '2025-12-03 06:38:11', '2025-12-05 00:56:27'),
(12, 2, 'MMT 340GSM', 'Cetak Spanduk Outdoor (Frontlite) Standar. Ketebalan 340gr (Lebih tebal).', 25000.00, 20, 'm2', 'products/mmt-340gsm-1764921365.png', '[{\"nama\":\"Mata Ayam (Per Sudut)\",\"harga\":0},{\"nama\":\"Selongsong (Kanan-Kiri)\",\"harga\":5000},{\"nama\":\"Selongsong (Atas-Bawah)\",\"harga\":5000},{\"nama\":\"Lipat Saja (Tanpa Lubang)\",\"harga\":0}]', NULL, '2025-12-03 06:38:12', '2025-12-05 00:56:05'),
(13, 2, 'MMT 440GSM', 'Cetak Spanduk Outdoor (Frontlite) Premium High Res. Ketebalan 440gr (Paling Tebal).', 45000.00, 20, 'm2', 'products/mmt-440gsm-1764921336.png', '[{\"nama\":\"Mata Ayam (Per Sudut)\",\"harga\":0},{\"nama\":\"Selongsong (Kanan-Kiri)\",\"harga\":5000},{\"nama\":\"Selongsong (Atas-Bawah)\",\"harga\":5000},{\"nama\":\"Lipat Saja (Tanpa Lubang)\",\"harga\":0}]', NULL, '2025-12-03 06:38:12', '2025-12-05 00:55:36'),
(14, 2, 'BACKLITE', 'Bahan khusus Neon Box (tembus cahaya).', 85000.00, 20, 'm2', 'products/backlite-1764921253.png', '[{\"nama\":\"Lebihan Bahan\",\"harga\":0}]', NULL, '2025-12-03 06:38:12', '2025-12-05 00:54:13'),
(15, 2, 'BACKLITE UV', 'Cetak Backlite menggunakan mesin UV.', 120000.00, 20, 'm2', 'products/backlite-uv-1764921228.png', '[{\"nama\":\"Lebihan Bahan\",\"harga\":0}]', NULL, '2025-12-03 06:38:12', '2025-12-05 00:53:48'),
(16, 2, 'ALBATROS', 'Bahan kertas sintetis halus (semi-glossy) untuk indoor.', 85000.00, 20, 'm2', 'products/albatros-1764921149.jpeg', '[{\"nama\":\"Tanpa Laminasi\",\"harga\":0},{\"nama\":\"Laminasi Glossy (Kilap)\",\"harga\":15000},{\"nama\":\"Laminasi Doff (Matte)\",\"harga\":15000},{\"nama\":\"Cutting Pola (Kiss Cut)\",\"harga\":25000}]', NULL, '2025-12-03 06:38:12', '2025-12-05 00:52:29'),
(17, 2, 'STICKER INDOOR', 'Sticker Vinyl Indoor High Res.', 85000.00, 20, 'm2', 'products/sticker-indoor-1764921112.jpeg', '[{\"nama\":\"Tanpa Laminasi\",\"harga\":0},{\"nama\":\"Laminasi Glossy (Kilap)\",\"harga\":15000},{\"nama\":\"Laminasi Doff (Matte)\",\"harga\":15000},{\"nama\":\"Cutting Pola (Kiss Cut)\",\"harga\":25000}]', NULL, '2025-12-03 06:38:12', '2025-12-05 00:51:52'),
(18, 2, 'STICKER OUTDOOR', 'Sticker Vinyl Outdoor tahan air & panas.', 75000.00, 20, 'm2', 'products/sticker-outdoor-1764921085.jpeg', '[{\"nama\":\"Tanpa Laminasi\",\"harga\":0},{\"nama\":\"Laminasi Glossy (Kilap)\",\"harga\":15000},{\"nama\":\"Laminasi Doff (Matte)\",\"harga\":15000},{\"nama\":\"Cutting Pola (Kiss Cut)\",\"harga\":25000}]', NULL, '2025-12-03 06:38:12', '2025-12-05 00:51:25'),
(19, 2, 'DURATRANS', 'Backlit Film kualitas tinggi untuk Neon Box Indoor.', 150000.00, 20, 'm2', 'products/duratrans-1764921029.jpeg', NULL, NULL, '2025-12-03 06:38:12', '2025-12-05 00:50:29'),
(20, 2, 'STEMPEL OTOMATIS', 'Stempel Flash otomatis tanpa bantalan tinta.', 65000.00, 20, 'pcs', 'products/stempel-otomatis-1764920985.jpeg', NULL, NULL, '2025-12-03 06:38:12', '2025-12-05 00:49:45'),
(21, 2, 'PLAT BK (Plat Nomor)', 'Cetak Plat Nomor Kendaraan.', 35000.00, 20, 'pcs', 'products/plat-bk-plat-nomor-1764913971.jpg', NULL, NULL, '2025-12-03 06:38:12', '2025-12-04 22:52:51'),
(26, 3, 'NEON BOX BACKLITE GRADE A', 'Spesifikasi:\r\n- Rangka Hollow 30\r\n- Lamput TL LED\r\n- Visual Backlite UV', 1200000.00, 20, 'm2', 'products/neon-box-backlite-grade-a-1782726356.png', NULL, NULL, '2025-12-04 01:45:49', '2026-06-29 02:45:56'),
(27, 2, 'Umbul - Umbul', 'Umbul Umbul Kualitas terbaik', 18000.00, 20, 'm2', 'products/umbul-umbul-1764910006.png', NULL, NULL, '2025-12-04 21:46:46', '2026-06-28 19:01:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`service_id`, `nama_layanan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 'Percetakan', 'Semua kebutuhan cetak Anda.', '2025-12-03 06:38:11', '2025-12-03 06:38:11'),
(3, 'Periklanan', 'Layanan periklanan indoor dan outdoor.', '2025-12-03 06:38:11', '2025-12-03 06:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sph_details`
--

CREATE TABLE `sph_details` (
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `sph_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sph_headers`
--

CREATE TABLE `sph_headers` (
  `sph_id` bigint(20) UNSIGNED NOT NULL,
  `sph_number` varchar(100) NOT NULL,
  `sph_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_up` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `rincian_image` varchar(255) DEFAULT NULL,
  `design_image` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_modal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `unit_multiplier` int(11) NOT NULL DEFAULT 1,
  `total_biaya` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ppn_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `pph_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `terms_waktu` text DEFAULT NULL,
  `terms_pembayaran` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sph_headers`
--

INSERT INTO `sph_headers` (`sph_id`, `sph_number`, `sph_date`, `client_name`, `client_up`, `job_title`, `rincian_image`, `design_image`, `user_id`, `total_modal`, `unit_multiplier`, `total_biaya`, `ppn_amount`, `pph_amount`, `grand_total`, `terms_waktu`, `terms_pembayaran`, `created_at`, `updated_at`) VALUES
(5, 'SPH/2026/001', '2026-04-19', 'PARAGON TECH & INNOVATION', 'U/P Bpk Dharma & Team', 'Pembuatan Neon Box', 'sph_images/gwVy97xhXfkdIZiLahJ0PFc9uz5GNL7xDBONRor0.jpg', 'sph_images/YbtqJAhv5tH9BNEuXiKSynvQPmwoZ7H3DCiWW7Q6.jpg', 2, 0.00, 1, 0.00, 0.00, 0.00, 0.00, '14 Hari Kerja', 'DP 30% dari nilai pekerjaan. Pelunasan setelah selesai.', '2026-04-18 22:33:03', '2026-04-18 22:33:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `initial` varchar(5) NOT NULL,
  `rating` int(11) DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `role`, `content`, `initial`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', 'Marketing Manager', 'Pelayanan mantap, cetakan rapi banget!', 'BS', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$NRYJuU4Dja1eP83LGl6V6eBjsExBnOrgptu7faffOst4xRO87NOT.', 'Admin Arya', '2025-12-03 06:38:11', '2025-12-04 04:20:35'),
(2, 'adminarya', '$2y$10$/ZOixZG2sHkGKvXdKsp0g.BnuGBmSNZkuNvPjWDPylQp8FU3lLg5.', 'Admin Arya', '2025-12-04 04:37:50', '2025-12-04 04:37:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `gallery_service_id_foreign` (`service_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_verified_by_foreign` (`verified_by`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_service_id_foreign` (`service_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indeks untuk tabel `sph_details`
--
ALTER TABLE `sph_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `sph_details_sph_id_foreign` (`sph_id`);

--
-- Indeks untuk tabel `sph_headers`
--
ALTER TABLE `sph_headers`
  ADD PRIMARY KEY (`sph_id`),
  ADD UNIQUE KEY `sph_headers_sph_number_unique` (`sph_number`),
  ADD KEY `sph_headers_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT untuk tabel `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sph_details`
--
ALTER TABLE `sph_details`
  MODIFY `detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sph_headers`
--
ALTER TABLE `sph_headers`
  MODIFY `sph_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `orders_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sph_details`
--
ALTER TABLE `sph_details`
  ADD CONSTRAINT `sph_details_sph_id_foreign` FOREIGN KEY (`sph_id`) REFERENCES `sph_headers` (`sph_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sph_headers`
--
ALTER TABLE `sph_headers`
  ADD CONSTRAINT `sph_headers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
