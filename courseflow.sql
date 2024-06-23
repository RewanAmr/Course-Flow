-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 08:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courseflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `email`, `password`, `name`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'rewanamrmahmoud@gmail.com', '111', 'Rewan Amr Mahmoud ', NULL, NULL),
(2, 'lamismahran7@gmail.com\n', '111', NULL, NULL, NULL),
(3, 'omerna419@gmail.com', '111', NULL, 'b6c048e3d7c12bbcacafe28e0ceb3207eb4e5943c390a83e21f61d0887fef6ae', '2023-12-27 23:44:03'),
(4, 'elsayedshrouq80@gmail.com', '111', NULL, NULL, NULL),
(5, 'riham99mahmoud7@gmail.com', '123', 'Reham', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursetable`
--

CREATE TABLE `coursetable` (
  `course_id` varchar(200) NOT NULL,
  `types` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `seat_limit` int(200) NOT NULL,
  `seat_available` int(200) NOT NULL,
  `course_fee` int(200) NOT NULL,
  `examfee` int(200) NOT NULL,
  `totalfee` int(200) NOT NULL,
  `course_teacher` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coursetable`
--

INSERT INTO `coursetable` (`course_id`, `types`, `course_name`, `seat_limit`, `seat_available`, `course_fee`, `examfee`, `totalfee`, `course_teacher`) VALUES
('1', 'Flutter', 'Flutter Payment Integration: Stripe, PayPal & More! [Arabic]', 2, 0, 100, 100, 0, 'mmmgg'),
('10', 'Python', 'Data Processing Using Python', 3, 2, 4000, 1000, 0, '0'),
('11', 'Python', 'Crash Course on Python', 3, 3, 4000, 1000, 0, '0'),
('12', 'Python', 'Google IT Automation with Python ', 3, 3, 2000, 1000, 0, '0'),
('13', 'Python', 'Data Analysis with Python', 3, 3, 4000, 1000, 0, '0'),
('14', 'Python', 'Python and Statistics for Financial Analysis', 3, 3, 4000, 1000, 0, '0'),
('15', 'Python', 'Investment Management with Python and Machine Learning Specialization', 3, 3, 4000, 1000, 0, '0'),
('16', 'Python', 'Python for Finance: Beta and Capital Asset Pricing Model', 3, 3, 4000, 1000, 0, '0'),
('17', 'Software', 'The Complete 2023 Software Testing Bootcamp', 3, 3, 4000, 1000, 0, '0'),
('18', 'Software', 'MasterClass Software Testing with Jira & Agile -Be a QA Lead', 3, 3, 2000, 1000, 0, '0'),
('19', 'Software', 'Automated Software Testing with Python', 3, 3, 4000, 1000, 0, '0'),
('2', 'Flutter', 'Flutter Advanced Course Bloc and MVVM Pattern [Arabic][2023]', 3, 3, 4000, 1000, 0, '0'),
('20', 'Software', 'Business Analyst: Software Testing Processes & Techniques', 3, 3, 2000, 1000, 0, '0'),
('21', 'Software', 'SOFTWARE TESTING MASTERCLASS-2023-JIRA | AGILE | API Testing', 3, 3, 4000, 1000, 0, '0'),
('22', 'Software', 'Software Testing Interview Secrets: Ace Your QA Interviews', 3, 3, 2000, 1000, 0, '0'),
('23', 'Software', 'Software Tester Course - Become an Effective Tester', 3, 3, 4000, 1000, 0, '0'),
('24', 'Software', 'Software Manual Testing - Complete course beginner to expert', 3, 3, 4000, 1000, 0, '0'),
('25', 'Marketing ', 'Software Manual Testing - Complete course beginner to expert', 3, 3, 4000, 1000, 0, '0'),
('26', 'Marketing', 'Digital Marketing: 16 Strategic and Tactical Courses in 1', 3, 3, 2000, 1000, 0, '0'),
('27', 'Marketing', 'How to Market Yourself as a Coach or Consultant', 3, 3, 4000, 1000, 0, '0'),
('28', 'Marketing', 'Marketing Research: support your marketing decisions', 3, 3, 4000, 1000, 0, '0'),
('29', 'Marketing', 'Business Writing & Technical Writing Immersion', 3, 3, 2000, 1000, 0, '0'),
('3', 'Flutter', 'Deep Dive into Clean Architecture in Flutter[Arabic]', 3, 3, 2000, 1000, 0, '0'),
('30', 'Marketing', 'Marketing Research: support your marketing decisions', 3, 3, 4000, 1000, 0, '0'),
('31', 'Marketing', 'Mega Digital Marketing Course A-Z: 32 Courses in 1 + Updates', 3, 3, 2000, 1000, 0, '0'),
('32', 'Marketing', 'Social Media Marketing Advertising with Dekker, MBA 2023', 3, 3, 4000, 1000, 0, '0'),
('33', 'Design', 'Creating Responsive Web Design', 3, 3, 4000, 1000, 0, '0'),
('34', 'Design', 'Photoshop CS6 Crash Course', 3, 3, 2000, 1000, 0, '0'),
('35', 'Desing', 'User Experience (UX): The Ultimate Guide to Usability and UX', 3, 3, 4000, 1000, 0, '0'),
('36', 'Design', 'Essential Skills for Designers - Masking', 3, 3, 2000, 1000, 0, '0'),
('37', 'Design', 'Methods of Design Synthesis: Research to Product Innovation', 3, 3, 4000, 1000, 0, '0'),
('38', 'Design', 'Figma Design Course 2023. Your Website from Start to Finish', 3, 3, 2000, 1000, 0, '0'),
('39', 'Design', 'Complete Figma Megacourse: UI/UX Design Beginner to Expert', 3, 3, 4000, 1000, 0, '0'),
('4', 'Flutter', 'Flutter & Dart Complete Development Course [2023] [Arabic]', 3, 3, 4000, 1000, 0, '0'),
('40', 'Design', 'Learn Figma - UI/UX Design Essential Training', 3, 3, 2000, 1000, 0, '0'),
('41', 'Design', 'Motion Design with Figma: Animations, Motion Graphics, UX/UI', 3, 3, 4000, 1000, 0, '0'),
('42', 'Development', 'Javascript for Beginners', 3, 3, 4000, 1000, 0, '0'),
('43', 'Development', 'Become a Certified Web Developer: HTML, CSS and JavaScript', 3, 3, 2000, 1000, 0, '0'),
('44', 'Development', 'Learn C# Programming (In Ten Easy Steps)', 3, 3, 4000, 1000, 0, '0'),
('45', 'Development', 'AJAX Development', 3, 3, 4000, 1000, 0, '0'),
('46', 'Development', 'The Complete 2020 Fullstack Web Developer Course', 3, 3, 2000, 1000, 0, '0'),
('47', 'Development', 'Java Swing (GUI) Programming: From Beginner to Expert', 3, 3, 4000, 1000, 0, '0'),
('48', 'Development', 'The Complete 2023 Web Development Bootcamp', 3, 3, 2000, 1000, 0, '0'),
('49', 'Development ', 'Web Development Masterclass - Online Certification Course', 3, 3, 4000, 1000, 0, '0'),
('5', 'Flutter', 'Mastering Flutter: Responsive & Adaptive UI Design [Arabic]', 3, 3, 4000, 1000, 0, '0'),
('50', 'Development', 'The Complete Web Developer Course', 3, 3, 4000, 1000, 0, '0'),
('51', 'Business', 'How to Budget and Forecast for Your Business', 3, 3, 4000, 1000, 0, '0'),
('52', 'Business', 'Powerful Business Writing: How to Write Concisely', 3, 3, 2000, 1000, 0, '0'),
('53', 'Business', 'Chief Financial Officer Leadership Program', 3, 3, 4000, 1000, 0, '0'),
('54', 'Business', 'Sales and Persuasion Skills for Startups', 3, 3, 4000, 1000, 0, '0'),
('55', 'Business ', 'Master Your Mindset & Brain: Framestorm Your Way to Success', 3, 3, 4000, 1000, 0, '0'),
('56', 'Business', 'Improve Communication: Speak Smoothly, Clearly & Confidently', 3, 3, 2000, 1000, 0, '0'),
('57', 'Business', 'The Business Intelligence Analyst Course 2023', 3, 3, 8000, 2000, 0, '0'),
('58', 'Business', 'Business Analysis Fundamentals - ECBA, CCBA, CBAP endorsed', 3, 3, 10000, 2000, 0, '0'),
('6', 'Flutter', 'Flutter & Dart for Beginners: Complete Course [2023 Latest]', 3, 3, 2000, 1000, 0, '0'),
('7', 'Flutter', 'The Complete Flutter Development Bootcamp', 3, 3, 4000, 1000, 0, '0'),
('8', 'Flutter', 'Flutter - Intermediate', 2, 2, 4000, 1000, 0, '0'),
('9', 'Python', 'Build a Machine Learning Model with Python', 3, 3, 4000, 1000, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `examtype`
--

CREATE TABLE `examtype` (
  `status` int(200) NOT NULL,
  `exam_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendingcourse`
--

CREATE TABLE `pendingcourse` (
  `roll_no` int(200) NOT NULL,
  `course_id` varchar(200) NOT NULL,
  `types` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `exam_type` varchar(200) NOT NULL,
  `coursefee` int(200) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendingcourse`
--

INSERT INTO `pendingcourse` (`roll_no`, `course_id`, `types`, `course_name`, `exam_type`, `coursefee`, `status`) VALUES
(1, '10', 'Python', 'Data Processing Using Python', 'Regular', 0, 0),
(90, '10', 'Python', 'Data Processing Using Python', 'Regular', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_id` int(11) NOT NULL,
  `time_id` int(1) NOT NULL,
  `day` varchar(50) NOT NULL,
  `member_id` int(200) NOT NULL,
  `subject_code` varchar(200) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `settings_id` int(11) NOT NULL,
  `encoded_by` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `time_id`, `day`, `member_id`, `subject_code`, `remarks`, `settings_id`, `encoded_by`) VALUES
(0, 4, 'm', 1, 'Data Processing Using Python', '', 1, '27'),
(0, 5, 'w', 1, 'Data Processing Using Python', '', 1, '27'),
(0, 6, 'f', 1, 'Data Processing Using Python', '', 1, '27'),
(0, 4, 'm', 1, 'Data Processing Using Python', '', 1, '27'),
(0, 5, 'w', 1, 'Data Processing Using Python', '', 1, '27'),
(0, 6, 'f', 1, 'Data Processing Using Python', '', 1, '27');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `term` varchar(10) NOT NULL,
  `sem` varchar(15) NOT NULL,
  `sy` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `term`, `sem`, `sy`, `status`) VALUES
(1, 'First Seme', '1st', '2022-2023', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `studentsignup`
--

CREATE TABLE `studentsignup` (
  `student_name` varchar(200) NOT NULL,
  `roll_no` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile_no` int(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirm_password` varchar(50) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentsignup`
--

INSERT INTO `studentsignup` (`student_name`, `roll_no`, `email`, `address`, `mobile_no`, `password`, `confirm_password`, `reset_token_hash`, `reset_token_expires_at`) VALUES
('a', 1, 'a@gmail.com', 'asdfs', 24, '123', '123', NULL, NULL),
('b', 2, 'b@gmail.com', 'afdgsdfg', 346546, '123', '123', NULL, NULL),
('c', 7, 'c@gmail.com', 'sgfdg', 344, '123', '123', NULL, NULL),
('Rewan Amr Mahmoud ', 90, 'rewanamrmahmoud@gmail.com', 'Suez', 122222, '600', '600', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `days` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `time_start`, `time_end`, `days`) VALUES
(4, '07:30:00', '08:30:00', 'mwf'),
(5, '08:30:00', '09:30:00', 'mwf'),
(6, '09:30:00', '10:30:00', 'mwf'),
(7, '10:30:00', '11:30:00', 'mwf'),
(8, '11:30:00', '12:30:00', 'mwf'),
(9, '12:30:00', '13:30:00', 'mwf'),
(10, '13:30:00', '14:30:00', 'mwf'),
(11, '14:30:00', '15:30:00', 'mwf'),
(12, '15:30:00', '16:30:00', 'mwf'),
(13, '16:30:00', '17:30:00', 'mwf'),
(14, '17:30:00', '18:30:00', 'mwf'),
(15, '18:30:00', '19:30:00', 'mwf'),
(18, '07:30:00', '09:00:00', 'tth'),
(19, '09:00:00', '10:30:00', 'tth'),
(20, '10:30:00', '12:00:00', 'tth'),
(21, '12:00:00', '13:30:00', 'tth'),
(22, '13:30:00', '15:00:00', 'tth'),
(23, '15:00:00', '16:30:00', 'tth'),
(24, '16:30:00', '18:00:00', 'tth'),
(25, '18:00:00', '19:30:00', 'tth'),
(37, '19:30:00', '20:30:00', 'mwf'),
(56, '15:00:00', '16:00:00', 'fst'),
(52, '10:00:00', '11:00:00', 'fst'),
(51, '09:00:00', '10:00:00', 'fst'),
(41, '08:00:00', '09:00:00', 'fst'),
(55, '14:00:00', '15:00:00', 'fst'),
(54, '13:00:00', '14:00:00', 'fst'),
(53, '11:00:00', '12:00:00', 'fst'),
(57, '16:00:00', '17:00:00', 'fst'),
(58, '17:00:00', '18:00:00', 'fst');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- Indexes for table `coursetable`
--
ALTER TABLE `coursetable`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `examtype`
--
ALTER TABLE `examtype`
  ADD PRIMARY KEY (`exam_type`);

--
-- Indexes for table `pendingcourse`
--
ALTER TABLE `pendingcourse`
  ADD KEY `roll_no` (`roll_no`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD KEY `fk_schedule_studentsignup` (`member_id`),
  ADD KEY `fk_schedule_coursetable` (`subject_code`),
  ADD KEY `fk_schedule_settings` (`settings_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `studentsignup`
--
ALTER TABLE `studentsignup`
  ADD PRIMARY KEY (`roll_no`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendingcourse`
--
ALTER TABLE `pendingcourse`
  ADD CONSTRAINT `fk_pendingcourse_coursetable` FOREIGN KEY (`course_id`) REFERENCES `coursetable` (`course_id`),
  ADD CONSTRAINT `fk_pendingcourse_studentsignup` FOREIGN KEY (`roll_no`) REFERENCES `studentsignup` (`roll_no`),
  ADD CONSTRAINT `pendingcourse_ibfk_1` FOREIGN KEY (`roll_no`) REFERENCES `studentsignup` (`roll_no`),
  ADD CONSTRAINT `pendingcourse_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `coursetable` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
