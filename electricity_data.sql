-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2017 at 02:07 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electricity_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `consumer_payment`
--

CREATE TABLE `consumer_payment` (
  `payment_id` int(11) NOT NULL,
  `con_id` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `bill_amount` double NOT NULL,
  `payment_value` double NOT NULL,
  `remain` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumer_payment`
--

INSERT INTO `consumer_payment` (`payment_id`, `con_id`, `year`, `month`, `payment_date`, `bill_amount`, `payment_value`, `remain`) VALUES
(64, 'Con-0002', 2017, 9, '2017-09-23 01:09:04', 13900, 5000, 8900),
(65, 'Con-0002', 2017, 9, '2017-09-23 01:09:19', 8900, 500, 8400),
(66, 'Con-0002', 2017, 9, '2017-09-23 01:09:40', 8400, 400, 8000),
(67, 'Con-0001', 2017, 9, '2017-09-23 01:09:23', 15883.5, 5000, 10883.5),
(68, 'Con-0001', 2017, 9, '2017-09-23 01:09:47', 10883.5, 1000, 9883.5),
(69, 'Con-0002', 2017, 9, '2017-09-23 01:09:34', 16000, 2000, 14000),
(70, 'Con-0002', 2017, 9, '2017-09-23 01:09:53', 6000, 3000, 3000),
(71, 'Con-0001', 2017, 9, '2017-09-23 01:09:10', 9883.5, 1000, 8883.5),
(74, 'Con-0001', 2017, 9, '2017-09-23 05:09:32', 10053.5, 5000, 5053.5),
(75, 'Con-0001', 2017, 9, '2017-09-23 09:09:04', 72553.5, 80000, -7446.5);

-- --------------------------------------------------------

--
-- Table structure for table `consumer_table`
--

CREATE TABLE `consumer_table` (
  `con_id` varchar(20) NOT NULL,
  `con_title` varchar(20) NOT NULL,
  `con_name` varchar(100) NOT NULL,
  `con_nic` varchar(10) NOT NULL,
  `con_address` varchar(200) NOT NULL,
  `con_contact` int(10) NOT NULL,
  `con_email` varchar(100) NOT NULL,
  `con_password` varchar(50) NOT NULL,
  `premises_id` varchar(10) NOT NULL,
  `tariff_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumer_table`
--

INSERT INTO `consumer_table` (`con_id`, `con_title`, `con_name`, `con_nic`, `con_address`, `con_contact`, `con_email`, `con_password`, `premises_id`, `tariff_id`) VALUES
('Con-0001', 'Mr', 'S.B. Ranjith Dharmasiri', '580213814V', '"Piumika", Sirigala, Monaragala', 724321708, 'ranjith@gmail.com', 'ranjith', 'Mo-0004', 'D-1'),
('Con-0002', 'Mrs', 'R.R. Sriyani Gunasena', '680212831V', '"Sena niwasa", Obbegoda, Monaragala', 710142855, 'sriyani@gmail.com', 'sriyani', 'Mo-0006', 'D-2'),
('Con-0003', 'Ms', 'Bagya Madushani', '930214758V', 'No 45, Sirigala, Monaragala', 724758846, 'bagya@gmail.com', 'bagya', 'Mo-0001', 'GP-1'),
('Con-0004', 'Mr', 'Shahen Dulash', '92014782V', 'Sirigala,Monaragala', 714569233, 'shahen@gmail.com', 'shahen', 'Mo-0005', 'GP-2'),
('Con-0005', 'Mr', 'Nimal Munasinghe', '945874283V', 'No 23, Hulandawa, Monaragala', 715846923, 'nimal@gmail.com', 'nimal', 'Mo-0003', 'GP-3');

-- --------------------------------------------------------

--
-- Table structure for table `consumption_table`
--

CREATE TABLE `consumption_table` (
  `cons_no` int(11) NOT NULL,
  `con_id` varchar(20) NOT NULL,
  `cons_date` date NOT NULL,
  `cons_time` time NOT NULL,
  `cons_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumption_table`
--

INSERT INTO `consumption_table` (`cons_no`, `con_id`, `cons_date`, `cons_time`, `cons_amount`) VALUES
(1, 'Con-0001', '2017-08-01', '00:00:24', 5),
(2, 'Con-0001', '2017-08-02', '00:00:24', 4),
(3, 'Con-0001', '2017-08-03', '00:00:24', 10),
(4, 'Con-0001', '2017-08-04', '00:00:24', 12),
(5, 'Con-0001', '2017-08-05', '00:00:24', 9),
(6, 'Con-0001', '2017-08-06', '00:00:24', 15),
(7, 'Con-0001', '2017-08-07', '00:00:24', 10),
(8, 'Con-0001', '2017-08-08', '00:00:24', 17),
(9, 'Con-0001', '2017-08-09', '00:00:24', 2),
(10, 'Con-0001', '2017-08-10', '00:00:24', 3),
(11, 'Con-0001', '2017-08-11', '00:00:24', 5),
(12, 'Con-0001', '2017-08-12', '00:00:24', 2),
(13, 'Con-0001', '2017-08-13', '00:00:24', 0),
(14, 'Con-0001', '2017-08-14', '00:00:24', 5),
(15, 'Con-0001', '2017-08-15', '00:00:24', 4),
(16, 'Con-0001', '2017-08-16', '00:00:24', 6),
(17, 'Con-0001', '2017-08-17', '00:00:24', 3),
(18, 'Con-0001', '2017-08-18', '00:00:24', 8),
(19, 'Con-0001', '2017-08-19', '00:00:24', 0),
(20, 'Con-0001', '2017-08-20', '00:00:24', 3),
(21, 'Con-0001', '2017-08-21', '00:00:24', 2),
(22, 'Con-0001', '2017-08-22', '00:00:24', 5),
(23, 'Con-0001', '2017-08-23', '00:00:24', 6),
(24, 'Con-0001', '2017-08-24', '00:00:24', 5),
(25, 'Con-0001', '2017-08-25', '00:00:24', 3),
(26, 'Con-0001', '2017-08-26', '00:00:24', 2),
(27, 'Con-0001', '2017-08-27', '00:00:24', 5),
(28, 'Con-0001', '2017-08-28', '00:00:24', 0),
(29, 'Con-0001', '2017-08-29', '00:00:24', 4),
(30, 'Con-0001', '2017-08-30', '00:00:24', 2),
(31, 'Con-0001', '2017-08-31', '18:00:24', 5),
(32, 'Con-0002', '2017-09-01', '05:32:24', 7),
(33, 'Con-0002', '2017-09-02', '18:00:00', 6),
(34, 'Con-0002', '2017-09-03', '10:24:24', 3),
(35, 'Con-0002', '2017-09-04', '11:10:24', 2),
(36, 'Con-0002', '2017-09-05', '22:00:00', 9),
(37, 'Con-0002', '2017-09-06', '04:19:08', 12),
(38, 'Con-0002', '0000-00-00', '00:00:24', 15),
(39, 'Con-0002', '0000-00-00', '00:00:24', 9),
(40, 'Con-0002', '2017-09-18', '18:54:43', 20),
(41, 'Con-0002', '2017-09-12', '22:59:00', 90),
(42, 'Con-0002', '0000-00-00', '05:00:00', 5),
(43, 'Con-0002', '2017-09-12', '18:20:00', 56),
(44, 'Con-0002', '2017-09-13', '05:00:00', 25),
(45, 'Con-0002', '2017-09-04', '19:58:00', 50),
(47, 'Con-0002', '2017-09-06', '10:42:00', 56),
(50, 'Con-0001', '2017-09-18', '20:16:29', 20),
(51, 'Con-0001', '2017-09-18', '20:16:59', 5),
(52, 'Con-0001', '2017-09-18', '20:17:29', 1),
(53, 'Con-0001', '2017-09-18', '20:17:59', 16),
(54, 'Con-0001', '2017-09-18', '20:18:29', 2),
(55, 'Con-0001', '2017-09-18', '20:18:59', 12),
(56, 'Con-0001', '2017-09-18', '20:19:29', 3),
(57, 'Con-0001', '2017-09-18', '20:20:56', 11),
(58, 'Con-0001', '2017-09-18', '20:21:30', 4),
(59, 'Con-0001', '2017-09-18', '20:22:19', 17),
(60, 'Con-0001', '2017-09-18', '20:30:10', 18),
(61, 'Con-0001', '2017-09-18', '20:30:40', 19),
(62, 'Con-0001', '2017-09-18', '20:33:09', 17),
(63, 'Con-0002', '2017-09-19', '11:11:21', 60),
(64, 'Con-0002', '2017-09-12', '04:00:00', 20),
(65, 'Con-0002', '2017-09-19', '10:36:00', 12),
(66, 'Con-0001', '2017-09-21', '14:51:51', 6),
(67, 'Con-0001', '2017-09-21', '14:51:52', 2),
(68, 'Con-0001', '2017-09-21', '14:52:21', 1),
(69, 'Con-0001', '2017-09-21', '14:52:22', 5),
(70, 'Con-0001', '2017-09-21', '14:53:50', 10),
(71, 'Con-0001', '2017-09-21', '14:54:05', 8),
(72, 'Con-0001', '2017-09-21', '14:54:20', 1),
(73, 'Con-0001', '2017-09-21', '14:54:35', 6),
(74, 'Con-0001', '2017-09-21', '14:54:50', 8),
(75, 'Con-0001', '2017-09-21', '14:55:05', 5),
(76, 'Con-0001', '2017-09-21', '14:55:05', 19),
(77, 'Con-0001', '2017-09-22', '08:08:07', 8),
(78, 'Con-0001', '2017-09-22', '08:08:12', 10),
(79, 'Con-0001', '2017-09-22', '08:08:17', 3),
(80, 'Con-0001', '2017-09-22', '08:08:22', 10),
(81, 'Con-0001', '2017-09-22', '08:08:27', 6),
(82, 'Con-0001', '2017-09-22', '08:08:32', 5),
(83, 'Con-0001', '2017-09-22', '08:08:37', 8),
(84, 'Con-0001', '2017-09-22', '08:08:45', 4),
(85, 'Con-0001', '2017-09-22', '08:08:50', 10),
(86, 'Con-0001', '2017-09-22', '08:08:55', 6),
(87, 'Con-0001', '2017-09-22', '08:09:00', 2),
(88, 'Con-0001', '2017-09-22', '08:09:05', 3),
(89, 'Con-0001', '2017-09-22', '08:12:49', 9),
(90, 'Con-0001', '2017-09-22', '08:12:54', 3),
(91, 'Con-0001', '2017-09-22', '08:13:22', 5),
(92, 'Con-0001', '2017-09-22', '08:13:27', 2),
(93, 'Con-0001', '2017-09-22', '08:13:32', 7),
(94, 'Con-0001', '2017-09-22', '08:13:37', 7),
(95, 'Con-0001', '2017-09-22', '08:13:42', 9),
(96, 'Con-0001', '2017-09-22', '08:13:47', 10),
(97, 'Con-0001', '2017-09-22', '08:13:52', 2),
(98, 'Con-0001', '2017-09-22', '08:13:57', 1),
(99, 'Con-0001', '2017-09-22', '08:15:19', 5),
(100, 'Con-0001', '2017-09-22', '08:15:24', 8),
(101, 'Con-0001', '2017-09-22', '08:15:29', 7),
(102, 'Con-0001', '2017-09-22', '08:15:34', 5),
(103, 'Con-0003', '2017-09-20', '04:00:00', 50),
(104, 'Con-0001', '2017-09-23', '03:56:19', 4),
(105, 'Con-0001', '2017-09-23', '03:56:24', 7),
(106, 'Con-0001', '2017-09-23', '03:56:29', 9),
(107, 'Con-0001', '2017-09-23', '03:56:34', 10),
(108, 'Con-0001', '2017-09-23', '03:56:39', 2),
(109, 'Con-0001', '2017-09-23', '03:56:44', 2),
(110, 'Con-0001', '2017-09-23', '03:56:49', 3),
(111, 'Con-0001', '2017-09-23', '03:56:54', 7),
(112, 'Con-0001', '2017-09-23', '03:56:59', 3),
(113, 'Con-0005', '2017-09-23', '04:28:41', 20),
(114, 'Con-0001', '2017-09-23', '08:49:54', 2),
(115, 'Con-0001', '2017-09-23', '08:49:59', 8),
(116, 'Con-0001', '2017-09-23', '08:50:04', 6),
(117, 'Con-0001', '2017-09-23', '08:50:09', 10),
(118, 'Con-0001', '2017-09-23', '09:07:51', 9),
(119, 'Con-0001', '2017-09-23', '09:07:56', 1),
(120, 'Con-0001', '2017-09-23', '09:08:01', 3),
(121, 'Con-0001', '2017-09-23', '09:08:06', 2),
(122, 'Con-0001', '2017-09-23', '09:08:11', 6),
(123, 'Con-0001', '2017-09-23', '09:08:16', 9),
(124, 'Con-0001', '2017-09-23', '09:08:21', 1),
(125, 'Con-0001', '2017-09-23', '09:08:26', 6),
(126, 'Con-0001', '2017-09-23', '09:08:31', 7),
(127, 'Con-0001', '2017-09-23', '09:08:36', 9),
(128, 'Con-0001', '2017-09-23', '09:08:41', 1),
(129, 'Con-0001', '2017-09-23', '09:08:46', 10),
(130, 'Con-0001', '2017-09-23', '09:08:51', 10),
(131, 'Con-0001', '2017-09-23', '09:08:56', 10),
(132, 'Con-0001', '2017-09-23', '09:09:01', 2),
(133, 'Con-0001', '2017-09-23', '09:09:06', 6),
(134, 'Con-0001', '2017-09-23', '09:09:11', 6),
(135, 'Con-0001', '2017-09-23', '09:09:16', 1),
(136, 'Con-0001', '2017-09-23', '09:09:21', 2),
(137, 'Con-0001', '2017-09-23', '09:09:26', 7),
(138, 'Con-0001', '2017-09-23', '09:09:31', 3),
(139, 'Con-0001', '2017-09-23', '09:09:36', 7),
(140, 'Con-0001', '2017-09-23', '09:09:41', 3),
(141, 'Con-0001', '2017-09-23', '09:09:46', 7),
(142, 'Con-0001', '2017-09-23', '09:09:51', 9),
(143, 'Con-0001', '2017-09-23', '09:09:56', 2),
(144, 'Con-0001', '2017-09-23', '09:10:01', 6),
(145, 'Con-0001', '2017-09-23', '09:10:06', 2),
(146, 'Con-0001', '2017-09-23', '09:10:11', 9),
(147, 'Con-0001', '2017-09-23', '09:10:16', 10),
(148, 'Con-0001', '2017-09-23', '09:10:21', 9),
(149, 'Con-0001', '2017-09-23', '09:10:26', 7),
(150, 'Con-0001', '2017-09-23', '09:10:31', 8),
(151, 'Con-0001', '2017-09-23', '09:10:36', 3),
(152, 'Con-0001', '2017-09-23', '09:10:41', 4),
(153, 'Con-0001', '2017-09-23', '09:10:46', 8),
(154, 'Con-0001', '2017-09-23', '09:10:51', 4),
(155, 'Con-0001', '2017-09-23', '09:10:56', 6),
(156, 'Con-0001', '2017-09-23', '09:11:01', 9),
(157, 'Con-0001', '2017-09-23', '09:11:06', 9),
(158, 'Con-0001', '2017-09-23', '09:11:11', 4),
(159, 'Con-0001', '2017-09-23', '09:11:16', 9),
(160, 'Con-0001', '2017-09-23', '09:11:21', 2),
(161, 'Con-0001', '2017-09-23', '09:11:26', 10),
(162, 'Con-0001', '2017-09-23', '09:11:31', 6),
(163, 'Con-0001', '2017-09-23', '09:11:36', 7),
(164, 'Con-0001', '2017-09-23', '09:11:41', 9),
(165, 'Con-0001', '2017-09-23', '09:11:46', 10),
(166, 'Con-0001', '2017-09-23', '09:11:51', 10),
(167, 'Con-0001', '2017-09-23', '09:11:56', 6),
(168, 'Con-0001', '2017-09-23', '09:12:01', 1),
(169, 'Con-0001', '2017-09-23', '09:12:06', 4),
(170, 'Con-0001', '2017-09-23', '09:12:11', 7),
(171, 'Con-0001', '2017-09-23', '09:12:16', 5),
(172, 'Con-0001', '2017-09-23', '09:12:21', 8),
(173, 'Con-0001', '2017-09-23', '09:12:26', 8),
(174, 'Con-0001', '2017-09-23', '09:12:31', 4),
(175, 'Con-0001', '2017-09-23', '09:12:36', 6),
(176, 'Con-0001', '2017-09-23', '09:12:41', 9),
(177, 'Con-0001', '2017-09-23', '09:12:46', 2),
(178, 'Con-0001', '2017-09-23', '09:12:51', 1),
(179, 'Con-0001', '2017-09-23', '09:12:56', 9),
(180, 'Con-0001', '2017-09-23', '09:13:01', 8),
(181, 'Con-0001', '2017-09-23', '09:13:06', 2),
(182, 'Con-0001', '2017-09-23', '09:13:11', 8),
(183, 'Con-0001', '2017-09-23', '09:13:16', 7),
(184, 'Con-0001', '2017-09-23', '09:13:21', 10),
(185, 'Con-0001', '2017-09-23', '09:13:26', 3),
(186, 'Con-0001', '2017-09-23', '09:13:31', 5),
(187, 'Con-0001', '2017-09-23', '09:13:36', 1),
(188, 'Con-0001', '2017-09-23', '09:13:41', 9),
(189, 'Con-0001', '2017-09-23', '09:13:46', 3),
(190, 'Con-0001', '2017-09-23', '09:13:51', 1),
(191, 'Con-0001', '2017-09-23', '09:13:56', 9),
(192, 'Con-0001', '2017-09-23', '09:14:01', 6),
(193, 'Con-0001', '2017-09-23', '09:14:06', 5),
(194, 'Con-0001', '2017-09-23', '09:14:11', 5),
(195, 'Con-0001', '2017-09-23', '09:14:16', 8),
(196, 'Con-0001', '2017-09-23', '09:14:22', 5),
(197, 'Con-0001', '2017-09-23', '09:14:27', 8),
(198, 'Con-0001', '2017-09-23', '09:14:32', 7),
(199, 'Con-0001', '2017-09-23', '09:14:37', 7),
(200, 'Con-0001', '2017-09-23', '09:14:42', 2),
(201, 'Con-0001', '2017-09-23', '09:14:47', 10),
(202, 'Con-0001', '2017-09-23', '09:14:52', 4),
(203, 'Con-0001', '2017-09-23', '09:14:57', 8),
(204, 'Con-0001', '2017-09-23', '09:15:02', 10),
(205, 'Con-0001', '2017-09-23', '09:15:07', 6),
(206, 'Con-0001', '2017-09-23', '09:15:12', 8),
(207, 'Con-0001', '2017-09-23', '09:15:17', 6),
(208, 'Con-0001', '2017-09-23', '09:15:22', 3),
(209, 'Con-0001', '2017-09-23', '09:15:27', 4),
(210, 'Con-0001', '2017-09-23', '09:15:32', 5),
(211, 'Con-0001', '2017-09-23', '09:15:37', 3),
(212, 'Con-0001', '2017-09-23', '09:15:42', 3),
(213, 'Con-0001', '2017-09-23', '09:15:47', 8),
(214, 'Con-0001', '2017-09-23', '09:15:52', 9),
(215, 'Con-0001', '2017-09-23', '09:15:57', 6),
(216, 'Con-0001', '2017-09-23', '09:16:02', 2),
(217, 'Con-0001', '2017-09-23', '09:16:07', 6),
(218, 'Con-0001', '2017-09-23', '09:16:12', 4),
(219, 'Con-0001', '2017-09-23', '09:16:17', 10),
(220, 'Con-0001', '2017-09-23', '09:16:22', 3),
(221, 'Con-0001', '2017-09-23', '09:16:27', 10),
(222, 'Con-0001', '2017-09-23', '09:16:32', 10),
(223, 'Con-0001', '2017-09-23', '09:16:37', 6),
(224, 'Con-0001', '2017-09-23', '09:16:42', 8),
(225, 'Con-0001', '2017-09-23', '09:16:47', 6),
(226, 'Con-0001', '2017-09-23', '09:16:52', 9),
(227, 'Con-0001', '2017-09-23', '09:16:57', 6),
(228, 'Con-0001', '2017-09-23', '09:17:02', 6),
(229, 'Con-0001', '2017-09-23', '09:17:07', 2),
(230, 'Con-0001', '2017-09-23', '09:17:12', 10),
(231, 'Con-0001', '2017-09-23', '09:17:17', 4),
(232, 'Con-0001', '2017-09-23', '09:17:22', 6),
(233, 'Con-0001', '2017-09-23', '09:17:27', 6),
(234, 'Con-0001', '2017-09-23', '09:17:32', 9),
(235, 'Con-0001', '2017-09-23', '09:17:37', 3),
(236, 'Con-0001', '2017-09-23', '09:17:42', 3),
(237, 'Con-0001', '2017-09-23', '09:17:47', 5),
(238, 'Con-0001', '2017-09-23', '09:17:52', 3),
(239, 'Con-0001', '2017-09-23', '09:17:57', 1),
(240, 'Con-0001', '2017-09-23', '09:18:02', 10),
(241, 'Con-0001', '2017-09-23', '09:18:07', 5),
(242, 'Con-0001', '2017-09-23', '09:18:12', 9),
(243, 'Con-0001', '2017-09-23', '09:18:17', 1),
(244, 'Con-0001', '2017-09-23', '09:18:22', 2),
(245, 'Con-0001', '2017-09-23', '09:18:27', 4),
(246, 'Con-0001', '2017-09-23', '09:18:32', 10),
(247, 'Con-0001', '2017-09-23', '09:18:37', 8),
(248, 'Con-0001', '2017-09-23', '09:18:42', 1),
(249, 'Con-0001', '2017-09-23', '09:18:47', 6),
(250, 'Con-0001', '2017-09-23', '09:18:52', 2),
(251, 'Con-0001', '2017-09-23', '09:18:57', 1),
(252, 'Con-0001', '2017-09-23', '09:19:02', 5),
(253, 'Con-0001', '2017-09-23', '09:19:07', 8),
(254, 'Con-0001', '2017-09-23', '09:19:12', 10),
(255, 'Con-0001', '2017-09-23', '09:19:17', 2),
(256, 'Con-0001', '2017-09-23', '09:19:22', 7),
(257, 'Con-0001', '2017-09-23', '09:19:27', 1),
(258, 'Con-0001', '2017-09-23', '09:19:32', 4),
(259, 'Con-0001', '2017-09-23', '09:19:37', 6),
(260, 'Con-0001', '2017-09-23', '09:19:42', 3),
(261, 'Con-0001', '2017-09-23', '09:19:47', 10),
(262, 'Con-0001', '2017-09-23', '09:19:52', 6),
(263, 'Con-0001', '2017-09-23', '09:19:57', 7),
(264, 'Con-0001', '2017-09-23', '09:20:02', 6),
(265, 'Con-0001', '2017-09-23', '09:20:07', 10),
(266, 'Con-0001', '2017-09-23', '09:20:12', 6),
(267, 'Con-0001', '2017-09-23', '09:20:17', 2),
(268, 'Con-0001', '2017-09-23', '09:20:22', 8),
(269, 'Con-0001', '2017-09-23', '09:20:27', 5),
(270, 'Con-0001', '2017-09-23', '09:20:32', 3),
(271, 'Con-0001', '2017-09-23', '09:20:37', 8),
(272, 'Con-0001', '2017-09-23', '09:20:42', 9),
(273, 'Con-0001', '2017-09-23', '09:20:47', 3),
(274, 'Con-0001', '2017-09-23', '09:20:52', 1),
(275, 'Con-0001', '2017-09-23', '09:20:57', 5),
(276, 'Con-0001', '2017-09-23', '09:21:02', 5),
(277, 'Con-0001', '2017-09-23', '09:21:07', 1),
(278, 'Con-0001', '2017-09-23', '09:21:12', 6),
(279, 'Con-0001', '2017-09-23', '09:21:17', 6),
(280, 'Con-0001', '2017-09-23', '09:21:22', 1),
(281, 'Con-0001', '2017-09-23', '09:21:27', 3),
(282, 'Con-0001', '2017-09-23', '09:21:32', 10),
(283, 'Con-0001', '2017-09-23', '09:21:37', 4),
(284, 'Con-0001', '2017-09-23', '09:21:42', 1),
(285, 'Con-0001', '2017-09-23', '09:21:47', 3),
(286, 'Con-0001', '2017-09-23', '09:21:52', 4),
(287, 'Con-0001', '2017-09-23', '09:21:57', 3),
(288, 'Con-0001', '2017-09-23', '09:22:02', 10),
(289, 'Con-0001', '2017-09-23', '09:22:07', 9),
(290, 'Con-0001', '2017-09-23', '09:22:12', 3),
(291, 'Con-0001', '2017-09-23', '09:22:17', 9),
(292, 'Con-0001', '2017-09-23', '09:22:22', 6),
(293, 'Con-0001', '2017-09-23', '09:22:27', 6),
(294, 'Con-0001', '2017-09-23', '09:22:32', 3),
(295, 'Con-0001', '2017-09-23', '09:22:37', 3),
(296, 'Con-0001', '2017-09-23', '09:22:42', 2),
(297, 'Con-0001', '2017-09-23', '09:22:47', 9),
(298, 'Con-0001', '2017-09-23', '09:22:52', 5),
(299, 'Con-0001', '2017-09-23', '09:22:57', 6),
(300, 'Con-0001', '2017-09-23', '09:23:02', 3),
(301, 'Con-0001', '2017-09-23', '09:23:07', 6),
(302, 'Con-0001', '2017-09-23', '09:23:12', 9),
(303, 'Con-0001', '2017-09-23', '09:23:17', 7),
(304, 'Con-0001', '2017-09-23', '09:23:22', 7),
(305, 'Con-0001', '2017-09-23', '09:23:27', 8),
(306, 'Con-0001', '2017-09-23', '09:23:32', 4),
(307, 'Con-0001', '2017-09-23', '09:23:37', 6),
(308, 'Con-0001', '2017-09-23', '09:23:42', 6),
(309, 'Con-0001', '2017-09-23', '09:23:47', 7),
(310, 'Con-0001', '2017-09-23', '09:23:52', 6),
(311, 'Con-0001', '2017-09-23', '09:23:57', 2),
(312, 'Con-0001', '2017-09-23', '09:24:02', 8),
(313, 'Con-0001', '2017-09-23', '09:24:07', 7),
(314, 'Con-0001', '2017-09-23', '09:24:12', 6),
(315, 'Con-0001', '2017-09-23', '09:24:17', 5),
(316, 'Con-0001', '2017-09-23', '09:24:22', 3),
(317, 'Con-0001', '2017-09-23', '09:24:27', 5),
(318, 'Con-0001', '2017-09-23', '09:24:32', 10),
(319, 'Con-0001', '2017-09-23', '09:24:37', 9),
(320, 'Con-0001', '2017-09-23', '09:24:42', 9),
(321, 'Con-0001', '2017-09-23', '09:24:47', 3),
(322, 'Con-0001', '2017-09-23', '09:24:52', 5),
(323, 'Con-0001', '2017-09-23', '09:24:57', 10),
(324, 'Con-0001', '2017-09-23', '09:25:02', 4),
(325, 'Con-0001', '2017-09-23', '09:25:07', 1),
(326, 'Con-0001', '2017-09-23', '09:25:12', 6),
(327, 'Con-0001', '2017-09-23', '09:25:17', 6),
(328, 'Con-0001', '2017-09-23', '09:25:22', 4),
(329, 'Con-0001', '2017-09-23', '09:25:27', 9),
(330, 'Con-0001', '2017-09-23', '09:25:32', 5),
(331, 'Con-0001', '2017-09-23', '09:25:37', 4),
(332, 'Con-0001', '2017-09-23', '09:25:42', 5),
(333, 'Con-0001', '2017-09-23', '09:25:47', 2),
(334, 'Con-0001', '2017-09-23', '09:25:52', 3),
(335, 'Con-0001', '2017-09-23', '09:25:57', 5),
(336, 'Con-0001', '2017-09-23', '09:26:02', 9),
(337, 'Con-0001', '2017-09-23', '09:26:07', 1),
(338, 'Con-0001', '2017-09-23', '09:26:12', 5),
(339, 'Con-0001', '2017-09-23', '09:26:17', 2),
(340, 'Con-0001', '2017-09-23', '09:26:22', 10),
(341, 'Con-0001', '2017-09-23', '09:26:27', 2),
(342, 'Con-0001', '2017-09-23', '09:26:32', 6),
(343, 'Con-0001', '2017-09-23', '09:26:37', 8),
(344, 'Con-0001', '2017-09-23', '09:26:42', 10),
(345, 'Con-0001', '2017-09-23', '09:26:47', 3),
(346, 'Con-0001', '2017-09-23', '09:26:52', 4),
(347, 'Con-0001', '2017-09-23', '09:26:57', 5),
(348, 'Con-0001', '2017-09-23', '09:27:02', 10),
(349, 'Con-0001', '2017-09-23', '09:27:07', 4),
(350, 'Con-0001', '2017-09-23', '09:27:12', 6),
(351, 'Con-0001', '2017-09-23', '09:27:17', 8),
(352, 'Con-0001', '2017-09-23', '09:27:22', 4),
(353, 'Con-0001', '2017-09-23', '09:27:27', 3),
(354, 'Con-0001', '2017-09-23', '09:27:32', 7),
(355, 'Con-0001', '2017-09-23', '09:27:37', 2),
(356, 'Con-0001', '2017-09-23', '09:27:42', 7),
(357, 'Con-0001', '2017-09-23', '09:27:47', 9),
(358, 'Con-0001', '2017-09-23', '09:27:52', 3),
(359, 'Con-0001', '2017-09-23', '09:27:57', 4),
(360, 'Con-0001', '2017-09-23', '09:28:02', 10),
(361, 'Con-0001', '2017-09-23', '09:28:07', 10),
(362, 'Con-0001', '2017-09-23', '09:28:12', 4),
(363, 'Con-0001', '2017-09-23', '09:28:17', 8),
(364, 'Con-0001', '2017-09-23', '09:28:22', 6),
(365, 'Con-0001', '2017-09-23', '09:28:27', 8),
(366, 'Con-0001', '2017-09-23', '09:28:32', 3),
(367, 'Con-0001', '2017-09-23', '09:28:37', 5),
(368, 'Con-0001', '2017-09-23', '09:28:42', 3),
(369, 'Con-0001', '2017-09-23', '09:28:47', 4),
(370, 'Con-0001', '2017-09-23', '09:28:52', 3),
(371, 'Con-0001', '2017-09-23', '09:28:57', 3),
(372, 'Con-0001', '2017-09-23', '09:29:02', 2),
(373, 'Con-0001', '2017-09-23', '09:29:07', 4),
(374, 'Con-0001', '2017-09-23', '09:29:12', 1),
(375, 'Con-0001', '2017-09-23', '09:29:17', 4),
(376, 'Con-0001', '2017-09-23', '09:29:22', 1),
(377, 'Con-0001', '2017-09-23', '09:29:27', 3),
(378, 'Con-0001', '2017-09-23', '09:29:32', 4),
(379, 'Con-0001', '2017-09-23', '09:29:37', 2),
(380, 'Con-0001', '2017-09-23', '09:29:42', 4),
(381, 'Con-0001', '2017-09-23', '09:29:47', 2),
(382, 'Con-0001', '2017-09-23', '09:29:52', 1),
(383, 'Con-0001', '2017-09-23', '09:29:57', 7),
(384, 'Con-0001', '2017-09-23', '09:30:02', 9),
(385, 'Con-0001', '2017-09-23', '09:30:07', 6),
(386, 'Con-0001', '2017-09-23', '09:30:12', 9),
(387, 'Con-0001', '2017-09-23', '09:30:17', 5);

-- --------------------------------------------------------

--
-- Table structure for table `consumption_time_table`
--

CREATE TABLE `consumption_time_table` (
  `id` int(11) NOT NULL,
  `con_id` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `peak_con` int(11) NOT NULL,
  `off_peak_con` int(11) NOT NULL,
  `day_con` int(11) NOT NULL,
  `peak_rs` double NOT NULL,
  `off_peak_rs` double NOT NULL,
  `day_rs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumption_time_table`
--

INSERT INTO `consumption_time_table` (`id`, `con_id`, `year`, `month`, `peak_con`, `off_peak_con`, `day_con`, `peak_rs`, `off_peak_rs`, `day_rs`) VALUES
(6, 'Con-0002', 2017, 9, 79, 57, 202, 1027, 1425, 10908),
(7, 'Con-0004', 2017, 9, 0, 0, 0, 0, 0, 0),
(8, 'Con-0005', 2017, 9, 0, 20, 0, 0, 287, 0);

-- --------------------------------------------------------

--
-- Table structure for table `electricity_bill_table`
--

CREATE TABLE `electricity_bill_table` (
  `bill_id` int(11) NOT NULL,
  `con_id` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `consumption` int(11) NOT NULL,
  `bill_amount` double NOT NULL,
  `outstanding` double NOT NULL,
  `total_amount` double NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `electricity_bill_table`
--

INSERT INTO `electricity_bill_table` (`bill_id`, `con_id`, `year`, `month`, `consumption`, `bill_amount`, `outstanding`, `total_amount`, `is_paid`) VALUES
(67, 'Con-0001', 2017, 9, 418, 15883.5, 0, 15883.5, 1),
(68, 'Con-0002', 2017, 9, 428, 13900, 2100, 16000, 1),
(69, 'Con-0003', 2017, 9, 50, 0, 0, 0, 0),
(70, 'Con-0004', 2017, 9, 0, 4100, 0, 4100, 0),
(71, 'Con-0005', 2017, 9, 20, 4287, 0, 4287, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_table`
--

CREATE TABLE `employee_table` (
  `emp_id` varchar(10) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_post` varchar(50) NOT NULL,
  `emp_telephone` int(10) NOT NULL,
  `emp_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_table`
--

INSERT INTO `employee_table` (`emp_id`, `emp_name`, `emp_post`, `emp_telephone`, `emp_password`) VALUES
('Emp-0001', 'R.M. Susantha Pradeep', 'Accountant', 725748856, 'accountant'),
('Emp-0002', 'W.D. Shahen Dulash', 'Data Entry Clerk', 715899633, 'dataEntryClerk'),
('Emp-0003', 'K. Buddhi Ashan', 'Electrical Engineer', 718745952, 'electricalEngineer'),
('Emp-0004', 'G.N. Dinush Asanka', 'Revenue Clerk', 774541563, 'revenueClerk'),
('Emp-0005', 'P.G. Prasanna Ranathunga', 'Admin', 778477952, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `message_table`
--

CREATE TABLE `message_table` (
  `msg_id` int(11) NOT NULL,
  `msg_info` varchar(500) NOT NULL,
  `msg_date` date NOT NULL,
  `msg_time` time NOT NULL,
  `con_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meter`
--

CREATE TABLE `meter` (
  `meter_no` int(11) NOT NULL,
  `meter_reading` int(11) NOT NULL,
  `con_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meter`
--

INSERT INTO `meter` (`meter_no`, `meter_reading`, `con_id`) VALUES
(1, 4302220, 'Con-0001'),
(2, 458710, 'Con-0002');

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE `payment_table` (
  `adjustment` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `premises_table`
--

CREATE TABLE `premises_table` (
  `premises_id` varchar(10) NOT NULL,
  `premises_name` varchar(50) NOT NULL,
  `transformer_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premises_table`
--

INSERT INTO `premises_table` (`premises_id`, `premises_name`, `transformer_id`) VALUES
('Mo-0001', 'Monaragala', 'trans-001'),
('Mo-0002', 'Hulandawa Left', 'trans-002'),
('Mo-0003', 'Hulandawa Right', 'trans-002'),
('Mo-0004', 'Bibile', 'trans-002'),
('Mo-0005', 'Obbegoda', 'trans-003'),
('Mo-0006', 'Dambagalla', 'trans-003'),
('Mo-0007', 'Dombagahawela', 'trans-003'),
('Mo-0008', 'Athimale', 'trans-003'),
('Mo-0009', 'Kotiyagala', 'trans-001'),
('Mo-0010', 'Siyabalanduwa', 'trans-001');

-- --------------------------------------------------------

--
-- Table structure for table `reconnecting_payment`
--

CREATE TABLE `reconnecting_payment` (
  `recon_id` int(11) NOT NULL,
  `con_id` varchar(20) NOT NULL,
  `recon_date` date NOT NULL,
  `recon_payment` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reconnecting_payment`
--

INSERT INTO `reconnecting_payment` (`recon_id`, `con_id`, `recon_date`, `recon_payment`) VALUES
(7, 'Con-0001', '2017-09-20', 697.7);

-- --------------------------------------------------------

--
-- Table structure for table `tariff_table`
--

CREATE TABLE `tariff_table` (
  `tariff_id` varchar(10) NOT NULL,
  `tariff_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tariff_table`
--

INSERT INTO `tariff_table` (`tariff_id`, `tariff_name`) VALUES
('D-0', 'If consumption less than 60 units (D-1)'),
('D-1', 'Domestic purpose (Unit Rate)'),
('D-2', 'Domestic purpose (Time Rate)'),
('des', 's'),
('GP-1', 'General Purpose 1 (Unit Rate)'),
('GP-2', 'General Purpose 1 (Time Rate)'),
('GP-3', 'General Purpose 2 (Time Rate)'),
('GV-1', 'Government Purpose 1 (Unit Rate) - Schools'),
('GV-2', 'Government Purpose 2 (Unit Rate) - Universities'),
('GV-3', 'Government Purpose 3 (Unit Rate) - Hospitals'),
('H-1', 'Hotel Purpose 1 (Unit Rate)'),
('H-2', 'Hotel Purpose 2 (Time Rate) - Large'),
('H-3', 'Hotel Purpose 3 (Time Rate) - Small'),
('has', 'has'),
('I-1', 'Industry Purpose 1 (Unit Rate)'),
('I-2', 'Industry Purpose 2 (Time Rate) - Small'),
('I-3', 'Industry Purpose 3 (Time Rate) - Large'),
('R-1', 'Religious Purpose (Unit Rate)'),
('Z-1', 'hjhj');

-- --------------------------------------------------------

--
-- Table structure for table `tariff_time_table`
--

CREATE TABLE `tariff_time_table` (
  `tariff_no` int(11) NOT NULL,
  `tariff_time_id` varchar(10) NOT NULL,
  `peak` double NOT NULL,
  `off_peak` double NOT NULL,
  `day` double NOT NULL,
  `fixed_charge` double NOT NULL,
  `demand_charge` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tariff_time_table`
--

INSERT INTO `tariff_time_table` (`tariff_no`, `tariff_time_id`, `peak`, `off_peak`, `day`, `fixed_charge`, `demand_charge`) VALUES
(1, 'GP-2', 26.6, 15.4, 21.8, 3000, 1100),
(2, 'GP-3', 25.5, 14.35, 20.7, 3000, 1000),
(3, 'H-2', 23.5, 9.8, 14.65, 3000, 1100),
(4, 'H-3', 22.5, 8.8, 13.7, 3000, 1000),
(5, 'I-2', 20.5, 6.85, 11, 3000, 1100),
(6, 'I-3', 23.5, 5.9, 10.25, 3000, 1000),
(7, 'D-2', 13, 25, 54, 540, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tariff_unit_table`
--

CREATE TABLE `tariff_unit_table` (
  `tariff_no` int(11) NOT NULL,
  `tariff_unit_id` varchar(10) NOT NULL,
  `start_unit` int(10) NOT NULL,
  `end_unit` int(10) NOT NULL,
  `unit_charge` double NOT NULL,
  `fixed_charge` double NOT NULL,
  `demand_charge` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tariff_unit_table`
--

INSERT INTO `tariff_unit_table` (`tariff_no`, `tariff_unit_id`, `start_unit`, `end_unit`, `unit_charge`, `fixed_charge`, `demand_charge`) VALUES
(1, 'D-0', 0, 30, 2.5, 30, 0),
(2, 'D-0', 31, 60, 4.85, 60, 0),
(3, 'D-1', 0, 60, 7.85, 60, 0),
(4, 'D-1', 61, 90, 10, 90, 0),
(5, 'D-1', 91, 120, 27.75, 480, 0),
(6, 'D-1', 121, 180, 32, 480, 0),
(7, 'D-1', 181, 1000000, 45, 540, 0),
(8, 'R-1', 0, 30, 1.9, 30, 0),
(9, 'R-1', 31, 90, 2.8, 60, 0),
(10, 'R-1', 91, 120, 6.75, 180, 0),
(11, 'R-1', 121, 180, 7.5, 180, 0),
(12, 'R-1', 181, 1000000, 9.4, 240, 0),
(13, 'GP-1', 0, 300, 18.3, 240, 0),
(14, 'GP-1', 301, 1000000, 22.85, 240, 0),
(15, 'GV-1', 0, 1000000, 14.65, 600, 0),
(16, 'GV-2', 0, 1000000, 14.55, 3000, 1100),
(17, 'GV-3', 0, 1000000, 14.35, 3000, 1000),
(18, 'H-1', 0, 1000000, 21.5, 600, 0),
(19, 'I-1', 0, 300, 10.8, 600, 0),
(20, 'I-1', 301, 1000000, 12.2, 600, 0),
(37, 'des', 1, 1, 1, 1, 1),
(38, 'has', -1, 1, 1, 1, 1),
(41, 'Z-1', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `time_plan`
--

CREATE TABLE `time_plan` (
  `time_plan_no` int(11) NOT NULL,
  `time_plan_id` varchar(20) NOT NULL,
  `peak` time NOT NULL,
  `off_peak` time NOT NULL,
  `day` time NOT NULL,
  `implement_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_plan`
--

INSERT INTO `time_plan` (`time_plan_no`, `time_plan_id`, `peak`, `off_peak`, `day`, `implement_date`) VALUES
(1, 'plan_01', '22:30:00', '05:30:00', '18:30:00', '2017-01-01 00:00:00'),
(2, '', '00:00:00', '00:00:00', '00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transformer`
--

CREATE TABLE `transformer` (
  `transformer_id` varchar(20) NOT NULL,
  `situation` varchar(50) NOT NULL,
  `trans_date` date NOT NULL,
  `usages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transformer`
--

INSERT INTO `transformer` (`transformer_id`, `situation`, `trans_date`, `usages`) VALUES
('trans-001', 'Sirigala', '2017-09-22', 1000),
('trans-002', 'Hulandawa', '2017-09-22', 2000),
('trans-003', 'Obbegoda', '2017-09-22', 5000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consumer_payment`
--
ALTER TABLE `consumer_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `consumer_table`
--
ALTER TABLE `consumer_table`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `consumption_table`
--
ALTER TABLE `consumption_table`
  ADD PRIMARY KEY (`cons_no`);

--
-- Indexes for table `consumption_time_table`
--
ALTER TABLE `consumption_time_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electricity_bill_table`
--
ALTER TABLE `electricity_bill_table`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `employee_table`
--
ALTER TABLE `employee_table`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `message_table`
--
ALTER TABLE `message_table`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `meter`
--
ALTER TABLE `meter`
  ADD PRIMARY KEY (`meter_no`);

--
-- Indexes for table `premises_table`
--
ALTER TABLE `premises_table`
  ADD PRIMARY KEY (`premises_id`);

--
-- Indexes for table `reconnecting_payment`
--
ALTER TABLE `reconnecting_payment`
  ADD PRIMARY KEY (`recon_id`);

--
-- Indexes for table `tariff_table`
--
ALTER TABLE `tariff_table`
  ADD PRIMARY KEY (`tariff_id`);

--
-- Indexes for table `tariff_time_table`
--
ALTER TABLE `tariff_time_table`
  ADD PRIMARY KEY (`tariff_no`);

--
-- Indexes for table `tariff_unit_table`
--
ALTER TABLE `tariff_unit_table`
  ADD PRIMARY KEY (`tariff_no`);

--
-- Indexes for table `time_plan`
--
ALTER TABLE `time_plan`
  ADD PRIMARY KEY (`time_plan_no`);

--
-- Indexes for table `transformer`
--
ALTER TABLE `transformer`
  ADD PRIMARY KEY (`transformer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consumer_payment`
--
ALTER TABLE `consumer_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `consumption_table`
--
ALTER TABLE `consumption_table`
  MODIFY `cons_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;
--
-- AUTO_INCREMENT for table `consumption_time_table`
--
ALTER TABLE `consumption_time_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `electricity_bill_table`
--
ALTER TABLE `electricity_bill_table`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `message_table`
--
ALTER TABLE `message_table`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `meter`
--
ALTER TABLE `meter`
  MODIFY `meter_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reconnecting_payment`
--
ALTER TABLE `reconnecting_payment`
  MODIFY `recon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tariff_time_table`
--
ALTER TABLE `tariff_time_table`
  MODIFY `tariff_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tariff_unit_table`
--
ALTER TABLE `tariff_unit_table`
  MODIFY `tariff_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `time_plan`
--
ALTER TABLE `time_plan`
  MODIFY `time_plan_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
