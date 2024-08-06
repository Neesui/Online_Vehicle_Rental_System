-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 02:20 PM
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
-- Database: `online_vehicle_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Nisha Chaudhary', 'Admin', 'admin@1gmail.com', '0192023a7bbd73250516f069df18b500', 1, '2023-06-29 15:37:01', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `b_id` int(11) NOT NULL,
  `Full_Name` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone_Number` bigint(20) DEFAULT NULL,
  `Address` varchar(30) NOT NULL,
  `Rent_Days` int(11) NOT NULL,
  `Vehicle_Category` varchar(20) NOT NULL,
  `Booking_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Driving_License` varchar(100) DEFAULT NULL,
  `Message` varchar(500) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `vehicle_id` int(11) DEFAULT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`b_id`, `Full_Name`, `Email`, `Phone_Number`, `Address`, `Rent_Days`, `Vehicle_Category`, `Booking_Date`, `End_Date`, `Driving_License`, `Message`, `status`, `vehicle_id`, `c_id`) VALUES
(1, 'Nisha Chudhary', 'user@gmail.com', 9871231230, 'Paknajol', 2, 'Bike', '2023-10-09', '2023-10-11', '652232dd7ba3c_driver-license.png', ' I want this Bike for 2 days', 1, 1, 1),
(2, 'Neesha Chaudhary', 'neesha11@gmail.com', 9860809356, 'Bagbazar', 5, 'Bike', '2023-10-09', '2023-10-13', '652266967c068_driver-license.png', ' I want Bike for tour..', 0, 2, 5),
(3, 'Neesha Chaudhary', 'neesha11@gmail.com', 9860809356, 'Dilibazar', 3, 'Car', '2023-10-10', '2023-10-13', '652374cd2b3d3_driver-license.png', ' I want this Car for 3 Days...', 0, 4, 5),
(4, 'Pooja Tamang', 'pooja@gmail.com', 9866655565, 'Palpa', 2, 'Car', '2023-10-10', '2023-10-12', '652379beb2983_driver-license.png', ' I want car..', 1, 5, 3),
(5, 'Neesha Chaudhary', 'neesha11@gmail.com', 9860809356, 'Pokhara', 1, 'Bike', '2023-10-11', '2023-10-12', '65260c78649c2_driver-license.png', ' I want this bike for 1 day', 0, 2, 5),
(6, 'Neetu Rai', 'neesha11@gmail.com', 9846588712, 'Dharan', 2, 'Car', '2023-10-11', '2023-10-13', '65260d03b13d8_driver-license.png', ' I want this car for 2 days', 0, 4, 5);

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `vehicle_status` AFTER INSERT ON `booking` FOR EACH ROW call vehicle_status_change(new.vehicle_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `rank` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `rank`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Bike', 1, 1, '0000-00-00 00:00:00', NULL, 0, NULL),
(2, 'Car', 2, 1, '0000-00-00 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `full_Name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `Phone_Number` bigint(20) DEFAULT NULL,
  `Address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `full_Name`, `email`, `password`, `Phone_Number`, `Address`) VALUES
(1, 'Nisha Chaudhary', 'user@gmail.com', 'user@123', 9871231230, 'Paknajol'),
(2, 'Neetu Rai', 'neetu@gmail.com', 'neetu123', 9876543210, 'Dhapashi'),
(3, 'Pooja Tamang', 'pooja55@gmail.com', 'pooja_123', 9866655565, 'Palpa'),
(4, 'Ram Sharma', 'rama@22@gmail.com', 'Rama78@', 9874563210, 'Kalanki'),
(5, 'Neesha Chaudhary', 'neesha11@gmail.com', 'neesha@55', 9860809356, 'Bagbazar');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `Vehicle_name` varchar(50) NOT NULL,
  `fuel` varchar(20) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `Vehicle_name`, `fuel`, `seats`, `price`, `model`, `image`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `category_id`, `message`) VALUES
(1, 'Pulser Ns', 'Petrol', 2, 2000, 2021, '651ef0d462686_b1.jpg', 0, '2023-10-05 23:07:28', '0000-00-00 00:00:00', 1, NULL, 1, 'Pulser NS  Latest Update Pulser\r\nhas Lunched Pulser NS 200 CC.'),
(2, 'Honda Cb', 'Petrol', 2, 1500, 2021, '65260f4c921cb_350.jpg', 0, '2023-10-05 23:09:23', '2023-10-11 04:58:20', 1, 1, 1, 'Honda CB Latest Update Honda has Lunched Honda CB 160\r\n\r\n'),
(3, 'Ktm Duke', 'Petrol', 2, 2500, 2022, '65260f24a848f_2020-KTM-Duke-200-1.jpg', 1, '2023-10-05 23:11:55', '2023-10-11 04:57:40', 1, 1, 1, 'KTM Duke Latest Update KTM has Lunched KTM Duke 250 RC.\r\n\r\n'),
(4, 'Honda', 'Petrol', 5, 3000, 2021, '65215add72c58_12.jpg', 0, '2023-10-07 19:04:25', '0000-00-00 00:00:00', 1, NULL, 2, 'Honda BR-V Latest Update Honda\r\nhas Lunched Honda BR-V 2. '),
(5, 'Mahindra', 'Petrol', 4, 2500, 2020, '652376fabece2_car2.jpg', 0, '2023-10-09 09:25:30', '2023-10-09 05:43:54', 1, 1, 2, 'Mahindra Latest Update Mahindra\r\nhas Lunched Mahindra 500'),
(6, 'Audi Qb', 'Petrol', 4, 3000, 2022, '6523791b60b91_images.jpg', 1, '2023-10-09 09:30:57', '2023-10-09 05:52:59', 1, 1, 2, 'Audi QB Latest Update Audi\r\nhas Lunched Audi QB is 0 kmpt.'),
(7, 'Yamaha FZ', 'Petrol', 2, 2500, 2022, '652416ad538ad_yamaha.jpg', 1, '2023-10-09 20:28:05', '2023-10-09 17:05:17', 1, 1, 1, 'Yamaha FZ Latest Update Yamaha has Lunched Yamaha FZ 250\r\n\r\n'),
(8, 'Royal Bullet', 'Petrol', 2, 3520, 2022, '65241237c546a_front-view.png', 1, '2023-10-09 20:31:15', '0000-00-00 00:00:00', 1, NULL, 1, 'Royal Enfield Bullet Latest Update Bullet\r\nhas Lunched Royal Bullet 350'),
(9, 'Suzuki', 'Petrol', 2, 2600, 2023, '652415f99b37c_suzuki.png', 1, '2023-10-09 20:37:47', '2023-10-09 17:02:17', 1, 1, 1, 'Suzuki Latest Update Suzuki has Lunched Suzuki 250.'),
(10, 'Suzuki Celerio', 'Petrol', 4, 3500, 2022, '65241730517fe_thumb.jfif', 1, '2023-10-09 20:52:28', '0000-00-00 00:00:00', 1, NULL, 2, 'Suzuki Latest Update Suzuki\r\nhas Lunched Suzuki Celerio 1.0'),
(11, 'Nissan', 'Petrol', 4, 2500, 2021, '652417e87b9ff_nissan.jpg', 1, '2023-10-09 20:53:46', '2023-10-09 17:10:32', 1, 1, 2, 'The GT-R Latest Update Nissan\r\nhas Lunched Nisan GT-R 3.8.'),
(12, 'Hyundai Aura', 'Petrol', 5, 3520, 2023, '652418842b836_Hyundai-Aura1.jpg', 1, '2023-10-09 20:56:52', '2023-10-09 17:13:08', 1, 1, 2, 'Hyundai Aura Latest Update\r\nhas Lunched Hyundai Aura SUV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `Driving_License` (`Driving_License`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
