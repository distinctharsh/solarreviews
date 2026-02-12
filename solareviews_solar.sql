-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2026 at 02:52 AM
-- Server version: 10.6.24-MariaDB-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solareviews_solar`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo_url`, `description`, `country`, `created_at`, `updated_at`) VALUES
(1, 'Tesla', 'tesla', 'uploads/brands/tata-power-solar-1764184763.png', NULL, 'India', '2025-11-26 13:49:23', '2025-11-26 15:12:38'),
(2, 'Luminous', 'luminous', NULL, NULL, 'India', '2025-11-26 13:49:41', '2025-11-26 13:49:41'),
(3, 'Havells', 'havells', 'uploads/brands/havells-1764184799.png', NULL, 'India', '2025-11-26 13:49:59', '2025-11-26 13:49:59'),
(4, 'Waaree', 'waaree', NULL, NULL, NULL, '2025-11-26 13:50:15', '2025-11-26 13:50:15'),
(5, 'Adani Solar', 'adani-solar', NULL, NULL, NULL, '2025-11-26 13:50:28', '2025-11-26 13:50:28'),
(6, 'Vikram Solar', 'vikram-solar', NULL, NULL, NULL, '2025-11-26 13:50:43', '2025-11-26 13:50:43'),
(7, 'HelioMax', 'heliomax', 'brands/heliomax.png', 'Mono PERC panel specialist with BIS certification.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(8, 'VoltEdge', 'voltedge', 'brands/voltedge.png', 'Hybrid inverter range with smart monitoring.', 'Germany', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(9, 'SunCraft', 'suncraft', 'brands/suncraft.png', 'Premium high-efficiency modules.', 'USA', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(10, 'BrightCell', 'brightcell', 'brands/brightcell.png', 'Lithium battery racks and BMS.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(11, 'Aquila Solar', 'aquila-solar', 'brands/aquila.png', 'String inverters with AFCI protection.', 'Spain', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(12, 'EcoRack', 'ecorack', 'brands/ecorack.png', 'Mounting and tracking hardware.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(13, 'Nimbus Charge', 'nimbus-charge', 'brands/nimbus.png', 'EV + solar hybrid controllers.', 'Singapore', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(14, 'PulseVolt', 'pulsevolt', 'brands/pulsevolt.png', 'Industrial UPS-integrated inverters.', 'Taiwan', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(15, 'Terraspan', 'terraspan', 'brands/terraspan.png', 'Ground-mount structure OEM.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(16, 'Lumiflow', 'lumiflow', 'brands/lumiflow.png', 'DC optimizers and rapid-shutdown gear.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(17, 'AegisGrid', 'aegisgrid', 'brands/aegisgrid.png', 'Utility-scale monitoring suites.', 'USA', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(18, 'Solaris PumpTech', 'solaris-pumptech', 'brands/solaris.png', 'MNRE-approved solar pump kits.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(19, 'ZenithCharge', 'zenithcharge', 'brands/zenithcharge.png', 'Battery-backed micro inverter range.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(20, 'AuroraFlex', 'auroraflex', 'brands/auroraflex.png', 'Flexible thin-film panels.', 'France', '2025-12-04 13:31:37', '2025-12-04 13:31:37'),
(21, 'GridPulse', 'gridpulse', 'brands/gridpulse.png', 'SCADA and analytics for mid-scale solar.', 'India', '2025-12-04 13:31:37', '2025-12-04 13:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `brand_category`
--

CREATE TABLE `brand_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_category`
--

INSERT INTO `brand_category` (`id`, `brand_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2025-11-26 13:49:23', '2025-11-26 13:49:23'),
(2, 2, 1, '2025-11-26 13:49:41', '2025-11-26 13:49:41'),
(3, 3, 2, '2025-11-26 13:49:59', '2025-11-26 13:49:59'),
(4, 4, 3, '2025-11-26 13:50:15', '2025-11-26 13:50:15'),
(5, 4, 1, '2025-11-26 13:50:15', '2025-11-26 13:50:15'),
(6, 5, 1, '2025-11-26 13:50:28', '2025-11-26 13:50:28'),
(7, 5, 2, '2025-11-26 13:50:28', '2025-11-26 13:50:28'),
(8, 6, 3, '2025-11-26 13:50:43', '2025-11-26 13:50:43'),
(9, 6, 1, '2025-11-26 13:50:43', '2025-11-26 13:50:43'),
(10, 6, 2, '2025-11-26 13:50:43', '2025-11-26 13:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('solarreviews_cache_state_companies_andhra-pradesh_v5', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:6;s:4:\"name\";s:23:\"Evergrid Solar Partners\";s:4:\"slug\";s:23:\"evergrid-solar-partners\";s:4:\"logo\";N;s:5:\"state\";s:14:\"Andhra Pradesh\";s:11:\"description\";s:79:\"Multi-brand dealer network providing procurement support and financing tie-ups.\";s:14:\"average_rating\";d:4.33;s:13:\"total_reviews\";i:3;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1766629480),
('solarreviews_cache_state_companies_chhattisgarh_v5', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:5;s:4:\"name\";s:16:\"HelioWave Energy\";s:4:\"slug\";s:16:\"heliowave-energy\";s:4:\"logo\";N;s:5:\"state\";s:12:\"Chhattisgarh\";s:11:\"description\";s:72:\"Tier-2 module manufacturer with BIS-certified mono PERC production line.\";s:14:\"average_rating\";d:4;s:13:\"total_reviews\";i:4;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1766629442),
('solarreviews_cache_state_companies_delhi_v5', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:4:{i:0;a:10:{s:2:\"id\";i:2;s:4:\"name\";s:5:\"Harsh\";s:4:\"slug\";s:16:\"harsh-1764242904\";s:4:\"logo\";N;s:5:\"state\";s:5:\"Delhi\";s:11:\"description\";N;s:14:\"average_rating\";d:4.67;s:13:\"total_reviews\";i:3;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}i:1;a:10:{s:2:\"id\";i:20;s:4:\"name\";s:6:\"New Me\";s:4:\"slug\";s:17:\"new-me-1765638093\";s:4:\"logo\";N;s:5:\"state\";s:5:\"Delhi\";s:11:\"description\";N;s:14:\"average_rating\";d:0;s:13:\"total_reviews\";i:0;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}i:2;a:10:{s:2:\"id\";i:21;s:4:\"name\";s:4:\"test\";s:4:\"slug\";s:15:\"test-1765648168\";s:4:\"logo\";N;s:5:\"state\";s:5:\"Delhi\";s:11:\"description\";N;s:14:\"average_rating\";d:0;s:13:\"total_reviews\";i:0;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}i:3;a:10:{s:2:\"id\";i:22;s:4:\"name\";s:5:\"Harsh\";s:4:\"slug\";s:4:\"test\";s:4:\"logo\";s:73:\"https://solarreviews.distinctharsh.com/uploads/companies/1766562351_h.jpg\";s:5:\"state\";s:5:\"Delhi\";s:11:\"description\";N;s:14:\"average_rating\";d:0;s:13:\"total_reviews\";i:0;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1767207586),
('solarreviews_cache_state_companies_gujarat_v5', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:3;s:4:\"name\";s:18:\"Sunline Renewables\";s:4:\"slug\";s:18:\"sunline-renewables\";s:4:\"logo\";N;s:5:\"state\";s:7:\"Gujarat\";s:11:\"description\";s:87:\"Ahmedabad-based EPC delivering turnkey solar rooftop plants and AMC services for MSMEs.\";s:14:\"average_rating\";d:4.33;s:13:\"total_reviews\";i:3;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1766629438),
('solarreviews_cache_state_companies_haryana_v5', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1767203172),
('solarreviews_cache_state_companies_himachal-pradesh_v5', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1767034461),
('solarreviews_cache_state_companies_ladakh_v5', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:17;s:4:\"name\";s:24:\"Skyvolt Rooftop Services\";s:4:\"slug\";s:24:\"skyvolt-rooftop-services\";s:4:\"logo\";N;s:5:\"state\";s:6:\"Ladakh\";s:11:\"description\";s:62:\"Residential-focused installer with zero-cost EMI partnerships.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:5;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1766601129),
('solarreviews_cache_state_companies_madhya-pradesh_v5', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1767040843),
('solarreviews_cache_state_companies_tamil-nadu_v5', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1766629435),
('solarreviews_cache_state_companies_telangana_v5', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:13;s:4:\"name\";s:16:\"SolarCraft Infra\";s:4:\"slug\";s:16:\"solarcraft-infra\";s:4:\"logo\";N;s:5:\"state\";s:9:\"Telangana\";s:11:\"description\";s:63:\"Handles captive solar for textile parks with remote monitoring.\";s:14:\"average_rating\";d:4.67;s:13:\"total_reviews\";i:3;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1766629425),
('solarreviews_cache_state_companies_uttar-pradesh_v5', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;a:10:{s:2:\"id\";i:8;s:4:\"name\";s:23:\"Zenith Sun Distributors\";s:4:\"slug\";s:23:\"zenith-sun-distributors\";s:4:\"logo\";N;s:5:\"state\";s:13:\"Uttar Pradesh\";s:11:\"description\";s:69:\"North India distribution hub for tier-1 inverters and energy storage.\";s:14:\"average_rating\";d:3.83;s:13:\"total_reviews\";i:6;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}i:1;a:10:{s:2:\"id\";i:11;s:4:\"name\";s:17:\"Nexsun Components\";s:4:\"slug\";s:17:\"nexsun-components\";s:4:\"logo\";N;s:5:\"state\";s:13:\"Uttar Pradesh\";s:11:\"description\";s:79:\"Pan-India wholesaler stocking rails, clamps, and balance-of-system accessories.\";s:14:\"average_rating\";d:3.5;s:13:\"total_reviews\";i:6;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1766629462),
('solarreviews_cache_test@test.comq|164.100.206.129', 'i:1;', 1766576665),
('solarreviews_cache_test@test.comq|164.100.206.129:timer', 'i:1766576665;', 1766576665);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Inverter', 'inverters', NULL, 1, 'active', '2025-11-26 13:42:18', '2025-11-26 13:42:18'),
(2, 'Panel', 'panels', NULL, 1, 'active', '2025-11-26 13:42:32', '2025-11-26 13:42:32'),
(3, 'Battery', 'batteries', NULL, 1, 'active', '2025-11-26 13:42:50', '2025-11-26 13:42:50'),
(4, 'EPC', 'epc', NULL, 1, 'active', '2025-11-26 13:44:04', '2025-11-26 13:44:04'),
(16, 'Solar Installer', 'solar-installers', 'Review the installers who put panels on your roof and help other homeowners pick the right partner.', 1, 'active', '2025-12-06 00:59:11', '2025-12-06 00:59:11'),
(17, 'Solar Panels', 'solar-panels', 'Tell us how your panels have performed, their durability, and real-world production.', 1, 'active', '2025-12-06 00:59:11', '2025-12-06 00:59:11'),
(18, 'Solar Inverter', 'solar-inverters', 'Share how reliable your inverter has been and how easy it is to monitor.', 1, 'active', '2025-12-06 00:59:11', '2025-12-06 00:59:11'),
(19, 'Battery Storage', 'battery-storage', 'Let others know how your storage system performs during outages and daily cycling.', 1, 'active', '2025-12-06 00:59:11', '2025-12-06 00:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_options`
--

CREATE TABLE `chatbot_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `next_question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_options`
--

INSERT INTO `chatbot_options` (`id`, `question_id`, `label`, `value`, `description`, `display_order`, `next_question_id`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 1, 'Find top installers in my area', 'installer_help', 'Compare verified EPC and installer companies', 1, 2, NULL, '2025-11-28 13:28:34', '2025-11-28 13:28:34'),
(2, 1, 'Report an issue with my current solar setup', 'troubleshoot_system', 'Panels, inverter, battery, or monitoring issue', 2, 2, NULL, '2025-11-28 13:28:34', '2025-11-28 13:28:34'),
(3, 1, 'Get advice on solar products or financing', 'product_advice', 'Panels, inverters, warranties, or loan info', 3, 2, NULL, '2025-11-28 13:28:34', '2025-11-28 13:28:34'),
(4, 4, 'Submit another query', 'another_query', 'Restart the assistant flow', 1, 1, NULL, '2025-11-28 13:28:34', '2025-11-28 13:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_questions`
--

CREATE TABLE `chatbot_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `prompt` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'choice',
  `is_required` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `input_placeholder` varchar(255) DEFAULT NULL,
  `input_validation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`input_validation`)),
  `default_next_question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_questions`
--

INSERT INTO `chatbot_questions` (`id`, `title`, `prompt`, `type`, `is_required`, `is_active`, `display_order`, `input_placeholder`, `input_validation`, `default_next_question_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Welcome Prompt', 'Hi! I am the Solar Reviews assistant. What would you like help with today?', 'choice', 1, 1, 1, NULL, NULL, 2, '2025-11-28 13:28:34', '2025-11-28 13:28:34', NULL),
(2, 'State Selection', 'Great! Which state are you located in?', 'input', 1, 1, 2, 'e.g. Maharashtra', NULL, 3, '2025-11-28 13:28:34', '2025-11-28 13:28:34', NULL),
(3, 'Issue Details', 'Please describe your requirement or issue in a sentence or two.', 'text', 1, 1, 3, 'Tell us about your solar project or problem', NULL, 5, '2025-11-28 13:28:34', '2026-01-05 05:56:56', NULL),
(4, 'Thank You', 'Thank you! Our team will review your message and get back with the best installers or advice.', 'choice', 0, 1, 7, NULL, NULL, NULL, '2025-11-28 13:28:34', '2026-01-05 05:58:24', NULL),
(5, 'Name', 'Please enter your name', 'input', 1, 1, 4, 'Name', NULL, 6, '2026-01-05 05:48:03', '2026-01-05 05:57:49', NULL),
(6, 'Email', 'Please enter your email', 'input', 1, 1, 5, 'Email', NULL, 7, '2026-01-05 05:49:58', '2026-01-05 05:57:59', NULL),
(7, 'Phone Number', 'Please enter your phone number', 'phone', 1, 1, 6, NULL, NULL, 4, '2026-01-05 05:50:54', '2026-01-05 05:58:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_user_messages`
--

CREATE TABLE `chatbot_user_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender` varchar(255) NOT NULL DEFAULT 'user',
  `input_value` text DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payload`)),
  `sequence` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_user_messages`
--

INSERT INTO `chatbot_user_messages` (`id`, `session_id`, `question_id`, `option_id`, `sender`, `input_value`, `payload`, `sequence`, `created_at`, `updated_at`) VALUES
(6883, 6808, NULL, NULL, 'system', NULL, '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T11:18:08+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:18:17+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Harsh\"}}}]}', 1, '2026-01-05 05:48:18', '2026-01-05 05:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_user_sessions`
--

CREATE TABLE `chatbot_user_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visitor_uuid` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `context` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`context`)),
  `started_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_user_sessions`
--

INSERT INTO `chatbot_user_sessions` (`id`, `user_id`, `visitor_uuid`, `source`, `status`, `context`, `started_at`, `ended_at`, `created_at`, `updated_at`) VALUES
(6806, NULL, 'dfe33553-0eaa-4fa0-8a6f-3a0737f99d41', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-04T06:27:16+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-04T06:27:18+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":2,\"option_label\":\"Report an issue with my current solar setup\",\"option_value\":\"troubleshoot_system\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-04T06:27:19+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-04T06:27:24+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-04T06:27:24+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-04T06:27:31+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Solar EPC\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-04T06:27:31+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-04 00:57:16', NULL, '2026-01-04 00:57:16', '2026-01-04 00:57:31'),
(6807, NULL, 'e9fcaa25-c0a0-416e-a05a-169e93c62adf', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T04:07:41+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-05T04:07:50+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":3,\"option_label\":\"Get advice on solar products or financing\",\"option_value\":\"product_advice\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T04:07:50+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T04:07:56+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T04:07:56+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T04:08:06+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Solar Panel\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T04:08:06+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T04:08:21+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"answer\":{\"option_id\":4,\"option_label\":\"Submit another query\",\"option_value\":\"another_query\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T04:08:21+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T04:08:24+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":1,\"option_label\":\"Find top installers in my area\",\"option_value\":\"installer_help\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T04:08:24+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T04:08:28+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T04:08:29+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T04:08:36+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Solar Panels\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T04:08:36+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-04 22:37:41', NULL, '2026-01-04 22:37:41', '2026-01-04 22:38:36'),
(6808, NULL, '44908b82-d4a9-4be5-9410-b5b67576ab0b', 'website', 'completed', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T11:18:08+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:18:17+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Harsh\"}}}]}', '2026-01-05 05:48:08', '2026-01-05 05:48:20', '2026-01-05 05:48:08', '2026-01-05 05:48:20'),
(6809, NULL, 'ebc109ef-0960-48f0-9e18-9a53828efd7b', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T11:18:52+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:18:56+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Harsh\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:18:56+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-05 05:48:52', NULL, '2026-01-05 05:48:52', '2026-01-05 05:48:56'),
(6810, NULL, 'e3b2b0be-73b0-4022-b363-93fb89d3175c', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T11:20:58+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:03+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Harsh\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:03+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:11+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"distinctharsh@gmail.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:11+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:11+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":3,\"option_label\":\"Get advice on solar products or financing\",\"option_value\":\"product_advice\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:11+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}}]}', '2026-01-05 05:50:58', NULL, '2026-01-05 05:50:58', '2026-01-05 05:51:11'),
(6811, NULL, '8c3290be-af82-4087-abd1-f50083be028c', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:32+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:36+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Harsh\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:37+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:45+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"distinctharsh@gmail.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:46+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:52+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"7840091293\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:52+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:54+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":1,\"option_label\":\"Find top installers in my area\",\"option_value\":\"installer_help\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:54+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:21:59+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:21:59+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}}]}', '2026-01-05 05:51:30', NULL, '2026-01-05 05:51:30', '2026-01-05 05:51:59'),
(6812, NULL, 'da629b34-4849-40b6-86cb-9f7daccce332', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T11:27:20+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}}]}', '2026-01-05 05:57:19', NULL, '2026-01-05 05:57:19', '2026-01-05 05:57:20'),
(6813, NULL, '279156d3-7c37-4ad0-9cd3-105a63c6a2ee', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-05T11:28:29+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:28:31+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":2,\"option_label\":\"Report an issue with my current solar setup\",\"option_value\":\"troubleshoot_system\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:28:31+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:28:36+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:28:36+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:28:48+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Panel not working\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:28:48+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:28:52+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Harsh\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:28:52+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:28:59+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"distinctharsh@gmail.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:28:59+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-05T11:29:03+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"7840091293\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-05T11:29:03+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-05 05:58:29', NULL, '2026-01-05 05:58:29', '2026-01-05 05:59:03'),
(6814, NULL, 'ea0f6f39-bf98-4c09-92d5-5632bfd24883', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-07T12:52:30+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-07 07:22:30', NULL, '2026-01-07 07:22:30', '2026-01-07 07:22:30'),
(6815, NULL, '3d29de36-1336-4c8c-87e7-87c4a55b1330', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-09T09:40:21+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-09 04:10:17', NULL, '2026-01-09 04:10:17', '2026-01-09 04:10:21'),
(6816, NULL, '5074f631-2578-4840-ba3b-0579e11695d2', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-09T18:12:47+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-09T18:12:49+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":2,\"option_label\":\"Report an issue with my current solar setup\",\"option_value\":\"troubleshoot_system\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-09T18:12:50+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}}]}', '2026-01-09 12:42:47', NULL, '2026-01-09 12:42:47', '2026-01-09 12:42:50'),
(6817, NULL, '6c40b6b3-8e97-411a-b2f6-123062716085', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T07:37:17+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 02:07:14', NULL, '2026-01-10 02:07:15', '2026-01-10 02:07:17'),
(6818, NULL, '2388a878-f416-4bf1-8ccb-d29fd832b12f', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T07:43:16+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 02:13:10', NULL, '2026-01-10 02:13:10', '2026-01-10 02:13:16'),
(6819, NULL, '58fda20d-c682-4157-b4f4-73209f68d818', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T08:07:23+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 02:37:18', NULL, '2026-01-10 02:37:18', '2026-01-10 02:37:23'),
(6820, NULL, 'cde51bcc-56a0-40f3-8611-7254779da222', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T08:11:26+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:11:35+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":3,\"option_label\":\"Get advice on solar products or financing\",\"option_value\":\"product_advice\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:11:35+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:13:05+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Gurgaon\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:13:06+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T09:21:57+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Need best epc\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T09:21:58+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T09:22:16+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Abc\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T09:22:16+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T09:22:52+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"project@dexter-chem.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T09:22:52+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T09:23:00+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"9205611520\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T09:23:00+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-10 02:41:26', NULL, '2026-01-10 02:41:26', '2026-01-10 03:53:00'),
(6821, NULL, '7d49c705-6289-48b2-9784-eecc7a68e387', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T08:11:26+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:11:33+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":1,\"option_label\":\"Find top installers in my area\",\"option_value\":\"installer_help\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:11:33+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:11:37+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:11:37+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:11:41+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Panel\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:11:42+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:12:28+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Deepak Chauhan\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:12:31+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:12:44+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"deepak@orangemedialabs.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:12:46+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-10T08:12:51+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"9990093303\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T08:12:52+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-10 02:41:26', NULL, '2026-01-10 02:41:26', '2026-01-10 02:42:52'),
(6822, NULL, '3bc3bb81-dd7c-4c28-b980-c825cdb46775', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T08:36:43+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 03:06:42', NULL, '2026-01-10 03:06:42', '2026-01-10 03:06:43'),
(6823, NULL, '8b32cb41-c84c-409a-bd14-b64ef9f88f9f', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T08:50:01+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 03:20:01', NULL, '2026-01-10 03:20:01', '2026-01-10 03:20:01'),
(6824, NULL, '4d2622b3-a89a-42af-8c9f-0f537e80d0ae', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T09:21:00+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-10T09:22:08+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":2,\"option_label\":\"Report an issue with my current solar setup\",\"option_value\":\"troubleshoot_system\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-10T09:22:08+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}}]}', '2026-01-10 03:51:00', NULL, '2026-01-10 03:51:00', '2026-01-10 03:52:08'),
(6825, NULL, '697ddd47-d433-4de1-bcc2-eb1d63a74bcc', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T09:30:11+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 04:00:11', NULL, '2026-01-10 04:00:11', '2026-01-10 04:00:11'),
(6826, NULL, 'de01ecd8-b691-4b60-b864-8b749927bdd5', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T09:35:59+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 04:05:58', NULL, '2026-01-10 04:05:58', '2026-01-10 04:05:59'),
(6827, NULL, '09783794-7296-4a11-816f-d0532bfae5ac', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T09:56:38+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 04:26:37', NULL, '2026-01-10 04:26:37', '2026-01-10 04:26:38'),
(6828, NULL, 'c98292e4-7bd0-4a16-b517-629fdbda194a', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T10:52:54+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 05:22:54', NULL, '2026-01-10 05:22:54', '2026-01-10 05:22:54'),
(6829, NULL, '6add49b8-5a23-4a8a-b6f9-7ff3a3a53131', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-10T10:52:55+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-10 05:22:54', NULL, '2026-01-10 05:22:54', '2026-01-10 05:22:55'),
(6830, NULL, '68aad421-9191-4f7f-b153-929ae44dd2a5', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-12T06:55:05+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-12 01:25:03', NULL, '2026-01-12 01:25:03', '2026-01-12 01:25:05'),
(6831, NULL, '3e64aba9-e0ab-4042-a486-0ac79abaf9d7', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-15T05:00:07+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-15T05:00:15+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":1,\"option_label\":\"Find top installers in my area\",\"option_value\":\"installer_help\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-15T05:00:16+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-15T05:00:23+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-15T05:00:23+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-15T05:00:33+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Test\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-15T05:00:34+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-15T05:00:40+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Harsh\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-15T05:00:41+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-15T05:00:53+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"distinctharsh@gmail.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-15T05:00:55+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-15T05:01:04+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"7840091293\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-15T05:01:04+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-14 23:30:07', NULL, '2026-01-14 23:30:07', '2026-01-14 23:31:04'),
(6832, NULL, 'f9e27ca4-9f16-47e9-bb6e-bf5fdc71ff86', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-19T02:22:45+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-19T02:22:50+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":3,\"option_label\":\"Get advice on solar products or financing\",\"option_value\":\"product_advice\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-19T02:22:50+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-19T02:23:06+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Haryana\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-19T02:23:06+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-19T02:23:17+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Resindential\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-19T02:23:17+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-19T02:23:28+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Rakesh\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-19T02:23:28+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-19T02:23:50+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"rakesh.mehta4@gmail.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-19T02:23:50+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-19T02:23:56+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"9654013171\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-19T02:23:56+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-01-18 20:52:45', NULL, '2026-01-18 20:52:45', '2026-01-18 20:53:56'),
(6833, NULL, 'c446cbe5-b72f-4d44-9cd6-4c34b633da70', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-22T13:44:32+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-01-22T13:44:39+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":1,\"option_label\":\"Find top installers in my area\",\"option_value\":\"installer_help\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-01-22T13:44:39+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-01-22T13:44:51+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Maharashta\"}}},{\"sender\":\"bot\",\"at\":\"2026-01-22T13:44:51+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}}]}', '2026-01-22 08:14:31', NULL, '2026-01-22 08:14:32', '2026-01-22 08:14:51'),
(6834, NULL, '4ef28be3-2c88-4f93-91f5-172f459d11b2', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-01-22T13:45:02+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-01-22 08:15:02', NULL, '2026-01-22 08:15:02', '2026-01-22 08:15:02'),
(6835, NULL, '4e2aee34-bebb-4ad0-a5ab-248cc9e7ee8c', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-02-02T00:31:43+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-02-01 19:01:39', NULL, '2026-02-01 19:01:40', '2026-02-01 19:01:43'),
(6836, NULL, 'b79342f7-9f1b-4479-820e-4ad1572faced', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-02-02T00:33:18+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-02-01 19:03:17', NULL, '2026-02-01 19:03:17', '2026-02-01 19:03:18');
INSERT INTO `chatbot_user_sessions` (`id`, `user_id`, `visitor_uuid`, `source`, `status`, `context`, `started_at`, `ended_at`, `created_at`, `updated_at`) VALUES
(6837, NULL, 'b2cc1eb8-0db1-403f-bdfa-e548261f828a', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-02-02T00:33:53+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-02-01 19:03:53', NULL, '2026-02-01 19:03:53', '2026-02-01 19:03:53'),
(6838, NULL, 'aae98bac-96b4-466a-8d0f-f0eb255e607a', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-02-08T14:45:32+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}}]}', '2026-02-08 09:15:32', NULL, '2026-02-08 09:15:32', '2026-02-08 09:15:32'),
(6839, NULL, 'b8d48122-8050-4dd7-a6b1-1a241da54818', 'website', 'active', '{\"transcript\":[{\"sender\":\"bot\",\"at\":\"2026-02-08T14:45:32+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"options\":[{\"id\":1,\"label\":\"Find top installers in my area\",\"value\":\"installer_help\"},{\"id\":2,\"label\":\"Report an issue with my current solar setup\",\"value\":\"troubleshoot_system\"},{\"id\":3,\"label\":\"Get advice on solar products or financing\",\"value\":\"product_advice\"}]}},{\"sender\":\"user\",\"at\":\"2026-02-08T14:45:36+00:00\",\"payload\":{\"question\":{\"id\":1,\"title\":\"Welcome Prompt\",\"prompt\":\"Hi! I am the Solar Reviews assistant. What would you like help with today?\",\"type\":\"choice\"},\"answer\":{\"option_id\":1,\"option_label\":\"Find top installers in my area\",\"option_value\":\"installer_help\",\"input_value\":null}}},{\"sender\":\"bot\",\"at\":\"2026-02-08T14:45:36+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-02-08T14:45:43+00:00\",\"payload\":{\"question\":{\"id\":2,\"title\":\"State Selection\",\"prompt\":\"Great! Which state are you located in?\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Delhi\"}}},{\"sender\":\"bot\",\"at\":\"2026-02-08T14:45:43+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-02-08T14:45:50+00:00\",\"payload\":{\"question\":{\"id\":3,\"title\":\"Issue Details\",\"prompt\":\"Please describe your requirement or issue in a sentence or two.\",\"type\":\"text\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Residential\"}}},{\"sender\":\"bot\",\"at\":\"2026-02-08T14:45:50+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-02-08T14:45:56+00:00\",\"payload\":{\"question\":{\"id\":5,\"title\":\"Name\",\"prompt\":\"Please enter your name\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Hello\"}}},{\"sender\":\"bot\",\"at\":\"2026-02-08T14:45:56+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-02-08T14:46:09+00:00\",\"payload\":{\"question\":{\"id\":6,\"title\":\"Email\",\"prompt\":\"Please enter your email\",\"type\":\"input\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"Hello@gmail.com\"}}},{\"sender\":\"bot\",\"at\":\"2026-02-08T14:46:09+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"options\":[]}},{\"sender\":\"user\",\"at\":\"2026-02-08T14:46:20+00:00\",\"payload\":{\"question\":{\"id\":7,\"title\":\"Phone Number\",\"prompt\":\"Please enter your phone number\",\"type\":\"phone\"},\"answer\":{\"option_id\":null,\"option_label\":null,\"option_value\":null,\"input_value\":\"9863251758\"}}},{\"sender\":\"bot\",\"at\":\"2026-02-08T14:46:20+00:00\",\"payload\":{\"question\":{\"id\":4,\"title\":\"Thank You\",\"prompt\":\"Thank you! Our team will review your message and get back with the best installers or advice.\",\"type\":\"choice\"},\"options\":[]}}]}', '2026-02-08 09:15:32', NULL, '2026-02-08 09:15:32', '2026-02-08 09:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 14, 'Mumbai', 'mumbai', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(2, 14, 'Pune', 'pune', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(3, 14, 'Nagpur', 'nagpur', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(4, 14, 'Nashik', 'nashik', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(5, 14, 'Aurangabad', 'aurangabad', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(6, 7, 'Ahmedabad', 'ahmedabad', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(7, 7, 'Surat', 'surat', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(8, 7, 'Vadodara', 'vadodara', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(9, 7, 'Rajkot', 'rajkot', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(10, 7, 'Bhavnagar', 'bhavnagar', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(11, 21, 'Jaipur', 'jaipur', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(12, 21, 'Jodhpur', 'jodhpur', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(13, 21, 'Udaipur', 'udaipur', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(14, 21, 'Kota', 'kota', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(15, 21, 'Bikaner', 'bikaner', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(16, 11, 'Bengaluru', 'bengaluru', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(17, 11, 'Mysuru', 'mysuru', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(18, 11, 'Mangaluru', 'mangaluru', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(19, 11, 'Hubballi', 'hubballi', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(20, 11, 'Belagavi', 'belagavi', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(21, 23, 'Chennai', 'chennai', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(22, 23, 'Coimbatore', 'coimbatore', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(23, 23, 'Madurai', 'madurai', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(24, 23, 'Tiruchirappalli', 'tiruchirappalli', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(25, 23, 'Salem', 'salem', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(26, 26, 'Lucknow', 'lucknow', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(27, 26, 'Kanpur', 'kanpur', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(28, 26, 'Varanasi', 'varanasi', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(29, 26, 'Noida', 'noida', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(30, 26, 'Agra', 'agra', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(31, 32, 'New Delhi', 'new-delhi', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(32, 32, 'Dwarka', 'dwarka', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(33, 32, 'Rohini', 'rohini', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(34, 32, 'Saket', 'saket', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(35, 32, 'Karol Bagh', 'karol-bagh', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(36, 24, 'Hyderabad', 'hyderabad', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(37, 24, 'Warangal', 'warangal', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(38, 24, 'Nizamabad', 'nizamabad', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(39, 24, 'Karimnagar', 'karimnagar', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(40, 24, 'Khammam', 'khammam', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(41, 28, 'Kolkata', 'kolkata', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(42, 28, 'Howrah', 'howrah', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(43, 28, 'Durgapur', 'durgapur', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(44, 28, 'Siliguri', 'siliguri', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(45, 28, 'Asansol', 'asansol', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(46, 13, 'Bhopal', 'bhopal', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(47, 13, 'Indore', 'indore', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(48, 13, 'Gwalior', 'gwalior', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(49, 13, 'Jabalpur', 'jabalpur', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39'),
(50, 13, 'Ujjain', 'ujjain', 1, '2025-11-26 14:50:39', '2025-11-26 14:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `company_type` enum('manufacturer','distributor','dealer','installer','wholesaler','retailer','epc') NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `email` varchar(255) DEFAULT NULL,
  `years_in_business` int(10) UNSIGNED DEFAULT NULL,
  `gst_number` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `owner_id`, `slug`, `company_type`, `owner_name`, `phone`, `website_url`, `logo_url`, `description`, `status`, `email`, `years_in_business`, `gst_number`, `address`, `city`, `pincode`, `state_id`, `city_id`, `is_active`, `is_verified`, `created_at`, `updated_at`) VALUES
(177, NULL, 'silres_energy_solutions_private_limited', 'distributor', 'SILRES ENERGY SOLUTIONS PRIVATE LIMITED', '9789811899', NULL, NULL, NULL, 'active', '[silres@feniceenergy.com](mailto:silres@feniceenergy.com)', NULL, 'ABCCS7137A', '30/5, First Floor, 1st Cross Street, Raja Annamalai Puram, Chennai 600028', 'Chennai', '600028', 23, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(178, NULL, 'amplus_kn_one_power_pvt_ltd', 'distributor', 'Amplus KN One Power Pvt Ltd', '8818812976', NULL, NULL, NULL, 'active', '[hstenders@amplussolar.com](mailto:hstenders@amplussolar.com)', NULL, 'AAPCA6307E', 'A-57 DDA Sheds Okhla Industrial Area Phase-2 New Delhi-110020', 'New Delhi', '110020', 32, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(179, NULL, 'suntek_energy_systems_private_limited', 'distributor', 'SUNTEK ENERGY SYSTEMS PRIVATE LIMITED', '9030032222', NULL, NULL, NULL, 'active', '[suresh@suntek.co.in](mailto:suresh@suntek.co.in)', NULL, 'AATCS9217K', 'Plot No-77, 2nd Floor, Subhodaya Colony, Jashu Society, Allwyn Colony Road, Kukatpally, Hyderabad -500072', 'Hyderabad', '500072', 24, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(180, NULL, 'eastern_light_and_power_pvt_ltd', 'distributor', 'EASTERN LIGHT AND POWER PVT. LTD.', '9818230950', NULL, NULL, NULL, 'active', '[netmetering@itsmysun.com](mailto:netmetering@itsmysun.com)', NULL, 'AAECE0573H', '8th Floor, 817-818, Assotech Business Cresterra, Tower-1, Plot No 22, Sector 135, Noida 201301, Uttar Pradesh', 'Noida', '201301', 26, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(181, NULL, 'ghanpriya_energy_solution_private_limited', 'distributor', 'GHANPRIYA ENERGY SOLUTION PRIVATE LIMITED', '9110960721', NULL, NULL, NULL, 'active', '[info@ghanpriyaenergy.com](mailto:info@ghanpriyaenergy.com)', NULL, 'AAGCG7777D', 'Ghanpriya Energy Solution Pvt. Ltd., 148 1, Opposite Peepal Kuan, Mandi Village, New Delhi 110047', 'New Delhi', '110047', 32, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(182, NULL, 'mn_energy_and_infra_private_limited', 'distributor', 'MN ENERGY AND INFRA PRIVATE LIMITED', '9971933844', NULL, NULL, NULL, 'active', '[info@themiecl.com](mailto:info@themiecl.com)', NULL, 'AAPCM0224L', 'Plot No 142 Kakrola Housing Complex Dwarka New Delhi 110078', 'New Delhi', '110078', 32, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(183, NULL, 'sun_astra_energy_solutions_private_limited', 'distributor', 'SUN ASTRA ENERGY SOLUTIONS PRIVATE LIMITED', '9888877655', NULL, NULL, NULL, 'active', '[info@sunastra.com](mailto:info@sunastra.com)', NULL, 'AAVCS5983J', 'Plot No 58 Industrial Area Phase 2 Panchkula Haryana 134113', 'Panchkula', '134113', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(184, NULL, 'gac_energy_and_automation_private_limited', 'distributor', 'GAC ENERGY & AUTOMATION PRIVATE LIMITED', '9818739011', NULL, NULL, NULL, 'active', '[gacgroup1991@gmail.com](mailto:gacgroup1991@gmail.com)', NULL, 'AAACG3479Q', 'C-2/1, 3rd Floor, Church Compound, Sukhdev Vihar, New Delhi-110025', 'New Delhi', '110025', 32, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(185, NULL, 'sunglow_electric_power_p_ltd', 'distributor', 'M/s Sunglow Electric Power (P) Ltd.', '9996636540', NULL, NULL, NULL, 'active', '[sunglowelectricpower@gmail.com](mailto:sunglowelectricpower@gmail.com)', NULL, 'AAYCS4533K', 'NH-148B, Near Baba Ghisa Ram Filling Station, Pali, Mohendergarh', 'Mohendergarh', '000000', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(186, NULL, 'suntrik_solutions', 'distributor', 'M/s Suntrik Solutions', '9354214625', NULL, NULL, NULL, 'active', '[rajat@suntrik.com](mailto:rajat@suntrik.com)', NULL, 'ADTFS9494E', 'Rania Bazar Sirsa 125055', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(187, NULL, 'xpanz_energy_solutions_llp', 'distributor', 'Xpanz Energy Solutions LLP', '9873326193', NULL, NULL, NULL, 'active', '[xpanzsolar@gmail.com](mailto:xpanzsolar@gmail.com)', NULL, 'AAAFX1751H', '314, Plot No - P2, JOP Plaza, Noida, Uttar Pradesh - 201301', 'Noida', '201301', 26, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(188, NULL, 'jm_power_technologies_p_ltd', 'distributor', 'M/s J.M. Power Technologies (P) Ltd.', '9518837560', NULL, NULL, NULL, 'active', '[contact@jmpowertech.com](mailto:contact@jmpowertech.com)', NULL, 'AADCJ9015A', 'Plot No 122 Ind Area Hisar Road Sirsa Haryana 125055', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(189, NULL, 'nexa_solar_p_ltd', 'distributor', 'M/s Nexa Solar (P) Ltd.', '9992871234', NULL, NULL, NULL, 'active', '[nexasolar16@gmail.com](mailto:nexasolar16@gmail.com)', NULL, 'AAFCN2241N', 'SCO 380 Mughal Canal Karnal 132001', 'Karnal', '132001', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(190, NULL, 'maven_solar_p_ltd', 'distributor', 'M/s Maven Solar (P) Ltd.', '9671799866', NULL, NULL, NULL, 'active', '[info@mavensolar.com](mailto:info@mavensolar.com)', NULL, 'AALCM5084C', '342 29 Ram Gopal Colony Opp TVS Showroom Rohtak 124001 Haryana', 'Rohtak', '124001', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(191, NULL, 'future_green_power_solution_p_ltd', 'distributor', 'M/s Future Green Power Solution (P) Ltd.', '7597271656', NULL, NULL, NULL, 'active', '[fgps.solar@gmail.com](mailto:fgps.solar@gmail.com)', NULL, 'AACCF6855B', 'Plot No 92 Gandhi Path Karne Nagar Jaipur Rajasthan 302034', 'Jaipur', '302034', 21, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(192, NULL, 'himalayan_solar_pvt_ltd', 'distributor', 'M/s Himalayan Solar Pvt. Ltd.', '7027794870', NULL, NULL, NULL, 'active', '[clientmanager@himalayansolar.co.in](mailto:clientmanager@himalayansolar.co.in)', NULL, 'AADCH6953K', 'Plot No 237 HSIIDC Industrial Estate Alipur Barwala Panchkula 134118', 'Panchkula', '134118', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(193, NULL, 'divy_power_pvt_ltd', 'distributor', 'Divy Power Pvt. Ltd.', '7065028803', NULL, NULL, NULL, 'active', '[admin@divypower.com](mailto:admin@divypower.com)', NULL, 'AACCD8041P', '53, Ramte ram road ghaziabad up', 'Ghaziabad', '000000', 26, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(194, NULL, 'divine_energies_solutions', 'distributor', 'Divine Energies Solutions', '8684911110', NULL, NULL, NULL, 'active', '[nishant@divineenergies.com](mailto:nishant@divineenergies.com)', NULL, 'HRYPS9868C', 'H No 402 Metropolis Mall Opp Mid Town Grand Hisar 125001', 'Hisar', '125001', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(195, NULL, 'divvy_solare_power_and_solutions_pvt_ltd', 'distributor', 'M/s Divvy Solare Power & Solutions Pvt. Ltd.', '8901077120', NULL, NULL, NULL, 'active', '[dhananjay@divvysolar.in](mailto:dhananjay@divvysolar.in)', NULL, 'AAGCD6490E', 'Lower Ground SJ Tower Sector 13 Tosham Road Hisar 125001 Haryana', 'Hisar', '125001', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(196, NULL, 'blueneba_technologies_pvt_ltd', 'distributor', 'BLUENEBA TECHNOLOGIES PVT LTD', '9999277000', NULL, NULL, NULL, 'active', '[info@blueneba.com](mailto:info@blueneba.com)', NULL, 'AAHCB9965D', 'Unit No. 916, Vipul Business Park, Sohna Road Sector 48 Gurugram Haryana 122018', 'Gurugram', '122018', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(197, NULL, 'electromech_devices_manufacturing_company', 'distributor', 'ELECTROMECH DEVICES MANUFACTURING COMPANY', '9893786088', NULL, NULL, NULL, 'active', '[edmc.rp@gmail.com](mailto:edmc.rp@gmail.com)', NULL, 'AAAFE6217F', 'A-09, Ground Floor, Mahavir Goushala Complex, K.K.Road, Moudhapara, Raipur, Chhattisgarh, 492001', 'Raipur', '492001', 5, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(198, NULL, 'solarium_green_energy_limited', 'distributor', 'Solarium Green Energy Limited', '9099051501', NULL, NULL, NULL, 'active', '[nitin@solariumenergy.in](mailto:nitin@solariumenergy.in)', NULL, 'ABHCS9467Q', 'Survey MP. 319/3 Paiki, At Bhamsara, Bavla, Bavla, Bhamsara, Ahmedabad, Gujrat 382240', 'Ahmedabad', '382240', 7, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(199, NULL, 'sonic_energy_solutions_llp', 'distributor', 'SONIC ENERGY SOLUTIONS LLP', '9053004701', NULL, NULL, NULL, 'active', '[SONICENERGYSOLUTION@GMAIL.COM](mailto:SONICENERGYSOLUTION@GMAIL.COM)', NULL, 'AESFS9744M', 'Shop No 3 Near Bhagwati Mandir Mahesh Nagar Ambala Cantt', 'Ambala', '000000', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(200, NULL, 'inter_solar_systems_pvt_ltd', 'distributor', 'Inter solar systems PVT. LTD', '9357834139', NULL, NULL, NULL, 'active', '[info@intersolarsystems.com](mailto:info@intersolarsystems.com)', NULL, 'AAACI8132J', 'Plot No. 901-A Industrial area Phase-2 Chandigarh', 'Chandigarh', '000000', 30, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(201, NULL, 'shree_solar_venture_pvt_ltd', 'distributor', 'SHREE SOLAR VENTURE PVT LTD', '9571211118', NULL, NULL, NULL, 'active', '[shreesolarventure@gmail.com](mailto:shreesolarventure@gmail.com)', NULL, 'AAXCS5585Q', 'Bikaner', 'Bikaner', '000000', 21, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(202, NULL, 'jm_solar_farmer_renewable_energy_pvt_ltd', 'distributor', 'JM Solar Farmer Renewable Energy Pvt. Ltd.', '9991114686', NULL, NULL, NULL, 'active', '[info.solarfarmer@gmail.com](mailto:info.solarfarmer@gmail.com)', NULL, 'AAFCJ7440P', 'Shop No 15A Sector 7 Bahadurgarh District Jhajjar Haryana 124507', 'Bahadurgarh', '124507', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(203, NULL, 'thapson_systems_pvt_ltd', 'distributor', 'Thapson Systems Pvt. Ltd.', '9254107926', NULL, NULL, NULL, 'active', '[contact@thapson.com](mailto:contact@thapson.com)', NULL, 'AAACT7164K', 'H NO 1062 SEC 6 URBAN ESTATE KARNAL, 132001, HARYANA', 'Karnal', '132001', 8, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(204, NULL, 'v_guard_industries_limited', 'distributor', 'V-GUARD INDUSTRIES LIMITED', '8384012757', NULL, NULL, NULL, 'active', '[manikuttan@vguard.in](mailto:manikuttan@vguard.in)', NULL, 'AAACV5492Q', '42/962, VENNALA HIGH SCHOOL ROAD, VENNALA P O, ERNAKULAM - 682028, KERALA', 'Ernakulam', '682028', 12, NULL, 1, 0, '2026-01-26 14:48:41', '2026-01-26 14:48:41'),
(205, NULL, 'birkan_engineering_industries_pvt_ltd_s', 'distributor', 'Birkan Engineering Industries Pvt. Ltd. (S)', '9999258328', NULL, NULL, NULL, 'active', '[robinmukesh@birkanengg.com](mailto:robinmukesh@birkanengg.com)', NULL, 'AABCB8310J', 'S-4,6,8 and 10 Site IV, Sahibabad Industrial Area, Ghaziabad, Uttar Pradesh', 'Ghaziabad', '201010', 26, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(206, NULL, 'arm_renewables_s', 'distributor', 'ARM RENEWABLES (S)', '9344600003', NULL, NULL, NULL, 'active', '[raghav@armrenewables.com](mailto:raghav@armrenewables.com)', NULL, 'ABNFA5408J', 'Plot Cum Shop 21/28, 1st Industrial Area, Near Ashoka Rice Mill, Sirsa, Haryana', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(207, NULL, 'fidus_energy_pvt_ltd_s', 'distributor', 'Fidus Energy Pvt. Ltd. (S)', '8860201196', NULL, NULL, NULL, 'active', '[fidusenergy@gmail.com](mailto:fidusenergy@gmail.com)', NULL, 'AADCF2574L', '713/5, Firoz Gandhi Colony, Near Sector 4-7-9 Chowk, Gurugram', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(208, NULL, 'ramji_dass_om_parkash_s', 'distributor', 'Ramji Dass Om Parkash (S)', '9068672843', NULL, NULL, NULL, 'active', '[ramjidassomparkash1@gmail.com](mailto:ramjidassomparkash1@gmail.com)', NULL, 'ADQPB9824Q', 'Chinni Market, Near SBI Bank, Railway Road, Tohana', 'Tohana', '125120', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(209, NULL, 'zunroof_tech_pvt_ltd_n', 'distributor', 'Zunroof Tech Pvt Ltd (N)', '8448389952', NULL, NULL, NULL, 'active', '[gosolar@zunroof.com](mailto:gosolar@zunroof.com)', NULL, 'AAACZ9608E', '6th Floor, Paras Trinity, Sector 63, Gurugram, Haryana', 'Gurugram', '122011', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(210, NULL, 'sach_collection_point_s', 'distributor', 'Sach Collection Point (S)', '9555355131', NULL, NULL, NULL, 'active', '[sachsolar@yahoo.com](mailto:sachsolar@yahoo.com)', NULL, 'BKTPR0984E', '1789/3, Rajeev Nagar, Near Shiv Mandir, Gurugram', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(211, NULL, 'jk_solar_pvt_ltd_s', 'distributor', 'JK Solar Pvt. Ltd. (S)', '9911244410', NULL, NULL, NULL, 'active', '[jksolargurugram@gmail.com](mailto:jksolargurugram@gmail.com)', NULL, 'AADCJ9506E', 'Near Sector 10A Chowk, Pataudi Road Kadipur, Gurugram Haryana', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(212, NULL, 'lohia_sales_s', 'distributor', 'Lohia Sales (S)', '9896276612', NULL, NULL, NULL, 'active', '[lohiasales@gmail.com](mailto:lohiasales@gmail.com)', NULL, 'AADFL2485K', 'Opp. Bus Stand, Rewari', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(213, NULL, 'hkp_green_energy_s', 'distributor', 'H.K.P. GREEN ENERGY (S)', '9393000094', NULL, NULL, NULL, 'active', '[hkpgreenenergy@gmail.com](mailto:hkpgreenenergy@gmail.com)', NULL, 'AFIPA7329F', 'Parbhat Cinema Market, Opp Jogiwala Mandir, Loharu Road Bhiwani', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(214, NULL, 'solar_power_solution_s', 'distributor', 'Solar Power Solution (S)', '9711252058', NULL, NULL, NULL, 'active', '[solarpowersolution21@gmail.com](mailto:solarpowersolution21@gmail.com)', NULL, 'AJMPY3663J', 'A-314, Ground Floor, Dharam Colony, Palma Vihar Extn, Gurugram', 'Gurugram', '122017', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(215, NULL, 'rs_solar_infrastructure_private_limited_s', 'distributor', 'RS Solar Infrastructure Private Limited (S)', '9711873660', NULL, NULL, NULL, 'active', '[rajender1975@gmail.com](mailto:rajender1975@gmail.com)', NULL, 'AAICR2978P', 'C/O RS Solar Infrastructure Private, B620 2nd 3rd Floor Nehru Ground Faridabad, Haryana', 'Faridabad', '121001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(216, NULL, 'ganesh_pipe_store_s', 'distributor', 'GANESH PIPE STORE (S)', '7988131586', NULL, NULL, NULL, 'active', '[ganeshp2004@gmail.com](mailto:ganeshp2004@gmail.com)', NULL, 'AAMFG2564P', 'Near Railway Bridge GT Road Mandi Dabwali', 'Dabwali', '125104', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(217, NULL, 'sunrises_solar_solution_s', 'distributor', 'Sunrises Solar Solution (S)', '8813022855', NULL, NULL, NULL, 'active', '[lsgreentec@gmail.com](mailto:lsgreentec@gmail.com)', NULL, 'BPIPP0015G', 'Manesar, Gurugram, Haryana', 'Manesar', '122051', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(218, NULL, 'sungrid_projects_india_private_limited_s', 'distributor', 'Sungrid Projects India Private Limited (S)', '8014080147', NULL, NULL, NULL, 'active', '[sungridsolarindia@gmail.com](mailto:sungridsolarindia@gmail.com)', NULL, 'ABFCS4724A', 'Sector-10A, Gurugram', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(219, NULL, 'solar_experts_s', 'distributor', 'Solar Experts (S)', '8800103130', NULL, NULL, NULL, 'active', '[solarexpertsggn@gmail.com](mailto:solarexpertsggn@gmail.com)', NULL, 'AWQPA1461M', 'Plot No 927 Sector 47 Gurgaon', 'Gurugram', '122018', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(220, NULL, 'arya_electric_company_s', 'distributor', 'Arya Electric Company (S)', '9991328916', NULL, NULL, NULL, 'active', '[varunmittal279@gmail.com](mailto:varunmittal279@gmail.com)', NULL, 'BHNPM3820K', 'Model Town, Near Union Bank Narwana', 'Narwana', '126116', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(221, NULL, 'tse_renewables_private_limited_s', 'distributor', 'TSE RENEWABLES PRIVATE LIMITED (S)', '7050233333', NULL, NULL, NULL, 'active', '[tserenewables@gmail.com](mailto:tserenewables@gmail.com)', NULL, 'AAGCT8311G', 'Plot No. 17, Kitty Kailash Colony, Bhattu Road, Fatehabad', 'Fatehabad', '125050', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(222, NULL, 'envision_enterprises_s', 'distributor', 'ENVISION ENTERPRISES (S)', '7056303951', NULL, NULL, NULL, 'active', '[envisionharyana@gmail.com](mailto:envisionharyana@gmail.com)', NULL, 'AAHFE2063J', 'Durga Colony, Jhajjar Road, Rewari', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(223, NULL, 'vats_solar_private_limited_s', 'distributor', 'Vats Solar Private Limited (S)', '9971797339', NULL, NULL, NULL, 'active', '[sudesh_jangra@rediffmail.com](mailto:sudesh_jangra@rediffmail.com)', NULL, 'AAFCV6265J', 'Shop No. 65A, Dinod Gate, Bhiwani', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(224, NULL, 'shree_shyam_associates_s', 'distributor', 'Shree Shyam Associates (S)', '9466781020', NULL, NULL, NULL, 'active', '[rajenderyadav0786@gmail.com](mailto:rajenderyadav0786@gmail.com)', NULL, 'ABQPY5933M', 'Shop No. 212 Gaushala Market Opp. Bus Stand Narnaul Mahinder Garh Haryana', 'Narnaul', '123001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(225, NULL, 'chahal_power_projects_s', 'distributor', 'Chahal Power Projects (S)', '7876000123', NULL, NULL, NULL, 'active', '[chahalsolarpowerprojects@gmail.com](mailto:chahalsolarpowerprojects@gmail.com)', NULL, 'BFKPK9778R', 'Chaubisi-Uklana Mandi', 'Uklana', '125113', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(226, NULL, 'solar_petal_private_limited_s', 'distributor', 'Solar Petal Private Limited (S)', '9050032082', NULL, NULL, NULL, 'active', '[solarpetal@gmail.com](mailto:solarpetal@gmail.com)', NULL, 'ABICS4991G', 'House No 318 A, Navdeep Colony, Ram Nagar 2', 'Not specified', '000000', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(227, NULL, 'evaska_energy_private_limited_s', 'distributor', 'Evaska Energy Private Limited (S)', '9650728179', NULL, NULL, NULL, 'active', '[aditya@evaskaenergy.com](mailto:aditya@evaskaenergy.com)', NULL, 'AAGCE1749R', 'B1/701, The Legend, Sector-57, Gurgaon-Haryana', 'Gurugram', '122011', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(228, NULL, 'om_solar_solutions_s', 'distributor', 'OM Solar Solutions (S)', '7874615662', NULL, NULL, NULL, 'active', '[omsolarhr@gmail.com](mailto:omsolarhr@gmail.com)', NULL, 'AAHFO9661N', 'Near Rao Tula Ram Chowk, Opposite DHBVN Electricity Board, Mahender Garh, Haryana', 'Mahendragarh', '123029', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(229, NULL, 'bbn_solutions_s', 'distributor', 'BBN Solutions (S)', '9717652229', NULL, NULL, NULL, 'active', '[jitender@bbnsolution.com](mailto:jitender@bbnsolution.com)', NULL, 'ALVPJ3072F', 'Gurugram', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(230, NULL, 'sunday_solar_power_s', 'distributor', 'Sunday Solar Power (S)', '9971579381', NULL, NULL, NULL, 'active', '[sundaysolarpower9971@gmail.com](mailto:sundaysolarpower9971@gmail.com)', NULL, 'ALTPY5988M', '1st Floor, Jai Bhole Properties, Main Pataudi Road, Amar Colony, Near Police Chowki, Gurugram', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(231, NULL, 'universal_solar_s', 'distributor', 'Universal Solar (S)', '9999200727', NULL, NULL, NULL, 'active', '[pradeep@universalsolar.in](mailto:pradeep@universalsolar.in)', NULL, 'AUFPY1993B', 'Not specified', 'Not specified', '000000', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(232, NULL, 'ac_greentech_energy_s', 'distributor', 'AC Greentech Energy (S)', '9310490200', NULL, NULL, NULL, 'active', '[acgreentechenergy@gmail.com](mailto:acgreentechenergy@gmail.com)', NULL, 'BPCPS2896J', 'Not specified', 'Not specified', '000000', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(233, NULL, 'manu_solar_power_solution_s', 'distributor', 'Manu Solar Power Solution (S)', '9530022447', NULL, NULL, NULL, 'active', '[manu06solar@gmail.com](mailto:manu06solar@gmail.com)', NULL, 'AKVPJ0930B', 'Narnaul', 'Narnaul', '123001', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(234, NULL, 'bbc_india_group_s', 'distributor', 'BBC India Group (S)', '9416090345', NULL, NULL, NULL, 'active', '[bbcindiagrouphr@gmail.com](mailto:bbcindiagrouphr@gmail.com)', NULL, 'AZYPB2323G', '540/18 BRB Press Complex Shiv Colony Opp Hotel Utsav Safidon Road Jind Haryana', 'Jind', '126102', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(235, NULL, 'bridgeway_power_services_pvt_ltd_s', 'distributor', 'Bridgeway Power Services Pvt. Ltd. (S)', '9319685860', NULL, NULL, NULL, 'active', '[customersupport@bridgewaypower.in](mailto:customersupport@bridgewaypower.in)', NULL, 'AAKCB9790K', '550, Mandakini Enclave, Alaknanda, New Delhi', 'New Delhi', '110019', 32, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(236, NULL, 'amgreen_solar_private_limited_s', 'distributor', 'AMGREEN SOLAR PRIVATE LIMITED (S)', '8198005100', NULL, NULL, NULL, 'active', '[akashdeep@amgreen.solar](mailto:akashdeep@amgreen.solar)', NULL, 'AAYCA4421G', 'Not specified', 'Not specified', '000000', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(237, NULL, 'a_b_traders_s', 'distributor', 'A. B. Traders (S)', '9555568310', NULL, NULL, NULL, 'active', '[abtpkl@gmail.com](mailto:abtpkl@gmail.com)', NULL, 'ANPPN6005L', 'Plot No-132, Phase-I, Shed No 4, Panchkula', 'Panchkula', '134113', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(238, NULL, 'arsh_infratech_services_s', 'distributor', 'Arsh Infratech services (S)', '9810061017', NULL, NULL, NULL, 'active', '[arshinfra@gmail.com](mailto:arshinfra@gmail.com)', NULL, 'AHIPS2808P', 'Green Fields Colony, Faridabad', 'Faridabad', '121010', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(239, NULL, 'ojaskar_vidyut_s', 'distributor', 'OJASKAR VIDYUT (S)', '9992113519', NULL, NULL, NULL, 'active', '[balraj@ojaskar.in](mailto:balraj@ojaskar.in)', NULL, 'ITWPS6793D', 'Not specified', 'Not specified', '000000', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(240, NULL, 'kkg_electrical_s', 'distributor', 'KKG ELECTRICAL (S)', '8708088787', NULL, NULL, NULL, 'active', '[kkgelectric@gmail.com](mailto:kkgelectric@gmail.com)', NULL, 'AOEPG2806C', 'Opp. Aggarwal Colony Bhattu Road', 'Not specified', '000000', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(241, NULL, 'brd_industries_s', 'distributor', 'BRD INDUSTRIES (S)', '9518199913', NULL, NULL, NULL, 'active', '[vipin@brdindustries.co.in](mailto:vipin@brdindustries.co.in)', NULL, 'DIMPK2471Q', 'Near KD Public School, Rania Road Village Nanakpur, Sirsa', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 14:57:48', '2026-01-26 14:57:48'),
(242, NULL, 'nbs_metal_works_s', 'distributor', 'NBS METAL WORKS (S)', '9811809795', NULL, NULL, NULL, 'active', '[csinghggn@gmail.com](mailto:csinghggn@gmail.com)', NULL, 'BAEPS9711B', '20/2, basai industrial area basai gurgaon', 'Gurgaon', '122001', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(243, NULL, 'electrik_bee_private_limited_s', 'distributor', 'ELECTRIK BEE PRIVATE LIMITED (S)', '9654654369', NULL, NULL, NULL, 'active', '[hello@electrikbee.com](mailto:hello@electrikbee.com)', NULL, 'AAHCE1779L', '27, 28, 29/36 Amrit Steel Compound, Industrial Area, South side GT Road, Ghaziabad, UP-201001', 'Ghaziabad', '201001', 26, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(244, NULL, 'exolar_energy_private_limited_s', 'distributor', 'Exolar Energy Private Limited (S)', '9319082512', NULL, NULL, NULL, 'active', '[info@exolarenergy.com](mailto:info@exolarenergy.com)', NULL, 'AAGCE3558E', 'Third floor, Unit Office No. 310/A5, Pearls Best Heights-I, Netaji Subhash Place, Pitampura, Central Delhi, New Delhi, 110039', 'Delhi', '110039', 32, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(245, NULL, 'servotech_power_systems_limited_n', 'distributor', 'Servotech Power Systems Limited (N)', '9818680033', NULL, NULL, NULL, 'active', '[sarika78@servotechindia.com](mailto:sarika78@servotechindia.com)', NULL, 'AAICS5470K', '806, 8th Floor, Crown Heights, Sector-10, Delhi-110085', 'Delhi', '110085', 32, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(246, NULL, 'delhi_solar_s', 'distributor', 'DELHI SOLAR (S)', '9599912134', NULL, NULL, NULL, 'active', '[sales@delhi-solar.com](mailto:sales@delhi-solar.com)', NULL, 'AAUFD3889L', 'Delhi', 'Delhi', '000000', 32, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(247, NULL, 'bps_kiran_solar_solution_s', 'distributor', 'BPS Kiran Solar Solution (S)', '9015901566', NULL, NULL, NULL, 'active', '[info@bpskiransolar.com](mailto:info@bpskiransolar.com)', NULL, 'AARFB3104D', 'Plot No RE 8, 1st floor JDM Business Complex IMT, Sec 69, Faridabad-121004', 'Faridabad', '121004', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(248, NULL, 'roots_india_solar_pvt_ltd_s', 'distributor', 'Roots India Solar Pvt. Ltd. (S)', '9991308370', NULL, NULL, NULL, 'active', '[rootsindia8@gmail.com](mailto:rootsindia8@gmail.com)', NULL, 'AAKCR7932H', 'opp. Mini Secretariat Hailyamandi Road, Pataudi 122503', 'Pataudi', '122503', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(249, NULL, 'smart_roof_solar_solution_pvt_ltd_s', 'distributor', 'Smart Roof Solar Solution Pvt. Ltd. (S)', '7988655042', NULL, NULL, NULL, 'active', '[ajay.panchal@gosmartroof.com](mailto:ajay.panchal@gosmartroof.com)', NULL, 'AAVCS6215R', 'E-011, Raheja Atlantis, Sector-31, Gurgaon, Haryana-122001', 'Gurgaon', '122001', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(250, NULL, 'shapash_energy_pvt_ltd_s', 'distributor', 'SHAPASH ENERGY PVT LTD (S)', '9031890818', NULL, NULL, NULL, 'active', '[shapashenergy@gmail.com](mailto:shapashenergy@gmail.com)', NULL, 'ABACS1241H', 'First Floor, 3059-P, sector 46, Gurgaon', 'Gurgaon', '122003', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(251, NULL, 'terra_green_solar_solutions_s', 'distributor', 'Terra Green Solar Solutions (S)', '9929577110', NULL, NULL, NULL, 'active', '[terragreensolar@hotmail.com](mailto:terragreensolar@hotmail.com)', NULL, 'BUMPK5215Q', 'Basement, Plot No. 1, Kh. No. 349, 100 Foot Road, Ghitorni, Delhi-110030', 'Delhi', '110030', 32, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(252, NULL, 'chauhan_electronics_s', 'distributor', 'Chauhan Electronics (S)', '9728352000', NULL, NULL, NULL, 'active', '[chauhanbwn@gmail.com](mailto:chauhanbwn@gmail.com)', NULL, 'AYJPS5765R', 'Chauhan Electronics Near Railway Crossing Loharu Road Bhiwani 127021', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(253, NULL, 'sun_energy_solutions_s', 'distributor', 'Sun Energy Solutions (S)', '9555272067', NULL, NULL, NULL, 'active', '[seshisar@gmail.com](mailto:seshisar@gmail.com)', NULL, 'AQVPD6945Q', 'S. No. 25, New Auto Market, Hisar, Haryana', 'Hisar', '125001', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(254, NULL, 'vikas_bishnoi_contractor_s', 'distributor', 'Vikas Bishnoi Contractor (S)', '9990000029', NULL, NULL, NULL, 'active', '[info@sunrayssolar.in](mailto:info@sunrayssolar.in)', NULL, 'AKKPB7998L', 'DSS-59, Pocket-C, Opposite Income Tax Office, Sector 14, Hisar', 'Hisar', '125001', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(255, NULL, 'gd_solar_energy_s', 'distributor', 'GD SOLAR ENERGY (S)', '7206314585', NULL, NULL, NULL, 'active', '[gdsolarenergy786@gmail.com](mailto:gdsolarenergy786@gmail.com)', NULL, 'CWTPK5638P', 'In front of Railway Station Bhiwani 127021, Haryana', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(256, NULL, 'dassault_energy_pvt_ltd_s', 'distributor', 'DASSAULT ENERGY PVT.LTD (S)', '9991422999', NULL, NULL, NULL, 'active', '[dassaultinfo@gmail.com](mailto:dassaultinfo@gmail.com)', NULL, 'AAHCD5258P', 'HN 195, Ward No 20, Street Parkhon Wali Nohria Bazar', 'Not specified', '000000', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(257, NULL, 'sanshri_corporation_s', 'distributor', 'Sanshri Corporation (S)', '9929530744', NULL, NULL, NULL, 'active', '[sanshricorporation@gmail.com](mailto:sanshricorporation@gmail.com)', NULL, 'CCEPS0593J', 'Plot No. 491, Pace City-II, Sector-37, Gurugram, Haryana-122001', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(258, NULL, 'a1_rewari_solar_infra_private_limited_s', 'distributor', 'A1 Rewari Solar Infra Private Limited (S)', '8221812011', NULL, NULL, NULL, 'active', '[a1solarinfa@gmail.com](mailto:a1solarinfa@gmail.com)', NULL, 'AAZCA2786P', 'Ground Floor, Shop No. 557, Sayed Saray, Circular Road, Near Jain School, Rewari', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(259, NULL, 'bergen_solar_power_and_energy_limited_s', 'distributor', 'BERGEN SOLAR POWER AND ENERGY LIMITED (S)', '9830886495', NULL, NULL, NULL, 'active', '[chetan@bergengroupindia.com](mailto:chetan@bergengroupindia.com)', NULL, 'AAECB2060J', 'Emaar Digital Greens, Tower-B, B212, 2nd Floor, Sector 61, Gurugram, Haryana 122102', 'Gurugram', '122102', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(260, NULL, 'apricus_premium_solar_private_limited_s', 'distributor', 'APRICUS PREMIUM SOLAR PRIVATE LIMITED (S)', '9873725487', NULL, NULL, NULL, 'active', '[sales@apricuspremiumsolar.com](mailto:sales@apricuspremiumsolar.com)', NULL, 'AAUCA2783K', 'Sirsa Haryana', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(261, NULL, 'innovative_roof_solar_solutions_llp_s', 'distributor', 'INNOVATIVE ROOF SOLAR SOLUTIONS LLP (S)', '9810704577', NULL, NULL, NULL, 'active', '[sudhanshusingh1269@gmail.com](mailto:sudhanshusingh1269@gmail.com)', NULL, 'AAFFI4583D', '1206 Ocus Quantum, Sec 51, Gurugram 122003', 'Gurugram', '122003', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(262, NULL, 'apn_solar_energy_pvt_ltd_n', 'distributor', 'APN SOLAR ENERGY PVT LTD (N)', '9769711216', NULL, NULL, NULL, 'active', '[sales@apnsolar.com](mailto:sales@apnsolar.com)', NULL, 'AAQCA3634H', 'Office No 602, 6th floor, Hari Om IT Park, Mahajanwadi, Near MIDC Tank Naka, Mira Road East, Thane -401107', 'Thane', '401107', 14, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(263, NULL, 'aggarwal_traders_s', 'distributor', 'Aggarwal Traders (S)', '9354832661', NULL, NULL, NULL, 'active', '[aggarwaltraders6415@gmail.com](mailto:aggarwaltraders6415@gmail.com)', NULL, 'ALVPG8998D', 'Opp. Jogiwala mandi, Loharu Road, Bhiwani', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(264, NULL, 'oswal_pumps_s', 'distributor', 'OSWAL PUMPS (S)', '7404666270', NULL, NULL, NULL, 'active', '[anilaggarwal514@gmail.com](mailto:anilaggarwal514@gmail.com)', NULL, 'AEZPK3126J', 'Naya Bazar Bhiwani', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(265, NULL, 'reliant_pro_energy_llp_s', 'distributor', 'RELIANT PRO ENERGY LLP (S)', '7837157057', NULL, NULL, NULL, 'active', '[reliantproenergy@gmail.com](mailto:reliantproenergy@gmail.com)', NULL, 'ABHFR7804F', 'Near Chungi School Colony Road Dabwali', 'Dabwali', '125104', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(266, NULL, 'oswal_solar_structure_private_limited_s', 'distributor', 'OSWAL SOLAR STRUCTURE PRIVATE LIMITED (S)', '9817429014', NULL, NULL, NULL, 'active', '[tender@oswalsolar.com](mailto:tender@oswalsolar.com)', NULL, 'AADCO6824E', 'Opposite DD International Pvt Ltd, Link Road, Village Kutail, Karnal, Haryana 132037', 'Karnal', '132037', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(267, NULL, 'torios_solar_s', 'distributor', 'Torios Solar (S)', '9996111767', NULL, NULL, NULL, 'active', '[dhruvyadav@toriossolar.com](mailto:dhruvyadav@toriossolar.com)', NULL, 'BBBPY7314N', 'H. No. 7680E, Street No. 5, Mahaveer Nagar, Rewari', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(268, NULL, 'kharb_industries_s', 'distributor', 'KHARB INDUSTRIES (S)', '9992221991', NULL, NULL, NULL, 'active', '[kharbindustries1@gmail.com](mailto:kharbindustries1@gmail.com)', NULL, 'BTMPK5193A', 'Alika Road, Mandi Dabwali, District Sirsa - 125104', 'Dabwali', '125104', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(269, NULL, 'shivam_enterprises_s', 'distributor', 'Shivam Enterprises (S)', '9215415600', NULL, NULL, NULL, 'active', '[shivamsunsolar@gmail.com](mailto:shivamsunsolar@gmail.com)', NULL, 'AEFPY5665L', 'Village Gajjiwas, Bithwana Bus Stand, Bawal Road, Rewari', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(270, NULL, 'galo_energy_private_limited_n', 'distributor', 'Galo Energy Private Limited (N)', '9643104325', NULL, NULL, NULL, 'active', '[info@galo.co.in](mailto:info@galo.co.in)', NULL, 'AAHCG2480N', 'Plot No. 17 Ecotech - XII Greater Noida, Gautam Buddha Nagar, Uttar Pradesh 201306', 'Greater Noida', '201306', 26, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(271, NULL, 'rishika_kraft_private_limited_s', 'distributor', 'Rishika Kraft Private Limited (S)', '8595534175', NULL, NULL, NULL, 'active', '[rishikakraft@gmail.com](mailto:rishikakraft@gmail.com)', NULL, 'AAYCS0738A', 'Village-Bhera, Tehsil-Tosham, Bhiwani', 'Bhiwani', '127040', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(272, NULL, 'sunmayo_private_limited_s', 'distributor', 'Sunmayo Private Limited (S)', '9643800850', NULL, NULL, NULL, 'active', '[solarsunmayo@gmail.com](mailto:solarsunmayo@gmail.com)', NULL, 'ABECS7622Q', '26/18, Laxmi Garden, Near Tikona park Gurugram, Haryana', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(273, NULL, 'surya_parkash_solar_solutions_s', 'distributor', 'Surya Parkash Solar Solutions (S)', '9215415600', NULL, NULL, NULL, 'active', '[ravigupta31082014@gmail.com](mailto:ravigupta31082014@gmail.com)', NULL, 'GQOPM2036J', 'Durga Colony, Ward No. 28, Opp. Power House, Jhajjar Road, Rewari, Haryana', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(274, NULL, 'anant_energy_s', 'distributor', 'Anant Energy (S)', '7056553448', NULL, NULL, NULL, 'active', '[ayadav04049@gmail.com](mailto:ayadav04049@gmail.com)', NULL, 'BUXPJ1838D', 'Palhawas, Jhajjar Road, Rewari', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(275, NULL, 'samraj_bharat_private_limited_s', 'distributor', 'Samraj Bharat Private Limited (S)', '9728019666', NULL, NULL, NULL, 'active', '[sales@samrajbharat.com](mailto:sales@samrajbharat.com)', NULL, 'ABECS0221M', 'Shop No. 57, 1st Floor, Brass Market, Rewari, Haryana', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(276, NULL, 'ranjan_industries_n', 'distributor', 'RANJAN INDUSTRIES (N)', '9924818113', NULL, NULL, NULL, 'active', '[ranjan28496@gmail.com](mailto:ranjan28496@gmail.com)', NULL, 'ABDFR3815L', 'Street No 3 corner Samrat Industrial area main road Rajkot', 'Rajkot', '360001', 7, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(277, NULL, 'som_corporation_s', 'distributor', 'Som Corporation (S)', '9467760386', NULL, NULL, NULL, 'active', '[kumarsomdutt8@gmail.com](mailto:kumarsomdutt8@gmail.com)', NULL, 'FJWPS7471F', 'House no 1907/FC colony Uklana mandi Hisar Haryana', 'Uklana', '125113', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(278, NULL, 'jpl_solar_s', 'distributor', 'JPL Solar (S)', '9169197000', NULL, NULL, NULL, 'active', '[jplpowersolution@gmail.com](mailto:jplpowersolution@gmail.com)', NULL, 'DLRPK1630K', 'Near Tau Devi market Fatehabad Haryana', 'Fatehabad', '125050', 8, NULL, 1, 0, '2026-01-26 15:05:31', '2026-01-26 15:05:31'),
(279, NULL, 'sda_digital_solutions_private_limited', 'distributor', 'SDA DIGITAL SOLUTIONS PRIVATE LIMITED', '9215321162', NULL, NULL, NULL, 'active', '[sda.digitalsolutions@gmail.com](mailto:sda.digitalsolutions@gmail.com)', NULL, 'ABJCS8901K', 'Gali No 4, Uttam Nagar Loharu Road Near Subhash Kiryana Store Bhiwani 127021', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(280, NULL, 'aggarwal_automobiles_s', 'distributor', 'Aggarwal Automobiles (S)', '9416161312', NULL, NULL, NULL, 'active', '[manojrk_aggarwal@yahoo.co.in](mailto:manojrk_aggarwal@yahoo.co.in)', NULL, 'ACIPA9799A', 'Opp. Jogiwala mandir, Loharu Road, Bhiwani', 'Bhiwani', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(281, NULL, 'skf_solar_pumps_private_india_s', 'distributor', 'SKF SOLAR PUMPS PRIVATE INDIA (S)', '8888000058', NULL, NULL, NULL, 'active', '[sonuchahal1@gmail.com](mailto:sonuchahal1@gmail.com)', NULL, 'HCPPS7568D', 'New Grain Market Gate No. 1, SCO No. 65, Second Floor Near Loharu Road, Bhiwani, Haryana', 'Bhiwani', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(282, NULL, 'hindustan_vidyut_udyog_s', 'distributor', 'HINDUSTAN VIDYUT UDYOG (S)', '8130169070', NULL, NULL, NULL, 'active', '[info.hvuil@gmail.com](mailto:info.hvuil@gmail.com)', NULL, 'BCJPK9328K', 'OPP KRISHNA MANGLAM GARDEN SHEETLA MATA ROAD GURGAON', 'Gurgaon', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(283, NULL, 's_a_electronics_s', 'distributor', 'S. A. Electronics (S)', '9215521752', NULL, NULL, NULL, 'active', '[aei_azadelectronicsindia@yahoo.com](mailto:aei_azadelectronicsindia@yahoo.com)', NULL, 'AFTPA8675B', 'Near Red Cross, Rania bazar District Sirsa-125055', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(284, NULL, 'skg_technoworld_company_s', 'distributor', 'SKG Technoworld Company (S)', '9953525199', NULL, NULL, NULL, 'active', '[skgtechnoworldcompany@gmail.com](mailto:skgtechnoworldcompany@gmail.com)', NULL, 'FWEPS5077Q', 'near Vinay public School village Chandu, Farrukh Nagar main road, Gurugram, Haryana', 'Gurugram', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(285, NULL, 'verma_auto_electric_works_s', 'distributor', 'Verma Auto Electric Works (S)', '9416080311', NULL, NULL, NULL, 'active', '[vermaautoelectric@gmail.com](mailto:vermaautoelectric@gmail.com)', NULL, 'AHXPB4816D', 'College Road Mandi Adampur Hisar, Haryana', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(286, NULL, 'limelights_electronics_private_limited_s', 'distributor', 'Limelights Electronics Private Limited (S)', '9050119525', NULL, NULL, NULL, 'active', '[mahesh.yadav@limelights.in](mailto:mahesh.yadav@limelights.in)', NULL, 'AACCL8613M', 'Vill- Karoli, Tehsil- Nahar, Distt- Rewari, Haryana', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(287, NULL, 'sunrise_trading_co_s', 'distributor', 'Sunrise Trading CO. (S)', '9254308200', NULL, NULL, NULL, 'active', '[sunrisebhiwani1880@gmail.com](mailto:sunrisebhiwani1880@gmail.com)', NULL, 'ALTPR7717D', 'Near ICICI Bank, Circular Road, Near bus Stand, Bhiwani, Haryana', 'Bhiwani', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(288, NULL, 'deep_electricals_s', 'distributor', 'Deep Electricals (S)', '9416231710', NULL, NULL, NULL, 'active', '[deepbhiwani@gmail.com](mailto:deepbhiwani@gmail.com)', NULL, 'AQAPK5617R', '5-6, Improvement Trust Market, Bhiwani Haryana', 'Bhiwani', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(289, NULL, 'harsh_smart_grid_engineering_s', 'distributor', 'Harsh Smart Grid Engineering (S)', '9588595565', NULL, NULL, NULL, 'active', '[harshsingla1990@gmail.com](mailto:harshsingla1990@gmail.com)', NULL, 'BGMPG6148L', '21 Industrial Estate Delhi Road Industrial Area Hisar, Haryana', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(290, NULL, 'bs_solar_and_renewable_energy_s', 'distributor', 'BS Solar and Renewable Energy (S)', '9312050000', NULL, NULL, NULL, 'active', '[bssolars@gmail.com](mailto:bssolars@gmail.com)', NULL, 'DBMPS4974R', 'Mezbaan Chowk, Ward No. 19, Loharu Road, Charkhi Dadri, Haryana', 'Charkhi Dadri', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(291, NULL, 'washdown_solar_private_limited_n', 'distributor', 'Washdown Solar Private Limited (N)', '8750006868', NULL, NULL, NULL, 'active', '[wd@washdown.in](mailto:wd@washdown.in)', NULL, 'AADCW3704F', 'A 010 SF, RIDHI SIDHI AVENUE, SEC-28A, ALPHA CENTER, Taraori, Karnal, Haryana, 132001', 'Karnal', '132001', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(292, NULL, 'iti_limited_naini_n', 'distributor', 'ITI LIMITED, NAINI (N)', '8543806477', NULL, NULL, NULL, 'active', '[marketing_nni@itiltd.co.in](mailto:marketing_nni@itiltd.co.in)', NULL, 'AAACI4625C', 'ITI LIMITED, NAINI, MIRZAPUR ROAD, NAINI, PRAYAGRAJ - 211010', 'Prayagraj', '211010', 26, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(293, NULL, 'sadbhav_futuretech_private_limited_s', 'distributor', 'Sadbhav Futuretech Private Limited (S)', '9810092287', NULL, NULL, NULL, 'active', '[info@sadbhavfuturetech.com](mailto:info@sadbhavfuturetech.com)', NULL, 'AAFCl6537G', 'at Waladgao, Waluj Industrial Area, Chhatrapati Sambhaji Nagar, Maharashtra 431133', 'Chhatrapati Sambhaji Nagar', '431133', 14, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(294, NULL, 'rajeev_narang_s', 'distributor', 'RAJEEV NARANG (S)', '9996982372', NULL, NULL, NULL, 'active', '[premierautohsr@gmail.com](mailto:premierautohsr@gmail.com)', NULL, 'AGYPN8978N', '239 AUTO MARKET HISSAR', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(295, NULL, 'su_solartech_systems_p_ltd_n', 'distributor', 'Su Solartech Systems (P) Ltd (N)', '9814014278', NULL, NULL, NULL, 'active', '[solartech@susolartech.com](mailto:solartech@susolartech.com)', NULL, 'AACCS2987F', '739, Industrial Area, Phase-II, Chandigarh', 'Chandigarh', '000000', 30, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(296, NULL, 'tgsp_petwar_private_limited_s', 'distributor', 'TGSP Petwar Private Limited (S)', '9467091006', NULL, NULL, NULL, 'active', '[tgsppetwarpvtltd@gmail.com](mailto:tgsppetwarpvtltd@gmail.com)', NULL, 'AAOCM6731B', 'Vass-Badala Road VPO Petwar Teh. Narnaud Hisar', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(297, NULL, 'yn_solar_planet_private_limited_s', 'distributor', 'YN Solar Planet Private Limited (S)', '8168534802', NULL, NULL, NULL, 'active', '[ynsolarplanet@gmail.com](mailto:ynsolarplanet@gmail.com)', NULL, 'AABCY8091P', 'Near Sarva Haryana Gramin Bank, Village Gudiani, Tehsil Kosli, Distt. Rewari, Haryana', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(298, NULL, 'rakhchhit_green_energy_solutions_s', 'distributor', 'RAKHCHHIT GREEN ENERGY SOLUTIONS (S)', '9650148747', NULL, NULL, NULL, 'active', '[rges2002@gmail.com](mailto:rges2002@gmail.com)', NULL, 'EGLPK5123H', 'VILLAGE - HARPHALI, PALWAL, HARYANA, 121004', 'Palwal', '121004', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(299, NULL, 'shiva_enterprises_s', 'distributor', 'Shiva Enterprises (S)', '8295025766', NULL, NULL, NULL, 'active', '[shivaenterprises127032@gmail.com](mailto:shivaenterprises127032@gmail.com)', NULL, 'DZPPS5283G', 'New Bus Stand, Baliyali Bhiwani, Haryana', 'Bhiwani', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(300, NULL, 'lamba_solergen_technologies_private_limited_s', 'distributor', 'Lamba Solergen Technologies Private Limited (S)', '9416614814', NULL, NULL, NULL, 'active', '[lambasolergen@gmail.com](mailto:lambasolergen@gmail.com)', NULL, 'AAFCL8074R', 'Village Kullankullan Dist Fatehabad', 'Fatehabad', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(301, NULL, 'gridlynk_solar_llp_s', 'distributor', 'Gridlynk Solar LLP (S)', '8875008222', NULL, NULL, NULL, 'active', '[infor@gridlynk.com](mailto:infor@gridlynk.com)', NULL, 'AARFG9216H', '405P, Sector-31-32A, Gurugram-122001', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(302, NULL, 'sandeep_electronics_s', 'distributor', 'Sandeep Electronics (S)', '9416321027', NULL, NULL, NULL, 'active', '[sandeep21027@gmail.com](mailto:sandeep21027@gmail.com)', NULL, 'BPAPS9542F', 'Bus Stand, Masani Distt., Rewari', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(303, NULL, 'vansh_enterprises_s', 'distributor', 'Vansh Enterprises (S)', '9717175212', NULL, NULL, NULL, 'active', '[support@sunbeatsolar.in](mailto:support@sunbeatsolar.in)', NULL, 'GBRPS8317G', 'Branch Office 1962, sector-64c, near IMT Chowk, Faridabad Haryana', 'Faridabad', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(304, NULL, 'rocker_solar_solutions_private_limited_n', 'distributor', 'Rocker Solar Solutions Private Limited (N)', '9555375753', NULL, NULL, NULL, 'active', '[mukul@rockersolar.com](mailto:mukul@rockersolar.com)', NULL, 'AANCR6313F', '45/5 Second Floor, East Punjabi Bagh, New Delhi 110026', 'New Delhi', '110026', 32, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(305, NULL, 'suryam_international_private_limited_n', 'distributor', 'SURYAM INTERNATIONAL PRIVATE LIMITED (N)', '8114391608', NULL, NULL, NULL, 'active', '[tender.suryaminternational@gmail.com](mailto:tender.suryaminternational@gmail.com)', NULL, 'AAWCS6569B', '2nd Lane, Gandhi Nagar, Near Kalki Temple, Berhampur, Ganjam, Odisha, 760001', 'Berhampur', '760001', 19, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(306, NULL, 'super_watt_power_solutions_llp_n', 'distributor', 'Super Watt Power Solutions LLP (N)', '9920320366', NULL, NULL, NULL, 'active', '[power.superwatt@gmail.com](mailto:power.superwatt@gmail.com)', NULL, 'ADDFS1340P', '10A, Latif House, ST Road, Carnac Bunder, masjid East, Mumbai 400009', 'Mumbai', '400009', 14, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(307, NULL, 'fujiyama_power_systems_private_limited_n', 'distributor', 'FUJIYAMA POWER SYSTEMS PRIVATE LIMITED (N)', '9899337928', NULL, NULL, NULL, 'active', '[prateek.kumar@fujiyama.in](mailto:prateek.kumar@fujiyama.in)', NULL, 'AADCF2634F', 'Corporate Office - 53A/6 Rama Road industrial area, Near Sat Guru Ram Singh Marg Metro Station Near NDPL Grid Office, Delhi 110015 Manufacturing Unit - Plot No. 51,52 Sector, Ecotech-1, Ecotech Extn-1, Greater Noida, Gautam Budh Nagar, UP, 201310', 'Delhi', '110015', 32, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(308, NULL, 'solarsquare_energy_private_limited_n', 'distributor', 'SolarSquare Energy Private Limited (N)', '8826376150', NULL, NULL, NULL, 'active', '[nationalportal@solarsquare.in](mailto:nationalportal@solarsquare.in)', NULL, 'AAVCS8269F', 'Registered office Address- G-3, B wing, Het Kunj, VP Road, Fidali Baugh Lane, Andheri West, Mumbai 400058, Maharashtra', 'Mumbai', '400058', 14, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(309, NULL, 'krivi_energy_private_limited_n', 'distributor', 'KRIVI ENERGY PRIVATE LIMITED (N)', '9326275972', NULL, NULL, NULL, 'active', '[solar@krivienergy.com](mailto:solar@krivienergy.com)', NULL, 'AAFCK1166P', '112 Dipti square Suabash rd Jogeshwari East Mumbai 400060', 'Mumbai', '400060', 14, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(310, NULL, 'kamal_electricals_s', 'distributor', 'Kamal Electricals (S)', '9729485000', NULL, NULL, NULL, 'active', '[kamaljeet.soni666@gmail.com](mailto:kamaljeet.soni666@gmail.com)', NULL, 'BOCPK1732C', 'Works Chandigarh Road near Bijli Board Tohana', 'Tohana', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(311, NULL, 'recom_solar_energy_s', 'distributor', 'Recom Solar Energy (S)', '9817102217', NULL, NULL, NULL, 'active', '[recomsolarenergy@gmail.com](mailto:recomsolarenergy@gmail.com)', NULL, 'EWUPM5956B', 'Shop No.03 Model Town Rewari, Haryana', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:13:20', '2026-01-26 15:13:20'),
(312, NULL, 'arg_energy_solutions_s', 'distributor', 'ARG Energy Solutions (S)', '8295464923', NULL, NULL, NULL, 'active', '[argenergysolutions@gmail.com](mailto:argenergysolutions@gmail.com)', NULL, 'CGOPG7704D', 'Shop No. 6 Model Town Opp Huda Office 125001', 'Hisar', '125001', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(313, NULL, 'valour_promosales_llp_s', 'distributor', 'Valour Promosales LLP (S)', '9599486631', NULL, NULL, NULL, 'active', '[sales@valourpromosales.com](mailto:sales@valourpromosales.com)', NULL, 'AALFV9084G', '507, 5th Floor, Silverton Tower, Golf Course Extension Road, Sector-50, Gurugram-122003, Haryana', 'Gurugram', '122003', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(314, NULL, 'urjastrot_private_limited_n', 'distributor', 'Urjastrot Private Limited (N)', '9925445290', NULL, NULL, NULL, 'active', '[urjastrotenterprise@gmail.com](mailto:urjastrotenterprise@gmail.com)', NULL, 'AADCU5553G', 'L.S NO-47, Nr. Ramdevpir Temple, Bedva-388320, Anand, Gujarat, India', 'Anand', '388320', 7, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(315, NULL, 'brihaspathi_technologies_pvt_ltd_n', 'distributor', 'Brihaspathi Technologies Pvt Ltd (N)', '6300699999', NULL, NULL, NULL, 'active', '[info@brihaspathi.com](mailto:info@brihaspathi.com)', NULL, 'AADCB9748E', 'Plot No 7-1-621/259, 5 Floor, Sahithi Arcade, SR Nagar, Hyderabad-500038', 'Hyderabad', '500038', 24, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39');
INSERT INTO `companies` (`id`, `owner_id`, `slug`, `company_type`, `owner_name`, `phone`, `website_url`, `logo_url`, `description`, `status`, `email`, `years_in_business`, `gst_number`, `address`, `city`, `pincode`, `state_id`, `city_id`, `is_active`, `is_verified`, `created_at`, `updated_at`) VALUES
(316, NULL, 'rana_contractors_s', 'distributor', 'RANA CONTRACTORS (S)', '9728403030', NULL, NULL, NULL, 'active', '[ranacontractors.in@gmail.com](mailto:ranacontractors.in@gmail.com)', NULL, 'CHHPM3066L', '69 Sector 13, Part II, Hisar', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(317, NULL, 'forever_solar_energy_s', 'distributor', 'Forever Solar Energy (S)', '9416106292', NULL, NULL, NULL, 'active', '[info@foreversolarenergy.com](mailto:info@foreversolarenergy.com)', NULL, 'AIAPB1629C', 'House No 30, RSD Colony Sirsa 125055', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(318, NULL, 'ad_solution_s', 'distributor', 'AD Solution (S)', '9466370181', NULL, NULL, NULL, 'active', '[adsolution2024@gmail.com](mailto:adsolution2024@gmail.com)', NULL, 'AQZPK6026F', 'M/Garh Road Near Railway Phatak, Rewari', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(319, NULL, 'mehta_electrical_and_communication_s', 'distributor', 'Mehta Electrical & Communication (S)', '9810939995', NULL, NULL, NULL, 'active', '[mehtaelectrical.mehta@gmail.com](mailto:mehtaelectrical.mehta@gmail.com)', NULL, 'ALPPM6931L', '1/1 Devi Lal Nagar, Gurugram Haryana', 'Gurugram', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(320, NULL, 'morph_engineers_india_private_limited_s', 'distributor', 'MORPH ENGINEERS INDIA PRIVATE LIMITED (S)', '9696300004', NULL, NULL, NULL, 'active', '[morphengineersindia@gmail.com](mailto:morphengineersindia@gmail.com)', NULL, 'AARCM9272C', '237 Ground Floor part-I Model Town Tosham Road Hisar', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(321, NULL, 'the_successor_group_s', 'distributor', 'The Successor Group (S)', '8930388812', NULL, NULL, NULL, 'active', '[thesuccessorgroup@gmail.com](mailto:thesuccessorgroup@gmail.com)', NULL, 'ABXPC5649K', 'Near Indraj Pana Chopal, Village Petwar, Hisar Haryana', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(322, NULL, 'shri_krishna_contractor_s', 'distributor', 'Shri Krishna Contractor (S)', '9467488062', NULL, NULL, NULL, 'active', '[parmod.kaswan01@gmail.com](mailto:parmod.kaswan01@gmail.com)', NULL, 'FLMPR8560J', 'Village Panniwala Mota, District Sirsa, Haryana', 'Sirsa', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(323, NULL, 'yadav_battery_house_s', 'distributor', 'Yadav Battery House (S)', '9416063626', NULL, NULL, NULL, 'active', '[yadvbatteryhouse@gmail.com](mailto:yadvbatteryhouse@gmail.com)', NULL, 'ABJPY3500F', 'House Near Fly Over Dadri Road Mahendergarh, Haryana', 'Mahendergarh', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(324, NULL, 'babylonian_technologies_india_private_limited_s', 'distributor', 'Babylonian Technologies(India) Private Limited (S)', '9871998994', NULL, NULL, NULL, 'active', '[info@bbl-tech.com](mailto:info@bbl-tech.com)', NULL, 'AAFCB6512N', '2121, Tower-1, DLF Corporate Greens, Sector-74A, Narsighpur Gurugram Haryana 122004', 'Gurugram', '122004', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(325, NULL, 'mystic_future_energy_private_limited_s', 'distributor', 'Mystic Future Energy Private Limited (S)', '9255551146', NULL, NULL, NULL, 'active', '[mysticfuturesolar@gmail.com](mailto:mysticfuturesolar@gmail.com)', NULL, 'AAKCM5989R', 'DSS-119 Sector-15-A Hisar', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(326, NULL, 'aman_engineering_associates_s', 'distributor', 'Aman Engineering Associates (S)', '9953630100', NULL, NULL, NULL, 'active', '[info@amaneng.com](mailto:info@amaneng.com)', NULL, 'ABCFA1040P', 'H.No.203, Sector-1 DSIDC, Industrial Area, Bawana, Delhi-110039', 'Delhi', '110039', 32, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(327, NULL, 'soravi_traders_s', 'distributor', 'Soravi Traders (S)', '9812044406', NULL, NULL, NULL, 'active', '[soravitraders191971@gmail.com](mailto:soravitraders191971@gmail.com)', NULL, 'ACVPY7191F', 'Tkona Park, 42/4 College Road Charkhi Dadri', 'Charkhi Dadri', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(328, NULL, 'shree_shyam_solar_services_s', 'distributor', 'Shree Shyam Solar Services (S)', '7500777434', NULL, NULL, NULL, 'active', '[sssolarservice@gmail.com](mailto:sssolarservice@gmail.com)', NULL, 'AZJPK0624J', 'H.NO.458, Sector-19, Rewari, Haryana', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(329, NULL, 'sunbuilt_energy_llp_s', 'distributor', 'SUNBUILT ENERGY LLP (S)', '9289280505', NULL, NULL, NULL, 'active', '[sunbuiltenergy@gmail.com](mailto:sunbuiltenergy@gmail.com)', NULL, 'ADMFS8152J', 'Floor No 4, Flat No 30 BY 29 West Patel Nagar New Delhi 110008 District Central Delhi', 'Delhi', '110008', 32, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(330, NULL, 'hr_solar_and_electronics_s', 'distributor', 'H.R. Solar & Electronics (S)', '9315643092', NULL, NULL, NULL, 'active', '[rvjaiya@gmail.com](mailto:rvjaiya@gmail.com)', NULL, 'FTWPK0637M', 'Near Tibbi Road, Balmiki Chowk, Talwara Road, Ellenabad Sirsa', 'Sirsa', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(331, NULL, 'shri_radhe_enterprises_s', 'distributor', 'Shri Radhe Enterprises (S)', '9034330800', NULL, NULL, NULL, 'active', '[shriradheenterprisesjind@gmail.com](mailto:shriradheenterprisesjind@gmail.com)', NULL, 'ADJPW6507A', 'Plot No.-94 Hanuman Nagar Jind Haryana', 'Jind', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(332, NULL, 'photon_green_energy_s', 'distributor', 'Photon Green Energy (S)', '9818101704', NULL, NULL, NULL, 'active', '[cdr2009@rediffmail.com](mailto:cdr2009@rediffmail.com)', NULL, 'ABRPR5341P', 'PV-25, Palm Springs Golf Course Road DLF Phase-V, Sec-54 Gurugram-122002', 'Gurugram', '122002', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(333, NULL, 'daau_engineering_services_and_enterprises_s', 'distributor', 'Daau Engineering Services and Enterprises (S)', '9205871027', NULL, NULL, NULL, 'active', '[daau.engg@gmail.com](mailto:daau.engg@gmail.com)', NULL, 'AKZPS2301R', 'Shop No.P-23 Near PNB Bank Sohna Road Sector-23 Faridabad Haryana-121004', 'Faridabad', '121004', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(334, NULL, 'ms_enterprises_s', 'distributor', 'M.S. Enterprises (S)', '9466374243', NULL, NULL, NULL, 'active', '[manpreetsinghbhangui121@gmail.com](mailto:manpreetsinghbhangui121@gmail.com)', NULL, 'CYPPS7961B', '193 Radha Krishan Mandir, Shekhpura, Sirsa -125077', 'Sirsa', '125077', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(335, NULL, 'yadav_enterprises_s', 'distributor', 'Yadav Enterprises (S)', '9416064677', NULL, NULL, NULL, 'active', '[yadaventersisesnnl@gmail.com](mailto:yadaventersisesnnl@gmail.com)', NULL, 'ANAPD8122H', 'Opp. Panchayat Bhawan M/Garh Road Narnaul, Haryana', 'Narnaul', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(336, NULL, 'ug_power_private_limited_s', 'distributor', 'UG Power Private Limited (S)', '7400068000', NULL, NULL, NULL, 'active', '[ugpowervt@gmail.com](mailto:ugpowervt@gmail.com)', NULL, 'AACCU8510G', 'Village-Khaishergarh, Sirsa', 'Sirsa', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(337, NULL, 'naval_infrastructure_s', 'distributor', 'Naval Infrastructure (S)', '9996090149', NULL, NULL, NULL, 'active', '[navalinfrastructure@gmail.com](mailto:navalinfrastructure@gmail.com)', NULL, 'BCHPA2896L', 'Booth No 4, near Verma Marble, Sabzi Mandi, Rania Road, Sirsa', 'Sirsa', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(338, NULL, 'pankaj_jakhar_contractor_s', 'distributor', 'Pankaj Jakhar Contractor (S)', '9467657008', NULL, NULL, NULL, 'active', '[pankajjakhar0088@gmail.com](mailto:pankajjakhar0088@gmail.com)', NULL, 'BHRPJ0875M', 'Banwala Road village-Kharian, Distt-Sirsa', 'Sirsa', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(339, NULL, 'simran_solar_power_s', 'distributor', 'Simran Solar Power (S)', '9416479918', NULL, NULL, NULL, 'active', '[simran.sahib4@gmail.com](mailto:simran.sahib4@gmail.com)', NULL, 'GRFPS6516B', 'Near Bhagwan Valmiki Chowk Tohana Haryana 125120', 'Tohana', '125120', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(340, NULL, 'vinod_kumar_contractor_s', 'distributor', 'Vinod Kumar Contractor (S)', '9855610515', NULL, NULL, NULL, 'active', '[vk789677@gmail.com](mailto:vk789677@gmail.com)', NULL, 'FGSPK4968Q', 'Chamal Road, Near Harijan Chopal Village Bansudhar District Sirsa 125055', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(341, NULL, 'kalptaru_renewable_power_pvt_ltd_ms', 'distributor', 'Kalptaru renewable power Pvt Ltd (MS)', '7600037039', NULL, NULL, NULL, 'active', '[support@kalptaru.co](mailto:support@kalptaru.co)', NULL, 'AAKCK4101B', '701, Avdesh House, Opp Gurudwara, Thaltej', 'Ahmedabad', '000000', 7, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(342, NULL, 'mukesh_electric_and_machinery_store_s', 'distributor', 'Mukesh Electric and Machinery Store (S)', '9416063769', NULL, NULL, NULL, 'active', '[mukeshrewari45@gmail.com](mailto:mukeshrewari45@gmail.com)', NULL, 'BIVPK0336B', 'Jiwali Bazar Rewari Haryana 123401', 'Rewari', '123401', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(343, NULL, 'santosa_solar_techno_s', 'distributor', 'Santosa Solar Techno (S)', '9416132887', NULL, NULL, NULL, 'active', '[santosasolartechno@gmail.com](mailto:santosasolartechno@gmail.com)', NULL, 'BWOPG6596G', '776 Subhash Basti Near Under Pass Rewari Haryana', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(344, NULL, 'multi_infrastructure_and_engineering_pvt_ltd_ms', 'distributor', 'Multi Infrastructure & Engineering Pvt Ltd (MS)', '9971699555', NULL, NULL, NULL, 'active', '[epc@miepl.ind.in](mailto:epc@miepl.ind.in)', NULL, 'AAKCM6814B', 'House No 262 Sector 9A Gurugram Gurgaon Haryana 122001', 'Gurugram', '122001', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(345, NULL, 'haryana_machine_tools_s', 'distributor', 'Haryana Machine Tools (S)', '8683918007', NULL, NULL, NULL, 'active', '[hmtpowerol@gmail.com](mailto:hmtpowerol@gmail.com)', NULL, 'EFNPS5254C', 'Punjabi Chowk Railway Road Narwana District Jind Haryana', 'Narwana', '000000', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(346, NULL, 'mediez_solar_energy_private_limited_s', 'distributor', 'Mediez Solar Energy Private Limited (S)', '9215523023', NULL, NULL, NULL, 'active', '[mediezsolarenergy@gmail.com](mailto:mediezsolarenergy@gmail.com)', NULL, 'AALCM0474C', 'Gali No.2 Shop No.38 Backside Bansal Cinema Sirsa 125055', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(347, NULL, 'haryana_auto_electrician_s', 'distributor', 'Haryana Auto Electrician (S)', '8053263700', NULL, NULL, NULL, 'active', '[skofca11@gmail.com](mailto:skofca11@gmail.com)', NULL, 'BPUPK4214C', 'Mahendergarh Road Near Ashok Hospital Kanina 123027', 'Kanina', '123027', 8, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(348, NULL, 'bdb_ventures_private_limited_s', 'distributor', 'BDB Ventures Private Limited (S)', '9312644140', NULL, NULL, NULL, 'active', '[vivekbuydbest@gmail.com](mailto:vivekbuydbest@gmail.com)', NULL, 'AAFCB1019C', 'M.B Road F12 Vishwakarma Colony G.F Delhi 110044', 'Delhi', '110044', 32, NULL, 1, 0, '2026-01-26 15:27:39', '2026-01-26 15:27:39'),
(349, NULL, 'ashirwad_electronics_s', 'distributor', 'Ashirwad Electronics (S)', '7206850150', NULL, NULL, NULL, 'active', '[pawandhingra50150@gmail.com](mailto:pawandhingra50150@gmail.com)', NULL, 'EGCPK5906D', 'Backside of Baba Bihari Samadhi,121, Thed Mohella, Rania, Sirsa-125055', 'Sirsa', '125055', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(350, NULL, 'sapson_solar_private_limited_s', 'distributor', 'Sapson Solar Private Limited (S)', '9990002385', NULL, NULL, NULL, 'active', '[sukhbir@sapson.in](mailto:sukhbir@sapson.in)', NULL, 'AAZCS6725J', 'Mandola Road, Near Bharat Petrol Pump, Zainabad Dahina, Distt. Rewari, Haryana', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(351, NULL, 'aggarwal_trading_company_s', 'distributor', 'Aggarwal Trading Company (S)', '7404666270', NULL, NULL, NULL, 'active', '[ashuaggarwal7aug@gmail.com](mailto:ashuaggarwal7aug@gmail.com)', NULL, 'BJEPA2777A', 'Budhwari Mata, Naya Bazar Bhiwani', 'Bhiwani', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(352, NULL, 'jai_bharat_enggtools_co_s', 'distributor', 'JAI BHARAT ENGG.TOOLS CO (S)', '9996982372', NULL, NULL, NULL, 'active', '[jaibharat.hissar@gmail.com](mailto:jaibharat.hissar@gmail.com)', NULL, 'AAIPL6714E', 'Mandi Road Hissar', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(353, NULL, 'renaissance_corporate_solutions_pvt_ltd_n', 'distributor', 'Renaissance Corporate Solutions Pvt. Ltd. (N)', '8368478274', NULL, NULL, NULL, 'active', '[rcplsolar@gmail.com](mailto:rcplsolar@gmail.com)', NULL, 'AAFCR3303R', 'Office No.302, 3rd Floor, Kirti Mahal Building, Rajendra Place, New Delhi, Delhi-110008', 'New Delhi', '110008', 32, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(354, NULL, 'yadav_traders_s', 'distributor', 'Yadav Traders (S)', '8708010914', NULL, NULL, NULL, 'active', '[pardeepyadav6372@gmail.com](mailto:pardeepyadav6372@gmail.com)', NULL, 'BHAPK7808J', 'Main Bus Stand Berli Kalan Rewari Haryana', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(355, NULL, 'saini_generators_s', 'distributor', 'Saini Generators (S)', '8708646345', NULL, NULL, NULL, 'active', '[mahindra.sale@sainigenerators.com](mailto:mahindra.sale@sainigenerators.com)', NULL, 'BMAPS8137D', 'Union Bank Near Azad Chowk, Circular Road Rewari', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(356, NULL, 's_k_g_construction_company_s', 'distributor', 'S K G Construction Company (S)', '9992222540', NULL, NULL, NULL, 'active', '[sunilgaur99@yahoo.co.in](mailto:sunilgaur99@yahoo.co.in)', NULL, 'AEDPG4615A', 'Opp. Panchayat Bhawan Mohindergarh Road, Narnaul', 'Narnaul', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(357, NULL, 'v_n_solar_energy_s', 'distributor', 'V N Solar Energy (S)', '9355066667', NULL, NULL, NULL, 'active', '[vnsolartohana@gmail.com](mailto:vnsolartohana@gmail.com)', NULL, 'AUFPP1090G', 'Chandigarh Road Tohana Fatehabad', 'Tohana', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(358, NULL, 'ak_green_energy_s', 'distributor', 'AK Green Energy (S)', '9671537113', NULL, NULL, NULL, 'active', '[ajaysudesh2211@gmail.com](mailto:ajaysudesh2211@gmail.com)', NULL, 'BJHPD1966R', 'Shop No 251 Railway Station Road Kanina Mahendergarh Haryana', 'Kanina', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(359, NULL, 'redington_limited_n', 'distributor', 'Redington Limited (N)', '9910090894', NULL, NULL, NULL, 'active', '[vishalk.tiwari@redingtongroup.com](mailto:vishalk.tiwari@redingtongroup.com)', NULL, 'AABCR0347P', 'Block 3, Plathin-Redington Tower, D-176, Saraswathy Nagar West, 4th Street, Puzhuthivakkam, Chennai-600091', 'Chennai', '600091', 23, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(360, NULL, 'yashwardhan_solar_solution_traders_s', 'distributor', 'Yashwardhan Solar Solution Traders (S)', '9992610084', NULL, NULL, NULL, 'active', '[shamshersehoran1966@gmail.com](mailto:shamshersehoran1966@gmail.com)', NULL, 'FGFPS2579E', 'H.No. 11 Navdeep Colony Tau Nagar Phase-I Hisar', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(361, NULL, 'darsh_solar_solutions_s', 'distributor', 'Darsh Solar Solutions (S)', '9812243837', NULL, NULL, NULL, 'active', '[darshsolarsolutions@gmail.com](mailto:darshsolarsolutions@gmail.com)', NULL, 'LJUPS5155A', 'Shop No.52 Super Market Azad Nagar Hisar Haryana 125001', 'Hisar', '125001', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(362, NULL, 'sungo_power_solution_s', 'distributor', 'Sungo Power Solution (S)', '9053544001', NULL, NULL, NULL, 'active', '[sungopowersolution@gmail.com](mailto:sungopowersolution@gmail.com)', NULL, 'GTYPR0456L', 'H. no. 9, Shanti nagar, Padayawas Road, Rewari', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(363, NULL, 'shree_balaji_sanitary_and_electrical_store_s', 'distributor', 'Shree Balaji Sanitary and Electrical Store (S)', '9555294879', NULL, NULL, NULL, 'active', '[narendra.kharsu@reddiffmail.com](mailto:narendra.kharsu@reddiffmail.com)', NULL, 'AMGPD3846D', 'Bhiwani Road, Behal', 'Behal', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(364, NULL, 'shree_ram_electronics_s', 'distributor', 'Shree Ram Electronics (S)', '9812176113', NULL, NULL, NULL, 'active', '[shreeramelec.1@gmail.com](mailto:shreeramelec.1@gmail.com)', NULL, 'AZMPK5797K', 'Fancy Chowk, Naya Bazar Road, Bhiwani -127021 Haryana', 'Bhiwani', '127021', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(365, NULL, 'neelmadhav_udyam_ms', 'distributor', 'NEELMADHAV UDYAM (MS)', '8010080830', NULL, NULL, NULL, 'active', '[neelmadhavudyam@gmail.com](mailto:neelmadhavudyam@gmail.com)', NULL, 'CHSPS9993P', '434, FF SECTOR 29, Faridabad 121008 Haryana', 'Faridabad', '121008', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(366, NULL, 's_l_enterprises_s', 'distributor', 'S L Enterprises (S)', '7082981555', NULL, NULL, NULL, 'active', '[sselectricalworld@gmail.com](mailto:sselectricalworld@gmail.com)', NULL, 'AFKFS6318E', '2538, Sec-9-11, Hisar', 'Hisar', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(367, NULL, 'exide_industries_limited_n', 'distributor', 'Exide Industries Limited (N)', '6291226448', NULL, NULL, NULL, 'active', '[pramit.mukherjee@exide.co.in](mailto:pramit.mukherjee@exide.co.in)', NULL, 'AAACE6641E', 'Exide Industries Limited, Exide House 59E, Chowringhee Road, Kolkata -700020', 'Kolkata', '700020', 28, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(368, NULL, 'sls_solar_and_battery_house_s', 'distributor', 'SLS Solar and Battery House (S)', '9991756600', NULL, NULL, NULL, 'active', '[slssolarandbatteryhouse@gmail.com](mailto:slssolarandbatteryhouse@gmail.com)', NULL, 'CIFPS7176E', 'Near Indian Oil Petrol Pump, Mahindergarh Road Kanina', 'Kanina', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(369, NULL, 'r_k_electrical_s', 'distributor', 'R K Electrical (S)', '8950112242', NULL, NULL, NULL, 'active', '[rkelectricalsolar24@gmail.com](mailto:rkelectricalsolar24@gmail.com)', NULL, 'AAYFR0279G', '1088, Ghirai (Hansi)', 'Hansi', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(370, NULL, 'lodhaz_and_co_ms', 'distributor', 'LODHAZ & CO (MS)', '7838880077', NULL, NULL, NULL, 'active', '[lodhaz.co@gmail.com](mailto:lodhaz.co@gmail.com)', NULL, 'AALFL8676L', 'FF03, BPTP District Walk, Block B, Sector 81, Faridabad, 121002', 'Faridabad', '121002', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(371, NULL, 'bansal_electronics_s', 'distributor', 'Bansal Electronics (S)', '9315393939', NULL, NULL, NULL, 'active', '[bansalelectronics22@gmail.com](mailto:bansalelectronics22@gmail.com)', NULL, 'CFRPB9412B', 'Near Aggarwal Dharamshala Old G.T Road Hodal Palwal', 'Palwal', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(372, NULL, 'skytech_destination_private_limited_s', 'distributor', 'Skytech Destination Private Limited (S)', '9312593126', NULL, NULL, NULL, 'active', '[skytechdestination@gmail.com](mailto:skytechdestination@gmail.com)', NULL, 'ABLCS7063C', 'Village Pabra Distt Hisar,125112', 'Hisar', '125112', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(373, NULL, 'zionwatt_energy_private_limited_s', 'distributor', 'Zionwatt Energy Private Limited (S)', '9050698817', NULL, NULL, NULL, 'active', '[info@zionwattenergy.com](mailto:info@zionwattenergy.com)', NULL, 'AACCZ2261K', 'E-203, UGF, Sushant Shopping Arcade, Sushant Lok-1, Gurugram', 'Gurugram', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(374, NULL, 'tejas_solar_solution_s', 'distributor', 'Tejas Solar Solution (S)', '9050608500', NULL, NULL, NULL, 'active', '[tejassolarsolution@gmail.com](mailto:tejassolarsolution@gmail.com)', NULL, 'CCOPP8746E', 'Shop No 1, Opposite Corporation Bank, Railway Road, Palwal', 'Palwal', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(375, NULL, 'shree_ram_electricals_s', 'distributor', 'Shree Ram Electricals (S)', '8950387032', NULL, NULL, NULL, 'active', '[shramelectricalsijnd@gmail.com](mailto:shramelectricalsijnd@gmail.com)', NULL, 'AJZPD8853A', 'Oppsite Hanuman Mandir Apolo Road, Jind', 'Jind', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(376, NULL, 'shiva_battery_house_s', 'distributor', 'Shiva Battery House (S)', '9416065389', NULL, NULL, NULL, 'active', '[robinpowersystemrwr@gmail.com](mailto:robinpowersystemrwr@gmail.com)', NULL, 'AXFPS7291H', 'Near Old Truck Union, Circular Road, Rewari', 'Rewari', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(377, NULL, 'khushi_solar_solutions_s', 'distributor', 'Khushi Solar Solutions (S)', '9416916721', NULL, NULL, NULL, 'active', '[upsbattery.utl@gmail.com](mailto:upsbattery.utl@gmail.com)', NULL, 'EMZPK8915B', 'Near Gitanjali Hospital, Rampura Mor Gurugram Road, Pataudi 122503', 'Pataudi', '122503', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(378, NULL, 'devraj_auto_electric_works_s', 'distributor', 'Devraj Auto Electric Works (S)', '9355911015', NULL, NULL, NULL, 'active', '[devrajautohansi@gmail.com](mailto:devrajautohansi@gmail.com)', NULL, 'ANRPD5215C', 'Near Kali Devi Mandir Hansi Pin code:- 125033', 'Hansi', '125033', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(379, NULL, 'a_one_power_centre_s', 'distributor', 'A ONE POWER CENTRE (S)', '9896350021', NULL, NULL, NULL, 'active', '[aonepower@hotmail.com](mailto:aonepower@hotmail.com)', NULL, 'AEQPK8025D', 'SCO-1, ARYA SCHOOL MARKET, PANIPAT', 'Panipat', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(380, NULL, 'shri_mahavir_enterprises_s', 'distributor', 'Shri Mahavir Enterprises (S)', '9468270047', NULL, NULL, NULL, 'active', '[sme.rtk1@gmail.com](mailto:sme.rtk1@gmail.com)', NULL, 'AMIPG5245M', 'GROUND FLOOR 87, GALI NO 13, RAM GOPAL COLONY, ROHTAK', 'Rohtak', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(381, NULL, 'saar_engineers_s', 'distributor', 'Saar Engineers (S)', '8950182220', NULL, NULL, NULL, 'active', '[sumit.k2852@gmail.com](mailto:sumit.k2852@gmail.com)', NULL, 'DPNPK8648D', 'Shop No. 9, Near Valmiki Dharamshala, Kurukshetra', 'Kurukshetra', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(382, NULL, 'advance_technology_and_engineering_system_s', 'distributor', 'Advance Technology and Engineering System (S)', '9812776800', NULL, NULL, NULL, 'active', '[atesbawal@gmail.com](mailto:atesbawal@gmail.com)', NULL, 'BQAPS1060D', 'Near Govt Boys School, Railway Road, Bawal, Rewari', 'Bawal', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(383, NULL, 'fathe_and_zora_electrical_engineer_s', 'distributor', 'Fathe and Zora Electrical Engineer (S)', '9996878778', NULL, NULL, NULL, 'active', '[fatehsinghjoresingh@gmail.com](mailto:fatehsinghjoresingh@gmail.com)', NULL, 'HLPPS9718L', 'Fatehpuri-125120 (Fatehabad)', 'Fatehabad', '125120', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(384, NULL, 'sun_smart_innovations_s', 'distributor', 'Sun Smart Innovations (S)', '7678413149', NULL, NULL, NULL, 'active', '[sunsmartinnovations@gmail.com](mailto:sunsmartinnovations@gmail.com)', NULL, 'EGYPD1203C', 'D-36, Pinwood Drive, Mahendwara, Bhondsi, Gurugram', 'Gurugram', '000000', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(385, NULL, 'pomera_and_company_ltd_s', 'distributor', 'Pomera and Company Ltd (S)', '9729200073', NULL, NULL, NULL, 'active', '[pomera@pomeraltd.com](mailto:pomera@pomeraltd.com)', NULL, 'AABCP2062P', 'SCO No 9 10 KC Market Opp Govt Girls School Railway Road Karnal 132001', 'Karnal', '132001', 8, NULL, 1, 0, '2026-01-26 15:43:24', '2026-01-26 15:43:24'),
(386, NULL, 'fidus*energy*systems*(s)', 'distributor', 'Fidus Energy Systems (S)', '8860201196', NULL, NULL, NULL, 'active', '[fidusenergy@gmail.com](mailto:fidusenergy@gmail.com)', NULL, 'ACXPY3636R', 'Khata No 338 Garali Khurd Sector 37 B Pataudi Road Opp Sector 37C Main Road T Point Gurugram 122001', 'Gurugram', '122001', 8, NULL, 1, 1, '2026-01-26 15:46:24', '2026-02-09 12:50:17'),
(387, NULL, 'energy*world*(s)', 'distributor', 'Energy World (S)', '9466600611', NULL, NULL, NULL, 'active', '[mukesh@energyworld.co.in](mailto:mukesh@energyworld.co.in)', NULL, 'AAEFE9969N', '521/3 Ward No 3 Hari Nagar Ganaur Sonepat Haryana 131101', 'Ganaur', '131101', 8, NULL, 1, 0, '2026-01-26 15:46:24', '2026-01-26 15:46:24'),
(388, NULL, 'electronics*hub*(s)', 'distributor', 'Electronics Hub (S)', '9315156677', NULL, NULL, NULL, 'active', '[electronicshubrohtak@gmail.com](mailto:electronicshubrohtak@gmail.com)', NULL, 'BMZPP5596G', '945 28 Kamal Colony Rohtak 124001', 'Rohtak', '124001', 8, NULL, 1, 0, '2026-01-26 15:46:24', '2026-01-26 15:46:24'),
(389, NULL, 'parbhakar*shakti*solar*projects*and*technical*consultant*(s)', 'distributor', 'Parbhakar Shakti Solar projects and technical consultant (S)', '9810082403', NULL, NULL, NULL, 'active', '[pssolarprojects@gmail.com](mailto:pssolarprojects@gmail.com)', NULL, 'AAJCP2540G', 'MB-177 Master Block Shakarpur Delhi 110092', 'Delhi', '110092', 32, NULL, 1, 0, '2026-01-26 15:46:24', '2026-01-26 15:46:24'),
(390, NULL, 'solanand*solar*system*(s)', 'distributor', 'Solanand Solar System (S)', '8533800001', NULL, NULL, NULL, 'active', '[solanand2002@yahoo.co.in](mailto:solanand2002@yahoo.co.in)', NULL, 'AEEPG7559N', '6780 4 Khera Chowk Railway Road Ambala City Haryana 134003', 'Ambala', '134003', 8, NULL, 1, 0, '2026-01-26 15:46:24', '2026-01-26 15:46:24'),
(391, NULL, 'ss*distributors*(s)', 'distributor', 'SS Distributors (S)', '7404540009', NULL, NULL, NULL, 'active', '[SS.SOLAR54@GMAIL.COM](mailto:SS.SOLAR54@GMAIL.COM)', NULL, 'AAVPI2564C', '201 Sector 13 Extn Karnal', 'Karnal', '000000', 8, NULL, 1, 0, '2026-01-26 15:46:24', '2026-01-26 15:46:24'),
(392, NULL, 'delsin*power*(s)', 'distributor', 'Delsin Power (S)', '9910135901', NULL, NULL, NULL, 'active', '[projects.delsinpower@gmail.com](mailto:projects.delsinpower@gmail.com)', NULL, 'HYJPK2349C', '3rd Floor 35/1140 DDA Flat Madangir South Delhi 110045', 'Delhi', '110045', 32, NULL, 1, 0, '2026-01-26 15:46:24', '2026-01-26 15:46:24'),
(393, NULL, 'solar*hub*company*(s)', 'distributor', 'Solar Hub Company (S)', '8222007043', NULL, NULL, NULL, 'active', '[thesolarhub@gmail.com](mailto:thesolarhub@gmail.com)', NULL, 'DCVPS0433M', 'Vill- Mangali, Khuddi Road, Ambala Cantt', 'Ambala', '000000', 8, NULL, 1, 0, '2026-01-26 15:46:24', '2026-01-26 15:46:24'),
(394, NULL, 'dexter', 'installer', 'Dexter', NULL, 'https://Dexter', NULL, NULL, 'active', NULL, NULL, NULL, '', '', '', NULL, NULL, 1, 0, '2026-02-09 12:14:45', '2026-02-09 12:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `company_brand`
--

CREATE TABLE `company_brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('manufacturer','authorized_dealer','distributor') NOT NULL DEFAULT 'distributor',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_category`
--

CREATE TABLE `company_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_detail_requests`
--

CREATE TABLE `company_detail_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company_detail_requests`
--

INSERT INTO `company_detail_requests` (`id`, `company_id`, `name`, `mobile_number`, `email`, `location`, `message`, `created_at`, `updated_at`) VALUES
(1, 379, 'Harsh', '7840091293', 'distinctharsh@gmail.com', 'Delhi', 'Test', '2026-01-28 15:10:59', '2026-01-28 15:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `company_product`
--

CREATE TABLE `company_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `is_manufacturer` tinyint(1) NOT NULL DEFAULT 0,
  `stock_status` enum('in_stock','out_of_stock') NOT NULL DEFAULT 'in_stock',
  `price` decimal(10,2) DEFAULT NULL,
  `min_order_qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_reviews`
--

CREATE TABLE `company_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `manual_company_name` varchar(255) DEFAULT NULL,
  `company_url` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewer_state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewer_city` varchar(255) DEFAULT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `normal_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `sales_process_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `price_charged_as_quoted_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `on_schedule_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `installation_quality_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `after_sales_support_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `experience_metrics` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`experience_metrics`)),
  `system_size_kw` decimal(8,2) DEFAULT NULL,
  `system_price` decimal(12,2) DEFAULT NULL,
  `year_installed` int(11) DEFAULT NULL,
  `panel_brand` varchar(255) DEFAULT NULL,
  `inverter_brand` varchar(255) DEFAULT NULL,
  `review_title` varchar(255) DEFAULT NULL,
  `review_text` text NOT NULL,
  `media_paths` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`media_paths`)),
  `primary_media_path` varchar(255) DEFAULT NULL,
  `media_terms_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `review_date` date DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_reviews`
--

INSERT INTO `company_reviews` (`id`, `company_id`, `manual_company_name`, `company_url`, `category_id`, `state_id`, `reviewer_state_id`, `reviewer_city`, `reviewer_name`, `email`, `normal_user_id`, `rating`, `sales_process_rating`, `price_charged_as_quoted_rating`, `on_schedule_rating`, `installation_quality_rating`, `after_sales_support_rating`, `experience_metrics`, `system_size_kw`, `system_price`, `year_installed`, `panel_brand`, `inverter_brand`, `review_title`, `review_text`, `media_paths`, `primary_media_path`, `media_terms_accepted`, `review_date`, `source`, `is_featured`, `is_approved`, `created_at`, `updated_at`) VALUES
(53, NULL, 'Abcd2', 'https://abcd2.com', NULL, NULL, NULL, NULL, 'Harsh', 'harsh.software.dev@gmail.com', 4, 5, 5, 4, 5, 4, 5, '{\"sales_process\":5,\"price_charged_as_quoted\":4,\"on_schedule\":5,\"installation_quality\":4,\"after_sales_support\":5}', NULL, NULL, 2025, NULL, NULL, 'test2', 'test2', '[]', NULL, 1, '2025-12-23', NULL, 0, 1, '2025-12-23 06:49:28', '2025-12-24 06:30:21'),
(54, NULL, 'Distinctharsh', 'https://distinctharsh.com', NULL, NULL, NULL, NULL, 'Harsh', 'harsh.software.dev@gmail.com', 4, 5, 5, 3, 5, 4, 4, '{\"sales_process\":5,\"price_charged_as_quoted\":3,\"on_schedule\":5,\"installation_quality\":4,\"after_sales_support\":4}', NULL, NULL, 2025, NULL, NULL, 'test', 'test', '[]', NULL, 1, '2025-12-23', NULL, 0, 1, '2025-12-23 08:22:10', '2025-12-24 06:30:18'),
(60, NULL, 'Google', 'https://www.google.com/', NULL, NULL, NULL, NULL, 'Deepak Chauhan', 'dcdeepak2408@gmail.com', 5, 3, 4, 3, 3, 0, 4, '{\"sales_process\":4,\"price_charged_as_quoted\":3,\"on_schedule\":3,\"after_sales_support\":4}', 65.00, 10500000.00, 2024, 'REC', 'Subgrow', 'Better in terms of CLoud Storrage', 'Better in terms of CLoud Storrage', '[\"https:\\/\\/solarreviews.distinctharsh.com\\/storage\\/reviews\\/uowYHIXXJRI8peQ1lSPGDi5Goy7zVWUxp9P8gNdp.jpeg\",\"https:\\/\\/solarreviews.distinctharsh.com\\/storage\\/reviews\\/dRuNUWHNOSVSN42pwXjtaCjG3VpxkBLulOjJXtw0.jpg\"]', 'https://solarreviews.distinctharsh.com/storage/reviews/uowYHIXXJRI8peQ1lSPGDi5Goy7zVWUxp9P8gNdp.jpeg', 1, '2025-12-30', NULL, 0, 0, '2025-12-30 18:26:27', '2025-12-30 18:26:27'),
(85, NULL, 'Chatgpt', 'https://chatgpt.com/', NULL, NULL, NULL, NULL, 'Deepak Chauhan', 'orangemedialabss@gmail.com', 8, 3, 3, 4, 3, 4, 3, '{\"sales_process\":3,\"price_charged_as_quoted\":4,\"on_schedule\":3,\"installation_quality\":4,\"after_sales_support\":3}', NULL, NULL, 2026, NULL, NULL, 'Goog Service', 'Goog Service', '[]', NULL, 0, '2026-01-03', NULL, 0, 1, '2026-01-03 03:15:49', '2026-01-03 03:44:47'),
(86, NULL, 'Clinomic', 'https://clinomic.in/', NULL, NULL, NULL, NULL, 'Deepak Chauhan', 'orangemedialabss@gmail.com', 8, 3, 3, 2, 3, 3, 3, '{\"sales_process\":3,\"price_charged_as_quoted\":2,\"on_schedule\":3,\"installation_quality\":3,\"after_sales_support\":3}', 6.50, 10000000.00, 2025, 'REC, Omega', 'Sungrow', 'Good Panel Attachments', 'Good Panel Attachments', '[]', NULL, 1, '2026-01-03', NULL, 0, 1, '2026-01-03 03:42:13', '2026-01-03 03:44:42'),
(91, NULL, 'Speedtest', 'https://www.speedtest.net/', NULL, NULL, NULL, NULL, 'Harsh', 'distinctharsh@gmail.com', 1, 5, 5, 5, 5, 5, 5, '{\"sales_process\":5,\"price_charged_as_quoted\":5,\"on_schedule\":5,\"installation_quality\":5,\"after_sales_support\":5}', NULL, NULL, 2026, NULL, NULL, 'Test', 'Test', '[]', NULL, 1, '2026-01-03', NULL, 0, 0, '2026-01-03 09:32:05', '2026-01-03 09:32:05'),
(92, NULL, 'Ambitionbox', 'https://www.ambitionbox.com/companies-in-new-delhi', NULL, NULL, NULL, NULL, 'Harsh', 'distinctharsh@gmail.com', 1, 4, 4, 4, 4, 4, 3, '{\"sales_process\":4,\"price_charged_as_quoted\":4,\"on_schedule\":4,\"installation_quality\":4,\"after_sales_support\":3}', NULL, NULL, 2026, NULL, NULL, 'Test', 'Test', '[]', NULL, 1, '2026-01-03', NULL, 0, 0, '2026-01-03 10:02:53', '2026-01-03 10:02:53'),
(93, NULL, 'Windsurf', 'https://windsurf.com/profile', NULL, NULL, NULL, NULL, 'Harsh', 'distinctharsh@gmail.com', 1, 4, 5, 3, 5, 3, 5, '{\"sales_process\":5,\"price_charged_as_quoted\":3,\"on_schedule\":5,\"installation_quality\":3,\"after_sales_support\":5}', NULL, NULL, 2026, NULL, NULL, 'test', 'Test', '[]', NULL, 1, '2026-01-03', NULL, 0, 0, '2026-01-03 10:23:01', '2026-01-03 10:23:01'),
(94, NULL, 'Windsurf', 'https://windsurf.com/profile', NULL, NULL, NULL, NULL, 'Harsh', 'distinctharsh@gmail.com', 1, 4, 5, 3, 5, 3, 5, '{\"sales_process\":5,\"price_charged_as_quoted\":3,\"on_schedule\":5,\"installation_quality\":3,\"after_sales_support\":5}', NULL, NULL, 2026, NULL, NULL, 'test', 'Test', '[]', NULL, 1, '2026-01-03', NULL, 0, 0, '2026-01-03 10:23:28', '2026-01-03 10:23:28'),
(95, NULL, 'Ycombinator', 'https://www.ycombinator.com/companies', NULL, NULL, NULL, NULL, 'Harsh', 'distinctharsh@gmail.com', 1, 4, 4, 4, 3, 2, 4, '{\"sales_process\":4,\"price_charged_as_quoted\":4,\"on_schedule\":3,\"installation_quality\":2,\"after_sales_support\":4}', NULL, NULL, 2026, NULL, NULL, 'test', 'Test', '[]', NULL, 1, '2026-01-03', NULL, 0, 0, '2026-01-03 10:31:03', '2026-01-03 10:31:03'),
(103, 394, 'Dexter', 'https://Dexter', NULL, NULL, NULL, NULL, 'Rakesh Mehta', 'rakesh.mehta4@gmail.com', 7, 4, 3, 2, 2, 1, 3, '{\"sales_process\":3,\"price_charged_as_quoted\":2,\"on_schedule\":2,\"installation_quality\":1,\"after_sales_support\":3}', NULL, NULL, 2026, NULL, NULL, NULL, 'installation was average not very good', '[]', NULL, 0, '2026-01-10', NULL, 0, 1, '2026-01-10 03:03:02', '2026-02-09 12:14:46');

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
-- Table structure for table `get_quotes`
--

CREATE TABLE `get_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `get_quotes`
--

INSERT INTO `get_quotes` (`id`, `company_id`, `state_id`, `service_type`, `name`, `mobile_number`, `email`, `location`, `notes`, `created_at`, `updated_at`) VALUES
(2, NULL, 34, 'Solar Panel', 'Harsh', '7840091293', 'distinctharsh@gmail.com', 'Dadra and Nagar Haveli and Daman and Diu', 'Test', '2025-12-22 19:25:15', '2025-12-22 19:25:15'),
(3, NULL, 32, 'Solar Panel', 'Deepak Chauhan', '09990093303', 'dcdeepak2408@gmail.com', 'Andhra Pradesh', 'Solar Panel 1000 QTY', '2025-12-23 06:50:04', '2025-12-23 06:50:04'),
(4, NULL, 32, 'EPC', 'Harsh', '7840091293', 'distinctharsh@gmail.com', 'Delhi', 'Test', '2026-01-03 12:03:18', '2026-01-03 12:03:18'),
(5, NULL, 29, 'Solar Inverter', 'Rohan', '7840091293', 'distinctharsh@gmail.com', 'Delhi', 'Test', '2026-01-03 13:57:07', '2026-01-03 13:57:07'),
(6, NULL, 32, 'EPC', 'Test', '7840091293', 'distinctharsh@gmail.com', 'Delhi', 'Test', '2026-01-03 13:57:47', '2026-01-03 13:57:47');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"1f41139b-cefa-47d1-b47e-b4ef58b197de\",\"displayName\":\"App\\\\Notifications\\\\NewProfileSubmissionNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:50:\\\"App\\\\Notifications\\\\NewProfileSubmissionNotification\\\":2:{s:13:\\\"\\u0000*\\u0000submission\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:32:\\\"App\\\\Models\\\\UserProfileSubmission\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"d76fb56a-03b7-4261-b285-73a8028be4fb\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1766425577,\"delay\":null}', 0, NULL, 1766425577, 1766425577),
(2, 'default', '{\"uuid\":\"8fd53d4f-03cd-4e8d-ad53-cd18e634f9df\",\"displayName\":\"App\\\\Notifications\\\\NewProfileSubmissionNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:50:\\\"App\\\\Notifications\\\\NewProfileSubmissionNotification\\\":2:{s:13:\\\"\\u0000*\\u0000submission\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:32:\\\"App\\\\Models\\\\UserProfileSubmission\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"5df06c4f-0c7a-4bb0-83fa-f9cd453d9a4d\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1767070662,\"delay\":null}', 0, NULL, 1767070662, 1767070662);

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
(4, '2025_11_08_201724_add_is_admin_to_users_table', 1),
(5, '2025_11_26_000001_create_categories_table', 1),
(6, '2025_11_26_000002_create_brands_table', 2),
(7, '2025_11_26_194928_create_states_and_cities_tables', 3),
(8, '2025_11_26_195055_create_companies_table', 3),
(9, '2025_11_26_195132_create_company_category_table', 3),
(10, '2025_11_26_195158_create_company_brand_table', 3),
(11, '2025_11_26_195232_create_products_table', 3),
(12, '2025_11_26_195302_create_product_media_table', 3),
(13, '2025_11_26_195331_create_company_reviews_table', 3),
(14, '2025_11_27_090436_update_categories_table_structure', 4),
(15, '2025_11_27_091234_update_brands_table_structure', 5),
(16, '2025_11_27_091726_add_description_to_brands_table', 6),
(17, '2025_11_27_095108_update_products_table_structure', 7),
(18, '2025_11_27_100218_create_product_specs_table', 8),
(19, '2025_11_27_101848_update_companies_table_structure', 9),
(20, '2025_11_27_113125_add_type_to_company_brand_table', 10),
(21, '2025_11_27_113336_create_company_product_table', 11),
(22, '2025_11_27_113553_update_users_table_schema', 12),
(23, '2025_11_27_114821_create_personal_access_tokens_table', 13),
(24, '2025_11_27_120620_create_reviews_table', 14),
(25, '2025_11_27_120949_create_rating_summaries_table', 15),
(26, '2025_11_27_235900_add_efficiency_to_products_table', 16),
(27, '2025_11_28_000001_create_chatbot_questions_table', 17),
(28, '2025_11_28_000002_create_chatbot_options_table', 17),
(29, '2025_11_28_000003_create_chatbot_user_sessions_table', 17),
(30, '2025_11_28_000004_create_chatbot_user_messages_table', 17),
(31, '2025_12_09_000001_add_is_active_to_categories_table', 18),
(32, '2025_12_10_000002_update_company_reviews_table_additional_fields', 19),
(33, '2025_12_10_010500_add_metric_breakdown_columns_to_company_reviews', 20),
(34, '2025_12_10_175824_update_state_field_in_companies_table', 21),
(35, '2025_12_12_000001_create_user_types_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `normal_users`
--

CREATE TABLE `normal_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_activity_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `normal_users`
--

INSERT INTO `normal_users` (`id`, `name`, `email`, `phone_number`, `provider`, `provider_id`, `avatar_url`, `last_login_at`, `last_activity_at`, `created_at`, `updated_at`) VALUES
(1, 'Harsh', 'distinctharsh@gmail.com', NULL, 'google', '115523251233529732525', 'https://lh3.googleusercontent.com/a/ACg8ocLiTKL0u3Sjoz_FoP-IOtrZJUukwy8na_OhKfzcdGbjAZh7YlLk=s96-c', '2026-01-04 05:28:18', '2026-01-04 05:28:18', '2025-12-20 07:15:24', '2026-01-04 05:28:18'),
(2, 'Harsh', 'harsh@gmail.com', '7840091293', 'manual', NULL, NULL, '2025-12-20 20:35:13', '2025-12-20 20:35:13', '2025-12-20 20:35:13', '2025-12-20 20:35:13'),
(3, 'Kajal Chauhan', 'kr051160@gmail.com', '7840091293', 'google', '102599060821413864573', 'https://lh3.googleusercontent.com/a/ACg8ocKN14dl9aMv4cTbQtDkYyQ2yV2NJE8zQGEBAvf2yO0pi_UbejM=s96-c', '2025-12-30 17:36:56', '2025-12-30 17:36:56', '2025-12-21 05:37:46', '2025-12-30 17:36:56'),
(4, 'Harsh', 'harsh.software.dev@gmail.com', '7840091293', 'google', '110655386612993349450', 'https://lh3.googleusercontent.com/a/ACg8ocIH3Q0AemDyhH2rIcXSr5dWHl7diWnau5BUH9QUV7b2nTHG=s96-c', '2026-01-04 06:06:18', '2026-01-04 06:06:18', '2025-12-22 09:44:04', '2026-01-04 06:06:18'),
(5, 'Deepak Chauhan', 'dcdeepak2408@gmail.com', '7840091293', 'google', '103958502320012823144', 'https://lh3.googleusercontent.com/a/ACg8ocKcuaMx7iyqpDfpIrg5snRtBYgxfcgQUh-a8eqlfAPj_CYXKDPF=s96-c', '2026-01-10 03:25:15', '2026-01-10 03:25:15', '2025-12-22 17:32:55', '2026-01-10 03:25:15'),
(6, 'Harsh Singh', 'harshsingh55818@gmail.com', NULL, 'google', '101510449779934132609', 'https://lh3.googleusercontent.com/a/ACg8ocJ5hecX-Sh6kWxqPSVHmKlKN245P8bBK6N8w9ZTJoFW_FRcvzV9=s96-c', '2026-01-06 04:04:31', '2026-01-06 04:04:31', '2025-12-24 01:02:15', '2026-01-06 04:04:31'),
(7, 'Rakesh Mehta', 'rakesh.mehta4@gmail.com', NULL, 'google', '110256765497808847548', 'https://lh3.googleusercontent.com/a/ACg8ocJeyxl9AaRCfvzsL6DagQpKKiEQ6OJC1E0F3YPpzscSVPQgdTHn=s96-c', '2026-01-10 03:02:49', '2026-01-10 03:02:49', '2025-12-24 14:14:45', '2026-01-10 03:02:49'),
(8, 'Deepak Chauhan', 'orangemedialabss@gmail.com', NULL, 'google', '114735005714966785825', 'https://lh3.googleusercontent.com/a/ACg8ocIudEjwuVI3TzWtf4ZQh2NWTkCzq2yi-PyEzwMnzMiGyGYcrDs=s96-c', '2026-02-09 12:19:01', '2026-02-09 12:19:01', '2026-01-03 03:15:23', '2026-02-09 12:19:01'),
(9, 'Kiyama International', 'kiyamainternational@gmail.com', NULL, 'google', '101627538499168964712', 'https://lh3.googleusercontent.com/a/ACg8ocJosxITs48rQYSioX1J2FmJkArIj-yfzFQRUmmoXcp9jDyjWQ=s96-c', '2026-01-03 04:37:35', '2026-01-03 04:37:35', '2026-01-03 04:37:35', '2026-01-03 04:37:35'),
(10, 'Deepak Digital', 'deepakdigital07@gmail.com', NULL, 'google', '106139328653998941109', 'https://lh3.googleusercontent.com/a/ACg8ocL9gX7dhjLCmnAFjvBwWsyTSn-EEURfsRNYZIm4NNXx48jwuA=s96-c', '2026-01-04 00:28:17', '2026-01-04 00:28:17', '2026-01-04 00:28:17', '2026-01-04 00:28:17'),
(11, 'Manish Singla', 'singla.gaffy@gmail.com', NULL, 'google', '110397013949335962989', 'https://lh3.googleusercontent.com/a/ACg8ocJPBEPVVoKvaOYrbUWzfqoaNpZu-XdPV4ukXP74j9fNWBMT0g=s96-c', '2026-01-10 08:07:10', '2026-01-10 08:07:10', '2026-01-10 08:07:10', '2026-01-10 08:07:10');

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
-- Table structure for table `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `capacity_kw` decimal(10,2) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `technical_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `efficiency` decimal(5,2) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `product_name`, `model_name`, `type`, `capacity_kw`, `size`, `warranty`, `technical_details`, `efficiency`, `slug`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 'Test product', 'ML1', 'Solar Panel', 200.00, '12', 'yes', NULL, NULL, 'test-product', '2025-11-26 23:00:23', '2025-11-26 23:00:23'),
(2, 7, 2, 'HelioMax Prime 555', 'HelioMax Prime 555', 'Solar Panel', 0.56, NULL, '25 years performance', '{\"efficiency\":\"21%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'heliomax-prime-555', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(3, 7, 3, 'HelioMax Duo 600', 'HelioMax Duo 600', 'Solar Panel', 0.60, NULL, '30 years performance', '{\"efficiency\":\"22%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'heliomax-duo-600', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(4, 8, 1, 'VoltEdge Hybrid H5', 'VoltEdge Hybrid H5', 'Hybrid Inverter', 5.00, NULL, '10 years', '{\"efficiency\":\"20%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'voltedge-hybrid-h5', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(5, 8, 3, 'VoltEdge Hybrid H10', 'VoltEdge Hybrid H10', 'Hybrid Inverter', 10.00, NULL, '10 years', '{\"efficiency\":\"21%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'voltedge-hybrid-h10', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(6, 10, 2, 'BrightCell LFP Rack 10kWh', 'BrightCell LFP Rack 10kWh', 'Battery Rack', 10.00, NULL, '8 years', '{\"efficiency\":\"19%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'brightcell-lfp-rack-10kwh', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(7, 10, 1, 'BrightCell LFP Rack 20kWh', 'BrightCell LFP Rack 20kWh', 'Battery Rack', 20.00, NULL, '8 years', '{\"efficiency\":\"21%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'brightcell-lfp-rack-20kwh', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(8, 12, 3, 'EcoRack TerraFix-RT', 'EcoRack TerraFix-RT', 'Rooftop Mount', NULL, NULL, '15 years', '{\"efficiency\":null,\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'ecorack-terrafix-rt', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(9, 12, 2, 'EcoRack TerraFix-GM', 'EcoRack TerraFix-GM', 'Ground Mount', NULL, NULL, '20 years', '{\"efficiency\":null,\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'ecorack-terrafix-gm', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(10, 11, 1, 'Aquila Solar Axis 50', 'Aquila Solar Axis 50', 'String Inverter', 50.00, NULL, '7 years', '{\"efficiency\":\"21%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'aquila-solar-axis-50', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(11, 11, 3, 'Aquila Solar Axis 110', 'Aquila Solar Axis 110', 'String Inverter', 110.00, NULL, '7 years', '{\"efficiency\":\"22%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'aquila-solar-axis-110', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(12, 14, 2, 'PulseVolt SyncDrive 25', 'PulseVolt SyncDrive 25', 'Central Inverter', 25.00, NULL, '10 years', '{\"efficiency\":\"21%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'pulsevolt-syncdrive-25', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(13, 15, 1, 'Terraspan GroundPro 2P', 'Terraspan GroundPro 2P', 'Ground Structure', NULL, NULL, '20 years', '{\"efficiency\":null,\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'terraspan-groundpro-2p', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(14, 16, 3, 'Lumiflow RapidSafe', 'Lumiflow RapidSafe', 'Rapid Shutdown', NULL, NULL, '5 years', '{\"efficiency\":null,\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'lumiflow-rapidsafe', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(15, 18, 2, 'Solaris PumpTech 5HP', 'Solaris PumpTech 5HP', 'Solar Pump', 3.70, NULL, '5 years', '{\"efficiency\":\"20%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'solaris-pumptech-5hp', '2025-12-04 08:01:37', '2025-12-04 08:01:37'),
(16, 18, 1, 'Solaris PumpTech 7.5HP', 'Solaris PumpTech 7.5HP', 'Solar Pump', 5.50, NULL, '5 years', '{\"efficiency\":\"21%\",\"notes\":\"Seed data item for showcase listings.\"}', NULL, 'solaris-pumptech-75hp', '2025-12-04 08:01:37', '2025-12-04 08:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'image',
  `file_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_specs`
--

CREATE TABLE `product_specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `spec_name` varchar(255) NOT NULL,
  `spec_value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_summaries`
--

CREATE TABLE `rating_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reviewable_type` varchar(255) NOT NULL,
  `reviewable_id` bigint(20) UNSIGNED NOT NULL,
  `avg_rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `total_reviews` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_summaries`
--

INSERT INTO `rating_summaries` (`id`, `reviewable_type`, `reviewable_id`, `avg_rating`, `total_reviews`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Company', 2, 4.67, 3, '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(2, 'App\\Models\\Company', 3, 4.33, 3, '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(3, 'App\\Models\\Company', 4, 3.50, 6, '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(4, 'App\\Models\\Company', 5, 4.00, 4, '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(5, 'App\\Models\\Company', 6, 4.33, 3, '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(6, 'App\\Models\\Company', 7, 4.00, 4, '2025-12-04 13:33:02', '2025-12-04 13:33:03'),
(7, 'App\\Models\\Company', 8, 3.83, 6, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(8, 'App\\Models\\Company', 9, 4.33, 3, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(9, 'App\\Models\\Company', 10, 4.20, 5, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(10, 'App\\Models\\Company', 11, 3.50, 6, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(11, 'App\\Models\\Company', 12, 4.33, 6, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(12, 'App\\Models\\Company', 13, 4.67, 3, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(13, 'App\\Models\\Company', 14, 3.40, 5, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(14, 'App\\Models\\Company', 15, 4.40, 5, '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(15, 'App\\Models\\Company', 16, 4.00, 5, '2025-12-04 13:33:03', '2025-12-04 13:33:04'),
(16, 'App\\Models\\Company', 17, 3.80, 5, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(17, 'App\\Models\\Company', 18, 4.20, 5, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(18, 'App\\Models\\Brand', 1, 3.67, 3, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(19, 'App\\Models\\Brand', 2, 4.00, 4, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(20, 'App\\Models\\Brand', 3, 4.00, 5, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(21, 'App\\Models\\Brand', 4, 3.67, 6, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(22, 'App\\Models\\Brand', 5, 4.17, 6, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(23, 'App\\Models\\Brand', 6, 4.00, 3, '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(24, 'App\\Models\\Brand', 7, 3.67, 6, '2025-12-04 13:33:04', '2025-12-04 13:33:05'),
(25, 'App\\Models\\Brand', 8, 3.40, 5, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(26, 'App\\Models\\Brand', 9, 4.33, 6, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(27, 'App\\Models\\Brand', 10, 4.80, 5, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(28, 'App\\Models\\Brand', 11, 4.25, 4, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(29, 'App\\Models\\Brand', 12, 3.80, 5, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(30, 'App\\Models\\Brand', 13, 4.33, 3, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(31, 'App\\Models\\Brand', 14, 3.75, 4, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(32, 'App\\Models\\Brand', 15, 3.67, 3, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(33, 'App\\Models\\Brand', 16, 3.00, 3, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(34, 'App\\Models\\Brand', 17, 4.67, 3, '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(35, 'App\\Models\\Brand', 18, 3.67, 3, '2025-12-04 13:33:05', '2025-12-04 13:33:06'),
(36, 'App\\Models\\Brand', 19, 4.75, 4, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(37, 'App\\Models\\Brand', 20, 4.00, 3, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(38, 'App\\Models\\Brand', 21, 3.75, 4, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(39, 'App\\Models\\Product', 1, 3.25, 4, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(40, 'App\\Models\\Product', 2, 4.00, 5, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(41, 'App\\Models\\Product', 3, 4.00, 3, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(42, 'App\\Models\\Product', 4, 4.00, 4, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(43, 'App\\Models\\Product', 5, 3.75, 4, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(44, 'App\\Models\\Product', 6, 4.33, 6, '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(45, 'App\\Models\\Product', 7, 3.83, 6, '2025-12-04 13:33:06', '2025-12-04 13:33:07'),
(46, 'App\\Models\\Product', 8, 3.75, 4, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(47, 'App\\Models\\Product', 9, 3.67, 3, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(48, 'App\\Models\\Product', 10, 4.00, 5, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(49, 'App\\Models\\Product', 11, 4.00, 5, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(50, 'App\\Models\\Product', 12, 4.00, 3, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(51, 'App\\Models\\Product', 13, 4.00, 6, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(52, 'App\\Models\\Product', 14, 3.33, 3, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(53, 'App\\Models\\Product', 15, 4.20, 5, '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(54, 'App\\Models\\Product', 16, 4.20, 5, '2025-12-04 13:33:07', '2025-12-09 15:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reviewable_type` varchar(255) NOT NULL,
  `reviewable_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `reviewable_type`, `reviewable_id`, `rating`, `title`, `comment`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Company', 2, 5, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(2, 2, 'App\\Models\\Company', 2, 5, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(3, 1, 'App\\Models\\Company', 2, 4, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(4, 2, 'App\\Models\\Company', 3, 5, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(5, 1, 'App\\Models\\Company', 3, 3, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(6, 2, 'App\\Models\\Company', 3, 5, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(7, 2, 'App\\Models\\Company', 4, 3, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(8, 1, 'App\\Models\\Company', 4, 3, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(9, 1, 'App\\Models\\Company', 4, 5, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(10, 2, 'App\\Models\\Company', 4, 4, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(11, 1, 'App\\Models\\Company', 4, 3, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(12, 1, 'App\\Models\\Company', 4, 3, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(13, 1, 'App\\Models\\Company', 5, 4, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(14, 2, 'App\\Models\\Company', 5, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(15, 1, 'App\\Models\\Company', 5, 4, 'Solid choice', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(16, 1, 'App\\Models\\Company', 5, 4, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(17, 1, 'App\\Models\\Company', 6, 5, 'Solid choice', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(18, 2, 'App\\Models\\Company', 6, 3, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(19, 2, 'App\\Models\\Company', 6, 5, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(20, 1, 'App\\Models\\Company', 7, 5, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(21, 1, 'App\\Models\\Company', 7, 3, 'Solid choice', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(22, 2, 'App\\Models\\Company', 7, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:02', '2025-12-04 13:33:02'),
(23, 2, 'App\\Models\\Company', 7, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(24, 2, 'App\\Models\\Company', 8, 5, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(25, 2, 'App\\Models\\Company', 8, 3, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(26, 1, 'App\\Models\\Company', 8, 5, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(27, 2, 'App\\Models\\Company', 8, 4, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(28, 1, 'App\\Models\\Company', 8, 3, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(29, 1, 'App\\Models\\Company', 8, 3, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(30, 1, 'App\\Models\\Company', 9, 5, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(31, 2, 'App\\Models\\Company', 9, 3, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(32, 2, 'App\\Models\\Company', 9, 5, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(33, 1, 'App\\Models\\Company', 10, 5, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(34, 2, 'App\\Models\\Company', 10, 4, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(35, 2, 'App\\Models\\Company', 10, 4, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(36, 1, 'App\\Models\\Company', 10, 5, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(37, 2, 'App\\Models\\Company', 10, 3, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(38, 1, 'App\\Models\\Company', 11, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(39, 1, 'App\\Models\\Company', 11, 3, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(40, 1, 'App\\Models\\Company', 11, 3, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(41, 2, 'App\\Models\\Company', 11, 4, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(42, 1, 'App\\Models\\Company', 11, 3, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(43, 1, 'App\\Models\\Company', 11, 4, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(44, 2, 'App\\Models\\Company', 12, 4, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(45, 2, 'App\\Models\\Company', 12, 3, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(46, 2, 'App\\Models\\Company', 12, 5, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(47, 2, 'App\\Models\\Company', 12, 4, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(48, 1, 'App\\Models\\Company', 12, 5, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(49, 1, 'App\\Models\\Company', 12, 5, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(50, 1, 'App\\Models\\Company', 13, 4, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(51, 2, 'App\\Models\\Company', 13, 5, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(52, 2, 'App\\Models\\Company', 13, 5, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(53, 1, 'App\\Models\\Company', 14, 5, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(54, 1, 'App\\Models\\Company', 14, 3, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(55, 1, 'App\\Models\\Company', 14, 3, 'Solid choice', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(56, 1, 'App\\Models\\Company', 14, 3, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(57, 1, 'App\\Models\\Company', 14, 3, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(58, 1, 'App\\Models\\Company', 15, 4, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(59, 2, 'App\\Models\\Company', 15, 4, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(60, 2, 'App\\Models\\Company', 15, 5, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(61, 1, 'App\\Models\\Company', 15, 4, 'Solid choice', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(62, 1, 'App\\Models\\Company', 15, 5, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(63, 1, 'App\\Models\\Company', 16, 3, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(64, 2, 'App\\Models\\Company', 16, 5, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(65, 2, 'App\\Models\\Company', 16, 5, 'Solid choice', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(66, 2, 'App\\Models\\Company', 16, 3, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:03', '2025-12-04 13:33:03'),
(67, 1, 'App\\Models\\Company', 16, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(68, 2, 'App\\Models\\Company', 17, 4, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(69, 2, 'App\\Models\\Company', 17, 4, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(70, 2, 'App\\Models\\Company', 17, 5, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(71, 2, 'App\\Models\\Company', 17, 3, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(72, 2, 'App\\Models\\Company', 17, 3, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(73, 2, 'App\\Models\\Company', 18, 4, 'Solid choice', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(74, 1, 'App\\Models\\Company', 18, 4, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(75, 1, 'App\\Models\\Company', 18, 5, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(76, 1, 'App\\Models\\Company', 18, 3, 'Solid choice', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(77, 1, 'App\\Models\\Company', 18, 5, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(78, 1, 'App\\Models\\Brand', 1, 5, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(79, 2, 'App\\Models\\Brand', 1, 3, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(80, 2, 'App\\Models\\Brand', 1, 3, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(81, 2, 'App\\Models\\Brand', 2, 4, 'Reliable ops', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(82, 2, 'App\\Models\\Brand', 2, 4, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(83, 2, 'App\\Models\\Brand', 2, 5, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(84, 1, 'App\\Models\\Brand', 2, 3, 'Reliable ops', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(85, 1, 'App\\Models\\Brand', 3, 4, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(86, 2, 'App\\Models\\Brand', 3, 5, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(87, 1, 'App\\Models\\Brand', 3, 3, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(88, 2, 'App\\Models\\Brand', 3, 3, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(89, 2, 'App\\Models\\Brand', 3, 5, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(90, 2, 'App\\Models\\Brand', 4, 3, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(91, 1, 'App\\Models\\Brand', 4, 5, 'Solid choice', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(92, 2, 'App\\Models\\Brand', 4, 3, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(93, 1, 'App\\Models\\Brand', 4, 4, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(94, 1, 'App\\Models\\Brand', 4, 4, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(95, 1, 'App\\Models\\Brand', 4, 3, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(96, 2, 'App\\Models\\Brand', 5, 3, 'Solid choice', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(97, 1, 'App\\Models\\Brand', 5, 4, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(98, 1, 'App\\Models\\Brand', 5, 5, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(99, 2, 'App\\Models\\Brand', 5, 5, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(100, 2, 'App\\Models\\Brand', 5, 5, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(101, 1, 'App\\Models\\Brand', 5, 3, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(102, 1, 'App\\Models\\Brand', 6, 5, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(103, 2, 'App\\Models\\Brand', 6, 3, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(104, 2, 'App\\Models\\Brand', 6, 4, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(105, 1, 'App\\Models\\Brand', 7, 5, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(106, 1, 'App\\Models\\Brand', 7, 3, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(107, 1, 'App\\Models\\Brand', 7, 4, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(108, 1, 'App\\Models\\Brand', 7, 3, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(109, 2, 'App\\Models\\Brand', 7, 3, 'Solid choice', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:04', '2025-12-04 13:33:04'),
(110, 2, 'App\\Models\\Brand', 7, 4, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(111, 1, 'App\\Models\\Brand', 8, 3, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(112, 1, 'App\\Models\\Brand', 8, 4, 'Solid choice', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(113, 1, 'App\\Models\\Brand', 8, 4, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(114, 1, 'App\\Models\\Brand', 8, 3, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(115, 2, 'App\\Models\\Brand', 8, 3, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(116, 2, 'App\\Models\\Brand', 9, 3, 'Solid choice', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(117, 2, 'App\\Models\\Brand', 9, 4, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(118, 2, 'App\\Models\\Brand', 9, 4, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(119, 2, 'App\\Models\\Brand', 9, 5, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(120, 2, 'App\\Models\\Brand', 9, 5, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(121, 2, 'App\\Models\\Brand', 9, 5, 'Solid choice', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(122, 1, 'App\\Models\\Brand', 10, 5, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(123, 2, 'App\\Models\\Brand', 10, 5, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(124, 2, 'App\\Models\\Brand', 10, 4, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(125, 2, 'App\\Models\\Brand', 10, 5, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(126, 1, 'App\\Models\\Brand', 10, 5, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(127, 1, 'App\\Models\\Brand', 11, 4, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(128, 2, 'App\\Models\\Brand', 11, 5, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(129, 1, 'App\\Models\\Brand', 11, 4, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(130, 1, 'App\\Models\\Brand', 11, 4, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(131, 1, 'App\\Models\\Brand', 12, 5, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(132, 2, 'App\\Models\\Brand', 12, 3, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(133, 2, 'App\\Models\\Brand', 12, 5, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(134, 2, 'App\\Models\\Brand', 12, 3, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(135, 1, 'App\\Models\\Brand', 12, 3, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(136, 1, 'App\\Models\\Brand', 13, 3, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(137, 2, 'App\\Models\\Brand', 13, 5, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(138, 2, 'App\\Models\\Brand', 13, 5, 'Reliable ops', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(139, 2, 'App\\Models\\Brand', 14, 3, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(140, 1, 'App\\Models\\Brand', 14, 3, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(141, 2, 'App\\Models\\Brand', 14, 5, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(142, 2, 'App\\Models\\Brand', 14, 4, 'Reliable ops', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(143, 1, 'App\\Models\\Brand', 15, 3, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(144, 2, 'App\\Models\\Brand', 15, 3, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(145, 2, 'App\\Models\\Brand', 15, 5, 'Solid choice', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(146, 1, 'App\\Models\\Brand', 16, 3, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(147, 1, 'App\\Models\\Brand', 16, 3, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(148, 2, 'App\\Models\\Brand', 16, 3, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(149, 2, 'App\\Models\\Brand', 17, 4, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(150, 2, 'App\\Models\\Brand', 17, 5, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(151, 1, 'App\\Models\\Brand', 17, 5, 'Solid choice', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(152, 2, 'App\\Models\\Brand', 18, 5, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(153, 1, 'App\\Models\\Brand', 18, 3, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(154, 1, 'App\\Models\\Brand', 18, 3, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:05', '2025-12-04 13:33:05'),
(155, 1, 'App\\Models\\Brand', 19, 5, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(156, 2, 'App\\Models\\Brand', 19, 5, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(157, 2, 'App\\Models\\Brand', 19, 5, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(158, 1, 'App\\Models\\Brand', 19, 4, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(159, 2, 'App\\Models\\Brand', 20, 4, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(160, 2, 'App\\Models\\Brand', 20, 4, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(161, 2, 'App\\Models\\Brand', 20, 4, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(162, 2, 'App\\Models\\Brand', 21, 4, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(163, 2, 'App\\Models\\Brand', 21, 3, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(164, 1, 'App\\Models\\Brand', 21, 5, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(165, 1, 'App\\Models\\Brand', 21, 3, 'Solid choice', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(166, 2, 'App\\Models\\Product', 1, 3, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(167, 1, 'App\\Models\\Product', 1, 3, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(168, 1, 'App\\Models\\Product', 1, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(169, 1, 'App\\Models\\Product', 1, 3, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(170, 2, 'App\\Models\\Product', 2, 4, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(171, 2, 'App\\Models\\Product', 2, 3, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(172, 2, 'App\\Models\\Product', 2, 4, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(173, 1, 'App\\Models\\Product', 2, 4, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(174, 1, 'App\\Models\\Product', 2, 5, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(175, 2, 'App\\Models\\Product', 3, 4, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(176, 1, 'App\\Models\\Product', 3, 4, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(177, 2, 'App\\Models\\Product', 3, 4, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(178, 2, 'App\\Models\\Product', 4, 5, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(179, 1, 'App\\Models\\Product', 4, 4, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(180, 1, 'App\\Models\\Product', 4, 3, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(181, 2, 'App\\Models\\Product', 4, 4, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(182, 1, 'App\\Models\\Product', 5, 3, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(183, 1, 'App\\Models\\Product', 5, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(184, 2, 'App\\Models\\Product', 5, 4, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(185, 2, 'App\\Models\\Product', 5, 4, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(186, 1, 'App\\Models\\Product', 6, 5, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(187, 1, 'App\\Models\\Product', 6, 5, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(188, 2, 'App\\Models\\Product', 6, 4, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(189, 1, 'App\\Models\\Product', 6, 4, 'Reliable ops', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(190, 2, 'App\\Models\\Product', 6, 4, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(191, 1, 'App\\Models\\Product', 6, 4, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(192, 2, 'App\\Models\\Product', 7, 3, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(193, 2, 'App\\Models\\Product', 7, 4, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(194, 1, 'App\\Models\\Product', 7, 4, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(195, 1, 'App\\Models\\Product', 7, 4, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(196, 2, 'App\\Models\\Product', 7, 4, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:06', '2025-12-04 13:33:06'),
(197, 2, 'App\\Models\\Product', 7, 4, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(198, 1, 'App\\Models\\Product', 8, 3, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(199, 2, 'App\\Models\\Product', 8, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(200, 1, 'App\\Models\\Product', 8, 5, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(201, 1, 'App\\Models\\Product', 8, 3, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(202, 1, 'App\\Models\\Product', 9, 4, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(203, 1, 'App\\Models\\Product', 9, 3, 'Worth it', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(204, 1, 'App\\Models\\Product', 9, 4, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(205, 2, 'App\\Models\\Product', 10, 4, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(206, 2, 'App\\Models\\Product', 10, 3, 'Worth it', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(207, 2, 'App\\Models\\Product', 10, 4, 'Worth it', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(208, 2, 'App\\Models\\Product', 10, 4, 'Reliable ops', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(209, 1, 'App\\Models\\Product', 10, 5, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(210, 1, 'App\\Models\\Product', 11, 5, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(211, 1, 'App\\Models\\Product', 11, 4, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(212, 2, 'App\\Models\\Product', 11, 4, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(213, 2, 'App\\Models\\Product', 11, 3, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(214, 2, 'App\\Models\\Product', 11, 4, 'Solid choice', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(215, 2, 'App\\Models\\Product', 12, 3, 'Worth it', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(216, 2, 'App\\Models\\Product', 12, 5, 'Solid choice', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(217, 2, 'App\\Models\\Product', 12, 4, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(218, 2, 'App\\Models\\Product', 13, 3, 'Worth it', 'Saw a big drop in bills within the first cycle.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(219, 2, 'App\\Models\\Product', 13, 4, 'Reliable ops', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(220, 2, 'App\\Models\\Product', 13, 5, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(221, 2, 'App\\Models\\Product', 13, 4, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(222, 1, 'App\\Models\\Product', 13, 3, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(223, 2, 'App\\Models\\Product', 13, 5, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(224, 2, 'App\\Models\\Product', 14, 3, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(225, 2, 'App\\Models\\Product', 14, 4, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(226, 2, 'App\\Models\\Product', 14, 3, 'Reliable ops', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(227, 2, 'App\\Models\\Product', 15, 4, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(228, 1, 'App\\Models\\Product', 15, 5, 'Reliable ops', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(229, 2, 'App\\Models\\Product', 15, 5, 'Worth it', 'Installation crew maintained good safety practices.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(230, 1, 'App\\Models\\Product', 15, 3, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(231, 1, 'App\\Models\\Product', 15, 4, 'Reliable ops', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(232, 2, 'App\\Models\\Product', 16, 3, 'Worth it', 'After-sales service was proactive and transparent.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(233, 1, 'App\\Models\\Product', 16, 5, 'Solid choice', 'Delivery was quick and documentation crystal clear.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(234, 1, 'App\\Models\\Product', 16, 3, 'Solid choice', 'Monitoring app could be prettier but data is accurate.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(235, 2, 'App\\Models\\Product', 16, 5, 'Solid choice', 'Great value for money compared to other bids.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07'),
(236, 1, 'App\\Models\\Product', 16, 5, 'Reliable ops', 'Super helpful support team and neat workmanship.', '[]', '2025-12-04 13:33:07', '2025-12-04 13:33:07');

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
('8Vj7iaOtRH3e19NZboQKKY9JNTdqYNaIZIBQHoMO', NULL, '2405:201:4014:2042:dd86:310:454:b897', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzlCSjJxaUR2dXkydUFwbURZbk9zUjFDV2x5RWZwOUwzVHh0TTVKSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767191774),
('dC8PslMvRjkGcQyKahjMuPSLkiokoW6UlcZLPwEL', NULL, '164.100.206.129', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidXh5MWhLTTZBRGhTMklnVkppUFA1OWdXYkVWOUQ5em1UT1pZY0dvUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tL3Byb2ZpbGUvcmV2aWV3cyI7czo1OiJyb3V0ZSI7czoyNToibm9ybWFsLXVzZXIucmV2aWV3cy5pbmRleCI7fXM6MTI6InJldmlld19waG9uZSI7czoxMDoiNzg0MDA5MTI5MyI7czoxNDoicmV2aWV3X3Byb2ZpbGUiO2E6NTp7czo0OiJuYW1lIjtzOjU6IkhhcnNoIjtzOjU6ImVtYWlsIjtzOjI4OiJoYXJzaC5zb2Z0d2FyZS5kZXZAZ21haWwuY29tIjtzOjY6ImF2YXRhciI7czo5NDoiaHR0cHM6Ly9saDMuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2EvQUNnOG9jSUgzUTBBZW1EeWhIMnJJY1hTcjVkV0hsN2RpV25hdTVCVUg5UVVWN2IyblRIRz1zOTYtYyI7czo4OiJwcm92aWRlciI7czo2OiJnb29nbGUiO3M6MTE6InByb3ZpZGVyX2lkIjtzOjIxOiIxMTA2NTUzODY2MTI5OTMzNDk0NTAiO31zOjE0OiJub3JtYWxfdXNlcl9pZCI7aTo0O30=', 1767183016),
('dm8KBTEQW9VcCaFV7ixmr1Z3J7hc2ki3iZsHmOvS', NULL, '2405:201:4014:2042:cd5b:ac11:b522:2afb', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFBNbExoeElFekpRd1VpODYwZ0VyWjY1SXVlcW04Z0RKVER6REpKaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767241758),
('dWFn9xASXTmJtnsEyy9voFOPftzBUG7Wm2L9LEKY', NULL, '54.153.54.50', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_4_3) Gecko/20100812 Firefox/21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1k3dXdqRk9SU2ZXbzc4YkFUM2JBOHBvQVdtN1IzSUlkYzhvYzJvbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767323784),
('FRKiZjVOLjrSF2UZf38vWIWeLZSph25w8dO5ijSm', NULL, '54.153.54.50', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_4_3) Gecko/20100812 Firefox/21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0hUMUIwaW4xelNPQ2ozZzZBdHNsaWZSOXJUd1IwMTZOaU1JUWowMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767324659),
('fWGSHz2FW7dHJxcW9zOKghb3yGXA1RSOtON3fKNx', NULL, '2405:201:4014:2042:f114:defc:ec11:1d0e', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTh4SjI3YWt3Z1FqZHRTUGU1RDI3d2RKYmdUVURFM3Q5eERoRmFobSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767167538),
('GueSFljON8hkficRxDB8h4bByFvTzfnjuSrHlOZ8', NULL, '3.231.70.17', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTld2blBFeEc4YlYwaHhINURNam1PSzg3UjZyM1R1Z2p6VnhWcTBGMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767185541),
('j1QXKnx2bPJnALUWbhQ7H6w2TCVjYS9EGRr6PklE', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMVdIYkhVc2xZOXpUampBZmVmQlJoc1R4YkYxdUtSeGIzYUtUVWFUayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767241138),
('mQNSCCTuMoLGQrHBOgp0WsyhXsEKckeW2VjUQMcv', NULL, '2405:201:4014:2042:94cb:ff2e:a333:d7f1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkJBSnloRG05QUFzNFpmVkg5NmFMczBwZ1dVNW1Bd05YQzd6dUVpQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767167285),
('PI9wHKEvqwsUDvnFGiHQScIkQLm8DehFLMr2zAof', NULL, '2405:201:4014:2042:fc31:fb56:82e1:7f3f', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1ZBcll5S0N5UmFiRTJ6ajVUTkVXSGV0RVN1TW5Na0RXNmZXaDZqTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767202840),
('tRjouEZmiXYvhswu8t8IkfAo5YeKm0pJhxnJhg8h', NULL, '2405:201:4014:2042:cd5b:ac11:b522:2afb', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemZwRGtOVE9pVlVxd1d3djQwREdoZVdrcVdQUGZzVmJZY0RLbUd1MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767242932),
('TwBGT6FGCClsPKQ4J2FK6L3sdv2Kk6xTahs5Eiu3', NULL, '3.231.70.17', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN21TN0V3a2lEaWM3VUhhUVR3S200WkNwVkttd2sxUkJ1Yk5yMmdsNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767196264),
('VDzFHzENoKqYrq9siLqIlRmOiJNfFGNAf8aT2vlh', NULL, '2409:40d0:2028:1158:28ab:cda:82ea:63ed', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTdXRkhyMVdRV1VrYlI2a0ZYWVlhdzh5N3JuUGRGVDdFQjlzeldpdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767275692),
('X7QCWg5zkSVmJzVWK43GdLDQP1sX7eodHvkqlvcH', NULL, '2409:40d0:2028:1158:550c:e31d:23d8:3d76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDB0NFZlRFBpOWRDOVBuTTF1dEF1cU43amw4Y1czNkwyNEhRM1ZuRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767200470),
('YFZ7yi5rfDeP4FXzTmjrGUZuIO9GEoZ9huK8emd7', NULL, '2409:40d0:2028:1158:550c:e31d:23d8:3d76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWl0dWhzM3pxZjNORmpSVU1RamVBVnJicWRCSHduQUZQSnBBVnhybiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767212000);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `slug`, `code`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Andhra Pradesh', 'andhra-pradesh', 'AP', 'Top solar companies in Andhra Pradesh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(2, 'Arunachal Pradesh', 'arunachal-pradesh', 'AR', 'Top solar companies in Arunachal Pradesh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(3, 'Assam', 'assam', 'AS', 'Top solar companies in Assam', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(4, 'Bihar', 'bihar', 'BR', 'Top solar companies in Bihar', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(5, 'Chhattisgarh', 'chhattisgarh', 'CG', 'Top solar companies in Chhattisgarh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(6, 'Goa', 'goa', 'GA', 'Top solar companies in Goa', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(7, 'Gujarat', 'gujarat', 'GJ', 'Top solar companies in Gujarat', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(8, 'Haryana', 'haryana', 'HR', 'Top solar companies in Haryana', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(9, 'Himachal Pradesh', 'himachal-pradesh', 'HP', 'Top solar companies in Himachal Pradesh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(10, 'Jharkhand', 'jharkhand', 'JH', 'Top solar companies in Jharkhand', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(11, 'Karnataka', 'karnataka', 'KA', 'Top solar companies in Karnataka', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(12, 'Kerala', 'kerala', 'KL', 'Top solar companies in Kerala', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(13, 'Madhya Pradesh', 'madhya-pradesh', 'MP', 'Top solar companies in Madhya Pradesh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(14, 'Maharashtra', 'maharashtra', 'MH', 'Top solar companies in Maharashtra', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(15, 'Manipur', 'manipur', 'MN', 'Top solar companies in Manipur', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(16, 'Meghalaya', 'meghalaya', 'ML', 'Top solar companies in Meghalaya', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(17, 'Mizoram', 'mizoram', 'MZ', 'Top solar companies in Mizoram', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(18, 'Nagaland', 'nagaland', 'NL', 'Top solar companies in Nagaland', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(19, 'Odisha', 'odisha', 'OD', 'Top solar companies in Odisha', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(20, 'Punjab', 'punjab', 'PB', 'Top solar companies in Punjab', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(21, 'Rajasthan', 'rajasthan', 'RJ', 'Top solar companies in Rajasthan', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(22, 'Sikkim', 'sikkim', 'SK', 'Top solar companies in Sikkim', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(23, 'Tamil Nadu', 'tamil-nadu', 'TN', 'Top solar companies in Tamil Nadu', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(24, 'Telangana', 'telangana', 'TG', 'Top solar companies in Telangana', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(25, 'Tripura', 'tripura', 'TR', 'Top solar companies in Tripura', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(26, 'Uttar Pradesh', 'uttar-pradesh', 'UP', 'Top solar companies in Uttar Pradesh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(27, 'Uttarakhand', 'uttarakhand', 'UK', 'Top solar companies in Uttarakhand', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(28, 'West Bengal', 'west-bengal', 'WB', 'Top solar companies in West Bengal', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(29, 'Andaman and Nicobar Islands', 'andaman-and-nicobar-islands', 'AN', 'Top solar companies in Andaman and Nicobar Islands', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(30, 'Chandigarh', 'chandigarh', 'CH', 'Top solar companies in Chandigarh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(31, 'Dadra and Nagar Haveli and Daman and Diu', 'dadra-and-nagar-haveli-and-daman-and-diu', 'DN', 'Top solar companies in Dadra and Nagar Haveli and Daman and Diu', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(32, 'Delhi', 'delhi', 'DL', 'Top solar companies in Delhi', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(33, 'Jammu and Kashmir', 'jammu-and-kashmir', 'JK', 'Top solar companies in Jammu and Kashmir', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(34, 'Ladakh', 'ladakh', 'LA', 'Top solar companies in Ladakh', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(35, 'Lakshadweep', 'lakshadweep', 'LD', 'Top solar companies in Lakshadweep', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26'),
(36, 'Puducherry', 'puducherry', 'PY', 'Top solar companies in Puducherry', 1, '2025-11-26 14:44:26', '2025-11-26 14:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `user_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `phone` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','staff','viewer') NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `name`, `email`, `email_verified_at`, `is_admin`, `user_type_id`, `status`, `phone`, `is_active`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'admin@solar.com', NULL, 1, NULL, 'active', NULL, 1, '$2y$12$z.p20sd19EhMQ1wo2oX5s.5sW4QpJLXfx7gGrw.FM52F9EsCKdkHe', 'admin', 'Rl7GvABCpt88j7LDSU5A670VW32eOAhgQ4yu1LxPOYB88ZrxmFMtL9q22HR2', '2025-11-26 13:39:05', '2025-11-26 13:39:05'),
(2, NULL, 'Harsh', 'harsh@gmail.com', NULL, 0, 1, 'active', '+917840091293', 1, '$2y$12$TP3ppUk3awgEEpvO2knN2OG3YuLE.ZatSJWKW1vx0QJuJS5KpeLCy', 'admin', NULL, '2025-11-27 14:37:57', '2025-11-27 14:37:57'),
(3, NULL, 'Harsh', 'harsh1@gmail.com', NULL, 0, 2, 'active', '+917840091293', 1, '$2y$12$UgO8BfdPGmQ5UussX.P6Mu/9OeSTYbsuIPxvZW7Y93VNa6YvNbmK.', 'admin', NULL, '2025-12-11 16:17:08', '2025-12-11 16:17:08'),
(4, NULL, 'test', 'test@test.com', NULL, 0, 1, 'active', '+917840091293', 1, '$2y$12$AudXT.kdKo6dCQLUUwhLK.yBVGS0rLGdV6ijxLw7dL1v6/JY333SO', 'admin', NULL, '2025-12-13 19:30:36', '2025-12-13 19:30:36'),
(5, NULL, 'Nupur Das', 'project@dexter-chem.com', NULL, 0, 1, 'active', '+919205611520', 1, '$2y$12$oY1vYHOrAXa/vLpYprgXOOve4xLzdi1miBxj33nTp7p1/HkuQmr7i', 'admin', NULL, '2025-12-16 09:10:13', '2025-12-16 09:10:13'),
(6, NULL, 'Deepak Chauhan', 'dcdeepak2408@gmail.com', NULL, 0, 2, 'active', '+919990093303', 1, '$2y$12$F8b.xR0Bss143YjT0BqUfOebrfPPKLNAonWGiXxvb30GzBuBCJX.K', 'admin', NULL, '2025-12-22 17:43:07', '2025-12-22 17:43:07'),
(7, NULL, 'NewNew', 'new@gmail.com', NULL, 0, 1, 'active', '+917840091293', 1, '$2y$12$Uz4GJROpako78CI72O1xmewL/TcN3pL4c/2mftwF84e/oxSr7tHJC', 'admin', NULL, '2025-12-30 04:55:26', '2025-12-30 04:55:26'),
(8, NULL, 'Naresh', 'naresh@gmail.com', NULL, 0, 2, 'active', '7840091293', 1, '$2y$12$0iOHogYgl2KoJOpQnvsij.ro7Z8EtvOPH7s3ALisVi4mk8cB2CNQW', 'admin', NULL, '2025-12-31 07:37:05', '2025-12-31 07:37:05'),
(9, NULL, 'Harsh', 'distinctharsh@gmail.com', NULL, 0, 2, 'active', '78400 91293', 1, '$2y$12$KoOBS1kb5R34OFqyYnKegOMW.TXPUpflS2PUTJ4GUdye1V.m.EsRS', 'admin', NULL, '2026-01-03 02:19:04', '2026-01-03 02:19:04'),
(10, NULL, 'Harsh', 'harsh.software.dev@gmail.com', NULL, 0, 2, 'active', '+917840091293', 1, '$2y$12$8aaTuXO/FTMaPIp0NInf..c3V/9SfNRdTWcLcr45i0QCY3LD4OvFS', 'admin', NULL, '2026-01-04 05:55:31', '2026-01-04 05:55:31'),
(11, NULL, 'Deepak Chauhan', 'orangemedialabss@gmail.com', NULL, 0, 2, 'active', '+918802821151', 1, '$2y$12$NB5ZfmQgFLbpwt/iFgFRd.LwoVGoog9bwOBKEjPeoR0QYR9J4umOC', 'admin', NULL, '2026-01-21 03:50:27', '2026-01-21 03:50:27'),
(12, NULL, 'Deepak Chauhan', 'deepak@orangemedialabs.com', NULL, 0, 2, 'active', '+918802821151', 1, '$2y$12$zn19Yv2Jyqtzwa5Zu1GFn./riOmA8BgVw9vNbN7Yuqw0EK7/b9fAS', 'admin', NULL, '2026-01-21 03:54:11', '2026-01-21 03:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_submissions`
--

CREATE TABLE `user_profile_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `form_type` varchar(255) NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payload`)),
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `review_notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile_submissions`
--

INSERT INTO `user_profile_submissions` (`id`, `user_id`, `form_type`, `payload`, `status`, `review_notes`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'supplier', '{\"company_name\":\"Test\",\"registered_name\":\"Test\",\"business_type\":\"Manufacturer\",\"year_of_establishment\":\"2012\",\"registered_address\":\"Test\",\"corporate_address\":\"Test\",\"gst_number\":\"123456\",\"pan_number\":\"123456\",\"cin_number\":\"123456\",\"iso_certified\":\"yes\",\"primary_contact\":\"Harsh\",\"primary_designation\":\"Software Engineer\",\"primary_mobile\":\"7840091293\",\"primary_email\":\"distinctharsh@gmail.com\",\"alternate_contact\":\"123456\",\"alternate_mobile\":\"123456\",\"website_url\":null,\"product_types\":null,\"product_categories\":[\"Solar Panels\",\"Inverters\",\"Structures\",\"Batteries\"],\"key_brands\":null,\"payment_terms\":null,\"lead_time\":null,\"logistics_capabilities\":null,\"credit_period\":null,\"major_clients\":null,\"industry_experience_years\":null,\"reference_contacts\":null,\"signature\":null,\"declaration_date\":null,\"iso_certificates\":\"profile-submissions\\/supplier\\/4\\/jFJkhKq5ReS7KRI8ukcOcSySv70CSqTl9Cf4ShHQ.pdf\"}', 'approved', NULL, 1, '2025-12-22 17:46:45', '2025-12-22 17:46:17', '2025-12-22 17:46:45'),
(2, 7, 'supplier', '{\"company_name\":\"NewNew\",\"registered_name\":\"NewNew\",\"business_type\":\"Service Provider\",\"year_of_establishment\":\"2019\",\"registered_address\":\"Test\",\"corporate_address\":\"Test\",\"gst_number\":\"123456\",\"pan_number\":\"123456\",\"cin_number\":\"123456\",\"iso_certified\":\"yes\",\"msme_registered\":\"no\",\"primary_contact\":\"New\",\"primary_designation\":\"New\",\"primary_mobile\":\"123456\",\"primary_email\":\"new@gmail.com\",\"alternate_contact\":\"new\",\"alternate_mobile\":\"123456\",\"website_url\":\"https:\\/\\/www.distinctharsh.com\",\"product_types\":null,\"product_categories\":[\"Solar Panels\",\"Inverters\",\"Structures\",\"Batteries\",\"Cables\",\"Switchgear\"],\"key_brands\":null,\"payment_terms\":null,\"lead_time\":null,\"logistics_capabilities\":null,\"credit_period\":null,\"major_clients\":null,\"industry_experience_years\":null,\"reference_contacts\":null,\"signature\":null,\"declaration_date\":null,\"iso_certificates\":\"profile-submissions\\/supplier\\/7\\/NxLQpNHg64yyDykoOm65LhTWkk9OyYBycYN2oXkO.pdf\"}', 'pending', NULL, NULL, NULL, '2025-12-30 04:57:42', '2025-12-30 04:57:42'),
(3, 12, 'distributor', '{\"company_name\":\"Orange Media Labs\",\"state_id\":\"32\",\"business_type\":\"Distributor\",\"year_of_establishment\":\"2025\",\"registered_address\":\"C-30, near Chirag Delhi Flyover, Block C, Panchsheel Enclave,\\r\\nNew Delhi\",\"operating_regions\":\"PAN India\",\"gst_number\":null,\"pan_number\":null,\"msme_number\":null,\"owner_name\":null,\"owner_mobile\":\"09990093303\",\"owner_email\":\"deepak@orangemedialabs.com\",\"sales_manager_contact\":null,\"office_landline\":null,\"product_interests\":[\"Solar Panels\",\"Inverters\",\"Batteries\",\"Mounting Structures\",\"Solar Water Pumps\",\"Solar Street Lights\",\"EV Charging Solutions\"],\"monthly_sales_volume\":null,\"existing_product_lines\":null,\"team_size\":null,\"warehouse_capacity\":null,\"logistics_tieups\":null,\"service_team\":null,\"market_coverage\":null,\"annual_turnover\":null,\"credit_terms\":null,\"bank_name\":null,\"account_number\":null,\"ifsc_code\":null,\"distributor_policy\":\"on\",\"existing_brands\":null,\"distribution_experience_years\":null,\"reference_clients\":null,\"information_accuracy\":\"on\",\"e_signature\":null,\"declaration_date\":null,\"state_name\":\"Delhi\"}', 'pending', NULL, NULL, NULL, '2026-01-21 03:55:12', '2026-01-21 03:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Supplier', 'supplier', '2025-12-12 13:30:40', '2025-12-12 13:30:40'),
(2, 'Distributor', 'distributor', '2025-12-12 13:30:40', '2025-12-12 13:30:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_category_brand_id_category_id_unique` (`brand_id`,`category_id`),
  ADD KEY `brand_category_category_id_foreign` (`category_id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `chatbot_options`
--
ALTER TABLE `chatbot_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_options_question_id_foreign` (`question_id`),
  ADD KEY `chatbot_options_next_question_id_foreign` (`next_question_id`);

--
-- Indexes for table `chatbot_questions`
--
ALTER TABLE `chatbot_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_questions_default_next_question_id_foreign` (`default_next_question_id`);

--
-- Indexes for table `chatbot_user_messages`
--
ALTER TABLE `chatbot_user_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_user_messages_session_id_foreign` (`session_id`),
  ADD KEY `chatbot_user_messages_question_id_foreign` (`question_id`),
  ADD KEY `chatbot_user_messages_option_id_foreign` (`option_id`);

--
-- Indexes for table `chatbot_user_sessions`
--
ALTER TABLE `chatbot_user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_user_sessions_user_id_foreign` (`user_id`),
  ADD KEY `chatbot_user_sessions_visitor_uuid_index` (`visitor_uuid`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_state_id_slug_unique` (`state_id`,`slug`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_slug_unique` (`slug`),
  ADD KEY `companies_owner_id_foreign` (`owner_id`),
  ADD KEY `companies_state_id_foreign` (`state_id`),
  ADD KEY `companies_city_id_foreign` (`city_id`),
  ADD KEY `companies_company_type_is_active_index` (`company_type`,`is_active`);

--
-- Indexes for table `company_brand`
--
ALTER TABLE `company_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_brand_company_id_brand_id_unique` (`company_id`,`brand_id`),
  ADD KEY `company_brand_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `company_category`
--
ALTER TABLE `company_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_category_company_id_category_id_unique` (`company_id`,`category_id`),
  ADD KEY `company_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `company_detail_requests`
--
ALTER TABLE `company_detail_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_product`
--
ALTER TABLE `company_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_product_company_id_product_id_unique` (`company_id`,`product_id`),
  ADD KEY `company_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `company_reviews`
--
ALTER TABLE `company_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_reviews_category_id_foreign` (`category_id`),
  ADD KEY `company_reviews_state_id_foreign` (`state_id`),
  ADD KEY `company_reviews_company_id_is_approved_index` (`company_id`,`is_approved`),
  ADD KEY `company_reviews_reviewer_state_id_foreign` (`reviewer_state_id`),
  ADD KEY `company_reviews_normal_user_id_foreign` (`normal_user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `get_quotes`
--
ALTER TABLE `get_quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `get_quotes_company_id_foreign` (`company_id`) USING BTREE,
  ADD KEY `get_quotes_state_id_foreign` (`state_id`) USING BTREE;

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `normal_users`
--
ALTER TABLE `normal_users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `normal_users_email_unique` (`email`) USING BTREE,
  ADD KEY `normal_users_provider_index` (`provider`) USING BTREE,
  ADD KEY `normal_users_provider_id_index` (`provider_id`) USING BTREE;

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_company_id_category_id_index` (`category_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_media_product_id_type_index` (`product_id`,`type`);

--
-- Indexes for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_specs_product_id_foreign` (`product_id`);

--
-- Indexes for table `rating_summaries`
--
ALTER TABLE `rating_summaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_summaries_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `states_slug_unique` (`slug`),
  ADD UNIQUE KEY `states_code_unique` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_company_id_foreign` (`company_id`),
  ADD KEY `users_user_type_id_foreign` (`user_type_id`);

--
-- Indexes for table `user_profile_submissions`
--
ALTER TABLE `user_profile_submissions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `user_profile_submissions_user_id_form_type_unique` (`user_id`,`form_type`) USING BTREE,
  ADD KEY `user_profile_submissions_reviewed_by_foreign` (`reviewed_by`) USING BTREE;

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_types_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `chatbot_options`
--
ALTER TABLE `chatbot_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chatbot_questions`
--
ALTER TABLE `chatbot_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chatbot_user_messages`
--
ALTER TABLE `chatbot_user_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6884;

--
-- AUTO_INCREMENT for table `chatbot_user_sessions`
--
ALTER TABLE `chatbot_user_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6840;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=395;

--
-- AUTO_INCREMENT for table `company_brand`
--
ALTER TABLE `company_brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_category`
--
ALTER TABLE `company_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_detail_requests`
--
ALTER TABLE `company_detail_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_product`
--
ALTER TABLE `company_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_reviews`
--
ALTER TABLE `company_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `get_quotes`
--
ALTER TABLE `get_quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `normal_users`
--
ALTER TABLE `normal_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_specs`
--
ALTER TABLE `product_specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating_summaries`
--
ALTER TABLE `rating_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_profile_submissions`
--
ALTER TABLE `user_profile_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD CONSTRAINT `brand_category_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chatbot_options`
--
ALTER TABLE `chatbot_options`
  ADD CONSTRAINT `chatbot_options_next_question_id_foreign` FOREIGN KEY (`next_question_id`) REFERENCES `chatbot_questions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chatbot_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `chatbot_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chatbot_questions`
--
ALTER TABLE `chatbot_questions`
  ADD CONSTRAINT `chatbot_questions_default_next_question_id_foreign` FOREIGN KEY (`default_next_question_id`) REFERENCES `chatbot_questions` (`id`);

--
-- Constraints for table `chatbot_user_messages`
--
ALTER TABLE `chatbot_user_messages`
  ADD CONSTRAINT `chatbot_user_messages_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `chatbot_options` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chatbot_user_messages_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `chatbot_questions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chatbot_user_messages_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `chatbot_user_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chatbot_user_sessions`
--
ALTER TABLE `chatbot_user_sessions`
  ADD CONSTRAINT `chatbot_user_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `companies_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `company_brand`
--
ALTER TABLE `company_brand`
  ADD CONSTRAINT `company_brand_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_brand_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_category`
--
ALTER TABLE `company_category`
  ADD CONSTRAINT `company_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_category_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_product`
--
ALTER TABLE `company_product`
  ADD CONSTRAINT `company_product_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_reviews`
--
ALTER TABLE `company_reviews`
  ADD CONSTRAINT `company_reviews_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `company_reviews_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_reviews_normal_user_id_foreign` FOREIGN KEY (`normal_user_id`) REFERENCES `normal_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `company_reviews_reviewer_state_id_foreign` FOREIGN KEY (`reviewer_state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `company_reviews_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `get_quotes`
--
ALTER TABLE `get_quotes`
  ADD CONSTRAINT `get_quotes_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `get_quotes_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD CONSTRAINT `product_specs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_profile_submissions`
--
ALTER TABLE `user_profile_submissions`
  ADD CONSTRAINT `user_profile_submissions_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_profile_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
