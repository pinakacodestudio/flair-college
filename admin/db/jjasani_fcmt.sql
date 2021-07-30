-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2021 at 03:03 AM
-- Server version: 5.7.35
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jjasani_fcmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dli_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `po_box` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`, `dli_number`, `address`, `po_box`, `street_no`, `street_name`, `city`, `province`, `postcode`, `phone`, `extension`, `fax`, `institution_type`, `website`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Flair College of Management and Technology', 'O19800346567', NULL, NULL, '7601', 'Jane Street', 'Concord', 'Ontario', 'L4K 1X2', '(905) 761-9733', NULL, NULL, 'private', 'www.fcmtcollege.com', 'international@fcmtcollege.com', 1, NULL, '2020-10-08 06:20:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `college_campus`
--

CREATE TABLE `college_campus` (
  `id` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `college_campus`
--

INSERT INTO `college_campus` (`id`, `college_id`, `staff_id`, `name`, `address`, `city`, `postcode`, `phone`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Campus 1', 'Jane Street - 7601', 'Concord', 'L4K 1X2', NULL, 1, '2021-03-03 00:01:39', '2021-03-03 00:01:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `college_staff`
--

CREATE TABLE `college_staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_filename` mediumtext COLLATE utf8mb4_unicode_ci,
  `extension` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `college_staff`
--

INSERT INTO `college_staff` (`id`, `college_id`, `first_name`, `last_name`, `mobile`, `position`, `signature_filename`, `extension`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Staff 1', 'Flair College', '(905) 761-9733', 'admission_counsellor', '1_signature.png', NULL, 1, '2021-03-02 23:41:55', '2021-03-02 23:53:25', NULL),
(2, 1, 'Staff 2', 'Flair College', '(905) 761-9733', 'admission_officer', NULL, NULL, 1, '2021-03-02 23:46:32', '2021-03-02 23:51:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intakes`
--

CREATE TABLE `intakes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intakes`
--

