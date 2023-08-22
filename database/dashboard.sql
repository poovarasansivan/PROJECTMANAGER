-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2023 at 05:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_projects`
--

CREATE TABLE `m_projects` (
  `id` bigint(20) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '1' COMMENT '0-non active,1-active,2-ongoin',
  `created_by` varchar(20) DEFAULT NULL COMMENT 'id',
  `incharge` varchar(20) DEFAULT NULL COMMENT 'id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_projects`
--

INSERT INTO `m_projects` (`id`, `title`, `description`, `start_date`, `end_date`, `status`, `created_by`, `incharge`) VALUES
(1, 'SKILL', 'TempData is used to transfer data from view to controller, controller to view, or from one action method to another action method of the same or a different controller. TempData stores the data temporarily and automatically removes it after retrieving a value. TempData is a property in the ControllerBase class.', '2023-08-17', '2023-09-09', '1', '7376211cs239', '7376211cs239'),
(2, 'PS SKILL', 'aaa', '2023-08-16', '2023-08-18', '1', '7376211cs239', '7376211cs239'),
(4, 'TAC Portal', 'Dashboard for Skill team', '2023-09-07', '2023-09-05', '1', '7376211cs239', '7376211cs239'),
(5, 'Project Manager Dashboard', 'Admin And user login', '2023-08-18', '2023-08-19', '1', '7376211cs239', '7376211cs239'),
(6, 'PS SKILL', 'sd w', '2023-09-08', '2023-08-28', '2', '7376211cs239', '7376211cs239'),
(7, 'Project Design Portal', 'PORTAL', '2023-08-11', '2023-08-26', NULL, '7376211cs239', '7376211cs239');

-- --------------------------------------------------------

--
-- Table structure for table `m_resource`
--

