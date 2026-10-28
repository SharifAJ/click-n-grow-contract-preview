-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2026 at 12:06 PM
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
-- Database: `kisansat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@kisansat.com', '$2y$12$Yh29Ne8uOPHspkb54RJrROt94HRP6akuZzCu1qHgtXgcw5BQBKQuy', NULL, '2026-09-17 10:05:24', '2026-09-17 10:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `advisory_responses`
--

CREATE TABLE `advisory_responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `farm_id` varchar(255) NOT NULL,
  `img_id` varchar(255) NOT NULL,
  `SKU` varchar(255) DEFAULT NULL,
  `crop_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `disease_name` varchar(255) DEFAULT NULL,
  `disease_solution` text DEFAULT NULL,
  `img_name` varchar(255) DEFAULT NULL,
  `nutrient_deficiency` text DEFAULT NULL,
  `nutrient_management` text DEFAULT NULL,
  `pest_name` varchar(255) DEFAULT NULL,
  `pest_solution` text DEFAULT NULL,
  `status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advisory_submissions`
--

CREATE TABLE `advisory_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `img_id` varchar(255) NOT NULL,
  `image_file_name` varchar(255) NOT NULL,
  `audio_file_name` varchar(255) DEFAULT NULL,
  `croptype` text NOT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_usage_logs`
--

CREATE TABLE `api_usage_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_associates`
--

CREATE TABLE `business_associates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `state_district` varchar(255) NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `operating_area` varchar(255) DEFAULT NULL,
  `network_type` varchar(255) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `preferred_contact` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cartable_type` varchar(255) NOT NULL,
  `cartable_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities_and_states`
--

CREATE TABLE `cities_and_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(512) DEFAULT NULL,
  `state` varchar(512) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract_farmings`
--

CREATE TABLE `contract_farmings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `sowing_months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sowing_months`)),
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `pdf_en` varchar(255) DEFAULT NULL,
  `pdf_hi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crop_calendar`
--

CREATE TABLE `crop_calendar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `crop` varchar(255) NOT NULL,
  `range` varchar(255) NOT NULL,
  `recommended` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crop_harvest_ends`
--

CREATE TABLE `crop_harvest_ends` (
  `crop` varchar(255) NOT NULL,
  `last_day` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crop_list`
--

CREATE TABLE `crop_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE `error_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `error_type` varchar(255) NOT NULL,
  `error_message` text NOT NULL,
  `request_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`request_data`)),
  `api_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`api_response`)),
  `farm_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `state_district` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `land_area` decimal(8,2) NOT NULL,
  `irrigation` enum('Yes','No') NOT NULL,
  `land_type` enum('Owned','Leased') NOT NULL,
  `previous_crops` varchar(255) DEFAULT NULL,
  `interested_crops` varchar(255) DEFAULT NULL,
  `start_month` varchar(255) DEFAULT NULL,
  `preferred_support` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`preferred_support`)),
  `additional_comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `croptype` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sowingdate` date NOT NULL,
  `crop_variety` varchar(255) DEFAULT NULL,
  `area` double DEFAULT NULL,
  `center` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`center`)),
  `district` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `geo_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`geo_json`)),
  `geometry_type` varchar(255) DEFAULT NULL,
  `geo_json_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`geo_json_properties`)),
  `geo_json_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `last_satellite_api_check` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farm_list`
--

CREATE TABLE `farm_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fpos`
--

CREATE TABLE `fpos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `state_district_taluka` varchar(255) NOT NULL,
  `number_of_farmers` int(11) NOT NULL,
  `total_land` decimal(8,2) NOT NULL,
  `current_crops` varchar(255) DEFAULT NULL,
  `interested_crops` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`interested_crops`)),
  `expected_start` varchar(255) DEFAULT NULL,
  `support` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`support`)),
  `group_profile` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_advisory`
--

