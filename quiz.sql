-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 01:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `board` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=>deactice,1=>active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`id`, `board`, `status`, `created_at`) VALUES
(19, 'CBSE', 0, '2020-02-04 09:33:16'),
(20, 'ICSE', 1, '2020-02-04 09:05:55'),
(21, 'UP Board', 1, '2020-02-04 09:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=>deactive.1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `class` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=>deactive,1=>active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `board_id`, `class`, `status`, `created_at`) VALUES
(7, 21, 'Class V', 0, '2020-02-05 10:25:39'),
(8, 20, 'Class Xv', 0, '2020-02-05 10:02:53'),
(10, 20, 'Class X', 1, '2020-02-05 10:39:13'),
(11, 21, 'Class XI', 1, '2020-02-05 10:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `job_roles`
--

CREATE TABLE `job_roles` (
  `id` int(10) NOT NULL,
  `sector_id` int(10) NOT NULL,
  `sector_name` varchar(255) NOT NULL,
  `job_role_name` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '0 => "Inactive" 1 => "Active" 2 => "Delete"',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_roles`
--

INSERT INTO `job_roles` (`id`, `sector_id`, `sector_name`, `job_role_name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(64, 1, 'New Course', 'New Subject', NULL, 1, '2019-07-09 12:57:28', '0000-00-00 00:00:00'),
(65, 2, 'B.tech', 'PHP', NULL, 1, '2019-08-24 15:22:18', '0000-00-00 00:00:00'),
(66, 3, 'Sector 1', 'test job role', NULL, 1, '2019-09-05 13:13:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `board_name` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `question` longtext NOT NULL,
  `option_a` longtext NOT NULL,
  `option_b` longtext NOT NULL,
  `option_c` longtext NOT NULL,
  `option_d` longtext NOT NULL,
  `answer_key` varchar(255) NOT NULL,
  `difficulty_level` varchar(255) NOT NULL,
  `time_slot` varchar(255) DEFAULT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `board_id`, `board_name`, `subject_id`, `subject_name`, `chapter_id`, `chapter_name`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer_key`, `difficulty_level`, `time_slot`, `hint`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 2, 'B.tech', 65, 'PHP', 2, 'Basic PHP', 'Which of the following PHP function will return true if a variable is an array or false if it is not an array?', 'this_array()', 'is_array()', ' do_array()', 'in_array()', 'B', '1', '1', ' The function is_array() is an inbuilt function in PHP which is used to check whether a variable is an array or not. Its prototype follows: boolean is_array(mixed variable).', 1, '2019-08-26 17:34:26', '0000-00-00 00:00:00'),
(6, 2, 'B.tech', 65, 'PHP', 2, 'Basic PHP', 'Which function returns an array consisting of associative key/value pairs?', 'count()', 'array_count()', 'array_count_values()', 'count_values()', 'C', '1', '1', 'The function array_count_values() will count all the values of an array. It will return an associative array, where the keys will be the original array’s values, and the values are the number of occurrences.', 1, '2019-08-26 17:34:26', '0000-00-00 00:00:00'),
(7, 2, 'B.tech', 65, 'PHP', 2, 'Basic PHP', ' How many functions does PHP offer for searching and modifying strings using Perl-compatible regular expressions.', '7', '8', '9', '10', 'B', '1', '1', 'The functions are preg_filter(), preg_grep(), preg_match(), preg_match_all(), preg_quote(), preg_replace(), preg_replace_callback(), and preg_split().', 1, '2019-08-26 17:34:26', '0000-00-00 00:00:00'),
(8, 2, 'B.tech', 65, 'PHP', 2, 'Basic PHP', ' Which one of the following functions will convert a string to all uppercase?', 'strtoupper()', ' uppercase()', 'str_uppercase()', 'struppercase()', 'A', '1', '1', 'Its prototype follows string\nstrtoupper(string str).', 1, '2019-08-26 17:34:26', '0000-00-00 00:00:00'),
(9, 2, 'B.tech', 65, 'PHP', 2, 'Basic PHP', 'Which one of the following lines need to be uncommented or added in the php.ini file so as to enable mysqli extension?  ', ' extension=php_mysqli.dll ', 'extension=mysql.dll ', 'extension=php_mysqli.dl', ' extension=mysqli.dl ', 'A', '1', '1', 'Also make sure that extension_dir directive points to the appropriate directory.', 1, '2019-08-26 17:34:26', '0000-00-00 00:00:00'),
(10, 2, 'B.tech', 65, 'PHP', 2, 'Basic PHP', 'Which one of the following statements is used to create a table?', 'CREATE TABLE table_name (column_name column_type); ', 'CREATE table_name (column_type column_name); ', 'CREATE table_name (column_name column_type); ', 'CREATE TABLE table_name (column_type column_name); ', 'A', '1', '1', NULL, 1, '2019-08-26 17:34:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quizs`
--

CREATE TABLE `quizs` (
  `id` int(10) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quiz_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_of_questions` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempt_count` int(11) NOT NULL DEFAULT 0,
  `quiz_duration` time NOT NULL,
  `is_active` int(11) DEFAULT 1 COMMENT '0 => "Deactive" 1 => "Active" 2 => "Deleted"',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quizs`
--

INSERT INTO `quizs` (`id`, `course_id`, `course_name`, `subject_id`, `subject_name`, `quiz_name`, `number_of_questions`, `description`, `attempt_count`, `quiz_duration`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'New Course', 64, 'New Subject', 'Test Quiz', 10, NULL, 0, '00:20:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'B.tech', 65, 'PHP', 'Test', 10, 'This is test Quiz', 1, '00:00:05', 1, '2019-08-24 15:27:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_allocated`
--

CREATE TABLE `quiz_allocated` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `allocated_to_id` int(11) NOT NULL,
  `allocated_to_name` varchar(255) NOT NULL,
  `is_submitted` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `allocated_by` int(11) NOT NULL,
  `allocated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_allocated`
--

INSERT INTO `quiz_allocated` (`id`, `quiz_id`, `quiz_name`, `allocated_to_id`, `allocated_to_name`, `is_submitted`, `is_active`, `allocated_by`, `allocated_at`) VALUES
(1, 1, 'Test Quiz', 1, 'Admin', 0, 1, 1, '2019-07-17 18:06:00'),
(2, 1, 'Test Quiz', 4, 'Kishan', 0, 1, 4, '2019-08-24 15:10:36'),
(3, 1, 'Test Quiz', 3, 'Raghavendra', 0, 1, 1, '2019-09-05 12:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `option_a` longtext NOT NULL,
  `option_b` longtext NOT NULL,
  `option_c` longtext NOT NULL,
  `option_d` longtext NOT NULL,
  `answer_key` varchar(255) NOT NULL,
  `question_hint` text DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '0 => "Deactive" 1 => "Active" 2 => "Deleted"',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `topic_id`, `topic_name`, `question_number`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer_key`, `question_hint`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'New Topic', 1, 'What is my full name?', 'Amit Chaurasiya', 'Amit Kumar Chaurasiya', 'Amit', 'Amit Kumar', 'A', '', 1, '2019-07-15 16:44:11', '0000-00-00 00:00:00'),
(2, 1, 1, 'New Topic', 2, 'What is Raghvendra\'s full name?', 'Raghvendra Singh', 'Raghvendra Pratap Singh', 'Raghvendra Pratap', 'Raghvendra Pratap Singh Prabhakar', 'B', '', 1, '2019-07-15 16:44:11', '0000-00-00 00:00:00'),
(3, 1, 1, 'New Topic', 3, 'What is Ajay\'s full name?', 'Ajay Kumar Verma', 'Ajay Verma', 'Ajay Kumar', 'Ajay Singh Verma', 'C', '', 1, '2019-07-16 17:26:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submitted`
--

CREATE TABLE `quiz_submitted` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `number_of_questions` int(11) NOT NULL,
  `submitted_by` int(11) NOT NULL,
  `submitted_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_submitted`
--

INSERT INTO `quiz_submitted` (`id`, `course_id`, `course_name`, `subject_id`, `subject_name`, `quiz_id`, `quiz_name`, `number_of_questions`, `submitted_by`, `submitted_at`) VALUES
(1, 1, 'New Course', 64, 'New Subject', 1, 'Test Quiz', 3, 1, '2019-07-17 14:32:49'),
(2, 1, 'New Course', 64, 'New Subject', 1, 'Test Quiz', 3, 1, '2019-08-09 11:37:57'),
(3, 1, 'New Course', 64, 'New Subject', 1, 'Test Quiz', 3, 1, '2019-08-10 12:44:45'),
(4, 1, 'New Course', 64, 'New Subject', 1, 'Test Quiz', 3, 1, '2019-08-24 15:09:08'),
(5, 1, 'New Course', 64, 'New Subject', 1, 'Test Quiz', 3, 4, '2019-08-24 15:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submitted_answers`
--

CREATE TABLE `quiz_submitted_answers` (
  `id` int(11) NOT NULL,
  `quiz_submitted_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `is_attempted` int(11) NOT NULL DEFAULT 0,
  `question` longtext NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `correct_option` varchar(255) NOT NULL,
  `question_result` varchar(255) DEFAULT NULL,
  `submitted_by` int(11) NOT NULL,
  `submitted_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_submitted_answers`
--

INSERT INTO `quiz_submitted_answers` (`id`, `quiz_submitted_id`, `quiz_id`, `question_number`, `is_attempted`, `question`, `option_selected`, `correct_option`, `question_result`, `submitted_by`, `submitted_at`) VALUES
(1, 1, 1, 1, 1, 'What is my full name?', 'C', 'A', 'Incorrect', 1, '2019-07-17 14:32:49'),
(2, 1, 1, 2, 1, 'What is Raghvendra\'s full name?', 'A', 'B', 'Incorrect', 1, '2019-07-17 14:32:49'),
(3, 1, 1, 3, 1, 'What is Ajay\'s full name?', 'C', 'C', 'Correct', 1, '2019-07-17 14:32:49'),
(4, 2, 1, 1, 0, 'What is my full name?', NULL, 'A', NULL, 1, '2019-08-09 11:37:57'),
(5, 2, 1, 2, 0, 'What is Raghvendra\'s full name?', NULL, 'B', NULL, 1, '2019-08-09 11:37:57'),
(6, 2, 1, 3, 1, 'What is Ajay\'s full name?', 'B', 'C', 'Incorrect', 1, '2019-08-09 11:37:57'),
(7, 3, 1, 1, 1, 'What is my full name?', 'B', 'A', 'Incorrect', 1, '2019-08-10 12:44:45'),
(8, 3, 1, 2, 1, 'What is Raghvendra\'s full name?', 'C', 'B', 'Incorrect', 1, '2019-08-10 12:44:45'),
(9, 3, 1, 3, 0, 'What is Ajay\'s full name?', NULL, 'C', NULL, 1, '2019-08-10 12:44:45'),
(10, 4, 1, 1, 1, 'What is my full name?', 'A', 'A', 'Correct', 1, '2019-08-24 15:09:08'),
(11, 4, 1, 2, 1, 'What is Raghvendra\'s full name?', 'B', 'B', 'Correct', 1, '2019-08-24 15:09:08'),
(12, 4, 1, 3, 1, 'What is Ajay\'s full name?', 'C', 'C', 'Correct', 1, '2019-08-24 15:09:08'),
(13, 5, 1, 1, 1, 'What is my full name?', 'A', 'A', 'Correct', 4, '2019-08-24 15:10:53'),
(14, 5, 1, 2, 1, 'What is Raghvendra\'s full name?', 'B', 'B', 'Correct', 4, '2019-08-24 15:10:53'),
(15, 5, 1, 3, 1, 'What is Ajay\'s full name?', 'C', 'C', 'Correct', 4, '2019-08-24 15:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `sector_name` varchar(255) DEFAULT NULL,
  `job_role_id` int(11) NOT NULL,
  `job_role_name` varchar(255) DEFAULT NULL,
  `section_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '0 => "Inactive" 1 => "Active" 2 => "Delete"	',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `sector_id`, `sector_name`, `job_role_id`, `job_role_name`, `section_name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'New Course', 64, 'New Subject', 'New Topic', NULL, 1, '2019-07-09 14:27:11', '0000-00-00 00:00:00'),
(2, 2, 'B.tech', 65, 'PHP', 'Basic PHP', NULL, 1, '2019-08-24 15:22:53', '0000-00-00 00:00:00'),
(3, 1, 'New Course', 64, 'New Subject', 'vasdfgv', NULL, 1, '2019-09-05 13:24:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(10) NOT NULL,
  `sector_name` varchar(255) NOT NULL,
  `is_expired` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `sector_name`, `is_expired`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'New Course', 0, 1, '2019-07-08 14:58:05', '0000-00-00 00:00:00'),
(2, 'B.tech', 0, 1, '2019-08-24 15:21:45', '0000-00-00 00:00:00'),
(3, 'Sector 1', 0, 1, '2019-09-05 13:09:33', '0000-00-00 00:00:00'),
(4, 'M.tech', 0, 1, '2020-02-03 11:20:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `section_id` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `class_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `student_name` varchar(252) COLLATE utf8_unicode_ci NOT NULL,
  `student_school_name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `student_image` varchar(252) COLLATE utf8_unicode_ci NOT NULL,
  `student_dob` date NOT NULL,
  `student_gender` varchar(121) COLLATE utf8_unicode_ci NOT NULL,
  `student_corres_addresss` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `student_corres_landmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_corres_city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_corres_state` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_corres_country` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_corres_pincode` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_phone` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_mobile` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_emailId` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_permanent_address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `student_permanent_landmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_permanent_city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_permanent_state` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_permanent_country` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_permanent_pincode` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_father_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_father_occupation` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_father_org` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_father_org_address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_father_office_con` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_father_mobile` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_father_designation` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_father_earning` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_occupation` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_org` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_org_address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_office_con` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_mobile` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_designation` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_mother_earning` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stu_proofId_provided` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stu_proofId_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stu_proofId_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stu_other_details` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `ten_dight_crm_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=>deactive,1=>active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `board_id`, `class_id`, `subject`, `status`, `created_at`) VALUES
(5, 20, 2, 'Physics', 1, '2020-02-05 04:55:20'),
(6, 21, 3, 'Chemistry', 1, '2020-02-05 05:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_quiz_pools`
--

CREATE TABLE `tbl_class_quiz_pools` (
  `id` int(11) NOT NULL,
  `quizpool` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` varchar(112) COLLATE utf8_unicode_ci NOT NULL,
  `date_start` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `date_end` varchar(112) COLLATE utf8_unicode_ci NOT NULL,
  `validate_date` varchar(112) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_class_quiz_pools`
--

INSERT INTO `tbl_class_quiz_pools` (`id`, `quizpool`, `student_id`, `date_start`, `date_end`, `validate_date`, `timestamp`) VALUES
(46, '58', '61', '', '', '', '2014-12-26 17:18:15'),
(45, '58', '41', '', '', '', '2014-12-26 17:18:15'),
(44, '54', '51', '', '', '', '2014-04-24 14:43:53'),
(43, '57', '30', '', '', '', '2013-09-25 13:34:14'),
(42, '57', '29', '', '', '', '2013-09-25 13:34:14'),
(41, '57', '28', '', '', '', '2013-09-25 13:34:14'),
(25, '55', '31', '', '', '', '2013-08-24 15:36:04'),
(26, '55', '32', '', '', '', '2013-08-24 15:36:04'),
(27, '55', '33', '', '', '', '2013-08-24 15:36:04'),
(28, '55', '34', '', '', '', '2013-08-24 15:36:04'),
(29, '55', '35', '', '', '', '2013-08-24 15:36:04'),
(30, '55', '36', '', '', '', '2013-08-24 15:36:04'),
(31, '55', '37', '', '', '', '2013-08-24 15:36:04'),
(32, '55', '38', '', '', '', '2013-08-24 15:36:04'),
(33, '55', '39', '', '', '', '2013-08-24 15:36:04'),
(34, '55', '40', '', '', '', '2013-08-24 15:36:04'),
(40, '57', '27', '', '', '', '2013-09-25 13:34:14'),
(47, '74', '63', '', '', '', '2015-08-14 11:45:11'),
(48, '75', '63', '', '', '', '2015-08-14 12:37:16'),
(49, '75', '41', '', '', '', '2015-09-04 14:11:30'),
(50, '75', '61', '', '', '', '2015-09-04 14:11:30'),
(51, '75', '62', '', '', '', '2015-09-04 14:11:30'),
(52, '76', '41', '', '', '', '2015-09-14 14:57:10'),
(53, '76', '61', '', '', '', '2015-09-14 14:57:10'),
(54, '76', '62', '', '', '', '2015-09-14 14:57:10'),
(55, '75', '68', '', '', '', '2015-11-20 15:26:08'),
(56, '75', '69', '', '', '', '2015-11-20 16:28:35'),
(57, '75', '70', '', '', '', '2015-11-20 16:28:35'),
(58, '75', '71', '', '', '', '2015-11-20 16:28:35'),
(59, '53', '69', '', '', '', '2015-11-20 16:30:14'),
(60, '53', '70', '', '', '', '2015-11-20 16:30:14'),
(61, '53', '71', '', '', '', '2015-11-20 16:30:14'),
(62, '56', '69', '', '', '', '2015-11-20 17:04:34'),
(63, '56', '70', '', '', '', '2015-11-20 17:04:34'),
(64, '56', '71', '', '', '', '2015-11-20 17:04:34'),
(65, '77', '69', '', '', '', '2015-11-20 18:15:20'),
(66, '77', '70', '', '', '', '2015-11-20 18:15:20'),
(67, '77', '71', '', '', '', '2015-11-20 18:15:20'),
(68, '78', '69', '', '', '', '2015-11-20 18:24:21'),
(69, '78', '70', '', '', '', '2015-11-20 18:24:21'),
(70, '78', '71', '', '', '', '2015-11-20 18:24:21'),
(71, '79', '69', '', '', '', '2015-11-21 09:52:10'),
(72, '79', '70', '', '', '', '2015-11-21 09:52:11'),
(73, '79', '71', '', '', '', '2015-11-21 09:52:11'),
(74, '19', '69', '', '', '', '2017-03-17 13:46:57'),
(75, '19', '70', '', '', '', '2017-03-17 13:46:57'),
(76, '19', '71', '', '', '', '2017-03-17 13:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_generator`
--

CREATE TABLE `tbl_quiz_generator` (
  `id` int(11) NOT NULL,
  `quiz_pool_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `questions_array` longtext COLLATE utf8_unicode_ci NOT NULL,
  `answer_array` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_pool`
--

CREATE TABLE `tbl_quiz_pool` (
  `id` int(11) NOT NULL,
  `quiz_pool_name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `quiz_pool_description` text COLLATE utf8_unicode_ci NOT NULL,
  `class_id` varchar(112) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `status` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `showatfront` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `answers` longtext COLLATE utf8_unicode_ci NOT NULL,
  `questions` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_quiz_pool`
--

INSERT INTO `tbl_quiz_pool` (`id`, `quiz_pool_name`, `quiz_pool_description`, `class_id`, `created_date`, `status`, `showatfront`, `answers`, `questions`, `timestamp`) VALUES
(19, 'Quiz1', '<p>Quiz1</p>', '1', '2013-06-24', 'active', 'OFF', '---c---a---d---d---c---c---b---a---c---b---c---a---a---c---a---a---', '---11---315---336---358---371---212---831---2045---2650---2753---3391---3564---3693---3891---8007---8518---', '2013-06-24 18:59:13'),
(47, 'Absolute Study Quiz Round 1', '<p>18457</p>', '3', '2013-07-25', 'active', '', '---b---c---a---a---b---c---d---d---a---c---b---a---b---b---c---c---b---d---d---c---a---a---a---d---c---d---d---b---b---b---b---a---d---b---c---c---a---a---b---b---a---c---b---a---d---a---b---a---b---a---c---c---c---a---c---c---b---a---d---a---a---c---c---d---c---b---a---a---d---b---a---d---c---a---d---c---b---d---d---b---c---a---c---b---b---d---c---a---c---b---b---a---d---c---c---a---a---d---a---c---', '---1837---1838---1839---1845---1848---1854---1859---1860---1871---1872---1982---1986---1991---1996---1998---2000---2005---2006---2014---2015---2017---2020---2022---2023---2024---2025---2027---2031---2038---2039---7179---7227---7248---7251---7265---7279---7290---7295---7301---7305---7314---7330---7336---7346---7349---7358---7359---7361---7379---7381---7383---7385---7400---7411---7427---7442---7449---7451---7453---7455---7463---7465---7469---7481---7483---7484---7487---7489---7494---7497---10484---10485---10495---10501---10504---10518---10541---10543---10552---10556---10558---10584---10586---10590---10600---10602---10608---10627---10635---10661---10677---10707---10731---10742---10744---10770---10779---10782---10784---10796---', '2013-07-25 16:37:57'),
(48, 'Absolute Study Quiz Round 1', '<p>18458</p>', '4', '2013-07-25', 'active', '', '---c---d---b---c---c---c---b---c---c---a---b---c---a---a---b---c---d---b---c---b---a---c---a---a---b---c---c---c---a---b---a---c---a---d---a---c---b---c---d---a---a---d---b---a---c---a---a---a---c---c---c---d---a---c---c---c---b---a---a---a---b---a---a---c---a---a---b---d---a---c---d---a---b---a---d---b---d---b---a---a---b---d---a---b---c---a---d---b---a---a---c---a---a---c---c---c---a---c---a---d---', '---4002---4003---4005---4008---4024---4026---4027---4030---4035---4045---4050---4053---4054---4067---4069---4077---4078---4079---4100---4104---4120---4127---4129---4135---4136---4137---4141---4147---4149---4164---4180---4181---4193---4197---4198---4200---4204---4212---4213---4222---4225---4230---4236---4247---4251---4252---4262---4264---4267---4268---4273---4285---4294---4297---4301---4314---4324---4325---4331---4336---4340---4348---4349---4360---4361---4362---4364---4373---4376---4377---4378---4383---4388---4395---4396---4400---4402---4403---4406---4408---4414---4416---4420---4425---4432---4434---4435---4437---4440---4441---4446---4450---4452---4453---4455---4458---4459---4462---4466---4484---', '2013-07-25 16:40:20'),
(49, 'Absolute Study Quiz Round 1', '<p>18459</p>', '6', '2013-07-25', 'active', '', '---c---c---b---d---d---b---d---c---a---c---b---c---a---a---d---a---b---b---b---a---a---a---b---a---d---c---a---b---a---b---d---c---c---a---b---d---d---a---a---a---d---b---d---c---d---c---c---a---d---a---a---c---c---c---d---b---a---a---a---c---d---c---b---a---d---b---c---b---a---d---c---a---a---b---b---b---a---c---b---c---b---b---c---d---b---b---c---a---c---b---b---a---a---c---a---a---b---c---c---c---', '---7499---7517---7520---7547---7558---7562---7564---7569---7575---7578---7582---7586---7588---7590---7606---7638---7642---7665---7677---7681---7689---7690---7697---7700---7712---7722---7731---7734---7752---7753---9070---9081---9091---9094---9101---9103---9106---9110---9116---9124---9150---9154---9158---9176---9181---9207---9210---9235---9265---9281---9309---9312---9314---9317---9321---9332---9338---9341---9344---9347---9372---9384---9398---9406---9410---9447---9489---9586---9603---9606---9772---9773---9797---9806---9810---9829---9830---9843---9862---9902---9914---9930---9975---9966---9968---10082---10105---10107---10124---10125---10140---10187---10208---10213---10235---10237---10262---10298---10307---10311---', '2013-07-25 16:44:00'),
(50, 'Absolute Study Quiz Round 1', '<p>184510</p>', '2', '2013-07-25', 'active', '', '---d---a---c---c---c---b---c---c---c---c---c---b---c---a---d---c---b---d---a---c---d---b---b---a---d---b---a---c---a---a---c---a---b---b---a---b---b---b---c---a---a---d---d---d---d---c---a---a---c---c---c---b---c---b---b---b---d---b---d---b---b---a---a---d---d---b---a---d---d---c---d---a---b---a---c---b---b---b---c---c---d---b---d---a---c---c---d---b---a---d---', '---33---53---58---64---65---70---71---76---81---90---93---96---100---104---105---106---115---119---134---137---139---152---157---168---180---181---185---744---733---210---393---398---407---415---439---469---474---481---484---488---496---502---529---538---541---545---547---552---557---560---571---574---589---592---603---608---620---628---631---647---8895---8902---8904---8907---9043---9048---9060---9072---9100---9254---9345---9351---9356---9390---9393---9423---9441---9481---9520---9524---9544---9551---9556---9558---9652---9687---9744---9747---9750---9841---', '2013-07-25 16:48:03'),
(51, 'Absolute Study Quiz Round 1', '<p>185411</p>', '1', '2013-07-25', 'active', 'ON', '---a---a---b---d---b---a---d---d---b---c---b---c---a---c---b---d---d---a---c---b---d---d---b---a---a---c---c---d---b---a---a---b---a---b---d---d---a---a---c---b---b---c---c---b---d---a---d---d---c---a---d---a---b---c---c---b---d---a---d---b---c---c---c---d---a---b---b---a---a---b---c---a---b---d---c---a---a---a---c---c---b---c---b---a---c---c---a---a---c---c---a---b---b---c---d---a---c---c---c---d---', '---16---19---20---309---313---317---318---320---325---331---339---340---341---347---348---358---361---362---366---369---375---382---383---384---385---212---213---214---215---216---217---219---220---221---224---226---228---229---230---234---236---241---242---244---245---246---247---249---255---256---257---259---260---261---264---265---267---268---273---272---270---276---277---278---280---285---287---289---292---293---294---295---296---297---298---8518---8524---8526---8529---8530---8590---8593---8597---8598---8602---8610---8615---8636---8650---8654---8660---8662---8670---8671---8681---8683---8687---8688---8689---8705---', '2013-07-25 16:51:47'),
(52, 'Absolute Study Quiz Round 1', '<p>184511B</p>', '1', '2013-07-25', 'active', 'ON', '---a---c---b---d---b---c---a---b---a---a---d---a---d---a---c---d---d---c---c---d---b---b---b---d---a---c---b---b---b---b---c---d---c---a---a---b---b---d---a---a---a---c---c---b---b---d---c---b---a---b---c---b---b---c---c---b---b---a---d---c---c---b---a---b---c---a---d---b---c---a---c---b---a---d---c---a---b---c---c---a---c---a---c---b---a---c---b---a---b---b---a---a---d---c---c---c---a---d---a---b---', '---14---15---20---307---313---316---317---325---332---333---338---341---342---351---354---358---361---363---366---370---374---376---379---382---384---8011---8017---8018---8021---8023---8026---8029---8032---8038---8043---8045---8048---8058---8060---8062---8068---8078---8080---8090---8093---8098---8103---8105---8107---8110---8112---8116---8121---8122---8124---8126---8129---8130---8131---8134---8139---8140---8141---8143---8144---8147---8154---8159---8162---8163---8168---8171---8172---8175---8180---8518---8528---8571---8588---8598---8604---8607---8609---8612---8613---8614---8619---8623---8628---8631---8632---8660---8661---8663---8671---8677---8678---8679---8683---8703---', '2013-07-25 16:54:14'),
(53, 'Absolute Study Quiz Round 1', '<p>184512M</p>', '7', '2013-07-25', 'active', 'OFF', '---c---c---d---a---d---a---b---c---c---d---a---b---c---b---b---c---c---d---b---b---c---b---a---a---c---d---a---c---d---b---b---c---a---c---d---a---a---b---d---b---c---d---a---b---a---c---a---a---d---b---c---d---d---b---c---a---a---b---c---a---a---b---c---a---a---d---b---b---b---c---b---b---c---b---d---b---b---c---b---a---c---a---c---a---a---a---c---a---a---d---', '---9876---9890---9896---9935---9946---9997---10006---10010---10013---10023---10030---10044---10069---10152---10159---10166---10168---10169---10227---10280---10326---10328---10332---10337---10338---10349---10353---10365---10368---10389---10405---10410---10424---10434---10435---10436---10446---10454---10459---10468---10551---10583---10652---10715---10741---10857---10862---10876---10986---10998---11038---11039---11060---11062---11063---11081---11089---11092---11170---11175---11185---11193---11275---11316---11318---11009---11012---11027---11028---11068---10814---10824---10827---10843---10845---10869---10881---10964---10994---11079---11516---11552---11607---11639---11659---11696---11710---11753---11765---11830---', '2013-07-25 16:55:51'),
(54, 'Absolute Study Quiz Round 1', '<p>184512B</p>', '7', '2013-07-25', 'active', 'OFF', '---b---b---a---d---a---b---a---b---b---d---b---a---d---d---c---b---a---b---a---d---d---a---a---a---b---a---b---c---a---d---b---a---b---c---d---c---b---c---b---a---a---d---b---a---b---c---a---d---b---b---a---a---c---c---d---a---a---a---c---b---a---a---c---c---a---a---a---b---a---d---d---d---b---b---a---d---d---b---c---b---c---d---b---b---d---b---d---a---d---c---', '---7927---7928---7931---7933---7934---7937---7938---7939---7941---7942---7947---7948---7950---7953---7956---7960---7962---7963---7964---7965---7968---7969---7971---7975---7976---7978---7979---7983---7985---7986---7987---7988---7989---7990---7991---7992---7993---7994---7995---7996---7997---7998---7999---8000---8001---8002---8003---8004---8005---8006---9853---9885---9903---9916---9954---9976---9977---9997---10013---10044---10056---10083---10122---10151---10162---10183---10232---10239---10244---10282---10324---10327---10328---10330---10342---10343---10354---10371---10374---10389---10398---10415---10417---10433---10435---10450---10452---10458---10467---10469---', '2013-07-25 16:57:23'),
(45, 'Absolute Study Quiz Class 6th', '<p>18456</p>', '5', '2013-07-25', 'active', '', '---a---b---a---a---d---b---c---b---c---c---b---a---a---a---a---b---a---a---c---a---a---b---d---c---b---d---a---a---a---d---d---d---a---d---b---a---b---c---a---d---a---b---c---b---a---b---b---c---a---d---b---d---a---b---a---d---d---c---b---d---b---d---c---a---a---b---a---c---b---b---d---d---b---c---d---c---d---a---a---b---a---a---b---c---b---b---c---c---a---a---b---a---c---a---c---a---b---b---d---c---', '---5721---5843---5844---5852---5865---5869---5885---5940---5957---5968---6024---6059---6072---6088---6095---6108---6118---6124---6134---6173---6197---6295---6369---6370---6398---6399---6405---6420---6429---6461---6480---6498---6513---6521---6534---6542---6543---6562---6564---6568---6583---6593---6606---6651---6652---6668---6682---6692---6696---6697---6704---6714---6716---6720---6730---6732---6739---6747---6758---6774---6778---6780---6832---6835---6849---6855---6858---6859---6874---6884---8182---8187---8196---8198---8200---8201---8205---8207---8208---8209---8211---8212---8213---8216---8218---8223---8224---8225---8226---8229---8230---8231---8235---8236---8241---8244---8246---8248---8250---8252---', '2013-07-25 15:30:28'),
(55, 'Class 7th Quiz', '<p>Round 1</p>\r\n<p>1225NMS1</p>', '5', '2013-08-16', 'active', '', '---b---d---a---b---d---b---d---d---b---a---a---c---c---b---a---b---a---a---a---a---a---a---c---a---a---c---b---d---b---a---b---a---b---d---b---c---c---b---a---a---d---a---d---c---d---d---b---b---b---c---d---c---c---d---b---d---d---b---a---a---b---a---d---c---c---a---b---a---a---c---d---a---c---b---c---c---a---c---d---a---b---b---b---b---b---c---a---a---a---c---a---c---c---c---c---a---c---a---d---c---', '---5674---5679---5711---5725---5732---5776---5824---5833---5843---5855---5862---5885---5964---5998---6010---6045---6067---6138---6153---6184---6189---6209---6262---6319---6350---6365---6398---6399---6408---6429---6468---6472---6478---6480---6482---6484---6525---6540---6580---6583---6587---6608---6629---6645---6654---6663---6668---6679---6682---6686---6697---6701---6708---6714---6717---6726---6739---6744---6755---6772---6776---6806---6811---6818---6832---6849---6856---6858---6877---6886---8188---8191---8192---8193---8194---8198---8199---8201---8203---8204---8206---8209---8210---8217---8223---8225---8226---8229---8231---8232---8236---8238---8240---8241---8242---8247---8252---8255---8257---8258---', '2013-08-17 10:13:02'),
(56, 'Class 8th Quiz', '<p>Round 1</p>\r\n<p>1225NMS82</p>', '4', '2013-08-16', 'active', '', '---b---b---a---b---c---c---b---a---a---c---b---a---b---c---c---b---c---a---a---a---c---c---a---b---d---a---a---a---b---b---d---b---a---c---c---b---a---b---a---c---d---a---d---c---b---a---a---d---c---d---c---c---a---d---b---a---c---b---c---b---a---a---d---c---c---d---a---a---a---c---b---d---b---b---b---c---a---d---a---a---a---a---a---b---b---d---c---b---c---d---a---a---c---d---a---d---d---a---b---a---', '---4004---4005---4012---4027---4034---4043---4046---4052---4055---4059---4069---4072---4079---4083---4099---4109---4113---4126---4131---4133---4138---4147---4154---4156---4177---4180---4191---4198---4204---4208---4213---4221---4224---4232---4237---4243---4252---4255---4276---4277---4278---4286---4291---4297---4304---4305---4308---4312---4316---4337---4351---4357---4361---4363---4375---4376---4377---4379---4380---4382---4389---4392---4396---4397---4398---4402---4406---4407---4408---4411---4412---4416---4421---4423---4424---4426---4427---4428---4440---4441---4448---4452---4470---4473---4475---4477---4480---4483---4485---4489---4496---4512---4709---4726---4903---7222---7250---7339---7365---7402---', '2013-08-17 10:15:28'),
(57, 'Class 8th Quiz', '<p>Round 1</p>\r\n<p>1255NMS28</p>', '3', '2013-08-16', 'active', '', '---b---a---b---b---b---d---b---d---d---c---c---b---b---b---d---b---b---c---d---c---c---d---c---b---d---a---a---d---d---c---b---b---d---a---a---b---a---c---a---b---a---b---c---a---b---a---c---c---c---a---c---a---b---c---c---a---d---a---a---b---b---a---d---b---c---d---a---a---d---a---b---a---a---d---b---a---c---b---a---c---c---a---c---c---c---b---d---c---a---d---a---c---c---a---a---b---c---b---c---d---', '---1837---1839---1847---1848---1852---1853---1857---1860---1869---1872---1978---1987---1990---1993---1995---1996---2003---2004---2006---2010---2011---2013---2015---2016---2018---2020---2022---2025---2029---2036---7179---7204---7218---7260---7264---7270---7277---7281---7290---7293---7295---7305---7329---7331---7336---7361---7362---7383---7385---7389---7393---7395---7409---7422---7427---7429---7430---7443---7445---7449---7459---7460---7461---7462---7465---7471---7489---7492---7496---7498---10474---10484---10490---10508---10512---10546---10554---10567---10584---10595---10621---10622---10630---10631---10635---10640---10665---10670---10675---10678---10703---10704---10706---10722---10728---10746---10756---10757---10796---10805---', '2013-08-17 10:16:36'),
(58, 'abhi', '<p>abh</p>', '1', '2013-08-26', 'active', 'OFF', '---c---a---b---d---c---a---a---a---c---a---c---c---d---d---b---b---b---b---b---d---c---c---b---b---a---b---b---d---d---b---c---d---a---a---b---d---b---a---a---a---c---c---a---d---b---b---a---b---a---c---b---b---b---c---a---c---b---c---c---d---d---c---d---a---d---c---b---b---a---c---b---a---b---c---d---b---c---b---a---d---a---c---c---c---d---a---a---b---c---a---b---d---', '---11---315---339---342---347---349---351---359---363---364---366---367---372---375---376---379---383---8017---8030---8034---8035---8037---8040---8041---8043---8045---8048---8049---8050---8053---8055---8058---8060---8062---8063---8065---8066---8068---8073---8077---8078---8080---8086---8088---8089---8093---8101---8105---8108---8115---8123---8132---8133---8134---8138---8142---8143---8144---8146---8151---8154---8155---8156---8158---8167---8176---8181---8519---8525---8530---8597---8598---8601---8605---8611---8612---8617---8619---8623---8624---8635---8637---8646---8654---8661---8665---8678---8680---8685---8692---8703---8705---', '2013-08-27 00:10:59'),
(59, 'demo', '<p>demo</p>', '5', '2013-10-31', 'active', '', '---b---a---a---a---c---a---a---b---a---d---d---c---d---b---c---a---c---a---a---c---c---b---a---a---c---b---c---b---a---a---a---b---c---c---d---', '---5980---6011---6103---6257---6306---6580---6589---6616---6640---6654---6666---6701---6732---6737---6767---6787---6866---6877---6879---6886---6943---7003---7009---7012---7028---7053---7055---7083---7127---7143---8190---8210---8220---8242---8250---', '2013-10-31 17:27:51'),
(60, 'adesk', '<p>adesk</p>', '5', '2013-12-28', 'active', '', '---a---a---a---c---c---c---b---a---c---a---b---d---a---c---d---a---c---a---a---d---b---b---a---d---c---d---b---d---b---b---d---b---a---c---a---b---b---c---a---d---a---a---d---a---c---a---b---a---c---b---a---a---a---c---d---a---c---a---d---', '---5670---5710---5761---5841---5885---5951---5980---6166---6174---6182---6273---6289---6339---6417---6424---6503---6506---6555---6580---6587---6674---6682---6684---6690---6692---6697---6704---6714---6717---6720---6726---6728---6730---6735---6741---6753---6763---6767---6772---6811---6815---6820---6823---6864---6935---6984---6990---7015---7028---7062---7114---7115---7153---7167---8187---8191---8202---8204---8245---', '2013-12-28 12:57:31'),
(61, 'test', '<p>test</p>', '2', '2014-01-20', 'active', '', '---b---b---c---c---b---c---c---c---d---c---b---d---c---a---c---b---a---d---c---a---c---d---c---b---d---c---d---b---d---c---c---d---a---b---a---a---a---b---a---d---a---a---c---c---c---b---b---a---b---b---a---a---a---a---a---c---d---c---b---a---a---c---d---b---b---b---c---c---d---b---a---b---c---b---b---c---a---b---b---c---c---d---a---a---b---', '---35---39---44---51---54---58---63---65---79---84---96---98---99---113---126---122---125---130---137---143---147---156---166---167---175---177---180---190---192---745---403---419---420---423---427---453---460---464---466---467---495---496---516---523---530---573---581---584---592---593---604---622---639---630---643---8884---8907---8975---9006---9021---9061---9069---9072---9075---9217---9237---9254---9261---9345---9357---9419---9449---9457---9458---9476---9526---9534---9647---9694---9706---9762---9764---9767---9776---9799---', '2014-01-20 17:41:15'),
(62, 'to be deleted', '<p>to be deleted36783</p>', '1', '2014-03-21', 'active', '', '---c---b---d---b---c---b---b---d---b---d---c---d---c---d---c---b---c---a---a---c---c---b---c---d---c---d---a---c---a---c---c---d---b---a---a---a---d---d---d---a---a---a---a---a---b---d---c---b---d---c---c---b---', '---11---12---13---17---18---20---310---312---313---314---316---318---319---322---323---326---330---332---333---334---371---374---381---382---213---224---292---8012---8020---8026---8035---8039---8074---8075---8107---8108---8117---8145---8151---8158---8163---8518---8569---8615---8625---8642---8646---8651---8661---8663---8685---8704---', '2014-03-21 23:29:56'),
(63, '123', '<p>to be deleted</p>', '1', '2014-03-30', 'active', '', '---c---c---d---b---a---a---d---b---a---b---b---a---d---c---d---b---a---a---a---c---b---b---d---a---b---a---b---c---c---c---c---a---b---d---a---d---a---d---b---a---c---d---c---c---a---d---a---a---b---c---d---b---c---b---c---d---a---d---b---a---c---c---c---a---c---c---d---d---a---b---c---b---a---b---c---b---c---a---b---b---a---b---c---a---b---d---c---b---d---b---c---b---b---a---a---a---b---d---d---c---b---c---c---a---a---b---d---c---a---c---b---a---', '---212---213---214---215---216---217---218---219---220---221---222---223---224---225---226---227---228---232---229---230---231---234---235---233---236---237---238---239---240---241---242---243---244---245---246---247---248---249---250---251---252---253---254---255---256---257---258---259---260---261---262---263---264---265---266---267---268---273---272---271---270---269---274---275---276---277---278---279---280---281---282---283---284---285---286---287---288---289---290---291---292---293---294---295---296---297---298---8023---8029---8040---8044---8057---8067---8068---8075---8091---8095---8098---8113---8168---8181---8593---8610---8613---8623---8628---8633---8657---8678---8695---8696---8700---', '2014-03-30 17:47:49'),
(64, 'to be deleted', '<p>to be deleted</p>', '1', '2014-04-04', 'active', '', '---d---d---b---d---d---d---c---a---a---c---c---d---c---d---c---d---a---d---c---d---b---b---a---d---c---b---a---b---b---c---a---b---b---a---b---a---d---d---d---b---d---c---b---c---b---c---a---d---d---b---a---a---d---a---d---d---d---d---a---c---d---d---a---d---d---b---c---a---a---a---b---a---a---b---a---c---b---c---d---d---b---d---d---b---a---d---d---c---a---c---d---a---b---d---c---d---d---a---a---a---c---c---a---c---c---d---d---d---a---d---d---d---a---c---b---c---c---d---c---c---d---d---b---d---a---d---a---a---c---d---c---d---a---a---d---c---c---a---a---d---b---a---b---d---c---b---d---d---a---b---c---c---d---d---d---d---b---d---b---d---d---a---b---d---a---d---d---a---c---c---a---d---b---b---b---c---d---a---c---c---a---a---d---c---b---c---b---a---b---c---c---b---c---c---c---c---d---c---c---a---', '---2052---2053---2055---2057---2058---2062---2063---2065---2068---2072---2073---2075---2092---2094---2095---2105---2108---2113---2127---2128---2131---2138---2142---2147---2151---2152---2156---2159---2165---2167---2168---2177---2179---2188---2190---2192---2198---2203---2209---2213---2224---2226---2232---2236---2237---2239---2243---2247---2249---2253---2254---2255---2267---2269---2270---2274---2275---2276---2278---2282---2285---2291---2292---2295---2298---2299---2302---2304---2305---2306---2307---2312---2318---2331---2334---2338---2366---2369---2370---2374---2375---2376---2381---2392---2402---2405---2409---2410---2412---2414---2423---2427---2429---2432---2437---2442---2444---2446---2450---2458---2460---2469---2470---2473---2479---2492---2496---2502---2504---2505---2509---2511---2512---2516---2517---2526---2527---2530---2533---2536---2545---2547---2548---2550---2552---2554---2560---2567---2571---2572---2582---2594---2600---2603---2604---2614---2617---2622---2625---2627---2629---2635---2639---2640---2642---2644---2647---2649---5228---5249---5251---5264---5277---5315---5280---5296---5306---5307---5320---5322---5323---5334---5336---5338---5341---5344---5346---5356---5359---5365---5368---5377---5380---5384---5386---5392---5397---5398---5409---5415---5446---5449---5450---5510---5522---5534---5562---5563---5569---5571---5574---5577---5590---5591---5592---5594---5604---5607---5625---5648---', '2014-04-04 12:26:44'),
(65, 'tbd', '<p>tbd</p>', '1', '2014-04-04', 'active', '', '---a---a---c---b---c---c---c---d---c---d---a---b---a---d---c---c---c---c---a---b---d---a---a---a---d---b---a---d---c---d---d---c---b---b---b---c---c---d---a---d---c---a---d---b---c---d---b---b---d---c---d---b---a---c---d---d---d---b---b---d---d---d---b---a---a---c---d---c---d---c---c---c---c---d---c---d---d---d---a---a---a---b---b---b---a---d---d---c---b---c---d---c---b---d---a---d---c---b---a---a---c---a---c---b---a---d---a---d---b---d---a---a---b---b---d---d---a---c---c---c---a---a---d---a---d---d---d---a---d---b---c---d---a---a---d---b---b---a---a---b---b---a---b---c---a---b---c---d---a---b---b---a---a---a---d---b---d---d---b---c---d---d---a---d---b---d---b---c---b---a---c---d---a---c---b---a---d---d---b---c---d---d---b---b---a---c---a---c---d---b---c---c---a---d---a---d---b---c---c---', '---2054---2061---2063---2071---2073---2081---2089---2090---2092---2101---2107---2110---2112---2114---2116---2118---2121---2122---2123---2129---2139---2142---2145---2154---2155---2159---2160---2166---2167---2170---2171---2178---2186---2187---2190---2195---2196---2198---2199---2205---2206---2207---2209---2213---2214---2217---2228---2232---2242---2246---2251---2253---2257---2265---2274---2275---2276---2277---2286---2290---2291---2295---2308---2311---2312---2315---2323---2326---2329---2338---2341---2342---2348---2350---2354---2356---2367---2370---2373---2377---2384---2388---2392---2394---2400---2405---2413---2417---2421---2422---2423---2438---2443---2445---2450---2451---2453---2456---2457---2458---2460---2464---2483---2497---2498---2502---2504---2505---2510---2511---2512---2514---2517---2520---2522---2523---2525---2527---2533---2536---2541---2544---2583---2585---2587---2591---2594---2596---2605---2610---2619---2620---2622---2625---2627---2628---2629---2633---2635---2643---2644---2646---2648---5222---5228---5231---5237---5239---5248---5249---5252---5253---5265---5269---5278---5286---5295---5307---5320---5326---5328---5331---5337---5338---5348---5349---5354---5365---5366---5368---5375---5382---5417---5430---5431---5433---5447---5461---5467---5485---5491---5501---5530---5539---5563---5576---5583---5585---5587---5588---5590---5599---5603---5604---5608---5609---5622---5634---5639---', '2014-04-04 12:27:44'),
(66, 'y', '<p>y</p>', '1', '2014-05-13', 'active', '', '---c---a---a---d---d---b---a---d---d---c---d---b---d---d---d---a---b---c---b---a---d---c---b---d---a---b---c---d---b---a---d---b---a---b---a---d---b---b---b---c---d---c---c---d---d---d---c---c---c---d---d---d---d---d---a---b---d---b---a---c---d---b---d---b---b---a---a---b---c---c---b---a---c---b---b---c---b---c---b---a---a---c---a---d---b---a---a---b---d---c---a---b---d---b---c---a---c---a---c---b---a---a---d---b---d---c---b---d---d---a---a---d---b---b---d---a---a---c---c---a---d---a---d---d---b---d---b---a---b---d---d---a---a---a---d---b---c---c---c---b---c---c---a---a---b---a---c---d---d---a---d---b---d---a---d---d---a---a---c---c---d---b---a---b---c---c---d---c---c---b---b---a---c---d---b---c---b---d---a---b---b---a---c---d---a---a---d---d---b---c---c---d---c---a---', '---11---14---16---306---307---310---311---312---314---2049---2053---2055---2056---2058---2062---2067---2080---2081---2082---2091---2094---2095---2096---2101---2102---2106---2121---2126---2130---2135---2139---2150---2160---2161---2168---2173---2177---2179---2201---2202---2203---2204---2214---2216---2221---2224---2231---2234---2239---2244---2247---2249---2251---2252---2255---2256---2260---2264---2269---2271---2273---2277---2280---2281---2288---2292---2294---2299---2302---2303---2307---2311---2327---2331---2336---2338---2339---2342---2359---2361---2373---2378---2390---2391---2398---2401---2404---2406---2409---2411---2420---2436---2442---2443---2453---2458---2459---2464---2469---2471---2475---2484---2492---2497---2499---2500---2501---2502---2509---2512---2514---2515---2520---2528---2530---2531---2549---2561---2569---2574---2584---2585---2588---2590---2602---2605---2606---2608---2610---2615---2620---2622---2625---2626---2641---2645---5221---5222---5223---5249---5250---5251---5253---5258---5259---5269---5270---5275---5315---5287---5307---5336---5338---5341---5344---5349---5356---5355---5365---5373---5394---5404---5413---5425---5428---5437---5443---5444---5445---5452---5454---5465---5485---5501---5506---5526---5567---5572---5573---5577---5578---5580---5591---5595---5601---5603---5605---5612---5619---5625---5632---5633---5639---5654---', '2014-05-13 13:19:40'),
(67, 'roopam', '<p>ffghj</p>\r\n<p>ji</p>', '1', '2014-08-04', 'active', '', '---b---b---b---b---c---c---a---a---a---', '---12---17---321---325---239---242---248---259---271---', '2014-08-04 13:47:35'),
(68, 'test', '<p>test</p>', '1', '2014-09-13', 'active', '', '---b---d---a---b---b---c---d---c---d---c---c---b---a---c---a---d---c---b---b---d---d---b---c---b---c---c---d---b---b---d---d---a---b---b---a---b---a---b---b---', '---308---309---315---325---337---340---342---344---345---346---347---348---349---350---351---353---354---356---357---218---226---236---261---285---837---875---847---1048---1050---1027---1006---1085---1087---1062---1399---1450---1549---1641---1802---', '2014-09-13 15:31:16'),
(69, 'test1', '<p>deeplds</p>', '1', '2014-09-13', 'active', '', '---a---c---c---d---d---d---a---c---d---', '---14---18---316---318---224---245---251---274---297---', '2014-09-13 15:31:31'),
(70, 'memorial school ', '<p>pla delete</p>', '1', '2014-10-05', 'active', '', '---b---d---c---c---a---b---c---c---c---b---d---c---a---c---c---c---a---d---c---d---b---b---a---d---c---c---a---a---b---c---b---a---d---a---d---a---b---a---d---c---', '---20---306---319---328---341---356---363---366---373---376---218---242---284---288---294---912---1334---1508---1571---2363---2528---5622---2654---2721---2814---3182---3233---3445---3485---3563---3611---3671---3776---3837---3905---3976---8057---8073---8633---8634---', '2014-10-05 23:55:34'),
(71, 'millemni', '<p>data to deleted</p>', '5', '2014-10-09', 'active', '', '---b---a---c---a---a---c---a---a---a---d---a---d---c---b---a---d---b---b---d---c---c---b---c---c---d---b---d---a---b---a---c---c---a---a---c---c---c---d---a---a---d---c---a---b---d---b---b---b---d---a---d---b---c---b---', '---5707---5711---5868---6103---6219---6296---6390---6396---6423---6458---6472---6486---6492---6561---6564---6666---6668---6679---6690---6692---6701---6704---6708---6722---6726---6728---6732---6741---6744---6755---6760---6767---6770---6772---6791---6857---6859---6861---6879---6931---6950---6982---7006---7016---7079---7080---7105---7111---7159---8190---8203---8206---8224---8254---', '2014-10-09 15:18:59'),
(72, 'Absolute study Quiz .    Round I      Best of Luck', '<p>Pole Star Academy&nbsp;</p>\r\n<p>New Jalpaigudi</p>\r\n<p>Class XI</p>\r\n<p>Section Science</p>\r\n<p>Round 1</p>', '6', '2014-10-15', 'active', '', '---c---c---c---d---b---d---b---b---b---d---b---c---c---a---b---a---b---a---c---b---a---a---a---a---a---a---d---c---a---a---d---a---d---a---c---a---c---c---d---d---b---b---c---c---a---d---b---c---b---a---b---c---a---c---d---d---c---c---a---c---c---b---d---a---a---a---d---b---c---d---c---a---b---a---c---a---c---b---c---c---c---a---a---b---c---b---b---a---a---a---a---a---d---a---b---b---c---d---c---c---', '---7499---7500---7512---7516---7518---7523---7526---7529---7539---7558---7562---7569---7578---7588---7601---7638---7644---7650---7657---7665---7672---7673---7681---7694---7700---7702---7720---7722---7742---7752---9070---9094---9106---9116---9117---9120---9126---9129---9133---9139---9154---9159---9160---9165---9191---9208---9215---9216---9234---9242---9297---9306---9309---9312---9316---9327---9336---9339---9344---9347---9463---9490---9533---9535---9546---9550---9572---9592---9604---9676---9709---9722---9786---9789---9791---9797---9798---9803---9843---9865---9875---9926---9978---9968---9996---10045---10052---10077---10107---10110---10112---10127---10145---10149---10182---10185---10265---10287---10291---10307---', '2014-10-15 20:58:47'),
(73, 'new demo quiz', '<p>new demo quiz</p>', '1', '2014-12-26', 'active', '', '---b---a---d---d---b---a---c---b---d---c---b---c---a---c---c---c---b---b---c---a---b---c---b---a---d---b---d---a---c---d---a---c---d---c---d---a---d---b---c---a---b---b---b---a---d---c---b---', '---18465---311---312---322---326---333---340---343---345---350---357---363---364---365---367---371---379---215---242---258---263---298---834---818---1221---1437---2290---2361---5485---2651---2731---2802---2897---3100---3395---3518---3554---3589---3617---3743---3878---3972---3994---8043---8175---8695---8706---', '2014-12-26 17:27:34'),
(74, 'Logimetrix Quiz', '<p>Logimetrix Quiz</p>', '1', '2015-08-14', 'active', '', '---b---b---d---b---b---c---d---c---c---c---d---c---d---c---d---b---a---c---d---c---b---b---c---d---a---b---d---b---b---d---d---d---a---a---c---b---a---a---d---b---b---b---d---c---b---a---c---', '---20---313---314---321---326---330---345---346---347---350---352---360---361---366---370---378---380---255---257---266---290---296---916---951---1403---1384---2098---2174---5482---2655---2687---2898---3177---3188---3444---3469---3486---3575---3642---3750---3792---3918---3929---8016---8021---8636---8637---', '2015-08-14 11:40:18'),
(75, 'demo 123', '<p>demo 123</p>', '1', '2015-08-14', 'active', '', '---c---a---d---d---c---c---b---a---c---b---c---a---a---c---a---', '---11---315---336---358---371---212---831---2045---2650---2753---3391---3564---3693---3891---8007---', '2015-08-14 12:35:29'),
(76, 'Demo Quiz', '<p>Demo Quiz</p>', '1', '2015-09-14', 'active', '', '---c---a---d---d---c---c---b---a---c---b---c---a---a---a---', '---11---315---336---358---371---212---831---2045---2650---2753---3391---3564---3693---8007---', '2015-09-14 14:55:22'),
(77, 'ARMY QUIZ', '<p>army quizes</p>', '1', '2015-11-20', 'active', '', '---c---c---a---d---d---c---c---c---b---b---a---c---b---b---c---a---a---a---a---', '---11---319---333---336---358---363---371---212---841---1528---2045---2650---2753---3419---3542---3564---3693---8007---8518---', '2015-11-20 18:12:16'),
(78, 'Army Demo', '<p>army demo</p>', '1', '2015-11-20', 'active', '', '---c---c---c---a---c---b---a---a---a---a---', '---11---371---212---2045---2650---2753---3564---3693---8007---8518---', '2015-11-20 18:22:36'),
(79, 'Army Demo1', '<p>Army Demo</p>', '17', '2015-11-20', 'active', '', '---b---b---a---a---a---a---a---c---b---c---', '---11378---16701---16727---17206---17248---17479---17733---17769---17781---17851---', '2015-11-21 09:50:46'),
(80, 'ree', '<p>tet</p>', '1', '2015-11-26', 'active', '', '---c---b---b---b---c---c---a---c---b---a---a---a---a---', '---11---17---20---308---371---212---2045---2650---2753---3564---3693---8007---8518---', '2015-11-26 14:26:56'),
(81, 'TEST DEMO', '<p>TEST DEMO</p>', '2', '2017-03-17', 'active', 'OFF', '---c---b---a---c---b---c---d---c---b---d---a---c---d---c---c---b---b---b---d---a---b---c---c---c---a---d---c---a---a---c---b---b---a---a---b---a---a---b---c---a---d---a---a---b---c---c---b---c---c---a---b---a---b---b---b---c---d---a---d---a---c---b---a---a---d---b---d---a---c---b---b---a---b---b---c---d---c---c---a---c---d---a---a---a---a---', '---31---42---45---51---54---58---62---71---75---79---91---95---98---102---106---111---115---138---139---148---149---150---151---158---731---186---744---209---210---300---386---405---409---424---435---452---454---464---476---486---492---505---508---509---530---571---573---576---589---591---617---621---637---640---654---8975---8992---9021---9027---9031---9042---9062---9079---9088---9105---9196---9241---9308---9326---9356---9437---9446---9452---9501---9524---9556---9563---9567---9648---9723---9744---9750---9761---9776---9826---', '2017-03-17 12:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_pool_subject`
--

CREATE TABLE `tbl_quiz_pool_subject` (
  `id` int(11) NOT NULL,
  `quiz_pool_id` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_quiz_pool_subject`
--

INSERT INTO `tbl_quiz_pool_subject` (`id`, `quiz_pool_id`, `subject_id`, `timestamp`) VALUES
(1, '1', '1', '2013-04-25 15:49:10'),
(2, '1', '5', '2013-04-25 15:49:11'),
(3, '1', '9', '2013-04-25 15:49:11'),
(4, '1', '11', '2013-04-25 15:49:12'),
(5, '1', '12', '2013-04-25 15:49:12'),
(6, '1', '26', '2013-04-25 15:49:12'),
(7, '1', '34', '2013-04-25 15:49:13'),
(8, '2', '1', '2013-04-25 15:54:31'),
(9, '2', '5', '2013-04-25 15:54:31'),
(10, '2', '9', '2013-04-25 15:54:32'),
(11, '2', '11', '2013-04-25 15:54:32'),
(12, '2', '12', '2013-04-25 15:54:32'),
(13, '2', '26', '2013-04-25 15:54:33'),
(14, '2', '34', '2013-04-25 15:54:33'),
(15, '3', '1', '2013-04-25 16:08:46'),
(16, '3', '5', '2013-04-25 16:08:47'),
(17, '3', '9', '2013-04-25 16:08:47'),
(18, '3', '11', '2013-04-25 16:08:47'),
(19, '3', '12', '2013-04-25 16:08:48'),
(20, '3', '26', '2013-04-25 16:08:48'),
(21, '3', '34', '2013-04-25 16:08:48'),
(22, '4', '1', '2013-04-27 10:26:11'),
(23, '4', '5', '2013-04-27 10:26:12'),
(24, '4', '9', '2013-04-27 10:26:12'),
(25, '4', '11', '2013-04-27 10:26:14'),
(26, '4', '12', '2013-04-27 10:26:14'),
(27, '4', '26', '2013-04-27 10:26:16'),
(28, '4', '34', '2013-04-27 10:26:16'),
(29, '5', '1', '2013-04-27 15:20:53'),
(30, '5', '5', '2013-04-27 15:20:53'),
(31, '5', '9', '2013-04-27 15:20:53'),
(32, '5', '11', '2013-04-27 15:20:53'),
(33, '5', '12', '2013-04-27 15:20:54'),
(34, '5', '26', '2013-04-27 15:20:54'),
(35, '5', '34', '2013-04-27 15:20:54'),
(36, '6', '1', '2013-04-27 15:21:33'),
(37, '6', '5', '2013-04-27 15:21:34'),
(38, '6', '9', '2013-04-27 15:21:36'),
(39, '6', '11', '2013-04-27 15:21:36'),
(40, '6', '12', '2013-04-27 15:21:36'),
(41, '6', '26', '2013-04-27 15:21:37'),
(42, '6', '34', '2013-04-27 15:21:44'),
(43, '7', '1', '2013-04-29 12:25:45'),
(44, '7', '5', '2013-04-29 12:25:45'),
(45, '7', '9', '2013-04-29 12:25:45'),
(46, '7', '11', '2013-04-29 12:25:45'),
(47, '7', '12', '2013-04-29 12:25:45'),
(48, '7', '26', '2013-04-29 12:25:45'),
(49, '7', '34', '2013-04-29 12:25:45'),
(50, '8', '1', '2013-05-06 23:18:42'),
(51, '8', '5', '2013-05-06 23:18:42'),
(52, '8', '9', '2013-05-06 23:18:42'),
(53, '8', '11', '2013-05-06 23:18:43'),
(54, '8', '12', '2013-05-06 23:18:43'),
(55, '8', '26', '2013-05-06 23:18:43'),
(56, '8', '34', '2013-05-06 23:18:43'),
(57, '9', '1', '2013-05-14 12:54:18'),
(58, '9', '5', '2013-05-14 12:54:18'),
(59, '9', '9', '2013-05-14 12:54:18'),
(60, '9', '11', '2013-05-14 12:54:18'),
(61, '9', '12', '2013-05-14 12:54:18'),
(62, '9', '26', '2013-05-14 12:54:18'),
(63, '9', '34', '2013-05-14 12:54:18'),
(64, '10', '17', '2013-05-14 15:43:36'),
(65, '10', '18', '2013-05-14 15:43:36'),
(66, '10', '19', '2013-05-14 15:43:36'),
(67, '10', '20', '2013-05-14 15:43:36'),
(68, '10', '27', '2013-05-14 15:43:36'),
(69, '11', '17', '2013-05-15 13:01:47'),
(70, '11', '18', '2013-05-15 13:01:48'),
(71, '11', '19', '2013-05-15 13:01:48'),
(72, '11', '20', '2013-05-15 13:01:48'),
(73, '11', '27', '2013-05-15 13:01:48'),
(74, '12', '1', '2013-05-18 01:13:34'),
(75, '12', '5', '2013-05-18 01:13:34'),
(76, '12', '9', '2013-05-18 01:13:34'),
(77, '12', '11', '2013-05-18 01:13:34'),
(78, '12', '12', '2013-05-18 01:13:35'),
(79, '12', '26', '2013-05-18 01:13:35'),
(80, '12', '34', '2013-05-18 01:13:35'),
(81, '13', '13', '2013-05-18 12:30:10'),
(82, '13', '14', '2013-05-18 12:30:10'),
(83, '13', '15', '2013-05-18 12:30:10'),
(84, '13', '16', '2013-05-18 12:30:11'),
(85, '14', '4', '2013-05-27 17:41:31'),
(86, '14', '7', '2013-05-27 17:41:31'),
(87, '14', '8', '2013-05-27 17:41:31'),
(88, '14', '36', '2013-05-27 17:41:31'),
(89, '15', '17', '2013-06-18 11:17:35'),
(90, '15', '18', '2013-06-18 11:17:35'),
(91, '15', '19', '2013-06-18 11:17:35'),
(92, '15', '20', '2013-06-18 11:17:35'),
(93, '15', '27', '2013-06-18 11:17:35'),
(94, '16', '17', '2013-06-18 11:21:04'),
(95, '16', '18', '2013-06-18 11:21:05'),
(96, '16', '19', '2013-06-18 11:21:05'),
(97, '16', '20', '2013-06-18 11:21:05'),
(98, '16', '27', '2013-06-18 11:21:05'),
(99, '17', '1', '2013-06-19 01:22:36'),
(100, '17', '5', '2013-06-19 01:22:36'),
(101, '17', '9', '2013-06-19 01:22:36'),
(102, '17', '11', '2013-06-19 01:22:36'),
(103, '17', '12', '2013-06-19 01:22:36'),
(104, '17', '26', '2013-06-19 01:22:36'),
(105, '17', '34', '2013-06-19 01:22:36'),
(106, '18', '1', '2013-06-19 11:56:04'),
(107, '18', '5', '2013-06-19 11:56:04'),
(108, '18', '9', '2013-06-19 11:56:04'),
(109, '18', '11', '2013-06-19 11:56:04'),
(110, '18', '12', '2013-06-19 11:56:04'),
(111, '18', '26', '2013-06-19 11:56:05'),
(112, '18', '34', '2013-06-19 11:56:05'),
(113, '19', '1', '2013-06-24 18:59:13'),
(114, '19', '5', '2013-06-24 18:59:13'),
(115, '19', '9', '2013-06-24 18:59:13'),
(116, '19', '11', '2013-06-24 18:59:13'),
(117, '19', '12', '2013-06-24 18:59:13'),
(118, '19', '26', '2013-06-24 18:59:13'),
(119, '19', '34', '2013-06-24 18:59:13'),
(120, '20', '17', '2013-06-27 16:49:45'),
(121, '20', '18', '2013-06-27 16:49:45'),
(122, '20', '19', '2013-06-27 16:49:45'),
(123, '20', '20', '2013-06-27 16:49:45'),
(124, '20', '27', '2013-06-27 16:49:45'),
(125, '21', '33', '2013-06-29 15:38:38'),
(126, '21', '10', '2013-06-29 15:38:38'),
(127, '21', '21', '2013-06-29 15:38:38'),
(128, '21', '32', '2013-06-29 15:38:38'),
(129, '21', '42', '2013-06-29 15:38:38'),
(130, '22', '33', '2013-06-29 16:54:48'),
(131, '22', '10', '2013-06-29 16:54:48'),
(132, '22', '21', '2013-06-29 16:54:48'),
(133, '22', '32', '2013-06-29 16:54:48'),
(134, '22', '42', '2013-06-29 16:54:48'),
(135, '23', '17', '2013-06-29 16:56:51'),
(136, '23', '18', '2013-06-29 16:56:51'),
(137, '23', '19', '2013-06-29 16:56:52'),
(138, '23', '20', '2013-06-29 16:56:52'),
(139, '23', '27', '2013-06-29 16:56:53'),
(140, '24', '13', '2013-06-29 17:04:17'),
(141, '24', '14', '2013-06-29 17:04:18'),
(142, '24', '15', '2013-06-29 17:04:18'),
(143, '24', '16', '2013-06-29 17:04:18'),
(144, '25', '22', '2013-06-29 17:09:36'),
(145, '25', '24', '2013-06-29 17:09:36'),
(146, '25', '30', '2013-06-29 17:09:36'),
(147, '25', '35', '2013-06-29 17:09:36'),
(148, '25', '37', '2013-06-29 17:09:36'),
(149, '25', '38', '2013-06-29 17:09:36'),
(150, '26', '22', '2013-06-29 17:15:57'),
(151, '26', '24', '2013-06-29 17:15:57'),
(152, '26', '30', '2013-06-29 17:15:57'),
(153, '26', '35', '2013-06-29 17:15:57'),
(154, '26', '37', '2013-06-29 17:15:57'),
(155, '26', '38', '2013-06-29 17:15:57'),
(156, '27', '4', '2013-06-29 17:22:13'),
(157, '27', '7', '2013-06-29 17:22:13'),
(158, '27', '8', '2013-06-29 17:22:14'),
(159, '27', '36', '2013-06-29 17:22:14'),
(160, '28', '1', '2013-06-29 17:50:27'),
(161, '28', '5', '2013-06-29 17:50:28'),
(162, '28', '9', '2013-06-29 17:50:28'),
(163, '28', '11', '2013-06-29 17:50:28'),
(164, '28', '12', '2013-06-29 17:50:28'),
(165, '28', '26', '2013-06-29 17:50:29'),
(166, '28', '34', '2013-06-29 17:50:29'),
(167, '29', '1', '2013-06-29 17:52:32'),
(168, '29', '5', '2013-06-29 17:52:32'),
(169, '29', '9', '2013-06-29 17:52:32'),
(170, '29', '11', '2013-06-29 17:52:32'),
(171, '29', '12', '2013-06-29 17:52:33'),
(172, '29', '26', '2013-06-29 17:52:33'),
(173, '29', '34', '2013-06-29 17:52:33'),
(174, '30', '25', '2013-06-29 17:55:07'),
(175, '30', '39', '2013-06-29 17:55:08'),
(176, '30', '40', '2013-06-29 17:55:08'),
(177, '30', '43', '2013-06-29 17:55:08'),
(178, '31', '25', '2013-06-29 17:57:32'),
(179, '31', '39', '2013-06-29 17:57:32'),
(180, '31', '40', '2013-06-29 17:57:32'),
(181, '31', '43', '2013-06-29 17:57:32'),
(182, '32', '17', '2013-06-29 20:16:53'),
(183, '32', '18', '2013-06-29 20:16:53'),
(184, '32', '19', '2013-06-29 20:16:53'),
(185, '32', '20', '2013-06-29 20:16:53'),
(186, '32', '27', '2013-06-29 20:16:53'),
(187, '33', '51', '2013-06-29 20:52:43'),
(188, '33', '53', '2013-06-29 20:52:43'),
(189, '34', '51', '2013-06-29 20:57:15'),
(190, '34', '53', '2013-06-29 20:57:15'),
(191, '35', '13', '2013-06-29 20:59:33'),
(192, '35', '14', '2013-06-29 20:59:33'),
(193, '35', '15', '2013-06-29 20:59:33'),
(194, '35', '16', '2013-06-29 20:59:33'),
(195, '36', '17', '2013-07-20 08:58:37'),
(196, '36', '18', '2013-07-20 08:58:37'),
(197, '36', '19', '2013-07-20 08:58:37'),
(198, '36', '20', '2013-07-20 08:58:37'),
(199, '36', '27', '2013-07-20 08:58:37'),
(200, '37', '17', '2013-07-20 09:13:29'),
(201, '37', '18', '2013-07-20 09:13:29'),
(202, '37', '19', '2013-07-20 09:13:29'),
(203, '37', '20', '2013-07-20 09:13:29'),
(204, '37', '27', '2013-07-20 09:13:29'),
(205, '38', '33', '2013-07-20 09:14:41'),
(206, '38', '10', '2013-07-20 09:14:41'),
(207, '38', '21', '2013-07-20 09:14:41'),
(208, '38', '32', '2013-07-20 09:14:42'),
(209, '38', '42', '2013-07-20 09:14:42'),
(210, '39', '33', '2013-07-20 09:15:42'),
(211, '39', '10', '2013-07-20 09:15:42'),
(212, '39', '21', '2013-07-20 09:15:42'),
(213, '39', '32', '2013-07-20 09:15:43'),
(214, '39', '42', '2013-07-20 09:15:43'),
(215, '40', '13', '2013-07-20 09:21:19'),
(216, '40', '14', '2013-07-20 09:21:19'),
(217, '40', '15', '2013-07-20 09:21:20'),
(218, '40', '16', '2013-07-20 09:21:20'),
(219, '41', '22', '2013-07-20 09:25:24'),
(220, '41', '24', '2013-07-20 09:25:24'),
(221, '41', '30', '2013-07-20 09:25:24'),
(222, '41', '35', '2013-07-20 09:25:24'),
(223, '41', '37', '2013-07-20 09:25:24'),
(224, '41', '38', '2013-07-20 09:25:25'),
(225, '42', '4', '2013-07-20 09:36:10'),
(226, '42', '7', '2013-07-20 09:36:11'),
(227, '42', '8', '2013-07-20 09:36:11'),
(228, '42', '36', '2013-07-20 09:36:11'),
(229, '43', '4', '2013-07-20 09:44:49'),
(230, '43', '7', '2013-07-20 09:44:50'),
(231, '43', '8', '2013-07-20 09:44:51'),
(232, '43', '36', '2013-07-20 09:44:51'),
(233, '44', '25', '2013-07-20 09:48:19'),
(234, '44', '39', '2013-07-20 09:48:19'),
(235, '44', '40', '2013-07-20 09:48:19'),
(236, '44', '43', '2013-07-20 09:48:19'),
(237, '45', '17', '2013-07-25 15:30:28'),
(238, '45', '18', '2013-07-25 15:30:28'),
(239, '45', '19', '2013-07-25 15:30:29'),
(240, '45', '20', '2013-07-25 15:30:29'),
(241, '45', '27', '2013-07-25 15:30:29'),
(242, '46', '33', '2013-07-25 15:36:09'),
(243, '46', '10', '2013-07-25 15:36:09'),
(244, '46', '21', '2013-07-25 15:36:09'),
(245, '46', '32', '2013-07-25 15:36:10'),
(246, '46', '42', '2013-07-25 15:36:10'),
(247, '47', '33', '2013-07-25 16:37:57'),
(248, '47', '10', '2013-07-25 16:37:57'),
(249, '47', '21', '2013-07-25 16:37:57'),
(250, '47', '32', '2013-07-25 16:37:57'),
(251, '47', '42', '2013-07-25 16:37:57'),
(252, '48', '13', '2013-07-25 16:40:20'),
(253, '48', '14', '2013-07-25 16:40:21'),
(254, '48', '15', '2013-07-25 16:40:21'),
(255, '48', '16', '2013-07-25 16:40:21'),
(256, '49', '22', '2013-07-25 16:44:00'),
(257, '49', '24', '2013-07-25 16:44:01'),
(258, '49', '30', '2013-07-25 16:44:01'),
(259, '49', '35', '2013-07-25 16:44:01'),
(260, '49', '37', '2013-07-25 16:44:01'),
(261, '49', '38', '2013-07-25 16:44:01'),
(262, '50', '4', '2013-07-25 16:48:03'),
(263, '50', '7', '2013-07-25 16:48:03'),
(264, '50', '8', '2013-07-25 16:48:04'),
(265, '50', '36', '2013-07-25 16:48:04'),
(266, '51', '1', '2013-07-25 16:51:47'),
(267, '51', '5', '2013-07-25 16:51:47'),
(268, '51', '9', '2013-07-25 16:51:47'),
(269, '51', '11', '2013-07-25 16:51:47'),
(270, '51', '12', '2013-07-25 16:51:48'),
(271, '51', '26', '2013-07-25 16:51:48'),
(272, '51', '34', '2013-07-25 16:51:48'),
(273, '52', '1', '2013-07-25 16:54:14'),
(274, '52', '5', '2013-07-25 16:54:14'),
(275, '52', '9', '2013-07-25 16:54:14'),
(276, '52', '11', '2013-07-25 16:54:14'),
(277, '52', '12', '2013-07-25 16:54:14'),
(278, '52', '26', '2013-07-25 16:54:14'),
(279, '52', '34', '2013-07-25 16:54:14'),
(280, '53', '25', '2013-07-25 16:55:51'),
(281, '53', '39', '2013-07-25 16:55:52'),
(282, '53', '40', '2013-07-25 16:55:52'),
(283, '53', '43', '2013-07-25 16:55:52'),
(284, '54', '25', '2013-07-25 16:57:23'),
(285, '54', '39', '2013-07-25 16:57:23'),
(286, '54', '40', '2013-07-25 16:57:23'),
(287, '54', '43', '2013-07-25 16:57:23'),
(288, '55', '17', '2013-08-17 10:13:02'),
(289, '55', '18', '2013-08-17 10:13:02'),
(290, '55', '19', '2013-08-17 10:13:02'),
(291, '55', '20', '2013-08-17 10:13:02'),
(292, '55', '27', '2013-08-17 10:13:02'),
(293, '56', '13', '2013-08-17 10:15:28'),
(294, '56', '14', '2013-08-17 10:15:29'),
(295, '56', '15', '2013-08-17 10:15:29'),
(296, '56', '16', '2013-08-17 10:15:29'),
(297, '57', '33', '2013-08-17 10:16:36'),
(298, '57', '10', '2013-08-17 10:16:36'),
(299, '57', '21', '2013-08-17 10:16:36'),
(300, '57', '32', '2013-08-17 10:16:37'),
(301, '57', '42', '2013-08-17 10:16:37'),
(302, '58', '1', '2013-08-27 00:10:59'),
(303, '58', '5', '2013-08-27 00:10:59'),
(304, '58', '9', '2013-08-27 00:11:00'),
(305, '58', '11', '2013-08-27 00:11:00'),
(306, '58', '12', '2013-08-27 00:11:00'),
(307, '58', '26', '2013-08-27 00:11:00'),
(308, '58', '34', '2013-08-27 00:11:00'),
(309, '59', '17', '2013-10-31 17:27:51'),
(310, '59', '18', '2013-10-31 17:27:52'),
(311, '59', '19', '2013-10-31 17:27:52'),
(312, '59', '20', '2013-10-31 17:27:52'),
(313, '59', '27', '2013-10-31 17:27:52'),
(314, '60', '17', '2013-12-28 12:57:31'),
(315, '60', '18', '2013-12-28 12:57:32'),
(316, '60', '19', '2013-12-28 12:57:33'),
(317, '60', '20', '2013-12-28 12:57:33'),
(318, '60', '27', '2013-12-28 12:57:34'),
(319, '61', '4', '2014-01-20 17:41:15'),
(320, '61', '7', '2014-01-20 17:41:16'),
(321, '61', '8', '2014-01-20 17:41:16'),
(322, '61', '36', '2014-01-20 17:41:17'),
(323, '62', '1', '2014-03-21 23:29:56'),
(324, '62', '5', '2014-03-21 23:29:57'),
(325, '62', '9', '2014-03-21 23:29:58'),
(326, '62', '11', '2014-03-21 23:30:00'),
(327, '62', '12', '2014-03-21 23:30:01'),
(328, '62', '26', '2014-03-21 23:30:03'),
(329, '62', '34', '2014-03-21 23:30:04'),
(330, '63', '1', '2014-03-30 17:47:49'),
(331, '63', '5', '2014-03-30 17:47:50'),
(332, '63', '9', '2014-03-30 17:47:50'),
(333, '63', '11', '2014-03-30 17:47:51'),
(334, '63', '12', '2014-03-30 17:47:52'),
(335, '63', '26', '2014-03-30 17:47:53'),
(336, '63', '34', '2014-03-30 17:47:54'),
(337, '64', '1', '2014-04-04 12:26:44'),
(338, '64', '5', '2014-04-04 12:26:44'),
(339, '64', '9', '2014-04-04 12:26:45'),
(340, '64', '11', '2014-04-04 12:26:46'),
(341, '64', '12', '2014-04-04 12:26:46'),
(342, '64', '26', '2014-04-04 12:26:47'),
(343, '64', '34', '2014-04-04 12:26:48'),
(344, '65', '1', '2014-04-04 12:27:44'),
(345, '65', '5', '2014-04-04 12:27:45'),
(346, '65', '9', '2014-04-04 12:27:46'),
(347, '65', '11', '2014-04-04 12:27:47'),
(348, '65', '12', '2014-04-04 12:27:49'),
(349, '65', '26', '2014-04-04 12:27:51'),
(350, '65', '34', '2014-04-04 12:27:52'),
(351, '66', '1', '2014-05-13 13:19:40'),
(352, '66', '5', '2014-05-13 13:19:41'),
(353, '66', '9', '2014-05-13 13:19:41'),
(354, '66', '11', '2014-05-13 13:19:42'),
(355, '66', '12', '2014-05-13 13:19:43'),
(356, '66', '26', '2014-05-13 13:19:45'),
(357, '66', '34', '2014-05-13 13:19:46'),
(358, '67', '1', '2014-08-04 13:47:35'),
(359, '67', '5', '2014-08-04 13:47:36'),
(360, '67', '9', '2014-08-04 13:47:36'),
(361, '67', '11', '2014-08-04 13:47:38'),
(362, '67', '12', '2014-08-04 13:47:39'),
(363, '67', '26', '2014-08-04 13:47:40'),
(364, '67', '34', '2014-08-04 13:47:42'),
(365, '68', '1', '2014-09-13 15:31:16'),
(366, '68', '5', '2014-09-13 15:31:17'),
(367, '68', '9', '2014-09-13 15:31:18'),
(368, '68', '11', '2014-09-13 15:31:19'),
(369, '68', '12', '2014-09-13 15:31:20'),
(370, '68', '26', '2014-09-13 15:31:20'),
(371, '68', '34', '2014-09-13 15:31:21'),
(372, '69', '1', '2014-09-13 15:31:31'),
(373, '69', '5', '2014-09-13 15:31:31'),
(374, '69', '9', '2014-09-13 15:31:32'),
(375, '69', '11', '2014-09-13 15:31:35'),
(376, '69', '12', '2014-09-13 15:31:36'),
(377, '69', '26', '2014-09-13 15:31:40'),
(378, '69', '34', '2014-09-13 15:31:41'),
(379, '70', '1', '2014-10-05 23:55:34'),
(380, '70', '5', '2014-10-05 23:55:35'),
(381, '70', '9', '2014-10-05 23:55:36'),
(382, '70', '11', '2014-10-05 23:55:37'),
(383, '70', '12', '2014-10-05 23:55:37'),
(384, '70', '26', '2014-10-05 23:55:39'),
(385, '70', '34', '2014-10-05 23:55:40'),
(386, '71', '17', '2014-10-09 15:18:59'),
(387, '71', '18', '2014-10-09 15:19:00'),
(388, '71', '19', '2014-10-09 15:19:01'),
(389, '71', '20', '2014-10-09 15:19:01'),
(390, '71', '27', '2014-10-09 15:19:01'),
(391, '72', '22', '2014-10-15 20:58:47'),
(392, '72', '24', '2014-10-15 20:58:47'),
(393, '72', '30', '2014-10-15 20:58:48'),
(394, '72', '35', '2014-10-15 20:58:48'),
(395, '72', '37', '2014-10-15 20:58:49'),
(396, '72', '38', '2014-10-15 20:58:50'),
(397, '73', '1', '2014-12-26 17:27:34'),
(398, '73', '5', '2014-12-26 17:27:35'),
(399, '73', '9', '2014-12-26 17:27:35'),
(400, '73', '11', '2014-12-26 17:27:36'),
(401, '73', '12', '2014-12-26 17:27:36'),
(402, '73', '26', '2014-12-26 17:27:37'),
(403, '73', '34', '2014-12-26 17:27:38'),
(404, '74', '1', '2015-08-14 11:40:18'),
(405, '74', '5', '2015-08-14 11:40:18'),
(406, '74', '9', '2015-08-14 11:40:19'),
(407, '74', '11', '2015-08-14 11:40:20'),
(408, '74', '12', '2015-08-14 11:40:21'),
(409, '74', '26', '2015-08-14 11:40:21'),
(410, '74', '34', '2015-08-14 11:40:22'),
(411, '75', '1', '2015-08-14 12:35:29'),
(412, '75', '5', '2015-08-14 12:35:29'),
(413, '75', '9', '2015-08-14 12:35:30'),
(414, '75', '11', '2015-08-14 12:35:31'),
(415, '75', '12', '2015-08-14 12:35:31'),
(416, '75', '26', '2015-08-14 12:35:32'),
(417, '75', '34', '2015-08-14 12:35:33'),
(418, '76', '1', '2015-09-14 14:55:22'),
(419, '76', '5', '2015-09-14 14:55:22'),
(420, '76', '9', '2015-09-14 14:55:22'),
(421, '76', '11', '2015-09-14 14:55:23'),
(422, '76', '12', '2015-09-14 14:55:24'),
(423, '76', '26', '2015-09-14 14:55:25'),
(424, '76', '34', '2015-09-14 14:55:26'),
(425, '77', '1', '2015-11-20 18:12:16'),
(426, '77', '5', '2015-11-20 18:12:16'),
(427, '77', '9', '2015-11-20 18:12:17'),
(428, '77', '11', '2015-11-20 18:12:18'),
(429, '77', '12', '2015-11-20 18:12:18'),
(430, '77', '26', '2015-11-20 18:12:19'),
(431, '77', '34', '2015-11-20 18:12:20'),
(432, '78', '1', '2015-11-20 18:22:36'),
(433, '78', '5', '2015-11-20 18:22:37'),
(434, '78', '9', '2015-11-20 18:22:37'),
(435, '78', '11', '2015-11-20 18:22:38'),
(436, '78', '12', '2015-11-20 18:22:39'),
(437, '78', '26', '2015-11-20 18:22:40'),
(438, '78', '34', '2015-11-20 18:22:41'),
(439, '79', '46', '2015-11-21 09:50:46'),
(440, '79', '58', '2015-11-21 09:50:47'),
(441, '79', '59', '2015-11-21 09:50:47'),
(442, '79', '60', '2015-11-21 09:50:47'),
(443, '80', '1', '2015-11-26 14:26:57'),
(444, '80', '5', '2015-11-26 14:27:03'),
(445, '80', '9', '2015-11-26 14:27:04'),
(446, '80', '11', '2015-11-26 14:27:05'),
(447, '80', '12', '2015-11-26 14:27:05'),
(448, '80', '26', '2015-11-26 14:27:06'),
(449, '80', '34', '2015-11-26 14:27:07'),
(450, '81', '4', '2017-03-17 12:59:32'),
(451, '81', '7', '2017-03-17 12:59:32'),
(452, '81', '8', '2017-03-17 12:59:32'),
(453, '81', '36', '2017-03-17 12:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_pool_unit`
--

CREATE TABLE `tbl_quiz_pool_unit` (
  `id` int(11) NOT NULL,
  `quiz_pool_id` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `quiz_pool_sub_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `question_per_unit` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` varchar(112) COLLATE utf8_unicode_ci NOT NULL,
  `time_per_unit` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `total_question_unit` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_quiz_pool_unit`
--

INSERT INTO `tbl_quiz_pool_unit` (`id`, `quiz_pool_id`, `quiz_pool_sub_id`, `question_per_unit`, `unit_id`, `time_per_unit`, `total_question_unit`, `timestamp`) VALUES
(1, '1', '1', '19', '2', '4', '', '2013-04-25 15:49:11'),
(2, '1', '1', '20', '6', '0', '', '2013-04-25 15:49:11'),
(3, '1', '1', '20', '7', '0', '', '2013-04-25 15:49:11'),
(4, '1', '1', '0', '8', '0', '', '2013-04-25 15:49:11'),
(5, '1', '1', '0', '9', '0', '', '2013-04-25 15:49:11'),
(6, '1', '2', '20', '5', '0', '', '2013-04-25 15:49:11'),
(7, '1', '3', '10', '18', '1', '', '2013-04-25 15:49:12'),
(8, '1', '4', '1', '19', '1', '', '2013-04-25 15:49:12'),
(9, '1', '5', '1', '21', '1', '', '2013-04-25 15:49:12'),
(10, '1', '5', '1', '22', '1', '', '2013-04-25 15:49:12'),
(11, '1', '5', '1', '23', '1', '', '2013-04-25 15:49:12'),
(12, '1', '5', '1', '24', '1', '', '2013-04-25 15:49:12'),
(13, '1', '5', '1', '25', '1', '', '2013-04-25 15:49:12'),
(14, '1', '5', '1', '26', '1', '', '2013-04-25 15:49:12'),
(15, '1', '6', '1', '58', '1', '', '2013-04-25 15:49:12'),
(16, '1', '7', '1', '67', '1', '', '2013-04-25 15:49:13'),
(17, '2', '8', '19', '2', '4', '', '2013-04-25 15:54:31'),
(18, '2', '8', '20', '6', '5', '', '2013-04-25 15:54:31'),
(19, '2', '8', '20', '7', '4', '', '2013-04-25 15:54:31'),
(20, '2', '8', '0', '8', '5', '', '2013-04-25 15:54:31'),
(21, '2', '8', '0', '9', '4', '', '2013-04-25 15:54:31'),
(22, '2', '9', '20', '5', '5', '', '2013-04-25 15:54:32'),
(23, '2', '10', '10', '18', '1', '', '2013-04-25 15:54:32'),
(24, '2', '11', '2', '19', '1', '', '2013-04-25 15:54:32'),
(25, '2', '12', '4', '21', '1', '', '2013-04-25 15:54:32'),
(26, '2', '12', '3', '22', '1', '', '2013-04-25 15:54:33'),
(27, '2', '12', '4', '23', '1', '', '2013-04-25 15:54:33'),
(28, '2', '12', '4', '24', '1', '', '2013-04-25 15:54:33'),
(29, '2', '12', '7', '25', '1', '', '2013-04-25 15:54:33'),
(30, '2', '12', '5', '26', '1', '', '2013-04-25 15:54:33'),
(31, '2', '13', '9', '58', '1', '', '2013-04-25 15:54:33'),
(32, '2', '14', '2', '67', '1', '', '2013-04-25 15:54:33'),
(33, '3', '15', '19', '2', '4', '', '2013-04-25 16:08:46'),
(34, '3', '15', '20', '6', '5', '', '2013-04-25 16:08:46'),
(35, '3', '15', '20', '7', '4', '', '2013-04-25 16:08:46'),
(36, '3', '15', '5', '8', '5', '', '2013-04-25 16:08:46'),
(37, '3', '15', '5', '9', '4', '', '2013-04-25 16:08:47'),
(38, '3', '16', '20', '5', '5', '', '2013-04-25 16:08:47'),
(39, '3', '17', '10', '18', '1', '', '2013-04-25 16:08:47'),
(40, '3', '18', '2', '19', '1', '', '2013-04-25 16:08:48'),
(41, '3', '19', '4', '21', '1', '', '2013-04-25 16:08:48'),
(42, '3', '19', '3', '22', '1', '', '2013-04-25 16:08:48'),
(43, '3', '19', '4', '23', '1', '', '2013-04-25 16:08:48'),
(44, '3', '19', '4', '24', '1', '', '2013-04-25 16:08:48'),
(45, '3', '19', '7', '25', '1', '', '2013-04-25 16:08:48'),
(46, '3', '19', '5', '26', '1', '', '2013-04-25 16:08:48'),
(47, '3', '20', '9', '58', '1', '', '2013-04-25 16:08:48'),
(48, '3', '21', '2', '67', '1', '', '2013-04-25 16:08:48'),
(49, '4', '22', '19', '2', '4', '', '2013-04-27 10:26:11'),
(50, '4', '22', '20', '6', '5', '', '2013-04-27 10:26:11'),
(51, '4', '22', '20', '7', '4', '', '2013-04-27 10:26:12'),
(52, '4', '22', '5', '8', '5', '', '2013-04-27 10:26:12'),
(53, '4', '22', '5', '9', '4', '', '2013-04-27 10:26:12'),
(54, '4', '23', '20', '5', '5', '', '2013-04-27 10:26:12'),
(55, '4', '24', '10', '18', '1', '', '2013-04-27 10:26:14'),
(56, '4', '25', '2', '19', '1', '', '2013-04-27 10:26:14'),
(57, '4', '26', '4', '21', '1', '', '2013-04-27 10:26:14'),
(58, '4', '26', '3', '22', '1', '', '2013-04-27 10:26:14'),
(59, '4', '26', '4', '23', '1', '', '2013-04-27 10:26:14'),
(60, '4', '26', '4', '24', '1', '', '2013-04-27 10:26:14'),
(61, '4', '26', '7', '25', '1', '', '2013-04-27 10:26:16'),
(62, '4', '26', '5', '26', '1', '', '2013-04-27 10:26:16'),
(63, '4', '27', '9', '58', '1', '', '2013-04-27 10:26:16'),
(64, '4', '28', '2', '67', '1', '', '2013-04-27 10:26:16'),
(65, '5', '29', '5', '2', '12', '', '2013-04-27 15:20:53'),
(66, '5', '29', '10', '6', '5', '', '2013-04-27 15:20:53'),
(67, '5', '29', '6', '7', '4', '', '2013-04-27 15:20:53'),
(68, '5', '29', '5', '8', '7', '', '2013-04-27 15:20:53'),
(69, '5', '29', '5', '9', '4', '', '2013-04-27 15:20:53'),
(70, '5', '30', '10', '5', '5', '', '2013-04-27 15:20:53'),
(71, '5', '31', '8', '18', '1', '', '2013-04-27 15:20:53'),
(72, '5', '32', '2', '19', '1', '', '2013-04-27 15:20:54'),
(73, '5', '33', '4', '21', '1', '', '2013-04-27 15:20:54'),
(74, '5', '33', '3', '22', '1', '', '2013-04-27 15:20:54'),
(75, '5', '33', '4', '23', '1', '', '2013-04-27 15:20:54'),
(76, '5', '33', '4', '24', '1', '', '2013-04-27 15:20:54'),
(77, '5', '33', '7', '25', '1', '', '2013-04-27 15:20:54'),
(78, '5', '33', '5', '26', '1', '', '2013-04-27 15:20:54'),
(79, '5', '34', '9', '58', '1', '', '2013-04-27 15:20:54'),
(80, '5', '35', '2', '67', '1', '', '2013-04-27 15:20:54'),
(81, '6', '36', '19', '2', '4', '', '2013-04-27 15:21:33'),
(82, '6', '36', '20', '6', '5', '', '2013-04-27 15:21:33'),
(83, '6', '36', '20', '7', '4', '', '2013-04-27 15:21:34'),
(84, '6', '36', '5', '8', '5', '', '2013-04-27 15:21:34'),
(85, '6', '36', '5', '9', '4', '', '2013-04-27 15:21:34'),
(86, '6', '37', '20', '5', '5', '', '2013-04-27 15:21:36'),
(87, '6', '38', '10', '18', '1', '', '2013-04-27 15:21:36'),
(88, '6', '39', '2', '19', '1', '', '2013-04-27 15:21:36'),
(89, '6', '40', '4', '21', '1', '', '2013-04-27 15:21:36'),
(90, '6', '40', '3', '22', '1', '', '2013-04-27 15:21:36'),
(91, '6', '40', '4', '23', '1', '', '2013-04-27 15:21:37'),
(92, '6', '40', '4', '24', '1', '', '2013-04-27 15:21:37'),
(93, '6', '40', '7', '25', '1', '', '2013-04-27 15:21:37'),
(94, '6', '40', '5', '26', '1', '', '2013-04-27 15:21:37'),
(95, '6', '41', '9', '58', '1', '', '2013-04-27 15:21:44'),
(96, '6', '42', '2', '67', '1', '', '2013-04-27 15:21:44'),
(97, '7', '43', '19', '2', '4', '', '2013-04-29 12:25:45'),
(98, '7', '43', '20', '6', '5', '', '2013-04-29 12:25:45'),
(99, '7', '43', '20', '7', '4', '', '2013-04-29 12:25:45'),
(100, '7', '43', '5', '8', '5', '', '2013-04-29 12:25:45'),
(101, '7', '43', '5', '9', '4', '', '2013-04-29 12:25:45'),
(102, '7', '44', '20', '5', '5', '', '2013-04-29 12:25:45'),
(103, '7', '45', '10', '18', '1', '', '2013-04-29 12:25:45'),
(104, '7', '46', '2', '19', '1', '', '2013-04-29 12:25:45'),
(105, '7', '47', '4', '21', '1', '', '2013-04-29 12:25:45'),
(106, '7', '47', '3', '22', '1', '', '2013-04-29 12:25:45'),
(107, '7', '47', '4', '23', '1', '', '2013-04-29 12:25:45'),
(108, '7', '47', '4', '24', '1', '', '2013-04-29 12:25:45'),
(109, '7', '47', '7', '25', '1', '', '2013-04-29 12:25:45'),
(110, '7', '47', '5', '26', '1', '', '2013-04-29 12:25:45'),
(111, '7', '48', '9', '58', '1', '', '2013-04-29 12:25:45'),
(112, '7', '49', '2', '67', '1', '', '2013-04-29 12:25:45'),
(113, '8', '50', '19', '2', '4', '', '2013-05-06 23:18:42'),
(114, '8', '50', '20', '6', '5', '', '2013-05-06 23:18:42'),
(115, '8', '50', '20', '7', '4', '', '2013-05-06 23:18:42'),
(116, '8', '50', '5', '8', '5', '', '2013-05-06 23:18:42'),
(117, '8', '50', '5', '9', '4', '', '2013-05-06 23:18:42'),
(118, '8', '51', '20', '5', '5', '', '2013-05-06 23:18:42'),
(119, '8', '52', '10', '18', '1', '', '2013-05-06 23:18:43'),
(120, '8', '53', '2', '19', '1', '', '2013-05-06 23:18:43'),
(121, '8', '54', '4', '21', '1', '', '2013-05-06 23:18:43'),
(122, '8', '54', '3', '22', '1', '', '2013-05-06 23:18:43'),
(123, '8', '54', '4', '23', '1', '', '2013-05-06 23:18:43'),
(124, '8', '54', '4', '24', '1', '', '2013-05-06 23:18:43'),
(125, '8', '54', '7', '25', '1', '', '2013-05-06 23:18:43'),
(126, '8', '54', '5', '26', '1', '', '2013-05-06 23:18:43'),
(127, '8', '55', '9', '58', '1', '', '2013-05-06 23:18:43'),
(128, '8', '56', '2', '67', '1', '', '2013-05-06 23:18:43'),
(129, '9', '57', '19', '2', '4', '', '2013-05-14 12:54:18'),
(130, '9', '57', '20', '6', '5', '', '2013-05-14 12:54:18'),
(131, '9', '57', '20', '7', '4', '', '2013-05-14 12:54:18'),
(132, '9', '57', '5', '8', '5', '', '2013-05-14 12:54:18'),
(133, '9', '57', '5', '9', '4', '', '2013-05-14 12:54:18'),
(134, '9', '58', '20', '5', '5', '', '2013-05-14 12:54:18'),
(135, '9', '59', '10', '18', '1', '', '2013-05-14 12:54:18'),
(136, '9', '60', '2', '19', '1', '', '2013-05-14 12:54:18'),
(137, '9', '61', '4', '21', '1', '', '2013-05-14 12:54:18'),
(138, '9', '61', '3', '22', '1', '', '2013-05-14 12:54:18'),
(139, '9', '61', '4', '23', '1', '', '2013-05-14 12:54:18'),
(140, '9', '61', '4', '24', '1', '', '2013-05-14 12:54:18'),
(141, '9', '61', '7', '25', '1', '', '2013-05-14 12:54:18'),
(142, '9', '61', '5', '26', '1', '', '2013-05-14 12:54:18'),
(143, '9', '62', '9', '58', '1', '', '2013-05-14 12:54:18'),
(144, '9', '63', '2', '67', '1', '', '2013-05-14 12:54:18'),
(145, '10', '64', '20', '34', '1', '', '2013-05-14 15:43:36'),
(146, '10', '65', '15', '36', '1', '', '2013-05-14 15:43:36'),
(147, '10', '65', '15', '38', '1', '', '2013-05-14 15:43:36'),
(148, '10', '65', '10', '39', '1', '', '2013-05-14 15:43:36'),
(149, '10', '66', '0', '40', '1', '', '2013-05-14 15:43:36'),
(150, '10', '67', '0', '41', '1', '', '2013-05-14 15:43:36'),
(151, '10', '68', '40', '59', '1', '', '2013-05-14 15:43:37'),
(152, '11', '69', '20', '34', '1', '', '2013-05-15 13:01:48'),
(153, '11', '70', '15', '36', '1', '', '2013-05-15 13:01:48'),
(154, '11', '70', '15', '38', '1', '', '2013-05-15 13:01:48'),
(155, '11', '70', '10', '39', '1', '', '2013-05-15 13:01:48'),
(156, '11', '71', '0', '40', '1', '', '2013-05-15 13:01:48'),
(157, '11', '72', '0', '41', '1', '', '2013-05-15 13:01:48'),
(158, '11', '73', '40', '59', '1', '', '2013-05-15 13:01:48'),
(159, '12', '74', '19', '2', '4', '', '2013-05-18 01:13:34'),
(160, '12', '74', '20', '6', '5', '', '2013-05-18 01:13:34'),
(161, '12', '74', '20', '7', '4', '', '2013-05-18 01:13:34'),
(162, '12', '74', '5', '8', '5', '', '2013-05-18 01:13:34'),
(163, '12', '74', '5', '9', '4', '', '2013-05-18 01:13:34'),
(164, '12', '75', '20', '5', '5', '', '2013-05-18 01:13:34'),
(165, '12', '76', '10', '18', '1', '', '2013-05-18 01:13:34'),
(166, '12', '77', '2', '19', '1', '', '2013-05-18 01:13:35'),
(167, '12', '78', '4', '21', '1', '', '2013-05-18 01:13:35'),
(168, '12', '78', '3', '22', '1', '', '2013-05-18 01:13:35'),
(169, '12', '78', '4', '23', '1', '', '2013-05-18 01:13:35'),
(170, '12', '78', '4', '24', '1', '', '2013-05-18 01:13:35'),
(171, '12', '78', '7', '25', '1', '', '2013-05-18 01:13:35'),
(172, '12', '78', '5', '26', '1', '', '2013-05-18 01:13:35'),
(173, '12', '79', '9', '58', '1', '', '2013-05-18 01:13:35'),
(174, '12', '80', '2', '67', '1', '', '2013-05-18 01:13:35'),
(175, '13', '81', '5', '27', '1', '', '2013-05-18 12:30:10'),
(176, '13', '82', '5', '28', '1', '', '2013-05-18 12:30:10'),
(177, '13', '83', '10', '29', '1', '', '2013-05-18 12:30:10'),
(178, '13', '83', '10', '30', '1', '', '2013-05-18 12:30:10'),
(179, '13', '83', '10', '31', '1', '', '2013-05-18 12:30:11'),
(180, '13', '84', '5', '32', '1', '', '2013-05-18 12:30:11'),
(181, '13', '84', '5', '33', '1', '', '2013-05-18 12:30:11'),
(182, '13', '84', '5', '37', '1', '', '2013-05-18 12:30:11'),
(183, '13', '84', '5', '43', '1', '', '2013-05-18 12:30:11'),
(184, '14', '85', '10', '4', '1', '', '2013-05-27 17:41:31'),
(185, '14', '86', '5', '10', '0', '', '2013-05-27 17:41:31'),
(186, '14', '86', '0', '11', '0', '', '2013-05-27 17:41:31'),
(187, '14', '86', '5', '12', '0', '', '2013-05-27 17:41:31'),
(188, '14', '86', '3', '13', '0', '', '2013-05-27 17:41:31'),
(189, '14', '87', '0', '14', '0', '', '2013-05-27 17:41:31'),
(190, '14', '87', '0', '15', '1', '', '2013-05-27 17:41:31'),
(191, '14', '87', '0', '16', '1', '', '2013-05-27 17:41:31'),
(192, '14', '87', '0', '17', '1', '', '2013-05-27 17:41:31'),
(193, '14', '88', '10', '70', '0', '', '2013-05-27 17:41:31'),
(194, '14', '88', '10', '76', '0', '', '2013-05-27 17:41:32'),
(195, '15', '89', '30', '34', '1', '', '2013-06-18 11:17:35'),
(196, '15', '90', '15', '36', '1', '', '2013-06-18 11:17:35'),
(197, '15', '90', '15', '38', '1', '', '2013-06-18 11:17:35'),
(198, '15', '90', '10', '39', '1', '', '2013-06-18 11:17:35'),
(199, '15', '91', '0', '40', '1', '', '2013-06-18 11:17:35'),
(200, '15', '92', '0', '41', '1', '', '2013-06-18 11:17:35'),
(201, '15', '93', '30', '59', '1', '', '2013-06-18 11:17:35'),
(202, '16', '94', '30', '34', '1', '', '2013-06-18 11:21:05'),
(203, '16', '95', '15', '36', '1', '', '2013-06-18 11:21:05'),
(204, '16', '95', '15', '38', '1', '', '2013-06-18 11:21:05'),
(205, '16', '95', '10', '39', '1', '', '2013-06-18 11:21:05'),
(206, '16', '96', '0', '40', '1', '', '2013-06-18 11:21:05'),
(207, '16', '97', '0', '41', '1', '', '2013-06-18 11:21:05'),
(208, '16', '98', '30', '59', '1', '', '2013-06-18 11:21:05'),
(209, '17', '99', '19', '2', '4', '', '2013-06-19 01:22:36'),
(210, '17', '99', '20', '6', '5', '', '2013-06-19 01:22:36'),
(211, '17', '99', '20', '7', '4', '', '2013-06-19 01:22:36'),
(212, '17', '99', '5', '8', '5', '', '2013-06-19 01:22:36'),
(213, '17', '99', '5', '9', '4', '', '2013-06-19 01:22:36'),
(214, '17', '100', '20', '5', '5', '', '2013-06-19 01:22:36'),
(215, '17', '101', '10', '18', '1', '', '2013-06-19 01:22:36'),
(216, '17', '102', '2', '19', '1', '', '2013-06-19 01:22:36'),
(217, '17', '103', '4', '21', '1', '', '2013-06-19 01:22:36'),
(218, '17', '103', '3', '22', '1', '', '2013-06-19 01:22:36'),
(219, '17', '103', '4', '23', '1', '', '2013-06-19 01:22:36'),
(220, '17', '103', '4', '24', '1', '', '2013-06-19 01:22:36'),
(221, '17', '103', '7', '25', '1', '', '2013-06-19 01:22:36'),
(222, '17', '103', '5', '26', '1', '', '2013-06-19 01:22:36'),
(223, '17', '104', '9', '58', '1', '', '2013-06-19 01:22:36'),
(224, '17', '105', '2', '67', '1', '', '2013-06-19 01:22:36'),
(225, '18', '106', '19', '2', '4', '', '2013-06-19 11:56:04'),
(226, '18', '106', '20', '6', '5', '', '2013-06-19 11:56:04'),
(227, '18', '106', '20', '7', '4', '', '2013-06-19 11:56:04'),
(228, '18', '106', '5', '8', '5', '', '2013-06-19 11:56:04'),
(229, '18', '106', '5', '9', '4', '', '2013-06-19 11:56:04'),
(230, '18', '107', '20', '5', '5', '', '2013-06-19 11:56:04'),
(231, '18', '108', '10', '18', '1', '', '2013-06-19 11:56:04'),
(232, '18', '109', '2', '19', '1', '', '2013-06-19 11:56:04'),
(233, '18', '110', '4', '21', '1', '', '2013-06-19 11:56:04'),
(234, '18', '110', '3', '22', '1', '', '2013-06-19 11:56:05'),
(235, '18', '110', '4', '23', '1', '', '2013-06-19 11:56:05'),
(236, '18', '110', '4', '24', '1', '', '2013-06-19 11:56:05'),
(237, '18', '110', '7', '25', '1', '', '2013-06-19 11:56:05'),
(238, '18', '110', '5', '26', '1', '', '2013-06-19 11:56:05'),
(239, '18', '111', '9', '58', '1', '', '2013-06-19 11:56:05'),
(240, '18', '112', '11', '67', '1', '', '2013-06-19 11:56:05'),
(241, '19', '113', '1', '2', '4', '', '2013-06-24 18:59:13'),
(242, '19', '113', '1', '6', '5', '', '2013-06-24 18:59:13'),
(243, '19', '113', '1', '7', '4', '', '2013-06-24 18:59:13'),
(244, '19', '113', '1', '8', '5', '', '2013-06-24 18:59:13'),
(245, '19', '113', '1', '9', '4', '', '2013-06-24 18:59:13'),
(246, '19', '114', '1', '5', '5', '', '2013-06-24 18:59:13'),
(247, '19', '115', '1', '18', '1', '', '2013-06-24 18:59:13'),
(248, '19', '116', '1', '19', '1', '', '2013-06-24 18:59:13'),
(249, '19', '117', '1', '21', '1', '', '2013-06-24 18:59:13'),
(250, '19', '117', '1', '22', '1', '', '2013-06-24 18:59:13'),
(251, '19', '117', '1', '23', '1', '', '2013-06-24 18:59:13'),
(252, '19', '117', '1', '24', '1', '', '2013-06-24 18:59:13'),
(253, '19', '117', '1', '25', '1', '', '2013-06-24 18:59:13'),
(254, '19', '117', '1', '26', '1', '', '2013-06-24 18:59:13'),
(255, '19', '118', '1', '58', '1', '', '2013-06-24 18:59:13'),
(256, '19', '119', '1', '67', '1', '', '2013-06-24 18:59:13'),
(257, '20', '120', '30', '34', '1', '', '2013-06-27 16:49:45'),
(258, '20', '121', '15', '36', '1', '', '2013-06-27 16:49:45'),
(259, '20', '121', '15', '38', '1', '', '2013-06-27 16:49:45'),
(260, '20', '121', '10', '39', '1', '', '2013-06-27 16:49:45'),
(261, '20', '122', '0', '40', '1', '', '2013-06-27 16:49:45'),
(262, '20', '123', '0', '41', '1', '', '2013-06-27 16:49:45'),
(263, '20', '124', '30', '59', '1', '', '2013-06-27 16:49:45'),
(264, '21', '125', '1', '65', '1', '', '2013-06-29 15:38:38'),
(265, '21', '126', '40', '20', '1', '', '2013-06-29 15:38:38'),
(266, '21', '127', '15', '42', '1', '', '2013-06-29 15:38:38'),
(267, '21', '127', '15', '44', '1', '', '2013-06-29 15:38:38'),
(268, '21', '127', '10', '45', '1', '', '2013-06-29 15:38:38'),
(269, '21', '128', '1', '66', '1', '', '2013-06-29 15:38:38'),
(270, '21', '129', '30', '82', '0', '', '2013-06-29 15:38:38'),
(271, '22', '130', '0', '65', '1', '', '2013-06-29 16:54:48'),
(272, '22', '131', '30', '20', '1', '', '2013-06-29 16:54:48'),
(273, '22', '132', '15', '42', '1', '', '2013-06-29 16:54:48'),
(274, '22', '132', '15', '44', '1', '', '2013-06-29 16:54:48'),
(275, '22', '132', '10', '45', '1', '', '2013-06-29 16:54:48'),
(276, '22', '133', '0', '66', '1', '', '2013-06-29 16:54:48'),
(277, '22', '134', '30', '82', '0', '', '2013-06-29 16:54:48'),
(278, '23', '135', '30', '34', '1', '', '2013-06-29 16:56:51'),
(279, '23', '136', '15', '36', '1', '', '2013-06-29 16:56:52'),
(280, '23', '136', '15', '38', '1', '', '2013-06-29 16:56:52'),
(281, '23', '136', '10', '39', '1', '', '2013-06-29 16:56:52'),
(282, '23', '137', '0', '40', '1', '', '2013-06-29 16:56:52'),
(283, '23', '138', '0', '41', '1', '', '2013-06-29 16:56:53'),
(284, '23', '139', '30', '59', '1', '', '2013-06-29 16:56:53'),
(285, '24', '140', '30', '27', '1', '', '2013-06-29 17:04:18'),
(286, '24', '141', '30', '28', '1', '', '2013-06-29 17:04:18'),
(287, '24', '142', '15', '29', '1', '', '2013-06-29 17:04:18'),
(288, '24', '142', '15', '30', '1', '', '2013-06-29 17:04:18'),
(289, '24', '142', '10', '31', '1', '', '2013-06-29 17:04:18'),
(290, '24', '143', '0', '32', '1', '', '2013-06-29 17:04:18'),
(291, '24', '143', '0', '33', '1', '', '2013-06-29 17:04:18'),
(292, '24', '143', '0', '37', '1', '', '2013-06-29 17:04:18'),
(293, '24', '143', '0', '43', '1', '', '2013-06-29 17:04:18'),
(294, '25', '144', '15', '46', '1', '', '2013-06-29 17:09:36'),
(295, '25', '144', '15', '49', '1', '', '2013-06-29 17:09:36'),
(296, '25', '145', '10', '48', '1', '', '2013-06-29 17:09:36'),
(297, '25', '145', '5', '50', '1', '', '2013-06-29 17:09:36'),
(298, '25', '145', '5', '51', '1', '', '2013-06-29 17:09:36'),
(299, '25', '145', '5', '52', '1', '', '2013-06-29 17:09:36'),
(300, '25', '145', '5', '53', '1', '', '2013-06-29 17:09:36'),
(301, '25', '146', '0', '62', '1', '', '2013-06-29 17:09:36'),
(302, '25', '146', '0', '64', '1', '', '2013-06-29 17:09:36'),
(303, '25', '147', '0', '69', '1', '', '2013-06-29 17:09:36'),
(304, '25', '148', '0', '71', '0', '', '2013-06-29 17:09:36'),
(305, '25', '148', '0', '72', '0', '', '2013-06-29 17:09:36'),
(306, '25', '148', '0', '73', '0', '', '2013-06-29 17:09:36'),
(307, '25', '148', '0', '74', '0', '', '2013-06-29 17:09:36'),
(308, '25', '148', '0', '75', '0', '', '2013-06-29 17:09:36'),
(309, '25', '149', '15', '77', '0', '', '2013-06-29 17:09:36'),
(310, '25', '149', '15', '79', '0', '', '2013-06-29 17:09:36'),
(311, '26', '150', '18', '46', '1', '', '2013-06-29 17:15:57'),
(312, '26', '150', '15', '49', '1', '', '2013-06-29 17:15:57'),
(313, '26', '151', '10', '48', '1', '', '2013-06-29 17:15:57'),
(314, '26', '151', '5', '50', '1', '', '2013-06-29 17:15:57'),
(315, '26', '151', '5', '51', '1', '', '2013-06-29 17:15:57'),
(316, '26', '151', '5', '52', '1', '', '2013-06-29 17:15:57'),
(317, '26', '151', '10', '53', '1', '', '2013-06-29 17:15:57'),
(318, '26', '152', '0', '62', '1', '', '2013-06-29 17:15:57'),
(319, '26', '152', '0', '64', '1', '', '2013-06-29 17:15:57'),
(320, '26', '153', '0', '69', '1', '', '2013-06-29 17:15:57'),
(321, '26', '154', '0', '71', '0', '', '2013-06-29 17:15:57'),
(322, '26', '154', '0', '72', '0', '', '2013-06-29 17:15:57'),
(323, '26', '154', '0', '73', '0', '', '2013-06-29 17:15:57'),
(324, '26', '154', '0', '74', '0', '', '2013-06-29 17:15:57'),
(325, '26', '154', '0', '75', '0', '', '2013-06-29 17:15:57'),
(326, '26', '155', '17', '77', '0', '', '2013-06-29 17:15:57'),
(327, '26', '155', '15', '79', '0', '', '2013-06-29 17:15:58'),
(328, '27', '156', '40', '4', '1', '', '2013-06-29 17:22:13'),
(329, '27', '157', '5', '10', '0', '', '2013-06-29 17:22:13'),
(330, '27', '157', '5', '11', '0', '', '2013-06-29 17:22:13'),
(331, '27', '157', '5', '12', '0', '', '2013-06-29 17:22:14'),
(332, '27', '157', '5', '13', '0', '', '2013-06-29 17:22:14'),
(333, '27', '158', '0', '14', '0', '', '2013-06-29 17:22:14'),
(334, '27', '158', '0', '15', '1', '', '2013-06-29 17:22:14'),
(335, '27', '158', '0', '16', '1', '', '2013-06-29 17:22:14'),
(336, '27', '158', '0', '17', '1', '', '2013-06-29 17:22:14'),
(337, '27', '159', '20', '70', '0', '', '2013-06-29 17:22:14'),
(338, '27', '159', '20', '76', '0', '', '2013-06-29 17:22:14'),
(339, '28', '160', '5', '2', '1', '', '2013-06-29 17:50:27'),
(340, '28', '160', '5', '6', '1', '', '2013-06-29 17:50:27'),
(341, '28', '160', '5', '7', '1', '', '2013-06-29 17:50:28'),
(342, '28', '160', '5', '8', '1', '', '2013-06-29 17:50:28'),
(343, '28', '160', '5', '9', '1', '', '2013-06-29 17:50:28'),
(344, '28', '161', '50', '5', '5', '', '2013-06-29 17:50:28'),
(345, '28', '162', '10', '18', '1', '', '2013-06-29 17:50:28'),
(346, '28', '163', '20', '19', '1', '', '2013-06-29 17:50:28'),
(347, '28', '164', '0', '21', '1', '', '2013-06-29 17:50:28'),
(348, '28', '164', '0', '22', '1', '', '2013-06-29 17:50:29'),
(349, '28', '164', '0', '23', '1', '', '2013-06-29 17:50:29'),
(350, '28', '164', '10', '24', '1', '', '2013-06-29 17:50:29'),
(351, '28', '164', '10', '25', '1', '', '2013-06-29 17:50:29'),
(352, '28', '164', '0', '26', '1', '', '2013-06-29 17:50:29'),
(353, '28', '165', '0', '58', '1', '', '2013-06-29 17:50:29'),
(354, '28', '166', '25', '67', '1', '', '2013-06-29 17:50:29'),
(355, '29', '167', '5', '2', '1', '', '2013-06-29 17:52:32'),
(356, '29', '167', '5', '6', '1', '', '2013-06-29 17:52:32'),
(357, '29', '167', '5', '7', '1', '', '2013-06-29 17:52:32'),
(358, '29', '167', '5', '8', '1', '', '2013-06-29 17:52:32'),
(359, '29', '167', '5', '9', '1', '', '2013-06-29 17:52:32'),
(360, '29', '168', '0', '5', '5', '', '2013-06-29 17:52:32'),
(361, '29', '169', '10', '18', '1', '', '2013-06-29 17:52:32'),
(362, '29', '170', '20', '19', '1', '', '2013-06-29 17:52:33'),
(363, '29', '171', '0', '21', '1', '', '2013-06-29 17:52:33'),
(364, '29', '171', '0', '22', '1', '', '2013-06-29 17:52:33'),
(365, '29', '171', '0', '23', '1', '', '2013-06-29 17:52:33'),
(366, '29', '171', '10', '24', '1', '', '2013-06-29 17:52:33'),
(367, '29', '171', '10', '25', '1', '', '2013-06-29 17:52:33'),
(368, '29', '171', '0', '26', '1', '', '2013-06-29 17:52:33'),
(369, '29', '172', '40', '58', '1', '', '2013-06-29 17:52:33'),
(370, '29', '173', '25', '67', '1', '', '2013-06-29 17:52:33'),
(371, '30', '174', '0', '54', '1', '', '2013-06-29 17:55:08'),
(372, '30', '174', '0', '55', '1', '', '2013-06-29 17:55:08'),
(373, '30', '174', '0', '56', '1', '', '2013-06-29 17:55:08'),
(374, '30', '174', '0', '57', '1', '', '2013-06-29 17:55:08'),
(375, '30', '175', '20', '78', '0', '', '2013-06-29 17:55:08'),
(376, '30', '176', '20', '80', '0', '', '2013-06-29 17:55:08'),
(377, '30', '177', '30', '83', '0', '', '2013-06-29 17:55:08'),
(378, '30', '177', '30', '84', '0', '', '2013-06-29 17:55:08'),
(379, '31', '178', '15', '54', '1', '', '2013-06-29 17:57:32'),
(380, '31', '178', '15', '55', '1', '', '2013-06-29 17:57:32'),
(381, '31', '178', '15', '56', '1', '', '2013-06-29 17:57:32'),
(382, '31', '178', '15', '57', '1', '', '2013-06-29 17:57:32'),
(383, '31', '179', '20', '78', '0', '', '2013-06-29 17:57:32'),
(384, '31', '180', '20', '80', '0', '', '2013-06-29 17:57:32'),
(385, '31', '181', '0', '83', '0', '', '2013-06-29 17:57:32'),
(386, '31', '181', '0', '84', '0', '', '2013-06-29 17:57:32'),
(387, '32', '182', '446', '34', '1', '', '2013-06-29 20:16:53'),
(388, '32', '183', '0', '36', '1', '', '2013-06-29 20:16:53'),
(389, '32', '183', '0', '38', '1', '', '2013-06-29 20:16:53'),
(390, '32', '183', '0', '39', '1', '', '2013-06-29 20:16:53'),
(391, '32', '184', '0', '40', '1', '', '2013-06-29 20:16:53'),
(392, '32', '185', '0', '41', '1', '', '2013-06-29 20:16:53'),
(393, '32', '186', '0', '59', '1', '', '2013-06-29 20:16:53'),
(394, '33', '187', '30', '90', '0', '', '2013-06-29 20:52:43'),
(395, '33', '188', '18', '97', '0', '', '2013-06-29 20:52:43'),
(396, '34', '189', '30', '90', '0', '', '2013-06-29 20:57:15'),
(397, '34', '190', '18', '97', '0', '', '2013-06-29 20:57:15'),
(398, '35', '191', '10', '27', '1', '', '2013-06-29 20:59:33'),
(399, '35', '192', '10', '28', '1', '', '2013-06-29 20:59:33'),
(400, '35', '193', '10', '29', '1', '', '2013-06-29 20:59:33'),
(401, '35', '193', '10', '30', '1', '', '2013-06-29 20:59:33'),
(402, '35', '193', '10', '31', '1', '', '2013-06-29 20:59:33'),
(403, '35', '194', '10', '32', '1', '', '2013-06-29 20:59:33'),
(404, '35', '194', '10', '33', '1', '', '2013-06-29 20:59:34'),
(405, '35', '194', '10', '37', '1', '', '2013-06-29 20:59:34'),
(406, '35', '194', '10', '43', '1', '', '2013-06-29 20:59:34'),
(407, '36', '195', '15', '34', '1', '', '2013-07-20 08:58:37'),
(408, '36', '196', '23', '36', '1', '', '2013-07-20 08:58:37'),
(409, '36', '196', '19', '38', '1', '', '2013-07-20 08:58:37'),
(410, '36', '196', '19', '39', '1', '', '2013-07-20 08:58:37'),
(411, '36', '197', '0', '40', '1', '', '2013-07-20 08:58:37'),
(412, '36', '198', '0', '41', '1', '', '2013-07-20 08:58:37'),
(413, '36', '199', '50', '59', '1', '', '2013-07-20 08:58:37'),
(414, '37', '200', '15', '34', '1', '', '2013-07-20 09:13:29'),
(415, '37', '201', '23', '36', '1', '', '2013-07-20 09:13:29'),
(416, '37', '201', '19', '38', '1', '', '2013-07-20 09:13:29'),
(417, '37', '201', '19', '39', '1', '', '2013-07-20 09:13:29'),
(418, '37', '202', '0', '40', '1', '', '2013-07-20 09:13:29'),
(419, '37', '203', '0', '41', '1', '', '2013-07-20 09:13:29'),
(420, '37', '204', '50', '59', '1', '', '2013-07-20 09:13:29'),
(421, '38', '205', '25', '65', '1', '', '2013-07-20 09:14:41'),
(422, '38', '206', '30', '20', '1', '', '2013-07-20 09:14:41'),
(423, '38', '207', '15', '42', '1', '', '2013-07-20 09:14:41'),
(424, '38', '207', '15', '44', '1', '', '2013-07-20 09:14:41'),
(425, '38', '207', '10', '45', '1', '', '2013-07-20 09:14:42'),
(426, '38', '208', '15', '66', '1', '', '2013-07-20 09:14:42'),
(427, '38', '209', '30', '82', '0', '', '2013-07-20 09:14:42'),
(428, '39', '210', '25', '65', '1', '', '2013-07-20 09:15:42'),
(429, '39', '211', '30', '20', '1', '', '2013-07-20 09:15:42'),
(430, '39', '212', '15', '42', '1', '', '2013-07-20 09:15:42'),
(431, '39', '212', '15', '44', '1', '', '2013-07-20 09:15:43'),
(432, '39', '212', '10', '45', '1', '', '2013-07-20 09:15:43'),
(433, '39', '213', '15', '66', '1', '', '2013-07-20 09:15:43'),
(434, '39', '214', '30', '82', '0', '', '2013-07-20 09:15:43'),
(435, '40', '215', '60', '27', '1', '', '2013-07-20 09:21:19'),
(436, '40', '216', '30', '28', '1', '', '2013-07-20 09:21:20'),
(437, '40', '217', '15', '29', '1', '', '2013-07-20 09:21:20'),
(438, '40', '217', '16', '30', '1', '', '2013-07-20 09:21:20'),
(439, '40', '217', '18', '31', '1', '', '2013-07-20 09:21:20'),
(440, '40', '218', '0', '32', '1', '', '2013-07-20 09:21:20'),
(441, '40', '218', '0', '33', '1', '', '2013-07-20 09:21:20'),
(442, '40', '218', '0', '37', '1', '', '2013-07-20 09:21:20'),
(443, '40', '218', '0', '43', '1', '', '2013-07-20 09:21:20'),
(444, '41', '219', '20', '46', '1', '', '2013-07-20 09:25:24'),
(445, '41', '219', '20', '49', '1', '', '2013-07-20 09:25:24'),
(446, '41', '220', '20', '48', '1', '', '2013-07-20 09:25:24'),
(447, '41', '220', '20', '50', '1', '', '2013-07-20 09:25:24'),
(448, '41', '220', '20', '51', '1', '', '2013-07-20 09:25:24'),
(449, '41', '220', '20', '52', '1', '', '2013-07-20 09:25:24'),
(450, '41', '220', '20', '53', '1', '', '2013-07-20 09:25:24'),
(451, '41', '221', '13', '62', '1', '', '2013-07-20 09:25:24'),
(452, '41', '221', '19', '64', '1', '', '2013-07-20 09:25:24'),
(453, '41', '222', '15', '69', '1', '', '2013-07-20 09:25:24'),
(454, '41', '223', '15', '71', '0', '', '2013-07-20 09:25:24'),
(455, '41', '223', '15', '72', '0', '', '2013-07-20 09:25:24'),
(456, '41', '223', '14', '73', '0', '', '2013-07-20 09:25:24'),
(457, '41', '223', '17', '74', '0', '', '2013-07-20 09:25:24'),
(458, '41', '223', '19', '75', '0', '', '2013-07-20 09:25:25'),
(459, '41', '224', '17', '77', '0', '', '2013-07-20 09:25:25'),
(460, '41', '224', '15', '79', '0', '', '2013-07-20 09:25:25'),
(461, '42', '225', '40', '4', '1', '', '2013-07-20 09:36:11'),
(462, '42', '226', '5', '10', '0', '', '2013-07-20 09:36:11'),
(463, '42', '226', '19', '11', '0', '', '2013-07-20 09:36:11'),
(464, '42', '226', '5', '12', '0', '', '2013-07-20 09:36:11'),
(465, '42', '226', '18', '13', '0', '', '2013-07-20 09:36:11'),
(466, '42', '227', '0', '14', '0', '', '2013-07-20 09:36:11'),
(467, '42', '227', '0', '15', '1', '', '2013-07-20 09:36:11'),
(468, '42', '227', '0', '16', '1', '', '2013-07-20 09:36:11'),
(469, '42', '227', '0', '17', '1', '', '2013-07-20 09:36:11'),
(470, '42', '228', '45', '70', '0', '', '2013-07-20 09:36:11'),
(471, '42', '228', '51', '76', '0', '', '2013-07-20 09:36:11'),
(472, '43', '229', '40', '4', '1', '', '2013-07-20 09:44:50'),
(473, '43', '230', '17', '10', '0', '', '2013-07-20 09:44:50'),
(474, '43', '230', '19', '11', '0', '', '2013-07-20 09:44:50'),
(475, '43', '230', '19', '12', '0', '', '2013-07-20 09:44:51'),
(476, '43', '230', '18', '13', '0', '', '2013-07-20 09:44:51'),
(477, '43', '231', '0', '14', '0', '', '2013-07-20 09:44:51'),
(478, '43', '231', '0', '15', '1', '', '2013-07-20 09:44:51'),
(479, '43', '231', '0', '16', '1', '', '2013-07-20 09:44:51'),
(480, '43', '231', '0', '17', '1', '', '2013-07-20 09:44:51'),
(481, '43', '232', '45', '70', '0', '', '2013-07-20 09:44:52'),
(482, '43', '232', '51', '76', '0', '', '2013-07-20 09:44:52'),
(483, '44', '233', '15', '54', '1', '', '2013-07-20 09:48:19'),
(484, '44', '233', '15', '55', '1', '', '2013-07-20 09:48:19'),
(485, '44', '233', '15', '56', '1', '', '2013-07-20 09:48:19'),
(486, '44', '233', '15', '57', '1', '', '2013-07-20 09:48:19'),
(487, '44', '234', '20', '78', '0', '', '2013-07-20 09:48:19'),
(488, '44', '235', '20', '80', '0', '', '2013-07-20 09:48:19'),
(489, '44', '236', '49', '83', '0', '', '2013-07-20 09:48:19'),
(490, '44', '236', '18', '84', '0', '', '2013-07-20 09:48:20'),
(491, '45', '237', '30', '34', '1', '', '2013-07-25 15:30:28'),
(492, '45', '238', '15', '36', '1', '', '2013-07-25 15:30:29'),
(493, '45', '238', '15', '38', '1', '', '2013-07-25 15:30:29'),
(494, '45', '238', '10', '39', '1', '', '2013-07-25 15:30:29'),
(495, '45', '239', '0', '40', '1', '', '2013-07-25 15:30:29'),
(496, '45', '240', '0', '41', '1', '', '2013-07-25 15:30:29'),
(497, '45', '241', '30', '59', '1', '', '2013-07-25 15:30:29'),
(498, '46', '242', '0', '65', '1', '', '2013-07-25 15:36:09'),
(499, '46', '243', '30', '20', '1', '', '2013-07-25 15:36:09'),
(500, '46', '244', '15', '42', '1', '', '2013-07-25 15:36:10'),
(501, '46', '244', '15', '44', '1', '', '2013-07-25 15:36:10'),
(502, '46', '244', '10', '45', '1', '', '2013-07-25 15:36:10'),
(503, '46', '245', '0', '66', '1', '', '2013-07-25 15:36:10'),
(504, '46', '246', '30', '82', '0', '', '2013-07-25 15:36:10'),
(505, '47', '247', '0', '65', '1', '', '2013-07-25 16:37:57'),
(506, '47', '248', '30', '20', '1', '', '2013-07-25 16:37:57'),
(507, '47', '249', '15', '42', '1', '', '2013-07-25 16:37:57'),
(508, '47', '249', '15', '44', '1', '', '2013-07-25 16:37:57'),
(509, '47', '249', '10', '45', '1', '', '2013-07-25 16:37:57'),
(510, '47', '250', '0', '66', '1', '', '2013-07-25 16:37:57'),
(511, '47', '251', '30', '82', '0', '', '2013-07-25 16:37:57'),
(512, '48', '252', '30', '27', '1', '', '2013-07-25 16:40:21'),
(513, '48', '253', '30', '28', '1', '', '2013-07-25 16:40:21'),
(514, '48', '254', '15', '29', '1', '', '2013-07-25 16:40:21'),
(515, '48', '254', '15', '30', '1', '', '2013-07-25 16:40:21'),
(516, '48', '254', '10', '31', '1', '', '2013-07-25 16:40:21'),
(517, '48', '255', '0', '32', '1', '', '2013-07-25 16:40:21'),
(518, '48', '255', '0', '33', '1', '', '2013-07-25 16:40:21'),
(519, '48', '255', '0', '37', '1', '', '2013-07-25 16:40:21'),
(520, '48', '255', '0', '43', '1', '', '2013-07-25 16:40:21'),
(521, '49', '256', '15', '46', '1', '', '2013-07-25 16:44:01'),
(522, '49', '256', '15', '49', '1', '', '2013-07-25 16:44:01'),
(523, '49', '257', '0', '48', '1', '', '2013-07-25 16:44:01'),
(524, '49', '257', '0', '50', '1', '', '2013-07-25 16:44:01'),
(525, '49', '257', '0', '51', '1', '', '2013-07-25 16:44:01'),
(526, '49', '257', '0', '52', '1', '', '2013-07-25 16:44:01'),
(527, '49', '257', '0', '53', '1', '', '2013-07-25 16:44:01'),
(528, '49', '258', '0', '62', '1', '', '2013-07-25 16:44:01'),
(529, '49', '258', '0', '64', '1', '', '2013-07-25 16:44:01'),
(530, '49', '259', '0', '69', '1', '', '2013-07-25 16:44:01'),
(531, '49', '260', '10', '71', '0', '', '2013-07-25 16:44:01'),
(532, '49', '260', '5', '72', '0', '', '2013-07-25 16:44:01'),
(533, '49', '260', '5', '73', '0', '', '2013-07-25 16:44:01'),
(534, '49', '260', '10', '74', '0', '', '2013-07-25 16:44:01'),
(535, '49', '260', '10', '75', '0', '', '2013-07-25 16:44:01'),
(536, '49', '261', '15', '77', '0', '', '2013-07-25 16:44:01'),
(537, '49', '261', '15', '79', '0', '', '2013-07-25 16:44:01'),
(538, '50', '262', '30', '4', '1', '', '2013-07-25 16:48:03'),
(539, '50', '263', '5', '10', '0', '', '2013-07-25 16:48:04'),
(540, '50', '263', '5', '11', '0', '', '2013-07-25 16:48:04'),
(541, '50', '263', '5', '12', '0', '', '2013-07-25 16:48:04'),
(542, '50', '263', '5', '13', '0', '', '2013-07-25 16:48:04'),
(543, '50', '264', '5', '14', '0', '', '2013-07-25 16:48:04'),
(544, '50', '264', '5', '15', '1', '', '2013-07-25 16:48:04'),
(545, '50', '264', '0', '16', '1', '', '2013-07-25 16:48:04'),
(546, '50', '264', '0', '17', '1', '', '2013-07-25 16:48:04'),
(547, '50', '265', '15', '70', '0', '', '2013-07-25 16:48:04'),
(548, '50', '265', '15', '76', '0', '', '2013-07-25 16:48:04'),
(549, '51', '266', '5', '2', '1', '', '2013-07-25 16:51:47'),
(550, '51', '266', '5', '6', '1', '', '2013-07-25 16:51:47'),
(551, '51', '266', '5', '7', '1', '', '2013-07-25 16:51:47'),
(552, '51', '266', '5', '8', '1', '', '2013-07-25 16:51:47'),
(553, '51', '266', '5', '9', '1', '', '2013-07-25 16:51:47'),
(554, '51', '267', '50', '5', '5', '', '2013-07-25 16:51:47'),
(555, '51', '268', '0', '18', '1', '', '2013-07-25 16:51:47'),
(556, '51', '269', '0', '19', '1', '', '2013-07-25 16:51:48'),
(557, '51', '270', '0', '21', '1', '', '2013-07-25 16:51:48'),
(558, '51', '270', '0', '22', '1', '', '2013-07-25 16:51:48'),
(559, '51', '270', '0', '23', '1', '', '2013-07-25 16:51:48'),
(560, '51', '270', '0', '24', '1', '', '2013-07-25 16:51:48'),
(561, '51', '270', '0', '25', '1', '', '2013-07-25 16:51:48'),
(562, '51', '270', '0', '26', '1', '', '2013-07-25 16:51:48'),
(563, '51', '271', '0', '58', '1', '', '2013-07-25 16:51:48'),
(564, '51', '272', '25', '67', '1', '', '2013-07-25 16:51:48'),
(565, '52', '273', '5', '2', '1', '', '2013-07-25 16:54:14'),
(566, '52', '273', '5', '6', '1', '', '2013-07-25 16:54:14'),
(567, '52', '273', '5', '7', '1', '', '2013-07-25 16:54:14'),
(568, '52', '273', '5', '8', '1', '', '2013-07-25 16:54:14'),
(569, '52', '273', '5', '9', '1', '', '2013-07-25 16:54:14'),
(570, '52', '274', '0', '5', '5', '', '2013-07-25 16:54:14'),
(571, '52', '275', '0', '18', '1', '', '2013-07-25 16:54:14'),
(572, '52', '276', '0', '19', '1', '', '2013-07-25 16:54:14'),
(573, '52', '277', '0', '21', '1', '', '2013-07-25 16:54:14'),
(574, '52', '277', '0', '22', '1', '', '2013-07-25 16:54:14'),
(575, '52', '277', '0', '23', '1', '', '2013-07-25 16:54:14'),
(576, '52', '277', '0', '24', '1', '', '2013-07-25 16:54:14'),
(577, '52', '277', '0', '25', '1', '', '2013-07-25 16:54:14'),
(578, '52', '277', '0', '26', '1', '', '2013-07-25 16:54:14'),
(579, '52', '278', '50', '58', '1', '', '2013-07-25 16:54:14'),
(580, '52', '279', '25', '67', '1', '', '2013-07-25 16:54:14'),
(581, '53', '280', '0', '54', '1', '', '2013-07-25 16:55:51'),
(582, '53', '280', '0', '55', '1', '', '2013-07-25 16:55:52'),
(583, '53', '280', '0', '56', '1', '', '2013-07-25 16:55:52'),
(584, '53', '280', '0', '57', '1', '', '2013-07-25 16:55:52'),
(585, '53', '281', '20', '78', '0', '', '2013-07-25 16:55:52'),
(586, '53', '282', '20', '80', '0', '', '2013-07-25 16:55:52'),
(587, '53', '283', '25', '83', '0', '', '2013-07-25 16:55:52'),
(588, '53', '283', '25', '84', '0', '', '2013-07-25 16:55:52'),
(589, '54', '284', '10', '54', '1', '', '2013-07-25 16:57:23'),
(590, '54', '284', '10', '55', '1', '', '2013-07-25 16:57:23'),
(591, '54', '284', '10', '56', '1', '', '2013-07-25 16:57:23'),
(592, '54', '284', '20', '57', '1', '', '2013-07-25 16:57:23'),
(593, '54', '285', '20', '78', '0', '', '2013-07-25 16:57:23'),
(594, '54', '286', '20', '80', '0', '', '2013-07-25 16:57:23'),
(595, '54', '287', '0', '83', '0', '', '2013-07-25 16:57:23'),
(596, '54', '287', '0', '84', '0', '', '2013-07-25 16:57:24'),
(597, '55', '288', '30', '34', '1', '', '2013-08-17 10:13:02'),
(598, '55', '289', '15', '36', '1', '', '2013-08-17 10:13:02'),
(599, '55', '289', '15', '38', '1', '', '2013-08-17 10:13:02'),
(600, '55', '289', '10', '39', '1', '', '2013-08-17 10:13:02'),
(601, '55', '290', '0', '40', '1', '', '2013-08-17 10:13:02'),
(602, '55', '291', '0', '41', '1', '', '2013-08-17 10:13:02'),
(603, '55', '292', '30', '59', '1', '', '2013-08-17 10:13:02'),
(604, '56', '293', '25', '27', '1', '', '2013-08-17 10:15:29'),
(605, '56', '294', '25', '28', '1', '', '2013-08-17 10:15:29'),
(606, '56', '295', '15', '29', '1', '', '2013-08-17 10:15:29'),
(607, '56', '295', '15', '30', '1', '', '2013-08-17 10:15:29'),
(608, '56', '295', '10', '31', '1', '', '2013-08-17 10:15:29'),
(609, '56', '296', '5', '32', '1', '', '2013-08-17 10:15:29'),
(610, '56', '296', '0', '33', '1', '', '2013-08-17 10:15:30'),
(611, '56', '296', '0', '37', '1', '', '2013-08-17 10:15:30'),
(612, '56', '296', '5', '43', '1', '', '2013-08-17 10:15:30'),
(613, '57', '297', '0', '65', '26', '', '2013-08-17 10:16:36'),
(614, '57', '298', '30', '20', '1', '', '2013-08-17 10:16:36'),
(615, '57', '299', '15', '42', '1', '', '2013-08-17 10:16:37'),
(616, '57', '299', '15', '44', '1', '', '2013-08-17 10:16:37'),
(617, '57', '299', '10', '45', '1', '', '2013-08-17 10:16:37'),
(618, '57', '300', '0', '66', '1', '', '2013-08-17 10:16:37'),
(619, '57', '301', '30', '82', '0', '', '2013-08-17 10:16:37'),
(620, '58', '302', '1', '2', '1', '', '2013-08-27 00:10:59'),
(621, '58', '302', '1', '6', '1', '', '2013-08-27 00:10:59'),
(622, '58', '302', '5', '7', '1', '', '2013-08-27 00:10:59'),
(623, '58', '302', '5', '8', '1', '', '2013-08-27 00:10:59'),
(624, '58', '302', '5', '9', '1', '', '2013-08-27 00:10:59'),
(625, '58', '303', '0', '5', '5', '', '2013-08-27 00:11:00'),
(626, '58', '304', '0', '18', '1', '', '2013-08-27 00:11:00'),
(627, '58', '305', '0', '19', '1', '', '2013-08-27 00:11:00'),
(628, '58', '306', '0', '21', '1', '', '2013-08-27 00:11:00'),
(629, '58', '306', '0', '22', '1', '', '2013-08-27 00:11:00'),
(630, '58', '306', '0', '23', '1', '', '2013-08-27 00:11:00'),
(631, '58', '306', '0', '24', '1', '', '2013-08-27 00:11:00'),
(632, '58', '306', '0', '25', '1', '', '2013-08-27 00:11:00'),
(633, '58', '306', '0', '26', '1', '', '2013-08-27 00:11:00'),
(634, '58', '307', '50', '58', '1', '', '2013-08-27 00:11:00'),
(635, '58', '308', '25', '67', '1', '', '2013-08-27 00:11:00'),
(636, '59', '309', '5', '34', '1', '', '2013-10-31 17:27:52'),
(637, '59', '310', '5', '36', '1', '', '2013-10-31 17:27:52'),
(638, '59', '310', '5', '38', '1', '', '2013-10-31 17:27:52'),
(639, '59', '310', '5', '39', '1', '', '2013-10-31 17:27:52'),
(640, '59', '311', '5', '40', '1', '', '2013-10-31 17:27:52'),
(641, '59', '312', '5', '41', '1', '', '2013-10-31 17:27:52'),
(642, '59', '313', '5', '59', '1', '', '2013-10-31 17:27:52'),
(643, '60', '314', '15', '34', '1', '', '2013-12-28 12:57:32'),
(644, '60', '315', '5', '36', '1', '', '2013-12-28 12:57:33'),
(645, '60', '315', '19', '38', '1', '', '2013-12-28 12:57:33'),
(646, '60', '315', '5', '39', '1', '', '2013-12-28 12:57:33'),
(647, '60', '316', '5', '40', '1', '', '2013-12-28 12:57:33'),
(648, '60', '317', '5', '41', '1', '', '2013-12-28 12:57:34'),
(649, '60', '318', '5', '59', '1', '', '2013-12-28 12:57:34'),
(650, '61', '319', '30', '4', '1', '', '2014-01-20 17:41:16'),
(651, '61', '320', '5', '10', '0', '', '2014-01-20 17:41:16'),
(652, '61', '320', '5', '11', '0', '', '2014-01-20 17:41:16'),
(653, '61', '320', '5', '12', '0', '', '2014-01-20 17:41:16'),
(654, '61', '320', '0', '13', '0', '', '2014-01-20 17:41:16'),
(655, '61', '321', '5', '14', '0', '', '2014-01-20 17:41:17'),
(656, '61', '321', '5', '15', '1', '', '2014-01-20 17:41:17'),
(657, '61', '321', '0', '16', '1', '', '2014-01-20 17:41:17'),
(658, '61', '321', '0', '17', '1', '', '2014-01-20 17:41:17'),
(659, '61', '322', '15', '70', '0', '', '2014-01-20 17:41:18'),
(660, '61', '322', '15', '76', '0', '', '2014-01-20 17:41:18'),
(661, '62', '323', '10', '2', '1', '', '2014-03-21 23:29:56'),
(662, '62', '323', '10', '6', '1', '', '2014-03-21 23:29:57'),
(663, '62', '323', '0', '7', '1', '', '2014-03-21 23:29:57'),
(664, '62', '323', '0', '8', '1', '', '2014-03-21 23:29:57'),
(665, '62', '323', '4', '9', '1', '', '2014-03-21 23:29:57'),
(666, '62', '324', '3', '5', '5', '', '2014-03-21 23:29:58'),
(667, '62', '325', '0', '18', '1', '', '2014-03-21 23:30:00'),
(668, '62', '326', '0', '19', '1', '', '2014-03-21 23:30:01'),
(669, '62', '327', '0', '21', '1', '', '2014-03-21 23:30:01'),
(670, '62', '327', '0', '22', '1', '', '2014-03-21 23:30:02'),
(671, '62', '327', '0', '23', '1', '', '2014-03-21 23:30:02'),
(672, '62', '327', '0', '24', '1', '', '2014-03-21 23:30:02'),
(673, '62', '327', '0', '25', '1', '', '2014-03-21 23:30:03'),
(674, '62', '327', '0', '26', '1', '', '2014-03-21 23:30:03'),
(675, '62', '328', '14', '58', '1', '', '2014-03-21 23:30:04'),
(676, '62', '329', '11', '67', '1', '', '2014-03-21 23:30:05'),
(677, '63', '330', '0', '2', '1', '', '2014-03-30 17:47:49'),
(678, '63', '330', '0', '6', '1', '', '2014-03-30 17:47:49'),
(679, '63', '330', '0', '7', '1', '', '2014-03-30 17:47:50'),
(680, '63', '330', '0', '8', '1', '', '2014-03-30 17:47:50'),
(681, '63', '330', '0', '9', '1', '', '2014-03-30 17:47:50'),
(682, '63', '331', '87', '5', '5', '', '2014-03-30 17:47:50'),
(683, '63', '332', '0', '18', '1', '', '2014-03-30 17:47:51'),
(684, '63', '333', '0', '19', '1', '', '2014-03-30 17:47:52'),
(685, '63', '334', '0', '21', '1', '', '2014-03-30 17:47:52'),
(686, '63', '334', '0', '22', '1', '', '2014-03-30 17:47:53'),
(687, '63', '334', '0', '23', '1', '', '2014-03-30 17:47:53'),
(688, '63', '334', '0', '24', '1', '', '2014-03-30 17:47:53'),
(689, '63', '334', '0', '25', '1', '', '2014-03-30 17:47:53'),
(690, '63', '334', '0', '26', '1', '', '2014-03-30 17:47:53'),
(691, '63', '335', '14', '58', '1', '', '2014-03-30 17:47:54'),
(692, '63', '336', '11', '67', '1', '', '2014-03-30 17:47:55'),
(693, '64', '337', '0', '2', '1', '', '2014-04-04 12:26:44'),
(694, '64', '337', '0', '6', '1', '', '2014-04-04 12:26:44'),
(695, '64', '337', '0', '7', '1', '', '2014-04-04 12:26:44'),
(696, '64', '337', '0', '8', '1', '', '2014-04-04 12:26:44'),
(697, '64', '337', '0', '9', '1', '', '2014-04-04 12:26:44'),
(698, '64', '338', '0', '5', '5', '', '2014-04-04 12:26:45'),
(699, '64', '339', '0', '18', '1', '', '2014-04-04 12:26:46'),
(700, '64', '340', '200', '19', '1', '', '2014-04-04 12:26:46'),
(701, '64', '341', '0', '21', '1', '', '2014-04-04 12:26:46'),
(702, '64', '341', '0', '22', '1', '', '2014-04-04 12:26:47'),
(703, '64', '341', '0', '23', '1', '', '2014-04-04 12:26:47'),
(704, '64', '341', '0', '24', '1', '', '2014-04-04 12:26:47'),
(705, '64', '341', '0', '25', '1', '', '2014-04-04 12:26:47'),
(706, '64', '341', '0', '26', '1', '', '2014-04-04 12:26:47'),
(707, '64', '342', '0', '58', '1', '', '2014-04-04 12:26:48'),
(708, '64', '343', '0', '67', '1', '', '2014-04-04 12:26:48'),
(709, '65', '344', '0', '2', '1', '', '2014-04-04 12:27:45'),
(710, '65', '344', '0', '6', '1', '', '2014-04-04 12:27:45'),
(711, '65', '344', '0', '7', '1', '', '2014-04-04 12:27:45'),
(712, '65', '344', '0', '8', '1', '', '2014-04-04 12:27:45'),
(713, '65', '344', '0', '9', '1', '', '2014-04-04 12:27:45'),
(714, '65', '345', '0', '5', '5', '', '2014-04-04 12:27:46'),
(715, '65', '346', '0', '18', '1', '', '2014-04-04 12:27:47'),
(716, '65', '347', '199', '19', '1', '', '2014-04-04 12:27:49'),
(717, '65', '348', '0', '21', '1', '', '2014-04-04 12:27:49'),
(718, '65', '348', '0', '22', '1', '', '2014-04-04 12:27:50'),
(719, '65', '348', '0', '23', '1', '', '2014-04-04 12:27:50'),
(720, '65', '348', '0', '24', '1', '', '2014-04-04 12:27:50'),
(721, '65', '348', '0', '25', '1', '', '2014-04-04 12:27:50'),
(722, '65', '348', '0', '26', '1', '', '2014-04-04 12:27:50'),
(723, '65', '349', '0', '58', '1', '', '2014-04-04 12:27:51'),
(724, '65', '350', '0', '67', '1', '', '2014-04-04 12:27:52'),
(725, '66', '351', '9', '2', '1', '', '2014-05-13 13:19:40'),
(726, '66', '351', '0', '6', '1', '', '2014-05-13 13:19:40'),
(727, '66', '351', '0', '7', '1', '', '2014-05-13 13:19:40'),
(728, '66', '351', '0', '8', '1', '', '2014-05-13 13:19:40'),
(729, '66', '351', '0', '9', '1', '', '2014-05-13 13:19:41'),
(730, '66', '352', '0', '5', '5', '', '2014-05-13 13:19:41'),
(731, '66', '353', '0', '18', '1', '', '2014-05-13 13:19:42'),
(732, '66', '354', '185', '19', '12', '', '2014-05-13 13:19:43'),
(733, '66', '355', '0', '21', '1', '', '2014-05-13 13:19:43'),
(734, '66', '355', '0', '22', '1', '', '2014-05-13 13:19:44'),
(735, '66', '355', '0', '23', '1', '', '2014-05-13 13:19:45'),
(736, '66', '355', '0', '24', '1', '', '2014-05-13 13:19:45'),
(737, '66', '355', '0', '25', '1', '', '2014-05-13 13:19:45'),
(738, '66', '355', '0', '26', '1', '', '2014-05-13 13:19:45'),
(739, '66', '356', '0', '58', '1', '', '2014-05-13 13:19:46'),
(740, '66', '357', '0', '67', '1', '', '2014-05-13 13:19:47'),
(741, '67', '358', '2', '2', '1', '', '2014-08-04 13:47:35'),
(742, '67', '358', '2', '6', '1', '', '2014-08-04 13:47:35'),
(743, '67', '358', '0', '7', '1', '', '2014-08-04 13:47:36'),
(744, '67', '358', '0', '8', '1', '', '2014-08-04 13:47:36'),
(745, '67', '358', '0', '9', '1', '', '2014-08-04 13:47:36'),
(746, '67', '359', '5', '5', '5', '', '2014-08-04 13:47:36'),
(747, '67', '360', '0', '18', '1', '', '2014-08-04 13:47:38'),
(748, '67', '361', '0', '19', '12', '', '2014-08-04 13:47:39'),
(749, '67', '362', '0', '21', '1', '', '2014-08-04 13:47:39'),
(750, '67', '362', '0', '22', '1', '', '2014-08-04 13:47:40'),
(751, '67', '362', '0', '23', '1', '', '2014-08-04 13:47:40'),
(752, '67', '362', '0', '24', '1', '', '2014-08-04 13:47:40'),
(753, '67', '362', '0', '25', '1', '', '2014-08-04 13:47:40'),
(754, '67', '362', '0', '26', '1', '', '2014-08-04 13:47:40'),
(755, '67', '363', '0', '58', '1', '', '2014-08-04 13:47:42'),
(756, '67', '364', '0', '67', '1', '', '2014-08-04 13:47:43'),
(757, '68', '365', '2', '2', '1', '', '2014-09-13 15:31:16'),
(758, '68', '365', '2', '6', '1', '', '2014-09-13 15:31:16'),
(759, '68', '365', '15', '7', '1', '', '2014-09-13 15:31:17'),
(760, '68', '365', '0', '8', '1', '', '2014-09-13 15:31:17'),
(761, '68', '365', '0', '9', '1', '', '2014-09-13 15:31:17'),
(762, '68', '366', '5', '5', '5', '', '2014-09-13 15:31:18'),
(763, '68', '367', '15', '18', '1', '', '2014-09-13 15:31:19'),
(764, '68', '368', '0', '19', '12', '', '2014-09-13 15:31:20'),
(765, '68', '369', '0', '21', '1', '', '2014-09-13 15:31:20'),
(766, '68', '369', '0', '22', '1', '', '2014-09-13 15:31:20'),
(767, '68', '369', '0', '23', '1', '', '2014-09-13 15:31:20'),
(768, '68', '369', '0', '24', '1', '', '2014-09-13 15:31:20'),
(769, '68', '369', '0', '25', '1', '', '2014-09-13 15:31:20'),
(770, '68', '369', '0', '26', '1', '', '2014-09-13 15:31:20'),
(771, '68', '370', '0', '58', '1', '', '2014-09-13 15:31:21'),
(772, '68', '371', '0', '67', '1', '', '2014-09-13 15:31:22'),
(773, '69', '372', '2', '2', '1', '', '2014-09-13 15:31:31'),
(774, '69', '372', '2', '6', '1', '', '2014-09-13 15:31:31'),
(775, '69', '372', '0', '7', '1', '', '2014-09-13 15:31:31'),
(776, '69', '372', '0', '8', '1', '', '2014-09-13 15:31:31'),
(777, '69', '372', '0', '9', '1', '', '2014-09-13 15:31:31'),
(778, '69', '373', '5', '5', '5', '', '2014-09-13 15:31:32'),
(779, '69', '374', '0', '18', '1', '', '2014-09-13 15:31:35'),
(780, '69', '375', '0', '19', '12', '', '2014-09-13 15:31:36'),
(781, '69', '376', '0', '21', '1', '', '2014-09-13 15:31:37'),
(782, '69', '376', '0', '22', '1', '', '2014-09-13 15:31:39'),
(783, '69', '376', '0', '23', '1', '', '2014-09-13 15:31:39'),
(784, '69', '376', '0', '24', '1', '', '2014-09-13 15:31:40'),
(785, '69', '376', '0', '25', '1', '', '2014-09-13 15:31:40'),
(786, '69', '376', '0', '26', '1', '', '2014-09-13 15:31:40'),
(787, '69', '377', '0', '58', '1', '', '2014-09-13 15:31:41'),
(788, '69', '378', '0', '67', '1', '', '2014-09-13 15:31:42'),
(789, '70', '379', '2', '2', '1', '', '2014-10-05 23:55:35'),
(790, '70', '379', '2', '6', '1', '', '2014-10-05 23:55:35'),
(791, '70', '379', '2', '7', '1', '', '2014-10-05 23:55:35'),
(792, '70', '379', '2', '8', '1', '', '2014-10-05 23:55:35'),
(793, '70', '379', '2', '9', '1', '', '2014-10-05 23:55:35'),
(794, '70', '380', '5', '5', '5', '', '2014-10-05 23:55:36'),
(795, '70', '381', '4', '18', '1', '', '2014-10-05 23:55:37'),
(796, '70', '382', '3', '19', '12', '', '2014-10-05 23:55:37'),
(797, '70', '383', '2', '21', '1', '', '2014-10-05 23:55:38'),
(798, '70', '383', '3', '22', '1', '', '2014-10-05 23:55:38'),
(799, '70', '383', '3', '23', '1', '', '2014-10-05 23:55:39'),
(800, '70', '383', '2', '24', '1', '', '2014-10-05 23:55:39'),
(801, '70', '383', '2', '25', '1', '', '2014-10-05 23:55:39'),
(802, '70', '383', '2', '26', '1', '', '2014-10-05 23:55:39'),
(803, '70', '384', '2', '58', '1', '', '2014-10-05 23:55:40'),
(804, '70', '385', '2', '67', '1', '', '2014-10-05 23:55:41'),
(805, '71', '386', '10', '34', '1', '', '2014-10-09 15:19:00'),
(806, '71', '387', '5', '36', '1', '', '2014-10-09 15:19:00'),
(807, '71', '387', '19', '38', '1', '', '2014-10-09 15:19:01'),
(808, '71', '387', '5', '39', '1', '', '2014-10-09 15:19:01'),
(809, '71', '388', '5', '40', '1', '', '2014-10-09 15:19:01'),
(810, '71', '389', '5', '41', '1', '', '2014-10-09 15:19:01'),
(811, '71', '390', '5', '59', '1', '', '2014-10-09 15:19:02'),
(812, '72', '391', '15', '46', '1', '', '2014-10-15 20:58:47'),
(813, '72', '391', '15', '49', '1', '', '2014-10-15 20:58:47'),
(814, '72', '392', '0', '48', '1', '', '2014-10-15 20:58:47'),
(815, '72', '392', '0', '50', '1', '', '2014-10-15 20:58:48'),
(816, '72', '392', '0', '51', '1', '', '2014-10-15 20:58:48'),
(817, '72', '392', '0', '52', '1', '', '2014-10-15 20:58:48'),
(818, '72', '392', '0', '53', '1', '', '2014-10-15 20:58:48'),
(819, '72', '393', '0', '62', '1', '', '2014-10-15 20:58:48'),
(820, '72', '393', '0', '64', '1', '', '2014-10-15 20:58:48'),
(821, '72', '394', '0', '69', '1', '', '2014-10-15 20:58:49'),
(822, '72', '395', '10', '71', '0', '', '2014-10-15 20:58:49');
INSERT INTO `tbl_quiz_pool_unit` (`id`, `quiz_pool_id`, `quiz_pool_sub_id`, `question_per_unit`, `unit_id`, `time_per_unit`, `total_question_unit`, `timestamp`) VALUES
(823, '72', '395', '5', '72', '0', '', '2014-10-15 20:58:49'),
(824, '72', '395', '5', '73', '0', '', '2014-10-15 20:58:49'),
(825, '72', '395', '10', '74', '0', '', '2014-10-15 20:58:49'),
(826, '72', '395', '10', '75', '0', '', '2014-10-15 20:58:50'),
(827, '72', '396', '15', '77', '0', '', '2014-10-15 20:58:50'),
(828, '72', '396', '15', '79', '0', '', '2014-10-15 20:58:51'),
(829, '73', '397', '3', '2', '1', '', '2014-12-26 17:27:34'),
(830, '73', '397', '3', '6', '1', '', '2014-12-26 17:27:34'),
(831, '73', '397', '5', '7', '1', '', '2014-12-26 17:27:34'),
(832, '73', '397', '4', '8', '1', '', '2014-12-26 17:27:34'),
(833, '73', '397', '2', '9', '1', '', '2014-12-26 17:27:35'),
(834, '73', '398', '5', '5', '5', '', '2014-12-26 17:27:35'),
(835, '73', '399', '4', '18', '1', '', '2014-12-26 17:27:36'),
(836, '73', '400', '3', '19', '12', '', '2014-12-26 17:27:36'),
(837, '73', '401', '2', '21', '1', '', '2014-12-26 17:27:37'),
(838, '73', '401', '3', '22', '1', '', '2014-12-26 17:27:37'),
(839, '73', '401', '3', '23', '1', '', '2014-12-26 17:27:37'),
(840, '73', '401', '2', '24', '1', '', '2014-12-26 17:27:37'),
(841, '73', '401', '2', '25', '1', '', '2014-12-26 17:27:37'),
(842, '73', '401', '2', '26', '1', '', '2014-12-26 17:27:37'),
(843, '73', '402', '2', '58', '1', '', '2014-12-26 17:27:38'),
(844, '73', '403', '2', '67', '1', '', '2014-12-26 17:27:39'),
(845, '74', '404', '3', '2', '1', '', '2015-08-14 11:40:18'),
(846, '74', '404', '3', '6', '1', '', '2015-08-14 11:40:18'),
(847, '74', '404', '5', '7', '1', '', '2015-08-14 11:40:18'),
(848, '74', '404', '4', '8', '1', '', '2015-08-14 11:40:18'),
(849, '74', '404', '2', '9', '1', '', '2015-08-14 11:40:18'),
(850, '74', '405', '5', '5', '5', '', '2015-08-14 11:40:19'),
(851, '74', '406', '4', '18', '1', '', '2015-08-14 11:40:20'),
(852, '74', '407', '3', '19', '12', '', '2015-08-14 11:40:21'),
(853, '74', '408', '2', '21', '1', '', '2015-08-14 11:40:21'),
(854, '74', '408', '3', '22', '1', '', '2015-08-14 11:40:21'),
(855, '74', '408', '3', '23', '1', '', '2015-08-14 11:40:21'),
(856, '74', '408', '2', '24', '1', '', '2015-08-14 11:40:21'),
(857, '74', '408', '2', '25', '1', '', '2015-08-14 11:40:21'),
(858, '74', '408', '2', '26', '1', '', '2015-08-14 11:40:21'),
(859, '74', '409', '2', '58', '1', '', '2015-08-14 11:40:22'),
(860, '74', '410', '2', '67', '1', '', '2015-08-14 11:40:22'),
(861, '75', '411', '1', '2', '1', '', '2015-08-14 12:35:29'),
(862, '75', '411', '1', '6', '1', '', '2015-08-14 12:35:29'),
(863, '75', '411', '1', '7', '1', '', '2015-08-14 12:35:29'),
(864, '75', '411', '1', '8', '1', '', '2015-08-14 12:35:29'),
(865, '75', '411', '1', '9', '1', '', '2015-08-14 12:35:29'),
(866, '75', '412', '1', '5', '5', '', '2015-08-14 12:35:30'),
(867, '75', '413', '1', '18', '1', '', '2015-08-14 12:35:31'),
(868, '75', '414', '1', '19', '12', '', '2015-08-14 12:35:31'),
(869, '75', '415', '1', '21', '1', '', '2015-08-14 12:35:31'),
(870, '75', '415', '1', '22', '1', '', '2015-08-14 12:35:32'),
(871, '75', '415', '1', '23', '1', '', '2015-08-14 12:35:32'),
(872, '75', '415', '1', '24', '1', '', '2015-08-14 12:35:32'),
(873, '75', '415', '1', '25', '1', '', '2015-08-14 12:35:32'),
(874, '75', '415', '1', '26', '1', '', '2015-08-14 12:35:32'),
(875, '75', '416', '1', '58', '1', '', '2015-08-14 12:35:33'),
(876, '75', '417', '0', '67', '1', '', '2015-08-14 12:35:34'),
(877, '76', '418', '1', '2', '1', '', '2015-09-14 14:55:22'),
(878, '76', '418', '1', '6', '1', '', '2015-09-14 14:55:22'),
(879, '76', '418', '1', '7', '1', '', '2015-09-14 14:55:22'),
(880, '76', '418', '1', '8', '1', '', '2015-09-14 14:55:22'),
(881, '76', '418', '1', '9', '1', '', '2015-09-14 14:55:22'),
(882, '76', '419', '1', '5', '5', '', '2015-09-14 14:55:22'),
(883, '76', '420', '1', '18', '1', '', '2015-09-14 14:55:23'),
(884, '76', '421', '1', '19', '12', '', '2015-09-14 14:55:24'),
(885, '76', '422', '1', '21', '1', '', '2015-09-14 14:55:24'),
(886, '76', '422', '1', '22', '1', '', '2015-09-14 14:55:25'),
(887, '76', '422', '1', '23', '1', '', '2015-09-14 14:55:25'),
(888, '76', '422', '1', '24', '1', '', '2015-09-14 14:55:25'),
(889, '76', '422', '1', '25', '1', '', '2015-09-14 14:55:25'),
(890, '76', '422', '0', '26', '1', '', '2015-09-14 14:55:25'),
(891, '76', '423', '1', '58', '1', '', '2015-09-14 14:55:26'),
(892, '76', '424', '0', '67', '1', '', '2015-09-14 14:55:26'),
(893, '77', '425', '1', '2', '1', '', '2015-11-20 18:12:16'),
(894, '77', '425', '2', '6', '1', '', '2015-11-20 18:12:16'),
(895, '77', '425', '1', '7', '1', '', '2015-11-20 18:12:16'),
(896, '77', '425', '2', '8', '1', '', '2015-11-20 18:12:16'),
(897, '77', '425', '1', '9', '1', '', '2015-11-20 18:12:16'),
(898, '77', '426', '1', '5', '5', '', '2015-11-20 18:12:17'),
(899, '77', '427', '2', '18', '1', '', '2015-11-20 18:12:18'),
(900, '77', '428', '1', '19', '12', '', '2015-11-20 18:12:18'),
(901, '77', '429', '1', '21', '1', '', '2015-11-20 18:12:18'),
(902, '77', '429', '1', '22', '1', '', '2015-11-20 18:12:19'),
(903, '77', '429', '2', '23', '1', '', '2015-11-20 18:12:19'),
(904, '77', '429', '1', '24', '1', '', '2015-11-20 18:12:19'),
(905, '77', '429', '1', '25', '1', '', '2015-11-20 18:12:19'),
(906, '77', '429', '0', '26', '1', '', '2015-11-20 18:12:19'),
(907, '77', '430', '1', '58', '1', '', '2015-11-20 18:12:20'),
(908, '77', '431', '1', '67', '1', '', '2015-11-20 18:12:21'),
(909, '78', '432', '1', '2', '1', '', '2015-11-20 18:22:36'),
(910, '78', '432', '0', '6', '1', '', '2015-11-20 18:22:36'),
(911, '78', '432', '0', '7', '1', '', '2015-11-20 18:22:36'),
(912, '78', '432', '0', '8', '1', '', '2015-11-20 18:22:36'),
(913, '78', '432', '1', '9', '1', '', '2015-11-20 18:22:37'),
(914, '78', '433', '1', '5', '5', '', '2015-11-20 18:22:37'),
(915, '78', '434', '0', '18', '1', '', '2015-11-20 18:22:38'),
(916, '78', '435', '1', '19', '12', '', '2015-11-20 18:22:39'),
(917, '78', '436', '1', '21', '1', '', '2015-11-20 18:22:39'),
(918, '78', '436', '1', '22', '1', '', '2015-11-20 18:22:40'),
(919, '78', '436', '0', '23', '1', '', '2015-11-20 18:22:40'),
(920, '78', '436', '1', '24', '1', '', '2015-11-20 18:22:40'),
(921, '78', '436', '1', '25', '1', '', '2015-11-20 18:22:40'),
(922, '78', '436', '0', '26', '1', '', '2015-11-20 18:22:40'),
(923, '78', '437', '1', '58', '1', '', '2015-11-20 18:22:41'),
(924, '78', '438', '1', '67', '1', '', '2015-11-20 18:22:41'),
(925, '79', '439', '1', '85', '0', '', '2015-11-21 09:50:47'),
(926, '79', '440', '2', '109', '0', '', '2015-11-21 09:50:47'),
(927, '79', '441', '3', '110', '0', '', '2015-11-21 09:50:47'),
(928, '79', '442', '4', '111', '0', '', '2015-11-21 09:50:47'),
(929, '80', '443', '4', '2', '1', '', '2015-11-26 14:27:01'),
(930, '80', '443', '0', '6', '1', '', '2015-11-26 14:27:03'),
(931, '80', '443', '0', '7', '1', '', '2015-11-26 14:27:03'),
(932, '80', '443', '0', '8', '1', '', '2015-11-26 14:27:03'),
(933, '80', '443', '1', '9', '1', '', '2015-11-26 14:27:03'),
(934, '80', '444', '1', '5', '5', '', '2015-11-26 14:27:04'),
(935, '80', '445', '0', '18', '1', '', '2015-11-26 14:27:05'),
(936, '80', '446', '1', '19', '12', '', '2015-11-26 14:27:05'),
(937, '80', '447', '1', '21', '1', '', '2015-11-26 14:27:05'),
(938, '80', '447', '1', '22', '1', '', '2015-11-26 14:27:06'),
(939, '80', '447', '0', '23', '1', '', '2015-11-26 14:27:06'),
(940, '80', '447', '1', '24', '1', '', '2015-11-26 14:27:06'),
(941, '80', '447', '1', '25', '1', '', '2015-11-26 14:27:06'),
(942, '80', '447', '0', '26', '1', '', '2015-11-26 14:27:06'),
(943, '80', '448', '1', '58', '1', '', '2015-11-26 14:27:07'),
(944, '80', '449', '1', '67', '1', '', '2015-11-26 14:27:07'),
(945, '81', '450', '30', '4', '1', '', '2017-03-17 12:59:32'),
(946, '81', '451', '5', '10', '0', '', '2017-03-17 12:59:32'),
(947, '81', '451', '5', '11', '0', '', '2017-03-17 12:59:32'),
(948, '81', '451', '5', '12', '0', '', '2017-03-17 12:59:32'),
(949, '81', '451', '0', '13', '0', '', '2017-03-17 12:59:32'),
(950, '81', '452', '5', '14', '0', '', '2017-03-17 12:59:32'),
(951, '81', '452', '5', '15', '1', '', '2017-03-17 12:59:32'),
(952, '81', '452', '0', '16', '1', '', '2017-03-17 12:59:32'),
(953, '81', '452', '0', '17', '1', '', '2017-03-17 12:59:32'),
(954, '81', '453', '15', '70', '0', '', '2017-03-17 12:59:32'),
(955, '81', '453', '15', '76', '0', '', '2017-03-17 12:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `unit` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=>deactive.1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `plain_password` varchar(255) NOT NULL,
  `user_profile_image_path` longtext NOT NULL,
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `plain_password`, `user_profile_image_path`, `role_id`, `role`, `is_active`, `is_deleted`, `created_by`, `created_at`) VALUES
(1, 'Admin', 'admin', 'e766d0df42a46ae12a4c3d36dfe2d251bedc3416', '1900', '/assets/images/user_profile/admin.png', 1, 'admin', 1, 0, NULL, '2019-07-03 17:52:00'),
(2, 'Student', 'student', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '1234', '/assets/images/user_profile/student.png', 2, 'student', 1, 0, 1, '2019-07-17 15:50:00'),
(3, 'Raghavendra', 'raghav', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '1234', '/assets/images/user_profile/student.png', 2, 'student', 1, 0, 1, '2019-08-24 15:06:16'),
(4, 'Kishan', 'kishan', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '1234', '/assets/images/user_profile/student.png', 2, 'student', 1, 0, 1, '2019-08-24 15:06:16'),
(5, 'Gaurav', 'gaurav', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '1234', '/assets/images/user_profile/student.png', 2, 'student', 1, 0, 1, '2019-08-24 15:06:16'),
(6, 'Ashish', 'ashish', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '1234', '/assets/images/user_profile/student.png', 2, 'student', 1, 0, 1, '2019-08-24 15:06:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_roles`
--
ALTER TABLE `job_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizs`
--
ALTER TABLE `quizs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_allocated`
--
ALTER TABLE `quiz_allocated`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_submitted`
--
ALTER TABLE `quiz_submitted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_submitted_answers`
--
ALTER TABLE `quiz_submitted_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_class_quiz_pools`
--
ALTER TABLE `tbl_class_quiz_pools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quiz_generator`
--
ALTER TABLE `tbl_quiz_generator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quiz_pool`
--
ALTER TABLE `tbl_quiz_pool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quiz_pool_subject`
--
ALTER TABLE `tbl_quiz_pool_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quiz_pool_unit`
--
ALTER TABLE `tbl_quiz_pool_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_roles`
--
ALTER TABLE `job_roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quizs`
--
ALTER TABLE `quizs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_allocated`
--
ALTER TABLE `quiz_allocated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_submitted`
--
ALTER TABLE `quiz_submitted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_submitted_answers`
--
ALTER TABLE `quiz_submitted_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_class_quiz_pools`
--
ALTER TABLE `tbl_class_quiz_pools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_quiz_generator`
--
ALTER TABLE `tbl_quiz_generator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quiz_pool`
--
ALTER TABLE `tbl_quiz_pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_quiz_pool_subject`
--
ALTER TABLE `tbl_quiz_pool_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT for table `tbl_quiz_pool_unit`
--
ALTER TABLE `tbl_quiz_pool_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=956;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
