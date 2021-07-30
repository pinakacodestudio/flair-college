-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2020 at 07:57 PM
-- Server version: 10.2.3-MariaDB
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fcmt`
--

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
  `is_scholarship` tinyint(4) NOT NULL DEFAULT 0,
  `scholarship` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_internship` tinyint(4) NOT NULL DEFAULT 0,
  `internship_length` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internship_work` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditions_of_acceptance` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `completion_at` date DEFAULT NULL,
  `expiration_at` date DEFAULT NULL,
  `other_information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_admissions`
--
ALTER TABLE `student_admissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