CREATE TABLE `image_advisory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `SKU` varchar(255) DEFAULT NULL,
  `crop_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `disease_name` varchar(255) DEFAULT NULL,
  `disease_solution` text DEFAULT NULL,
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `img_id` bigint(20) UNSIGNED DEFAULT NULL,
  `img_name` varchar(255) DEFAULT NULL,
  `nutrient_deficiency` text DEFAULT NULL,
  `nutrient_management` text DEFAULT NULL,
  `pest_name` varchar(255) DEFAULT NULL,
  `pest_solution` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irrigation_data`
--

CREATE TABLE `irrigation_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `irrigation_date` date NOT NULL,
  `type` text NOT NULL,
  `gross_irrig` decimal(8,2) NOT NULL,
  `irrig_freq` int(11) NOT NULL,
  `data_fetched_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `mandi_rates`
--

CREATE TABLE `mandi_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `market` varchar(255) NOT NULL,
  `commodity` varchar(255) NOT NULL,
  `variety` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `arrival_date` date NOT NULL,
  `min_price` decimal(10,2) NOT NULL,
  `max_price` decimal(10,2) NOT NULL,
  `modal_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '0001_02_01_000000_create_users_table', 1),
(4, '2024_01_30_052353_create_farm_table', 1),
(5, '2024_04_06_101443_create_advisory_responses_table', 1),
(6, '2024_04_08_090943_create_api_usage_logs_table', 1),
(7, '2024_04_13_123128_create_carts_table', 1),
(8, '2024_04_14_093122_create_subscription_table', 1),
(9, '2024_04_30_070628_create_pest_and_diseases_table', 1),
(10, '2024_04_31_100853_create_irrigation_data_table', 1),
(11, '2024_04_31_105733_create_crop_calendar_table', 1),
(12, '2024_04_31_131936_create_satellite_data_table', 1),
(13, '2025_01_30_063047_create_image_advisory_table', 1),
(14, '2025_01_31_070842_create_retrieve_images_table', 1),
(15, '2025_01_31_101822_create_crop_list_table', 1),
(16, '2025_01_31_103014_create_farm_list_table', 1),
(17, '2025_01_31_103506_create_weather_table', 1),
(18, '2025_02_02_104229_create_personal_access_tokens_table', 1),
(19, '2025_02_04_134713_create_test_settelite_table', 1),
(20, '2025_02_06_064251_create_error_logs_table', 1),
(21, '2025_02_08_212923_add_deleted_at_to_farm_table', 1),
(22, '2025_02_09_194852_add_last_api_check_to_farms_table', 1),
(23, '2025_02_13_060451_create_service_and_package_masters_table', 1),
(24, '2025_02_15_070957_create_package_service_table', 1),
(25, '2025_03_03_070230_create_settings_table', 1),
(26, '2025_03_07_022727_create_request_logs_table', 1),
(27, '2025_03_07_192610_create_admins_table', 1),
(28, '2025_03_08_113457_create_mandi_rates_table', 1),
(29, '2025_03_08_130545_create_cities_and_states_table', 1),
(30, '2025_03_08_142539_add_file_paths_to_satellite_data_table', 1),
(31, '2025_03_11_180135_create_password_otps_table', 1),
(32, '2025_03_13_081356_create_notifications_table', 1),
(33, '2025_03_15_094912_create_crop_harvest_ends_table', 1),
(34, '2025_03_20_090528_add_fcm_token_to_users_table', 1),
(35, '2025_03_25_194347_update_farms_table', 1),
(36, '2025_03_26_170251_create_monitoring_status_table', 1),
(37, '2025_03_27_120307_create_contact_us_table', 1),
(38, '2025_03_31_002205_add_included_services_to_subscriptions_table', 1),
(39, '2025_04_02_165547_add_soft_deletes_to_users_table', 1),
(40, '2025_04_03_101432_create_advisory_submissions_table', 1),
(41, '2025_04_03_133859_add_deleted_at_to_advisory_submissions', 1),
(42, '2025_04_04_165547_add_soft_deletes_to_irrigation_data_table', 1),
(43, '2025_04_21_214745_add_language_to_users_table', 1),
(44, '2025_04_21_221533_add_language_to_pest_and_diseases_table', 1),
(45, '2025_04_25_021514_add_language_to_crop_calendar_table', 1),
(46, '2025_08_25_063120_create_contract_farmings_table', 1),
(47, '2025_08_25_063638_create_enquiries_table', 1),
(48, '2025_08_25_063650_create_business_associates_table', 1),
(49, '2025_08_25_063703_create_farmers_table', 1),
(50, '2025_08_25_064348_create_fpos_table', 1),
(51, '2025_08_25_071020_create_crops_table', 1),
(52, '202_05_31_124339_create_soil_report_table', 1),
(53, '305_04_14_111930_create_payment_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_status`
--

