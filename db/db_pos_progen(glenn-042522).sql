-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 08:09 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_pos_progen`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE IF NOT EXISTS `billing_details` (
`billing_detail_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `sales_type` varchar(50) DEFAULT NULL,
  `sales_id` int(11) NOT NULL DEFAULT '0',
  `dr_no` varchar(50) DEFAULT NULL,
  `dr_date` varchar(20) DEFAULT NULL,
  `total_unit_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_details`
--

INSERT INTO `billing_details` (`billing_detail_id`, `billing_id`, `sales_type`, `sales_id`, `dr_no`, `dr_date`, `total_unit_cost`, `total_amount`, `remaining_amount`) VALUES
(3, 3, 'goods', 1, 'PROBCD-2022-DR-0001', '2022-04-14', '416000.00', '499000.00', '499000.00'),
(4, 3, 'goods', 2, 'PROBCD-2022-DR-0002', '2022-04-20', '233000.00', '300000.00', '300000.00');

-- --------------------------------------------------------

--
-- Table structure for table `billing_head`
--

CREATE TABLE IF NOT EXISTS `billing_head` (
`billing_id` int(11) NOT NULL,
  `billing_no` varchar(50) DEFAULT NULL,
  `billing_date` varchar(20) DEFAULT NULL,
  `total_unit_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `client_id` int(11) NOT NULL DEFAULT '0',
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=billed, 1=paid'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_head`
--

INSERT INTO `billing_head` (`billing_id`, `billing_no`, `billing_date`, `total_unit_cost`, `total_amount`, `client_id`, `create_date`, `user_id`, `status`) VALUES
(3, 'BS-2022-0001', '2022-04-12', '649000.00', '799000.00', 1, '2022-04-12 14:10:30', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `billing_payment`
--

CREATE TABLE IF NOT EXISTS `billing_payment` (
`payment_id` int(11) NOT NULL,
  `billing_id` varchar(50) DEFAULT NULL,
  `payment_date` varchar(20) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `check_no` varchar(50) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bin`
--

CREATE TABLE IF NOT EXISTS `bin` (
`bin_id` int(11) NOT NULL,
  `bin_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bin`
--

INSERT INTO `bin` (`bin_id`, `bin_name`) VALUES
(1, 'Rack - 1'),
(2, 'Rack - 3'),
(3, 'Rack - 4'),
(4, 'Rack - 5'),
(5, 'Rack - 8'),
(6, 'Rack - A1'),
(7, 'Rack - A2'),
(8, 'Rack - A3'),
(9, 'Rack - A3&B4'),
(10, 'Rack - A4'),
(11, 'Rack - A4 & D1'),
(12, 'Rack - B1'),
(13, 'Rack - B2'),
(14, 'Rack - B3'),
(15, 'Rack - B4'),
(16, 'Rack - B4 & I2'),
(17, 'Rack - B4 & K3'),
(18, 'Rack - C1'),
(19, 'Rack - C3'),
(20, 'Rack - C4'),
(21, 'Rack - D1'),
(22, 'Rack - D2'),
(23, 'Rack - D2 /F3'),
(24, 'Rack - E1 & I3'),
(25, 'Rack - E2'),
(26, 'Rack - E3'),
(27, 'Rack - F2'),
(28, 'Rack - F3'),
(29, 'Rack - G1'),
(30, 'Rack - I2'),
(31, 'Rack - I3'),
(32, 'Rack - J1'),
(33, 'Rack - K1'),
(34, 'Rack - K3'),
(35, 'Rack - O2'),
(36, 'Rack - T'),
(37, 'Rack - C2'),
(38, 'Rack - M3'),
(39, 'Rack - O1'),
(40, 'JO - 2'),
(41, 'Rack - RO1'),
(42, 'Rack - M4'),
(43, 'Rack - I2'),
(44, 'Rack - I1'),
(45, 'Rack - O3'),
(46, 'Rack - G2'),
(47, 'Rack - I3'),
(48, 'Rack - O2'),
(49, 'Rack - K4'),
(52, 'Rack - J3'),
(54, 'Rack - G3'),
(55, 'JO CAB'),
(56, 'Rack - K2'),
(57, 'Basement'),
(58, ''),
(59, '');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
`brand_id` int(11) NOT NULL,
  `brand_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`client_id` int(11) NOT NULL,
  `address` text,
  `buyer_name` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `wht` int(11) NOT NULL DEFAULT '0' COMMENT '1=YES, 0=No'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `address`, `buyer_name`, `contact_person`, `contact_no`, `tin`, `wht`) VALUES
(1, 'Purok San Jose, Brgy. Calumangan, Bago City, Negros Occidental, 6101', 'Central Negros Power Reliability, Inc.', 'Ms. Julyn May', '(034)4351932', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `damage_details`
--

CREATE TABLE IF NOT EXISTS `damage_details` (
`damage_det_id` int(11) NOT NULL,
  `damage_id` int(11) NOT NULL DEFAULT '0',
  `in_id` int(11) NOT NULL DEFAULT '0',
  `brand` varchar(50) DEFAULT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `part_no` varchar(50) DEFAULT NULL,
  `acquisition_date` varchar(20) DEFAULT NULL,
  `acquisition_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `damage_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remarks` text,
  `repaired` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `damage_head`
--

CREATE TABLE IF NOT EXISTS `damage_head` (
`damage_id` int(11) NOT NULL,
  `damage_date` varchar(20) DEFAULT NULL,
  `remarks` text,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `pdr_no` varchar(50) DEFAULT NULL,
  `reported_date` varchar(50) DEFAULT NULL,
  `reported_by` varchar(100) DEFAULT NULL,
  `accounted_to` int(11) NOT NULL DEFAULT '0',
  `person_using` int(11) NOT NULL DEFAULT '0',
  `damage_description` text,
  `damage_reason` text,
  `inspected_by` int(11) NOT NULL DEFAULT '0',
  `date_inspected` varchar(50) DEFAULT NULL,
  `recommendation` text,
  `prepared_by` int(11) NOT NULL DEFAULT '0',
  `checked_by` int(11) NOT NULL DEFAULT '0',
  `noted_by` int(11) NOT NULL DEFAULT '0',
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'Accounting Department'),
(2, 'Auxiliary\r\n'),
(3, 'Bacolod HR'),
(4, 'Billing Department'),
(5, 'EIC'),
(7, 'Environment/PCO'),
(8, 'Finance Department'),
(9, 'Fuel and Lube Management'),
(10, 'Health and Safety'),
(11, 'IT Department'),
(12, 'Laboratory and Chemical'),
(13, 'Maintenance'),
(14, 'Office of the GM'),
(15, 'Operation'),
(16, 'Purchasing Department'),
(17, 'Reconditioning'),
(18, 'Security'),
(19, 'Site HR'),
(20, 'Special Proj/Facilities Imp'),
(21, 'Trading Department'),
(22, 'Warehouse Department'),
(23, 'Progen Warehouse'),
(24, 'Progen CV'),
(25, 'ECMG'),
(26, 'Turbo Charger Team'),
(27, 'Progen IPRO'),
(28, 'CENPRI Warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`employee_id` int(11) NOT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `department_id`, `position`, `contact_no`, `email`) VALUES
(1, 'Ma. Milagros Arana', 0, 'General Manager', '0917-5924080', NULL),
(2, 'Rhea Arsenio', 0, 'Trader', '0920-6398529', NULL),
(3, 'Jonah Faye Benares', 0, 'Software Development Supervisor', '0932-4515369', NULL),
(4, 'Kervic Biñas', 0, 'Procurement Assistant', '0930-2357794', NULL),
(5, 'Joemarie Calibjo', 0, 'Service Vehicle Driver', '0950-2900419', NULL),
(6, 'Maylen Cabaylo', 0, 'Purchasing Officer', '09099491894/09234597487', NULL),
(7, 'Rey  Carbaquil', 0, 'Service Vehicle Driver', '0912 5905319', NULL),
(8, 'Cristy Cesar', 0, 'Accounting Associate', '0916-3961389', NULL),
(9, 'Gretchen Danoy', 0, 'Accounting Supervisor', '0922-4386979', NULL),
(10, 'Merry Michelle Dato', 0, 'Projects and Assets Management', '0920-5205418', 'merrydioso.epiic2020@gmail.com'),
(11, 'Joemar De Los Santos', 0, 'Lead Trader', '0923-4187139', NULL),
(12, 'Imelda Espera', 0, 'A/P & Credit Supervisor', '0918-6760758', NULL),
(13, 'Elaisa Jane Febrio', 0, 'HR Assistant', '0917-9941917', NULL),
(14, 'Jason Flor', 0, 'Software Development Assistant', '0939-6488141', NULL),
(15, 'Zara Joy Gabales', 0, 'Billing Assistant', '0939-1159164', NULL),
(16, 'Relsie Gallo', 0, '0', '0', NULL),
(17, 'Celina Marie Grabillo', 0, 'Billing & Settlement Officer', '0907-4494479', NULL),
(18, 'Nazario Shyde Jr. Ibañez', 0, 'Trader', '0922-3271576', NULL),
(19, 'Gebby Jalandoni', 0, 'Accounting Assistant', '0909-9579077', NULL),
(20, 'Caesariane Jo', 0, 'Trader', '0927-8212228', NULL),
(21, 'Lloyd Jamero', 0, 'IT Specialist', '0908-7636105', NULL),
(22, 'Annavi Lacambra', 0, 'Corporate Accountant', '0932-3649978', NULL),
(23, 'Ma. Erika Oquiana', 0, 'Trader', '0912-4746470/09773640452', NULL),
(24, 'Charmaine Rei Plaza', 0, 'Energy Market Analyst', '0948-9285185', NULL),
(25, 'Cresilda Mae Ramirez', 0, 'Internal Auditor', '0977-8215247', NULL),
(26, 'Melanie Rocha', 0, 'Utility', '0910-4526879', NULL),
(27, 'Zyndyryn Rosales', 0, 'Finance Supervisor', '0932-8737196', NULL),
(28, 'Genie Saludo', 0, 'HR Assistant', '09272257127/09454569188', NULL),
(29, 'Daisy Jane Sanchez', 0, 'EMG Manager / WESM Compliance Officer', '0932-8773754', NULL),
(30, 'Rosemarie Sarroza', 0, 'Trader', '0917-9512950', NULL),
(31, 'Stephine David Severino', 0, 'Software Development Assistant', '0977-7106914', NULL),
(32, 'Henry Sia', 0, 'Grid Integration Manager', '9177996939', NULL),
(33, 'Syndey Sinoro', 0, 'HR Supervisor', '0923-2802343', NULL),
(34, 'Marianita Tabilla', 0, 'Finance Assistant', '0917-7793318', NULL),
(35, 'Krystal Gayle Tagalog', 0, 'Payroll Assistant', '0946-3348559', NULL),
(36, 'Hennelen Tanan', 0, 'IT Encoder ', '0945-5743745', NULL),
(37, 'Teresa Tan', 0, 'Contracts & Compliance Asst.', '0923-6828813', NULL),
(38, 'Dary Mae Villas', 0, 'Trader', '0930-7871989', NULL),
(39, 'Marlon Adorio', 0, 'E & IC Technician', '0912-5896720', NULL),
(40, 'John Ezequiel Alejandro', 0, 'Auxiliary Operator ', '0916-5321090', NULL),
(41, 'Carlito Alevio', 0, 'Plant Mechanic', '0926-8161359', NULL),
(42, 'Regina Alova', 0, 'Operations Analyst', '09235607021 / 09485342153', NULL),
(43, 'Rebecca Alunan ', 0, 'Performance Monitoring Supervisor', '0906-3425996', NULL),
(44, 'Fleur de Liz Ambong', 0, 'Fuel Management Asst.', '0909-4620177', NULL),
(45, 'Beverly  Ampog', 0, 'Operations Analyst', '0995-3634548', NULL),
(46, 'Genaro Angulo', 0, 'Electrical Supervisor', '09196745918', NULL),
(47, 'Rey Argawanon', 0, 'Power Delivery & Technical Manager', '0917-8653566', NULL),
(48, 'Alona Arroyo', 0, 'Operations Planner', '0919-3725318', NULL),
(49, 'Joemillan Baculio', 0, 'Auxiliary Operator', '0906-8802652', NULL),
(50, 'Rashelle Joy Bating', 0, 'Projects Coordinator Assistant', '0910-1980348', NULL),
(51, 'Gener Bawar', 0, 'Machine Shop & Reconditioning Supervisor', '0920-2128998', NULL),
(52, 'Ruel Beato', 0, 'Plant Mechanic', '0939-2369794', NULL),
(53, 'Mary Grace Bugna', 0, 'Commercial Asst. & Parts Analyst', '0915-2631219', 'marygracefortaleza.cenpri@gmail.com'),
(54, 'Vency Cababat', 0, ' E&IC Technician', '09267932911 / 09265638526', NULL),
(55, 'Rusty Canama', 0, 'Plant Mechanic', '0949-1547358', NULL),
(56, 'Exequil Corino', 0, 'Engine Room Operator', '0920-6995646', NULL),
(57, 'Juanito Dagupan', 0, 'Operation Shift Supervisor', '0918-6438993', NULL),
(58, 'Julyn May Divinagracia', 0, 'Admin Assistant', '0930-1553296/0916-6984461', NULL),
(59, 'Melfa Duis', 0, 'Purchasing Assistant', '0927-4597157', NULL),
(60, 'Jerson Factolerin', 0, 'Utility', '0932-5420679', NULL),
(61, 'Julius Fernandez', 0, 'Auxiliary Operator', '0918-2685507', NULL),
(62, 'Luisito Fortuno', 0, 'Auxiliary Operator', '0908-3317408', NULL),
(63, 'Donna Gellada', 0, 'Parts Inventory  Assistant', '0916-2779697', 'donna7.cenpri@gmail.com'),
(64, 'Felipe, III Globert', 0, 'Warehouse Assistant', '0948-7024664', NULL),
(65, 'Mikko Golvio', 0, 'E&IC Technician', '0930-9363013', NULL),
(66, 'Eric Jabiniar', 0, 'Plant Director', '0917-8607244', NULL),
(67, 'Jushkyle Jambongana', 0, 'IT Assistant', '0912-3867454', NULL),
(68, 'Bobby  Jardiniano', 0, 'Service Vehicle Driver', '0933-3388374', NULL),
(69, 'Stephen Jardinico', 0, 'Warehouse Assistant', '0912 922 1944', NULL),
(70, 'Joey Labanon', 0, 'Auxiliary Operator Trainee', '0910-5787327', NULL),
(71, 'Roan Renz Liao', 0, 'Parts Engineer', '0925-4887286', NULL),
(72, 'Gino Lovico', 0, 'Foreman (Machine Shop & Recon)', '0999-8143307', NULL),
(73, 'Ricky Madeja', 0, 'Safety Officer', '0918-6268028', NULL),
(74, 'Danilo Maglinte', 0, 'Engine Room Operator', '0935-4046632', NULL),
(75, 'Alex Manilla Jr.', 0, 'Fuel Tender', '0999-7353561', ''),
(76, 'Concordio Matuod', 0, 'Project Consultant', '0915-326-1829', NULL),
(77, 'Genielyne Mondejar', 0, 'Pollution Control Officer  ', '0912-5356230', NULL),
(78, 'Francis Montero', 0, 'Plant Mechanic', '0918-2063492', NULL),
(79, 'Andro Ortega', 0, 'Shift Supervisor Trainee', '0932-2400663', NULL),
(80, 'Joselito Panes', 0, 'Plant Mechanic', '0929-2629467', NULL),
(81, 'Nonito Pocong', 0, 'Control Room Operator', '0933-6159620', NULL),
(82, 'Mario Dante Purisima', 0, 'Shift Supervisor Trainee', '0927-1687549', NULL),
(83, 'Romeo Quiocson Jr.', 0, 'Technical Assistant', '0927-6537369', NULL),
(84, 'Lawrence Vincent Roiles', 0, 'E&IC Technician', '0936-6568781', NULL),
(85, 'Roy Sabit', 0, 'Control Room Operator', '0947-9916563', NULL),
(86, 'Robert Sabando', 0, 'Project Consultant', '0927-741-1950', NULL),
(87, 'Godfrey Stephen Samano', 0, 'O&M Superintendent', '0908-6094932', NULL),
(88, 'Kennah Sasamoto', 0, 'Test  Engineer', '0977-7842536', NULL),
(89, 'Iris Sixto', 0, 'Site Facilities Supervisor', '0948-2732052', NULL),
(90, 'Kelwin Sarcauga', 0, 'Engine Room Operator Trainee', '0932-1253131', NULL),
(91, 'Ranie Tabanao', 0, '0', '0', NULL),
(92, 'Alexander Tagarda', 0, 'Control Room Operator', '0936-2138490', NULL),
(93, 'Ariel Tandoy', 0, 'Driver', '0915-9555253', NULL),
(94, 'Ryan Tignero', 0, 'Shift Supervisor Trainee', '0927-2885847', NULL),
(95, 'Elmer Torrijos', 0, 'Mechanical Maintenance Supervisor / Equipment & Parts Engr.', '0999 677 8341', NULL),
(96, 'Democrito Urnopia', 0, 'Plant Mechanic', '0930-8736393', NULL),
(97, 'Jobelle Villarias', 0, 'Company Nurse', '0917-1595665', NULL),
(98, 'Melinda Aquino', 0, 'Accounting Assistant/ Bookkeeper', '0949-3005-813', NULL),
(99, 'Irish Dawn Torres', 0, 'Site Admin Officer', '0932-8657926', NULL),
(100, 'Vincent Jed Depasupil', 0, 'Auxiliary Operator', '', NULL),
(101, 'William Soltes', 0, '', '', NULL),
(102, 'Jerry Matucan', 0, 'Tool Keeper', '09461380576', ''),
(103, 'Aileen Tamaño', 0, 'Warehouse Supervisor', '', ''),
(104, 'Edwin Bejec', 25, 'Turbo Charger Repair Supervisor', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
`equipment_id` int(11) NOT NULL,
  `equipment_name` varchar(250) NOT NULL,
  `acquisition_cost` decimal(10,2) NOT NULL,
  `daily_rate` decimal(10,2) NOT NULL,
  `hourly_rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `equipment_name`, `acquisition_cost`, `daily_rate`, `hourly_rate`) VALUES
(1, 'equipment 1', '500000.00', '500.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `fifo_in`
--

CREATE TABLE IF NOT EXISTS `fifo_in` (
`in_id` int(11) NOT NULL,
  `receive_id` int(11) NOT NULL DEFAULT '0',
  `rd_id` int(11) NOT NULL DEFAULT '0',
  `ri_id` int(11) NOT NULL DEFAULT '0',
  `receive_date` varchar(20) DEFAULT NULL,
  `pr_no` varchar(30) DEFAULT NULL,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `brand` varchar(50) DEFAULT NULL,
  `catalog_no` varchar(30) DEFAULT NULL,
  `serial_no` varchar(30) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `item_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remaining_qty` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fifo_out`
--

CREATE TABLE IF NOT EXISTS `fifo_out` (
`out_id` int(11) NOT NULL,
  `in_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `transaction_type` varchar(30) DEFAULT NULL,
  `sales_id` int(11) NOT NULL DEFAULT '0',
  `sales_details_id` int(11) NOT NULL DEFAULT '0',
  `sales_serv_items_id` int(11) NOT NULL DEFAULT '0',
  `unit_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `selling_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `damage_id` int(11) NOT NULL DEFAULT '0',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remaining_qty` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`group_id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'Air Branches for Cylinder Cove'),
(2, 'Automatic Starting-Air Stop VA'),
(3, 'Auxiliary Driving Apparatus'),
(4, 'Balance Weight'),
(5, 'Barring Gear (On Right Side)'),
(6, 'Bearing Casing for Cylinder CO'),
(7, 'Cam Case Cover'),
(8, 'Cams'),
(9, 'Camshaft'),
(10, 'Charge Air Manifold'),
(11, 'Connecting Rod'),
(12, 'Control Element'),
(13, 'Control Element Cabinet'),
(14, 'Cooling Water Manifold'),
(15, 'Cooling Water Piping for Fuel Injector'),
(16, 'Cooling Water Pipings'),
(17, 'Crankcase Vent'),
(18, 'Crankshaft'),
(19, 'Cylinder'),
(20, 'Cylinder Cover'),
(21, 'Cylinder Head'),
(22, 'Cylinder Liner'),
(23, 'Cylinder Lubricating Pump Driv'),
(24, 'Engine Frame'),
(25, 'Exhaust Gas Piping'),
(26, 'Exhaust Piping (L = Left)'),
(27, 'External Thrust Bearing/Outbo'),
(28, 'Engine Control Valves'),
(29, 'Fly Wheel'),
(30, 'Fuel Injection Pump'),
(31, 'Fuel Injection Pump (Strength)'),
(32, 'Fuel Injection Pump Control Li'),
(33, 'Fuel Injection Pump Delivery P'),
(34, 'Fuel Injection Pump Driving GE'),
(35, 'Fuel Injection Valve'),
(36, 'Fuel Injector'),
(37, 'Fuel Oil Piping'),
(38, 'Fuel Pressure Pipe'),
(42, 'Fuel System'),
(43, 'Governing Linkage'),
(44, 'Governor'),
(45, 'Governor Drive'),
(46, 'Governor Driving Gear'),
(47, 'Indicator Cock/Valve'),
(48, 'Indicator Valve'),
(49, 'Inlet and Exhaust Valve'),
(50, 'Inspection Door w/ Relief Valve'),
(51, 'Lube Oil Pipes Valve Gear Lubricant'),
(52, 'Lube Oil Piping'),
(53, 'Main Bearing'),
(54, 'Oil Pump'),
(55, 'Oil Seal Coupling Side'),
(56, 'Oil Sump'),
(57, 'Overspeed Safety Device (w/o s'),
(58, 'Overspeed Trip'),
(59, 'Piston'),
(60, 'Raw Water Pump'),
(61, 'Relief Valve'),
(62, 'Reversing Gear'),
(63, 'Safety Device For Fuel Cut'),
(64, 'Safety Valve'),
(65, 'Servomotor For Camshaft Display'),
(66, 'Starting Air Apparatus'),
(67, 'Starting Air Distributor'),
(68, 'Starting Air Piping'),
(69, 'Starting Device'),
(70, 'Starting Valve'),
(71, 'Starting Valve (Dummy Valve)'),
(72, 'Supplemental Bearing of Camshaft'),
(73, 'Sulzer Bellows'),
(74, 'Tachogenerator'),
(75, 'Tachometer Driving Gear'),
(76, 'Thrust Bearing For Crankshaft'),
(77, 'Timing Gear Train'),
(78, 'Timing Gear Train Casing'),
(79, 'Turbo Charger'),
(80, 'Valve Drive'),
(81, 'Valve Gear'),
(82, 'Valve Gear Case'),
(83, 'Vibration Damper'),
(84, 'Visual Flow Control For Cylind'),
(85, 'AIR COOLER SUPPORT-OPPOSITE SIDE TO TIMING GEAR'),
(86, 'AIR COOLER-OPPOSITE SIDE TO TIMING GEAR'),
(87, 'AIR DISTRIBUTOR DRIVE'),
(88, 'AIR INTAKE MANIFOLD'),
(89, 'ANCHOR BEARING'),
(90, 'ANTI-VIBRATION DAMPER'),
(91, 'AUXILIARIES DRIVE'),
(92, 'BARRING GEAR '),
(93, 'BBC TURBO-BLOWER-OPPOSITE SIDE TO TIMING GEAR'),
(94, 'BELLOWS EXHAUST GAS MANIFOLD'),
(95, 'BOSS FOR THERMOMETER'),
(96, 'CAM SHAFT'),
(97, 'CAM SHAFT COVER'),
(98, 'CAMSHAFT FOR GENERATOR'),
(99, 'CAMSHAFT THRUST BEARING'),
(100, 'CIRCLIP'),
(101, 'CLEANING PIPES FOR T.B - OPPOSITE END TO TIMING GEAR'),
(102, 'CONNECTION BETWEEN AIR COOLER AND AIR MANIFOLD'),
(103, 'CONTACT LIFTING'),
(104, 'COUPLING SIDE COVER'),
(105, 'CRANKCASE OIL-VENT'),
(106, 'DRIVEN WATER PUMPS '),
(107, 'END COVER'),
(108, 'EXHAUST GAS MANIFOLD'),
(109, 'EXHAUST MANIFOLD'),
(110, 'EXTERNAL CAMSHAFT BEARING'),
(111, 'FUEL INJECTION PIPE'),
(112, 'FUEL OIL PIPE'),
(113, 'FUEL PUMP DRIVE'),
(114, 'INJECTION PUMP-CONTROL AUXILIARY APPARATUS'),
(115, 'INSULATING LAGGING'),
(116, 'INTAKE CONNECTION BETWEEN AIR COOLER AND ENGINE'),
(117, 'INTAKE CONNECTION BETWEEN T.B AND AIR COOLER'),
(118, 'L.O PRESSURE DROP TRIP LINKAGE'),
(119, 'LUBE OIL PUMP'),
(120, 'Mix Washer'),
(121, 'OIL PAN'),
(122, 'RECONDITIONING'),
(123, 'REGULATING DEVICE/FUEL INJECTION PUMP CONTROL LINKAGE'),
(124, 'RETAINING RING'),
(125, 'RIGHT HAND CAMSHAFT EXTRA BEARING'),
(126, 'SOUND-PROOFING FOR CONNECTION BOXES'),
(127, 'SPECIAL LUB-OIL RETURN PIPE'),
(128, 'SUPPLEMENTARY REGULATING DEVICE'),
(129, 'SUPPLEMENTARY REGULATING DEVICE/SAFETY DEVICE FOR FUEL CUT'),
(130, 'TB SUPPORT-OPPOSITE SIDE TO TIMING GEAR'),
(131, 'UNIDENTIFIED ORINGS'),
(132, 'VALVE CAGE'),
(133, 'Main Starting Valve'),
(134, 'Oil Seal Coupling Side'),
(135, 'Safety Valve for Cylinder'),
(136, 'WATER INLET & OUTLET CONNECTION'),
(137, 'FOUNDATION'),
(138, 'ENGINE LEVELING'),
(139, 'MAIN ENGINE'),
(140, 'ELECTRIC GENERATOR'),
(141, 'EXHAUST'),
(142, 'AIR COOLER'),
(143, 'COOLER'),
(144, 'CAM SHAFT SUPPLEMENTARY BEARING'),
(145, 'COUPLING OIL SEAL'),
(146, 'SEALS'),
(147, 'Unidentified Cotter Pin'),
(148, 'Unidentified Washer');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `subcat_id` int(11) NOT NULL DEFAULT '0',
  `original_pn` varchar(100) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `location_id` int(11) NOT NULL DEFAULT '0',
  `bin_id` int(11) NOT NULL DEFAULT '0',
  `warehouse_id` int(11) NOT NULL DEFAULT '0',
  `rack_id` int(11) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `picture1` varchar(255) DEFAULT NULL,
  `picture2` varchar(255) DEFAULT NULL,
  `picture3` varchar(255) DEFAULT NULL,
  `nkk_no` varchar(100) DEFAULT NULL,
  `semt_no` varchar(100) DEFAULT NULL,
  `selling_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `weight` varchar(50) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_id`, `subcat_id`, `original_pn`, `item_name`, `unit_id`, `group_id`, `location_id`, `bin_id`, `warehouse_id`, `rack_id`, `barcode`, `picture1`, `picture2`, `picture3`, `nkk_no`, `semt_no`, `selling_price`, `weight`, `added_by`, `date_added`) VALUES
(1, 1, 1, 'PN12345', 'Computer', 1, 1, 1, 1, 1, 1, '124444', NULL, NULL, NULL, 'asd', 'asddfew', '200.00', '150.00', 1, '2022-03-04'),
(2, 2, 2, 'PN01674728', 'Keyboard', 2, 1, 1, 1, 1, 1, 'sdfkjdf239239', NULL, NULL, NULL, 'asdgw32', 'dsf2134r', '500.00', '100.00', 1, '2022-03-04'),
(3, 1, 1, 'CON-AUT_1002', '35345345', 1, 1, 3, 57, 1, 216, '345345', '', '', '', '345345', '345345', '0.00', '345345.00', 1, '2022-04-07 14:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE IF NOT EXISTS `item_categories` (
`cat_id` int(11) NOT NULL,
  `cat_code` varchar(100) DEFAULT NULL,
  `cat_prefix` varchar(100) DEFAULT NULL,
  `cat_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`cat_id`, `cat_code`, `cat_prefix`, `cat_name`) VALUES
(1, 'A', '', 'Consumables'),
(2, 'B', '', 'Automotive Parts and Accessories'),
(3, 'C', '', 'Construction'),
(4, 'D', '', 'Electrical, Instrumentation and Control'),
(5, 'E', '', 'Engine and Auxiliary Parts and Accessories'),
(6, 'F', 'FFE-UNI', 'Furniture, Fixtures and Equipment'),
(7, 'G', 'TOO', 'Tools and Equipment'),
(8, NULL, NULL, 'Main Bearing'),
(9, NULL, NULL, 'Connecting Rod'),
(10, NULL, NULL, 'Piston'),
(11, NULL, NULL, 'Cylinder (Liner)'),
(12, NULL, NULL, 'Cylinder Head'),
(13, NULL, NULL, 'Inlet And Exhaust Valve'),
(14, NULL, NULL, 'Fuel Injector'),
(15, NULL, NULL, 'Safety Valve For Cylinder'),
(16, NULL, NULL, 'Starting Valve'),
(17, NULL, NULL, 'Indicator Valve'),
(18, NULL, NULL, 'Valve Gear'),
(19, NULL, NULL, 'Valve Gear  Case'),
(20, NULL, NULL, 'Cams'),
(21, NULL, NULL, 'Starting Air Distributor '),
(22, NULL, NULL, 'Fuel Injection Pump'),
(23, NULL, NULL, 'Fuel Pump Drive'),
(24, NULL, NULL, 'Inspection Door W/ Relief Valve'),
(25, NULL, NULL, 'Cooling Water Manifold'),
(26, NULL, NULL, 'Fuel Injection Pipe'),
(27, NULL, NULL, 'Reversing Gear (T/C Coupling Side)'),
(28, NULL, NULL, 'Timing Gear Train'),
(29, NULL, NULL, 'Main Starting Valve/Starting Air Apparatus'),
(30, NULL, NULL, 'Tachometer Driving Gear'),
(31, NULL, NULL, 'Overspeed Trip'),
(32, NULL, NULL, 'Governor Driving Gear'),
(33, NULL, NULL, 'Governor'),
(34, NULL, NULL, 'Auxiliary Driving Apparatus'),
(35, NULL, NULL, 'Coupling Side Cover'),
(36, NULL, NULL, 'Anchor Bearing'),
(37, NULL, NULL, 'End Cover'),
(38, NULL, NULL, 'Oil Seal Coupling Side'),
(39, NULL, NULL, 'Barring Gear (On Right Side)'),
(40, NULL, NULL, 'Crankshaft'),
(41, NULL, NULL, 'Balance Weight'),
(42, NULL, NULL, 'Oil Sump'),
(43, NULL, NULL, 'Cam Shaft'),
(44, NULL, NULL, 'Supplemental Bearing Of Cam Shaft'),
(45, NULL, NULL, 'Cam Shaft Cover'),
(46, NULL, NULL, 'Timing Gear Train Casing'),
(47, NULL, NULL, 'Regulating Device/Fuel Injection Pump Control Linkage'),
(48, NULL, NULL, 'Supplementary Regulating Device/Safety Device For Fuel Cut'),
(49, NULL, NULL, 'L.O Pressure Drop Trip Linkage'),
(50, NULL, NULL, 'Charge Air Manifold'),
(51, NULL, NULL, 'Exhaust Gas Piping'),
(52, NULL, NULL, 'Cooling Water Pipings'),
(53, NULL, NULL, 'Lube Oil Piping'),
(54, NULL, NULL, 'Lube Oil Pipes Valve Gear Lubricating Circuits'),
(55, NULL, NULL, 'Fuel Oil Piping'),
(56, NULL, NULL, 'Starting Air Piping'),
(57, NULL, NULL, 'Cooling Water Piping For Fuel Injector'),
(58, NULL, NULL, 'Vibration Damper'),
(59, NULL, NULL, 'Fly Wheel'),
(60, NULL, NULL, 'Turbo Charger'),
(61, NULL, NULL, 'Reconditioning'),
(62, NULL, NULL, 'Camshaft For Generator'),
(63, NULL, NULL, 'Engine Frame'),
(64, NULL, NULL, 'Oil Pan'),
(65, NULL, NULL, 'Valve Cage'),
(66, NULL, NULL, 'Mix Washer'),
(67, NULL, NULL, 'Circlip'),
(68, NULL, NULL, 'Retaining Ring'),
(69, NULL, NULL, 'Unidentified Orings'),
(70, NULL, NULL, 'AIR BRANCHES FOR CYLINDER COVER'),
(71, NULL, NULL, 'ARRANGEMENT OF TURBOCHARGER'),
(72, NULL, NULL, 'AUTOMATIC STARTING AIR SHUT-OFF VALVE'),
(73, NULL, NULL, 'AUTOMATIC STARTING-AIR STOP VALVE'),
(74, NULL, NULL, 'BARRING ENGINE (DRIVE)'),
(75, NULL, NULL, 'BARRING ENGINE; HORIZONTAL WORM GEAR'),
(76, NULL, NULL, 'BARRING ENGINE; PINION SHAFT'),
(77, NULL, NULL, 'BARRING ENGINE; VERTICAL WORM GEAR'),
(78, NULL, NULL, 'BEARING CASING FOR CYLINDER COVER'),
(79, NULL, NULL, 'CAMSHAFT'),
(80, NULL, NULL, 'CAMSHAFT DRIVE'),
(81, NULL, NULL, 'CASING (ENGINE WITH BUILT-ON PUMPS)'),
(82, NULL, NULL, 'CASING EXHAUST PIPING (TURBOCHARGER ON THE DAMPER SIDE)'),
(83, NULL, NULL, 'CASING EXHAUST PIPING (TURBOCHARGER ON THE FLYWHEEL SIDE)'),
(85, NULL, NULL, 'CONTROL ELEMENT CABINET'),
(86, NULL, NULL, 'CONTROL ELEMENTS'),
(87, NULL, NULL, 'COOLING WATER PUMP'),
(88, NULL, NULL, 'CRANKCASE'),
(89, NULL, NULL, 'CRANKCASE VENT'),
(91, NULL, NULL, 'CYLINDER BLOCK'),
(92, NULL, NULL, 'CYLINDER BLOCK (CASINGS)'),
(93, NULL, NULL, 'CYLINDER COVER'),
(94, NULL, NULL, 'CYLINDER LINER'),
(95, NULL, NULL, 'CYLINDER LUBRICATING PUMP DRIVE'),
(96, NULL, NULL, 'DRIVE (Engine with Built-on Pumps)'),
(98, NULL, NULL, 'ENGINE CONTROL VALVES'),
(100, NULL, NULL, 'ENGINE FRAME (SIDE COVER)'),
(101, NULL, NULL, 'EXHAUST PIPING  (L=Left       R=Right)'),
(102, NULL, NULL, 'EXHAUST PIPING (CASING)'),
(103, NULL, NULL, 'FUEL INJECTION PUMP (Strengthen Version)'),
(104, NULL, NULL, 'FUEL INJECTION VALVE'),
(105, NULL, NULL, 'FUEL PRESSURE PIPE'),
(106, NULL, NULL, 'FUEL SYSTEM'),
(107, NULL, NULL, 'FUEL TRANSFER PUMP'),
(108, NULL, NULL, 'GOVERNING LINKAGE'),
(109, NULL, NULL, 'GOVERNOR DRIVE'),
(112, NULL, NULL, 'INSTRUMENT PANEL'),
(113, NULL, NULL, 'INTERMEDIATE WHEELS FOR CAMSHAFT DRIVE'),
(114, NULL, NULL, 'LOAD CONTROL'),
(115, NULL, NULL, 'LOAD INDICATOR'),
(116, NULL, NULL, 'OIL MIST CONTROLLER'),
(117, NULL, NULL, 'OIL PUMP'),
(121, NULL, NULL, 'PRESSURE REGULATING VALVE'),
(122, NULL, NULL, 'PUMP ATTACHMENT'),
(123, NULL, NULL, 'RAW WATER PUMP'),
(124, NULL, NULL, 'RELIEF VALVE'),
(126, NULL, NULL, 'REMOTE LOAD INDICATOR'),
(127, NULL, NULL, 'SERVOMOTOR FOR CAMSHAFT DISPLACEMENT'),
(130, NULL, NULL, 'STARTING VALVE (DUMMY VALVE)'),
(131, NULL, NULL, 'STARTING-AIR SLEEVE VALVE'),
(132, NULL, NULL, 'SULZER BELLOWS'),
(133, NULL, NULL, 'TACHOGENERATOR'),
(134, NULL, NULL, 'THERMOMETER'),
(135, NULL, NULL, 'THRUST BEARING FOR CRANKSHAFT'),
(136, NULL, NULL, 'THRUST BOLT'),
(137, NULL, NULL, 'TIE ROD'),
(138, NULL, NULL, 'TRANSMITTER FOR REMOTE TACHOMETER'),
(139, NULL, NULL, 'TUBULAR SEALS'),
(140, NULL, NULL, 'VALVE DRIVE '),
(142, NULL, NULL, 'VISUAL FLOW CONTROL FOR CYLINDER LUBRICATION'),
(143, 'H', 'SHIP', 'Shipping Cost'),
(144, 'I', 'sa', 'dsadas');

-- --------------------------------------------------------

--
-- Table structure for table `item_subcat`
--

CREATE TABLE IF NOT EXISTS `item_subcat` (
`subcat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `subcat_code` varchar(100) DEFAULT NULL,
  `subcat_prefix` varchar(100) DEFAULT NULL,
  `subcat_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_subcat`
--

INSERT INTO `item_subcat` (`subcat_id`, `cat_id`, `subcat_code`, `subcat_prefix`, `subcat_name`) VALUES
(1, 1, 'A-1', 'CON-AUT', 'Automotive Supplies'),
(2, 1, 'A-2', 'CON-CHE', 'Chemical Supplies'),
(3, 1, 'A-3', 'CON-EIC', 'Electrical Supplies'),
(4, 1, 'A-4', 'CON-FUE', 'Fuel and Lubricants'),
(5, 1, 'A-5', 'CON-CON', 'Construction Consumables'),
(6, 1, 'A-6', 'CON-HOU', 'Housekeeping Supplies'),
(7, 1, 'A-7', 'CON-MED', 'Medical Supplies'),
(8, 1, 'A-8', 'CON-OFF', 'Office Supplies'),
(9, 1, 'A-9', 'CON-SAF', 'Safety & Security Supplies'),
(10, 1, 'A-10', 'CON-STA', 'Staffhouse Supplies'),
(11, 1, 'A-11', 'CON-OEA', 'Other Engine and Auxiliary Consumables'),
(12, 2, 'B-1', 'AUT-TRA', 'Transportation Equipment Parts and Acc.'),
(13, 2, 'B-2', 'AUT-HEA', 'Heavy Equipment Parts and Accessories'),
(14, 3, 'C-1', 'BUI-MAT', 'Building Materials'),
(15, 3, 'C-2', 'BUI-PIP', 'Piping'),
(16, 3, 'C-3', 'BUI-HAR', 'Hardware'),
(17, 4, 'D-1', 'EIC-PAR', 'EIC Parts and Accessories'),
(18, 5, 'E-1', 'AUX-PAR', 'Auxiliary Parts & Kits'),
(19, 5, 'E-2', 'ENG-COM', 'Engine/Mechanical (Common)   	'),
(20, 5, 'E-3', 'ENG-PIE', 'Engine/Mechanical (Pielstick)'),
(21, 5, 'E-4', 'ENG-SUL', 'Engine/Mechanical (Sulzer)'),
(22, 6, 'F-1', 'FFE-TRA', 'Transportation Equipment'),
(23, 6, 'F-2', 'FFE-HEA', 'Heavy Equipment'),
(24, 6, 'F-3', 'FFE-COM', 'Communication Equipment'),
(25, 6, 'F-4', 'FFE-FUR', 'Office Furnitures'),
(26, 6, 'F-5', 'FFE-OFF', 'Office Equipment'),
(27, 6, 'F-6', 'FFE-PPE', 'Personal Protective Equipment'),
(28, 6, 'F-7', 'FFE-SSE', 'Safety & Security Equipment'),
(29, 6, 'F-8', 'FFE-APP', 'Appliance'),
(30, 6, 'F-9', 'FFE-STA', 'Staffhouse Furniture and Supplies'),
(31, 6, 'F-10', 'FFE-HOU', 'Housewares'),
(32, 6, 'F-11', 'FFE-TES', 'Testing Equipment'),
(33, 6, 'F-12', 'FFE-MED', 'Medical Equipment'),
(34, 7, 'G-1', 'TOO-HAN', 'Hand Tools'),
(35, 7, 'G-2', 'TOO-POW', 'Power Tools'),
(36, 7, 'G-3', 'TOO-MEA', 'Measuring Tool'),
(37, 7, 'G-4', 'TOO-STO', 'Tool Storage/Box'),
(38, 6, 'F-13', 'FFE-UNI', 'Office Uniforms'),
(39, 1, 'A-12', 'COM-POW', 'Power Tools Parts and Accessories'),
(40, 1, 'A-13', '', 'Others'),
(41, 1, 'A-14', 'CON-TPA', 'Testing Equipment Parts and Accessories'),
(42, 7, 'G-5', 'TOO-SPE', 'Special Tool'),
(43, 60, '-1', 'TUR-PIE', 'Turbo Charger Parts and Accessories for Pielstick'),
(44, 60, '-2', 'TUR-SUL', 'Turbo Charger Parts and Accessories for Sulzer'),
(45, 143, 'H-1', 'SHIP-LOC', 'Shipping Cost - Local'),
(46, 143, 'H-2', 'SHIP-INT', 'Shipping Cost - International'),
(47, 7, 'G-6', 'TOO-LIF', 'Lifting Tools'),
(48, 7, 'G-7', 'TOO-LABE', 'Labelling Tools');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`location_id` int(11) NOT NULL,
  `location_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`) VALUES
(1, 'Cabinet'),
(3, 'Chem - Stg'),
(47, 'WH - Bldg.'),
(49, 'WH - Rm1'),
(50, 'WH - Rm2'),
(51, 'WH - Rm3'),
(54, 'WH - Extn'),
(56, 'WH - Extn A'),
(57, 'WH - Extn B'),
(58, 'WH - Sec 1'),
(59, 'WH - Sec 2'),
(60, 'WH - Sec 3'),
(61, 'WH - Sec 4'),
(62, 'PRO-WH-RM1'),
(63, 'PRO-WH-RM2'),
(64, 'PRO-WH-RM3'),
(65, 'CV Bay 1-1'),
(66, 'CV Bay 1-2'),
(67, 'CV Bay 1-3'),
(68, 'CV Bay 1-4'),
(69, 'CV Bay 1-5'),
(70, 'CV Bay 1-6'),
(71, 'CV Bay 1-7'),
(72, 'CV Bay 1-8'),
(73, 'CV Bay 1-9'),
(74, 'CV Bay 1-10'),
(75, 'CV 11'),
(76, 'CV 12'),
(77, 'CV 13'),
(78, 'CV Bay 2-14'),
(79, 'CV Bay 2-15'),
(80, 'CV Bay 2-16'),
(81, 'CV Bay 2-17'),
(82, 'CV Bay 2-18'),
(83, 'CV Bay 2-19'),
(84, 'CV Bay 2-20'),
(85, 'CV Bay 2-21'),
(86, 'CV Bay 2-22'),
(87, 'CV Yard'),
(88, 'Oring Box 1'),
(89, 'Oring Box 2'),
(90, 'Oring Box 3'),
(91, 'Oring Box 4'),
(92, 'Oring Box 5'),
(93, 'Oring Box 6'),
(94, 'Oring Box 7'),
(96, 'Oring Box 8'),
(97, 'Oring Box 9'),
(98, 'Oring Box 10'),
(99, 'Oring Drawer'),
(100, 'Stock Room'),
(103, 'Cabinet No. 1-B'),
(104, 'Oxy & Ace Storage Area');

-- --------------------------------------------------------

--
-- Table structure for table `manpower`
--

CREATE TABLE IF NOT EXISTS `manpower` (
`manpower_id` int(11) NOT NULL,
  `employee_name` varchar(150) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `daily_rate` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manpower`
--

INSERT INTO `manpower` (`manpower_id`, `employee_name`, `position`, `daily_rate`) VALUES
(2, 'Jonah Benares', 'IT', '36.00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_head`
--

CREATE TABLE IF NOT EXISTS `payment_head` (
`payment_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `payment_date` varchar(20) DEFAULT NULL,
  `payment_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=full, 2 = partial',
  `or_number` varchar(50) DEFAULT NULL,
  `payment_method` int(11) NOT NULL DEFAULT '0' COMMENT '1=cash, 2=check',
  `check_no` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pn_series`
--

CREATE TABLE IF NOT EXISTS `pn_series` (
`pn_id` int(11) NOT NULL,
  `subcat_prefix` varchar(50) DEFAULT NULL,
  `series` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pn_series`
--

INSERT INTO `pn_series` (`pn_id`, `subcat_prefix`, `series`) VALUES
(1, 'AUX-PAR', 1001),
(2, 'FFE-APP', 1001),
(3, 'EIC-PAR', 1001),
(4, 'BUI-MAT', 1001),
(5, 'AUX-PAR', 1002),
(6, 'AUX-PAR', 1003),
(7, 'AUX-PAR', 1004),
(8, 'CON-AUT', 1001),
(9, 'AUX-PAR', 1005),
(10, 'BUI-MAT', 1002),
(11, 'CON-AUT', 1002);

-- --------------------------------------------------------

--
-- Table structure for table `purpose`
--

CREATE TABLE IF NOT EXISTS `purpose` (
`purpose_id` int(11) NOT NULL,
  `purpose_desc` text
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purpose`
--

INSERT INTO `purpose` (`purpose_id`, `purpose_desc`) VALUES
(1, 'Accommodation/Board and Lodging'),
(2, 'Construction'),
(3, 'Corrective Maintenance\r\n'),
(4, 'Feeding/Medical Mission\r\n'),
(5, 'Housekeeping'),
(6, 'Hydration'),
(7, 'Inventory, Preservation, and Tagging'),
(8, 'Office Supplies'),
(9, 'Employee Protection (PPE)'),
(10, 'PMS (1000 R-Hrs)'),
(11, 'PMS (1500 R-Hrs)'),
(12, 'PMS (2000 R-Hrs)'),
(13, 'PMS (3000 R-Hrs)'),
(14, 'PMS (4000 R-Hrs)'),
(15, 'PMS (500 R-Hrs)'),
(16, 'PMS (8000 R-Hrs)'),
(17, 'Reconditioning'),
(18, 'Renovation'),
(19, 'Replacement'),
(20, 'Running Units Consumables'),
(21, 'Security Monitoring'),
(22, 'Testing/Sampling'),
(23, 'Tree Planting'),
(24, 'First Aid Treatment/Medication'),
(25, 'Training on Oil Spill Contingency Planning'),
(26, 'Fabrication of Office Partition'),
(27, 'HFO Fuel Piping Insulation'),
(28, 'HFO Settling and Service Tanks Insulation'),
(29, 'Storage Area Enclosure'),
(31, 'Pipe & Cable Trench Enclosure'),
(32, 'Power House Enclosure - Phase 2'),
(33, 'Supply of Power and Lighting'),
(34, 'Replacement of Cooler Plate and Gasket for Lube Oil Cooler'),
(35, 'Assembling of lube oil cooler plate'),
(36, 'Generator Sliding Tools for Sulzer'),
(37, 'Cylinder Head Hydraulic Tensioning Tool.'),
(38, 'Equipment NGCP Requirements'),
(39, 'Refuel for Heavy Equipment'),
(40, 'Installation of Microwave Radio Equipment'),
(41, 'Staff House Use'),
(42, 'Repair and Maintenance'),
(43, 'Pest Control'),
(44, 'Fire Protection System'),
(45, 'Fabrication of Generator Sliding Tools'),
(46, 'Insullation Works Equipment'),
(47, 'Portable Maintenance Equipment'),
(48, 'Repainting Works'),
(49, 'Adopt An Estero Program of EMB-DENR'),
(50, 'Working Clothes'),
(51, 'Material Recovery'),
(52, 'Power House Enclosure - Phase 1'),
(53, 'Support in Lifting & Sliding of Stator housing'),
(54, 'Station Service No. 2'),
(55, 'Leadership Training'),
(56, 'Water Treatment'),
(57, 'HFO Sludge Basin Cleaning'),
(58, 'Painting Works'),
(59, 'Removal & Transfer of Mechanical Barracks'),
(60, 'Construction of Cantilever Rip-Rap Wall at Main Drain Canal for Protection of Transmission Line Concrete Take Off Pole Foundation'),
(61, 'EIC Consumables'),
(62, 'Refill Hydraulic Oil'),
(63, 'Installation of Pippings'),
(64, 'Fabrication of Platform and Ladder'),
(65, 'Additional Sludge Recovery Storage'),
(66, 'Purifier House Enclosure - North Side'),
(67, 'Body Base Effective Grounding Installation'),
(68, 'Lightings'),
(69, 'Safekeeping of Tools'),
(70, 'Installation and Fabrication'),
(71, 'Installation of Covers for Plant Equipment'),
(72, 'Excess Materials'),
(73, 'Online Monitoring & Alarm'),
(74, 'Electrical Hand Tools for Personal Accountability'),
(75, 'Inventory Beginning Balance'),
(76, 'Waste Heat Recovery Boilers Removal'),
(77, 'Auto Start/Stop of Deep Well Pump Refill to Raw Water Tank'),
(78, 'RTD Wire Jacket Overall Insulation (Insertion of RTD sensors to coil winding for insulation)'),
(79, 'Microwave Antenna Support Structure'),
(80, 'Ventilation of Working Area'),
(81, 'Oil Drain Line (New Installation)'),
(82, 'Back filling/ Ground Preparation/ Canal Rip-rapping(1 side only)'),
(83, 'For Spare Unit on 125 VDC Battery, Bank for Generator'),
(84, '5MW Generator Exciter Contingency Parts'),
(85, 'Fuel For Rental of 0.3 cubic meter Bucket Backhoe'),
(86, 'CV Converted to Warehouse Phase 1'),
(87, 'Anti-Condensate Heater'),
(88, 'Temporary Christmas Decoration'),
(89, 'Sounding Activities'),
(90, 'Ready Spare for 3 Units Sulzer Engines (Speed Sensor Generator)'),
(91, 'Plant Decorations'),
(92, '40MVA Power Transformer, 6.6kV Additional Bus Support (Prevention of Bushing Oil Leak and Crack from Bus Movement)'),
(93, 'Pipe Segment Connecting Plates'),
(94, 'Progen Consumables'),
(95, 'DG4 & DG5 Generator: Correction of Erroneous RTD Probe Sensor Stator Winding Monitoring from PT50 to PT100'),
(96, 'Installation of Solar Powered / AC Powered Navigation Warning Light Flashing (As per Insurance requirement)'),
(97, 'Operations & Maintenance Consumables'),
(98, 'HFO Fuel Piping Insulation and Cladding'),
(99, 'Steel Pole for Microwave Antenna'),
(100, 'Grounding Installation for Microwave Antenna'),
(101, 'For Shells(Waste Heat Recovery Boilers Removal)'),
(102, 'Installation of Air Terminal'),
(103, 'Construction of Sounding Port Platform'),
(104, 'Fabrication of Battery Rack for 125Vdc Battery (100Ah)'),
(105, 'CV Converted to Warehouse Phase - 1 (Foundation)'),
(106, '40MVA Power Transformer Secondary Bus Framing/Support'),
(107, 'Personal Protective Equipment'),
(108, 'Grounding System Lay-out / Installation'),
(109, 'Fabrication of Guying Equalizer Bodies'),
(110, 'Replacement Materials for Riser Pipes and Consumables for Cleaning of Pump'),
(111, 'Repair of Left Bank Condition Canal'),
(112, 'Fabrication of Microwave Antenna Ladder'),
(113, 'Installation of Breaker'),
(114, 'Contingency Parts'),
(115, 'Threading of Lifting Tool'),
(116, 'Fabrication of Anchor Bolts'),
(117, 'Fabrication'),
(118, 'Christmas Prizes'),
(119, 'Additional Replacement Riser Pipes and Adapter'),
(120, 'Christmas Lantern Lightnings, Use for Christmas Party and Plant Light decor for Spirit of Christmas'),
(121, 'For Adjustment/Correction of Item Name'),
(122, 'Cover For MOCB Units'),
(123, 'Insulation of HFO Settling & Service Tanks'),
(124, 'Common Washing Area'),
(125, 'Fabrication of Lifting Frame for 4 Units Generator'),
(126, 'Additional Padlock for Reconditioning Equipment Tool Cabinet'),
(127, 'Uninterrupted Power Supply'),
(128, 'Installation of Protection Relay'),
(129, 'Installation of 5 Units Flood Lights Inside Power Plant Area'),
(130, 'Replacement and Spare of Damaged Mechanical Seal'),
(131, 'Renovation of All Electrical Outlet and Lan Cable'),
(132, 'Microwave Radio Equipment for NGCP Requirements'),
(133, 'Replacement of Damaged and Worn-out Parts'),
(134, 'Identification, Pre-Cleaning & Tagging of Spare Parts for PIELSTICK Engine, at CV Area (Additional )'),
(135, 'Re-Insulation of Jacket Water Motor in 4 Termination'),
(136, 'Microwave DC Supply Termination'),
(137, 'Suction of Header Line'),
(138, 'Lubricant Consumable for Plant Equipment ( Barring Gear, Lube Oil & Heavy Fuel Oil Purifier )'),
(139, 'Dismantling, cleaning, inspection, crack testing, measurement & evaluation, reassembling & preservation.'),
(140, 'Consumables / Cleaning & Preservation of Spare parts'),
(141, 'Fabrication of Wooden Crates for DG1 Engine Parts (Pistons & Connecting Rods)'),
(142, 'Replacement of Worn Out Equipment Cover at CV Yard'),
(143, 'Recovered items'),
(144, 'Replacement of Defective Generator Potential Transformer'),
(145, 'Consumables for Refurbishing  / Reconditioning'),
(146, 'Consumables for Reconditioning and Painting'),
(147, 'Consumables for Fabrication of Pielstick Cylinder Head Stand Bracket'),
(148, 'Preservation'),
(149, 'Hydrotesting of Cylinder Head and Valve Cage'),
(150, 'Common Tool for Thorough Cleaning of Engine Parts'),
(151, 'Special Tool'),
(152, 'Purchase Order of Engine Parts and Accessories'),
(153, 'Replacement Parts for Refurbishing / Reconditioning'),
(154, 'Support for Engine Parts and Other Equipment'),
(155, 'Fabrication of Crates'),
(156, 'Replacement of Defective Components for Operation Control Element - Sulzer'),
(157, 'Heating of Engine Parts'),
(158, 'Replacement for Burn Out Infared Heat Lamp'),
(159, 'Consumables for Reconditioning and Refurbishing'),
(160, 'Safekeep and Storage'),
(161, 'Equipment for Engine Parts Thickness Gauge Measurement'),
(162, 'To Power Up Equipment'),
(163, 'Replacement of Bellows for Exhaust Pipe'),
(164, 'CV Yard Maintenance'),
(165, 'Additional Consumables for Refurbishing/Reconditioning'),
(166, 'Repacking of Silica Gel'),
(167, 'Replacement of AVR Unit External Rheostat'),
(168, 'For Grass Cutter Use'),
(169, 'Consumables for Cleaning, Crack Testing and Inspection of Progen Items'),
(170, 'For Lubrication'),
(171, 'For Marking'),
(172, 'Weekly Performance Output Testing Supersede PR-423-2019'),
(173, 'Testing Equipment'),
(174, 'For Weighing of Spare Parts and Equipment'),
(175, 'Tools'),
(176, 'For January-February 2021 Office Supplies Consumption'),
(177, 'Lifting of Engine Parts'),
(178, 'Fabrication of Nuts'),
(179, 'For Printing and Scanning of Progen and IPRO-B Documents and Reports'),
(180, 'Consumables for Crating of Refurbished 4 Units Cylinder Head Assembly'),
(181, 'Change Oil'),
(182, 'Electrical Connection'),
(183, 'Safekeeping of Tools and Materials'),
(184, 'Consumables for Dismantling, Inspection, Hydrotesting and Assembling'),
(185, 'Painting Materials for Refurbishing/Reconditioning'),
(187, 'Tools and Equipment for Reconditioning/Refurbishing'),
(188, 'Calibration of Multimeters, Insulation and Winding Test Equipment'),
(189, 'Sulzer Spare Parts (old stock) Turnover to Cenpri Warehouse'),
(190, 'Replacement of Damaged Padlock'),
(191, 'Replacement of Drained Battery'),
(192, 'Consumables of Cleaning and Clearing'),
(193, 'Replacement of Allocated Corrugated Sheets for Engine Block Shed'),
(194, 'Official Use'),
(195, ''),
(196, 'rtyfhfghfgh');

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE IF NOT EXISTS `rack` (
`rack_id` int(11) NOT NULL,
  `rack_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`rack_id`, `rack_name`) VALUES
(1, 'Bolt Rack 3-A'),
(2, 'Bolt Rack 3-B'),
(3, 'Bolt Rack 4-A'),
(4, 'Bolt Rack 4-B'),
(5, 'Rack - B1'),
(6, 'Rack - B2'),
(7, 'Rack - B3'),
(8, 'Rack - B4'),
(9, 'Rack - C1'),
(10, 'Rack - C2'),
(11, 'Rack - C3'),
(12, 'Rack - C4'),
(13, 'Rack - D1'),
(14, 'Rack - D2'),
(15, 'Rack - D3'),
(16, 'Rack - E1'),
(17, 'Rack - E2'),
(18, 'Rack - E3'),
(19, 'Rack - E4'),
(20, 'Rack - F1'),
(21, 'Rack - F2'),
(22, 'Rack - F3'),
(23, 'Rack - G1'),
(24, 'Rack - G2'),
(25, 'Rack - G3'),
(26, 'Rack - H1'),
(27, 'Rack - H2'),
(28, 'Rack - H3'),
(29, 'Rack - I1'),
(30, 'Rack - I2'),
(31, 'Rack - I3'),
(32, 'Rack - J1'),
(33, 'Rack - J2'),
(34, 'Rack - J3'),
(35, 'Rack - K1'),
(36, 'Rack - K2'),
(37, 'Rack - K3'),
(38, 'Rack - K4'),
(39, 'Rack - L1'),
(40, 'Rack - L2'),
(41, 'Rack - M1'),
(42, 'Rack - M2'),
(43, 'Rack - M3'),
(44, 'Rack - M4'),
(45, 'Rack - M5'),
(46, 'Rack - N1'),
(47, 'Rack - N2'),
(48, 'Rack - N3'),
(49, 'Rack - N4'),
(50, 'Rack - O1'),
(51, 'Rack - O2'),
(52, 'Rack - O3'),
(53, 'Rack - P1'),
(54, 'Rack - P2'),
(55, 'Rack - P3'),
(56, 'Rack - Q1'),
(57, 'Rack - Q2'),
(58, 'Rack - Q3'),
(59, 'Rack - Q4'),
(60, 'Rack - Q5'),
(61, 'Rack - R1'),
(62, 'Rack - R2'),
(63, 'Rack - R3'),
(64, 'Container beside Rack 3'),
(65, 'Container beside Rack 5'),
(66, 'O-ring Box #1'),
(67, 'O-ring Box #5'),
(68, 'O-ring Box #4'),
(69, 'O-ring Box #7'),
(70, 'O-ring Box #2'),
(71, 'O-ring Box #3'),
(72, 'O-ring Box #8'),
(73, 'O-ring Box #9'),
(75, 'Oring Drawer 1'),
(76, 'Oring Drawer 2'),
(77, 'Oring Drawer 3'),
(78, 'Oring Drawer 4'),
(79, 'Oring Drawer 5'),
(81, 'Rack 1'),
(82, 'Rack 1 Drawer 2'),
(83, 'Rack 10-A'),
(84, 'Rack 10-B'),
(85, 'Rack 10-C'),
(86, 'Rack 11-A'),
(87, 'Rack 11-B'),
(88, 'Rack 1-A'),
(89, 'Rack 1-B'),
(90, 'Rack 1-B Drawer 1'),
(91, 'Rack 1-B Drawer 2'),
(95, 'Rack 1-B Drawer 3'),
(96, 'Rack 1-B Drawer 4'),
(97, 'Rack 1-B Drawer 5'),
(98, 'Rack 1-C'),
(99, 'Rack 1-C Drawer 6'),
(100, 'Rack 1-C Drawer 5'),
(102, 'Rack 1-D'),
(103, 'Rack 2-A'),
(104, 'Rack 2-B'),
(105, 'Rack 2-C'),
(106, 'Rack 2-D'),
(107, 'Rack 3-A'),
(108, 'Rack 3-B'),
(109, 'Rack 3-C'),
(110, 'Rack 3-D'),
(111, 'Rack 4-A'),
(112, 'Rack 4-B'),
(113, 'Rack 4-C'),
(114, 'Rack 4-D'),
(116, 'Rack 5-A'),
(117, 'Rack 5-B'),
(118, 'Rack 5-C'),
(119, 'Rack 5-D'),
(120, 'Rack 6-A/C'),
(121, 'Rack 6-C'),
(122, 'Rack 6-D'),
(123, 'Rack 7-A, Side Wall'),
(124, 'Rack 7-B, Side Wall'),
(125, 'Rack 7-C'),
(126, 'Rack 7-D'),
(127, 'Rack 8-A, Side Wall'),
(128, 'Rack 8-B, Side Wall'),
(129, 'Rack 8-C'),
(130, 'Rack 8-D'),
(131, 'Rack 8-E'),
(132, 'Rack 9-A'),
(133, 'Rack 9-B'),
(134, 'Rack 9-C'),
(137, 'Valve Rack 1'),
(138, 'Warehouse Extension'),
(139, 'R 4-D'),
(140, 'R 4-C'),
(141, 'BOX SEM'),
(142, 'beside rack 1'),
(143, 'R 4-B'),
(144, 'R 4-B/Drawer'),
(145, 'R 4-C  Drawer'),
(146, 'SR Cabinet 1-A'),
(147, 'Side Wall Rack'),
(148, 'Drawer 2.1 Side Wall'),
(149, 'Rack 5-A/B/C'),
(150, 'Beside Wall & Rack 5'),
(151, 'Rack 6-B'),
(152, 'O-ring Box #6'),
(153, 'Drawer 1.1 Side Wall'),
(154, 'Drawer 1.2 Side Wall'),
(155, 'Drawer 1.3 Side Wall'),
(156, 'Drawer 1.4 Side Wall'),
(157, 'Drawer 1.5 Side Wall'),
(158, 'Drawer 2.1 Side Wall'),
(159, 'Drawer 2.2 Side Wall'),
(160, 'Drawer 2.3 Side Wall'),
(161, 'Drawer 2.4 Side Wall'),
(162, 'Drawer 2.5 Side Wall'),
(163, 'Drawer 3.1 Side Wall'),
(164, 'Drawer 3.2 Side Wall'),
(165, 'Drawer 3.3 Side Wall'),
(166, 'Drawer 3.5 Side Wall'),
(167, 'Drawer 3.4 Side Wall'),
(168, 'Drawer 4.1 Side Wall'),
(169, 'Drawer 4.2 Side Wall'),
(170, 'Drawer 4.3 Side Wall'),
(171, 'Drawer 4.5 Side Wall'),
(172, 'Drawer 5.1 Side Wall'),
(173, 'Drawer 5.2 Side Wall'),
(174, 'Drawer 5.3 Side Wall'),
(175, 'Drawer 5.4 Side Wall'),
(176, 'Drawer 5.5 Side Wall'),
(177, 'Drawer 6.1 Side Wall'),
(178, 'Drawer 4.4 Side Wall'),
(179, 'Valve Rack 2'),
(180, 'Rack beside Valve Rack 1'),
(181, 'Valve & Injector Rack'),
(182, 'Governor Box'),
(183, 'Aux Rack 4-A'),
(184, 'Aux Rack 4-B'),
(185, 'Aux Rack 1-C Drawer 3.10'),
(186, 'Aux Rack 4-D Box1'),
(187, 'SR Cabinet 2-A'),
(188, 'SR Cabinet 2-B'),
(189, 'SR Cabinet 2-C'),
(190, 'SR Cabinet 1-B'),
(191, 'Aux Rack 4-C'),
(192, 'Aux Rack 1-C Drawer 1.10'),
(193, 'Aux Rack 1-C Drawer 1.9'),
(194, 'Aux Rack 1-C Drawer 3.9'),
(195, 'Aux Rack 1-C Drawer 1.5'),
(196, 'Aux Rack 1-C Drawer 1.6'),
(197, 'Aux Rack 1-C Drawer 1.7'),
(198, 'Aux Rack 1-C Drawer 1.8'),
(199, 'Aux Rack 1-C Drawer 3.1'),
(200, 'Aux Rack 1-C Drawer 2.1'),
(201, 'Aux Rack 1-C Drawer 2.2'),
(202, 'Aux Rack 1-C Drawer 2.3'),
(203, 'Aux Rack 1-C Drawer 2.4'),
(204, 'Aux Rack 1-C  Drawer 2.5'),
(205, 'Aux Rack 1-C Drawer 3.2'),
(206, 'Aux Rack 1-C Drawer 3.3'),
(207, 'Aux Rack 1-C Drawer 2.6'),
(208, 'Aux Rack 1-C Drawer 2.7'),
(209, 'Aux Rack 1-C Drawer 2.8'),
(210, 'Aux Rack 1-C Drawer 3.5'),
(211, 'Aux Rack 1-C Drawer 3.4'),
(212, 'Aux Rack 1-C Drawer 3.7'),
(213, 'Aux Rack 1-C Drawer 2.9'),
(214, 'Aux Rack 1-C Drawer 2.10'),
(215, 'Aux Rack 1-C Drawer 3.6'),
(216, 'Aux Rack 1-A'),
(217, 'Aux Rack 1-B'),
(218, 'Aux Rack 1-C'),
(219, 'Aux Rack 1-C Drawer 1.1'),
(220, 'Aux Rack 1-C Drawer 1.2'),
(221, 'Aux Rack 1-C Drawer 1.3'),
(222, 'Aux Rack 1-C Drawer 1.4'),
(223, 'EIC Rack 10-A Drawer 2.1'),
(224, 'Rack 3-E'),
(225, 'Aux Rack 2-A'),
(226, 'Aux Rack 2-B'),
(227, 'Aux Rack 2-C'),
(228, 'Aux Rack 2-D'),
(229, 'Aux Rack 1-C Drawer 3.8'),
(230, 'Aux Rack 1-C Drawer 4.1'),
(231, 'Aux Rack 1-C Drawer 4.2'),
(232, 'Aux Rack 1-C Drawer 4.3'),
(233, 'Aux Rack 1-C Drawer 4.4'),
(234, 'Aux Rack 1-C Drawer 4.5'),
(235, 'Aux Rack 1-C Drawer 4.6'),
(236, 'Aux Rack 1-C Drawer 4.7'),
(237, 'Aux Rack 1-C Drawer 4.8'),
(238, 'Aux Rack 1-C Drawer 4.9'),
(239, 'Aux Rack 1-C Drawer 4.10'),
(240, 'Aux Rack 1-C Drawer 5.1'),
(241, 'Aux Rack 1-C Drawer 5.2'),
(242, 'Aux Rack 1-C Drawer 5.3'),
(243, 'Aux Rack 1-C Drawer 5.4'),
(244, 'Aux Rack 1-C Drawer 5.5'),
(245, 'Aux Rack 1-C Drawer 5.6'),
(246, 'Aux Rack 1-C Drawer 5.8'),
(247, 'Aux Rack 1-C Drawer 5.7'),
(248, 'Aux Rack 1-C Drawer 5.9'),
(249, 'Aux Rack 1-C Drawer 5.10'),
(250, 'Aux Rack 6-A'),
(251, 'Aux Rack 6-B'),
(252, 'Aux Rack 6-B, Drawer 2A'),
(253, 'Aux Rack 6-B, Drawer 2B'),
(254, 'Aux Rack 6-B, Drawer 2C'),
(255, 'Aux Rack 6-B, Drawer 2D'),
(256, 'Aux Rack 6-B, Drawer 2E'),
(257, 'Aux Rack 6-B, Drawer 1A'),
(258, 'Aux Rack 6-B, Drawer 1B'),
(259, 'Aux Rack 6-B, Drawer 1C'),
(260, 'Aux Rack 6-B, Drawer 1D'),
(261, 'Aux Rack 6-B, Drawer 1E'),
(262, 'Aux Rack 6-B, Drawer 3A'),
(263, 'Aux Rack 6-B, Drawer 3B'),
(264, 'Aux Rack 6-B, Drawer 3C'),
(265, 'Aux Rack 6-B, Drawer 3D'),
(266, 'Aux Rack 6-B, Drawer 3E'),
(267, 'Aux Rack 6-C, Durabox'),
(268, 'Aux Rack 6-B, Drawer 4A'),
(269, 'Aux Rack 6-B, Drawer 4B'),
(270, 'Aux Rack 6-B, Drawer 4C'),
(271, 'Aux Rack 6-B, Drawer 4E'),
(272, 'Aux Rack 6-B, Drawer 4D'),
(273, 'EIC Rack 8-A'),
(274, 'EIC Rack 8-B Drawer 1.1'),
(275, 'EIC Rack 8-B Drawer 1.2'),
(276, 'EIC Rack 8-B Drawer 1.3'),
(277, 'EIC Rack 8-B Drawer 1.4'),
(278, 'EIC Rack 8-B Drawer 1.5'),
(279, 'EIC Rack 8-B Drawer 1.6'),
(280, 'EIC Rack 8-B Drawer 2.1'),
(281, 'EIC Rack 8-B Drawer 2.2'),
(282, 'EIC Rack 8-B Drawer 2.3'),
(283, 'EIC Rack 8-B Drawer 2.4'),
(284, 'EIC Rack 8-B Drawer 2.5'),
(285, 'EIC Rack 8-B Drawer 2.6'),
(286, 'EIC Rack 8-B Drawer 2.7'),
(287, 'EIC Rack 9-A'),
(288, 'EIC Rack 9-B'),
(289, 'EIC Rack 9-C'),
(290, 'EIC Rack 9-C Box'),
(291, 'SR Cabinet 2-D'),
(292, 'SR Cabinet 2-E'),
(293, 'Side Wall'),
(294, 'EIC Rack 10-A Drawer 3.1'),
(295, 'EIC Rack 10-A Drawer 3.2'),
(296, 'EIC Rack 10-A Drawer 3.3'),
(297, 'EIC Rack 10-A Drawer 3.4'),
(298, 'EIC Rack 10-A Drawer 3.5'),
(299, 'EIC Rack 10-A Drawer 3.6'),
(300, 'EIC Rack 10-A Drawer 3.7'),
(301, 'EIC Rack 10-A Drawer 3.8'),
(302, 'EIC Rack 10-A Drawer 3.9'),
(303, 'EIC Rack 10-A Drawer 4.1'),
(304, 'EIC Rack 10-A Drawer 4.2'),
(305, 'EIC Rack 10-A Drawer 4.3'),
(306, 'EIC Rack 10-A Drawer 4.4'),
(307, 'EIC Rack 10-A Drawer 4.5'),
(308, 'EIC Rack 10-A Drawer 4.6'),
(309, 'EIC Rack 10-A Drawer 4.7'),
(310, 'EIC rack 10-A Drawer 5.1'),
(311, 'EIC Rack 10-A Drawer 5.2'),
(312, 'SR Table'),
(313, 'Aux Rack 4-C Drawer 3.9'),
(314, 'Aux Rack 1-C Drawer 3.10'),
(315, 'Aux Rack 1-D'),
(316, 'Aux Rack 5-A Drawer 2.7'),
(317, 'Aux Rack 5-A Drawer 2.6'),
(318, 'Aux Rack 5-A Drawer 2.3'),
(319, 'Aux Rack 5-A Drawer 2.5'),
(320, 'Aux Rack 5-A Drawer 2.4'),
(321, 'Aux Rack 5-B'),
(322, 'Aux Rack 5-A'),
(323, 'Aux Rack 5-B Durabox'),
(324, 'Aux Rack 5-A Drawer 2.1'),
(325, 'Aux Rack 5-A Drawer 1.10'),
(326, 'Aux Rack 5-A Drawer 1.8'),
(327, 'Aux Rack 5-A Drawer 1.7'),
(328, 'Aux Rack 5-A Drawer 1.9'),
(329, 'Aux Rack 5-A Drawer 1.1'),
(330, 'Aux Rack 5-A Drawer 1.2'),
(331, 'Aux Rack 5-A Drawer 1.3'),
(332, 'Aux Rack 5-A Drawer 1.6'),
(333, 'Aux Rack 5-A Drawer 2.10'),
(334, 'Aux Rack 5-A Drawer 1.9'),
(335, 'Aux Rack 5-A Drawer 2.2'),
(336, 'Aux Rack 5-A Drawer 1.5'),
(337, 'Aux Rack 5-C Durabox'),
(338, 'Aux Rack 5-C'),
(339, 'Aux Rack 5-A Drawer 1.4'),
(340, 'Bolt Rack 1-A'),
(341, 'Bolt Rack 1-B'),
(342, 'Bolt Rack 2-A'),
(343, 'Bolt Rack 2-B'),
(344, 'Aux Rack 7-A'),
(345, 'Aux Rack 7-B'),
(346, 'Aux Rack 7-C'),
(347, 'Aux Rack 7-D'),
(348, 'Aux Rack 6-D'),
(349, 'EIC Rack 10-A Drawer 5.3'),
(350, 'EIC Rack 10-A Drawer 5.4'),
(351, 'EIC Rack 10-A Drawer 5.5'),
(352, 'EIC Rack 10-A Drawer 5.6'),
(353, 'EIC Rack 10-A Drawer 5.7'),
(354, 'EIC Rack 10-A Drawer 5.8'),
(355, 'EIC Rack 10-B'),
(356, 'EIC Rack 10-C'),
(357, 'Aux Rack 4-D Box2'),
(358, 'Bolt Rack 3-C'),
(359, 'Aux Rack 3-A'),
(360, 'Aux Rack 3-B'),
(361, 'Aux Rack 3-C'),
(362, 'Aux Rack 3-D'),
(363, 'Aux Rack 3-E'),
(364, 'Aux Rack 4-D'),
(365, 'Bolt Rack 2-A Container 1, Container 2'),
(366, 'Bolt Rack 2-A Container 3, Container 4'),
(367, 'EIC Rack 8-B'),
(368, 'Testing Storage Rm Wall'),
(369, 'Oxy & Ace Storage Area'),
(370, 'EIC Rack 10-A Drawer 2.2'),
(371, 'EIC Rack 10-A Drawer 2.3'),
(372, 'EIC Rack 10-A Drawer 2.4'),
(373, 'EIC Rack 10-A Drawer 2.5'),
(374, 'EIC Rack 10-A Drawer 2.6'),
(375, 'EIC Rack 10-A Drawer 2.7'),
(376, 'EIC Rack 10-A Drawer 1.0'),
(377, 'EIC Rack 10-A Drawer 1.1'),
(378, 'EIC Rack 10-A Drawer 1.2'),
(379, 'EIC Rack 10-A Drawer 1.3'),
(380, 'EIC Rack 10-A Drawer 1.4'),
(381, 'Bay 2 CV14'),
(382, 'Drawer 6.3 Side Wall'),
(383, 'Drawer 6.4 Side Wall'),
(384, 'Rack 6-A'),
(385, 'Rack 7-A'),
(386, 'Rack 7-B'),
(387, 'PRO-Office Supply Rack'),
(388, 'Floor, beside SR Table'),
(389, 'Drawer 6.2 Side Wall');

-- --------------------------------------------------------

--
-- Table structure for table `receive_details`
--

CREATE TABLE IF NOT EXISTS `receive_details` (
`rd_id` int(11) NOT NULL,
  `receive_id` int(11) NOT NULL DEFAULT '0',
  `pr_no` varchar(50) DEFAULT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `purpose_id` int(11) NOT NULL DEFAULT '0',
  `inspected_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receive_head`
--

CREATE TABLE IF NOT EXISTS `receive_head` (
`receive_id` int(11) NOT NULL,
  `mrecf_no` varchar(50) DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `receive_date` varchar(20) DEFAULT NULL,
  `dr_no` varchar(50) DEFAULT NULL,
  `po_no` varchar(50) DEFAULT NULL,
  `si_no` varchar(50) DEFAULT NULL,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `pcf` int(11) DEFAULT '0',
  `saved` int(11) DEFAULT '0',
  `delivered_by` text,
  `received_by` int(11) NOT NULL DEFAULT '0',
  `acknowledged_by` int(11) NOT NULL DEFAULT '0',
  `noted_by` int(11) NOT NULL DEFAULT '0',
  `overall_remarks` text,
  `backorder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receive_items`
--

CREATE TABLE IF NOT EXISTS `receive_items` (
`ri_id` int(11) NOT NULL,
  `rd_id` int(11) NOT NULL DEFAULT '0',
  `receive_id` int(11) NOT NULL DEFAULT '0',
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `brand` varchar(50) DEFAULT NULL,
  `catalog_no` varchar(50) DEFAULT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `item_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `expected_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `received_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `local_mnl` int(11) NOT NULL DEFAULT '0',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `expiration_date` varchar(50) DEFAULT NULL,
  `remarks` text,
  `bo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `repair_details`
--

CREATE TABLE IF NOT EXISTS `repair_details` (
`repair_id` int(11) NOT NULL,
  `damage_det_id` int(11) NOT NULL DEFAULT '0',
  `in_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `repair_date` varchar(20) DEFAULT NULL,
  `jo_no` varchar(30) DEFAULT NULL,
  `assessment` int(11) NOT NULL DEFAULT '0' COMMENT '1=repair, 2=beyong repair',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `repaired_by` varchar(150) DEFAULT NULL,
  `repair_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `received_by` int(11) NOT NULL DEFAULT '0',
  `remarks` text,
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `saved` int(11) NOT NULL DEFAULT '0',
  `unsaved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_details`
--

CREATE TABLE IF NOT EXISTS `return_details` (
`return_details_id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `in_id` int(11) NOT NULL DEFAULT '0',
  `return_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unit_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `selling_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_head`
--

CREATE TABLE IF NOT EXISTS `return_head` (
`return_id` int(11) NOT NULL,
  `dr_no` varchar(30) DEFAULT NULL,
  `return_date` varchar(20) DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_service_details`
--

CREATE TABLE IF NOT EXISTS `return_service_details` (
`return_serv_details_id` int(11) NOT NULL,
  `return_service_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `in_id` int(11) NOT NULL DEFAULT '0',
  `return_qty` int(11) NOT NULL DEFAULT '0',
  `unit_cost` decimal(10,0) NOT NULL DEFAULT '0',
  `selling_price` decimal(10,0) NOT NULL DEFAULT '0',
  `total_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `return_service_head`
--

CREATE TABLE IF NOT EXISTS `return_service_head` (
`return_service_id` int(11) NOT NULL,
  `dr_no` varchar(50) DEFAULT NULL,
  `return_date` varchar(20) DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_good_details`
--

CREATE TABLE IF NOT EXISTS `sales_good_details` (
`sales_good_det_id` int(11) NOT NULL,
  `sales_good_head_id` int(11) NOT NULL DEFAULT '0',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ave_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `selling_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_percent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `return_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_good_head`
--

CREATE TABLE IF NOT EXISTS `sales_good_head` (
`sales_good_head_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `sales_date` varchar(20) DEFAULT NULL,
  `pr_no` varchar(30) DEFAULT NULL,
  `pr_date` varchar(20) DEFAULT NULL,
  `po_no` varchar(30) DEFAULT NULL,
  `po_date` varchar(20) DEFAULT NULL,
  `dr_no` varchar(30) DEFAULT NULL,
  `vat` int(11) NOT NULL DEFAULT '0' COMMENT '1-vatable, 2-non vat',
  `remarks` text,
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `saved` int(11) NOT NULL DEFAULT '0',
  `billed` int(11) NOT NULL DEFAULT '0' COMMENT '1=billed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_services_head`
--

CREATE TABLE IF NOT EXISTS `sales_services_head` (
`sales_serv_head_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `sales_date` varchar(20) DEFAULT NULL,
  `jor_no` varchar(30) DEFAULT NULL,
  `jor_date` varchar(20) DEFAULT NULL,
  `joi_no` varchar(30) DEFAULT NULL,
  `joi_date` varchar(20) DEFAULT NULL,
  `dr_no` varchar(30) DEFAULT NULL,
  `vat` int(11) NOT NULL DEFAULT '0' COMMENT '1-vatable, 2-non vat',
  `purpose` text,
  `create_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `ar_description` text,
  `shipped_via` int(11) NOT NULL DEFAULT '0',
  `waybill_no` varchar(100) DEFAULT NULL,
  `remarks` text,
  `total_engine_parts` decimal(10,2) NOT NULL DEFAULT '0.00',
  `service_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wht` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saved` int(11) NOT NULL DEFAULT '0',
  `billed` int(11) NOT NULL DEFAULT '0' COMMENT '1=billed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_serv_equipment`
--

CREATE TABLE IF NOT EXISTS `sales_serv_equipment` (
`sales_serv_equipment_id` int(11) NOT NULL,
  `sales_serv_head_id` int(11) NOT NULL DEFAULT '0',
  `equipment_id` int(11) NOT NULL DEFAULT '0',
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `uom` varchar(30) DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT '0',
  `total_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rate_flag` int(11) NOT NULL DEFAULT '0' COMMENT '1=Daily Rate, 2=Hourly Rate'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_serv_items`
--

CREATE TABLE IF NOT EXISTS `sales_serv_items` (
`sales_serv_items_id` int(11) NOT NULL,
  `sales_serv_head_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `ave_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `selling_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_percent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `return_service_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_serv_manpower`
--

CREATE TABLE IF NOT EXISTS `sales_serv_manpower` (
`sales_serv_manpower_id` int(11) NOT NULL,
  `sales_serv_head_id` int(11) NOT NULL DEFAULT '0',
  `manpower_id` int(11) NOT NULL DEFAULT '0',
  `days` int(11) NOT NULL DEFAULT '0',
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `overtime` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_cost` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_serv_material`
--

CREATE TABLE IF NOT EXISTS `sales_serv_material` (
`sales_serv_mat_id` int(11) NOT NULL,
  `sales_serv_head_id` int(11) NOT NULL,
  `item_description` varchar(250) NOT NULL DEFAULT '0',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `uom` varchar(30) DEFAULT NULL,
  `unit_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_cost` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `serial_numbers`
--

CREATE TABLE IF NOT EXISTS `serial_numbers` (
`serial_id` int(11) NOT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `rd_id` int(11) NOT NULL DEFAULT '0',
  `in_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serial_numbers`
--

INSERT INTO `serial_numbers` (`serial_id`, `serial_no`, `rd_id`, `in_id`) VALUES
(1, 'series1001', 1, 1),
(2, 'series2', 1, 1),
(3, 'series3', 1, 1),
(4, 'series4', 1, 1),
(5, 'series5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_company`
--

CREATE TABLE IF NOT EXISTS `shipping_company` (
`ship_comp_id` int(11) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
`supplier_id` int(11) NOT NULL,
  `supplier_code` varchar(100) DEFAULT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `terms` varchar(100) DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=380 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_code`, `supplier_name`, `address`, `contact_number`, `terms`, `active`) VALUES
(1, 'sup_1001', '2GO Express', 'BREDCO, Port 2, Reclamation Area, Brgy. 10, Bacolod City', '(034) 704-1339', '', 1),
(2, 'sup_1002', '7RJ Brothers Sand & Gravel & Gen. Mdse.', 'Circumferential Road, Brgy. Villamonte, Bacolod City', '(034)458-0190/213-2249', 'COD-Actual Quantity (delivered to site)', 1),
(3, 'sup_1003', 'A.C. Parts Merchandising', 'Gonzaga Street - Tifanny Bldg, Brgy. 24, Bacolod City', '(034) 433-2512', '', 1),
(4, 'sup_1004', 'A-1 Gas Corporation', 'Alijis, Bacolod City', '434-0708; 433-3637; 433-3638; 432-2079', 'COD', 1),
(5, 'sup_1005', 'AA Electrical Supply', 'C & L Bldg., Lacson-Luzuriaga St., BC', '435-3811; 432-3712; 708-1212', 'COD', 1),
(6, 'sup_1006', 'Ablao Enterprises', 'Bago City', '461-0376', 'COD ', 1),
(7, 'sup_1007', 'Abomar Equipment Sales Corporation', 'Lacson Ext., Cor. Goldenfield Sts. Liroville Subd, Singcang, Bacolod City', '433-1687; 432-3673', '', 1),
(8, 'sup_1008', 'Ace Hardware Philippines, Inc. - Bacolod Branch', 'G/F Sm City Bacolod Bldg. A, Poblacion Reclamation Area, Bacolod City', '(034) 468 0135', 'COD', 1),
(9, 'sup_1009', 'Ace Rubber Manufacturing and Marketing Corp.', 'Galo Street, Bacolod City', '(034)433-2145', 'COD', 1),
(10, 'sup_1010', 'Agro Star Industrial Trading Corp', 'Lacson-Luzuriaga, Bacolod City', '441-3624', '', 1),
(11, 'sup_1011', 'AIC Marketing', 'Lopez Jaena St., Shopping, Bacolod City', '433-8921', 'COD', 1),
(12, 'sup_1012', 'Almark Chemical Corporation', 'Alijis Road, Bacolod City', '433-2864/432-3778', 'COD', 1),
(13, 'sup_1013', 'AMT Computer Solutions', 'Door #5, Prudentialife Building, Luzuriaga St, Bacolod City', '435-1207; 213-3607', '7 days', 1),
(14, 'sup_1014', 'Andreas Hollow Blocks Enterprises', 'Brgy. Bata, Bacolod City', '(034) 476-1207', '30 days', 1),
(15, 'sup_1015', 'Ang Bata Hardware', 'Carlos Hilado Highway, Bata, Bacolod City', '(034) 441-3141', '', 1),
(16, 'sup_1016', 'Ang Design Studios , Inc.', 'Hilado Street, Barangay 17, Bacolod City', '(034) 435 0463', 'COD', 1),
(17, 'sup_1017', 'Anilthone Motor Parts & General Merchandise', 'Lacson Street - Bacolod North Terminal, Banago, Bacolod City', '(034) 434-7539', '', 1),
(18, 'sup_1018', 'A-one Industrial Hardware', 'Lopez Jaena St., Libertad, Bacolod', '435-7383; 432-0652; 476-1127', '', 1),
(19, 'sup_1019', 'Ap Cargo Logistics Network Corporation', 'Door 2, SYC Building, Lacson Street, Bacolod City', '(034) 432 3981', 'COD', 1),
(20, 'sup_1020', 'Apollo Machine Shop', 'Lacson, Bacolod', '434-9512', '', 1),
(21, 'sup_1021', 'Arising Builders Hardware and Construction Supply', 'Door #5 Dona Angela Bldg., Gonzaga St., Bacolod City', '435-4302', 'COD', 1),
(22, 'sup_1022', 'Arvin International Marketing Inc.', 'Bredco Port 4, Bacolod City', '434-7941', 'COD-Cash', 1),
(23, 'sup_1023', 'Asco Auto Supply', 'Gonzaga Street - Tiffany Building, Barangay 24, Bacolod City', '(034) 433-8963', 'COD', 1),
(24, 'sup_1024', 'Assistco Energy & Industrial Corp', 'First Ave., Bagumbayan, Taguig, Metro Manila/ Park Lane Bldg, Tindalo-Hilado Sts., Shopping, Bacolod City', '435-1605', '', 1),
(25, 'sup_1025', 'Atlantic Auto Parts', 'Gonzaga Street, Barangay 24, Bacolod City', '(034) 435-0136', 'COD', 1),
(26, 'sup_1026', 'Atlas Industrial Hardware Inc', '56 Lacson St, Bacolod City', '433-8170; 476-4708; 476-8161', 'COD', 1),
(27, 'sup_1027', 'Atom Chemical Company, Inc.', 'Mansilingan, Bacolod City', '(034)707-0826', 'COD', 1),
(28, 'sup_1028', 'Automation and Security Inc.', 'G/F Cineplex Building, Araneta St., Bacolod City', '(034) 704-1842 / 0977-732-5013', 'COD', 1),
(29, 'sup_1029', 'Ava Construction Supply', 'Cor. Yakal-Lopez Jaena Sts., Capitol Shopping Center, Bacolod City', '434-1822; 433-0263; 435-1901; 708-3757', 'COD', 1),
(30, 'sup_1030', 'B. Benedicto and Sons. Inc.', '99-101 Plaridel St. Cebu City', '(032) 254-4624(032) 255-0941/256-2218', 'COD', 1),
(31, 'sup_1031', 'B. A. Oriental Tire Supply', 'Liroville Subdivision - D Cruz Drive, Taculing, Bacolod City', '(34)433 0780', 'COD', 1),
(32, 'sup_1032', 'Bacolod Canvas And Upholstery Supply', 'Gonzaga St, Bacolod City', '(034) 434-3188', 'COD', 1),
(33, 'sup_1033', 'Bacolod Chemical Supply', 'Lopez Jaena, Bacolod City, Negros Occidental', '(34)433-3141', 'COD', 1),
(34, 'sup_1034', 'Bacolod China Mart', '70 Lacson St., Bacolod City', '434-7293/434-7670', '', 1),
(35, 'sup_1035', 'Bacolod Erd Enterprises', 'Rizal Street - Corner Lacson Street, Barangay 22, Bacolod City', '(034) 434-2272', '', 1),
(36, 'sup_1036', 'Bacolod General Parts Marketing', 'Lacson - Gonzaga Street, Barangay 24, Bacolod City', '(034) 433-1174', '', 1),
(37, 'sup_1037', 'Bacolod Global Parts Sales', 'Gonzaga Street - Jacman Building, Barangay 24, Bacolod City', '(034) 433-2091', '', 1),
(38, 'sup_1038', 'KLS Electrical Supply', 'Locsin-Gonzaga Sts. , Bacolod City', '433-3807', '', 1),
(39, 'sup_1039', 'Bacolod Integral Trading', 'Luzuriaga St., Bacolod City', '433-8170', 'COD', 1),
(40, 'sup_1040', 'Bacolod Kingston Hardware', 'Gonzaga, Bacolod City', '435-4734-36', '', 1),
(41, 'sup_1041', 'Bacolod Marjessie Trading', 'Cuadra Street, Barangay 21, Bacolod City', '(034) 456-2519', '', 1),
(42, 'sup_1042', 'Bacolod Marton Industrial Hardware Corp', 'Bonifacio St., Bacolod City', '434-2236-37; 435-0637', '', 1),
(43, 'sup_1043', 'Bacolod Mindanao Lumber and Plywood', 'BLMPC Bldg., Lopez Jaena-Malaspina Sts., Bacolod', '433-3610-12', '', 1),
(44, 'sup_1044', 'Bacolod National Trading', 'Luzuriaga St., Bacolod City', '433-2959', 'COD', 1),
(45, 'sup_1045', 'Bacolod Office Solutions Unlimited, Inc.', 'Lacson Street, Bacolod City', '433-9636', 'COD', 1),
(46, 'sup_1046', 'Bacolod Oxygen Acetylene Gas Corp.', 'Brgy. Alijis, Bacolod City', '434-1780', 'COD', 1),
(47, 'sup_1047', 'Bacolod Paint Marketing', 'Luzuriaga St., Bacolod City', '(034) 433-2063', 'COD', 1),
(48, 'sup_1048', 'Republic Hardware', 'Bonifacio St., Bacolod City', '434-8317; 434-5125; 433-9941', 'COD', 1),
(49, 'sup_1049', 'Bacolod Steel Center Corporation', '#22 LM Bldg., Gonzaga St., Bacolod City', '435-2721-25', 'COD', 1),
(50, 'sup_1050', 'Bacolod Sure Computer, Inc.', 'Capitol Shopping Center, Hilado St, Villamonte, Bacolod City', '(034) 435-1949', 'COD', 1),
(51, 'sup_1051', 'Bacolod Triumph Hardware', 'Narra Extension, Hervias Subd., Brgy. Villamonte, Bacolod City', '433-5551/55; 709-7777', '30 days PDC ', 1),
(52, 'sup_1052', 'Bacolod Truckers Parts Corporation', 'Gonzaga Street - Ralph Building, Barangay 24, Bacolod City', '(034) 433-3335', 'COD', 1),
(53, 'sup_1053', 'Bacolod Visayan Lumber', 'No. 2725 Lopez Jaena Bacolod', '433-8888', '', 1),
(54, 'sup_1054', 'Bangkal Movers Merchandising', 'Bangga Cory, Taculing, Bacolod City', '09164080028 / 0943-200-3145 / 0922-210-3206', 'COD', 1),
(55, 'sup_1055', 'BCG Computers', 'Lopez-Jaena St., Bacolod City', '(034) 434-2532/709-1888', 'COD', 1),
(56, 'sup_1056', 'Bearing Center & Machinery Inc.', 'Door #8 G/F GGG Bldg., Hilado Ext. Capitol Shopping Center, Bacolod City', '433-8370', 'COD', 1),
(57, 'sup_1057', 'Bens Machine Shop', 'Lopez Jaena St., Bacolod City', '433-8990', '', 1),
(58, 'sup_1058', 'Bright Summit Distribution Corporation', '2nd Flr. VCY Cntr. Bldg., Hilado Ext., Bacolod City', '(034) 433-7111', 'COD', 1),
(59, 'sup_1059', 'B-Seg Sand And Gravel', 'Prk. San Jose Circumferential Rd., Brgy. Alijis, Bacolod City', '(034) 457-1173 / 0929-6762-702', 'COD-Actual Quantity (delivered at site)', 1),
(60, 'sup_1060', 'C.Y. Ong Multi-Distributor', 'Door #4 Asian Realty Bldg., Lacson St., Bacolod City', '434-4360; 709-1159', 'COD', 1),
(61, 'sup_1061', 'Capitol Subdivision Inc.', 'Homesite Subd., Bacolod City', '433-9190', 'COD', 1),
(62, 'sup_1062', 'CAR-V Industrial Sales', 'No. 25 Valtram Bldg., Lacson-Gonzaga Sts., BC', '434-4661; 433-3835; 708-0210', 'COD', 1),
(63, 'sup_1063', 'Catcom Marketing', '5 Rosario Amapolo, Bacolod City', '(034) 434 8732', 'COD', 1),
(64, 'sup_1064', 'Cebu Bolt And Screw Sales', 'Door # 30-32 Gochan Bldg., Leon Kilat St., Cebu City', '(032) 412-3561', 'Advance Payment', 1),
(65, 'sup_1065', 'Central Gas Corporation (CEGASCO)', 'Km7 Natl South Rd., Brgy. Pahanocoy, Bacolod City', '444-1113/444-1109/444-1996/444-1348/444-1344 / 444-1348', 'COD', 1),
(66, 'sup_1066', 'Cezar Machine Shop', '92 Rizal Estanzuela St., Iloilo City', '(033) 337-1068', '', 1),
(67, 'sup_1067', 'Char Pete General Merchandise', 'Bago City', '473-0300', 'COD', 1),
(68, 'sup_1068', 'Cibba Paint Center, Inc.', 'CEJ Building, Lopez-Jaena StreetBacolod City', '(034) 433 9291', 'COD', 1),
(69, 'sup_1069', 'CLG Commercial Corporation', 'Narra Ext., Bacolod City', '433-5329/707-0474 / 0909-260-4184 / 0925-828-1156', 'COD', 1),
(70, 'sup_1070', 'ColorSteel System Corp.', 'EAC Building - Pacific Home Depot,Lacson - Mandalagan St.,Brgy. Banago, Sta. Clara Subd.,Bacolod City, Bacolod', '(034) 421 2267', 'COD', 1),
(71, 'sup_1071', 'CORDS Industrial Sales and Services', 'Dr. 1 SC Bldg. Libertad Ext., Mansilingan, Bacolod City', '446-2339', '', 1),
(72, 'sup_1072', 'Crismar Enterprises', 'Cuadra St.,  Brgy. 21, Bacolod City', '434-1210', 'COD', 1),
(73, 'sup_1073', 'Cro-Magnon Corporation', '45 Gochuico Bldg., Mabini Cor. Rosario St., Bacolod City', '433-3221; 434-1416', 'COD', 1),
(74, 'sup_1074', 'Crossworlds Trading and Engg Services', 'Door 3 Zerrudo Commercial Complex (former Lopez Arcade) E. Lopez St. Jaro, Iloilo', '', '', 1),
(75, 'sup_1075', 'CS Sales', 'LACSON STREET - CORNER LUZURIAGA STREET, BARANGAY 37, BACOLOD CITY', '(034) 434-5390', 'COD', 1),
(76, 'sup_1076', 'Daks Auto Supply', 'Lopues Mandalagan - Annex Building , Mandalagan, Bacolod City', '(0922)856 1591', 'COD', 1),
(77, 'sup_1077', 'DBO Auto Parts', 'Rizal Street - Door 5 Lizlop Building, Barangay 21, Bacolod City', '(034) 435-6304', 'COD', 1),
(78, 'sup_1078', 'Warlen Industrial Sales Corp. (Deka Sales)', ' Lot 20 Block 2, Lacson Extension, Alijis Road, Bacolod City', '(034) 435-1573', 'COD', 1),
(79, 'sup_1079', 'Philippine DFC Cargo Forwarding Corp.', 'LGV Building, Molave Street, Capitol Shopping Center, Bacolod City', '(034) 709-1128', 'COD', 1),
(80, 'sup_1080', 'Direct Electrix Equipment Corporation', '#28 Ramylu Drive, Tangub, Bacolod City', '(034) 444-2023 / (032) 948-0221 / (032) 942-2871 / 0916-600-3244 / 0922-853-5384', 'COD', 1),
(81, 'sup_1081', 'DMC Industrial Supplies', 'Mabini St., Bacolod City', '(034) 441-3621 / 0943-283-1688', 'COD', 1),
(82, 'sup_1082', 'DY Home Builders, Inc.', 'No. 2725 Lopez Jaena Bacolod', '433-2222', '', 1),
(83, 'sup_1083', 'Dynasty Management & Devt Corporation', 'Araneta St., Brgy. Singcang, Bacolod City', '', '', 1),
(84, 'sup_1084', 'Dynasty Paint Center', 'Lopez-Jaena Taal Sts., Bacolod city', '(034) 435-4777', 'COD', 1),
(85, 'sup_1085', 'Dypo Auto Parts', 'Lacson Street - Door 2 Jr Building, Barangay 21, Bacolod City', '(034) 707-7055', 'COD', 1),
(86, 'sup_1086', 'Ebara Benguet, Inc', 'Door 3 Eusebio Arcade, Lacson St., Brgy 40, Bacolod City', '435-8162', 'COD', 1),
(87, 'sup_1087', 'Eduard Metal Industries', '23rd St, Bacolod City', '432-0490', '', 1),
(88, 'sup_1088', 'Enigma Technologies Inc.', '2F Terra Dolce Center, Hilado Ext., Bacolod City', '(034) 435 8144', 'COD', 1),
(89, 'sup_1089', 'Far Eastern Hardware & Furniture Enterprises, Inc.', '38 Quezon St. Iloilo City', '(033) 335-0891 ; 337-2654 ; 337-2222 ; 337-5321 ; 508-4196', '', 1),
(90, 'sup_1090', 'Federal Johnson Engineering Works', 'Circumferential Rd, Bacolod City', '441-2110; 441-0306', 'COD', 1),
(91, 'sup_1091', 'FGV Enterprises', 'Luzuriaga Street - Door 1 Lucias Building, Barangay 25, Bacolod City', '(034) 433-2672', 'COD', 1),
(92, 'sup_1092', 'Fil-Power Group and Marketing Corp', 'St Anthony Bldg Lopez Jaena St, Bacolod City', '434-7957; 707-8035', 'COD', 1),
(93, 'sup_1093', 'Firbon Multi Sales', 'Cuadra Street - Door 3 Rgr Building, Barangay 21, Bacolod City', '(0920)479 5919', 'COD', 1),
(94, 'sup_1094', 'Francis New Tractor Parts', 'Lacson - Cuadra Street, Barangay 24, Bacolod City', '(034) 433-1456', '', 1),
(95, 'sup_1095', 'Fuman Industries Inc.', 'Brgy. Banago, Bacolod City', '435-0973', '', 1),
(96, 'sup_1096', 'Gini GTB Industrial Network Inc./AsiaPhil', 'Room 209, 2nd Floor Boston Finance and Investment Corp Bldg., Bacolod City', '(034) 435-6269 / 0998-844-3078', 'COD', 1),
(97, 'sup_1097', 'GLE Sand and Gravel Enterprises', 'GSIS Corner Medel Road Tangub Highway, Bacolod City', '444-1644', 'COD', 1),
(98, 'sup_1098', 'Golden Gate Hardware', 'Gonzaga-Lacson Sts., Bacolod City', '433-0995/434-6848', '7 days', 1),
(99, 'sup_1099', 'Golden Jal Marketing', 'Cokins Bldg, Bacolod City', '433-0698; 435-0061', '', 1),
(100, 'sup_1100', 'Golden Tower Commercial', 'Dr. 3, Emerald Bldg., Lacson St., Bacolod City', '476-8043 fax', '', 1),
(101, 'sup_1101', 'Good Hope Enterprises', 'Bonifacio St., Bacolod City', '434-8588-89', 'COD', 1),
(102, 'sup_1102', 'Greenlane Hardware and Construction Supply Inc', 'Lacson St., Bacolod City', '432-1119', '', 1),
(103, 'sup_1103', 'Highway Tire Supply', 'Lacson Street, Barangay 38, Bacolod City', '(034) 433-1257', 'COD', 1),
(104, 'sup_1104', 'HRA Paint Center', 'Dr # JQ Center Bldg., Lopez Jaena St., Bacolod City', '(034) 435-6684', 'COD', 1),
(105, 'sup_1105', 'Ideal System Komponents', 'Room 4B/4F Villa Angela Metro Plaza Bldg., Araneta St. BC', '433-4224', '', 1),
(106, 'sup_1106', 'IEC Computers', '(034) 433 9472/708-4322', '', 'COD', 1),
(107, 'sup_1107', 'Iloilo City Hardware, Inc.', '105-107 Iznart St., Iloilo City', '(033) 337-2952; 337-2969 ; 338-1455; 337-5553', '', 1),
(108, 'sup_1108', 'Iloilo National Hardware', '', '(033) 337-0449; 509-8985 ; 337-2841 ; 509-7785', '', 1),
(109, 'sup_1109', 'Innovative Controls Incorporated', 'Rm. 1-10 JDI Bldg., Galo St., Bacolod City', '(034) 708-1727 / 0908-8162189', 'COD', 1),
(110, 'sup_1110', 'Inovadis, Inc.', 'Rizal St, Brgy 22, Bacolod City', '435-4634-35', '', 1),
(111, 'sup_1111', 'Integrated Power and Control Provider, Inc.', 'Unit #5 East Plaza Commercial Bldg, Suntal Phase II, Circumferential Rd., Brgy Taculing, BC', '446-7612', '15 days PDC', 1),
(112, 'sup_1112', 'Intrax Industrial Sales/ U2 Machine Shop', 'Lot 1 Blk 4 Along Murcia Rd, Hermelinda Homes, Mansilingan, BC', '446-3268', '', 1),
(113, 'sup_1113', 'ISO Industrial Sales', 'Luzuriaga St., Bacolod City', '432-3007', '', 1),
(114, 'sup_1114', 'J. T. Oil Philippines', 'Bacolod City', '(034) 435-2666', 'COD', 1),
(115, 'sup_1115', 'Jast Marketing Co.', '#6 GGG Bldg., Capitol Shopping, Bacolod City', '434-0043', '30 days', 1),
(116, 'sup_1116', 'Johnson Parts Center & General Merchandise', '6th Street Lacson - Gensoli Building, Barangay 24, Bacolod City', '(034) 433-5708', '', 1),
(117, 'sup_1117', 'Jojo 4 Wheel Parts Supply', 'Gonzaga Street - Door 1 Suntal Invst Building, Barangay 24, Bacolod City', '(034) 435-0626', '', 1),
(118, 'sup_1118', 'KARL-GELSON INDUSTRIAL SALES', 'Araneta St., Bacolod City', '432-6318', 'COD', 1),
(119, 'sup_1119', 'Kemras Industrial Supply', 'Blk. 5, Lot 11 NHA ACCO Housing, Circumferential Road, Brgy. Alijis, Bacolod City', '(034) 446-3162 / 0906-1464-064 / 0936-927-9953', '30 days', 1),
(120, 'sup_1120', 'KLP Easy Electrical', 'Libertad extension, 6100 Bacolod City, Negros Occidental, Philippines', '', '', 1),
(121, 'sup_1121', 'Kuntel Construction', 'Rooms 3-6, 2nd Floor, Villa Angela Arcade, Burgos Extension, Bacolod City', '434-7866', 'COD', 1),
(122, 'sup_1122', 'Leeleng Commercial, Inc.', 'Bacolod City', '446-1084', '', 1),
(123, 'sup_1123', 'Liberty First Enterprises', 'T. Gensoli Bldg., Lacson St., Bacolod City', '435-1530; 435-0533', '', 1),
(124, 'sup_1124', 'Linde Corporation', 'Bago City', '213-4596/213-4594', 'COD', 1),
(125, 'sup_1125', 'Linton Incorporated', 'For Additional Lightning in Powerhouse DG Area', '(02) 733-8800 ; 733-8810 ; 734-1059 ; 733-8817', '', 1),
(126, 'sup_1126', 'LMS Electrical Supply', 'Gonzaga Street, Bacolod City', '435-0424/434 8423', 'COD', 1),
(127, 'sup_1127', 'Loc-Seal Industrial Corporation', 'Rm. 209 2F, DB Bldg., Cor. Gonzaga-Locsin Sts., Bacolod City', '709-9519', 'COD', 1),
(128, 'sup_1128', 'Luis Paint Center', 'Gonzaga, Bacolod City', '435-0301', 'COD', 1),
(129, 'sup_1129', 'Luvimar Enterprises', 'Rizal Street corner Gatuslao Street (beside LLC), Bacolod City', '(034) 476-3612', 'COD', 1),
(130, 'sup_1130', 'Lyfline Marketing', 'Galo Hilado, Bacolod City', '(034) 434 6543/(34)434-2582', 'COD', 1),
(131, 'sup_1131', 'Macjils Refrigeration And Airconditioning Repair Shop', 'Prk. Sto. Rosario, lacson St., Bacolod City', '(034) 707-0639 / 0919-637-0637', 'COD', 1),
(132, 'sup_1132', 'MB United Commercial', 'Yakal St., Villamonte, Bacolod City', '435-3131; 434-7283; 709-1053', 'COD', 1),
(133, 'sup_1133', 'Metro Pacific Construction Supply, Inc.', 'No. 47 Mabini Street, Iloilo City', '(033) 338-1316 ; 337-1210 ; 337-3762; 337-0815', '', 1),
(134, 'sup_1134', 'MF Computer Solution', '434-6544', '0917-301-7762; 0999-994-6579', '', 1),
(135, 'sup_1135', 'MGNR Hardware & Construction Supply', '2780 Hilado Ext., Brgy Villamonte, Bacolod City', '435-3790', '', 1),
(136, 'sup_1136', 'Micro Valley', 'Reclamation Area, Bacolod City', '(034) 704-4317', 'COD-Cash', 1),
(137, 'sup_1137', 'MILCO MALCOLM MARKETING', 'MABINI STREET - SAN SEBASTIAN STREET, BARANGAY 32, BACOLOD CITY', '(034) 433-3429', '', 1),
(138, 'sup_1138', 'Milco Malcolm Mktg', 'M & M Aceron Bldg II, Mabini-San Sebastian Sts., BC', '433-3429; 434-2918; 434-3986', 'COD', 1),
(139, 'sup_1139', 'Mirola Hardware', 'Poblacion Sur, Ivisan, Capiz', '(036) 632-0104; 632-0028 ; 632-0108', '', 1),
(140, 'sup_1140', 'Negros Bolts & General Mdse', '2879 Burgos Ext., BS Aquino Drive, Bacolod City', '435-2260; 708-1183', '', 1),
(141, 'sup_1141', 'Negros International Auto Parts', 'Rizal Street - Corner Lacson Street - Sgo Building, Barangay 21, Bacolod City', '(034) 435-1416', '', 1),
(142, 'sup_1142', 'Negros Marketing', 'Cuadra St., Bacolod City', '(034) 435-4708', 'COD', 1),
(143, 'sup_1143', 'Negros Metal Corporation', 'Brgy. Alijis, Bacolod City', '(034) 433-7398', 'COD', 1),
(144, 'sup_1144', 'Negros Pioneer Enterprises', 'Gonzaga - Lacson Street, Barangay 24, Bacolod City', '(034) 433-2088', 'COD', 1),
(145, 'sup_1145', 'Netmax Solutions', 'Silay City', '(034) 213-6120 / 0949-883-2535/0923-141-2611', 'COD', 1),
(146, 'sup_1146', 'New Colomatic Motor Parts', 'Gonzaga Street - Lm Building, Barangay 25, Bacolod City', '(034) 434-5955', '', 1),
(147, 'sup_1147', 'New Yutek Hardware and Industrial Supply Corporation', 'Zulueta St., Cebu City, Cebu', '(032) 255-5406', 'COD', 1),
(148, 'sup_1148', 'Newbridge Electrical Enterprises', 'Lacson Ext., Cor LT Vista St. Singcang, Bacolod City', '433-9298; 433-2365; 434- 2185', 'COD', 1),
(149, 'sup_1149', 'Nikko Industrial Parts Center', 'Lacson Street - Door 3 Tmg Building , Barangay 25, Bacolod City', '(034) 708-0210/(034) 433-7908/(034) 433-3835', 'COD', 1),
(150, 'sup_1150', 'Nippon Engineering Works', 'Corner-Mabini Ledesma Sts., Iloilo City', '(033) 338-1122', '', 1),
(151, 'sup_1151', 'Northern Iloilo Lumber & Hardware', '24 Ledesma, Iloilo City', '(033) 337-4749', '', 1),
(152, 'sup_1152', 'NS Java Industrial Supply', 'Room 1-11 JDI Bldg, Galo St., Bacolod City', '433-0668', '', 1),
(153, 'sup_1153', 'Octagon Computer Superstore', 'SM City Bacolod, Rizal St., Reclamation Area, Bacolod City', '(034) 468-0205', 'COD', 1),
(154, 'sup_1154', 'Panay Negros Steel Corporation', 'Door 2, Torres Bldg, No. 61 Burgos, Bacolod City', '434-8272', '', 1),
(155, 'sup_1155', 'Philippine DFC Cargo Forwarding Corp.', 'Siment Warehouse, Zuellig Ave., Reclemation Area, Mandaue City', '0917-629-3024', 'Freight Collect', 1),
(156, 'sup_1156', 'Pins Auto Supply', 'Gonzaga Street - Purok Masinadyahon, Barangay 24, Bacolod City', '(034) 434-9349', '', 1),
(157, 'sup_1157', 'Platinum Construction Supply', 'Bugnay Road, Villamonte, Bacolod City', '(034) 433-1886', '', 1),
(158, 'sup_1158', 'Power Steel Specialist', '1714 Ma. Clara St., Sampaloc, Manila', '(02) 731-0000', '', 1),
(159, 'sup_1159', 'Power Systems, Inc', 'AU & Sons Bldg., Sto. Nino, Bacolod City', '433-4293', '', 1),
(160, 'sup_1160', 'Prism Import-Export, Inc.', 'C.L. Montelibano Avenue, Bacolod City', '(034) 433-6045/708-4443/433-5327', '15 days', 1),
(161, 'sup_1161', 'Procolors T-Shirts Printing', 'Lacson St., Bacolod City', '(034) 434 3403', 'COD', 1),
(162, 'sup_1162', 'Ravson Enterprises', 'Atrium Bldg., Gonzaga St., Bacolod City', '434-8929', 'COD', 1),
(163, 'sup_1163', 'Rc Fishing Supply', 'Gonzaga St, Bacolod City', '(034) 434 8299', 'COD', 1),
(164, 'sup_1164', 'Richard and Zachary Woodcraft', 'Victorina Heights, Libertad Ext., Brgy. Mansilingan', '431-5866/213-3858/0928-337-7568, 0927-325-4497, 0922-562-1005', 'COD', 1),
(165, 'sup_1165', 'RTH Marketing', 'Door 1, St. Francis Bldg., Lizares Ave.,Bacolod City', '433-1199; 433-8152', '', 1),
(166, 'sup_1166', 'Sam Parts Marketing', 'Cuadra Street, Barangay 24, Bacolod City', '(034) 434-6119', '', 1),
(167, 'sup_1167', 'SGS Hardware Corporation', 'Gatuslao Bacolod City', '435-3023-25', 'COD', 1),
(168, 'sup_1168', 'Sian Marketing', 'Luzuriaga-Lacson Sts., Bacolod City', '431-1375', '', 1),
(169, 'sup_1169', 'Sian Marketing', 'Luzuriaga-Lacson Sts., Bacolod City', '431-1375', '', 1),
(170, 'sup_1170', 'Silicon Valley', 'SM Bacolod City', '(034) 431-3251', 'COD', 1),
(171, 'sup_1171', 'Silver Horizon Trading Co. Inc.', 'Julio Las PiÃƒÂ±as St., Brgy. Villamonte, Bacolod City', '476-2590/09284495903/09296291246', 'COD', 1),
(172, 'sup_1172', 'Simplex Industrial Corp.', 'Tiffany bldg., Door 8, Gonzaga St., Bacolod City', '(0932)878-8882, (0925)868-8882', 'COD', 1),
(173, 'sup_1173', 'SKT Saturn Network, Inc.', 'SKT Compound, Rizal St., Bacolod City', '433-2494', '', 1),
(174, 'sup_1174', 'Sol Glass And Grills', 'Rosario Heights, Libertad Ext., Brgy. Taculing, Bacolod City', '(034) 213-3935 / 0917-5039-183', 'COD', 1),
(175, 'sup_1175', 'Specialized Bolt Center and Industrial Supply Inc.', '11 V. Sotto, Cebu City, Cebu', '(032) 2531345 / 253-1535', 'COD', 1),
(176, 'sup_1176', 'State Motor Parts Company', 'Gonzaga Street, Barangay 24, Bacolod City', '(034) 433-1683', '', 1),
(177, 'sup_1177', 'Sugarland Hardware Corp.', 'Lacson St., Bacolod City', '434-5390; 434-4549; 708-8850', 'COD', 1),
(178, 'sup_1178', 'Sunrise Marketing', 'Bldg./Street: Hilado Extension\r\nMunicipality: Bacolod City ', '434-5746', 'COD', 1),
(179, 'sup_1179', 'Svtec Industrial Enterprises', 'Gonzaga-Lacson St., Bacolod City', '(034) 707-7496', 'COD', 1),
(180, 'sup_1180', 'Technomart', '(034) 431-5994', '9322065585', 'COD', 1),
(181, 'sup_1181', 'Teranova Computers', '709 - 7737', '0999-817-4815 / 0942-009-1433', 'COD', 1),
(182, 'sup_1182', 'Tingson Builders Mart', '3 Gonzaga, Bacolod City', '434-1046; 707-5507', '', 1),
(183, 'sup_1183', 'Alpha Titan Hardware', '888 Chinatown Square, Gatuslao St.', '435-7496; 476-4106', '', 1),
(184, 'sup_1184', 'TMVG Multi-Sales, Inc.', 'Dr. 2, Genito Bldg., Lopez Jaena St., Bacolod City', '(034) 708-1819 / 434-7471 / 435-6003 / 476-4355 / 435-0905', 'COD', 1),
(185, 'sup_1185', 'Tokoname Enterprises', 'Hernaez St., Bacolod City', '433-3610/707-1844', 'COD/7 days', 1),
(186, 'sup_1186', 'Tri-con Marketing Center Inc.', 'Capitol Shopping Ctr, Bacolod City', '435-0889', '', 1),
(187, 'sup_1187', 'Triumph Machinery Corporation', 'Bacolod City', '441-0298', '', 1),
(188, 'sup_1188', 'U.S. Commercial', 'Gatuslao Street - Purok Bagong Silang, Barangay 13, Bacolod City', '(034) 433-1174', '', 1),
(189, 'sup_1189', 'Unikel Industrial Supplies and Safety Equipments', 'Door 2 G/F Malayan Bldg, 3rd St Lacson, Bacolod City', '476-3191; 435-8677', '', 1),
(190, 'sup_1190', 'Union Galvasteel Corp', 'Soliman Bldg, Bacolod', '435-7175', '', 1),
(191, 'sup_1191', 'United Bearing Industrial Corp', 'AP Bldg Lacson St, Bacolod City', '435-4541; 435-4497', '', 1),
(192, 'sup_1192', 'United Steel Technology International Corp.', 'Door 2, Goldbest Warehouse, Guzman St., Hibao-an, Mandurriao, Iloilo City', '(033) 333-7663', '', 1),
(193, 'sup_1193', 'US Commercial Inc (Uy Sian Commercial)', 'Gov V M Gatuslao, Bacolod City', '434-8989; 433-8017', '', 1),
(194, 'sup_1194', 'VCY Sales Corporation', 'Kamagong St., Brgy. Villamonte, Bacolod City', '433-7112/709-7778', 'COD', 1),
(195, 'sup_1195', 'Vendor 1', 'Vendor 1 address', '1111', '', 1),
(196, 'sup_1196', 'Visayan Construction Supply', 'Lacson St., Bacolod City', '434-7277 / 434-7278', 'COD', 1),
(197, 'sup_1197', 'Vosco Trading ', 'Cuadra St., Bacolod City', '(034) 435-8515', 'COD', 1),
(198, 'sup_1198', 'Wellmix Aggregates Inc', 'Ralph Townhouse, Bacolod City', '(034) 434-4704', '', 1),
(199, 'sup_1199', 'Western Hardware', 'EH Bldg., Lacson-San Sebastian Sts., Bacolod City', '434-5305-06', '', 1),
(200, 'sup_1200', 'Westlake Furnishings Inc.', 'Araneta St.,  Bacolod City', '(034) 433-9489/433-9498', 'COD', 1),
(201, 'sup_1201', 'Yousave Electrical Supply', 'Door #s 1-2 Sunstar Bldg., Hilado Ext., Bacolod City', '709-0594', '30 days PDC/COD', 1),
(202, 'sup_1202', 'Alta-Weld, Inc. / Alta (Far East) Welding Materials, Inc.', 'Sun Valley Drive KM. 15 West Service Road, South Superhighway, ParaÃƒÂ±aque City', '(02) 823-4032 / 824-2966 / 824-2988 / 0917-636-1187 / 0922-625-6397', 'COD', 1),
(203, 'sup_1203', 'Chokie Heavy Equipment Parts Center', 'AGPA Bldg. Lacson St., Bacolod City', '(034) 431-5303 / 0925-866-2081 / 0942-072-6467', 'COD', 1),
(204, 'sup_1204', 'Hydrauking Industrial Corp.', 'Door # 4 Ching Store, Zone 2 Tablon, Cagayan De Oro', '0928-828-2878 / 0905-228-4345', 'COD', 1),
(205, 'sup_1205', 'Ionic Impact One Nation Industrial Corporation', '6-D Pearl St., Golden Acres Subd. Las PiÃƒÂ±as City', '(02) 800-9104 / 806-2048 / 805-2959 / 0977-824-5812', 'COD', 1),
(206, 'sup_1206', 'Cebu Champion Hardware and Electric Depot, Inc.', 'Pres. Quirino St, Cebu City, Cebu', '(032) 234 4342 / 231-7139 / 0917-632-6505', 'Advance Payment(Bank to Bank)', 1),
(207, 'sup_1207', 'FH Commercial Inc.', 'FH Building, #22 Anonas Rd., Potrero, Malabon City, 1475', '(02) 362-2265 / 330-2019 / 330-2021 / 366-8598 / 361-4235 / 364-3352 / 0918-922-0974', 'COD', 1),
(208, 'sup_1208', 'A & M Medcare Products Distributors', ' Door 4 & 5, Estban Building, 5 Lacson St, Barangay 17, Bacolod City', '(034) 433 5728', 'COD', 1),
(209, 'sup_1209', 'Archi Glass & Aluminum Supply', 'P Hernaez St Ext, Bacolod City', '(034) 433 7116', '50% Downpayment, 50% upon completion', 1),
(210, 'sup_1210', 'Bacolod Electrical Supply', 'Gonzaga Corner Lacson St., Bacolod City', '(034) 434-0526', 'COD', 1),
(211, 'sup_1211', 'Morse Hydraulics System Corp.', 'DMC Bldg., Narra Ext. Bacolod City', '(034) 433-1538 / 0917-633-9634', 'COD', 1),
(212, 'sup_1212', 'JHM Industrial Supplies', 'Gov. Rafael Lacson St., Zone 12 Talisay City, Negros Occidental', '0949-846-7820 / 0923-568-3661', 'COD', 1),
(213, 'sup_1213', 'Negros GT Group', '159-161 Lacson St., Bacolod City', '(034) 434-6154', 'COD', 1),
(214, 'sup_1214', 'Powersteel Hardware', 'Coastal Road, Brgy. Banuyao, Lapaz, Iloilo City', '(033) 330-3792 | (033) 329-4484', 'Advance Payment (Bank to Bank)', 1),
(215, 'sup_1215', 'Propmech Corporation', 'J. king Warehouse, M. Sanchez St., Alang-alang, Mandaue City, Cebu', '(032) 344-0738', 'COD', 1),
(216, 'sup_1216', 'Assistco Energy & Industrial Corporation', 'Door # 2 Parklane Building, Cor. Rizal-Tindalo Sts., Shopping Center, Bacolod City', '(034) 435-1605', 'COD', 1),
(217, 'sup_1217', 'Joules Enterprise & Engineering Services', 'Jees bldg., Blk. 6 Lot 10 DoÃƒÂ±a Juana Cor. R. A. Canlas St., Springside, Pandan, Angeles City', '(045) 458-0848: 0918-940-7243: 0917-919-5258', 'COD', 1),
(218, 'sup_1218', 'Nexus Industrial Prime Solutions Corp.', 'Unit B, Roselindees Building, Galo-Hilado St., Bacolod City', '(034) 435-0560 / 0928-5079-9741', 'COD', 1),
(219, 'sup_1219', 'AGEC Engineering Supplies', 'American Packing Ind., Mandalagan, Bacolod City', '0947-776-8124 / 0916-300-8019', 'COD', 1),
(220, 'sup_1220', 'Sealand Industrial Supply', 'Plazamart, Araneta St., Bacolod City', '0932-9034-564', 'COD', 1),
(221, 'sup_1221', 'EFRC Industrial Services & Trading Corp.', '252 Dr. Jose Fabella St., Plainview, Mandaluyong City', '(02) 533-6673 / 0917-324-9530 / 0917-599-3366 / 0918-939-7962', 'COD', 1),
(222, 'sup_1222', 'New Interlock Sales & Services', 'Door # 3 NGS Bldg., M. J. Cuenco Avenue, Mabolo Cebu 6000', '(032) 2315-906 to 907; 412-8431; 412-8278 to 79', 'COD', 1),
(223, 'sup_1223', 'Fil Generators And Services Company', 'Door # 7, East Plaza Bldg., Circumferential Road, Brgy. Taculing, Bacolod City', '(034) 446-2674 / 0917-140-4763', 'COD', 1),
(224, 'sup_1224', 'Acster Marketing', '128 Araneta St., Singcang, Bacolod City', '(034) 458-4077 / 0927-291-2209', 'COD', 1),
(225, 'sup_1225', 'Mandaue Atlas Steel Fabrication Corp.', 'Plaridel St, Paknaan, Mandaue City, Cebu', '(032) 505-1806 / 316-2364', 'COD', 1),
(226, 'sup_1226', 'YKG Industrial Sales Corp.', '7-9 M. C. Briones St., Cebu City, 6000', '(032) 255-0870 to 73', 'COD', 1),
(227, 'sup_1227', 'Worldwide Steel Group, Inc.', 'Sacris Road Ext., Mandaue Cebu 6014', '(032) 346-0959; 345-0458: 344-0660', 'COD', 1),
(228, 'sup_1228', 'Tokyu Hardware & Industrial Supply', '1175-9 Highway 77, Talamban 6000 Cebu City', '(032) 345-1500 / 345-0498 / 416-0088', 'COD', 1),
(229, 'sup_1229', 'CJ KARR Industrial Sales And Services', 'Dr # 2, E & R Bldg, Hernaez Ext., Prk. Kabukiran, Taculing, Bacolod City', '(034) 709-0130 / 446-3843', 'COD', 1),
(230, 'sup_1230', 'Goldensteel Construction Supply', 'G/Floor, Casals Building, Pagsabungan Mandaue City', '(032) 405-3262 / 0998-5394-560 / 0942-356-6747 / 0910-613-2888', 'Advance Payment-Bank to Bank Transaction', 1),
(231, 'sup_1231', 'RJ Spring Rubber & Metal Parts Manufacturing Corp.', '#171National Road, Ortigas Ext., Brgy. Delapaz, Antipolo City, Rizal', '(02) 658-1951; 384-9315; 473-0433; 215-3069', 'COD', 1),
(232, 'sup_1232', 'Moldex Products Inc.', 'Moldex Building., Ligaya St., Cor. West Ave., Quezon City', '(032) 373-8888 / 373-4009 / 0917-863-9237', 'COD', 1),
(233, 'sup_1233', 'Gibrosen Fire Safety Products', 'Door # 2 Triple Es Siasat Bldg., Burgos Ext., 4th Road, Villamonte, B. C.', '(034) 434-2881', 'COD', 1),
(234, 'sup_1234', 'Phil-Nippon Kyoei Corp.', 'S705 Royal Plaza Twin Towers 648 Remedios St., Malate, Manila', '(02) 400-5778 / 328-3270', 'COD', 1),
(235, 'sup_1235', 'Able Machine Industries', '618 Ylac Ave., Villamonte, Bacolod City', '(034) 435-5960', '30 days PDC', 1),
(236, 'sup_1236', 'First Pilipinas Power and Automation, Inc.', 'Unit 1609 Cityland Tower 2 H. V. Dela Costa St., Salcedo Village, Makati City 1227 Philippines', '(02) 666-1843 / 892-1914 / 0922-881-4382/0927-311-5672', 'COD', 1),
(237, 'sup_1237', 'LP Solutions', '3/F Leeleng Bldg., 718 Shaw Blvd., Mandaluyong City, Phil, 1552 ', '(02) 723-7767 to 70 / 0999-855-3875', 'COD', 1),
(238, 'sup_1238', 'Starlube Corporation', 'Camia Street, Espinos Village 1, Circumferential Road, Bacolod City', '(034) 446-2420 / 446-2174', 'COD', 1),
(239, 'sup_1239', 'Berpa-Flex Technologies', 'St. Michael Subdivision, Alicante, E. B.Magalona, Negros Occidental', '0908-1092-386 / 0917-4631-769', 'COD', 1),
(240, 'sup_1240', 'Filtertech General Trading', 'N & N Bldg., Cortes Ave. Maguikay, Mandaue City', '(032) 505-8490 / 0922-2266-86 / 0920-2593-077', 'COD', 1),
(241, 'sup_1241', 'Compresstech Resources, Inc.', 'CRI Bldg., 665 Pres. E. Quirino Ave., Malate Manila', '(02) 567-4389 to 95 to 98 / 0922-8063885', 'COD', 1),
(242, 'sup_1242', 'Access Frontier Technologies, Inc.', 'Unit # 207 Grand Arcade Bldg., AC Cortez., Mandaue City 6014, Cebu, Philippines', '(032) 420-2429, 420-7818, 239-2629', 'COD', 1),
(243, 'sup_1243', 'Flex-a-Seal Industrial Supply', 'Blk. 2, Lot 29 Eufemia Compound Circumferential Rd., Taculing, Bacolod City', '(034) 458-3290 / 213-5221 / 0939-955-3716 / 0998-9896-690 / 0922-8051-480', 'COD', 1),
(244, 'sup_1244', 'AVK Philippines Inc.', '70 Wes Ave. West Triangle Quezon City', '(02) 376-6400 to 01 - 02-376-6399', 'COD', 1),
(245, 'sup_1245', 'Bernabe Construction & Industrial Corp.', 'Roosevelt Avenue, Quezon City', '(02) 292-3401 / (02) 292-1540 / (02) 293-7625', 'COD', 1),
(246, 'sup_1246', 'Gold Tools Enterprises', 'Unit 18, 46 D.Tuazon St., Corner E. Rodriguez Sr. Ave., Dona Josefa, Metro Manila, Quezon City', '415-6201 / 244-9577', '', 1),
(247, 'sup_1247', 'Sum-ag Petron Gas Station', '', '', '', 1),
(248, 'sup_1248', 'Marhil Spring', '', '', '', 1),
(249, 'sup_1249', '88 Electronics Supply', '', '', '', 1),
(250, 'sup_1250', 'DMs Oil Purifier Services and Supply', 'No. 11-A Esteban St. Mandaluyong City', '654-1521 / 0998-284-0757', '', 1),
(251, 'sup_1251', 'Alex Lumber Yard', '', '', '', 1),
(252, 'sup_1252', 'Nalco', '', '', '', 1),
(253, 'sup_1253', 'Jbee Department Store', '', '', '', 1),
(254, 'sup_1254', 'RS Components Corporation', '', '', '', 1),
(255, 'sup_1255', 'Llamado Enterprises', '', '', '', 1),
(256, 'sup_1256', 'K-Mart', '', '', '', 1),
(257, 'sup_1257', 'Enerpro Marketing Inc.', '', '', '', 1),
(258, 'sup_1258', 'Fluid Energy Philippines Inc.', 'Unit 1 & 2, Ground Floor AVJ Building No. 99 Fourth St. Corner C-3 Road, Caloocan City', '3195991 / 3517124 / 4422244 / 3656592 to 93', '', 1),
(259, 'sup_1259', 'A-One Industrial Sales', 'Door 4 & 5 ACFC  Bldg.,Lopez Jaena St, Bacolod City', '435-7383', '', 1),
(260, '', 'Precious V. Sanchez', '', '', '', 1),
(261, 'sup_1260', 'CTMJ Gases Supply', '99 Honey Bed Alijis, Bacolod City', '479 2455 / 707 0059', '', 1),
(262, 'sup_1261', 'Pos Gasul Negros Occidental INC.', 'Araneta St.,Brgy. Singcang, Bacolod City', '034 435- 1798 / 434- 0088 & 707- 3030', '', 1),
(263, 'sup_1262', 'Center for Reliability Excellence Laboratories Corporation', '718 Shaw Blvd, Mandaluyong, 1550 Metro Manila', '(02) 726 8244', '', 1),
(264, 'sup_1263', 'KJ Fairmart Inc.', 'Adela Bldg., Araneta St. Sum-ag, Bacolod City', '', '', 1),
(265, 'sup_1266', 'T5 Sum -ag Enterprises, Inc', 'San Luis Village, San Juan St., Sum-ag, Bacolod City', '034 444-0491', '', 1),
(266, 'sup_1264', 'Delixi Electric', '', '', '', 1),
(267, '', 'Donated by Sir RCT', '', '', '', 1),
(268, '', 'William Soltes', '', '', '', 1),
(269, 'sup_1265', 'CMC 417 Enterprises Corporation', 'Margarita St., Libertad, Brgy.40, Bacolod City', '704-8077 / 702-8402 / 09173008402', 'cash', 1),
(270, '', 'Warehouse', '', '', '', 1),
(271, 'sup_1267', 'Doods Sack Trading', 'Lopez Jaena-San Sevastian Sts., Bacolod City', '09075156093 / 09274228433', '', 1),
(272, 'sup_1268', 'Luzanta Native Products', 'Stall III-3 Bldg., North Public Market Brgy.19, Bacolod City', '', '', 1),
(273, 'sup_1269', 'I.E. Creative Computers', '062, SM City, Reclamation Area, Bacolod City', '433-9472 / 708IECC', '', 1),
(274, 'sup_1270', 'Pacific Ads Creative Outdoor', '', '', '', 1),
(275, 'sup_1271', 'Ametros Inc', '', '', '', 1),
(276, 'sup_1272', 'PC Gilmore Computer Center', '', '', '', 1),
(277, 'sup_1273', 'Montreiec Incorporated', '', '', '', 1),
(278, 'sup_1274', 'New China Mart', '70 Lacson St., Bacolod City', '034 434-7293 / 434-7670', '', 1),
(279, 'sup_1275', 'Zemarc Corporation', '', '', '', 1),
(280, 'sup_1276', 'New Kapitan Parts Center & Co., Inc.', 'EGA Towers, #36 Gonzaga, 25, Bacolod City, Neg. Occ', '434-1912 ; 432-3212 ; 432-1293 ; 709-1858', '', 1),
(281, 'sup_1277', 'National Book Store', '', '', '', 1),
(282, 'sup_1278', 'South Gas Petron', '', '', '', 1),
(283, 'sup_1279', '7-Eleven, LLARC Convenience Store', 'Araneta Ave. Cor Sum-ag-Abuanan Rd., Brgy. Sum-ag, Bacolod City', '', '', 1),
(284, 'sup_1280', 'Negros Grace Pharmacy', '', '', '', 1),
(285, 'sup_1281', 'F.G. Cycle Parts & Hardware', 'Araneta St., Bago City', '4610-148', '', 1),
(286, '', 'Borrowing', '', '', '', 1),
(287, 'sup_1282', 'Samson Merchandising, Inc.', '#90 Lacson St., Brgy.38, Bacolod City', '433-1208 / 435-1892', '', 1),
(288, 'sup_1283', 'Insuflex Industries, Inc.', '#9 Gregorio Del Pilar St., San Francisco Del Monte, Quezon City', '374-3953 / 372-1585 / 372-1613 / 415-3902', '', 1),
(289, 'sup_1284', 'All-Technik and Components, Incorporated', 'All-Technik bldg., Lot 11, Block 36, San Antonio Valley 1, Sucat, Parañaque City', '829-4849 to 50 / 825-2533 / 0923-7014027', '', 1),
(290, 'sup_1285', 'Speed Controls Enterprises', '2479 Decena st., San Roque, Brgy. 94, Pasay City', '09156273548 / 09296075797', '', 1),
(291, 'sup_1286', 'Vencio Auto Supply', 'Dr.#2 Ang Building, Brgy.25, Bacolod City', '435-8248 / 435-8870', '', 1),
(292, 'sup_1287', 'Platinum International Supply & Services, Inc.', 'Unit 217 & 218, Cityland Dela Rosa Condominium, 7648 Dela Rosa St., Brgy. Pio del Pilar, Makati City', '813-1380 / 813-1492 / 813-1384', '', 1),
(293, 'sup_1288', 'Prince Hypermart Bago', 'H. Yulo St., Brgy. Pob, Bago City', '', '', 1),
(294, 'sup_1289', 'MTG Gasoline Service Station', '', '', '', 1),
(295, 'sup_1290', 'Citi Hardware Bacolod', 'Bacolod city', '432-3493', '', 1),
(296, 'sup_1291', 'GC & C, Inc.', 'Carlos Hilado Highway, Ceircumfrrential Road, Bacolod City', '034 441-2409', '', 1),
(297, 'sup_1292', 'GC Appliance Centrum', 'Lacson St., Bacolod City', '434-6993', '', 1),
(298, 'sup_1294', 'Upshaw Industrial Corporation', 'Rm. 201, VAG Building, Ortigas Avenue, San Jaun City, Metro Manila', '721-5451', '', 1),
(299, 'sup_1295', 'Poweredge Solutions Phils., Inc', '', '', '', 1),
(300, 'sup_1296', 'Powerex, Inc', '173 Pavillion Lane Youngwood, PA 15697', '724-925-7272', '', 1),
(301, 'sup_1297', 'Stellite Commercial, Inc', '17 Calbayog St., Brgy. Highway Hills, Mandaluyong City', '531-4681', '', 1),
(302, 'sup_1298', 'Savemore Market', 'Bacolod City', '', '', 1),
(303, 'sup_1299', 'JPEL Construction Supply & Services', 'Crossing High school, Brgy. Lag-asan, Bago city', '0929-350-0395', '', 1),
(304, 'sup_1300', 'Heatwave Industrial Sales', 'No.488 HIS Bldg., P. Sevilla(Lakambini) St., Ave. Grace Park, Caloocan City', '02-244-5386 / 09175326737', '', 1),
(305, 'sup_1301', 'Noris Automation Far East Pte Ltd', 'nO.42. Toh Guan Road East #01-80, Entrepreneur Hub, Singapore, 608583', '65 6267 8536 Ext 111', '', 1),
(306, 'SUP_1302', 'Sum-ag Mansfort Merchandise', 'Araneta St., Sum-ag, Bacolod City', '444-2047', '', 1),
(307, 'sup_1303', 'Alpha Pacific Electric Co., Inc', 'Unit 113 Madison Manor, Condominium Complex, Manhattan, Bldg., Manila Doctors Villages Las Piñas City', '800-0870 / 805-3485', '', 1),
(308, 'sup_1304', 'Virgon Repair, Welding Shop and Lathe Works', 'Calumangan, Bago City', '0919-6566243 / 09298977281', '', 1),
(309, 'sup_1305', 'Portalloy Industrial Supply Corporation', '1011-1013 Oroquieta St., Sta.Cruz, Metro Manila', '734-8137 / 734-8141 / 734-7143', '', 1),
(310, 'sup_1306', 'Nationware Marketing Services, Inc', 'G/Flr NH08 Bldg.128 Porvinir St. Near Cor. F.B. Harrison St., Pasay City', '526-8701 loc 116 / 0942-4768727 / 0956-8851213', '', 1),
(311, 'sup_1307', 'Columbia Wire & Cable Corporation', '75 Howmart Road, Baesa, Barrio Kangkong, Quezon City', '340-5235 / 361-6151', '', 1),
(312, 'sup_1308', 'MAC Alpha Omega Industrial Sales Inc', '16 R. Baetiong Drive, Balintawak, Quezon City', '(02) 282-4920 / (02) 410-3450 / (02) 929-4607 / (02) 5460700 / 09171388899', '', 1),
(313, 'sup_1309', 'Marsteel Construction Supply', '#29 Aurora Blvd. Cor. S.Veloso St., San Juan City', '726-8818 / 723-1156', '', 1),
(314, 'sup_1310', 'CCM Hardware', 'Sum-ag, Bacolod City', '', '', 1),
(315, 'sup_1311', 'Bacolod Plastic Supply', '5 Hilado St., Bacolod City', '0340434-0067', '', 1),
(316, 'sup_1312', 'The Hunter Motor Co.', 'Gonzaga St., Bacolod City', '433-3673 / 433-3674', '', 1),
(317, 'sup_1313', 'Safegear Industrial Sales Ltd. Co.', '1686 SAn Lazaro St., Sta.Cruz, Manila', '(02) 523-7297 / (02) 311-6440 / (02) 493-5166', '', 1),
(318, 'sup_1314', 'Negros Megabright Corporation', 'C & L Bldg., Luzuriaga-Lacson St., Bacolod City', '(034) 435-0375 / (034) 435-0851', '', 1),
(319, 'sup_1315', 'Your Daily Mktg.', 'Hi-Way, Tangub, Bacolod City', '', '', 1),
(320, 'sup_1317', 'GPM Trading & Engineering Services', 'Lot 888H, National Highway, Alijis, Bacolod City', '(034) 435-0742 / 707-3814', '', 1),
(321, 'sup_1318', 'Crown Agri-Trading Corp.', 'D-47 Narra Ave., Capitol Shopping Center, Bacolod City', '434-5322 / 434-3050 / 434-8509', '', 1),
(322, 'sup_1319', 'Dalian Hivolt Power System Co., Ltd', '', '', '', 1),
(323, 'sup_1320', 'Golden Hope Mktg.', 'Bacolod city', '', '', 1),
(324, 'sup_1321', 'SKG Shopping Plaza', 'Bacolod City', '', '', 1),
(325, 'sup_1322', 'Bacolod Standard Radio', 'Gonzaga St., Bacolod City', '', '', 1),
(326, 'sup_1323', 'Joel Glass Ware Store', 'Blk. 341 Central Public Market, Bacolod City', '', '', 1),
(327, 'sup_1324', 'Ebara Pumps Philippines, Inc', 'Canlubang Industrial Estate, Cabuyao, Laguna', '(02)871-9098 / 049-549-5028', '', 1),
(328, 'sup_1325', 'Armak Abraisive Products, Inc', '2205 Angelinao Paco Manila', '(02) 521-383', '', 1),
(329, 'sup_1326', 'L & J General Merchandise', 'Bago City', '', '', 1),
(330, 'sup_1327', 'Gilbilt Industrial Marketing', '', '', '', 1),
(331, 'sup_1328', 'Ken-tool Hardware Corporation', '1167 La Torre St., J.A Santos Ave., Manila', '252-0861 / 252-0871', '', 1),
(332, 'sup_1329', 'Excelsior Sevenfold Trade Corp', '#22 Datsun St., Fairview Park Subd., Fairview, Quezon City', '428-2539 / 428-2536 / 0917-5773218', '', 1),
(333, 'sup_1330', 'TGA Chemical Enterprises', 'Tower Bldg., 61 Burgos Ave., Bacolod City', '034 432-1899', '', 1),
(334, '', 'NKK', '', '', '', 1),
(335, '', 'SEMT', '', '', '', 1),
(336, 'PRO2019', 'Progen', '', '', '', 1),
(337, '', 'Impact One Nation Industrial Corporation', '6D Pearl St. Golden Acres, Las Piñas City', '(02) 800-9104', '', 1),
(338, '', 'Petron Corporation', 'KM. 13.5 National Highway, Taloc Bago City', '', '', 1),
(339, '', 'Burgos Market', 'Burgos, Bacolod City', '', 'Cash', 1),
(340, '', 'Philippine Desiccants Inc.', '15 Jasmine St. South Green Park, Km. 18, West Service Rd. Parañaque City', '(02) 776-6177 / 821-0117-18', '', 1),
(341, '', 'Twin Top Pharma', 'Door 6, JL Bldg. Burgos Ave., cor. Lacson St. Bacolod City', '(034) 708-0544', '', 1),
(342, '', 'Bacolod Pro Sanicleaners Supply Center', 'Tower Building, 61 Burgos Ave. Bacolod City', '(034) 432-1899', '', 1),
(343, '', 'RM Shell', '100 B.S Aquino Drive, Bacolod City', '(034) 433-6038', '', 1),
(344, '', 'Richard & Zacchary Woodcraft', 'Victorina Heights, Libertad Ext., Brgy. Mansilingan', '(034)431-5866/213-3858', '', 1),
(345, '', 'Khaiyen and Khaila Lumber Merchandising', 'Mansilingan, Bacolod City', '09416-408-0028/0943-200-3145', '', 1),
(346, '', 'Bacolod Canvas 88, Inc.', 'Gonzaga St. Bacolod City', '(034) 434-3188', '', 1),
(347, '', 'Cifra Marketing Corporation', '#4229 General Mojica St. Bangkal, Makati City', '(02) 8844-6742 / 8844-7787', '', 1),
(348, '', 'SM Supermarket', 'Annex Building, South Wing-SM City, Bacolod City', '(034) 468-0168', '', 1),
(349, '', 'Belen Store', 'Burgos Market, Bacolod City', '', '', 1),
(350, '', 'New China Enterprises', '55 Luzuriaga St., Bacolod, 6100 Negros Occidental', '(034) 433-5808/444-2773', '', 1),
(351, '', 'Robinsons Handyman Inc.', 'Mandalagan, Bacolod City', '', '', 1),
(352, '', 'Ideal Electric', '', '', '', 1),
(353, '', 'Lubritek, Inc.', '', '(064) 435-1976', '', 1),
(354, '', 'Goldtown Import', '160 M.H. Del Polar St. between 8th and  9th Ave., Caloocan City', '8364-7840 / 8365-8357', '', 1),
(355, '', 'Jotun (Philippines) Inc.', 'United Avenue Mandaue Cebu City,', '(032) 346-7832, 346-7998', '', 1),
(356, '', 'Gaudite Hardware and Construction Supply', 'Araneta St., Bago City', '034-461-0148', '', 1),
(357, 'sup_1331', 'ENEX GmbH / ENEX Vertriebsgesellschaft mbH', 'Schnackenburgallee 116, 22525 Hamburg, Germany / Tibarg 40 DE-22459, Hamburg, Germany', 'Ms. Susanne Strauss +49 40 5472160', '', 1),
(358, 'sup_1332', 'Pro Torque Tools', '751 James P. Brawley Dr. NW Suite # 3 Atlanta, GA 30318 USA', 'Mr. Cleve McCounry - 1-800-945-7644', '', 1),
(359, 'sup_1333', 'MD Trade Power GmbH & Co. KG', 'Alte Kreisstrasse1, 39171 Suelzetal, Germany', 'Mr. Steven Wnendt - +49 391 727678-13', '', 1),
(360, 'sup_1334', 'Panda Construction Supply Inc.', '340-B G. Araneta Avenue, Brgy. Doña Imelda, Quezon City', 'Mr. Rommy -7168361/62, 7157455, 7153424, 2428214', '', 1),
(361, 'sup_1335', 'Cerakote (NIC Industries)', '7050 6th Street, White City, Oregon, Usa, 97503', '1-866-774-7628', '', 1),
(362, '', 'Bacolod HKL Enterprises', 'Locsin Street, Bacolod City', '034 458 9588', '', 1),
(363, '', 'Bacolod Luis Paint Center Enterprises', '2580 Tindalo Ave., Capitol Shopping, Villamonte, Bacolod City', '034 435-2227 / 434-1509', '', 1),
(364, 'sup_1336', 'Imperial Appliance Plaza', '69-2 Araneta Ave, Bacolod City', '034-435-0469', '', 1),
(365, 'sup_1337', 'Guangzhou Landtek Instruments Co., Ltd.', 'Flat C, Kengkou Electronic Base, No. 3 Huaxi Rd. Fangcun Liwan District, Guangzhou, China', '020-81609313 /13794373236', '', 1),
(366, 'SUP_1338', 'Kent International Trading Co. Inc.', '14 Brixton St., Brgy. Kapitolyo, Pasig City, Metro Manila', '8727-30-11 to 16', '', 1),
(367, 'SUP_1339', 'Ene Vertriebsgesellschaft mbH', 'Tibarg 40, DE-22459 Hamburg, Germany', '+49 (0) 40 54 72 16-0', '', 1),
(368, 'SUP_1340', 'Carvi Upholstery & Home Supply', 'Gonzaga St, Bacolod City', '034-434-5020', '', 1),
(369, 'SUP_1341', 'Ocean Electrical Pte. Ltd.', '50 Tuas Ave 11, Tuas Lot#03-25, Singapore, 639107', '+65-6316 2230', '', 1),
(370, 'SUP_1342', 'Daiso Japan', '2nd Flr. Robinsons Place, Bacolod City', '(034) 441-0517', '', 1),
(371, 'SUP_1343', 'Kametsino Gen. MDSE.', 'Door 14 G/F VJA Bldg. Burgos-San Juan St., Bacolod City', '', '', 1),
(372, 'SUP_1344', 'Interworld Highway, LLC (Tequipment Net)', '205 Westwood Avenue Long Branch, New Jersey, 07740', '1-877-571-7901 /1-782-728-2590', '', 1),
(373, 'SUP_1345', 'Hipotronics Inc.', '1650 Route 22N, Brewster, NY 10509', '+91 44-49304086, +91 7550096590', '', 1),
(374, 'SUP_1346', 'Mtech Asia Trading, Inc.', 'No. 3 2nd St., Brgy Kapitolyo Pasig City, Metron Manila', 'Tel: 8470-6048 / 8470-4232 / 8470-4329', '', 1),
(375, 'SUP_1347	', 'Hardware and Industrial Solutions Incorporated', '56 Madison Street, Mandaluyong City', '02 631-8366 / 638-1432', '', 1),
(376, 'SUP_1348', 'Du Ek Sam, Inc.', 'Regena Bldg., Ist St. Marhil Subd. Poblacion, Bago City', '0917 891 6347', '', 1),
(377, 'SUP_1349', 'Helton Marketing', 'Libertad Street, Bacolod City', '433-2927 / 434-7359', '', 1),
(378, 'SUP_1350', 'Tower General Merchandise', 'Int 103, 1009 Benavidez St., Brgy. 294 Zone 28, Binondo, Manila 1006', '', '', 1),
(379, 'SUP_1351', 'PASS (Portable Appliance Safety Services) LTD', '1 Wilson Street Thornaby Stockton On Tees TS17 7AR', '0800 247 1600', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_sales_out`
--

CREATE TABLE IF NOT EXISTS `temp_sales_out` (
`temp_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL DEFAULT '0',
  `sales_serv_items_id` int(11) NOT NULL DEFAULT '0',
  `sales_details_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `in_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE IF NOT EXISTS `uom` (
`unit_id` int(11) NOT NULL,
  `unit_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`unit_id`, `unit_name`) VALUES
(1, 'bag/s'),
(2, 'bar/s'),
(3, 'bot/s'),
(4, 'box/s'),
(5, 'can/s'),
(6, 'cart/s'),
(7, 'cont/s'),
(8, 'cu.m'),
(9, 'cyl/s'),
(10, 'drum/s'),
(11, 'feet'),
(12, 'gal/s'),
(13, 'kg/s'),
(14, 'lgth/s'),
(15, 'ltr/s'),
(16, 'mtr/s'),
(17, 'pack/s'),
(18, 'pad/s'),
(19, 'pail/s'),
(20, 'pair/s'),
(21, 'pc/s'),
(22, 'ream/s'),
(23, 'roll/s'),
(24, 'sack/s'),
(25, 'set/s'),
(26, 'sht/s'),
(27, 'tab/s'),
(28, 'tube/s'),
(29, 'unit/s'),
(30, 'grm/s'),
(31, 'assy/s'),
(32, 'lot'),
(33, 'kit/s');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `position`, `password`) VALUES
(1, 'admin', 'Admin', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
`warehouse_id` int(11) NOT NULL,
  `warehouse_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `warehouse_name`) VALUES
(1, 'CENPRI'),
(2, 'PROGEN'),
(3, 'CV Access Area Bay 1'),
(4, 'CV Access Area Bay 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
 ADD PRIMARY KEY (`billing_detail_id`);

--
-- Indexes for table `billing_head`
--
ALTER TABLE `billing_head`
 ADD PRIMARY KEY (`billing_id`);

--
-- Indexes for table `billing_payment`
--
ALTER TABLE `billing_payment`
 ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `bin`
--
ALTER TABLE `bin`
 ADD PRIMARY KEY (`bin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
 ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `damage_details`
--
ALTER TABLE `damage_details`
 ADD PRIMARY KEY (`damage_det_id`);

--
-- Indexes for table `damage_head`
--
ALTER TABLE `damage_head`
 ADD PRIMARY KEY (`damage_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
 ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `fifo_in`
--
ALTER TABLE `fifo_in`
 ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `fifo_out`
--
ALTER TABLE `fifo_out`
 ADD PRIMARY KEY (`out_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `item_subcat`
--
ALTER TABLE `item_subcat`
 ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `manpower`
--
ALTER TABLE `manpower`
 ADD PRIMARY KEY (`manpower_id`);

--
-- Indexes for table `payment_head`
--
ALTER TABLE `payment_head`
 ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pn_series`
--
ALTER TABLE `pn_series`
 ADD PRIMARY KEY (`pn_id`);

--
-- Indexes for table `purpose`
--
ALTER TABLE `purpose`
 ADD PRIMARY KEY (`purpose_id`);

--
-- Indexes for table `rack`
--
ALTER TABLE `rack`
 ADD PRIMARY KEY (`rack_id`);

--
-- Indexes for table `receive_details`
--
ALTER TABLE `receive_details`
 ADD PRIMARY KEY (`rd_id`);

--
-- Indexes for table `receive_head`
--
ALTER TABLE `receive_head`
 ADD PRIMARY KEY (`receive_id`), ADD UNIQUE KEY `mrecf_no` (`mrecf_no`);

--
-- Indexes for table `receive_items`
--
ALTER TABLE `receive_items`
 ADD PRIMARY KEY (`ri_id`);

--
-- Indexes for table `repair_details`
--
ALTER TABLE `repair_details`
 ADD PRIMARY KEY (`repair_id`);

--
-- Indexes for table `return_details`
--
ALTER TABLE `return_details`
 ADD PRIMARY KEY (`return_details_id`);

--
-- Indexes for table `return_head`
--
ALTER TABLE `return_head`
 ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `return_service_details`
--
ALTER TABLE `return_service_details`
 ADD PRIMARY KEY (`return_serv_details_id`);

--
-- Indexes for table `return_service_head`
--
ALTER TABLE `return_service_head`
 ADD PRIMARY KEY (`return_service_id`);

--
-- Indexes for table `sales_good_details`
--
ALTER TABLE `sales_good_details`
 ADD PRIMARY KEY (`sales_good_det_id`);

--
-- Indexes for table `sales_good_head`
--
ALTER TABLE `sales_good_head`
 ADD PRIMARY KEY (`sales_good_head_id`);

--
-- Indexes for table `sales_services_head`
--
ALTER TABLE `sales_services_head`
 ADD PRIMARY KEY (`sales_serv_head_id`);

--
-- Indexes for table `sales_serv_equipment`
--
ALTER TABLE `sales_serv_equipment`
 ADD PRIMARY KEY (`sales_serv_equipment_id`);

--
-- Indexes for table `sales_serv_items`
--
ALTER TABLE `sales_serv_items`
 ADD PRIMARY KEY (`sales_serv_items_id`);

--
-- Indexes for table `sales_serv_manpower`
--
ALTER TABLE `sales_serv_manpower`
 ADD PRIMARY KEY (`sales_serv_manpower_id`);

--
-- Indexes for table `sales_serv_material`
--
ALTER TABLE `sales_serv_material`
 ADD PRIMARY KEY (`sales_serv_mat_id`);

--
-- Indexes for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
 ADD PRIMARY KEY (`serial_id`);

--
-- Indexes for table `shipping_company`
--
ALTER TABLE `shipping_company`
 ADD PRIMARY KEY (`ship_comp_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `temp_sales_out`
--
ALTER TABLE `temp_sales_out`
 ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
 ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
 ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
MODIFY `billing_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `billing_head`
--
ALTER TABLE `billing_head`
MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `billing_payment`
--
ALTER TABLE `billing_payment`
MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bin`
--
ALTER TABLE `bin`
MODIFY `bin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `damage_details`
--
ALTER TABLE `damage_details`
MODIFY `damage_det_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `damage_head`
--
ALTER TABLE `damage_head`
MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fifo_in`
--
ALTER TABLE `fifo_in`
MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fifo_out`
--
ALTER TABLE `fifo_out`
MODIFY `out_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `item_subcat`
--
ALTER TABLE `item_subcat`
MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `manpower`
--
ALTER TABLE `manpower`
MODIFY `manpower_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_head`
--
ALTER TABLE `payment_head`
MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pn_series`
--
ALTER TABLE `pn_series`
MODIFY `pn_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `purpose`
--
ALTER TABLE `purpose`
MODIFY `purpose_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `rack`
--
ALTER TABLE `rack`
MODIFY `rack_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=390;
--
-- AUTO_INCREMENT for table `receive_details`
--
ALTER TABLE `receive_details`
MODIFY `rd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receive_head`
--
ALTER TABLE `receive_head`
MODIFY `receive_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receive_items`
--
ALTER TABLE `receive_items`
MODIFY `ri_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `repair_details`
--
ALTER TABLE `repair_details`
MODIFY `repair_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_details`
--
ALTER TABLE `return_details`
MODIFY `return_details_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_head`
--
ALTER TABLE `return_head`
MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_service_details`
--
ALTER TABLE `return_service_details`
MODIFY `return_serv_details_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_service_head`
--
ALTER TABLE `return_service_head`
MODIFY `return_service_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_good_details`
--
ALTER TABLE `sales_good_details`
MODIFY `sales_good_det_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_good_head`
--
ALTER TABLE `sales_good_head`
MODIFY `sales_good_head_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_services_head`
--
ALTER TABLE `sales_services_head`
MODIFY `sales_serv_head_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_serv_equipment`
--
ALTER TABLE `sales_serv_equipment`
MODIFY `sales_serv_equipment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_serv_items`
--
ALTER TABLE `sales_serv_items`
MODIFY `sales_serv_items_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_serv_manpower`
--
ALTER TABLE `sales_serv_manpower`
MODIFY `sales_serv_manpower_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_serv_material`
--
ALTER TABLE `sales_serv_material`
MODIFY `sales_serv_mat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
MODIFY `serial_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `shipping_company`
--
ALTER TABLE `shipping_company`
MODIFY `ship_comp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=380;
--
-- AUTO_INCREMENT for table `temp_sales_out`
--
ALTER TABLE `temp_sales_out`
MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
