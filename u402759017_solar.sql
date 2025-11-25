-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2025 at 04:02 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u402759017_solar`
--

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
('laravel_cache_state_companies_bihar', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1762906884),
('laravel_cache_state_companies_delhi', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:9:{s:2:\"id\";i:5;s:4:\"name\";s:12:\"Sunpro Solar\";s:4:\"slug\";s:12:\"sunpro-solar\";s:4:\"logo\";N;s:5:\"state\";s:5:\"Delhi\";s:11:\"description\";s:147:\"Serving Delhi since 2012, Sunpro Solar has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:13;s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763078985),
('laravel_cache_state_companies_nagaland', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:9:{s:2:\"id\";i:9;s:4:\"name\";s:15:\"Freedom Forever\";s:4:\"slug\";s:15:\"freedom-forever\";s:4:\"logo\";N;s:5:\"state\";s:8:\"Nagaland\";s:11:\"description\";s:171:\"At Freedom Forever, we\'re committed to helping Nagaland residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:18;s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:11:\"Lisa Wilson\";s:11:\"review_text\";s:94:\"Professional and efficient service from Freedom Forever. Very happy with our new solar panels.\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Jun 23, 2024\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1762906881),
('laravel_cache_state_companies_uttar-pradesh', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;a:9:{s:2:\"id\";i:2;s:4:\"name\";s:12:\"Tesla Energy\";s:4:\"slug\";s:12:\"tesla-energy\";s:4:\"logo\";N;s:5:\"state\";s:13:\"Uttar Pradesh\";s:11:\"description\";s:173:\"As a locally-owned and operated solar company in Uttar Pradesh, Tesla Energy is dedicated to providing personalized service and the latest solar technology to our customers.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:16;s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:13:\"Jane Williams\";s:11:\"review_text\";s:85:\"The team at Tesla Energy was knowledgeable and helpful throughout the entire process.\";s:6:\"rating\";i:5;s:4:\"date\";s:12:\"Aug 28, 2022\";}}i:1;a:9:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"SunPower Solar\";s:4:\"slug\";s:14:\"sunpower-solar\";s:4:\"logo\";N;s:5:\"state\";s:13:\"Uttar Pradesh\";s:11:\"description\";s:175:\"As a locally-owned and operated solar company in Uttar Pradesh, SunPower Solar is dedicated to providing personalized service and the latest solar technology to our customers.\";s:14:\"average_rating\";d:3.7;s:13:\"total_reviews\";i:11;s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:15:\"David Rodriguez\";s:11:\"review_text\";s:79:\"I would give SunPower Solar 10 stars if I could. Excellent service and support!\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Aug 09, 2023\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1762906887),
('solarreviews_cache_state_companies_andaman-and-nicobar-islands_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:6;s:4:\"name\";s:14:\"Momentum Solar\";s:4:\"slug\";s:14:\"momentum-solar\";s:4:\"logo\";N;s:5:\"state\";s:27:\"Andaman and Nicobar Islands\";s:11:\"description\";s:220:\"Momentum Solar is a leading solar energy company serving Andaman and Nicobar Islands and surrounding areas. We provide high-quality solar panel installation and energy solutions for residential and commercial properties.\";s:14:\"average_rating\";d:3.6;s:13:\"total_reviews\";i:17;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:13:\"Robert Miller\";s:11:\"review_text\";s:95:\"Great experience with Momentum Solar. The installation was quick and the team was professional.\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Jan 22, 2023\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648810),
('solarreviews_cache_state_companies_andhra-pradesh_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649392),
('solarreviews_cache_state_companies_arunachal-pradesh_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:8;s:4:\"name\";s:7:\"Sunnova\";s:4:\"slug\";s:7:\"sunnova\";s:4:\"logo\";N;s:5:\"state\";s:17:\"Arunachal Pradesh\";s:11:\"description\";s:157:\"Sunnova offers innovative solar solutions in the Arunachal Pradesh area, including solar panel installation, battery storage, and energy efficiency upgrades.\";s:14:\"average_rating\";d:3.7;s:13:\"total_reviews\";i:11;s:12:\"category_ids\";a:1:{i:0;i:3;}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649498),
('solarreviews_cache_state_companies_assam_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648651),
('solarreviews_cache_state_companies_bihar_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649422),
('solarreviews_cache_state_companies_chandigarh_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649481),
('solarreviews_cache_state_companies_chhattisgarh_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:10;s:4:\"name\";s:13:\"Trinity Solar\";s:4:\"slug\";s:13:\"trinity-solar\";s:4:\"logo\";N;s:5:\"state\";s:12:\"Chhattisgarh\";s:11:\"description\";s:204:\"Trinity Solar is a leading solar energy company serving Chhattisgarh and surrounding areas. We provide high-quality solar panel installation and energy solutions for residential and commercial properties.\";s:14:\"average_rating\";d:3.3;s:13:\"total_reviews\";i:12;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:12:\"David Garcia\";s:11:\"review_text\";s:92:\"Professional and efficient service from Trinity Solar. Very happy with our new solar panels.\";s:6:\"rating\";i:2;s:4:\"date\";s:12:\"Sep 09, 2024\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649189),
('solarreviews_cache_state_companies_dadra-and-nagar-haveli-and-daman-and-diu_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763241442),
('solarreviews_cache_state_companies_delhi', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:9:{s:2:\"id\";i:5;s:4:\"name\";s:12:\"Sunpro Solar\";s:4:\"slug\";s:12:\"sunpro-solar\";s:4:\"logo\";N;s:5:\"state\";s:5:\"Delhi\";s:11:\"description\";s:147:\"Serving Delhi since 2012, Sunpro Solar has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:13;s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763149803),
('solarreviews_cache_state_companies_delhi_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:5;s:4:\"name\";s:12:\"Sunpro Solar\";s:4:\"slug\";s:12:\"sunpro-solar\";s:4:\"logo\";N;s:5:\"state\";s:5:\"Delhi\";s:11:\"description\";s:147:\"Serving Delhi since 2012, Sunpro Solar has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:13;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649136),
('solarreviews_cache_state_companies_goa_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648601),
('solarreviews_cache_state_companies_gujarat_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649450),
('solarreviews_cache_state_companies_haryana_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648934),
('solarreviews_cache_state_companies_himachal-pradesh_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649597),
('solarreviews_cache_state_companies_jammu-and-kashmir_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648868),
('solarreviews_cache_state_companies_jharkhand_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763650400),
('solarreviews_cache_state_companies_karnataka_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648996),
('solarreviews_cache_state_companies_kerala_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:12;s:4:\"name\";s:14:\"Palmetto Solar\";s:4:\"slug\";s:14:\"palmetto-solar\";s:4:\"logo\";N;s:5:\"state\";s:6:\"Kerala\";s:11:\"description\";s:168:\"At Palmetto Solar, we\'re committed to helping Kerala residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:20;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763650300),
('solarreviews_cache_state_companies_ladakh_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:7;s:4:\"name\";s:12:\"PetersenDean\";s:4:\"slug\";s:12:\"petersendean\";s:4:\"logo\";N;s:5:\"state\";s:6:\"Ladakh\";s:11:\"description\";s:151:\"PetersenDean offers innovative solar solutions in the Ladakh area, including solar panel installation, battery storage, and energy efficiency upgrades.\";s:14:\"average_rating\";d:3.6;s:13:\"total_reviews\";i:11;s:12:\"category_ids\";a:1:{i:0;i:1;}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:11:\"John Garcia\";s:11:\"review_text\";s:75:\"PetersenDean made going solar easy and stress-free. Great customer service!\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Jul 25, 2022\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648984),
('solarreviews_cache_state_companies_lakshadweep_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648739),
('solarreviews_cache_state_companies_madhya-pradesh_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Sunrun\";s:4:\"slug\";s:6:\"sunrun\";s:4:\"logo\";N;s:5:\"state\";s:14:\"Madhya Pradesh\";s:11:\"description\";s:199:\"Sunrun is a leading solar energy company serving Madhya Pradesh and surrounding areas. We provide high-quality solar panel installation and energy solutions for residential and commercial properties.\";s:14:\"average_rating\";d:3.3;s:13:\"total_reviews\";i:8;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:11:\"David Smith\";s:11:\"review_text\";s:76:\"Thanks to Sunrun, we are now saving money and reducing our carbon footprint.\";s:6:\"rating\";i:5;s:4:\"date\";s:12:\"Oct 20, 2022\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649534),
('solarreviews_cache_state_companies_maharashtra_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:20;s:4:\"name\";s:20:\"SunPower by Sunworks\";s:4:\"slug\";s:20:\"sunpower-by-sunworks\";s:4:\"logo\";N;s:5:\"state\";s:11:\"Maharashtra\";s:11:\"description\";s:179:\"At SunPower by Sunworks, we\'re committed to helping Maharashtra residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.\";s:14:\"average_rating\";d:4.2;s:13:\"total_reviews\";i:6;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648915),
('solarreviews_cache_state_companies_manipur_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648893),
('solarreviews_cache_state_companies_meghalaya_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:13;s:4:\"name\";s:6:\"Sunlux\";s:4:\"slug\";s:6:\"sunlux\";s:4:\"logo\";N;s:5:\"state\";s:9:\"Meghalaya\";s:11:\"description\";s:145:\"Serving Meghalaya since 2010, Sunlux has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:4;s:13:\"total_reviews\";i:7;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:13:\"David Davis D\";s:11:\"review_text\";s:76:\"Thanks to Sunlux, we are now saving money and reducing our carbon footprint.\";s:6:\"rating\";i:3;s:4:\"date\";s:12:\"Dec 27, 2023\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763650371),
('solarreviews_cache_state_companies_mizoram_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;a:10:{s:2:\"id\";i:16;s:4:\"name\";s:8:\"Sunworks\";s:4:\"slug\";s:8:\"sunworks\";s:4:\"logo\";N;s:5:\"state\";s:7:\"Mizoram\";s:11:\"description\";s:145:\"Serving Mizoram since 2013, Sunworks has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:4;s:13:\"total_reviews\";i:8;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:17:\"Emily Rodriguez Z\";s:11:\"review_text\";s:81:\"The team at Sunworks was knowledgeable and helpful throughout the entire process.\";s:6:\"rating\";i:2;s:4:\"date\";s:12:\"Oct 02, 2023\";}}i:1;a:10:{s:2:\"id\";i:17;s:4:\"name\";s:20:\"SunPower by Infinity\";s:4:\"slug\";s:20:\"sunpower-by-infinity\";s:4:\"logo\";N;s:5:\"state\";s:7:\"Mizoram\";s:11:\"description\";s:157:\"Serving Mizoram since 2006, SunPower by Infinity has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:3.3;s:13:\"total_reviews\";i:7;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";N;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649007),
('solarreviews_cache_state_companies_nagaland_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:9;s:4:\"name\";s:15:\"Freedom Forever\";s:4:\"slug\";s:15:\"freedom-forever\";s:4:\"logo\";N;s:5:\"state\";s:8:\"Nagaland\";s:11:\"description\";s:171:\"At Freedom Forever, we\'re committed to helping Nagaland residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:18;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:11:\"Lisa Wilson\";s:11:\"review_text\";s:94:\"Professional and efficient service from Freedom Forever. Very happy with our new solar panels.\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Jun 23, 2024\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649071),
('solarreviews_cache_state_companies_odisha_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649018),
('solarreviews_cache_state_companies_puducherry_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:18;s:4:\"name\";s:25:\"SunPower by Custom Energy\";s:4:\"slug\";s:25:\"sunpower-by-custom-energy\";s:4:\"logo\";N;s:5:\"state\";s:10:\"Puducherry\";s:11:\"description\";s:165:\"Serving Puducherry since 2016, SunPower by Custom Energy has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:3.9;s:13:\"total_reviews\";i:16;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:11:\"Lisa Garcia\";s:11:\"review_text\";s:98:\"The team at SunPower by Custom Energy was knowledgeable and helpful throughout the entire process.\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"May 18, 2024\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649522),
('solarreviews_cache_state_companies_punjab_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648841),
('solarreviews_cache_state_companies_rajasthan_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:4;s:4:\"name\";s:12:\"Vivint Solar\";s:4:\"slug\";s:12:\"vivint-solar\";s:4:\"logo\";N;s:5:\"state\";s:9:\"Rajasthan\";s:11:\"description\";s:169:\"At Vivint Solar, we\'re committed to helping Rajasthan residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.\";s:14:\"average_rating\";d:3.6;s:13:\"total_reviews\";i:20;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:15:\"Robert Garcia V\";s:11:\"review_text\";s:85:\"The team at Vivint Solar was knowledgeable and helpful throughout the entire process.\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Nov 21, 2024\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649563),
('solarreviews_cache_state_companies_sikkim_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763650257),
('solarreviews_cache_state_companies_tamil-nadu_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;a:10:{s:2:\"id\";i:15;s:4:\"name\";s:22:\"SunPower by Blue Raven\";s:4:\"slug\";s:22:\"sunpower-by-blue-raven\";s:4:\"logo\";N;s:5:\"state\";s:10:\"Tamil Nadu\";s:11:\"description\";s:162:\"Serving Tamil Nadu since 2010, SunPower by Blue Raven has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.\";s:14:\"average_rating\";d:4.3;s:13:\"total_reviews\";i:16;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:12:\"James Wilson\";s:11:\"review_text\";s:103:\"Great experience with SunPower by Blue Raven. The installation was quick and the team was professional.\";s:6:\"rating\";i:3;s:4:\"date\";s:12:\"Sep 30, 2023\";}}i:1;a:10:{s:2:\"id\";i:14;s:4:\"name\";s:9:\"ADT Solar\";s:4:\"slug\";s:9:\"adt-solar\";s:4:\"logo\";N;s:5:\"state\";s:10:\"Tamil Nadu\";s:11:\"description\";s:167:\"At ADT Solar, we\'re committed to helping Tamil Nadu residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.\";s:14:\"average_rating\";d:3.2;s:13:\"total_reviews\";i:9;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:11:\"James Brown\";s:11:\"review_text\";s:90:\"Great experience with ADT Solar. The installation was quick and the team was professional.\";s:6:\"rating\";i:1;s:4:\"date\";s:12:\"Nov 23, 2023\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649027),
('solarreviews_cache_state_companies_telangana_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649238),
('solarreviews_cache_state_companies_tripura_v2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648777),
('solarreviews_cache_state_companies_uttar-pradesh_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;a:10:{s:2:\"id\";i:2;s:4:\"name\";s:12:\"Tesla Energy\";s:4:\"slug\";s:12:\"tesla-energy\";s:4:\"logo\";N;s:5:\"state\";s:13:\"Uttar Pradesh\";s:11:\"description\";s:173:\"As a locally-owned and operated solar company in Uttar Pradesh, Tesla Energy is dedicated to providing personalized service and the latest solar technology to our customers.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:16;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:13:\"Jane Williams\";s:11:\"review_text\";s:85:\"The team at Tesla Energy was knowledgeable and helpful throughout the entire process.\";s:6:\"rating\";i:5;s:4:\"date\";s:12:\"Aug 28, 2022\";}}i:1;a:10:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"SunPower Solar\";s:4:\"slug\";s:14:\"sunpower-solar\";s:4:\"logo\";N;s:5:\"state\";s:13:\"Uttar Pradesh\";s:11:\"description\";s:175:\"As a locally-owned and operated solar company in Uttar Pradesh, SunPower Solar is dedicated to providing personalized service and the latest solar technology to our customers.\";s:14:\"average_rating\";d:3.7;s:13:\"total_reviews\";i:11;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:15:\"David Rodriguez\";s:11:\"review_text\";s:79:\"I would give SunPower Solar 10 stars if I could. Excellent service and support!\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Aug 09, 2023\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763649325),
('solarreviews_cache_state_companies_uttarakhand_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:11;s:4:\"name\";s:16:\"Blue Raven Solar\";s:4:\"slug\";s:16:\"blue-raven-solar\";s:4:\"logo\";N;s:5:\"state\";s:11:\"Uttarakhand\";s:11:\"description\";s:175:\"At Blue Raven Solar, we\'re committed to helping Uttarakhand residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.\";s:14:\"average_rating\";d:3.8;s:13:\"total_reviews\";i:6;s:12:\"category_ids\";a:1:{i:0;i:2;}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:14:\"David Williams\";s:11:\"review_text\";s:92:\"Our experience with Blue Raven Solar was outstanding from start to finish. Highly recommend!\";s:6:\"rating\";i:4;s:4:\"date\";s:12:\"Aug 15, 2022\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763648547),
('solarreviews_cache_state_companies_west-bengal_v2', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:10:{s:2:\"id\";i:19;s:4:\"name\";s:19:\"SunPower by Horizon\";s:4:\"slug\";s:19:\"sunpower-by-horizon\";s:4:\"logo\";N;s:5:\"state\";s:11:\"West Bengal\";s:11:\"description\";s:178:\"As a locally-owned and operated solar company in West Bengal, SunPower by Horizon is dedicated to providing personalized service and the latest solar technology to our customers.\";s:14:\"average_rating\";d:4.5;s:13:\"total_reviews\";i:6;s:12:\"category_ids\";a:0:{}s:15:\"featured_review\";a:4:{s:13:\"reviewer_name\";s:15:\"Jane Williams Q\";s:11:\"review_text\";s:102:\"Very satisfied with the service from SunPower by Horizon. Our energy bills have dropped significantly.\";s:6:\"rating\";i:5;s:4:\"date\";s:12:\"Jun 08, 2024\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1763275843);

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
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `sort_order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Panels', 'panels', 'test', NULL, 0, 1, NULL, NULL, NULL),
(2, 'Batteries', 'batteries', 'test', NULL, 0, 1, NULL, NULL, NULL),
(3, 'Inverters', 'inverters', 'test', NULL, 0, 1, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `average_rating` decimal(3,1) NOT NULL DEFAULT 0.0,
  `total_reviews` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `slug`, `description`, `logo`, `state_id`, `average_rating`, `total_reviews`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'SunPower Solar', 'sunpower-solar', 'As a locally-owned and operated solar company in Uttar Pradesh, SunPower Solar is dedicated to providing personalized service and the latest solar technology to our customers.', NULL, 26, 3.7, 11, 1, '2025-11-11 02:56:15', '2025-11-11 05:12:19'),
