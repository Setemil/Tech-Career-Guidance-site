-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 09:40 AM
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
-- Database: `careerguidancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `appointment_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `student_id`, `instructor_id`, `course_id`, `appointment_time`) VALUES
(12, 18, 9, 16, '2025-03-30 12:50:00'),
(13, 17, 9, 14, '2025-03-09 13:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_image` varchar(255) NOT NULL,
  `syllabus_pdf` varchar(255) DEFAULT NULL,
  `difficulty_level` enum('beginner','intermediate','advanced') DEFAULT NULL,
  `duration_hours` int(11) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `learning_style` enum('visual','reading','interactive','combination') DEFAULT NULL,
  `career_path` enum('entry_level','career_switch','skill_enhancement','personal_projects','entrepreneurship') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_image`, `syllabus_pdf`, `difficulty_level`, `duration_hours`, `provider`, `description`, `rating`, `learning_style`, `career_path`) VALUES
(14, 'Cybersecurity', 'uploads/Cybersecurity.jpeg', NULL, 'beginner', NULL, NULL, 'This is the process of learning the ways of ethical hacking and other forms of securing computers', NULL, 'interactive', 'skill_enhancement'),
(15, 'Data Analysis', 'uploads/Data-Analytics.jpeg', NULL, 'beginner', NULL, NULL, 'This is the Process of making use of large amounts of data to work', NULL, 'interactive', 'entry_level'),
(16, 'Data Science', 'uploads/data-science.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Product Management', 'uploads/product-management.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Project Management', 'uploads/project-management.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Python Development', 'uploads/python.jpeg', NULL, 'beginner', NULL, NULL, 'In this course you can learn the basics of python programming and development and implement it in whatever course you decide to go into next', NULL, 'visual', 'entry_level'),
(22, 'Technical Writing', 'uploads/Technical-Writing.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'UI-UX Mastery', 'uploads/UI-UX.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Cloud Computing', 'uploads/Cloud-Computing.jpeg', NULL, 'intermediate', NULL, NULL, 'This is the study of using cloud infrastructures to develop programs', NULL, 'visual', 'entry_level'),
(28, 'Product Design', 'uploads/product-design.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Machine Learning', 'uploads/Machine-Learning.jpeg', NULL, 'intermediate', NULL, NULL, 'This is a difficult course that is meant for users that are okay with working with large amount of data and have alot of time to train models', NULL, 'combination', 'skill_enhancement'),
(33, 'Game Development', 'uploads/545236.jpg', NULL, 'advanced', NULL, NULL, 'This course is meant for people who want to improve in their game development skills and have proper knowledge in c# and c++', NULL, 'interactive', 'personal_projects'),
(34, 'Web Development', 'uploads/web-development.jpeg', NULL, 'beginner', NULL, NULL, 'This is using HTML, css and Javascript to teach you how to make websites', NULL, 'interactive', 'entry_level');

-- --------------------------------------------------------

--
-- Table structure for table `course_interests`
--

CREATE TABLE `course_interests` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_interests`
--

INSERT INTO `course_interests` (`id`, `course_id`, `interest_id`) VALUES
(35, 14, 6),
(40, 15, 4),
(36, 26, 1),
(37, 26, 4),
(38, 26, 7),
(39, 26, 8),
(28, 30, 2),
(29, 30, 4),
(30, 30, 5),
(25, 33, 3),
(26, 33, 5),
(27, 33, 9),
(41, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_languages`
--

CREATE TABLE `course_languages` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_languages`
--

INSERT INTO `course_languages` (`id`, `course_id`, `language_id`) VALUES
(27, 15, 2),
(30, 21, 2),
(26, 26, 3),
(22, 30, 1),
(23, 30, 2),
(24, 30, 4),
(20, 33, 4),
(21, 33, 10),
(28, 34, 1),
(29, 34, 5);

-- --------------------------------------------------------

--
-- Table structure for table `course_roadmap`
--

CREATE TABLE `course_roadmap` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `topic` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `resource_links` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_roadmap`
--

INSERT INTO `course_roadmap` (`id`, `course_id`, `topic`, `description`, `resource_links`) VALUES
(4, 34, 'Learn HTML', 'This is a programming language that is known as the building block of any website', 'youtube.com, udemy.com'),
(5, 34, 'Learn CSS', 'This is a programming language that is used to style html code and is meant for beautifying any website', 'youtube.com, udemy.com');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `phone`, `email`, `password`) VALUES
(3, 'Young Jesse', '0901111111', 'jesseyoung@gmail.com', ''),
(7, 'Opawande Oluwasegun', '0902212222', 'opasegs@gmail.com', ''),
(9, 'Maconi_Nancy', '08142842285', 'nancymaconi@gmail.com', '$2y$10$qjvKFBnrnR54ScHX6FU9MuKvDmKUByV7Xz5yYsHOC1E176QOqybWm');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_courses`
--

CREATE TABLE `instructor_courses` (
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_courses`
--

INSERT INTO `instructor_courses` (`instructor_id`, `course_id`) VALUES
(3, 15),
(3, 16),
(3, 19),
(3, 20),
(3, 30),
(3, 33),
(7, 28),
(9, 14),
(9, 15),
(9, 16);

-- --------------------------------------------------------

--
-- Table structure for table `interest_areas`
--

CREATE TABLE `interest_areas` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interest_areas`
--

INSERT INTO `interest_areas` (`id`, `name`, `description`) VALUES
(1, 'Web Development', 'Frontend and backend web development'),
(2, 'Mobile App Development', 'iOS, Android, and cross-platform mobile app development'),
(3, 'Game Development', 'Creating games for various platforms'),
(4, 'Data Science/Analytics', 'Data analysis, visualization, and insights'),
(5, 'Artificial Intelligence/Machine Learning', 'AI algorithms, machine learning, and deep learning'),
(6, 'Cybersecurity', 'Security practices, penetration testing, and defense'),
(7, 'Cloud Computing', 'AWS, Azure, Google Cloud, and cloud architecture'),
(8, 'DevOps', 'CI/CD, automation, and infrastructure management'),
(9, 'UI/UX Design', 'User interface and experience design'),
(10, 'Blockchain/Cryptocurrency', 'Blockchain technology and cryptocurrency development');

-- --------------------------------------------------------

--
-- Table structure for table `news_updates`
--

CREATE TABLE `news_updates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_updates`
--

INSERT INTO `news_updates` (`id`, `title`, `content`, `image_path`, `created_at`) VALUES
(5, 'HTML Abbreviation has been CHANGED', 'HTML which is commonly known as the \"building block of the internet\" has now gotten its acronym changed from the usual \"HyperText Markup Language\" that we all grew upp to know and love into sommething totally different', 'uploads/news/1740712407_116571.jpg', '2025-02-28 03:13:27'),
(6, 'CSS is now OUTTDATED???!!!', 'HTML which is commonly known as the \"building block of the internet\" has now gotten its acronym changed from the usual \"HyperText Markup Language\" that we all grew upp to know and love into sommething totally different', 'uploads/news/1740712434_13652.jpg', '2025-02-28 03:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `programming_languages`
--

CREATE TABLE `programming_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programming_languages`
--

INSERT INTO `programming_languages` (`id`, `name`) VALUES
(1, 'JavaScript'),
(2, 'Python'),
(3, 'Java'),
(4, 'C#'),
(5, 'PHP'),
(6, 'Ruby'),
(7, 'Swift'),
(8, 'Kotlin'),
(9, 'Go'),
(10, 'Rust');

-- --------------------------------------------------------

--
-- Table structure for table `saved_courses`
--

CREATE TABLE `saved_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_courses`
--

INSERT INTO `saved_courses` (`id`, `student_id`, `course_id`, `saved_at`) VALUES
(10, 18, 30, '2025-03-22 13:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `university_email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `age`, `gender`, `university_email`, `phone`, `password`, `role`) VALUES
(4, 'Setemi', NULL, NULL, 'setemiloye@gmail.com', NULL, '$2y$10$4AXBZ4K/r08MHUaVg1/RE.XcG6vO84.HqyBNB3ml4gPw7pTJWA9tu', 'admin'),
(17, 'Jesse', NULL, NULL, 'jesse@gmail.com', NULL, '$2y$10$mk7EeYmj7sJNx2SmSBTCEu2Zpxt813qjV/Za.DWTSL.tFhm1TVkiu', 'student'),
(18, 'prosper', 20, 'male', 'prosper@gmail.com', '08142842285', '$2y$10$VnwHL/1TCFKSwnC0I.udYOHTtJ28wfs9pjTR1r5Ndp2rLiR1oQT6G', 'student'),
(19, 'Great', NULL, NULL, 'great@gmail.com', NULL, '$2y$10$INM5FJFjOiLjrEzYat/bg.yq9.yKqG7oVFDKBYXJvU6hI7Lda7/B2', 'student'),
(20, 'emma', NULL, NULL, 'emma@gmail.com', NULL, '$2y$10$LPTNNN3YpqYHhFHAYEd1zOu7uWzeP3I1LRfaIyEFVj8upohBEwCiO', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `student_interests`
--

CREATE TABLE `student_interests` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_interests`
--

INSERT INTO `student_interests` (`id`, `student_id`, `interest_id`) VALUES
(20, 17, 1),
(21, 17, 2),
(22, 17, 3),
(23, 18, 3),
(24, 18, 4),
(25, 19, 1),
(26, 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `student_languages`
--

CREATE TABLE `student_languages` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_languages`
--

INSERT INTO `student_languages` (`id`, `student_id`, `language_id`) VALUES
(18, 17, 2),
(19, 17, 3),
(20, 18, 1),
(21, 18, 2),
(22, 19, 1),
(23, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

CREATE TABLE `survey_responses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `experience_level` enum('none','beginner','intermediate','advanced') NOT NULL,
  `learning_style` enum('visual','reading','interactive','combination') NOT NULL,
  `career_goal` enum('entry_level','career_switch','skill_enhancement','personal_projects','entrepreneurship') NOT NULL,
  `learning_time` enum('less_than_5','5_to_10','10_to_20','more_than_20') NOT NULL,
  `survey_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_responses`
--

INSERT INTO `survey_responses` (`id`, `student_id`, `experience_level`, `learning_style`, `career_goal`, `learning_time`, `survey_date`) VALUES
(6, 17, 'beginner', 'interactive', 'entry_level', 'less_than_5', '2025-03-22 11:51:40'),
(7, 18, 'intermediate', 'interactive', 'career_switch', 'more_than_20', '2025-03-22 13:15:52'),
(8, 19, 'intermediate', 'reading', 'personal_projects', '5_to_10', '2025-03-23 21:06:04'),
(9, 20, 'none', 'interactive', 'entry_level', '10_to_20', '2025-03-24 19:25:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_interests`
--
ALTER TABLE `course_interests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_interest` (`course_id`,`interest_id`),
  ADD KEY `course_interests_ibfk_2` (`interest_id`);

--
-- Indexes for table `course_languages`
--
ALTER TABLE `course_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_language` (`course_id`,`language_id`),
  ADD KEY `course_languages_ibfk_2` (`language_id`);

--
-- Indexes for table `course_roadmap`
--
ALTER TABLE `course_roadmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `instructor_courses`
--
ALTER TABLE `instructor_courses`
  ADD PRIMARY KEY (`instructor_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `interest_areas`
--
ALTER TABLE `interest_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_updates`
--
ALTER TABLE `news_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programming_languages`
--
ALTER TABLE `programming_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_courses`
--
ALTER TABLE `saved_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `university_email` (`university_email`);

--
-- Indexes for table `student_interests`
--
ALTER TABLE `student_interests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`interest_id`),
  ADD KEY `interest_id` (`interest_id`);

--
-- Indexes for table `student_languages`
--
ALTER TABLE `student_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `course_interests`
--
ALTER TABLE `course_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `course_languages`
--
ALTER TABLE `course_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `course_roadmap`
--
ALTER TABLE `course_roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `interest_areas`
--
ALTER TABLE `interest_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news_updates`
--
ALTER TABLE `news_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `programming_languages`
--
ALTER TABLE `programming_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `saved_courses`
--
ALTER TABLE `saved_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_interests`
--
ALTER TABLE `student_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `student_languages`
--
ALTER TABLE `student_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `survey_responses`
--
ALTER TABLE `survey_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_interests`
--
ALTER TABLE `course_interests`
  ADD CONSTRAINT `course_interests_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_interests_ibfk_2` FOREIGN KEY (`interest_id`) REFERENCES `interest_areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_languages`
--
ALTER TABLE `course_languages`
  ADD CONSTRAINT `course_languages_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_languages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `programming_languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_roadmap`
--
ALTER TABLE `course_roadmap`
  ADD CONSTRAINT `course_roadmap_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instructor_courses`
--
ALTER TABLE `instructor_courses`
  ADD CONSTRAINT `instructor_courses_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `instructor_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_courses`
--
ALTER TABLE `saved_courses`
  ADD CONSTRAINT `saved_courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `saved_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `student_interests`
--
ALTER TABLE `student_interests`
  ADD CONSTRAINT `student_interests_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_interests_ibfk_2` FOREIGN KEY (`interest_id`) REFERENCES `interest_areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_languages`
--
ALTER TABLE `student_languages`
  ADD CONSTRAINT `student_languages_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_languages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `programming_languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD CONSTRAINT `survey_responses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
