-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 04:20 AM
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
(1, 6, 1, 15, '2025-03-01 01:00:00'),
(2, 5, 7, 28, '2025-03-02 05:20:00'),
(3, 5, 3, 15, '2025-02-28 01:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_image`) VALUES
(14, 'Cybersecurity', 'uploads/Cybersecurity.jpeg'),
(15, 'Data Analysis', 'uploads/Data-Analytics.jpeg'),
(16, 'Data Science', 'uploads/data-science.jpeg'),
(17, 'Machine Learning', 'uploads/Machine-Learning.jpeg'),
(19, 'Product Management', 'uploads/product-management.jpeg'),
(20, 'Project Management', 'uploads/project-management.jpeg'),
(21, 'Python Development', 'uploads/python.jpeg'),
(22, 'Technical Writing', 'uploads/Technical-Writing.jpeg'),
(23, 'UI-UX Mastery', 'uploads/UI-UX.jpeg'),
(24, 'Web Development', 'uploads/web-development.jpeg'),
(26, 'Cloud Computing', 'uploads/Cloud-Computing.jpeg'),
(28, 'Product Design', 'uploads/product-design.jpeg');

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
(1, 24, 'Learning HTML', 'HTML or Hyper-Text Markup Language is a web development programming language that serves as the structure of any website', 'http://localhost/MainBySetemi/Dashboard/main.php'),
(2, 24, 'Learning CSS', 'CSS or Cascading style sheet is a web development programming language which is used to style websites', 'youtube.com'),
(3, 24, 'Learn JavaScript', 'Javascript is a very important programming language that is used for adding functionality to any website', 'udemy.com');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `phone`, `email`) VALUES
(1, 'Ogunwole Prosper', '08142842285', 'mayowaprosper@gmail.com'),
(3, 'Young Jesse', '0901111111', 'jesseyoung@gmail.com'),
(6, 'Setemi Loye', '0902212222', 'setemiloye2@gmail.com'),
(7, 'Opawande Oluwasegun', '0902212222', 'opasegs@gmail.com');

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
(1, 14),
(1, 15),
(3, 15),
(6, 15),
(7, 28);

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
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `university_email` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `age`, `gender`, `university_email`, `email`, `phone`, `password`, `role`) VALUES
(4, 'Setemi', NULL, NULL, 'setemiloye@gmail.com', NULL, NULL, '$2y$10$bDz2BIp3.W6vS7VmRak/8ubJL6PAooHnIEXpjWuszmbQuyrbCV0/y', 'admin'),
(5, 'Segzy', NULL, NULL, 'opawandesegun@gmail.com', NULL, NULL, '$2y$10$LUxUu.Pey6qmYGj9sxBP6eeQ1K1HnrbIPJ9mE9s6QCxdXiMNWasLS', 'student'),
(6, 'odiche', NULL, NULL, 'odichenye45@gmail.com', NULL, NULL, '$2y$10$FP6Y4t2PmAYAhHLzIFB5v.0sxJ47BHA1Cynm7YVy9dxml.tfOg6EK', 'student'),
(7, 'YounJ', NULL, NULL, 'yjesse330@gmail.com', NULL, NULL, '$2y$10$/JP1wMxxMDG.4U/To9WapOQb9s40Mitr8X3zuijY2deMoF0LsjDo6', 'student');

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
-- Indexes for table `news_updates`
--
ALTER TABLE `news_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `university_email` (`university_email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `course_roadmap`
--
ALTER TABLE `course_roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_updates`
--
ALTER TABLE `news_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
