-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 04 sep. 2021 à 22:05
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `doctosen`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointements`
--

DROP TABLE IF EXISTS `appointements`;
CREATE TABLE IF NOT EXISTS `appointements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointement_date` date NOT NULL,
  `appointement_hour` time NOT NULL,
  `appointement_reason` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointements`
--

INSERT INTO `appointements` (`id`, `appointement_date`, `appointement_hour`, `appointement_reason`, `created_at`, `updated_at`, `doctor_id`, `patient_id`, `status`) VALUES
(1, '2021-08-30', '10:45:00', NULL, '2021-08-31 02:26:59', '2021-08-31 17:03:03', 1, 2, 'annulé'),
(2, '2021-09-02', '10:17:00', 'je suis souffrant', '2021-08-31 02:39:09', '2021-08-31 02:39:09', 1, 2, 'en attente de confirmation'),
(3, '2021-09-05', '20:45:00', NULL, '2021-08-31 04:20:00', '2021-08-31 04:20:01', 1, 2, 'annulé'),
(4, '2021-09-05', '22:05:00', NULL, '2021-08-31 04:20:45', '2021-08-31 04:20:45', 1, 2, 'fait'),
(5, '2021-09-05', '20:45:00', NULL, '2021-08-31 04:22:42', '2021-08-31 04:22:42', 1, 2, 'confirmé'),
(6, '2021-09-05', '20:45:00', NULL, '2021-08-31 04:33:13', '2021-08-31 04:33:14', 1, 2, 'confirmé'),
(7, '2021-09-05', '22:05:00', NULL, '2021-08-31 04:33:57', '2021-08-31 04:33:57', 1, 2, 'en attente de confirmation'),
(8, '2021-09-04', '11:14:00', 'démo', '2021-08-31 22:50:07', '2021-08-31 22:50:07', 1, 2, 'en attente de confirmation');

-- --------------------------------------------------------

--
-- Structure de la table `diplomas`
--

DROP TABLE IF EXISTS `diplomas`;
CREATE TABLE IF NOT EXISTS `diplomas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `diplomas_title_unique` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `diplomas`
--

INSERT INTO `diplomas` (`id`, `title`, `year`, `image`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'am writing things you can\'t', '2015', 'reponse2_1630362142.pdf', '2021-08-30 22:22:22', '2021-08-30 22:22:22', 1);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hospitals`
--

DROP TABLE IF EXISTS `hospitals`;
CREATE TABLE IF NOT EXISTS `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `adress`, `phone`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'abass ndao', 'avenue cheikh anta diop', 774520123, '2021-08-30 22:18:10', '2021-08-30 22:18:10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_08_24_145657_create_sessions_table', 1),
(7, '2021_08_25_111955_create_hospitals_table', 1),
(8, '2021_08_25_113942_add_doctor_id_to_hospitals', 1),
(9, '2021_08_25_114954_create_diplomas_table', 1),
(10, '2021_08_25_120057_add_doctor_id_to_diplomas', 1),
(11, '2021_08_28_115420_create_schedules_table', 1),
(12, '2021_08_28_132722_add_status_to_schedules', 1),
(13, '2021_08_28_132828_add_doctor_id_to_schedules', 1),
(14, '2021_08_28_134643_create_appointements_table', 1),
(15, '1970_01_01_000000_create_base_models_table', 2),
(16, '2021_08_25_113942_add_user_id_to_hospitals', 3),
(17, '2021_08_25_120057_add_user_id_to_diplomas', 4),
(18, '2021_08_28_132828_add_user_id_to_schedules', 5),
(19, '2021_08_30_215058_add_doctor_id_patient_id_to_appointements', 6),
(20, '2021_08_31_154742_add_status_to_appointements', 7);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `schedule_date` date NOT NULL,
  `start_time` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultation_duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `schedules`
--

INSERT INTO `schedules` (`id`, `schedule_date`, `start_time`, `end_time`, `consultation_duration`, `created_at`, `updated_at`, `status`, `user_id`) VALUES
(1, '2021-09-04', '10:50', '20:45', '30', '2021-08-30 22:54:18', '2021-08-31 23:16:41', 1, 1),
(2, '2021-08-31', '10:25', '14:17', '20', '2021-08-30 22:55:01', '2021-08-30 22:55:01', 1, 1),
(3, '2021-09-02', '10:25', '14:17', '20', '2021-08-30 22:55:12', '2021-08-30 22:55:12', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Qz0iUdHZhDH6eZzR66MnEVAhqufICo3SRxBQI3jC', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiS0ZkNFZvVndaVWhVS2pMeTJuNWZ4YjMxd0pjZ2hMOXNUUE40R2ZWciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvdXNlci9hcHBvaW50ZW1lbnQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkMlZ4MXBqTWJFdUQza0YvdWJVbmZnLmduSm43MXZPc3Nvdm1LaDR2VFZGYWgvMm1hQ2swdlciO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJDJWeDFwak1iRXVEM2tGL3ViVW5mZy5nbkpuNzF2T3Nzb3ZtS2g0dlRWRmFoLzJtYUNrMHZXIjt9', 1630433066),
('3ZffLjKZY4h1GTTh1Zn3d8U1AbDrnCoty8wNfski', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQW1iWmszcHRlUlZEeGxFRk5VckpRbEphcVdZQ2ZMcERWaEtlVkN1WSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvZG9jdG9yL3NjaGVkdWxlL2NyZWF0ZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRrMFBMMXNyRGdFVzBGanhobHo5Ny51MFh1M2N5Ri9KMTM2VlloQmxJWVdKMlRobFpMcHVQbSI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkazBQTDFzckRnRVcwRmp4aGx6OTcudTBYdTNjeUYvSjEzNlZZaEJsSVlXSjJUaGxaTHB1UG0iO30=', 1630453016);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `adress`, `phone`, `title`, `email`, `type`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'abc', 'def', 'avenue cheikh anta diop', '785202123', 'Cardiologue', 'layeboly58@gmail.com', 'doctor', '2021-08-30 18:20:35', '$2y$10$k0PL1srDgEW0Fjxhlz97.u0Xu3cyF/J136VYhBlIYWJ2ThlZLpuPm', NULL, NULL, NULL, NULL, NULL, '2021-08-30 18:19:11', '2021-08-30 18:20:35'),
(2, 'aa', 'bb', 'Ouest Foire Yoff Dakar', '762511230', 'Agriculteur', 'mohamedboly@esp.sn', 'patient', '2021-08-30 21:59:51', '$2y$10$2Vx1pjMbEuD3kF/ubUnfg.gnJn71vOssovmKh4vTVFah/2maCk0vW', NULL, NULL, NULL, NULL, NULL, '2021-08-30 21:58:06', '2021-08-30 21:59:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