CREATE TABLE `monitoring_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `farm_id` varchar(255) NOT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `api_status` varchar(255) DEFAULT NULL,
  `error_message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `read_at` timestamp NULL DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_masters`
--

CREATE TABLE `package_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`duration`)),
  `is_once` tinyint(1) NOT NULL DEFAULT 0,
  `amount` decimal(10,2) DEFAULT NULL,
  `package_type` enum('premium','free') NOT NULL DEFAULT 'premium',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_masters`
--

INSERT INTO `package_masters` (`id`, `name`, `description`, `duration`, `is_once`, `amount`, `package_type`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Basic Package', 'Includes 5 premium services', '[30]', 0, 400.00, 'premium', 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(3, 'Silver Package', 'Includes all 10 services', '[180]', 0, 1000.00, 'premium', 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(4, 'Gold Package', 'Includes all 10 services', '[365]', 0, 1800.00, 'premium', 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `package_service`
--

CREATE TABLE `package_service` (
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_service`
--

INSERT INTO `package_service` (`package_id`, `service_id`, `created_at`, `updated_at`) VALUES
(2, 2, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(2, 5, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(2, 6, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(2, 8, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(2, 9, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(2, 10, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 1, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 2, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 3, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 4, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 5, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 6, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 7, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 8, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 9, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(3, 10, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 1, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 2, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 3, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 4, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 5, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 6, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 7, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 8, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 9, '2026-09-17 10:05:25', '2026-09-17 10:05:25'),
(4, 10, '2026-09-17 10:05:25', '2026-09-17 10:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_otps`
--

CREATE TABLE `password_otps` (
  `email` varchar(255) NOT NULL,
  `otp` varchar(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment_transactions`
--

CREATE TABLE `payment_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `gateway_transaction_id` varchar(255) DEFAULT NULL,
  `gateway_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_method_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_method_details`)),
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `gateway_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gateway_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `pest_and_diseases`
--

CREATE TABLE `pest_and_diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL DEFAULT 'en',
  `crop_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `affected_part` varchar(255) NOT NULL,
  `disease` varchar(255) DEFAULT NULL,
  `disease_img_urls` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`disease_img_urls`)),
  `pest` varchar(255) DEFAULT NULL,
  `pest_img_urls` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pest_img_urls`)),
  `mode_of_spread` text NOT NULL,
  `pathogen` varchar(255) NOT NULL,
  `solution` text NOT NULL,
  `stage_of_infection` varchar(255) NOT NULL,
  `symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`symptoms`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_logs`
--

CREATE TABLE `request_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_name` varchar(50) NOT NULL,
  `farm_id` varchar(255) DEFAULT NULL,
  `request_method` varchar(10) NOT NULL,
  `request_url` varchar(255) NOT NULL,
  `request_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`request_data`)),
  `response_status` int(11) DEFAULT NULL,
  `response_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`response_data`)),
  `is_successful` tinyint(1) NOT NULL DEFAULT 0,
  `error_message` text DEFAULT NULL,
  `execution_time` decimal(10,6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retrieve_images`
--

CREATE TABLE `retrieve_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satellite_data`
--

CREATE TABLE `satellite_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` bigint(20) UNSIGNED NOT NULL,
  `png_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`png_data`)),
  `tif_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tif_data`)),
  `zonal_stats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`zonal_stats`)),
  `file_paths` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`file_paths`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `farm_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_masters`
--

CREATE TABLE `service_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`duration`)),
  `is_once` tinyint(1) NOT NULL DEFAULT 0,
  `service_type` enum('premium','free') NOT NULL DEFAULT 'premium',
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_masters`
--

INSERT INTO `service_masters` (`id`, `name`, `description`, `duration`, `is_once`, `service_type`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Land Area Mapping', 'Mapping of land area', '[-1]', 0, 'free', 0.00, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(2, 'Weather Forecasting', 'Provides weather forecasts', '[30]', 0, 'premium', 0.00, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(3, 'Mandi Rates', 'Provides market rates for crops', '[-1]', 0, 'free', 0.00, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(4, 'Soil Nutrient Analysis', 'Analyzes soil nutrient levels', '[30]', 1, 'premium', 400.00, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(5, 'Pests & Diseases Forewarning', 'Forewarning for pests and diseases', '[30]', 0, 'premium', NULL, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(6, 'Crop Health Analysis', 'Analyzes the health of crops', '[30]', 0, 'premium', NULL, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(7, 'Image-Based Diagnosis', 'Uses images to diagnose crop issues', '[30]', 0, 'premium', 400.00, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(8, 'Soil Moisture Estimation', 'Estimates soil moisture levels', '[30]', 0, 'premium', NULL, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(9, 'Crop Calendar', 'Provides a crop calendar', '[30]', 0, 'premium', NULL, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24'),
(10, 'Optimal Irrigation', 'Provides optimal irrigation recommendations', '[30]', 0, 'premium', NULL, 'active', '2026-09-17 10:05:24', '2026-09-17 10:05:24');

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

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `about_us` text DEFAULT NULL,
  `application_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soil_report`
--

CREATE TABLE `soil_report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `csv` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`csv`)),
  `pdf` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pdf`)),
  `recommendation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`recommendation`)),
  `remark` text DEFAULT NULL,
  `more_Info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`more_Info`)),
  `png_K` text DEFAULT NULL,
  `png_N` text DEFAULT NULL,
  `png_OC` text DEFAULT NULL,
  `png_P` text DEFAULT NULL,
  `png_pH` text DEFAULT NULL,
  `statistics_K` text DEFAULT NULL,
  `statistics_N` text DEFAULT NULL,
  `statistics_OC` text DEFAULT NULL,
  `statistics_P` text DEFAULT NULL,
  `statistics_pH` text DEFAULT NULL,
  `xyz_K` text DEFAULT NULL,
  `xyz_N` text DEFAULT NULL,
  `xyz_OC` text DEFAULT NULL,
  `xyz_P` text DEFAULT NULL,
  `xyz_pH` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_code` varchar(255) NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `subscribable_id` bigint(20) UNSIGNED NOT NULL,
  `subscribable_type` varchar(255) NOT NULL,
  `included_services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`included_services`)),
  `duration` int(11) NOT NULL,
  `starts_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `subscription_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` varchar(255) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed','cancelled','refunded','disputed','not applicable') NOT NULL DEFAULT 'pending',
  `remark` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_settelite`
--

CREATE TABLE `test_settelite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `date` bigint(20) NOT NULL,
  `png` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`png`)),
  `tif` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tif`)),
  `zonalStats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`zonalStats`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farmer_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `reg_date` varchar(255) NOT NULL DEFAULT '2026-09-17',
  `user_status` varchar(255) NOT NULL DEFAULT 'active',
  `language` varchar(5) NOT NULL DEFAULT 'en',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `wind_speed` decimal(5,2) NOT NULL,
  `cloud_cover` decimal(5,2) NOT NULL,
  `narrative` text NOT NULL,
  `precip_chance` decimal(5,2) NOT NULL,
  `precip_type` varchar(255) DEFAULT NULL,
  `qpf` decimal(5,3) NOT NULL,
  `relative_humidity` decimal(5,2) NOT NULL,
  `sunrise_time_local` date NOT NULL,
  `temperature` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`temperature`)),
  `thunder_category` varchar(255) NOT NULL,
  `valid_time_utc` bigint(20) NOT NULL,
  `wind_direction` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `advisory_responses`
