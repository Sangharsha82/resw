-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2017 at 06:47 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agent_id` int(10) NOT NULL,
  `agent_name` varchar(150) NOT NULL,
  `agent_address` varchar(250) NOT NULL,
  `agent_contact` varchar(20) NOT NULL,
  `agent_email` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agent_id`, `agent_name`, `agent_address`, `agent_contact`, `agent_email`) VALUES
(1, 'Ronas Pahiju', 'Byasi Bhaktapur', '987654321', 'ronas@gmail.com'),
(2, 'Krish Karmacharya', 'Balakhu Bhaktapur', '123456789', 'krish@gmail.com'),
(3, 'Aardish Duwal', 'Dekocha Bhaktapur', '02 4728 5284', 'aardish@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(10) NOT NULL,
  `property_title` varchar(150) DEFAULT NULL,
  `property_details` text,
  `delivery_type` varchar(20) DEFAULT NULL,
  `availablility` int(5) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `property_address` varchar(200) DEFAULT NULL,
  `property_img` varchar(200) DEFAULT NULL,
  `bed_room` int(5) DEFAULT NULL,
  `liv_room` int(5) DEFAULT NULL,
  `parking` int(5) DEFAULT NULL,
  `kitchen` int(5) DEFAULT NULL,
  `utility` varchar(100) DEFAULT NULL,
  `property_type` varchar(20) DEFAULT NULL,
  `floor_space` varchar(20) DEFAULT NULL,
  `agent_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `property_title`, `property_details`, `delivery_type`, `availablility`, `price`, `property_address`, `property_img`, `bed_room`, `liv_room`, `parking`, `kitchen`, `utility`, `property_type`, `floor_space`, `agent_id`) VALUES
(1, 'Apartment', 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. <br> <br>\r\n\r\nCompletely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service', 'Sale', 0, 150000, 'Byasi Bhaktapur', 'images/properties/bed-1-1.jpg', 3, 2, 1, 1, 'Electricity, Gas, Water', 'Apartment', '1600 X 1400', 3),
(2, 'Apartment For Rent', 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. <br> <br>\r\n\r\nCompletely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service', 'Rent', 0, 7000, 'Dekocha Bhaktapur', 'images/properties/bed-2-1.jpg', 3, 2, 1, 1, 'Electricity, Gas, Water', 'Apartment', '1650 X 1350', 3),
(3, 'Apartment For Sale', 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. <br> <br>\r\n\r\nCompletely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service', 'Sale', 1, 80000, 'KamalBinayak Bhaktapur', 'images/properties/bed-3-1.jpg', 3, 2, 1, 1, 'Electricity, Gas, Water', 'Apartment', '1500 X 1300', 3),
(4, 'Office-Space for Sale', 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. <br> <br>\r\n\r\nCompletely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service', 'Sale', 0, 100000, 'Chyamasignh Bhaktapur', 'images/properties/liv-4-1.jpg', 2, 3, 1, 1, 'Electricity, Gas, Water, Internet', 'Office-Space', '1650 X 1350', 2),
(5, 'Office-Space for Rent', 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. <br> <br>\r\n\r\nCompletely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service', 'Rent', 0, 7500, 'Sallaghari Bhaktapur', 'images/properties/liv-5-1.jpg', 2, 2, 1, 1, 'Electricity, Gas, Water, Internet', 'Office-Space', '1650 X 1350', 2),
(6, 'Office-Space for Rent', 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. <br> <br>\r\n\r\nCompletely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service', 'Rent', 1, 6000, 'Suryabinayak Bhaktapur', 'images/properties/liv-6-1.jpg', 2, 2, 1, 1, 'Electricity, Gas, Water, Internet', 'Office-Space', '1450 X 1250', 1),
(7, 'Building for Sale', 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. <br> <br>\r\n\r\nCompletely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service', 'Sale', 0, 1750000, 'Thimi Bhaktapur', 'images/properties/bed-7-1.jpg', 3, 2, 1, 1, 'Electricity, Gas, Water', 'Building', '1650 X 1350', 2);

-- --------------------------------------------------------

--
-- Table structure for table `property_image`
--

CREATE TABLE `property_image` (
  `property_images` varchar(200) DEFAULT NULL,
  `property_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_image`
--

INSERT INTO `property_image` (`property_images`, `property_id`) VALUES
('images/properties/bed-1-1.jpg', 1),
('images/properties/bed-1-2.jpg', 1),
('images/properties/liv-1-1.jpg', 1),
('images/properties/liv-1-2.jpg', 1),
('images/properties/kitchen-1-1.jpg', 1),
('images/properties/bed-1-1.jpg', 2),
('images/properties/bed-1-2.jpg', 2),
('images/properties/liv-1-1.jpg', 2),
('images/properties/liv-1-2.jpg', 2),
('images/properties/kitchen-1-1.jpg', 2),
('images/properties/bed-2-1.jpg', 2),
('images/properties/bed-2-2.jpg', 2),
('images/properties/liv-2-1.jpg', 2),
('images/properties/liv-2-2.jpg', 2),
('images/properties/kitchen-2-1.jpg', 2),
('images/properties/bed-3-1.jpg', 3),
('images/properties/bed-3-2.jpg', 3),
('images/properties/liv-3-1.jpg', 3),
('images/properties/liv-3-2.jpg', 3),
('images/properties/kitchen-3-1.jpg', 3),
('images/properties/bed-4-1.jpg', 4),
('images/properties/bed-4-2.jpg', 4),
('images/properties/liv-4-1.jpg', 4),
('images/properties/liv-4-2.jpg', 4),
('images/properties/kitchen-4-1.jpg', 4),
('images/properties/bed-5-1.jpg', 5),
('images/properties/bed-5-2.jpg', 5),
('images/properties/liv-5-1.jpg', 5),
('images/properties/liv-5-2.jpg', 5),
('images/properties/kitchen-5-1.jpg', 5),
('images/properties/bed-6-1.jpg', 6),
('images/properties/bed-6-2.jpg', 6),
('images/properties/liv-6-1.jpg', 6),
('images/properties/liv-6-2.jpg', 6),
('images/properties/kitchen-6-1.jpg', 6),
('images/properties/bed-7-1.jpg', 7),
('images/properties/bed-7-2.jpg', 7),
('images/properties/liv-7-1.jpg', 7),
('images/properties/liv-7-2.jpg', 7),
('images/properties/kitchen-7-1.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--


--
-- Indexes for table `agent`


-- First, add the admin column to the users table


-- Then, create an admin user (or update an existing user to be admin)
-- Option 1: Create new admin user
INSERT INTO users (
    username, 
    email, 
    password,  -- storing plain password (not recommended for production)
    full_name, 
    phone, 
    is_admin
) VALUES (
    'admin',
    'admin@jaggamandu.com',
    'admin123',
    'Administrator',
    '1234567890',
    TRUE
);

INSERT INTO users (
    username, 
    email, 
    password,  -- storing plain password (not recommended for production)
    full_name, 
    phone, 
    is_admin
) VALUES (
    'admin2',
    'admin2@jaggamandu.com',
    'admin123',
    'Administrator2',
    '1234567890',
    TRUE
);

-- Update existing admin user with properly hashed password
UPDATE users 
SET password = '$2y$10$YOUR_HASHED_PASSWORD'  -- This will be replaced by the PHP code
WHERE username = 'admin';

-- Or if you need to recreate the admin user:
INSERT INTO users (
    username, 
    email, 
    password,
    full_name,
    phone,
    is_admin
) VALUES (
    'admin',
    'admin@jaggamandu.com',
    '$2y$10$YOUR_HASHED_PASSWORD',  -- This will be replaced by the PHP code
    'Administrator',
    '1234567890',
    TRUE
) ON DUPLICATE KEY UPDATE
    password = VALUES(password),
    is_admin = TRUE;

-- Update both admin users with properly hashed passwords
UPDATE users 
SET password = CASE 
    WHEN username = 'admin' THEN '$2y$10$YOUR_HASHED_PASSWORD1'
    WHEN username = 'admin2' THEN '$2y$10$YOUR_HASHED_PASSWORD2'
    END
WHERE username IN ('admin', 'admin2');

-- Or if you need to recreate both admin users:
INSERT INTO users (
    username, 
    email, 
    password,
    full_name,
    phone,
    is_admin
) VALUES 
('admin', 'admin@jaggamandu.com', '$2y$10$YOUR_HASHED_PASSWORD1', 'Administrator', '1234567890', TRUE),
('admin2', 'admin2@jaggamandu.com', '$2y$10$YOUR_HASHED_PASSWORD2', 'Administrator2', '1234567890', TRUE)
ON DUPLICATE KEY UPDATE
    password = VALUES(password),
    is_admin = TRUE;