CREATE TABLE `m_resource` (
  `id` int(20) NOT NULL,
  `res_group` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `sort_id` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0-not active;1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_resource`
--

INSERT INTO `m_resource` (`id`, `res_group`, `label`, `link`, `img`, `sort_id`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 'dashboard', 'home', 1, '1'),
(2, 'Project', 'Our Project', 'ourproject', 'clipboard', 2, '1'),
(3, 'Project', 'WorkLog', 'worklog', 'file-text', 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `m_task`
--

CREATE TABLE `m_task` (
  `id` int(20) NOT NULL,
  `project_id` int(20) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `discription` text DEFAULT NULL,
  `assign_to` int(20) DEFAULT NULL,
  `assign_by` int(20) DEFAULT NULL,
  `due` datetime DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id` int(20) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '0-not active, 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `user_id`, `name`, `email`, `phone`, `status`) VALUES
(1, '7376211cs239', 'POOVARASAN', 'poovarasan.cs21@bitsathy.ac.in', 2147483647, '1'),
(2, '7376211cs261', 'RISHVANTH', 'p@gmail.com', 455445656, '1');

-- --------------------------------------------------------

--
-- Table structure for table `project_user_mapping`
--

CREATE TABLE `project_user_mapping` (
  `id` bigint(20) NOT NULL,
  `project_id` int(20) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0-not active 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_user_mapping`
--

INSERT INTO `project_user_mapping` (`id`, `project_id`, `user_id`, `status`) VALUES
(1, 1, '7376211CS239', '0'),
(2, 2, '7376211cs239', '1'),
(3, 3, '7376211cs239', '1'),
(4, 4, '7376211cs239', '0'),
(5, 5, '7376211cs239 ', '0');

-- --------------------------------------------------------

--
-- Table structure for table `task_log`
--

CREATE TABLE `task_log` (
  `id` int(20) NOT NULL,
  `task_id` int(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(5) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `username`, `password`, `role`, `status`) VALUES
(1, '7376211cs239', 'poosu', '9953a2a203d453edc8674c5ce303c452', 1, '1'),
(2, '7376211cs261', 'Rish', 'Rish123', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(20) NOT NULL,
  `label` varchar(50) NOT NULL,
  `resource` varchar(150) NOT NULL,
  `starting` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `label`, `resource`, `starting`) VALUES
(1, 'Admin', '1-2-3-4-5-6-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_log`
--

CREATE TABLE `work_log` (
  `id` int(20) NOT NULL,
  `project_id` int(20) DEFAULT NULL,
  `check_in` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `check_out` timestamp NULL DEFAULT NULL,
  `checkout_description` text DEFAULT NULL,
  `checkin_latitude` double DEFAULT NULL,
  `checkin_longitude` double DEFAULT NULL,
  `checkout_latitude` double DEFAULT NULL,
  `checkout_longitude` double DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `status` enum('0','1','2','3') DEFAULT '3' COMMENT '0-pending,1-Approved,2-rejected,3-Waiting for checkout',
  `approved_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_log`
--

INSERT INTO `work_log` (`id`, `project_id`, `check_in`, `check_out`, `checkout_description`, `checkin_latitude`, `checkin_longitude`, `checkout_latitude`, `checkout_longitude`, `duration`, `user_id`, `status`, `approved_by`) VALUES
(1, 1, '2023-08-18 04:59:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL),
(2, 5, '2023-08-18 11:21:29', '2023-08-18 04:59:40', 'Dashboard For Material Tracking', NULL, NULL, NULL, NULL, 60, '7376211cs239', '1', NULL),
(3, 1, '2023-08-19 03:17:02', '2023-08-18 05:00:02', 'UI/UX', NULL, NULL, NULL, NULL, 60, '7376211cs239', '1', NULL),
(4, 3, '2023-08-18 08:41:20', '2023-08-18 05:00:17', 'Admin page ', NULL, NULL, NULL, NULL, 0, '7376211cs239', '1', NULL),
(5, 4, '2023-08-18 08:41:22', '2023-08-18 05:00:52', 'Dashboard for Tac Approval', NULL, NULL, NULL, NULL, 0, '7376211cs239', '1', NULL),
(6, 2, '2023-08-18 11:22:16', '2023-08-18 05:31:37', 'qcqw', NULL, NULL, NULL, NULL, 120, '7376211cs239', '1', NULL),
(7, 1, '2023-07-17 08:46:05', '2023-07-20 08:41:07', 'vw', NULL, NULL, NULL, NULL, 60, '7376211cs239', '1', NULL),
(8, 1, '2023-07-11 08:43:59', '2023-07-10 08:41:00', 'devwe', NULL, NULL, NULL, NULL, 60, '7376211cs239', '1', NULL),
(9, 5, '2023-08-17 08:46:46', '2023-08-17 10:46:50', 'Dashboard\r\n\n\n', NULL, NULL, NULL, NULL, 120, '7376211cs239', '1', NULL),
(10, 2, '2023-08-19 03:07:01', '2023-08-19 03:06:47', 'dau', NULL, NULL, NULL, NULL, 0, '7376211cs239', '1', NULL),
(11, 2, '2023-08-19 03:18:57', '2023-08-19 03:10:54', 'wevwe', NULL, NULL, NULL, NULL, 0, '7376211cs239', '1', NULL),
(12, 1, '2023-08-19 03:18:52', '2023-08-19 03:18:36', 'Dashboard', NULL, NULL, NULL, NULL, 6, '7376211cs239', '1', NULL),
(13, 4, '2023-08-19 04:53:06', '2023-08-19 04:12:46', 'svw', NULL, NULL, NULL, NULL, 40, '7376211cs239', '1', NULL),
(14, 1, '2023-08-19 04:52:35', '2023-08-19 04:12:38', 'dv', NULL, NULL, NULL, NULL, 37, '7376211cs239', '1', NULL),
(15, 2, '2023-08-19 07:09:21', '2023-08-19 07:09:01', 'dvs', NULL, NULL, NULL, NULL, 2, '7376211cs239', '1', NULL),
(16, 0, '2023-08-19 08:49:08', '2023-08-19 08:19:11', '', NULL, NULL, NULL, NULL, 0, '7376211cs239', '1', NULL),
(17, 2, '2023-08-19 08:58:07', '2023-08-19 08:58:02', 'bsd', NULL, NULL, NULL, NULL, 8, '7376211cs239', '1', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_projects`
--
ALTER TABLE `m_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_resource`
--
ALTER TABLE `m_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_task`
--
ALTER TABLE `m_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `project_user_mapping`
--
ALTER TABLE `project_user_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_log`
--
ALTER TABLE `task_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_log`
--
ALTER TABLE `work_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_projects`
--
ALTER TABLE `m_projects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_resource`
--
ALTER TABLE `m_resource`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_user_mapping`
--
ALTER TABLE `project_user_mapping`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_log`
--
ALTER TABLE `work_log`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
