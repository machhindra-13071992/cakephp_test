-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2014 at 08:55 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `its`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`) VALUES
(1, 'Mumbai'),
(2, 'Kolkata'),
(3, 'Ahmedabad'),
(4, 'Home');

-- --------------------------------------------------------

--
-- Table structure for table `system_allocations`
--

CREATE TABLE IF NOT EXISTS `system_allocations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `system_detail_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `assigned_date` datetime NOT NULL,
  `unassigned_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `comments` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `system_id` (`system_detail_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `system_details`
--

CREATE TABLE IF NOT EXISTS `system_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_no` varchar(10) NOT NULL,
  `model` varchar(30) NOT NULL,
  `serial_no` varchar(30) NOT NULL,
  `part_no` varchar(30) NOT NULL,
  `processor` varchar(50) NOT NULL,
  `high_resolution` char(3) DEFAULT NULL,
  `hard_disk` varchar(30) NOT NULL,
  `memory` varchar(30) NOT NULL,
  `memory_detail` varchar(50) NOT NULL,
  `warranty` date DEFAULT NULL,
  `wifi_available` enum('Yes','No') NOT NULL,
  `wifi_works` enum('Yes','No') NOT NULL,
  `sound` char(2) DEFAULT NULL,
  `software_key` varchar(50) DEFAULT NULL,
  `custom_charges` char(1) DEFAULT NULL,
  `side_battery` varchar(30) DEFAULT NULL,
  `main_battery` enum('Yes','No') NOT NULL,
  `status` enum('W','NW','U') NOT NULL DEFAULT 'W',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `in_date` datetime DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `department` enum('HR','Admin','ITS','Producers','Testers') NOT NULL,
  `role` varchar(64) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=420 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `department`, `role`, `created`, `modified`, `status`) VALUES
(1, 'Admin', 'admin', 'bff6325bbdab45abf166ed8daabd7f479d0b2064', 'admin@procentris.com', 'ITS', NULL, NULL, NULL, 1),
(3, 'Derick Pereira', 'derick@procentris.com', NULL, 'derick@procentris.com', 'Admin', NULL, NULL, '2014-07-02 08:36:33', 1),
(11, 'Shailesh Joisher', 'shailesh@procentris.com', NULL, 'shailesh@procentris.com', 'ITS', NULL, NULL, NULL, 1),
(13, 'Sameer Dhodapkar', 'sameer@procentris.com', NULL, 'sameer@procentris.com', 'ITS', NULL, NULL, NULL, 1),
(16, 'Kamlesh Harijan', 'kamlesh@procentris.com', NULL, 'kamlesh@procentris.com', 'ITS', NULL, NULL, NULL, 1),
(17, 'Sandip Dhurat', 'sandip@procentris.com', NULL, 'sandip@procentris.com', 'HR', NULL, NULL, '2014-07-02 08:32:35', 0),
(19, 'Tapan Chowdhury', 'tapan@procentris.com', NULL, 'tapan@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(23, 'Manasi Devrukhkar', 'manasi@procentris.com', NULL, 'manasi@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(28, 'Manisha Aher', 'manisha@procentris.com', NULL, 'manisha@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(30, 'Rajen Shah', 'rajen@procentris.com', NULL, 'rajen@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(32, 'Alka Singh', 'alka@procentris.com', NULL, 'alka@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(35, 'Amita Gupta', 'amita@procentris.com', NULL, 'amita@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(44, 'Sudarshan D.', 'sudarshan@procentris.com', NULL, 'sudarshan@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(84, 'Venugopal C R', 'venugopal@procentris.com', NULL, 'venugopal@procentris.com', 'ITS', NULL, NULL, NULL, 1),
(101, 'Santosh Rachawar', 'santosh@procentris.com', NULL, 'santosh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(114, 'Janak Prajapati', 'janak@procentris.com', NULL, 'janak@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(121, 'Sachin Singh', 'sachin@procentris.com', NULL, 'sachin@procentris.com', 'ITS', NULL, NULL, NULL, 1),
(125, 'Sandeep Jaiswal', 'sandeepj@procentris.com', NULL, 'sandeepj@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(133, 'Revathi Kalyanasundaram', 'revathi@procentris.com', NULL, 'revathi@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(137, 'Sushma Mohite', 'sushmam@procentris.com', NULL, 'sushmam@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(142, 'Rahul Bansode', 'rahul@procentris.com', NULL, 'rahul@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(154, 'Prabha Chakravarthy', 'prabha@procentris.com', NULL, 'prabha@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(170, 'Lawrence Avidan', 'larryav@procentris.com', NULL, 'larryav@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(183, 'Susheel Jangam', 'susheel@procentris.com', NULL, 'susheel@procentris.com', 'ITS', NULL, NULL, NULL, 1),
(192, 'Prathmesh Kolaskar', 'prathmesh@procentris.com', NULL, 'prathmesh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(198, 'Komal Abrol', 'komal@procentris.com', NULL, 'komal@procentris.com', 'HR', NULL, NULL, NULL, 1),
(204, 'Kartik Thakkar', 'kartik@procentris.com', NULL, 'kartik@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(208, 'Amit Kumar Singh', 'amitk@procentris.com', NULL, 'amitk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(218, 'Namrata Mohata', 'namratam@procentris.com', NULL, 'namratam@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(221, 'Appurava Khicha', 'appurava@procentris.com', NULL, 'appurava@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(223, 'Vikash Mehta', 'vikash@procentris.com', NULL, 'vikash@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(229, 'Gayle Simon', 'Gaylesimon@procentris.com', NULL, 'Gaylesimon@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(230, 'Shobha Thorve', 'shobha@procentris.com', NULL, 'shobha@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(231, 'Hemant Ghodke', 'hemant@procentris.com', NULL, 'hemant@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(232, 'Preeti Sharma', 'preetis@procentris.com', NULL, 'preetis@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(234, 'Saurabh Chandra', 'saurabh@procentris.com', NULL, 'saurabh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(246, 'Sanket Harad', 'sanket@procentris.com', NULL, 'sanket@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(247, 'Koushik Nandy', 'koushik@procentris.com', NULL, 'koushik@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(248, 'Kumar Varun', 'kumarv@procentris.com', NULL, 'kumarv@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(249, 'Parshuram Vishwakarma', 'parshuram@procentris.com', NULL, 'parshuram@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(250, 'Sandip Gaikwad', 'sandipg@procentris.com', NULL, 'sandipg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(251, 'Priti Jagtap', 'pritij@procentris.com', NULL, 'pritij@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(252, 'Mahesh Mane', 'maheshm@procentris.com', NULL, 'maheshm@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(253, 'Santu Sarkar', 'santu@procentris.com', NULL, 'santu@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(254, 'Sukanta Sana', 'sukanta@procentris.com', NULL, 'sukanta@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(256, 'Ravindra Mitke', 'rvmitke@procentris.com', NULL, 'rvmitke@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(257, 'Anish Patil', 'anishp@procentris.com', NULL, 'anishp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(258, 'Manoranjan Nanda', 'manoranjan@procentris.com', NULL, 'manoranjan@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(259, 'Anil Gupta', 'anil@procentris.com', NULL, 'anil@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(260, 'Satish Sadaphule', 'satishs@procentris.com', NULL, 'satishs@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(261, 'Dharam Veer Singh', 'dharam@procentris.com', NULL, 'dharam@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(262, 'Sijo George', 'sijo@procentris.com', NULL, 'sijo@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(263, 'Rajendra Todkari', 'rajendra@procentris.com', NULL, 'rajendra@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(264, 'Bhumika Dedhia', 'bhumika@procentris.com', NULL, 'bhumika@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(266, 'Sushant Kumar Nayak', 'sushantn@procentris.com', NULL, 'sushantn@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(267, 'Monali Kedare', 'monali@procentris.com', NULL, 'monali@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(268, 'Anil Vadhavane', 'anilv@procentris.com', NULL, 'anilv@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(269, 'Harshala Shinde', 'harshala@procentris.com', NULL, 'harshala@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(270, 'Rajashri Jagkar', 'rajashri@procentris.com', NULL, 'rajashri@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(271, 'Sudhakar Ahiwale', 'sudhakar@procentris.com', NULL, 'sudhakar@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(272, 'Vinayak Gorade', 'vinayak@procentris.com', NULL, 'vinayak@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(273, 'Suparno', 'suparno@procentris.com', NULL, 'suparno@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(274, 'Shahnawaz Ansari', 'shahnawaz@procentris.com', NULL, 'shahnawaz@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(275, 'Prathip Kattekola', 'prathip@procentris.com', NULL, 'prathip@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(276, 'Om Prakash', 'omprakash@procentris.com', NULL, 'omprakash@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(277, 'Kavita Dattani', 'Kavitad@procentris.com', NULL, 'Kavitad@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(278, 'Sanjeev Menon', 'sanjeev@procentris.com', NULL, 'sanjeev@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(279, 'Krishnapratap Vedula', 'krishnapratap@procentris.com', NULL, 'krishnapratap@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(280, 'Anil Gohil', 'anilgohil@procentris.com', NULL, 'anilgohil@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(281, 'Madhura Gavali', 'madhurag@procentris.com', NULL, 'madhurag@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(282, 'Balaji Gaikwad', 'balaji@procentris.com', NULL, 'balaji@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(283, 'Manoj Lonar', 'manoj@procentris.com', NULL, 'manoj@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(284, 'Sounyak Chakraborty', 'sounyak@procentris.com', NULL, 'sounyak@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(285, 'Anant Prabhu', 'anant@procentris.com', NULL, 'anant@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(286, 'Satish Kharatmol', 'satishk@procentris.com', NULL, 'satishk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(287, 'Santosh Paramanick', 'santoshp@procentris.com', NULL, 'santoshp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(289, 'Anand Gajbhiv', 'anand@procentris.com', NULL, 'anand@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(290, 'Chandragiri Yoseph', 'chandragiri@procentris.com', NULL, 'chandragiri@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(291, 'Naresh Sharma', 'naresh@procentris.com', NULL, 'naresh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(292, 'Vijay Kokane', 'vijayk@procentris.com', NULL, 'vijayk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(293, 'Ghanshyam Saxena', 'ghanshyam@procentris.com', NULL, 'ghanshyam@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(294, 'Partha Sarathi Dutta', 'partha@procentris.com', NULL, 'partha@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(295, 'Devika Kubal', 'devika@procentris.com', NULL, 'devika@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(297, 'Ravibhushan Gaikwad', 'ravibhushan@procentris.com', NULL, 'ravibhushan@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(298, 'Jituraj Gaikwad', 'jituraj@procentris.com', NULL, 'jituraj@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(299, 'Suresh Maharana', 'suresh@procentris.com', NULL, 'suresh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(300, 'George Ekka', 'georgee@procentris.com', NULL, 'georgee@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(301, 'Kishalay Mandal', 'kishalay@procentris.com', NULL, 'kishalay@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(302, 'Vaidehi Desai', 'vaidehi@procentris.com', NULL, 'vaidehi@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(303, 'Bhoomi Desai', 'bhoomi@procentris.com', NULL, 'bhoomi@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(304, 'Arun Yadav', 'arun@procentris.com', NULL, 'arun@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(305, 'Mitesh Bhanushali', 'mitesh@procentris.com', NULL, 'mitesh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(306, 'Hariraja', 'hariraja@procentris.com', NULL, 'hariraja@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(307, 'Tejas Sarwade', 'tejass@procentris.com', NULL, 'tejass@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(308, 'Mayur Paradkar', 'mayurp@procentris.com', NULL, 'mayurp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(309, 'Juhi Tyagi', 'juhi@procentris.com', NULL, 'juhi@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(310, 'Pranita Kulkarni', 'pranitak@procentris.com', NULL, 'pranitak@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(311, 'Sucharita Ghosh', 'sucharitag@procentris.com', NULL, 'sucharitag@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(312, 'Tarashankar Sarkar', 'tarashankar@procentris.com', NULL, 'tarashankar@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(313, 'Seraj Khan', 'serajk@procentris.com', NULL, 'serajk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(314, 'Dipeeka Gaikwad', 'dipeeka@procentris.com', NULL, 'dipeeka@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(315, 'Manjeet Kaur', 'manjeet@procentris.com', NULL, 'manjeet@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(316, 'Priyanka Das', 'priyankad@procentris.com', NULL, 'priyankad@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(317, 'Rahul Saxena', 'rahuls@procentris.com', NULL, 'rahuls@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(318, 'Paresh Singh', 'pareshs@procentris.com', NULL, 'pareshs@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(319, 'Suzanna Correia', 'suzanna@procentris.com', NULL, 'suzanna@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(320, 'Tejesh Bhalerao', 'tejesh@procentris.com', NULL, 'tejesh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(321, 'Kunal Jadhav', 'kunalj@procentris.com', NULL, 'kunalj@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(322, 'Yogesh Gaikwad', 'yogeshg@procentris.com', NULL, 'yogeshg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(323, 'Vishwanath Parande', 'vishwanathp@procentris.com', NULL, 'vishwanathp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(324, 'Karankumar Shinde', 'karankumars@procentris.com', NULL, 'karankumars@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(325, 'Ravindra Kotapally', 'ravindrak@procentris.com', NULL, 'ravindrak@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(326, 'Pramod Varak', 'pramodv@procentris.com', NULL, 'pramodv@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(327, 'Rohit Gaikwad', 'rohitg@procentris.com', NULL, 'rohitg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(328, 'Kishor Pagare', 'kishorp@procentris.com', NULL, 'kishorp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(329, 'Rohit Sonawane', 'rohits@procentris.com', NULL, 'rohits@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(330, 'Nikhil Misale', 'nikhilm@procentris.com', NULL, 'nikhilm@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(331, 'Pravin Tribhuvan', 'pravint@procentris.com', NULL, 'pravint@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(332, 'Kumar Prabhakar', 'kumar@procentris.com', NULL, 'kumar@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(333, 'Sourav Banerjee', 'sourav@procentris.com', NULL, 'sourav@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(334, 'Swapnil Jadhav', 'swapnilj@procentris.com', NULL, 'swapnilj@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(335, 'Arshad Ali', 'arshada@procentris.com', NULL, 'arshada@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(336, 'Pankaj Katke', 'pankajk@procentris.com', NULL, 'pankajk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(337, 'Nitesh Narkar', 'niteshn@procentris.com', NULL, 'niteshn@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(338, 'Santanu Mitra', 'santanu@procentris.com', NULL, 'santanu@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(339, 'Sachin Mahajan', 'sachinm@procentris.com', NULL, 'sachinm@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(340, 'Rafeeq Sarang', 'rafeeqs@procentris.com', NULL, 'rafeeqs@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(341, 'Santosh Kitta', 'santoshk@procentris.com', NULL, 'santoshk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(342, 'Vinod Gurav', 'vinodg@procentris.com', NULL, 'vinodg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(343, 'Chandrashekhar Dawal', 'chandrashekhard@procentris.com', NULL, 'chandrashekhard@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(344, 'Shailesh Shinde', 'shaileshs@procentris.com', NULL, 'shaileshs@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(345, 'Ashish Pathak', 'ashishp@procentris.com', NULL, 'ashishp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(346, 'Sunil Pagare', 'sunilp@procentris.com', NULL, 'sunilp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(347, 'Karan Yenna', 'karany@procentris.com', NULL, 'karany@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(348, 'Prakash Dhananjayan', 'prakashd@procentris.com', NULL, 'prakashd@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(349, 'Azar Sharif', 'azars@procentris.com', NULL, 'azars@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(350, 'Sunil Keswani', 'sunilk@procentris.com', NULL, 'sunilk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(351, 'Vinod Fiske', 'vinodf@procentris.com', NULL, 'vinodf@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(352, 'Iftekhar Ahmed', 'iftekhara@procentris.com', NULL, 'iftekhara@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(353, 'Ganesh Ghorpade', 'ganeshg@procentris.com', NULL, 'ganeshg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(354, 'Prathmesh Jadhav', 'prathmeshj@procentris.com', NULL, 'prathmeshj@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(355, 'Kiran Ujagare', 'Kiranu@procentris.com', NULL, 'Kiranu@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(356, 'Shashank Kadam', 'shashank@procentris.com', NULL, 'shashank@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(357, 'Govindraj Marimuthu', 'govindrajm@procentris.com', NULL, 'govindrajm@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(358, 'Avinash Shelar', 'avinashs@procentris.com', NULL, 'avinashs@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(359, 'Yogesh Rajput', 'yogeshr@procentris.com', NULL, 'yogeshr@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(360, 'Sachin Thorat', 'sachint@procentris.com', NULL, 'sachint@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(361, 'Jitesh Naiknavare', 'jiteshn@procentris.com', NULL, 'jiteshn@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(362, 'Avinash Gupta', 'avinashg@procentris.com', NULL, 'avinashg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(364, 'Govind Yadav', 'govindy@procentris.com', NULL, 'govindy@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(365, 'Shivprasad V', 'shivprasadv@procentris.com', NULL, 'shivprasadv@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(366, 'Neeraj Pandav', 'neerajp@procentris.com', NULL, 'neerajp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(367, 'Aditya Kandke', 'adityak@procentris.com', NULL, 'adityak@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(368, 'Laxman Chavan', 'laxmanc@procentris.com', NULL, 'laxmanc@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(369, 'Swapnil Billare', 'swapnilb@procentris.com', NULL, 'swapnilb@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(371, 'Arijit Das', 'arijit@procentris.com', NULL, 'arijit@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(373, 'Gouranga Das', 'gouranga@procentris.com', NULL, 'gouranga@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(374, 'Arsalan Sayed', 'arsalan@procentris.com', NULL, 'arsalan@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(375, 'Rupesh Sawardekar', 'rupesh@procentris.com', NULL, 'rupesh@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(376, 'Harshad Thorat', 'harshadt@procentris.com', NULL, 'harshadt@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(377, 'Yatin Patil', 'yatinp@procentris.com', NULL, 'yatinp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(378, 'Amol Kshetre', 'amolk@procentris.com', NULL, 'amolk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(379, 'Pramod Pagare', 'pramodp@procentris.com', NULL, 'pramodp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(380, 'Farhan Majgaonkar', 'farhanm@procentris.com', NULL, 'farhanm@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(381, 'Jitendra Phopale', 'jitendrap@procentris.com', NULL, 'jitendrap@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(382, 'Saritha Botla', 'sarithab@procentris.com', NULL, 'sarithab@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(383, 'Mahesh Bhanushali', 'maheshb@procentris.com', NULL, 'maheshb@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(384, 'Vishal Sonawale', 'vishals@procentris.com', NULL, 'vishals@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(385, 'Mahendra Gaikwad', 'mahendrag@procentris.com', NULL, 'mahendrag@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(386, 'Siddhant Ghadge', 'siddhantg@procentris.com', NULL, 'siddhantg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(387, 'Amol Kadam', 'amolkadam@procentris.com', NULL, 'amolkadam@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(388, 'Rajesh Pawar', 'rajeshp@procentris.com', NULL, 'rajeshp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(389, 'Vishal Bhosle', 'vishalb@procentris.com', NULL, 'vishalb@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(390, 'Roshan Suryagandh', 'roshans@procentris.com', NULL, 'roshans@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(392, 'Karan Ramulu', 'karanr@procentris.com', NULL, 'karanr@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(393, 'Salim Sharif', 'salims@procentris.com', NULL, 'salims@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(394, 'Aatish Kharat', 'aatishk@procentris.com', NULL, 'aatishk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(395, 'Abhishek Warang', 'abhishekw@procentris.com', NULL, 'abhishekw@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(396, 'Ajit Kamble', 'ajitk@procentris.com', NULL, 'ajitk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(397, 'Manjar Ansari', 'manjara@procentris.com', NULL, 'manjara@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(398, 'Devendra Parab', 'devendrap@procentris.com', NULL, 'devendrap@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(399, 'Sahil Pawar', 'sahilp@procentris.com', NULL, 'sahilp@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(400, 'Somnath Das', 'somnathd@procentris.com', NULL, 'somnathd@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(401, 'Mayur Kshetre', 'mayurk@procentris.com', NULL, 'mayurk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(402, 'Janardan Tupe', 'janardant@procentris.com', NULL, 'janardant@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(403, 'Nitin Kasar', 'nitink@procentris.com', NULL, 'nitink@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(404, 'Salahuddin Abbasi', 'salahuddina@procentris.com', NULL, 'salahuddina@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(405, 'Shashikant Kasarwani', 'shashikantk@procentris.com', NULL, 'shashikantk@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(406, 'Farhan Mirza', 'farhanmirza@procentris.com', NULL, 'farhanmirza@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(407, 'Ashish Nikam', 'ashishn@procentris.com', NULL, 'ashishn@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(408, 'Amol Ghurye', 'amolg@procentris.com', NULL, 'amolg@procentris.com', 'Producers', NULL, NULL, NULL, 1),
(409, 'Paul', 'paul@procentris.com', NULL, 'paul@procentris.com', '', NULL, NULL, NULL, 1),
(410, 'taxe', 'taxe@procentris.com', NULL, 'taxe@procentris.com', '', NULL, NULL, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