INSERT INTO `intakes` (`id`, `name`, `start_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'July', '2021-07-01', 1, '2020-09-23 23:21:51', '2021-01-24 22:46:12', NULL),
(2, 'June', '2021-06-01', 1, '2020-09-23 23:22:09', '2021-01-24 22:46:23', NULL),
(3, 'November', '2021-11-16', 1, '2020-09-23 23:22:26', '2021-01-24 22:46:32', NULL),
(4, 'October', '2021-10-12', 1, '2020-09-23 23:22:43', '2021-01-24 22:46:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_of_study` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_program` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_program_other` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours_per_week` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_duration_weeks` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_duration_years` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fees` double DEFAULT NULL,
  `intake_ids` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `level_of_study`, `type_of_program`, `type_of_program_other`, `academic_status`, `hours_per_week`, `program_duration_weeks`, `program_duration_years`, `total_fees`, `intake_ids`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Chef De Cuisine', 'certificate_program', 'vocational', '', 'full_time', '20', '50', '1', 17930, '1,2,3,4', 1, '2020-09-23 23:25:33', '2021-07-29 22:27:25', NULL),
(2, 'Culinary and Hospitality Operations Management', 'post_secondary_diploma', 'vocational', '', 'full_time', '20', '84', '2', 23480, '3', 1, '2020-09-23 23:26:06', '2020-09-23 23:26:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_applications`
--

CREATE TABLE `students_applications` (
  `id` int(10) UNSIGNED NOT NULL,
  `application_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_of_citizenship` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` text COLLATE utf8mb4_unicode_ci,
  `home_postcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_address` text COLLATE utf8mb4_unicode_ci,
  `secondary_postcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_province` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_agent` tinyint(4) NOT NULL DEFAULT '0',
  `agent_id` int(11) NOT NULL DEFAULT '0',
  `agent_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_qualification_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_qualification_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_english_first_language` tinyint(4) NOT NULL DEFAULT '1',
  `is_english_test_given` tinyint(4) NOT NULL DEFAULT '0',
  `english_test_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `english_test_score` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `english_test_date` date DEFAULT NULL,
  `programs_ids` text COLLATE utf8mb4_unicode_ci,
  `intake_ids` text COLLATE utf8mb4_unicode_ci,
  `admission_status` tinyint(4) NOT NULL DEFAULT '0',
  `profile_status` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_applications`
--

INSERT INTO `students_applications` (`id`, `application_no`, `updated_user_id`, `first_name`, `last_name`, `middle_name`, `gender`, `dob`, `email`, `passport_number`, `country_of_citizenship`, `home_address`, `home_postcode`, `home_country`, `home_phone`, `secondary_address`, `secondary_postcode`, `secondary_city`, `secondary_province`, `secondary_phone`, `is_agent`, `agent_id`, `agent_email`, `agent_name`, `academic_qualification_name`, `academic_qualification_year`, `is_english_first_language`, `is_english_test_given`, `english_test_name`, `english_test_score`, `english_test_date`, `programs_ids`, `intake_ids`, `admission_status`, `profile_status`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '100001', 1, 'Jasmin', 'Jasani', 'K', 'male', '1987-08-09', 'jasanijasmink@gmail.com', '12345678', 'India', '106, Alay Flats, Opp. Backbone App,', '360005', 'India', '9979936669', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'Ajay', 'MCA', '2011', 0, 1, 'IELTS', '8', '2020-09-01', '1', '3,4', 4, 0, 1, '2020-09-23 23:28:46', '2020-10-21 01:47:14', NULL),
(2, '100002', 4, 'abc', 'xyz', 'd', 'male', '2001-11-05', 'abc@email.com', 'E1234D45', 'India', '6 Sitaram Soc,', '360001', 'India', '12345566', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'NetWorth Immigraiton', 'Higher Secondary School', '2018', 1, 1, 'IELTS', '7', '2020-05-13', '2', '3', 3, 0, 1, '2020-10-01 01:10:15', '2021-07-29 23:32:51', NULL),
(3, '100003', NULL, 'Khushi', 'Sharma', NULL, 'female', '1996-08-07', 'khushi@gmail.com', 'M090901', 'India', '7601', 'L4K1X2', 'Canada', '9052619733', '7601', 'L4K1X2', 'Concord', 'Ontario', '9052619733', 1, 0, NULL, 'xyz', 'High School', '2012', 1, 1, 'IELTS', '7', '2021-04-04', '1,2', '1,2,3,4', 2, 0, 1, '2021-04-19 21:33:26', '2021-04-30 00:40:15', NULL),
(4, '100004', NULL, 'Jasmin', 'Jasani', 'K', 'male', '1987-08-09', 'jasanijasmink@gmail.com', '213456789789', 'India', '106, ALAY FLATS, NEAR GANDHI SCHOOL', '360005', 'India', '9979936669', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 'Rajeshbhai', 'MCA', '2011', 1, 1, 'IELTS', '8', '2021-05-07', '1,2', '2', 4, 0, 1, '2021-05-07 21:43:51', '2021-05-07 21:49:30', NULL),
(5, '100005', NULL, 'Deepanshu', 'Sharma', 'Sharma', 'female', '2000-01-13', 'simrangrewal719@gmail.com', 'M789937893', 'India', 'H.No. 73, Basant Nagar', 'M9V1Z4', 'India', '456123789', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 'Geet', 'Graduation', '2016', 1, 1, NULL, NULL, NULL, '1', '4', 4, 0, 1, '2021-07-29 21:14:07', '2021-07-29 21:17:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_admissions`
--

CREATE TABLE `student_admissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `students_application_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `student_id_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` int(10) UNSIGNED NOT NULL,
  `intake_id` int(10) UNSIGNED NOT NULL,
  `first_year_fees` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_of_study` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_program` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours_per_week` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_program` tinyint(1) NOT NULL DEFAULT '0',
  `fees_prepaid` tinyint(4) NOT NULL DEFAULT '0',
  `is_scholarship` tinyint(4) NOT NULL DEFAULT '0',
  `scholarship` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_internship` tinyint(4) NOT NULL DEFAULT '0',
  `internship_length` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internship_work` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditions_of_acceptance` text COLLATE utf8mb4_unicode_ci,
  `start_at` date DEFAULT NULL,
  `completion_at` date DEFAULT NULL,
  `expiration_at` date DEFAULT NULL,
  `other_information` text COLLATE utf8mb4_unicode_ci,
  `signed_loa_filename` mediumtext COLLATE utf8mb4_unicode_ci,
  `staff1_id` int(11) DEFAULT NULL,
  `staff2_id` int(11) DEFAULT NULL,
  `college_campus_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_admissions`
--

INSERT INTO `student_admissions` (`id`, `students_application_id`, `user_id`, `student_id_number`, `program_id`, `intake_id`, `first_year_fees`, `level_of_study`, `type_of_program`, `academic_status`, `hours_per_week`, `exchange_program`, `fees_prepaid`, `is_scholarship`, `scholarship`, `is_internship`, `internship_length`, `internship_work`, `conditions_of_acceptance`, `start_at`, `completion_at`, `expiration_at`, `other_information`, `signed_loa_filename`, `staff1_id`, `staff2_id`, `college_campus_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '012010001', 1, 4, '17930', 'Certificate Program', 'Vocational', 'Full Time', '20', 0, 1, 0, NULL, 0, NULL, NULL, NULL, '2020-10-12', '2021-09-27', '2020-10-22', NULL, '100001_signed_loa.pdf', NULL, NULL, 0, 1, '2020-09-23 23:36:52', '2020-10-08 06:19:09', NULL),
(2, 2, 1, NULL, 2, 3, NULL, 'Post - Secondary Diploma', 'Vocational', 'Full Time', '20', 0, 0, 0, NULL, 0, NULL, NULL, NULL, '2020-11-16', '2022-06-27', NULL, NULL, '100002_signed_loa.pdf', NULL, NULL, 0, 1, '2021-01-24 00:38:41', '2021-07-29 23:32:27', NULL),
(3, 3, 1, NULL, 1, 4, NULL, 'Certificate Program', 'Vocational', 'Full Time', '20', 0, 0, 0, NULL, 0, NULL, NULL, NULL, '2021-10-12', '2022-09-27', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-30 00:40:15', '2021-04-30 00:40:15', NULL),
(4, 4, 1, '012110004', 1, 4, '17930', 'Certificate Program', 'Vocational', 'Full Time', '20', 0, 1, 0, NULL, 0, NULL, NULL, NULL, '2021-10-12', '2022-09-27', '2021-05-21', NULL, '100004_signed_loa.pdf', NULL, NULL, 1, 1, '2021-05-07 21:46:57', '2021-05-07 21:49:30', NULL),
(5, 5, 4, '012110005', 1, 4, '17930', 'Certificate Program', 'Vocational', 'Full Time', '20', 0, 1, 0, NULL, 0, NULL, NULL, NULL, '2021-10-12', '2022-09-27', '2021-08-12', NULL, '100005_signed_loa.pdf', NULL, NULL, 1, 1, '2021-07-29 21:16:24', '2021-07-29 21:17:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_payments`
--

CREATE TABLE `student_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_admission_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `payment_mode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_payments`
--

INSERT INTO `student_payments` (`id`, `student_admission_id`, `amount`, `payment_mode`, `reference_no`, `payment_at`, `status`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1000, 'Cheque', '123456', '2020-10-20 06:00:00', 1, 'note', '2020-10-20 02:49:43', '2020-10-20 02:49:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_payment_refunds`
--

CREATE TABLE `student_payment_refunds` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_admission_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `payment_mode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `is_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `login_enable` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invitation_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `first_name`, `last_name`, `mobile`, `email`, `user_type`, `password`, `gender`, `birth_date`, `address`, `city`, `country`, `college_id`, `is_super_admin`, `status`, `login_enable`, `remember_token`, `invitation_token`, `email_verified`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Admin', NULL, NULL, 'admin@FCMT.com', 'super_admin', '$2y$10$QgSnEjXTgPxBFt8h1IZjXeaUWNuvYTMvyYp8zfTxLgz/LUC2Da8YC', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 'A4pmHtPP23SWkh7bLS926TtcF9q6JrfBhj2eGn9jBqqruJUk1x5lGi0vnWT6', NULL, 0, '2020-09-08 22:00:52', '2020-09-08 22:00:52', NULL),
(2, NULL, 'sandip', 'dhakecha', '6478189266', 'sandipdhakecha@gmail.com', 'admin', NULL, 'male', NULL, '45', 'Brampton', 'Canada', 1, 0, 1, 1, NULL, '1045c16b416c9633affe656d7be26dea57e5bcb4f375fd5feb0c2467aea11b8a', 0, '2020-10-01 01:06:12', '2020-10-01 01:06:44', NULL),
(3, NULL, 'asdf', 'asdf', '09979936669', 'jasmin.jasani@rku.ac.in', 'agent', '$2y$10$UuFcuNrBSeGgS2nxSdzzo.AmcnbF1t8WXTB3hbSqB/tUsnV5w1bFK', 'male', NULL, '106, Alay Flats, Opp. Backbone App,', 'Rajkot', 'India', 1, 0, 0, 1, '2eEeZ47mNY9TpCYA50Eo5wWWZJrMvrTC7a19QiNuIfcEN6rhwKQPznkhI24T', NULL, 1, '2021-07-29 20:56:42', '2021-07-29 21:07:12', NULL),
(4, NULL, 'FCMT', 'Canada', '6475463268', 'international@fcmtcollege.com', 'agent', '$2y$10$OAz8gzHBOam8aVnxzuqMy.givLNzDtd4EtEFwW7Sm56oRHZ8NPHra', 'female', NULL, 'Unit 100, 164 Queen Street East', 'Brampton', 'Canada', 1, 0, 1, 1, 'vIO8Cx63Y1owXntJWEhlKnz3FZpQ8w0umJm8XKXhdw6loAgAu1kIpBmzs9TC', NULL, 1, '2021-07-29 21:04:00', '2021-07-29 23:31:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_campus`
--
ALTER TABLE `college_campus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `college_staff`
--
ALTER TABLE `college_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `intakes`
--
ALTER TABLE `intakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_applications`
--
ALTER TABLE `students_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_admissions`
--
ALTER TABLE `student_admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_application_id` (`students_application_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `intake_id` (`intake_id`);

--
-- Indexes for table `student_payments`
--
ALTER TABLE `student_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_admission_id` (`student_admission_id`);

--
-- Indexes for table `student_payment_refunds`
--
ALTER TABLE `student_payment_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_admission_id` (`student_admission_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `college_campus`
--
ALTER TABLE `college_campus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `college_staff`
--
ALTER TABLE `college_staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `intakes`
--
ALTER TABLE `intakes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_applications`
--
ALTER TABLE `students_applications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_admissions`
--
ALTER TABLE `student_admissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_payments`
--
ALTER TABLE `student_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_payment_refunds`
--
ALTER TABLE `student_payment_refunds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