--
ALTER TABLE `advisory_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advisory_submissions`
--
ALTER TABLE `advisory_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advisory_submissions_farm_id_foreign` (`farm_id`);

--
-- Indexes for table `api_usage_logs`
--
ALTER TABLE `api_usage_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_associates`
--
ALTER TABLE `business_associates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_cartable_type_cartable_id_index` (`cartable_type`,`cartable_id`),
  ADD KEY `carts_farm_id_foreign` (`farm_id`);

--
-- Indexes for table `cities_and_states`
--
ALTER TABLE `cities_and_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_farmings`
--
ALTER TABLE `contract_farmings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_calendar`
--
ALTER TABLE `crop_calendar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crop_calendar_crop_range_unique` (`crop`,`range`),
  ADD KEY `crop_calendar_crop_range_index` (`crop`,`range`),
  ADD KEY `crop_calendar_language_index` (`language`);

--
-- Indexes for table `crop_harvest_ends`
--
ALTER TABLE `crop_harvest_ends`
  ADD PRIMARY KEY (`crop`);

--
-- Indexes for table `crop_list`
--
ALTER TABLE `crop_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `error_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `farms_farm_id_unique` (`farm_id`),
  ADD KEY `farms_user_id_foreign` (`user_id`);

--
-- Indexes for table `farm_list`
--
ALTER TABLE `farm_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fpos`
--
ALTER TABLE `fpos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_advisory`
--
ALTER TABLE `image_advisory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irrigation_data`
--
ALTER TABLE `irrigation_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `irrigation_data_farm_id_foreign` (`farm_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandi_rates`
--
ALTER TABLE `mandi_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitoring_status`
--
ALTER TABLE `monitoring_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_farm_id_index` (`farm_id`),
  ADD KEY `notifications_processed_at_index` (`processed_at`),
  ADD KEY `notifications_user_id_processed_at_index` (`user_id`,`processed_at`),
  ADD KEY `notifications_type_index` (`type`);

--
-- Indexes for table `package_masters`
--
ALTER TABLE `package_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_service`
--
ALTER TABLE `package_service`
  ADD PRIMARY KEY (`package_id`,`service_id`),
  ADD KEY `package_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `password_otps`