(2, 'Tesla Energy', 'tesla-energy', 'As a locally-owned and operated solar company in Uttar Pradesh, Tesla Energy is dedicated to providing personalized service and the latest solar technology to our customers.', NULL, 26, 3.8, 16, 1, '2025-11-11 02:56:16', '2025-11-11 02:56:21'),
(3, 'Sunrun', 'sunrun', 'Sunrun is a leading solar energy company serving Madhya Pradesh and surrounding areas. We provide high-quality solar panel installation and energy solutions for residential and commercial properties.', NULL, 13, 3.3, 8, 1, '2025-11-11 02:56:16', '2025-11-11 02:56:22'),
(4, 'Vivint Solar', 'vivint-solar', 'At Vivint Solar, we\'re committed to helping Rajasthan residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.', NULL, 21, 3.6, 20, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:24'),
(5, 'Sunpro Solar', 'sunpro-solar', 'Serving Delhi since 2012, Sunpro Solar has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.', NULL, 32, 3.8, 13, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:26'),
(6, 'Momentum Solar', 'momentum-solar', 'Momentum Solar is a leading solar energy company serving Andaman and Nicobar Islands and surrounding areas. We provide high-quality solar panel installation and energy solutions for residential and commercial properties.', NULL, 29, 3.6, 17, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:27'),
(7, 'PetersenDean', 'petersendean', 'PetersenDean offers innovative solar solutions in the Ladakh area, including solar panel installation, battery storage, and energy efficiency upgrades.', NULL, 34, 3.6, 11, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:28'),
(8, 'Sunnova', 'sunnova', 'Sunnova offers innovative solar solutions in the Arunachal Pradesh area, including solar panel installation, battery storage, and energy efficiency upgrades.', NULL, 2, 3.7, 11, 1, '2025-11-11 02:56:17', '2025-11-14 10:57:26'),
(9, 'Freedom Forever', 'freedom-forever', 'At Freedom Forever, we\'re committed to helping Nagaland residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.', NULL, 18, 3.8, 18, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:31'),
(10, 'Trinity Solar', 'trinity-solar', 'Trinity Solar is a leading solar energy company serving Chhattisgarh and surrounding areas. We provide high-quality solar panel installation and energy solutions for residential and commercial properties.', NULL, 5, 3.3, 12, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:32'),
(11, 'Blue Raven Solar', 'blue-raven-solar', 'At Blue Raven Solar, we\'re committed to helping Uttarakhand residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.', NULL, 27, 3.8, 6, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:33'),
(12, 'Palmetto Solar', 'palmetto-solar', 'At Palmetto Solar, we\'re committed to helping Kerala residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.', NULL, 12, 3.8, 20, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:35'),
(13, 'Sunlux', 'sunlux', 'Serving Meghalaya since 2010, Sunlux has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.', NULL, 16, 4.0, 7, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:35'),
(14, 'ADT Solar', 'adt-solar', 'At ADT Solar, we\'re committed to helping Tamil Nadu residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.', NULL, 23, 3.2, 9, 1, '2025-11-11 02:56:17', '2025-11-11 02:56:36'),
(15, 'SunPower by Blue Raven', 'sunpower-by-blue-raven', 'Serving Tamil Nadu since 2010, SunPower by Blue Raven has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.', NULL, 23, 4.3, 16, 1, '2025-11-11 02:56:18', '2025-11-11 02:56:37'),
(16, 'Sunworks', 'sunworks', 'Serving Mizoram since 2013, Sunworks has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.', NULL, 17, 4.0, 8, 1, '2025-11-11 02:56:18', '2025-11-11 02:56:38'),
(17, 'SunPower by Infinity', 'sunpower-by-infinity', 'Serving Mizoram since 2006, SunPower by Infinity has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.', NULL, 17, 3.3, 7, 1, '2025-11-11 02:56:18', '2025-11-11 02:56:40'),
(18, 'SunPower by Custom Energy', 'sunpower-by-custom-energy', 'Serving Puducherry since 2016, SunPower by Custom Energy has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.', NULL, 36, 3.9, 16, 1, '2025-11-11 02:56:18', '2025-11-11 02:56:43'),
(19, 'SunPower by Horizon', 'sunpower-by-horizon', 'As a locally-owned and operated solar company in West Bengal, SunPower by Horizon is dedicated to providing personalized service and the latest solar technology to our customers.', NULL, 28, 4.5, 6, 1, '2025-11-11 02:56:18', '2025-11-11 02:56:44'),
(20, 'SunPower by Sunworks', 'sunpower-by-sunworks', 'At SunPower by Sunworks, we\'re committed to helping Maharashtra residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.', NULL, 14, 4.2, 6, 1, '2025-11-11 02:56:18', '2025-11-11 02:56:45');

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

--
-- Dumping data for table `company_category`
--

INSERT INTO `company_category` (`id`, `company_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 11, 2, NULL, NULL),
(2, 7, 1, NULL, NULL),
(3, 8, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_reviews`
--

CREATE TABLE `company_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `review_title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `review_date` date NOT NULL,
  `source` varchar(255) NOT NULL DEFAULT 'website',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_verified` tinyint(1) NOT NULL DEFAULT 0,
  `otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_reviews`
--

INSERT INTO `company_reviews` (`id`, `company_id`, `category_id`, `state_id`, `reviewer_name`, `review_title`, `email`, `rating`, `review_text`, `review_date`, `source`, `is_featured`, `is_approved`, `created_at`, `updated_at`, `deleted_at`, `otp`, `otp_verified`, `otp_expires_at`) VALUES
(1, 1, NULL, NULL, 'David Rodriguez', NULL, NULL, 4, 'I would give SunPower Solar 10 stars if I could. Excellent service and support!', '2023-08-09', 'Website', 1, 0, '2023-08-09 02:56:18', '2023-08-09 02:56:18', NULL, NULL, 0, NULL),
(2, 1, NULL, NULL, 'Robert Johnson', NULL, NULL, 4, 'SunPower Solar made going solar easy and stress-free. Great customer service!', '2023-09-16', 'Yelp', 1, 0, '2023-09-16 02:56:19', '2023-09-16 02:56:19', NULL, NULL, 0, NULL),
(3, 1, NULL, NULL, 'Emily Miller', NULL, NULL, 4, 'The team at SunPower Solar was knowledgeable and helpful throughout the entire process.', '2024-06-04', 'Yelp', 0, 0, '2024-06-04 02:56:19', '2024-06-04 02:56:19', NULL, NULL, 0, NULL),
(4, 1, NULL, NULL, 'Jane Wilson M', NULL, NULL, 3, 'Great experience with SunPower Solar. The installation was quick and the team was professional.', '2023-08-04', 'Website', 0, 0, '2023-08-04 02:56:19', '2023-08-04 02:56:19', NULL, NULL, 0, NULL),
(5, 1, NULL, NULL, 'Michael Garcia B', NULL, NULL, 5, 'SunPower Solar made going solar easy and stress-free. Great customer service!', '2024-03-06', 'Website', 0, 0, '2024-03-06 02:56:19', '2024-03-06 02:56:19', NULL, NULL, 0, NULL),
(6, 1, NULL, NULL, 'David Smith Q', NULL, NULL, 3, 'I would give SunPower Solar 10 stars if I could. Excellent service and support!', '2023-01-30', 'Website', 0, 0, '2023-01-30 02:56:19', '2023-01-30 02:56:19', NULL, NULL, 0, NULL),
(7, 1, NULL, NULL, 'James Miller U', NULL, NULL, 4, 'SunPower Solar provided a great solar solution for our home. The installation was seamless.', '2022-09-03', 'Trustpilot', 0, 0, '2022-09-03 02:56:19', '2022-09-03 02:56:19', NULL, NULL, 0, NULL),
(8, 1, NULL, NULL, 'David Rodriguez', NULL, NULL, 5, 'SunPower Solar did an amazing job on our solar installation. Highly recommend!', '2023-07-16', 'Website', 1, 0, '2023-07-16 02:56:19', '2023-07-16 02:56:19', NULL, NULL, 0, NULL),
(9, 1, NULL, NULL, 'Jennifer Brown', NULL, NULL, 2, 'I would give SunPower Solar 10 stars if I could. Excellent service and support!', '2024-03-18', 'Facebook', 0, 0, '2024-03-18 02:56:19', '2024-03-18 02:56:19', NULL, NULL, 0, NULL),
(10, 1, NULL, NULL, 'Michael Wilson', NULL, NULL, 4, 'SunPower Solar did an amazing job on our solar installation. Highly recommend!', '2023-12-16', 'Yelp', 0, 0, '2023-12-16 02:56:19', '2023-12-16 02:56:19', NULL, NULL, 0, NULL),
(11, 2, NULL, NULL, 'Robert Miller', NULL, NULL, 4, 'Very satisfied with the service from Tesla Energy. Our energy bills have dropped significantly.', '2022-07-26', 'Google', 0, 0, '2022-07-26 02:56:20', '2022-07-26 02:56:20', NULL, NULL, 0, NULL),
(12, 2, NULL, NULL, 'David Miller X', NULL, NULL, 5, 'Thanks to Tesla Energy, we are now saving money and reducing our carbon footprint.', '2023-01-04', 'Google', 0, 0, '2023-01-04 02:56:20', '2023-01-04 02:56:20', NULL, NULL, 0, NULL),
(13, 2, NULL, NULL, 'Sarah Miller', NULL, NULL, 4, 'Great experience with Tesla Energy. The installation was quick and the team was professional.', '2023-08-13', 'Google', 0, 0, '2023-08-13 02:56:20', '2023-08-13 02:56:20', NULL, NULL, 0, NULL),
(14, 2, NULL, NULL, 'James Rodriguez', NULL, NULL, 5, 'Our experience with Tesla Energy was outstanding from start to finish. Highly recommend!', '2023-06-28', 'Facebook', 0, 0, '2023-06-28 02:56:20', '2023-06-28 02:56:20', NULL, NULL, 0, NULL),
(15, 2, NULL, NULL, 'Jane Smith', NULL, NULL, 3, 'Tesla Energy did an amazing job on our solar installation. Highly recommend!', '2023-07-10', 'Yelp', 0, 0, '2023-07-10 02:56:20', '2023-07-10 02:56:20', NULL, NULL, 0, NULL),
(16, 2, NULL, NULL, 'David Wilson D', NULL, NULL, 1, 'Thanks to Tesla Energy, we are now saving money and reducing our carbon footprint.', '2022-06-11', 'Website', 0, 0, '2022-06-11 02:56:20', '2022-06-11 02:56:20', NULL, NULL, 0, NULL),
(17, 2, NULL, NULL, 'Jennifer Jones H', NULL, NULL, 4, 'Professional and efficient service from Tesla Energy. Very happy with our new solar panels.', '2023-10-15', 'Google', 0, 0, '2023-10-15 02:56:20', '2023-10-15 02:56:20', NULL, NULL, 0, NULL),
(18, 2, NULL, NULL, 'Jane Williams', NULL, NULL, 5, 'The team at Tesla Energy was knowledgeable and helpful throughout the entire process.', '2022-08-28', 'Yelp', 1, 0, '2022-08-28 02:56:20', '2022-08-28 02:56:20', NULL, NULL, 0, NULL),
(19, 2, NULL, NULL, 'Lisa Williams E', NULL, NULL, 3, 'Tesla Energy did an amazing job on our solar installation. Highly recommend!', '2025-09-13', 'Google', 0, 0, '2025-09-13 02:56:20', '2025-09-13 02:56:20', NULL, NULL, 0, NULL),
(20, 2, NULL, NULL, 'Sarah Williams', NULL, NULL, 5, 'Thanks to Tesla Energy, we are now saving money and reducing our carbon footprint.', '2023-01-01', 'Google', 0, 0, '2023-01-01 02:56:21', '2023-01-01 02:56:21', NULL, NULL, 0, NULL),
(21, 2, NULL, NULL, 'Sarah Williams', NULL, NULL, 4, 'Our experience with Tesla Energy was outstanding from start to finish. Highly recommend!', '2023-02-25', 'Google', 0, 0, '2023-02-25 02:56:21', '2023-02-25 02:56:21', NULL, NULL, 0, NULL),
(22, 2, NULL, NULL, 'Jane Rodriguez', NULL, NULL, 4, 'Tesla Energy provided a great solar solution for our home. The installation was seamless.', '2025-02-15', 'Trustpilot', 0, 0, '2025-02-15 02:56:21', '2025-02-15 02:56:21', NULL, NULL, 0, NULL),
(23, 2, NULL, NULL, 'Jane Garcia', NULL, NULL, 4, 'Very satisfied with the service from Tesla Energy. Our energy bills have dropped significantly.', '2024-12-20', 'Facebook', 1, 0, '2024-12-20 02:56:21', '2024-12-20 02:56:21', NULL, NULL, 0, NULL),
(24, 2, NULL, NULL, 'Michael Garcia', NULL, NULL, 3, 'Tesla Energy made going solar easy and stress-free. Great customer service!', '2023-06-06', 'Trustpilot', 0, 0, '2023-06-06 02:56:21', '2023-06-06 02:56:21', NULL, NULL, 0, NULL),
(25, 2, NULL, NULL, 'Lisa Wilson', NULL, NULL, 4, 'Tesla Energy made going solar easy and stress-free. Great customer service!', '2023-08-11', 'Facebook', 0, 0, '2023-08-11 02:56:21', '2023-08-11 02:56:21', NULL, NULL, 0, NULL),
(26, 2, NULL, NULL, 'Jennifer Wilson', NULL, NULL, 3, 'Our experience with Tesla Energy was outstanding from start to finish. Highly recommend!', '2024-05-08', 'Google', 1, 0, '2024-05-08 02:56:21', '2024-05-08 02:56:21', NULL, NULL, 0, NULL),
(27, 3, NULL, NULL, 'Michael Wilson', NULL, NULL, 3, 'Very satisfied with the service from Sunrun. Our energy bills have dropped significantly.', '2024-11-14', 'Trustpilot', 0, 0, '2024-11-14 02:56:21', '2024-11-14 02:56:21', NULL, NULL, 0, NULL),
(28, 3, NULL, NULL, 'Robert Garcia', NULL, NULL, 4, 'Professional and efficient service from Sunrun. Very happy with our new solar panels.', '2024-02-02', 'Facebook', 0, 0, '2024-02-02 02:56:21', '2024-02-02 02:56:21', NULL, NULL, 0, NULL),
(29, 3, NULL, NULL, 'Jennifer Wilson G', NULL, NULL, 3, 'Professional and efficient service from Sunrun. Very happy with our new solar panels.', '2024-01-17', 'Yelp', 0, 0, '2024-01-17 02:56:21', '2024-01-17 02:56:21', NULL, NULL, 0, NULL),
(30, 3, NULL, NULL, 'Sarah Garcia U', NULL, NULL, 2, 'I would give Sunrun 10 stars if I could. Excellent service and support!', '2024-03-23', 'Google', 0, 0, '2024-03-23 02:56:21', '2024-03-23 02:56:21', NULL, NULL, 0, NULL),
(31, 3, NULL, NULL, 'David Wilson', NULL, NULL, 5, 'Sunrun did an amazing job on our solar installation. Highly recommend!', '2024-12-27', 'Website', 0, 0, '2024-12-27 02:56:21', '2024-12-27 02:56:21', NULL, NULL, 0, NULL),
(32, 3, NULL, NULL, 'John Smith', NULL, NULL, 3, 'Very satisfied with the service from Sunrun. Our energy bills have dropped significantly.', '2024-07-30', 'Website', 0, 0, '2024-07-30 02:56:21', '2024-07-30 02:56:21', NULL, NULL, 0, NULL),
(33, 3, NULL, NULL, 'David Smith', NULL, NULL, 5, 'Thanks to Sunrun, we are now saving money and reducing our carbon footprint.', '2022-10-20', 'Yelp', 1, 0, '2022-10-20 02:56:22', '2022-10-20 02:56:22', NULL, NULL, 0, NULL),
(34, 3, NULL, NULL, 'Emily Smith', NULL, NULL, 1, 'I would give Sunrun 10 stars if I could. Excellent service and support!', '2022-11-23', 'Facebook', 1, 0, '2022-11-23 02:56:22', '2022-11-23 02:56:22', NULL, NULL, 0, NULL),
(35, 4, NULL, NULL, 'Lisa Garcia', NULL, NULL, 5, 'Professional and efficient service from Vivint Solar. Very happy with our new solar panels.', '2023-12-19', 'Facebook', 0, 0, '2023-12-19 02:56:22', '2023-12-19 02:56:22', NULL, NULL, 0, NULL),
(36, 4, NULL, NULL, 'David Brown', NULL, NULL, 5, 'Vivint Solar did an amazing job on our solar installation. Highly recommend!', '2024-11-09', 'Website', 0, 0, '2024-11-09 02:56:22', '2024-11-09 02:56:22', NULL, NULL, 0, NULL),
(37, 4, NULL, NULL, 'Robert Garcia V', NULL, NULL, 4, 'The team at Vivint Solar was knowledgeable and helpful throughout the entire process.', '2024-11-21', 'Google', 1, 0, '2024-11-21 02:56:22', '2024-11-21 02:56:22', NULL, NULL, 0, NULL),
(38, 4, NULL, NULL, 'Jane Miller', NULL, NULL, 3, 'Great experience with Vivint Solar. The installation was quick and the team was professional.', '2023-11-28', 'Facebook', 0, 0, '2023-11-28 02:56:22', '2023-11-28 02:56:22', NULL, NULL, 0, NULL),
(39, 4, NULL, NULL, 'Emily Smith U', NULL, NULL, 5, 'Very satisfied with the service from Vivint Solar. Our energy bills have dropped significantly.', '2022-10-27', 'Trustpilot', 1, 0, '2022-10-27 02:56:22', '2022-10-27 02:56:22', NULL, NULL, 0, NULL),
(40, 4, NULL, NULL, 'Emily Wilson C', NULL, NULL, 5, 'Great experience with Vivint Solar. The installation was quick and the team was professional.', '2025-01-19', 'Website', 0, 0, '2025-01-19 02:56:22', '2025-01-19 02:56:22', NULL, NULL, 0, NULL),
(41, 4, NULL, NULL, 'David Davis', NULL, NULL, 2, 'The team at Vivint Solar was knowledgeable and helpful throughout the entire process.', '2024-08-07', 'Google', 1, 0, '2024-08-07 02:56:22', '2024-08-07 02:56:22', NULL, NULL, 0, NULL),
(42, 4, NULL, NULL, 'Michael Smith', NULL, NULL, 3, 'Vivint Solar provided a great solar solution for our home. The installation was seamless.', '2025-04-06', 'Yelp', 0, 0, '2025-04-06 02:56:22', '2025-04-06 02:56:22', NULL, NULL, 0, NULL),
(43, 4, NULL, NULL, 'John Garcia O', NULL, NULL, 3, 'Professional and efficient service from Vivint Solar. Very happy with our new solar panels.', '2023-08-20', 'Yelp', 1, 0, '2023-08-20 02:56:23', '2023-08-20 02:56:23', NULL, NULL, 0, NULL),
(44, 4, NULL, NULL, 'Sarah Williams', NULL, NULL, 5, 'Great experience with Vivint Solar. The installation was quick and the team was professional.', '2022-04-12', 'Trustpilot', 0, 0, '2022-04-12 02:56:23', '2022-04-12 02:56:23', NULL, NULL, 0, NULL),
(45, 4, NULL, NULL, 'Sarah Wilson P', NULL, NULL, 4, 'Vivint Solar provided a great solar solution for our home. The installation was seamless.', '2022-09-29', 'Yelp', 0, 0, '2022-09-29 02:56:23', '2022-09-29 02:56:23', NULL, NULL, 0, NULL),
(46, 4, NULL, NULL, 'Jane Jones', NULL, NULL, 5, 'Vivint Solar made going solar easy and stress-free. Great customer service!', '2025-01-21', 'Trustpilot', 0, 0, '2025-01-21 02:56:23', '2025-01-21 02:56:23', NULL, NULL, 0, NULL),
(47, 4, NULL, NULL, 'Robert Johnson S', NULL, NULL, 1, 'Vivint Solar did an amazing job on our solar installation. Highly recommend!', '2023-07-15', 'Yelp', 0, 0, '2023-07-15 02:56:23', '2023-07-15 02:56:23', NULL, NULL, 0, NULL),
(48, 4, NULL, NULL, 'John Rodriguez', NULL, NULL, 2, 'Professional and efficient service from Vivint Solar. Very happy with our new solar panels.', '2023-09-24', 'Facebook', 0, 0, '2023-09-24 02:56:23', '2023-09-24 02:56:23', NULL, NULL, 0, NULL),
(49, 4, NULL, NULL, 'Jane Smith', NULL, NULL, 4, 'Thanks to Vivint Solar, we are now saving money and reducing our carbon footprint.', '2022-09-17', 'Trustpilot', 0, 0, '2022-09-17 02:56:23', '2022-09-17 02:56:23', NULL, NULL, 0, NULL),
(50, 4, NULL, NULL, 'James Jones K', NULL, NULL, 3, 'Very satisfied with the service from Vivint Solar. Our energy bills have dropped significantly.', '2024-06-25', 'Website', 0, 0, '2024-06-25 02:56:23', '2024-06-25 02:56:23', NULL, NULL, 0, NULL),
(51, 4, NULL, NULL, 'Emily Brown', NULL, NULL, 5, 'I would give Vivint Solar 10 stars if I could. Excellent service and support!', '2023-03-12', 'Yelp', 0, 0, '2023-03-12 02:56:23', '2023-03-12 02:56:23', NULL, NULL, 0, NULL),
(52, 4, NULL, NULL, 'Emily Miller', NULL, NULL, 2, 'The team at Vivint Solar was knowledgeable and helpful throughout the entire process.', '2025-06-20', 'Website', 0, 0, '2025-06-20 02:56:23', '2025-06-20 02:56:23', NULL, NULL, 0, NULL),
(53, 4, NULL, NULL, 'Emily Williams', NULL, NULL, 3, 'I would give Vivint Solar 10 stars if I could. Excellent service and support!', '2023-10-23', 'Facebook', 0, 0, '2023-10-23 02:56:24', '2023-10-23 02:56:24', NULL, NULL, 0, NULL),
(54, 4, NULL, NULL, 'Jane Williams', NULL, NULL, 3, 'Vivint Solar made going solar easy and stress-free. Great customer service!', '2023-08-29', 'Facebook', 0, 0, '2023-08-29 02:56:24', '2023-08-29 02:56:24', NULL, NULL, 0, NULL),
(55, 5, NULL, NULL, 'Jane Jones', NULL, NULL, 1, 'The team at Sunpro Solar was knowledgeable and helpful throughout the entire process.', '2024-01-06', 'Facebook', 0, 0, '2024-01-06 02:56:24', '2024-01-06 02:56:24', NULL, NULL, 0, NULL),
(56, 5, NULL, NULL, 'Lisa Johnson', NULL, NULL, 5, 'Sunpro Solar did an amazing job on our solar installation. Highly recommend!', '2024-04-09', 'Google', 0, 0, '2024-04-09 02:56:25', '2024-04-09 02:56:25', NULL, NULL, 0, NULL),
(57, 5, NULL, NULL, 'David Smith', NULL, NULL, 3, 'Thanks to Sunpro Solar, we are now saving money and reducing our carbon footprint.', '2024-10-30', 'Website', 0, 0, '2024-10-30 02:56:25', '2024-10-30 02:56:25', NULL, NULL, 0, NULL),
(58, 5, NULL, NULL, 'Jane Brown', NULL, NULL, 5, 'The team at Sunpro Solar was knowledgeable and helpful throughout the entire process.', '2025-01-04', 'Facebook', 0, 0, '2025-01-04 02:56:25', '2025-01-04 02:56:25', NULL, NULL, 0, NULL),
(59, 5, NULL, NULL, 'Jennifer Rodriguez', NULL, NULL, 5, 'Sunpro Solar made going solar easy and stress-free. Great customer service!', '2024-11-25', 'Trustpilot', 0, 0, '2024-11-25 02:56:25', '2024-11-25 02:56:25', NULL, NULL, 0, NULL),
(60, 5, NULL, NULL, 'John Rodriguez', NULL, NULL, 3, 'Sunpro Solar provided a great solar solution for our home. The installation was seamless.', '2024-02-21', 'Yelp', 0, 0, '2024-02-21 02:56:25', '2024-02-21 02:56:25', NULL, NULL, 0, NULL),
(61, 5, NULL, NULL, 'James Wilson', NULL, NULL, 5, 'Thanks to Sunpro Solar, we are now saving money and reducing our carbon footprint.', '2025-02-14', 'Trustpilot', 0, 0, '2025-02-14 02:56:25', '2025-02-14 02:56:25', NULL, NULL, 0, NULL),
(62, 5, NULL, NULL, 'Michael Brown', NULL, NULL, 5, 'Great experience with Sunpro Solar. The installation was quick and the team was professional.', '2023-06-22', 'Website', 0, 0, '2023-06-22 02:56:25', '2023-06-22 02:56:25', NULL, NULL, 0, NULL),
(63, 5, NULL, NULL, 'Lisa Smith', NULL, NULL, 5, 'Great experience with Sunpro Solar. The installation was quick and the team was professional.', '2024-10-05', 'Facebook', 0, 0, '2024-10-05 02:56:25', '2024-10-05 02:56:25', NULL, NULL, 0, NULL),
(64, 5, NULL, NULL, 'John Smith M', NULL, NULL, 2, 'Great experience with Sunpro Solar. The installation was quick and the team was professional.', '2025-09-29', 'Google', 0, 0, '2025-09-29 02:56:25', '2025-09-29 02:56:25', NULL, NULL, 0, NULL),
(65, 5, NULL, NULL, 'David Garcia', NULL, NULL, 4, 'Very satisfied with the service from Sunpro Solar. Our energy bills have dropped significantly.', '2023-04-25', 'Facebook', 0, 0, '2023-04-25 02:56:26', '2023-04-25 02:56:26', NULL, NULL, 0, NULL),
(66, 5, NULL, NULL, 'Jane Johnson', NULL, NULL, 3, 'Sunpro Solar did an amazing job on our solar installation. Highly recommend!', '2023-01-22', 'Trustpilot', 0, 0, '2023-01-22 02:56:26', '2023-01-22 02:56:26', NULL, NULL, 0, NULL),
(67, 5, NULL, NULL, 'Jennifer Rodriguez E', NULL, NULL, 3, 'Great experience with Sunpro Solar. The installation was quick and the team was professional.', '2023-04-09', 'Facebook', 0, 0, '2023-04-09 02:56:26', '2023-04-09 02:56:26', NULL, NULL, 0, NULL),
(68, 6, NULL, NULL, 'Jane Davis', NULL, NULL, 5, 'Our experience with Momentum Solar was outstanding from start to finish. Highly recommend!', '2021-12-16', 'Trustpilot', 0, 0, '2021-12-16 02:56:26', '2021-12-16 02:56:26', NULL, NULL, 0, NULL),
(69, 6, NULL, NULL, 'James Jones', NULL, NULL, 5, 'Momentum Solar provided a great solar solution for our home. The installation was seamless.', '2023-01-13', 'Google', 0, 0, '2023-01-13 02:56:26', '2023-01-13 02:56:26', NULL, NULL, 0, NULL),
(70, 6, NULL, NULL, 'David Johnson', NULL, NULL, 4, 'Momentum Solar provided a great solar solution for our home. The installation was seamless.', '2025-07-01', 'Website', 0, 0, '2025-07-01 02:56:26', '2025-07-01 02:56:26', NULL, NULL, 0, NULL),
(71, 6, NULL, NULL, 'John Johnson Q', NULL, NULL, 3, 'Great experience with Momentum Solar. The installation was quick and the team was professional.', '2025-05-06', 'Facebook', 0, 0, '2025-05-06 02:56:26', '2025-05-06 02:56:26', NULL, NULL, 0, NULL),
(72, 6, NULL, NULL, 'Robert Miller', NULL, NULL, 4, 'Great experience with Momentum Solar. The installation was quick and the team was professional.', '2023-01-22', 'Google', 1, 0, '2023-01-22 02:56:26', '2023-01-22 02:56:26', NULL, NULL, 0, NULL),
(73, 6, NULL, NULL, 'John Rodriguez', NULL, NULL, 5, 'Professional and efficient service from Momentum Solar. Very happy with our new solar panels.', '2023-01-16', 'Website', 0, 0, '2023-01-16 02:56:26', '2023-01-16 02:56:26', NULL, NULL, 0, NULL),
(74, 6, NULL, NULL, 'Robert Brown', NULL, NULL, 4, 'Momentum Solar provided a great solar solution for our home. The installation was seamless.', '2023-09-14', 'Trustpilot', 0, 0, '2023-09-14 02:56:27', '2023-09-14 02:56:27', NULL, NULL, 0, NULL),
(75, 6, NULL, NULL, 'John Rodriguez', NULL, NULL, 1, 'Momentum Solar did an amazing job on our solar installation. Highly recommend!', '2023-11-15', 'Yelp', 0, 0, '2023-11-15 02:56:27', '2023-11-15 02:56:27', NULL, NULL, 0, NULL),
(76, 6, NULL, NULL, 'Sarah Jones', NULL, NULL, 5, 'The team at Momentum Solar was knowledgeable and helpful throughout the entire process.', '2023-01-24', 'Website', 0, 0, '2023-01-24 02:56:27', '2023-01-24 02:56:27', NULL, NULL, 0, NULL),
(77, 6, NULL, NULL, 'David Smith', NULL, NULL, 4, 'Momentum Solar provided a great solar solution for our home. The installation was seamless.', '2023-08-04', 'Website', 0, 0, '2023-08-04 02:56:27', '2023-08-04 02:56:27', NULL, NULL, 0, NULL),
(78, 6, NULL, NULL, 'James Davis', NULL, NULL, 3, 'Very satisfied with the service from Momentum Solar. Our energy bills have dropped significantly.', '2022-03-24', 'Website', 0, 0, '2022-03-24 02:56:27', '2022-03-24 02:56:27', NULL, NULL, 0, NULL),
(79, 6, NULL, NULL, 'Lisa Williams', NULL, NULL, 5, 'I would give Momentum Solar 10 stars if I could. Excellent service and support!', '2022-08-23', 'Trustpilot', 0, 0, '2022-08-23 02:56:27', '2022-08-23 02:56:27', NULL, NULL, 0, NULL),
(80, 6, NULL, NULL, 'Emily Smith', NULL, NULL, 5, 'Momentum Solar made going solar easy and stress-free. Great customer service!', '2024-12-21', 'Website', 0, 0, '2024-12-21 02:56:27', '2024-12-21 02:56:27', NULL, NULL, 0, NULL),
(81, 6, NULL, NULL, 'James Davis', NULL, NULL, 5, 'I would give Momentum Solar 10 stars if I could. Excellent service and support!', '2024-07-23', 'Yelp', 0, 0, '2024-07-23 02:56:27', '2024-07-23 02:56:27', NULL, NULL, 0, NULL),
(82, 6, NULL, NULL, 'Sarah Wilson', NULL, NULL, 2, 'Momentum Solar made going solar easy and stress-free. Great customer service!', '2023-03-08', 'Trustpilot', 0, 0, '2023-03-08 02:56:27', '2023-03-08 02:56:27', NULL, NULL, 0, NULL),
(83, 6, NULL, NULL, 'David Davis', NULL, NULL, 1, 'Momentum Solar made going solar easy and stress-free. Great customer service!', '2024-02-12', 'Yelp', 1, 0, '2024-02-12 02:56:27', '2024-02-12 02:56:27', NULL, NULL, 0, NULL),
(84, 6, NULL, NULL, 'Jennifer Johnson H', NULL, NULL, 1, 'The team at Momentum Solar was knowledgeable and helpful throughout the entire process.', '2025-01-19', 'Facebook', 0, 0, '2025-01-19 02:56:27', '2025-01-19 02:56:27', NULL, NULL, 0, NULL),
(85, 7, NULL, NULL, 'Emily Miller', NULL, NULL, 5, 'PetersenDean did an amazing job on our solar installation. Highly recommend!', '2024-10-09', 'Website', 0, 0, '2024-10-09 02:56:27', '2024-10-09 02:56:27', NULL, NULL, 0, NULL),
(86, 7, NULL, NULL, 'Jennifer Rodriguez', NULL, NULL, 5, 'PetersenDean made going solar easy and stress-free. Great customer service!', '2023-04-01', 'Yelp', 0, 0, '2023-04-01 02:56:27', '2023-04-01 02:56:27', NULL, NULL, 0, NULL),
(87, 7, NULL, NULL, 'David Brown X', NULL, NULL, 2, 'Professional and efficient service from PetersenDean. Very happy with our new solar panels.', '2023-06-27', 'Facebook', 0, 0, '2023-06-27 02:56:27', '2023-06-27 02:56:27', NULL, NULL, 0, NULL),
(88, 7, NULL, NULL, 'Emily Miller', NULL, NULL, 4, 'PetersenDean did an amazing job on our solar installation. Highly recommend!', '2023-05-23', 'Website', 0, 0, '2023-05-23 02:56:28', '2023-05-23 02:56:28', NULL, NULL, 0, NULL),
(89, 7, NULL, NULL, 'Lisa Garcia', NULL, NULL, 5, 'PetersenDean made going solar easy and stress-free. Great customer service!', '2022-12-01', 'Website', 0, 0, '2022-12-01 02:56:28', '2022-12-01 02:56:28', NULL, NULL, 0, NULL),
(90, 7, NULL, NULL, 'Jennifer Miller', NULL, NULL, 4, 'Thanks to PetersenDean, we are now saving money and reducing our carbon footprint.', '2023-03-09', 'Website', 0, 0, '2023-03-09 02:56:28', '2023-03-09 02:56:28', NULL, NULL, 0, NULL),
(91, 7, NULL, NULL, 'John Garcia', NULL, NULL, 4, 'PetersenDean made going solar easy and stress-free. Great customer service!', '2022-07-25', 'Google', 1, 0, '2022-07-25 02:56:28', '2022-07-25 02:56:28', NULL, NULL, 0, NULL),
(92, 7, NULL, NULL, 'Jennifer Brown', NULL, NULL, 5, 'Our experience with PetersenDean was outstanding from start to finish. Highly recommend!', '2025-02-03', 'Yelp', 1, 0, '2025-02-03 02:56:28', '2025-02-03 02:56:28', NULL, NULL, 0, NULL),
(93, 7, NULL, NULL, 'Lisa Smith F', NULL, NULL, 2, 'PetersenDean did an amazing job on our solar installation. Highly recommend!', '2023-06-16', 'Website', 0, 0, '2023-06-16 02:56:28', '2023-06-16 02:56:28', NULL, NULL, 0, NULL),
(94, 7, NULL, NULL, 'Jennifer Williams', NULL, NULL, 3, 'Thanks to PetersenDean, we are now saving money and reducing our carbon footprint.', '2023-09-23', 'Google', 0, 0, '2023-09-23 02:56:28', '2023-09-23 02:56:28', NULL, NULL, 0, NULL),
(95, 7, NULL, NULL, 'Emily Johnson', NULL, NULL, 1, 'Very satisfied with the service from PetersenDean. Our energy bills have dropped significantly.', '2023-08-20', 'Facebook', 0, 0, '2023-08-20 02:56:28', '2023-08-20 02:56:28', NULL, NULL, 0, NULL),
(96, 8, NULL, NULL, 'Emily Jones', NULL, NULL, 4, 'Sunnova made going solar easy and stress-free. Great customer service!', '2024-02-28', 'Facebook', 0, 0, '2024-02-28 02:56:29', '2024-02-28 02:56:29', NULL, NULL, 0, NULL),
(97, 8, NULL, NULL, 'Emily Garcia', NULL, NULL, 2, 'Sunnova did an amazing job on our solar installation. Highly recommend!', '2025-01-25', 'Yelp', 0, 0, '2025-01-25 02:56:29', '2025-01-25 02:56:29', NULL, NULL, 0, NULL),
(98, 8, NULL, NULL, 'James Wilson', NULL, NULL, 3, 'Professional and efficient service from Sunnova. Very happy with our new solar panels.', '2024-04-16', 'Yelp', 0, 0, '2024-04-16 02:56:29', '2024-04-16 02:56:29', NULL, NULL, 0, NULL),
(99, 8, NULL, NULL, 'Lisa Davis', NULL, NULL, 2, 'Very satisfied with the service from Sunnova. Our energy bills have dropped significantly.', '2024-07-16', 'Trustpilot', 0, 0, '2024-07-16 02:56:29', '2024-07-16 02:56:29', NULL, NULL, 0, NULL),
(100, 8, NULL, NULL, 'Sarah Williams', NULL, NULL, 2, 'Our experience with Sunnova was outstanding from start to finish. Highly recommend!', '2024-06-22', 'Google', 0, 0, '2024-06-22 02:56:29', '2024-06-22 02:56:29', NULL, NULL, 0, NULL),
(101, 8, NULL, NULL, 'Michael Rodriguez', NULL, NULL, 5, 'Our experience with Sunnova was outstanding from start to finish. Highly recommend!', '2024-06-04', 'Facebook', 0, 0, '2024-06-04 02:56:29', '2024-06-04 02:56:29', NULL, NULL, 0, NULL),
(102, 8, NULL, NULL, 'Sarah Johnson X', NULL, NULL, 5, 'Professional and efficient service from Sunnova. Very happy with our new solar panels.', '2022-05-31', 'Website', 0, 0, '2022-05-31 02:56:29', '2022-05-31 02:56:29', NULL, NULL, 0, NULL),
(103, 8, NULL, NULL, 'Jennifer Brown M', NULL, NULL, 5, 'Professional and efficient service from Sunnova. Very happy with our new solar panels.', '2022-09-13', 'Trustpilot', 0, 0, '2022-09-13 02:56:29', '2022-09-13 02:56:29', NULL, NULL, 0, NULL),
(104, 8, NULL, NULL, 'Jane Brown', NULL, NULL, 5, 'Sunnova did an amazing job on our solar installation. Highly recommend!', '2022-11-23', 'Yelp', 0, 0, '2022-11-23 02:56:29', '2022-11-23 02:56:29', NULL, NULL, 0, NULL),
(105, 8, NULL, NULL, 'Jane Rodriguez', NULL, NULL, 4, 'Our experience with Sunnova was outstanding from start to finish. Highly recommend!', '2022-12-06', 'Facebook', 0, 0, '2022-12-06 02:56:29', '2022-12-06 02:56:29', NULL, NULL, 0, NULL),
(106, 9, NULL, NULL, 'Emily Williams M', NULL, NULL, 4, 'Great experience with Freedom Forever. The installation was quick and the team was professional.', '2025-04-12', 'Google', 0, 0, '2025-04-12 02:56:30', '2025-04-12 02:56:30', NULL, NULL, 0, NULL),
(107, 9, NULL, NULL, 'James Miller', NULL, NULL, 5, 'Thanks to Freedom Forever, we are now saving money and reducing our carbon footprint.', '2023-04-12', 'Website', 0, 0, '2023-04-12 02:56:30', '2023-04-12 02:56:30', NULL, NULL, 0, NULL),
(108, 9, NULL, NULL, 'John Wilson', NULL, NULL, 5, 'Freedom Forever provided a great solar solution for our home. The installation was seamless.', '2024-09-08', 'Website', 0, 0, '2024-09-08 02:56:30', '2024-09-08 02:56:30', NULL, NULL, 0, NULL),
(109, 9, NULL, NULL, 'Lisa Smith', NULL, NULL, 3, 'Our experience with Freedom Forever was outstanding from start to finish. Highly recommend!', '2022-04-16', 'Google', 0, 0, '2022-04-16 02:56:30', '2022-04-16 02:56:30', NULL, NULL, 0, NULL),
(110, 9, NULL, NULL, 'Lisa Jones', NULL, NULL, 5, 'Freedom Forever made going solar easy and stress-free. Great customer service!', '2022-12-14', 'Facebook', 0, 0, '2022-12-14 02:56:30', '2022-12-14 02:56:30', NULL, NULL, 0, NULL),
(111, 9, NULL, NULL, 'David Jones', NULL, NULL, 4, 'The team at Freedom Forever was knowledgeable and helpful throughout the entire process.', '2024-03-30', 'Trustpilot', 0, 0, '2024-03-30 02:56:30', '2024-03-30 02:56:30', NULL, NULL, 0, NULL),
(112, 9, NULL, NULL, 'Michael Johnson', NULL, NULL, 2, 'I would give Freedom Forever 10 stars if I could. Excellent service and support!', '2024-08-13', 'Yelp', 0, 0, '2024-08-13 02:56:30', '2024-08-13 02:56:30', NULL, NULL, 0, NULL),
(113, 9, NULL, NULL, 'Michael Davis', NULL, NULL, 5, 'Our experience with Freedom Forever was outstanding from start to finish. Highly recommend!', '2023-06-20', 'Trustpilot', 0, 0, '2023-06-20 02:56:30', '2023-06-20 02:56:30', NULL, NULL, 0, NULL),
(114, 9, NULL, NULL, 'Lisa Smith Z', NULL, NULL, 1, 'Thanks to Freedom Forever, we are now saving money and reducing our carbon footprint.', '2022-11-24', 'Website', 0, 0, '2022-11-24 02:56:30', '2022-11-24 02:56:30', NULL, NULL, 0, NULL),
(115, 9, NULL, NULL, 'Emily Garcia', NULL, NULL, 5, 'Very satisfied with the service from Freedom Forever. Our energy bills have dropped significantly.', '2022-02-08', 'Website', 0, 0, '2022-02-08 02:56:30', '2022-02-08 02:56:30', NULL, NULL, 0, NULL),
(116, 9, NULL, NULL, 'Lisa Smith', NULL, NULL, 5, 'Freedom Forever provided a great solar solution for our home. The installation was seamless.', '2022-06-06', 'Yelp', 0, 0, '2022-06-06 02:56:30', '2022-06-06 02:56:30', NULL, NULL, 0, NULL),
(117, 9, NULL, NULL, 'David Smith I', NULL, NULL, 4, 'Freedom Forever provided a great solar solution for our home. The installation was seamless.', '2022-09-30', 'Google', 0, 0, '2022-09-30 02:56:30', '2022-09-30 02:56:30', NULL, NULL, 0, NULL),
(118, 9, NULL, NULL, 'Emily Johnson', NULL, NULL, 2, 'I would give Freedom Forever 10 stars if I could. Excellent service and support!', '2024-09-19', 'Website', 0, 0, '2024-09-19 02:56:30', '2024-09-19 02:56:30', NULL, NULL, 0, NULL),
(119, 9, NULL, NULL, 'James Davis', NULL, NULL, 4, 'Professional and efficient service from Freedom Forever. Very happy with our new solar panels.', '2023-05-16', 'Website', 0, 0, '2023-05-16 02:56:30', '2023-05-16 02:56:30', NULL, NULL, 0, NULL),
(120, 9, NULL, NULL, 'John Brown', NULL, NULL, 5, 'Freedom Forever made going solar easy and stress-free. Great customer service!', '2025-01-06', 'Website', 0, 0, '2025-01-06 02:56:30', '2025-01-06 02:56:30', NULL, NULL, 0, NULL),
(121, 9, NULL, NULL, 'James Johnson', NULL, NULL, 5, 'Very satisfied with the service from Freedom Forever. Our energy bills have dropped significantly.', '2023-04-28', 'Website', 0, 0, '2023-04-28 02:56:31', '2023-04-28 02:56:31', NULL, NULL, 0, NULL),
(122, 9, NULL, NULL, 'James Johnson', NULL, NULL, 1, 'Very satisfied with the service from Freedom Forever. Our energy bills have dropped significantly.', '2022-09-01', 'Website', 0, 0, '2022-09-01 02:56:31', '2022-09-01 02:56:31', NULL, NULL, 0, NULL),
(123, 9, NULL, NULL, 'Lisa Wilson', NULL, NULL, 4, 'Professional and efficient service from Freedom Forever. Very happy with our new solar panels.', '2024-06-23', 'Website', 1, 0, '2024-06-23 02:56:31', '2024-06-23 02:56:31', NULL, NULL, 0, NULL),
(124, 10, NULL, NULL, 'Jennifer Miller', NULL, NULL, 5, 'Trinity Solar made going solar easy and stress-free. Great customer service!', '2024-03-17', 'Website', 0, 0, '2024-03-17 02:56:31', '2024-03-17 02:56:31', NULL, NULL, 0, NULL),
(125, 10, NULL, NULL, 'John Wilson', NULL, NULL, 1, 'Thanks to Trinity Solar, we are now saving money and reducing our carbon footprint.', '2022-11-10', 'Google', 0, 0, '2022-11-10 02:56:31', '2022-11-10 02:56:31', NULL, NULL, 0, NULL),
(126, 10, NULL, NULL, 'John Garcia', NULL, NULL, 3, 'The team at Trinity Solar was knowledgeable and helpful throughout the entire process.', '2022-12-15', 'Google', 0, 0, '2022-12-15 02:56:31', '2022-12-15 02:56:31', NULL, NULL, 0, NULL),
(127, 10, NULL, NULL, 'Emily Garcia', NULL, NULL, 3, 'The team at Trinity Solar was knowledgeable and helpful throughout the entire process.', '2023-04-08', 'Yelp', 0, 0, '2023-04-08 02:56:31', '2023-04-08 02:56:31', NULL, NULL, 0, NULL),
(128, 10, NULL, NULL, 'Emily Johnson K', NULL, NULL, 1, 'The team at Trinity Solar was knowledgeable and helpful throughout the entire process.', '2024-12-12', 'Yelp', 0, 0, '2024-12-12 02:56:31', '2024-12-12 02:56:31', NULL, NULL, 0, NULL),
(129, 10, NULL, NULL, 'Jane Rodriguez', NULL, NULL, 4, 'Very satisfied with the service from Trinity Solar. Our energy bills have dropped significantly.', '2024-09-04', 'Website', 0, 0, '2024-09-04 02:56:32', '2024-09-04 02:56:32', NULL, NULL, 0, NULL),
(130, 10, NULL, NULL, 'James Wilson', NULL, NULL, 4, 'Trinity Solar did an amazing job on our solar installation. Highly recommend!', '2023-09-02', 'Facebook', 0, 0, '2023-09-02 02:56:32', '2023-09-02 02:56:32', NULL, NULL, 0, NULL),
(131, 10, NULL, NULL, 'Michael Rodriguez', NULL, NULL, 3, 'Great experience with Trinity Solar. The installation was quick and the team was professional.', '2025-02-01', 'Yelp', 0, 0, '2025-02-01 02:56:32', '2025-02-01 02:56:32', NULL, NULL, 0, NULL),
(132, 10, NULL, NULL, 'Robert Brown', NULL, NULL, 4, 'Trinity Solar made going solar easy and stress-free. Great customer service!', '2023-10-06', 'Yelp', 0, 0, '2023-10-06 02:56:32', '2023-10-06 02:56:32', NULL, NULL, 0, NULL),
(133, 10, NULL, NULL, 'Lisa Miller', NULL, NULL, 4, 'Trinity Solar provided a great solar solution for our home. The installation was seamless.', '2022-02-17', 'Website', 0, 0, '2022-02-17 02:56:32', '2022-02-17 02:56:32', NULL, NULL, 0, NULL),
(134, 10, NULL, NULL, 'Michael Garcia', NULL, NULL, 5, 'Our experience with Trinity Solar was outstanding from start to finish. Highly recommend!', '2022-04-01', 'Google', 0, 0, '2022-04-01 02:56:32', '2022-04-01 02:56:32', NULL, NULL, 0, NULL),
(135, 10, NULL, NULL, 'David Garcia', NULL, NULL, 2, 'Professional and efficient service from Trinity Solar. Very happy with our new solar panels.', '2024-09-09', 'Website', 1, 0, '2024-09-09 02:56:32', '2024-09-09 02:56:32', NULL, NULL, 0, NULL),
(136, 11, NULL, NULL, 'John Jones', NULL, NULL, 5, 'Thanks to Blue Raven Solar, we are now saving money and reducing our carbon footprint.', '2023-07-24', 'Trustpilot', 0, 0, '2023-07-24 02:56:32', '2023-07-24 02:56:32', NULL, NULL, 0, NULL),
(137, 11, NULL, NULL, 'David Williams', NULL, NULL, 4, 'Our experience with Blue Raven Solar was outstanding from start to finish. Highly recommend!', '2022-08-15', 'Facebook', 1, 0, '2022-08-15 02:56:32', '2022-08-15 02:56:32', NULL, NULL, 0, NULL),
(138, 11, NULL, NULL, 'Robert Wilson K', NULL, NULL, 4, 'I would give Blue Raven Solar 10 stars if I could. Excellent service and support!', '2022-11-12', 'Facebook', 0, 0, '2022-11-12 02:56:32', '2022-11-12 02:56:32', NULL, NULL, 0, NULL),
(139, 11, NULL, NULL, 'David Davis', NULL, NULL, 3, 'Blue Raven Solar did an amazing job on our solar installation. Highly recommend!', '2024-05-17', 'Facebook', 0, 0, '2024-05-17 02:56:32', '2024-05-17 02:56:32', NULL, NULL, 0, NULL),
(140, 11, NULL, NULL, 'Jane Brown', NULL, NULL, 2, 'I would give Blue Raven Solar 10 stars if I could. Excellent service and support!', '2022-05-28', 'Google', 0, 0, '2022-05-28 02:56:32', '2022-05-28 02:56:32', NULL, NULL, 0, NULL),
(141, 11, NULL, NULL, 'Jane Rodriguez', NULL, NULL, 5, 'Professional and efficient service from Blue Raven Solar. Very happy with our new solar panels.', '2025-01-14', 'Facebook', 0, 0, '2025-01-14 02:56:32', '2025-01-14 02:56:32', NULL, NULL, 0, NULL),
(142, 12, NULL, NULL, 'David Rodriguez', NULL, NULL, 3, 'Professional and efficient service from Palmetto Solar. Very happy with our new solar panels.', '2024-12-28', 'Facebook', 0, 0, '2024-12-28 02:56:33', '2024-12-28 02:56:33', NULL, NULL, 0, NULL),
(143, 12, NULL, NULL, 'Lisa Smith', NULL, NULL, 4, 'Thanks to Palmetto Solar, we are now saving money and reducing our carbon footprint.', '2024-10-07', 'Trustpilot', 0, 0, '2024-10-07 02:56:33', '2024-10-07 02:56:33', NULL, NULL, 0, NULL),
(144, 12, NULL, NULL, 'David Garcia', NULL, NULL, 4, 'Palmetto Solar made going solar easy and stress-free. Great customer service!', '2024-11-06', 'Facebook', 0, 0, '2024-11-06 02:56:33', '2024-11-06 02:56:33', NULL, NULL, 0, NULL),
(145, 12, NULL, NULL, 'Lisa Garcia', NULL, NULL, 5, 'Our experience with Palmetto Solar was outstanding from start to finish. Highly recommend!', '2024-03-07', 'Google', 0, 0, '2024-03-07 02:56:33', '2024-03-07 02:56:33', NULL, NULL, 0, NULL),
(146, 12, NULL, NULL, 'Michael Rodriguez', NULL, NULL, 3, 'Professional and efficient service from Palmetto Solar. Very happy with our new solar panels.', '2022-12-08', 'Google', 0, 0, '2022-12-08 02:56:33', '2022-12-08 02:56:33', NULL, NULL, 0, NULL),
(147, 12, NULL, NULL, 'Robert Jones S', NULL, NULL, 2, 'Great experience with Palmetto Solar. The installation was quick and the team was professional.', '2023-08-06', 'Website', 0, 0, '2023-08-06 02:56:33', '2023-08-06 02:56:33', NULL, NULL, 0, NULL),
(148, 12, NULL, NULL, 'Robert Smith', NULL, NULL, 3, 'Palmetto Solar provided a great solar solution for our home. The installation was seamless.', '2024-07-17', 'Facebook', 0, 0, '2024-07-17 02:56:33', '2024-07-17 02:56:33', NULL, NULL, 0, NULL),
(149, 12, NULL, NULL, 'Jane Johnson', NULL, NULL, 5, 'Great experience with Palmetto Solar. The installation was quick and the team was professional.', '2023-11-04', 'Trustpilot', 0, 0, '2023-11-04 02:56:33', '2023-11-04 02:56:33', NULL, NULL, 0, NULL),
(150, 12, NULL, NULL, 'Emily Jones', NULL, NULL, 4, 'Very satisfied with the service from Palmetto Solar. Our energy bills have dropped significantly.', '2024-12-28', 'Website', 0, 0, '2024-12-28 02:56:33', '2024-12-28 02:56:33', NULL, NULL, 0, NULL),
(151, 12, NULL, NULL, 'Robert Williams', NULL, NULL, 3, 'Palmetto Solar did an amazing job on our solar installation. Highly recommend!', '2023-06-30', 'Yelp', 0, 0, '2023-06-30 02:56:34', '2023-06-30 02:56:34', NULL, NULL, 0, NULL),
(152, 12, NULL, NULL, 'Robert Brown L', NULL, NULL, 5, 'Palmetto Solar provided a great solar solution for our home. The installation was seamless.', '2023-10-01', 'Yelp', 0, 0, '2023-10-01 02:56:34', '2023-10-01 02:56:34', NULL, NULL, 0, NULL),
(153, 12, NULL, NULL, 'John Brown', NULL, NULL, 4, 'Professional and efficient service from Palmetto Solar. Very happy with our new solar panels.', '2024-06-08', 'Facebook', 0, 0, '2024-06-08 02:56:34', '2024-06-08 02:56:34', NULL, NULL, 0, NULL),
(154, 12, NULL, NULL, 'Jennifer Smith', NULL, NULL, 5, 'Palmetto Solar did an amazing job on our solar installation. Highly recommend!', '2023-05-06', 'Trustpilot', 0, 0, '2023-05-06 02:56:34', '2023-05-06 02:56:34', NULL, NULL, 0, NULL),
(155, 12, NULL, NULL, 'Jennifer Miller I', NULL, NULL, 5, 'Great experience with Palmetto Solar. The installation was quick and the team was professional.', '2022-09-03', 'Yelp', 0, 0, '2022-09-03 02:56:34', '2022-09-03 02:56:34', NULL, NULL, 0, NULL),
(156, 12, NULL, NULL, 'James Smith', NULL, NULL, 3, 'The team at Palmetto Solar was knowledgeable and helpful throughout the entire process.', '2022-12-22', 'Trustpilot', 0, 0, '2022-12-22 02:56:34', '2022-12-22 02:56:34', NULL, NULL, 0, NULL),
(157, 12, NULL, NULL, 'Michael Smith', NULL, NULL, 5, 'Palmetto Solar provided a great solar solution for our home. The installation was seamless.', '2023-02-28', 'Website', 0, 0, '2023-02-28 02:56:34', '2023-02-28 02:56:34', NULL, NULL, 0, NULL),
(158, 12, NULL, NULL, 'John Rodriguez', NULL, NULL, 4, 'Very satisfied with the service from Palmetto Solar. Our energy bills have dropped significantly.', '2022-09-21', 'Website', 0, 0, '2022-09-21 02:56:34', '2022-09-21 02:56:34', NULL, NULL, 0, NULL),
(159, 12, NULL, NULL, 'James Williams', NULL, NULL, 4, 'Palmetto Solar did an amazing job on our solar installation. Highly recommend!', '2022-05-27', 'Google', 0, 0, '2022-05-27 02:56:34', '2022-05-27 02:56:34', NULL, NULL, 0, NULL),
(160, 12, NULL, NULL, 'Sarah Brown', NULL, NULL, 2, 'Our experience with Palmetto Solar was outstanding from start to finish. Highly recommend!', '2025-04-02', 'Website', 0, 0, '2025-04-02 02:56:34', '2025-04-02 02:56:34', NULL, NULL, 0, NULL),
(161, 12, NULL, NULL, 'Lisa Rodriguez V', NULL, NULL, 3, 'Palmetto Solar made going solar easy and stress-free. Great customer service!', '2024-11-12', 'Yelp', 0, 0, '2024-11-12 02:56:34', '2024-11-12 02:56:34', NULL, NULL, 0, NULL),
(162, 13, NULL, NULL, 'David Davis D', NULL, NULL, 3, 'Thanks to Sunlux, we are now saving money and reducing our carbon footprint.', '2023-12-27', 'Website', 1, 0, '2023-12-27 02:56:35', '2023-12-27 02:56:35', NULL, NULL, 0, NULL),
(163, 13, NULL, NULL, 'Jane Davis', NULL, NULL, 2, 'Sunlux did an amazing job on our solar installation. Highly recommend!', '2023-09-02', 'Google', 0, 0, '2023-09-02 02:56:35', '2023-09-02 02:56:35', NULL, NULL, 0, NULL),
(164, 13, NULL, NULL, 'Emily Garcia', NULL, NULL, 5, 'Thanks to Sunlux, we are now saving money and reducing our carbon footprint.', '2024-08-04', 'Website', 0, 0, '2024-08-04 02:56:35', '2024-08-04 02:56:35', NULL, NULL, 0, NULL),
(165, 13, NULL, NULL, 'Emily Jones', NULL, NULL, 4, 'Sunlux made going solar easy and stress-free. Great customer service!', '2022-11-21', 'Yelp', 0, 0, '2022-11-21 02:56:35', '2022-11-21 02:56:35', NULL, NULL, 0, NULL),
(166, 13, NULL, NULL, 'Lisa Wilson', NULL, NULL, 4, 'Thanks to Sunlux, we are now saving money and reducing our carbon footprint.', '2022-11-19', 'Trustpilot', 0, 0, '2022-11-19 02:56:35', '2022-11-19 02:56:35', NULL, NULL, 0, NULL),
(167, 13, NULL, NULL, 'Michael Jones', NULL, NULL, 5, 'Our experience with Sunlux was outstanding from start to finish. Highly recommend!', '2023-01-11', 'Trustpilot', 0, 0, '2023-01-11 02:56:35', '2023-01-11 02:56:35', NULL, NULL, 0, NULL),
(168, 13, NULL, NULL, 'Lisa Garcia W', NULL, NULL, 5, 'Thanks to Sunlux, we are now saving money and reducing our carbon footprint.', '2023-06-22', 'Google', 0, 0, '2023-06-22 02:56:35', '2023-06-22 02:56:35', NULL, NULL, 0, NULL),
(169, 14, NULL, NULL, 'Jennifer Rodriguez', NULL, NULL, 2, 'Our experience with ADT Solar was outstanding from start to finish. Highly recommend!', '2023-02-11', 'Website', 0, 0, '2023-02-11 02:56:35', '2023-02-11 02:56:35', NULL, NULL, 0, NULL),
(170, 14, NULL, NULL, 'David Garcia', NULL, NULL, 4, 'The team at ADT Solar was knowledgeable and helpful throughout the entire process.', '2022-10-08', 'Trustpilot', 0, 0, '2022-10-08 02:56:35', '2022-10-08 02:56:35', NULL, NULL, 0, NULL),
(171, 14, NULL, NULL, 'Sarah Garcia', NULL, NULL, 2, 'Professional and efficient service from ADT Solar. Very happy with our new solar panels.', '2023-05-12', 'Yelp', 0, 0, '2023-05-12 02:56:35', '2023-05-12 02:56:35', NULL, NULL, 0, NULL),
(172, 14, NULL, NULL, 'James Brown', NULL, NULL, 1, 'Great experience with ADT Solar. The installation was quick and the team was professional.', '2023-11-23', 'Website', 1, 0, '2023-11-23 02:56:35', '2023-11-23 02:56:35', NULL, NULL, 0, NULL),
(173, 14, NULL, NULL, 'Robert Rodriguez', NULL, NULL, 3, 'Professional and efficient service from ADT Solar. Very happy with our new solar panels.', '2024-03-03', 'Website', 0, 0, '2024-03-03 02:56:35', '2024-03-03 02:56:35', NULL, NULL, 0, NULL),
(174, 14, NULL, NULL, 'David Wilson', NULL, NULL, 4, 'The team at ADT Solar was knowledgeable and helpful throughout the entire process.', '2024-07-01', 'Trustpilot', 0, 0, '2024-07-01 02:56:35', '2024-07-01 02:56:35', NULL, NULL, 0, NULL),
(175, 14, NULL, NULL, 'Lisa Rodriguez', NULL, NULL, 5, 'The team at ADT Solar was knowledgeable and helpful throughout the entire process.', '2024-08-27', 'Website', 0, 0, '2024-08-27 02:56:35', '2024-08-27 02:56:35', NULL, NULL, 0, NULL),
(176, 14, NULL, NULL, 'James Miller', NULL, NULL, 5, 'The team at ADT Solar was knowledgeable and helpful throughout the entire process.', '2023-11-13', 'Yelp', 0, 0, '2023-11-13 02:56:36', '2023-11-13 02:56:36', NULL, NULL, 0, NULL),
(177, 14, NULL, NULL, 'Sarah Wilson', NULL, NULL, 3, 'Very satisfied with the service from ADT Solar. Our energy bills have dropped significantly.', '2024-05-11', 'Facebook', 0, 0, '2024-05-11 02:56:36', '2024-05-11 02:56:36', NULL, NULL, 0, NULL),
(178, 15, NULL, NULL, 'Lisa Brown', NULL, NULL, 3, 'Professional and efficient service from SunPower by Blue Raven. Very happy with our new solar panels.', '2025-02-03', 'Trustpilot', 0, 0, '2025-02-03 02:56:36', '2025-02-03 02:56:36', NULL, NULL, 0, NULL),
(179, 15, NULL, NULL, 'Robert Smith', NULL, NULL, 5, 'Thanks to SunPower by Blue Raven, we are now saving money and reducing our carbon footprint.', '2022-10-12', 'Google', 0, 0, '2022-10-12 02:56:36', '2022-10-12 02:56:36', NULL, NULL, 0, NULL),
(180, 15, NULL, NULL, 'Jane Smith', NULL, NULL, 5, 'SunPower by Blue Raven made going solar easy and stress-free. Great customer service!', '2023-08-25', 'Trustpilot', 0, 0, '2023-08-25 02:56:36', '2023-08-25 02:56:36', NULL, NULL, 0, NULL),
(181, 15, NULL, NULL, 'Robert Jones', NULL, NULL, 5, 'Great experience with SunPower by Blue Raven. The installation was quick and the team was professional.', '2023-06-22', 'Facebook', 0, 0, '2023-06-22 02:56:36', '2023-06-22 02:56:36', NULL, NULL, 0, NULL),
(182, 15, NULL, NULL, 'Michael Smith X', NULL, NULL, 4, 'SunPower by Blue Raven provided a great solar solution for our home. The installation was seamless.', '2024-06-22', 'Google', 0, 0, '2024-06-22 02:56:36', '2024-06-22 02:56:36', NULL, NULL, 0, NULL),
(183, 15, NULL, NULL, 'David Jones Z', NULL, NULL, 5, 'Great experience with SunPower by Blue Raven. The installation was quick and the team was professional.', '2023-01-23', 'Google', 0, 0, '2023-01-23 02:56:36', '2023-01-23 02:56:36', NULL, NULL, 0, NULL),
(184, 15, NULL, NULL, 'Michael Brown I', NULL, NULL, 3, 'SunPower by Blue Raven made going solar easy and stress-free. Great customer service!', '2025-02-05', 'Trustpilot', 0, 0, '2025-02-05 02:56:36', '2025-02-05 02:56:36', NULL, NULL, 0, NULL),
(185, 15, NULL, NULL, 'Michael Johnson', NULL, NULL, 5, 'Very satisfied with the service from SunPower by Blue Raven. Our energy bills have dropped significantly.', '2024-07-21', 'Trustpilot', 0, 0, '2024-07-21 02:56:36', '2024-07-21 02:56:36', NULL, NULL, 0, NULL),
(186, 15, NULL, NULL, 'Jennifer Garcia', NULL, NULL, 4, 'SunPower by Blue Raven made going solar easy and stress-free. Great customer service!', '2024-06-08', 'Yelp', 0, 0, '2024-06-08 02:56:36', '2024-06-08 02:56:36', NULL, NULL, 0, NULL),
(187, 15, NULL, NULL, 'David Rodriguez', NULL, NULL, 5, 'The team at SunPower by Blue Raven was knowledgeable and helpful throughout the entire process.', '2024-11-15', 'Trustpilot', 0, 0, '2024-11-15 02:56:37', '2024-11-15 02:56:37', NULL, NULL, 0, NULL),
(188, 15, NULL, NULL, 'John Miller', NULL, NULL, 5, 'Great experience with SunPower by Blue Raven. The installation was quick and the team was professional.', '2023-04-05', 'Website', 0, 0, '2023-04-05 02:56:37', '2023-04-05 02:56:37', NULL, NULL, 0, NULL),
(189, 15, NULL, NULL, 'James Wilson', NULL, NULL, 3, 'Great experience with SunPower by Blue Raven. The installation was quick and the team was professional.', '2023-09-30', 'Website', 1, 0, '2023-09-30 02:56:37', '2023-09-30 02:56:37', NULL, NULL, 0, NULL),
(190, 15, NULL, NULL, 'John Wilson I', NULL, NULL, 5, 'Great experience with SunPower by Blue Raven. The installation was quick and the team was professional.', '2024-04-05', 'Yelp', 0, 0, '2024-04-05 02:56:37', '2024-04-05 02:56:37', NULL, NULL, 0, NULL),
(191, 15, NULL, NULL, 'David Garcia L', NULL, NULL, 3, 'Our experience with SunPower by Blue Raven was outstanding from start to finish. Highly recommend!', '2023-03-22', 'Google', 0, 0, '2023-03-22 02:56:37', '2023-03-22 02:56:37', NULL, NULL, 0, NULL),
(192, 15, NULL, NULL, 'Jennifer Jones L', NULL, NULL, 4, 'Professional and efficient service from SunPower by Blue Raven. Very happy with our new solar panels.', '2024-02-11', 'Trustpilot', 0, 0, '2024-02-11 02:56:37', '2024-02-11 02:56:37', NULL, NULL, 0, NULL),
(193, 15, NULL, NULL, 'Sarah Johnson', NULL, NULL, 5, 'Our experience with SunPower by Blue Raven was outstanding from start to finish. Highly recommend!', '2025-04-15', 'Facebook', 0, 0, '2025-04-15 02:56:37', '2025-04-15 02:56:37', NULL, NULL, 0, NULL),
(194, 16, NULL, NULL, 'Emily Rodriguez Z', NULL, NULL, 2, 'The team at Sunworks was knowledgeable and helpful throughout the entire process.', '2023-10-02', 'Trustpilot', 1, 0, '2023-10-02 02:56:37', '2023-10-02 02:56:37', NULL, NULL, 0, NULL),
(195, 16, NULL, NULL, 'David Smith', NULL, NULL, 2, 'Very satisfied with the service from Sunworks. Our energy bills have dropped significantly.', '2022-12-15', 'Website', 0, 0, '2022-12-15 02:56:37', '2022-12-15 02:56:37', NULL, NULL, 0, NULL),
(196, 16, NULL, NULL, 'Sarah Jones R', NULL, NULL, 4, 'Sunworks provided a great solar solution for our home. The installation was seamless.', '2024-04-20', 'Google', 0, 0, '2024-04-20 02:56:37', '2024-04-20 02:56:37', NULL, NULL, 0, NULL),
(197, 16, NULL, NULL, 'Robert Miller', NULL, NULL, 5, 'Very satisfied with the service from Sunworks. Our energy bills have dropped significantly.', '2023-05-01', 'Facebook', 1, 0, '2023-05-01 02:56:38', '2023-05-01 02:56:38', NULL, NULL, 0, NULL),
(198, 16, NULL, NULL, 'John Jones J', NULL, NULL, 5, 'Our experience with Sunworks was outstanding from start to finish. Highly recommend!', '2024-08-09', 'Yelp', 0, 0, '2024-08-09 02:56:38', '2024-08-09 02:56:38', NULL, NULL, 0, NULL),
(199, 16, NULL, NULL, 'Michael Wilson', NULL, NULL, 5, 'Sunworks made going solar easy and stress-free. Great customer service!', '2023-05-26', 'Google', 0, 0, '2023-05-26 02:56:38', '2023-05-26 02:56:38', NULL, NULL, 0, NULL),
(200, 16, NULL, NULL, 'Sarah Brown', NULL, NULL, 5, 'The team at Sunworks was knowledgeable and helpful throughout the entire process.', '2024-06-06', 'Facebook', 0, 0, '2024-06-06 02:56:38', '2024-06-06 02:56:38', NULL, NULL, 0, NULL),
(201, 16, NULL, NULL, 'John Smith W', NULL, NULL, 4, 'Thanks to Sunworks, we are now saving money and reducing our carbon footprint.', '2024-06-08', 'Google', 0, 0, '2024-06-08 02:56:38', '2024-06-08 02:56:38', NULL, NULL, 0, NULL),
(202, 17, NULL, NULL, 'Lisa Rodriguez', NULL, NULL, 1, 'The team at SunPower by Infinity was knowledgeable and helpful throughout the entire process.', '2024-02-13', 'Google', 0, 0, '2024-02-13 02:56:38', '2024-02-13 02:56:38', NULL, NULL, 0, NULL),
(203, 17, NULL, NULL, 'David Williams Q', NULL, NULL, 3, 'SunPower by Infinity made going solar easy and stress-free. Great customer service!', '2024-03-15', 'Google', 0, 0, '2024-03-15 02:56:38', '2024-03-15 02:56:38', NULL, NULL, 0, NULL),
(204, 17, NULL, NULL, 'John Davis', NULL, NULL, 3, 'Very satisfied with the service from SunPower by Infinity. Our energy bills have dropped significantly.', '2023-03-06', 'Trustpilot', 0, 0, '2023-03-06 02:56:39', '2023-03-06 02:56:39', NULL, NULL, 0, NULL),
(205, 17, NULL, NULL, 'James Smith W', NULL, NULL, 3, 'SunPower by Infinity did an amazing job on our solar installation. Highly recommend!', '2024-02-21', 'Website', 0, 0, '2024-02-21 02:56:39', '2024-02-21 02:56:39', NULL, NULL, 0, NULL),
(206, 17, NULL, NULL, 'Emily Davis L', NULL, NULL, 3, 'Very satisfied with the service from SunPower by Infinity. Our energy bills have dropped significantly.', '2024-10-28', 'Google', 0, 0, '2024-10-28 02:56:39', '2024-10-28 02:56:39', NULL, NULL, 0, NULL),
(207, 17, NULL, NULL, 'Michael Garcia', NULL, NULL, 5, 'Thanks to SunPower by Infinity, we are now saving money and reducing our carbon footprint.', '2023-01-03', 'Website', 0, 0, '2023-01-03 02:56:39', '2023-01-03 02:56:39', NULL, NULL, 0, NULL);
INSERT INTO `company_reviews` (`id`, `company_id`, `category_id`, `state_id`, `reviewer_name`, `review_title`, `email`, `rating`, `review_text`, `review_date`, `source`, `is_featured`, `is_approved`, `created_at`, `updated_at`, `deleted_at`, `otp`, `otp_verified`, `otp_expires_at`) VALUES
(208, 17, NULL, NULL, 'Jennifer Smith', NULL, NULL, 5, 'I would give SunPower by Infinity 10 stars if I could. Excellent service and support!', '2024-09-07', 'Website', 0, 0, '2024-09-07 02:56:40', '2024-09-07 02:56:40', NULL, NULL, 0, NULL),
(209, 18, NULL, NULL, 'Lisa Garcia', NULL, NULL, 4, 'The team at SunPower by Custom Energy was knowledgeable and helpful throughout the entire process.', '2024-05-18', 'Website', 1, 0, '2024-05-18 02:56:40', '2024-05-18 02:56:40', NULL, NULL, 0, NULL),
(210, 18, NULL, NULL, 'Jennifer Brown', NULL, NULL, 5, 'Our experience with SunPower by Custom Energy was outstanding from start to finish. Highly recommend!', '2024-09-17', 'Yelp', 0, 0, '2024-09-17 02:56:40', '2024-09-17 02:56:40', NULL, NULL, 0, NULL),
(211, 18, NULL, NULL, 'David Brown V', NULL, NULL, 5, 'Great experience with SunPower by Custom Energy. The installation was quick and the team was professional.', '2024-01-27', 'Website', 0, 0, '2024-01-27 02:56:41', '2024-01-27 02:56:41', NULL, NULL, 0, NULL),
(212, 18, NULL, NULL, 'Jane Wilson', NULL, NULL, 5, 'I would give SunPower by Custom Energy 10 stars if I could. Excellent service and support!', '2023-07-23', 'Trustpilot', 0, 0, '2023-07-23 02:56:41', '2023-07-23 02:56:41', NULL, NULL, 0, NULL),
(213, 18, NULL, NULL, 'Sarah Miller', NULL, NULL, 5, 'Thanks to SunPower by Custom Energy, we are now saving money and reducing our carbon footprint.', '2024-05-13', 'Trustpilot', 0, 0, '2024-05-13 02:56:41', '2024-05-13 02:56:41', NULL, NULL, 0, NULL),
(214, 18, NULL, NULL, 'David Jones', NULL, NULL, 3, 'Our experience with SunPower by Custom Energy was outstanding from start to finish. Highly recommend!', '2024-12-26', 'Facebook', 0, 0, '2024-12-26 02:56:41', '2024-12-26 02:56:41', NULL, NULL, 0, NULL),
(215, 18, NULL, NULL, 'Emily Brown', NULL, NULL, 4, 'Very satisfied with the service from SunPower by Custom Energy. Our energy bills have dropped significantly.', '2024-07-02', 'Website', 1, 0, '2024-07-02 02:56:41', '2024-07-02 02:56:41', NULL, NULL, 0, NULL),
(216, 18, NULL, NULL, 'Robert Jones L', NULL, NULL, 5, 'Great experience with SunPower by Custom Energy. The installation was quick and the team was professional.', '2023-04-05', 'Facebook', 0, 0, '2023-04-05 02:56:41', '2023-04-05 02:56:41', NULL, NULL, 0, NULL),
(217, 18, NULL, NULL, 'Jennifer Miller', NULL, NULL, 3, 'The team at SunPower by Custom Energy was knowledgeable and helpful throughout the entire process.', '2023-11-14', 'Website', 1, 0, '2023-11-14 02:56:41', '2023-11-14 02:56:41', NULL, NULL, 0, NULL),
(218, 18, NULL, NULL, 'Jane Wilson', NULL, NULL, 2, 'Very satisfied with the service from SunPower by Custom Energy. Our energy bills have dropped significantly.', '2024-08-05', 'Trustpilot', 0, 0, '2024-08-05 02:56:41', '2024-08-05 02:56:41', NULL, NULL, 0, NULL),
(219, 18, NULL, NULL, 'Robert Garcia L', NULL, NULL, 2, 'The team at SunPower by Custom Energy was knowledgeable and helpful throughout the entire process.', '2023-06-30', 'Yelp', 0, 0, '2023-06-30 02:56:41', '2023-06-30 02:56:41', NULL, NULL, 0, NULL),
(220, 18, NULL, NULL, 'Michael Johnson', NULL, NULL, 5, 'SunPower by Custom Energy made going solar easy and stress-free. Great customer service!', '2025-02-13', 'Website', 0, 0, '2025-02-13 02:56:41', '2025-02-13 02:56:41', NULL, NULL, 0, NULL),
(221, 18, NULL, NULL, 'Jennifer Davis K', NULL, NULL, 4, 'The team at SunPower by Custom Energy was knowledgeable and helpful throughout the entire process.', '2025-04-12', 'Trustpilot', 1, 0, '2025-04-12 02:56:42', '2025-04-12 02:56:42', NULL, NULL, 0, NULL),
(222, 18, NULL, NULL, 'Emily Wilson', NULL, NULL, 4, 'SunPower by Custom Energy provided a great solar solution for our home. The installation was seamless.', '2022-03-10', 'Website', 0, 0, '2022-03-10 02:56:42', '2022-03-10 02:56:42', NULL, NULL, 0, NULL),
(223, 18, NULL, NULL, 'Lisa Smith', NULL, NULL, 2, 'SunPower by Custom Energy did an amazing job on our solar installation. Highly recommend!', '2024-07-21', 'Google', 0, 0, '2024-07-21 02:56:42', '2024-07-21 02:56:42', NULL, NULL, 0, NULL),
(224, 18, NULL, NULL, 'Sarah Johnson', NULL, NULL, 4, 'Great experience with SunPower by Custom Energy. The installation was quick and the team was professional.', '2022-10-14', 'Yelp', 1, 0, '2022-10-14 02:56:42', '2022-10-14 02:56:42', NULL, NULL, 0, NULL),
(225, 19, NULL, NULL, 'Sarah Davis', NULL, NULL, 5, 'SunPower by Horizon provided a great solar solution for our home. The installation was seamless.', '2024-05-29', 'Facebook', 0, 0, '2024-05-29 02:56:43', '2024-05-29 02:56:43', NULL, NULL, 0, NULL),
(226, 19, NULL, NULL, 'Jane Williams Q', NULL, NULL, 5, 'Very satisfied with the service from SunPower by Horizon. Our energy bills have dropped significantly.', '2024-06-08', 'Google', 1, 0, '2024-06-08 02:56:43', '2024-06-08 02:56:43', NULL, NULL, 0, NULL),
(227, 19, NULL, NULL, 'Sarah Miller N', NULL, NULL, 5, 'Great experience with SunPower by Horizon. The installation was quick and the team was professional.', '2024-03-15', 'Trustpilot', 0, 0, '2024-03-15 02:56:43', '2024-03-15 02:56:43', NULL, NULL, 0, NULL),
(228, 19, NULL, NULL, 'Michael Garcia', NULL, NULL, 3, 'Thanks to SunPower by Horizon, we are now saving money and reducing our carbon footprint.', '2022-02-28', 'Trustpilot', 0, 0, '2022-02-28 02:56:43', '2022-02-28 02:56:43', NULL, NULL, 0, NULL),
(229, 19, NULL, NULL, 'Michael Garcia', NULL, NULL, 5, 'SunPower by Horizon did an amazing job on our solar installation. Highly recommend!', '2023-10-06', 'Yelp', 0, 0, '2023-10-06 02:56:43', '2023-10-06 02:56:43', NULL, NULL, 0, NULL),
(230, 19, NULL, NULL, 'Jane Brown', NULL, NULL, 4, 'SunPower by Horizon did an amazing job on our solar installation. Highly recommend!', '2024-07-16', 'Website', 0, 0, '2024-07-16 02:56:43', '2024-07-16 02:56:43', NULL, NULL, 0, NULL),
(231, 20, NULL, NULL, 'John Davis', NULL, NULL, 5, 'SunPower by Sunworks did an amazing job on our solar installation. Highly recommend!', '2022-09-10', 'Website', 0, 0, '2022-09-10 02:56:44', '2022-09-10 02:56:44', NULL, NULL, 0, NULL),
(232, 20, NULL, NULL, 'Robert Johnson', NULL, NULL, 4, 'SunPower by Sunworks provided a great solar solution for our home. The installation was seamless.', '2024-12-28', 'Yelp', 0, 0, '2024-12-28 02:56:44', '2024-12-28 02:56:44', NULL, NULL, 0, NULL),
(233, 20, NULL, NULL, 'James Johnson', NULL, NULL, 4, 'Professional and efficient service from SunPower by Sunworks. Very happy with our new solar panels.', '2023-10-27', 'Google', 0, 0, '2023-10-27 02:56:44', '2023-10-27 02:56:44', NULL, NULL, 0, NULL),
(234, 20, NULL, NULL, 'Emily Miller F', NULL, NULL, 5, 'SunPower by Sunworks made going solar easy and stress-free. Great customer service!', '2024-02-09', 'Facebook', 0, 0, '2024-02-09 02:56:45', '2024-02-09 02:56:45', NULL, NULL, 0, NULL),
(235, 20, NULL, NULL, 'Jane Rodriguez', NULL, NULL, 4, 'Our experience with SunPower by Sunworks was outstanding from start to finish. Highly recommend!', '2024-02-24', 'Website', 0, 0, '2024-02-24 02:56:45', '2024-02-24 02:56:45', NULL, NULL, 0, NULL),
(236, 20, NULL, NULL, 'Jennifer Wilson', NULL, NULL, 3, 'Very satisfied with the service from SunPower by Sunworks. Our energy bills have dropped significantly.', '2023-08-30', 'Google', 0, 0, '2023-08-30 02:56:45', '2023-08-30 02:56:45', NULL, NULL, 0, NULL),
(237, 1, NULL, 32, 'Harsh', 'Good Products', 'distinctharsh@gmail.com', 3, 'Their solar inverter was of excellent quality Ã¢â‚¬â€ installation was smooth, and the performance exceeded expectations. Both the product and service were truly top-notch.Ã¢â‚¬Â Ã¢Å¡Â¡Ã¢Ëœâ‚¬Ã¯Â¸Â', '2025-11-11', 'website', 1, 0, '2025-11-11 05:12:19', '2025-11-11 06:57:46', NULL, NULL, 0, NULL),
(238, 8, 3, 2, 'Harsh', 'Good Products', 'distinctharsh@gmail.com', 4, 'I recently bought an inverter from this company and I really liked it. The build quality is good, the performance is reliable, and it works smoothly without any issues. I’m fully satisfied with the product and would definitely recommend this company to others', '2025-11-14', 'website', 0, 0, '2025-11-14 10:57:26', '2025-11-14 10:57:26', NULL, NULL, 0, NULL);

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
(4, '2025_11_08_200817_create_states_table', 1),
(5, '2025_11_08_200825_create_categories_table', 1),
(6, '2025_11_08_200852_create_products_table', 1),
(7, '2025_11_08_200905_create_product_variants_table', 1),
(8, '2025_11_08_200920_create_reviews_table', 1),
(9, '2025_11_08_201724_add_is_admin_to_users_table', 1),
(10, '2025_11_09_181500_create_states_table', 1),
(11, '2025_11_09_181510_create_cities_table', 1),
(12, '2025_11_09_181520_create_companies_table', 1),
(13, '2025_11_09_181540_create_company_reviews_table', 1),
(14, '2025_11_11_095315_add_fields_to_company_reviews_table', 2),
(15, '2025_11_14_000000_create_company_category_table', 3),
(16, '2025_11_14_000010_add_category_id_to_company_reviews_table', 3);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `features` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `model_number` varchar(255) DEFAULT NULL,
  `warranty_years` decimal(5,1) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT 'Rating from 1 to 5',
  `author_name` varchar(255) NOT NULL,
  `author_email` varchar(255) NOT NULL,
  `author_location` varchar(255) DEFAULT NULL,
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('027BiK4jygFMXJQJVaafdB1SlsKEmpe4JDTEzfeQ', NULL, '42.106.160.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidzVzU1g3MTJ0N05WeUI1TFlMeXNrb0JTQ2NtYkRYSjlhcmhtdjFIbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cHM6Ly9zb2xhcnJldmlld3MuZGlzdGluY3RoYXJzaC5jb20vYWRtaW4vZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763791657),
('ANHYp4H4UMvyRJYwDWJ6GR6tkEBfBTXUGx4jdMU2', NULL, '195.211.77.142', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0dHUm9KVGJwekM5WkdPY3RaS1VrbEs2SnNjcVcxRU00cVZGMXBwRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763815048),
('ARN2Iy9pCjlkkzTwP9c4Z6z6jkbPBT1f83T6BC8A', NULL, '195.211.77.142', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYk9iYWhPOFBjYzNsWkFqbHpDZGk2emgxTG5heVoyaHhLNGFoekFncyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763815011),
('HAyI0ebtx7MDCkkeqYBg8zCLj4q0iKYma0v7Y9AB', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMWRMRHlmdDN4a3dLZUFXcDZOZkk1Tmkzd2VDd1k2UjZsS0dTdXlCdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764042607),
('HxflSEMDbFSP3hWRPra52qbzEIi2VU1ikMl1L3Nh', NULL, '2405:201:4014:2042:79ae:397:c1c2:fcb1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3lyVEExSlN0Mll0SEw3cE5oekJUQ2ttZVdXa3hmdUxhVDE4MWtoSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763792464),
('IVNA4oNsfRBLh9xiDuTDgEZsgYHOW7wbBoKnOrPX', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZ090Y00xWWtRYkhaZ2ZWMmtoeG9yNWk3VkhWcXhRZUM1RDJpOTlhNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763995793),
('LeU86s9l4F2b7snRhdq0jcH5aaDxmAfMnruYuDQP', NULL, '2405:201:4014:2042:6c34:5538:89f2:f21f', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXYyOWVYRll0aWM3U20wQTgzOWF5M2o5TUtJTDJKUEtZSXFHMXF2QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763886156),
('t9DUXpUKTRCrgcRrJ8sRV98jPV5zBZtLf72O2v9I', NULL, '49.44.67.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnFFWEZOS3VXa1AxZVpZeDBCNVcwZlpMVnB0UDJIZHJnUk1ZNGdWTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763791644),
('TMnJjZIzn0KUtqmBg90YG9iwZ8ptdHZ15rO6CnqP', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNUFPdEpYdHFVelkzTFZ4Qm5ZV2paSERIdnFLQ0JLeWtVRlZzNm9CTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763877794),
('WnWxDcpHXZWyxq3c3iLk7bBUYmWR4Y1UD0O82HCC', 1, '2405:201:4014:2042:79ae:397:c1c2:fcb1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibHVSV0pSaFd5RG5NZHNKNlB3Z2x3TVZGMTVxU3gyQm50S041NXNtbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tL2FkbWluL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1763793163),
('xLBwmLhYvZOtrjFXzASp5l1j6OgBESkU1Ym3ZUPg', 1, '2409:40d0:202c:7b5f:e47f:8447:609:411b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmFJaXI4U3lNcnM0bmtVUUtOUUFDdzlWMkJnVDB0ZTBzakc0RVE2dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1763791713),
('ZVig1QFNJY11ETh1TefthgsP52EgxM12mMu6auwR', NULL, '209.38.110.109', 'Mozilla/5.0 (X11; Linux x86_64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkFRa09uenJTZTlKOEpLeWEwZXh5UkJMUjRwOEp2ZGgwV3NHQjAxWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc29sYXJyZXZpZXdzLmRpc3RpbmN0aGFyc2guY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763900974);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `code` varchar(2) NOT NULL COMMENT 'State code like CA, NY, etc.',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `slug`, `description`, `code`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Andhra Pradesh', 'andhra-pradesh', 'Top solar companies in Andhra Pradesh', 'AP', 1, '2025-11-11 02:56:10', '2025-11-11 02:56:10', NULL),
(2, 'Arunachal Pradesh', 'arunachal-pradesh', 'Top solar companies in Arunachal Pradesh', 'AR', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(3, 'Assam', 'assam', 'Top solar companies in Assam', 'AS', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(4, 'Bihar', 'bihar', 'Top solar companies in Bihar', 'BR', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(5, 'Chhattisgarh', 'chhattisgarh', 'Top solar companies in Chhattisgarh', 'CG', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(6, 'Goa', 'goa', 'Top solar companies in Goa', 'GA', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(7, 'Gujarat', 'gujarat', 'Top solar companies in Gujarat', 'GJ', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(8, 'Haryana', 'haryana', 'Top solar companies in Haryana', 'HR', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(9, 'Himachal Pradesh', 'himachal-pradesh', 'Top solar companies in Himachal Pradesh', 'HP', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(10, 'Jharkhand', 'jharkhand', 'Top solar companies in Jharkhand', 'JH', 1, '2025-11-11 02:56:11', '2025-11-11 02:56:11', NULL),
(11, 'Karnataka', 'karnataka', 'Top solar companies in Karnataka', 'KA', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(12, 'Kerala', 'kerala', 'Top solar companies in Kerala', 'KL', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(13, 'Madhya Pradesh', 'madhya-pradesh', 'Top solar companies in Madhya Pradesh', 'MP', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(14, 'Maharashtra', 'maharashtra', 'Top solar companies in Maharashtra', 'MH', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(15, 'Manipur', 'manipur', 'Top solar companies in Manipur', 'MN', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(16, 'Meghalaya', 'meghalaya', 'Top solar companies in Meghalaya', 'ML', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(17, 'Mizoram', 'mizoram', 'Top solar companies in Mizoram', 'MZ', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(18, 'Nagaland', 'nagaland', 'Top solar companies in Nagaland', 'NL', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(19, 'Odisha', 'odisha', 'Top solar companies in Odisha', 'OD', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(20, 'Punjab', 'punjab', 'Top solar companies in Punjab', 'PB', 1, '2025-11-11 02:56:12', '2025-11-11 02:56:12', NULL),
(21, 'Rajasthan', 'rajasthan', 'Top solar companies in Rajasthan', 'RJ', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(22, 'Sikkim', 'sikkim', 'Top solar companies in Sikkim', 'SK', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(23, 'Tamil Nadu', 'tamil-nadu', 'Top solar companies in Tamil Nadu', 'TN', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(24, 'Telangana', 'telangana', 'Top solar companies in Telangana', 'TG', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(25, 'Tripura', 'tripura', 'Top solar companies in Tripura', 'TR', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(26, 'Uttar Pradesh', 'uttar-pradesh', 'Top solar companies in Uttar Pradesh', 'UP', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(27, 'Uttarakhand', 'uttarakhand', 'Top solar companies in Uttarakhand', 'UK', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(28, 'West Bengal', 'west-bengal', 'Top solar companies in West Bengal', 'WB', 1, '2025-11-11 02:56:13', '2025-11-11 02:56:13', NULL),
(29, 'Andaman and Nicobar Islands', 'andaman-and-nicobar-islands', 'Top solar companies in Andaman and Nicobar Islands', 'AN', 1, '2025-11-11 02:56:14', '2025-11-11 02:56:14', NULL),
(30, 'Chandigarh', 'chandigarh', 'Top solar companies in Chandigarh', 'CH', 1, '2025-11-11 02:56:14', '2025-11-11 02:56:14', NULL),
(31, 'Dadra and Nagar Haveli and Daman and Diu', 'dadra-and-nagar-haveli-and-daman-and-diu', 'Top solar companies in Dadra and Nagar Haveli and Daman and Diu', 'DN', 1, '2025-11-11 02:56:14', '2025-11-11 02:56:14', NULL),
(32, 'Delhi', 'delhi', 'Top solar companies in Delhi', 'DL', 1, '2025-11-11 02:56:14', '2025-11-11 02:56:14', NULL),
(33, 'Jammu and Kashmir', 'jammu-and-kashmir', 'Top solar companies in Jammu and Kashmir', 'JK', 1, '2025-11-11 02:56:14', '2025-11-11 02:56:14', NULL),
(34, 'Ladakh', 'ladakh', 'Top solar companies in Ladakh', 'LA', 1, '2025-11-11 02:56:14', '2025-11-11 02:56:14', NULL),
(35, 'Lakshadweep', 'lakshadweep', 'Top solar companies in Lakshadweep', 'LD', 1, '2025-11-11 02:56:15', '2025-11-11 02:56:15', NULL),
(36, 'Puducherry', 'puducherry', 'Top solar companies in Puducherry', 'PY', 1, '2025-11-11 02:56:15', '2025-11-11 02:56:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2025-11-11 06:41:42', 1, '$2y$12$ai9CZvzM1hS2fGw54UFQdeufETT1F2mBewtE5k/6RUPv0DQCrMykS', 'oawbp0eEBcaDJt4vUOpD4lT6V7cru6k19OSyVacgImQJlew7UpzsBP5rMj8Q', '2025-11-11 02:57:33', '2025-11-11 06:41:42');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_slug_unique` (`slug`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_slug_unique` (`slug`),
  ADD KEY `companies_state_id_foreign` (`state_id`);

--
-- Indexes for table `company_category`
--
ALTER TABLE `company_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_category_company_id_category_id_unique` (`company_id`,`category_id`),
  ADD KEY `company_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `company_reviews`
--
ALTER TABLE `company_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_reviews_company_id_foreign` (`company_id`),
  ADD KEY `company_reviews_state_id_foreign` (`state_id`),
  ADD KEY `company_reviews_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_state_id_foreign` (`state_id`),
  ADD KEY `reviews_approved_by_foreign` (`approved_by`);

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
  ADD UNIQUE KEY `states_name_unique` (`name`),
  ADD UNIQUE KEY `states_code_unique` (`code`),
  ADD UNIQUE KEY `states_slug_unique` (`slug`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `company_category`
--
ALTER TABLE `company_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_reviews`
--
ALTER TABLE `company_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_category`
--
ALTER TABLE `company_category`
  ADD CONSTRAINT `company_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_category_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_reviews`
--
ALTER TABLE `company_reviews`
  ADD CONSTRAINT `company_reviews_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `company_reviews_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_reviews_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
