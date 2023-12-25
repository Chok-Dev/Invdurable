-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2023 at 12:57 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `durable`
--

-- --------------------------------------------------------

--
-- Table structure for table `com_service_list`
--

CREATE TABLE `com_service_list` (
  `service_list_id` int NOT NULL,
  `service_list_name` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci DEFAULT '',
  `v_id` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci DEFAULT NULL,
  `money_service` decimal(20,2) DEFAULT NULL COMMENT 'มูลค่าเงิน',
  `time_set` decimal(20,2) DEFAULT NULL COMMENT 'ระยะเวลาการแก้ปัญหา'
) ENGINE=InnoDB DEFAULT CHARSET=tis620 COMMENT='บริการอื่นๆระบบซ่อมคอม';

--
-- Dumping data for table `com_service_list`
--

INSERT INTO `com_service_list` (`service_list_id`, `service_list_name`, `v_id`, `money_service`, `time_set`) VALUES
(7, 'เครื่องคอมพิวเตอร์ขัดข้อง', '9999-888-0001/1', NULL, NULL),
(8, 'เครือข่ายคอมพิวเตอร์ขัดข้อง', '9999-888-0002/1', NULL, NULL),
(9, 'เครื่องสำรองไฟขัดข้อง', '9999-888-0003/1', NULL, NULL),
(10, 'อุปกรณ์อื่นขัดข้อง เช่น Smart Phone, EDC ฯลฯ', '9999-888-0004/1', NULL, NULL),
(11, 'เครื่องพิมพ์หมึกหมด', '9999-888-0005/1', NULL, NULL),
(12, 'ขอรายงาน/ข้อมูล การบริการ', '9999-888-0006/1', NULL, NULL),
(13, 'ขอรายงาน/ข้อมูล ด้านการเบิกชดเชยและการเงิน', '9999-888-0007/1', NULL, NULL),
(14, 'ขอรายงาน/ข้อมูล ส่วนตัวของเจ้าหน้าที่', '9999-888-0008/1', NULL, NULL),
(15, 'ขอคำปรึกษาเรื่องการใช้งานอุปกรณ์', '9999-888-0009/1', NULL, NULL),
(16, 'ขอคำปรึกษาเรื่องการใช้งานโปรแกรม', '9999-888-0010/1', NULL, NULL),
(17, 'ขอคำปรึกษาเรื่องระบบงานข้อมูล', '9999-888-0011/1', NULL, NULL),
(18, 'ขอให้จัดเตรียม/ติดตั้ง/ย้ายอุปกรณ์', '9999-888-0012/1', NULL, NULL),
(19, 'ขอให้พัฒนาโปรแกรม', '9999-888-0013/1', NULL, NULL),
(20, 'เครื่องพิมพ์ขัดข้อง', '9999-888-0014/1', NULL, NULL),
(21, 'โปรแกรมขัดข้อง', '9999-888-0015/1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_type`
--

CREATE TABLE `com_type` (
  `com_type_id` int NOT NULL,
  `com_type_name` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=tis620 COMMENT='ประเภทคอมพิวเตอร์' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `com_type`
--

INSERT INTO `com_type` (`com_type_id`, `com_type_name`, `created_at`, `updated_at`) VALUES
(1, 'คอมพิวเตอร์ PC', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(2, 'คอมพิวเตอร์ Server', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(3, 'คอมพิวเตอร์ Notebook', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(4, 'คอมพิวเตอร์ All-in-one', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(5, 'จอมอนิเตอร์', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(6, 'เครื่อง Scanner', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(7, 'เครื่องอ่านบัตร Smart Card', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(8, 'เครื่อง Printer (ทั่วไป)', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(9, 'เครื่อง Printer (ถ่ายเอกสารได้)', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(10, 'เครื่อง Printer (พิมพ์ใบเสร็จ)', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(12, 'เครื่องสำรองไฟ UPS', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(13, 'เครื่อง Printer (สติ๊กเกอร์)', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(14, 'เครื่อง EDC', '2023-09-29 07:45:03', '2023-09-29 07:45:03'),
(18, 'นอกเหนือครุภัณฑ์', '2023-11-18 15:42:19', '2023-11-18 15:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `durable_engineer`
--

CREATE TABLE `durable_engineer` (
  `id` int NOT NULL,
  `engineer_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `durable_engineer`
--

INSERT INTO `durable_engineer` (`id`, `engineer_name`) VALUES
(484, 'นายสิริวัชร ภวะภูตานนท์'),
(486, 'นายสุทธิชัย ลำพุทธา'),
(487, 'นายศุภชัย สุนารักษ์'),
(488, 'นายพงศธร คำบ่อเศร้า'),
(543, 'นายเจริญราษฎร์ ลิศรี');

-- --------------------------------------------------------

--
-- Table structure for table `durable_fix`
--

CREATE TABLE `durable_fix` (
  `id` int NOT NULL,
  `solution` text NOT NULL,
  `signed` text,
  `help_evl_type_id` bigint DEFAULT NULL,
  `help_apprv_emp_id` bigint DEFAULT NULL,
  `com_id` varchar(255) NOT NULL,
  `repair_by_id` bigint NOT NULL,
  `status_id` int DEFAULT NULL,
  `service_list_id` bigint NOT NULL,
  `hos_repiar_id` bigint NOT NULL,
  `name` text,
  `tel_number` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inv_durable_rate_after_point` int DEFAULT NULL,
  `inv_durable_rate_after_emp_id` int DEFAULT NULL,
  `help_detail` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `durable_goods`
--

CREATE TABLE `durable_goods` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `durable_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durable_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inv_dep_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_type_id` bigint DEFAULT NULL,
  `anydesk_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_received` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `durable_goods`
--

INSERT INTO `durable_goods` (`id`, `durable_name`, `durable_id`, `inv_dep_id`, `com_type_id`, `anydesk_ip`, `year_received`, `created_at`, `updated_at`) VALUES
('COM0000001', 'drug_store_1', '7440-001-0001/312', '43', 4, '707564189', NULL, '2023-06-22 20:25:42', '2023-07-21 16:21:30'),
('COM0000002', 'drug_store_2', '7440-001-0001/443', '43', 4, '222134333', NULL, '2023-06-22 20:25:42', '2023-07-14 10:03:03'),
('COM0000003', 'drug_store_3', '7440-001-0001/441', '43', 4, '1439385151', NULL, '2023-06-22 20:25:42', '2023-07-14 10:03:10'),
('COM0000004', 'drug_store_4', '7440-001-0001/439', '43', 4, '551755496', NULL, '2023-06-22 20:25:42', '2023-07-14 10:02:50'),
('COM0000005', 'Supply_1', '7440-001-0001/240', '21', 4, '1146910450', NULL, '2023-06-22 20:38:17', '2023-07-14 10:00:02'),
('COM0000006', 'Supply_2', '7440-001-5002/279', '21', 4, '1148434003', NULL, '2023-06-22 20:38:48', '2023-07-14 10:00:07'),
('COM0000007', 'nutrition_1', '7440-001-0001/271', '15', 4, '1593136719', NULL, '2023-06-22 20:39:34', '2023-07-14 10:02:24'),
('COM0000008', 'nutrition_2', '7440-001-0001/245', '15', 4, '1174037894', NULL, '2023-06-22 20:40:04', '2023-07-14 10:02:33'),
('COM0000009', 'opd_boss', '-', '8', 4, '422793839', NULL, '2023-06-23 15:33:27', '2023-07-14 10:00:20'),
('COM0000010', 'opd_office', '-', '8', 4, '623983916', NULL, '2023-06-23 15:33:44', '2023-07-14 10:00:28'),
('COM0000011', 'or_1', '7440-001-0001/478', '11', 4, '1568728806', NULL, '2023-06-29 11:29:32', '2023-07-14 10:12:14'),
('COM0000012', 'doctor_opd_1', '-', '8', 4, '323599282', NULL, '2023-06-29 11:30:18', '2023-07-14 10:03:40'),
('COM0000013', 'doctor_opd_2', '-', '8', 4, '296351887', NULL, '2023-06-29 11:30:28', '2023-07-14 10:03:48'),
('COM0000014', 'doctor_opd_4', '-', '8', 4, '431780148', NULL, '2023-06-29 11:30:38', '2023-07-14 10:03:56'),
('COM0000015', 'doctor_opd_5', '-', '8', 4, '457703917', NULL, '2023-06-29 11:31:08', '2023-07-14 10:04:03'),
('COM0000016', 'doctor_opd_6', '-', '8', 4, '502764349', NULL, '2023-06-29 11:31:25', '2023-07-14 10:04:37'),
('COM0000017', 'doctor_opd_7', '-', '8', 4, '529698491', NULL, '2023-06-29 11:31:35', '2023-07-14 10:04:46'),
('COM0000018', 'ob_gyn_1', '-', '22', 4, '595905390', NULL, '2023-06-29 11:31:54', '2023-07-14 10:08:12'),
('COM0000019', 'ob_gyn_2', '-', '22', 4, '523305139', NULL, '2023-06-29 11:32:04', '2023-07-14 10:08:20'),
('COM0000020', 'ob_gyn_3', '-', '22', 4, '331529255', NULL, '2023-06-29 11:32:15', '2023-07-14 10:08:28'),
('COM0000021', 'ob_gyn_4', '-', '22', 4, '656641229', NULL, '2023-06-29 11:33:03', '2023-06-29 11:33:03'),
('COM0000022', 'ob_gyn_5', '-', '22', 4, '222207684', NULL, '2023-06-29 11:33:18', '2023-06-29 11:33:18'),
('COM0000023', 'ob_gyn_6', '-', '22', 4, '145305009', NULL, '2023-06-29 11:33:32', '2023-06-29 11:33:32'),
('COM0000024', 'ob_gyn_7', '-', '22', 4, '564036814', NULL, '2023-06-29 11:33:44', '2023-06-29 11:33:44'),
('COM0000025', 'ob_gyn_8', '-', '22', 4, '607931215', NULL, '2023-06-29 11:34:05', '2023-07-11 10:59:19'),
('COM0000026', 'medical_1', '-', '26', 4, '719850507', NULL, '2023-07-11 08:23:49', '2023-07-11 11:09:33'),
('COM0000027', 'medical_2', '-', '26', 4, '720652053', NULL, '2023-07-11 08:24:12', '2023-07-11 11:09:10'),
('COM0000028', 'medical_3', '-', '26', 4, '887109605', NULL, '2023-07-11 08:24:26', '2023-07-11 11:09:04'),
('COM0000029', 'medical_4', '-', '26', 4, '444177859', NULL, '2023-07-11 08:24:37', '2023-07-11 11:08:57'),
('COM0000030', 'medical_5', '-', '26', 4, '1481881868', NULL, '2023-07-11 08:24:50', '2023-07-11 11:08:48'),
('COM0000031', 'medical_6', '-', '26', 4, '1112810797', NULL, '2023-07-11 08:24:59', '2023-07-11 11:08:42'),
('COM0000032', 'medical_7', '-', '26', 4, '1314652213', NULL, '2023-07-11 08:25:09', '2023-07-11 11:08:36'),
('COM0000033', 'opd_1', '-', '8', 4, '1526358999', NULL, '2023-07-11 08:25:58', '2023-07-14 10:20:00'),
('COM0000034', 'opd_2', '-', '8', 4, '1228742366', NULL, '2023-07-11 08:26:09', '2023-07-14 10:20:11'),
('COM0000035', 'opd_3', '-', '8', 4, '1923908372', NULL, '2023-07-11 08:26:19', '2023-07-14 10:20:19'),
('COM0000036', 'opd_4', '-', '8', 4, '1219447952', NULL, '2023-07-11 08:26:29', '2023-07-14 10:20:25'),
('COM0000037', 'doctor_opd_3', '-', '8', 4, '1232823280', NULL, '2023-07-11 08:26:56', '2023-07-14 10:20:32'),
('COM0000038', 'er_boss', '-', '10', 4, '852635007', NULL, '2023-07-11 08:27:25', '2023-07-11 11:08:25'),
('COM0000039', 'ems_1', '-', '10', 4, '895179465', NULL, '2023-07-11 08:27:44', '2023-07-11 11:08:20'),
('COM0000040', 'ems_2', '-', '10', 4, '964315051', NULL, '2023-07-11 08:27:55', '2023-07-11 11:08:13'),
('COM0000041', 'er_1', '-', '10', 4, '391482552', NULL, '2023-07-11 08:28:09', '2023-07-11 11:08:05'),
('COM0000042', 'er_2', '-', '10', 4, '1071729654', NULL, '2023-07-11 08:28:21', '2023-07-11 11:07:57'),
('COM0000043', 'er_3', '-', '10', 4, '1190097919', NULL, '2023-07-11 08:28:47', '2023-07-11 11:07:51'),
('COM0000044', 'doctor_er_1', '-', '10', 4, '1161506720', NULL, '2023-07-11 08:30:06', '2023-07-14 10:21:06'),
('COM0000045', 'doctor_er_2', '-', '10', 4, '1258423745', NULL, '2023-07-11 08:30:15', '2023-07-11 11:06:14'),
('COM0000046', 'doctor_er_3', '-', '10', 4, '1183523112', NULL, '2023-07-11 08:30:37', '2023-07-11 11:06:04'),
('COM0000047', 'Ped_ward_1', '-', '3', 4, '1648630207', NULL, '2023-07-11 08:31:26', '2023-07-11 11:05:02'),
('COM0000048', 'Ped_ward_2', '-', '3', 4, '355929810', NULL, '2023-07-11 08:31:37', '2023-07-11 11:04:56'),
('COM0000049', 'Ped_ward_3', '-', '3', 4, '1967679172', NULL, '2023-07-11 08:31:47', '2023-07-11 11:04:45'),
('COM0000050', 'Ped_ward_4', '-', '3', 4, '609665304', NULL, '2023-07-11 08:31:57', '2023-07-11 11:04:38'),
('COM0000051', 'ped_ward_doctor_1', '-', '3', 4, '1295481471', NULL, '2023-07-11 08:32:07', '2023-07-11 11:04:31'),
('COM0000052', 'Male_ward_1', '-', '2', 4, '1143793871', NULL, '2023-07-11 08:32:27', '2023-07-17 13:51:40'),
('COM0000053', 'Male_ward_2', '-', '2', 4, '1562968415', NULL, '2023-07-11 08:32:41', '2023-07-17 13:51:57'),
('COM0000054', 'Male_ward_3', '-', '2', 4, '281115665', NULL, '2023-07-11 08:32:56', '2023-07-17 13:52:04'),
('COM0000055', 'Male_ward_4', '-', '2', 4, '524035372', NULL, '2023-07-11 08:33:07', '2023-07-17 13:52:12'),
('COM0000056', 'Male_doctor_1', '-', '2', 4, '1689940486', NULL, '2023-07-11 08:33:20', '2023-07-17 13:52:19'),
('COM0000057', 'female_ward_1', '-', '1', 4, '1135727698', NULL, '2023-07-11 08:33:40', '2023-07-17 13:52:30'),
('COM0000058', 'female_ward_2', '-', '1', 4, '1566723593', NULL, '2023-07-11 08:33:49', '2023-07-17 13:59:45'),
('COM0000059', 'female_ward_3', '-', '1', 4, '789191808', NULL, '2023-07-11 08:33:57', '2023-07-17 14:00:12'),
('COM0000060', 'female_ward_4', '-', '1', 4, '981883863', NULL, '2023-07-11 08:34:33', '2023-07-17 14:00:05'),
('COM0000061', 'female_ward_5', '-', '1', 4, '1726374114', NULL, '2023-07-11 09:04:03', '2023-07-17 13:59:59'),
('COM0000062', 'famale_ward_doctor_1', '-', '1', 4, '1842926349', NULL, '2023-07-11 09:04:21', '2023-07-17 13:59:52'),
('COM0000063', 'vip4_ward_1', '-', '4', 4, '1841247074', '2565', '2023-07-11 09:04:46', '2023-07-26 10:19:47'),
('COM0000064', 'vip4_ward_2', '-', '4', 4, '1903616621', NULL, '2023-07-11 09:04:58', '2023-07-11 10:57:21'),
('COM0000065', 'vip4_ward_3', '-', '4', 4, '1237460525', NULL, '2023-07-11 09:05:07', '2023-07-11 10:57:11'),
('COM0000066', 'vip5_ward_1', '-', '4', 4, '1214026189', NULL, '2023-07-11 09:05:39', '2023-07-11 10:57:04'),
('COM0000067', 'vip5_ward_2', '7440-001-001/268', '4', 4, '1989548517', '2561', '2023-07-11 09:05:53', '2023-07-26 10:37:52'),
('COM0000068', 'vip5_ward_3', '-', '4', 4, '1061867496', NULL, '2023-07-11 09:06:03', '2023-07-11 10:56:52'),
('COM0000069', 'vip5_ward_4', '7440-001-0001/313', '4', 4, '1297365716', NULL, '2023-07-11 09:06:21', '2023-07-11 10:56:47'),
('COM0000070', 'vip5_doctor_1', '-', '4', 4, '304726111', NULL, '2023-07-11 09:06:31', '2023-07-11 09:41:19'),
('COM0000071', 'เครื่องสำรองไฟ', '7440-009-0001/145', '21', 12, NULL, '2566', '2023-07-26 11:59:27', '2023-07-26 12:04:05'),
('COM0000072', 'เครื่องสำรองไฟ', '7440-009-0001/147', '8', 12, NULL, '2566', '2023-07-26 12:03:27', '2023-07-26 12:04:30'),
('COM0000073', 'เครื่องสำรองไฟ', '7440-009-0001/148', '8', 12, NULL, '2566', '2023-07-26 12:05:12', '2023-07-26 12:05:12'),
('COM0000074', 'เครื่องสำรองไฟ', '7440-009-0001/149', '8', 12, NULL, '2566', '2023-07-26 12:05:35', '2023-07-26 12:05:35'),
('COM0000075', 'เครื่องสำรองไฟ', '7440-009-0001/150', '8', 12, NULL, '2566', '2023-07-26 12:06:03', '2023-07-26 12:06:03'),
('COM0000076', 'เครื่องสำรองไฟ', '7440-009-0001/151', '8', 12, NULL, '2566', '2023-07-26 12:06:30', '2023-07-26 12:06:30'),
('COM0000077', 'เครื่องสำรองไฟ', '7440-009-0001/152', '8', 12, NULL, '2566', '2023-07-26 12:08:00', '2023-07-26 12:08:00'),
('COM0000078', 'เครื่องสำรองไฟ', '7440-009-0001/153', '8', 12, NULL, '2566', '2023-07-26 12:08:26', '2023-07-26 12:08:26'),
('COM0000079', 'เครื่องสำรองไฟ', '7440-009-0001/154', '8', 12, NULL, '2566', '2023-07-26 12:08:44', '2023-07-26 12:08:44'),
('COM0000080', 'เครื่องสำรองไฟ', '7440-009-0001/155', '8', 12, NULL, '2566', '2023-07-26 12:09:20', '2023-07-26 12:09:20'),
('COM0000081', 'เครื่องสำรองไฟ', '7440-009-0001/156', '8', 12, NULL, '2566', '2023-07-26 12:09:38', '2023-07-26 12:09:38'),
('COM0000082', NULL, '7440-009-0001/159', '10', 12, NULL, '2566', '2023-08-08 08:29:25', '2023-08-08 08:29:25'),
('COM0000083', NULL, '7440-009-0001/160', '10', 12, NULL, '2566', '2023-08-08 08:29:53', '2023-08-08 08:29:53'),
('COM0000084', NULL, '7440-001-0001/161', '10', 12, NULL, '2566', '2023-08-08 08:32:25', '2023-08-08 08:32:25'),
('COM0000085', NULL, '7440-001-0001/162', '10', 12, NULL, '2566', '2023-08-08 08:32:46', '2023-08-08 08:32:46'),
('COM0000086', NULL, '7440-001-0001/163', '10', 12, NULL, '2566', '2023-08-08 08:33:11', '2023-08-08 08:33:11'),
('COM0000087', NULL, '7440-001-0001/164', '10', 12, NULL, '2566', '2023-08-08 08:33:28', '2023-08-08 08:33:28'),
('COM0000088', 'ศูนย์เปล', '7440-001-0001/498', '8', 4, NULL, '2566', '2023-08-23 09:59:36', '2023-08-23 09:59:36'),
('COM0000089', 'ศูนย์เปล', '7440-001-0001/497', '10', 4, NULL, '2566', '2023-08-23 10:00:04', '2023-08-23 10:00:04'),
('COM0000090', NULL, '7440-001-0001/496', '6', 4, NULL, '2566', '2023-08-23 10:01:28', '2023-08-23 10:01:28'),
('COM0000091', NULL, '7440-001-0002/55', '39', 3, NULL, '2566', '2023-08-23 10:03:07', '2023-08-23 10:03:07'),
('COM0000092', NULL, '7440-001-0002/54', '39', 3, NULL, '2566', '2023-08-23 10:03:31', '2023-08-23 10:03:31'),
('COM0000093', NULL, '7440-001-0002/56', '39', 3, NULL, '2566', '2023-08-23 10:04:09', '2023-08-23 10:04:09'),
('COM0000094', NULL, '7440-002-0005/69', '12', 13, NULL, '2566', '2023-09-05 09:45:00', '2023-09-05 09:45:00'),
('COM0000095', 'หัวหน้าวิสัญญี', '7440-001-0001/493', '12', 4, NULL, '2566', '2023-09-05 09:46:22', '2023-09-06 22:10:49'),
('COM0000096', NULL, '7440-002-0005/66', '3', 13, NULL, '2566', '2023-09-07 10:05:57', '2023-09-07 10:05:57'),
('COM0000097', NULL, '7440-002-0005/67', '2', 13, NULL, '2566', '2023-09-07 10:06:25', '2023-09-07 10:06:25'),
('COM0000098', NULL, '7440-002-0005/68', '1', 13, NULL, '2566', '2023-09-07 10:07:03', '2023-09-07 10:07:03'),
('COM0000099', 'ฉลากยา', '7440-002-0005/40', '24', 13, '', '2561', '2023-11-08 13:42:03', '2023-11-08 13:42:03'),
('COM0000100', 'ARI', '7440-001-0001/251', '8', 4, '644716768', '2559', '2023-11-09 07:35:57', '2023-11-09 07:35:57'),
('COM0000101', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '8', 18, '', '2566', '2023-11-18 15:41:11', '2023-11-18 15:41:11'),
('COM0000102', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '1', 18, '', '2566', '2023-11-18 15:42:56', '2023-11-18 15:42:56'),
('COM0000103', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '2', 18, '', '2566', '2023-11-18 15:43:12', '2023-11-18 15:43:12'),
('COM0000104', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '3', 18, '', '2566', '2023-11-18 15:44:24', '2023-11-18 15:44:24'),
('COM0000105', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '4', 18, '', '2566', '2023-11-18 15:44:43', '2023-11-18 15:44:43'),
('COM0000106', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '5', 18, '', '2566', '2023-11-18 15:45:21', '2023-11-18 15:45:21'),
('COM0000107', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '6', 18, '', '2566', '2023-11-18 15:45:58', '2023-11-18 15:45:58'),
('COM0000108', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '10', 18, '', '2566', '2023-11-18 15:46:18', '2023-11-18 15:46:18'),
('COM0000109', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '11', 18, '', '2566', '2023-11-18 15:46:32', '2023-11-18 15:46:32'),
('COM0000110', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '12', 18, '', '2566', '2023-11-18 15:46:50', '2023-11-18 15:46:50'),
('COM0000111', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '13', 18, '', '2566', '2023-11-18 15:47:20', '2023-11-18 15:47:20'),
('COM0000112', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '15', 18, '', '2566', '2023-11-18 15:48:08', '2023-11-18 15:48:08'),
('COM0000113', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '21', 18, '', '2566', '2023-11-18 15:49:05', '2023-11-18 15:49:05'),
('COM0000114', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '24', 18, '', '2566', '2023-11-18 15:49:57', '2023-11-18 15:49:57'),
('COM0000115', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '41', 18, '', '2566', '2023-11-18 15:50:24', '2023-11-18 15:50:24'),
('COM0000116', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '43', 18, '', '2566', '2023-11-18 15:50:44', '2023-11-18 15:50:44'),
('COM0000117', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '34', 18, '', '2566', '2023-11-18 15:51:26', '2023-11-18 15:51:26'),
('COM0000118', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '32', 18, '', '2566', '2023-11-18 15:51:50', '2023-11-18 15:51:50'),
('COM0000119', 'Qr-code แจ้งซ่อมนอกเหนือครุภัณฑ์', '-', '16', 18, '', '2566', '2023-11-18 15:54:00', '2023-11-18 15:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_dep`
--

CREATE TABLE `inv_dep` (
  `inv_dep_id` bigint NOT NULL,
  `inv_dep_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `inv_dep`
--

INSERT INTO `inv_dep` (`inv_dep_id`, `inv_dep_name`) VALUES
(1, 'งานผู้ป่วยใน (หญิง)'),
(2, 'งานผู้ป่วยใน (ชาย)'),
(3, 'งานผู้ป่วยใน (เด็ก)'),
(4, 'งานผู้ป่วยใน( พิเศษ )'),
(5, 'ห้องคลอด'),
(6, 'งานการพยาบาลผู้ป่วยหนัก'),
(7, 'รพ.สนาม'),
(8, 'ผู้ป่วยนอก (OPD)'),
(9, 'คลินิกพิเศษ'),
(10, 'งานอุบัติเหตุและฉุกเฉิน'),
(11, 'ผ่าตัด'),
(12, 'วิสัญญีพยาบาล'),
(13, 'ทันตกรรม'),
(14, 'กายภาพบำบัด'),
(15, 'โภชนาการ'),
(16, 'รังสีวิทยา'),
(17, 'PCU โรงพยาบาล'),
(18, 'แพทย์แผนไทย'),
(19, 'เทคนิคการแพทย์'),
(20, 'คลินิคสีขาว'),
(21, 'หน่วยจ่ายกลาง (SUPPLY)'),
(22, 'สูติ-นรีเวช'),
(23, 'ห้องจ่ายยา NCD รพ.1'),
(24, 'ห้องจ่ายยา OPD'),
(25, 'ห้องจ่ายยา OPD.'),
(26, 'งานเวชระเบียน'),
(27, 'CKD'),
(28, 'สุขาภิบาล'),
(29, 'ธุรการ'),
(30, 'ซ่อมบำรุง'),
(31, 'ทรัพยากรบุคคล'),
(32, 'ยานพาหนะ'),
(33, 'โสตทัศนศึกษา'),
(34, 'การเงินและบัญชี'),
(35, 'รักษาความปลอดภัย (รปภ.)'),
(36, 'องค์กรแพทย์ (ห้องพักแพทย์)'),
(37, 'กลุ่มงานการพยาบาล (ห้องกลุ่มการฯ)'),
(38, 'งานพัสดุ'),
(39, 'ศูนย์คอมพิวเตอร์'),
(40, 'แผนงานและประเมินผล'),
(41, 'งานประกันสุขภาพ'),
(42, 'งานคุณภาพ QIC'),
(43, 'คลังยา'),
(44, 'งาน Palliative Care'),
(45, 'งานประชาสัมพันธ์'),
(46, 'งานสวน'),
(47, 'งานอาชีวะอนามัย'),
(48, 'ตึกแยกโรค'),
(49, 'ไตเทียม (CKD)'),
(50, 'บ้านพักแพทย์'),
(51, 'โรงพยาบาลหนองหาน'),
(52, 'ห้อง ผู้อำนวยการ'),
(53, 'ห้องประชุม ศรีหลักเมือง'),
(54, 'หอถังสูง'),
(60, 'งานจิตเวช');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(57, '2014_10_12_000000_create_users_table', 2),
(58, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(59, '2014_10_12_100000_create_password_resets_table', 2),
(60, '2019_08_19_000000_create_failed_jobs_table', 2),
(61, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('fridaymumu@gmail.com', '$2y$10$FCsGnAh/8x8FwhbNtw57XevpJlq5c5P77PC2kTRGnnvUjagjBbvqq', '2023-06-30 10:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`, `status_tag`) VALUES
(1, 'ซ่อมเรียบร้อย', 'bg-label-success'),
(2, 'กำลังดำเนินการซ่อม', 'bg-label-info'),
(3, 'ส่งภายนอก', 'bg-label-warning'),
(4, 'แทงชำรุด', 'bg-label-danger'),
(5, 'รับเรื่องแล้ว', 'bg-label-primary'),
(6, 'รอรับเรื่อง', 'bg-label-dark'),
(8, 'รออะไหล่', 'bg-label-secondary');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'chok', NULL, NULL, '$2y$10$4J4ZR/MkeDJSvXPedNHyNeSrLRotijm.r2r2Kdx4DNT2S66xjGlbG', 1, NULL, '2023-06-30 11:14:57', '2023-06-30 11:14:57'),
(11, 'nhh', NULL, NULL, '$2y$10$GXZpev6yQTGDZTe6tNDE8OibQ76NciAif5eSxPaLB94jhUN3SnpHO', 1, NULL, '2023-11-17 06:56:46', '2023-11-17 06:56:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `com_service_list`
--
ALTER TABLE `com_service_list`
  ADD PRIMARY KEY (`service_list_id`);

--
-- Indexes for table `com_type`
--
ALTER TABLE `com_type`
  ADD PRIMARY KEY (`com_type_id`) USING BTREE;

--
-- Indexes for table `durable_engineer`
--
ALTER TABLE `durable_engineer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `durable_fix`
--
ALTER TABLE `durable_fix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `durable_goods`
--
ALTER TABLE `durable_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_dep_id` (`inv_dep_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inv_dep`
--
ALTER TABLE `inv_dep`
  ADD PRIMARY KEY (`inv_dep_id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `com_service_list`
--
ALTER TABLE `com_service_list`
  MODIFY `service_list_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `com_type`
--
ALTER TABLE `com_type`
  MODIFY `com_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `durable_fix`
--
ALTER TABLE `durable_fix`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inv_dep`
--
ALTER TABLE `inv_dep`
  MODIFY `inv_dep_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