--
ALTER TABLE `password_otps`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pest_and_diseases`
--
ALTER TABLE `pest_and_diseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pest_and_diseases_farm_id_foreign` (`farm_id`),
  ADD KEY `pest_and_diseases_language_index` (`language`);

--
-- Indexes for table `request_logs`
--
ALTER TABLE `request_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_logs_user_id_foreign` (`user_id`),
  ADD KEY `request_logs_service_name_index` (`service_name`),
  ADD KEY `request_logs_response_status_index` (`response_status`),
  ADD KEY `request_logs_farm_id_foreign` (`farm_id`);

--
-- Indexes for table `retrieve_images`
--
ALTER TABLE `retrieve_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satellite_data`
--
ALTER TABLE `satellite_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `satellite_data_farm_id_date_unique` (`farm_id`,`date`),
  ADD KEY `satellite_data_date_index` (`date`);

--
-- Indexes for table `service_masters`
--
ALTER TABLE `service_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soil_report`
--
ALTER TABLE `soil_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soil_report_farm_id_foreign` (`farm_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_subscription_code_unique` (`subscription_code`),
  ADD KEY `subscriptions_farm_id_subscribable_id_subscribable_type_index` (`farm_id`,`subscribable_id`,`subscribable_type`);

--
-- Indexes for table `test_settelite`
--
ALTER TABLE `test_settelite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advisory_responses`
--
ALTER TABLE `advisory_responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advisory_submissions`
--
ALTER TABLE `advisory_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_usage_logs`
--
ALTER TABLE `api_usage_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_associates`
--
ALTER TABLE `business_associates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities_and_states`
--
ALTER TABLE `cities_and_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract_farmings`
--
ALTER TABLE `contract_farmings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crop_calendar`
--
ALTER TABLE `crop_calendar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crop_list`
--
ALTER TABLE `crop_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `error_logs`
--
ALTER TABLE `error_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farm_list`
--
ALTER TABLE `farm_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fpos`
--
ALTER TABLE `fpos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_advisory`
--
ALTER TABLE `image_advisory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `irrigation_data`
--
ALTER TABLE `irrigation_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mandi_rates`
--
ALTER TABLE `mandi_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `monitoring_status`
--
ALTER TABLE `monitoring_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_masters`
--
ALTER TABLE `package_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pest_and_diseases`
--
ALTER TABLE `pest_and_diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_logs`
--
ALTER TABLE `request_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retrieve_images`
--
ALTER TABLE `retrieve_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satellite_data`
--
ALTER TABLE `satellite_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_masters`
--
ALTER TABLE `service_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soil_report`
--
ALTER TABLE `soil_report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_settelite`
--
ALTER TABLE `test_settelite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisory_submissions`
--
ALTER TABLE `advisory_submissions`
  ADD CONSTRAINT `advisory_submissions_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD CONSTRAINT `error_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `farms`
--
ALTER TABLE `farms`
  ADD CONSTRAINT `farms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `irrigation_data`
--
ALTER TABLE `irrigation_data`
  ADD CONSTRAINT `irrigation_data_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_service`
--
ALTER TABLE `package_service`
  ADD CONSTRAINT `package_service_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package_masters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `service_masters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD CONSTRAINT `payment_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pest_and_diseases`
--
ALTER TABLE `pest_and_diseases`
  ADD CONSTRAINT `pest_and_diseases_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`) ON DELETE CASCADE;

--
-- Constraints for table `request_logs`
--
ALTER TABLE `request_logs`
  ADD CONSTRAINT `request_logs_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `request_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `satellite_data`
--
ALTER TABLE `satellite_data`
  ADD CONSTRAINT `satellite_data_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`) ON DELETE CASCADE;

