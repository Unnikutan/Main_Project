-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 07:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garbage`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bins`
--

CREATE TABLE `tbl_bins` (
  `bin_id` int(3) NOT NULL,
  `b_name` varchar(20) NOT NULL,
  `gb_id` int(4) NOT NULL,
  `type` varchar(3) NOT NULL,
  `pick_up` int(3) DEFAULT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `location` varchar(150) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 0,
  `fill_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bins`
--

INSERT INTO `tbl_bins` (`bin_id`, `b_name`, `gb_id`, `type`, `pick_up`, `lat`, `lon`, `location`, `status`, `fill_date`) VALUES
(1, 'Small_bin1', 4, 'S', 16, 8.90709, 77.0546, 'Kerala Gramin Bank Front 1', 0, NULL),
(2, 'Small_bin2', 4, 'S', 16, 8.90709, 77.0545, 'Kerala Gramin Bank Front 2', 0, NULL),
(3, 'Small_bin3', 4, 'S', 16, 8.90716, 77.0545, 'Near Panchayat Office', 0, NULL),
(4, 'Small_bin4', 4, 'S', 16, 8.90724, 77.0547, 'Near Bus Stop', 0, NULL),
(6, 'Small_bin5', 4, 'S', 16, 8.90736, 77.0547, 'Opposite Bus Stop', 0, NULL),
(7, 'Small_bin6', 4, 'S', 16, 8.90792, 77.055, 'Near Dental Clinic', 0, NULL),
(9, 'Small_bin8', 4, 'S', 16, 8.90769, 77.0547, 'Near Kpzha Market', 0, NULL),
(10, 'Small_bin9', 4, 'S', 16, 8.90825, 77.0554, 'kpzha Main Jn', 0, NULL),
(11, 'Small_bin10', 4, 'S', 16, 8.9081, 77.0553, 'Near Private Bus Stop', 0, NULL),
(12, 'Large_BIN1', 4, 'L', NULL, 8.90722, 77.0546, 'Near Panchayat Office', 0, NULL),
(13, 'Large_BIN2', 4, 'L', NULL, 8.90831, 77.0555, 'Near Main JN, KPZHA', 0, NULL),
(14, 'Large_BIN3', 4, 'L', NULL, 8.90971, 77.0547, 'Near Jama Masjid ', 0, NULL),
(15, 'Large_BIN4', 4, 'L', NULL, 8.90927, 77.0527, 'Near Petrol Pump', 0, NULL),
(16, 'Large_BIN5', 4, 'L', NULL, 8.90748, 77.0535, 'Near Federal Bank', 0, NULL),
(17, 'Large_BIN6', 4, 'L', NULL, 8.90772, 77.0561, 'Auto Stand 3 Kpzha', 0, NULL),
(19, 'Large_BIN7', 4, 'L', NULL, 8.90712, 77.0567, 'Near Bus Stand', 0, NULL),
(20, 'Large_BIN8', 4, 'L', NULL, 8.90664, 77.0571, 'Near UPS school', 0, NULL),
(21, 'Large_BIN9', 4, 'L', NULL, 8.90506, 77.0574, 'Near Forest Meseum', 0, NULL),
(22, 'Large_BIN10', 4, 'L', NULL, 8.90443, 77.0555, 'Green Valley School', 0, NULL),
(23, 'Large_BIN11', 4, 'L', NULL, 8.90513, 77.0535, 'Near Pattapalli', 0, NULL),
(24, 'Large_BIN12', 4, 'L', NULL, 8.90633, 77.0523, 'Nellimoodu Kayattam', 0, NULL),
(25, 'Large_BIN13', 4, 'L', NULL, 8.90563, 77.0509, 'AK sons', 0, NULL),
(26, 'Large_BIN14', 4, 'L', NULL, 8.90579, 77.0491, 'Nellimoodu Cross', 0, NULL),
(27, 'Large_BIN15', 4, 'L', NULL, 8.90634, 77.0477, 'Transformer JN', 0, NULL),
(28, 'Large_BIN16', 4, 'L', NULL, 8.90793, 77.0488, 'Near small mosque', 0, NULL),
(29, 'Large_BIN17', 4, 'L', NULL, 8.9102, 77.0495, 'Kaithakkadu', 0, NULL),
(30, 'Container_1', 4, 'C', NULL, 8.90816, 77.0531, 'Kulathupzha WM', 0, NULL),
(31, 'Container_2', 4, 'C', NULL, 8.89818, 77.0562, 'Kalluvettam Kuzhi', 0, NULL),
(32, 'Container_3', 4, 'C', NULL, 8.91333, 77.0462, 'Valiyavila', 0, NULL),
(33, 'Container_4', 4, 'C', NULL, 8.91548, 77.0553, 'Ex-Service', 0, NULL),
(34, 'Container_5', 4, 'C', NULL, 8.92864, 77.0635, 'Neduvannor Kadavu', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comp`
--

CREATE TABLE `tbl_comp` (
  `id` int(3) NOT NULL,
  `type` int(3) NOT NULL,
  `enter_id` int(3) NOT NULL,
  `gb_id` int(3) NOT NULL,
  `topic` varchar(30) NOT NULL,
  `descrip` varchar(200) NOT NULL,
  `feedback` varchar(150) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comp`
--

INSERT INTO `tbl_comp` (`id`, `type`, `enter_id`, `gb_id`, `topic`, `descrip`, `feedback`, `status`) VALUES
(1, 2, 5, 4, 'Webiste Issue', 'fsdfsdfsdfsdfsdfsdf', 'Thats for your comment, Action will take soon', 2),
(3, 2, 5, 4, 'Truck Issue', 'fdgfdgfddfdadrregevsfs', '', 0),
(5, 2, 5, 9, 'Truck Issue', 'There is a issue with my truck \r\nPlaese rectify it', '', 0),
(6, 1, 1, 4, 'Bin Issue', 'Trash Bin Not Working', 'Please Specify the bin Name', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver`
--

CREATE TABLE `tbl_driver` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `type` int(2) NOT NULL COMMENT '1 = Garbage Collector\r\n2 =  Driver',
  `gb_id` int(3) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `aadhaar` varchar(20) NOT NULL,
  `phno` bigint(15) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_driver`
--

INSERT INTO `tbl_driver` (`id`, `name`, `age`, `gender`, `type`, `gb_id`, `address`, `aadhaar`, `phno`, `username`, `password`) VALUES
(5, 'Vineesh A U', 23, 'Male', 2, 4, 'alaka palambil,\r\nThrissur', '545123456789', 7012272629, 'vineesh1997@gmail.com', 'garu'),
(8, 'Shajahan A K', 40, 'Male', 2, NULL, 'Shiyas Manzil\r\nKasimpillla Karikkom\r\nKulathupuzha', '561423154875', 6238582109, 'shiyassak@gmail.com', 'unni8799'),
(9, 'Binshad A J', 32, 'Male', 2, 4, 'Kadampattu House,\r\nNellimoodu\r\nKulathupuzha', '693341775822', 9845696235, 'binshadaj@gmail.com', 'aydhus1998'),
(10, 'Hari', 21, 'Male', 2, 4, 'kamsan house', '123456789546', 9744833407, 'kamsan@gmail.com', 'hari1234'),
(12, 'Abhijith ', 20, 'Male', 2, 4, 'Validathil House,\r\nRanni', '591236478593', 9207090928, 'abhijith@gmail.com', 'abhijith@123'),
(13, 'Keerthana', 22, 'Female', 2, 4, 'Viyyath House,\r\nThrissur', '904868572415', 7594841242, 'keerthavm@gmail.com', 'keerthanavm'),
(16, 'Babu VM', 30, 'Male', 1, 4, 'hskdjhsajkdgsajd', '251362354488', 9062356966, 'jaijavan@gmail.com', 'jaijavan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gb`
--

CREATE TABLE `tbl_gb` (
  `gb_id` int(3) NOT NULL,
  `gb_name` varchar(20) NOT NULL,
  `person` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `address` varchar(150) NOT NULL,
  `small_bin` int(4) NOT NULL,
  `large_bin` int(3) NOT NULL,
  `container` int(3) NOT NULL,
  `total_bin` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gb`
--

INSERT INTO `tbl_gb` (`gb_id`, `gb_name`, `person`, `position`, `address`, `small_bin`, `large_bin`, `container`, `total_bin`, `username`, `password`) VALUES
(4, 'Kulathupuzha', 'Anil Kumar', 'President', 'Kulathupuzha Panchayat Office,\r\nKulathupuzha', 30, 1, 0, 62, 'kulathupuzha_gb', 'kpzha'),
(9, 'Anchal', 'Salma Beevi', 'President', 'Anchal WM,\r\nR.O Jn, Anchal', 0, 0, 0, 0, 'anchalgb', 'anchal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(3) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` int(3) NOT NULL COMMENT '0 = admin\r\n1 = worker\r\n2 = driver\r\n3 = wm\r\n4 = user',
  `enter_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `username`, `password`, `type`, `enter_id`) VALUES
(1, 'admin', 'admin', 0, ''),
(12, 'shefeeque234@gmail.com', 'aliyan123', 2, '2'),
(15, 'vineesh1997@gmail.com', 'garu', 2, '5'),
(18, 'kulathupuzha_gb', 'kpzha', 3, '4'),
(21, 'unnikuttan8799@gmail.com', 'Unni8799', 4, '1'),
(23, 'anchalgb', 'anchal', 3, '9'),
(24, 'shiyassak@gmail.com', 'unni8799', 2, '8'),
(25, 'binshadaj@gmail.com', 'aydhus1998', 2, '9'),
(26, 'kamsan@gmail.com', 'hari1234', 2, '10'),
(28, 'annamabraham98@gmail.com', 'anna1998', 4, '2'),
(29, 'ariyankavu_gb', 'ariyan', 3, '10'),
(30, 'punalur_gb', 'punalur', 3, '11'),
(31, 'abhijith@gmail.com', 'abhijith@123', 2, '12'),
(32, 'keerthavm@gmail.com', 'keerthanavm', 2, '13'),
(37, 'anasbasheer114@gmail.com', 'anas@123', 4, '4'),
(39, 'jaijavan@gmail.com', 'jaijavan', 1, '16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_office`
--

CREATE TABLE `tbl_office` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `gb_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_office`
--

INSERT INTO `tbl_office` (`id`, `name`, `lat`, `lon`, `gb_id`) VALUES
(1, 'Anchal', 8.92742, 76.9141, 9),
(2, 'Ariyankavu', 8.97642, 77.1505, NULL),
(3, 'Edamulakkal', 8.88951, 76.8511, NULL),
(4, 'Karavaloor', 8.97892, 76.9252, NULL),
(5, 'Kulathupuzha', 8.90712, 77.0545, 4),
(6, 'Punalur', 9.01756, 76.9264, NULL),
(7, 'Thenmala', 8.95805, 77.0647, NULL),
(8, 'Yeroor', 8.93578, 76.9461, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requestbin`
--

CREATE TABLE `tbl_requestbin` (
  `id` int(3) NOT NULL,
  `gb_id` int(4) NOT NULL,
  `type` varchar(3) NOT NULL,
  `num` int(3) NOT NULL,
  `date` date NOT NULL,
  `comment` varchar(100) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_requestbin`
--

INSERT INTO `tbl_requestbin` (`id`, `gb_id`, `type`, `num`, `date`, `comment`, `status`) VALUES
(4, 4, 'L', 10, '2022-07-05', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE `tbl_route` (
  `route_id` int(3) NOT NULL,
  `route_name` varchar(30) NOT NULL,
  `details` varchar(100) NOT NULL,
  `truck_no` varchar(15) DEFAULT NULL,
  `gb_id` int(3) DEFAULT NULL,
  `day` int(11) NOT NULL,
  `spl` int(11) NOT NULL,
  `itr` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_route`
--

INSERT INTO `tbl_route` (`route_id`, `route_name`, `details`, `truck_no`, `gb_id`, `day`, `spl`, `itr`) VALUES
(24, 'route1', 'dfsdfsdfsd', 'KL-25-M-1805', 4, 3, 0, 0),
(27, 'dfsdfsdfds_route', 'fjdhfdsjkfhdsjkfhdskjfhd', 'KL-25-Z-0000', NULL, 2, 0, 0),
(29, 'Admin_route2', 'From kpzha to Thenmala', 'KL-25-Z-0000', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route_details`
--

CREATE TABLE `tbl_route_details` (
  `id` int(3) NOT NULL,
  `route_id` int(3) NOT NULL,
  `bins` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_route_details`
--

INSERT INTO `tbl_route_details` (`id`, `route_id`, `bins`) VALUES
(58, 24, 12),
(59, 24, 13),
(60, 24, 17),
(61, 27, 32),
(62, 27, 30),
(63, 27, 33),
(64, 27, 34),
(65, 29, 31),
(66, 29, 33),
(67, 29, 34);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_truck`
--

CREATE TABLE `tbl_truck` (
  `truck_no` varchar(15) NOT NULL,
  `gb_id` int(3) DEFAULT NULL,
  `driver_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_truck`
--

INSERT INTO `tbl_truck` (`truck_no`, `gb_id`, `driver_id`) VALUES
('KL-25-A-1222', 9, NULL),
('KL-25-A-2356', 9, NULL),
('KL-25-B-9000', 9, NULL),
('KL-25-D-1003', 4, NULL),
('KL-25-E-9048', 4, NULL),
('KL-25-L-1234', 4, 5),
('KL-25-M-1805', 4, 5),
('KL-25-Z-0000', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `u_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(150) NOT NULL,
  `aadhaar` varchar(15) NOT NULL,
  `pin` int(11) NOT NULL,
  `phno` bigint(15) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `gb_id` int(3) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`u_id`, `name`, `age`, `gender`, `address`, `aadhaar`, `pin`, `phno`, `photo`, `gb_id`, `email`, `password`) VALUES
(1, 'Shiyas Shajahan', 22, 'Male', 'Shiyas Manzil\r\nKasimpillla Karikkom', '591591591523', 691310, 9745910475, '', 4, 'unnikuttan8799@gmail.com', 'Unni8799'),
(2, 'Anna M Abraham', 23, 'Female', 'Malethu House,\r\nAnchal', '695648751235', 691312, 9539796490, '', 9, 'annamabraham98@gmail.com', 'anna1998'),
(4, 'Anas B S', 20, 'Male', 'Vengavila Vedu,\r\nKazimpilla karikkam,\r\nKulathupuzha', '152630547945', 691310, 7582164086, 'uploads/Photo.jpg', 4, 'anasbasheer114@gmail.com', 'anas@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bins`
--
ALTER TABLE `tbl_bins`
  ADD PRIMARY KEY (`bin_id`),
  ADD KEY `gb_id` (`gb_id`);

--
-- Indexes for table `tbl_comp`
--
ALTER TABLE `tbl_comp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gb_id` (`gb_id`);

--
-- Indexes for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gb_id` (`gb_id`);

--
-- Indexes for table `tbl_gb`
--
ALTER TABLE `tbl_gb`
  ADD PRIMARY KEY (`gb_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_office`
--
ALTER TABLE `tbl_office`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_office_ibfk_1` (`gb_id`);

--
-- Indexes for table `tbl_requestbin`
--
ALTER TABLE `tbl_requestbin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gb_id` (`gb_id`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `tbl_route_ibfk_1` (`gb_id`),
  ADD KEY `tbl_route_ibfk_2` (`truck_no`);

--
-- Indexes for table `tbl_route_details`
--
ALTER TABLE `tbl_route_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `bins` (`bins`);

--
-- Indexes for table `tbl_truck`
--
ALTER TABLE `tbl_truck`
  ADD PRIMARY KEY (`truck_no`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `gb_id` (`gb_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `gb_id` (`gb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bins`
--
ALTER TABLE `tbl_bins`
  MODIFY `bin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_comp`
--
ALTER TABLE `tbl_comp`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_gb`
--
ALTER TABLE `tbl_gb`
  MODIFY `gb_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_office`
--
ALTER TABLE `tbl_office`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_requestbin`
--
ALTER TABLE `tbl_requestbin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `route_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_route_details`
--
ALTER TABLE `tbl_route_details`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bins`
--
ALTER TABLE `tbl_bins`
  ADD CONSTRAINT `tbl_bins_ibfk_1` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_comp`
--
ALTER TABLE `tbl_comp`
  ADD CONSTRAINT `tbl_comp_ibfk_1` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  ADD CONSTRAINT `tbl_driver_ibfk_1` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_office`
--
ALTER TABLE `tbl_office`
  ADD CONSTRAINT `tbl_office_ibfk_1` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_requestbin`
--
ALTER TABLE `tbl_requestbin`
  ADD CONSTRAINT `tbl_requestbin_ibfk_1` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD CONSTRAINT `tbl_route_ibfk_1` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_route_ibfk_2` FOREIGN KEY (`truck_no`) REFERENCES `tbl_truck` (`truck_no`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_route_details`
--
ALTER TABLE `tbl_route_details`
  ADD CONSTRAINT `tbl_route_details_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `tbl_route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_route_details_ibfk_2` FOREIGN KEY (`bins`) REFERENCES `tbl_bins` (`bin_id`);

--
-- Constraints for table `tbl_truck`
--
ALTER TABLE `tbl_truck`
  ADD CONSTRAINT `tbl_truck_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `tbl_driver` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_truck_ibfk_2` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`gb_id`) REFERENCES `tbl_gb` (`gb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `route_demo1` ON SCHEDULE EVERY 1 DAY STARTS '2022-07-05 22:48:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
	DELETE FROM tbl_route
	WHERE spl = 1;
	UPDATE tbl_route
	set itr = 0;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