--
-- Constraints for table `soil_report`
--
ALTER TABLE `soil_report`
  ADD CONSTRAINT `soil_report_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`);


-- --------------------------------------------------------
-- Click-N-Grow / KisanSat Production Updates (October 2026)
-- --------------------------------------------------------

--
-- Table structure for table `trading_enquiries`
--
CREATE TABLE IF NOT EXISTS `trading_enquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_country_code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+91',
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_interest` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inquiry_purposes` json NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `consented_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `blog_posts`
--
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `career_applications`
--
CREATE TABLE IF NOT EXISTS `career_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `highest_qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_consent` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `gallery_items`
--
CREATE TABLE IF NOT EXISTS `gallery_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_items`
--
INSERT INTO `gallery_items` (`id`, `title`, `caption`, `image_path`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Farmers sharing field experience', 'Community gathering with local growers.', 'images/client-assets/gallery-farmer-meeting.jpg', 1, 1, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(2, 'Learning together in the field', 'A crop visit brings farmers and advisors together.', 'images/client-assets/gallery-field-visit.jpg', 1, 2, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(3, 'Farmer training session', 'A learning session focused on practical farming support.', 'images/client-assets/gallery-training.jpg', 1, 3, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(4, 'Field visit with growers', 'On-ground discussions in a cultivated field.', 'images/client-assets/gallery-farmers-in-field.jpg', 1, 4, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(5, 'Knowledge exchange with farmers', 'A community session for sharing crop guidance.', 'images/client-assets/gallery-farmer-session.jpg', 1, 5, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(6, 'Community farmer meeting', 'Growers come together for an information session.', 'images/client-assets/gallery-community-meeting.jpg', 1, 6, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(7, 'Working with farmer groups', 'A group meeting with local farming partners.', 'images/client-assets/gallery-farmer-group.jpg', 1, 7, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(8, 'Connecting growers and markets', 'A look at produce moving through local markets.', 'images/client-assets/gallery-produce-market.jpg', 1, 8, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(9, 'Team field visit', 'The team meets growers and reviews their fields.', 'images/client-assets/gallery-team-visit.jpg', 1, 9, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(10, 'Community event', 'A farmer event recognizing community participation.', 'images/client-assets/gallery-event.jpg', 1, 10, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(11, 'Workshop and discussion', 'Farmers and partners take part in a workshop.', 'images/client-assets/gallery-workshop.jpg', 1, 11, '2026-10-27 12:00:00', '2026-10-27 12:00:00'),
(12, 'Community discussion', 'A group discussion with farming partners.', 'images/client-assets/gallery-community-discussion.jpg', 1, 12, '2026-10-27 12:00:00', '2026-10-27 12:00:00')
ON DUPLICATE KEY UPDATE `id`=`id`;

--
-- Table structure for table `expert_visit_registrations`
--
CREATE TABLE IF NOT EXISTS `expert_visit_registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residential_village` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residential_taluka` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residential_district` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residential_state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residential_pincode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nearest_railway_station` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_visit_date` date NOT NULL,
  `visit_days` tinyint unsigned NOT NULL,
  `fee_per_day` int unsigned NOT NULL,
  `total_fee` int unsigned NOT NULL,
  `payment_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `razorpay_order_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_payment_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_accepted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expert_visit_registrations_reference_unique` (`reference`),
  UNIQUE KEY `expert_visit_registrations_razorpay_order_id_unique` (`razorpay_order_id`),
  UNIQUE KEY `expert_visit_registrations_razorpay_payment_id_unique` (`razorpay_payment_id`),
  KEY `expert_visit_registrations_payment_status_index` (`payment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `expert_visit_farms`
--
CREATE TABLE IF NOT EXISTS `expert_visit_farms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `registration_id` bigint unsigned NOT NULL,
  `village` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_acres` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expert_visit_farms_state_district_index` (`state`,`district`),
  KEY `expert_visit_farms_registration_id_foreign` (`registration_id`),
  CONSTRAINT `expert_visit_farms_registration_id_foreign` FOREIGN KEY (`registration_id`) REFERENCES `expert_visit_registrations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Record migrations as completed in `migrations` table
--
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2026_10_12_000001_create_trading_enquiries_table', 2),
('2026_10_25_000001_create_blog_posts_table', 2),
('2026_10_27_000000_create_career_applications_table', 2),
('2026_10_27_000001_create_gallery_items_table', 2);

COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
