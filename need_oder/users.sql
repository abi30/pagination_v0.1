-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 02:48 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `procedure`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `salary` decimal(20,2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `group_name` varchar(50) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `salary`, `email`, `update_at`, `group_name`) VALUES
(17, 'abdulla ', '4567.00', 'alrakib@arisecur.com', '2022-05-04 08:05:11', 'Active'),
(19, 'thth', '435.00', 'dfgsfdadfsaf@fsdsfas.ca', '2022-05-04 08:47:25', 'Active'),
(36, 'abdulla ', '88888.00', '', '2022-05-03 07:42:16', 'Active'),
(37, 'abdulla ', '77777.00', '', '2022-05-03 07:42:16', 'Active'),
(38, 'abdulla ', '543.00', 'dsfoisdsdf@ggoa.com', '2022-05-03 15:26:37', 'Active'),
(40, 'gjhh', '321.00', 'zt', '2022-05-04 08:00:37', 'Active'),
(41, 'gjhh', '320.00', 'rakib0751@gmail.com', '2022-05-04 11:16:43', 'Active'),
(44, 'fgfrrsd', '45543.00', 'dsfoisdsdf@ggoa.com', '2022-05-03 15:26:27', 'Active'),
(46, 'abdulla ', '55645.00', '', '2022-05-03 15:28:46', 'Active'),
(56, 'mr abdullla ', '3421.00', 'emaple@ar.com', '2022-05-03 10:26:09', 'Active'),
(64, 'abdulla al rakib', '123.00', 'rakib0751@gmail.com', '2022-05-04 08:18:12', 'Active'),
(66, 'dfgdffd', '34343.00', 'dssd@sdfdsds', '2022-05-04 08:20:47', 'Active'),
(67, 'xxxyyy', '111222.00', 'xxxyyy@com.com', '2022-05-04 08:44:18', 'Active'),
(73, 'abdulla ', '3434.00', 'rakib0751@gmail.com', '2022-05-04 10:01:58', 'Active'),
(80, 'fgfrrsd', '343.66', 'rertertre@erttre.at', '2022-05-04 10:19:35', 'Active'),
(81, '334343dfsdfsdfsda', '0.00', 'sdfdsd@aasd.dsa', '2022-05-04 10:21:49', 'Active'),
(82, 'abdulla ', '3434.43', 'kdjioeds@grimfa.d', '2022-05-04 11:10:23', 'Active'),
(83, 'sdfsd', '222.54', 'dsfoisdsdf@ggoa.com', '2022-05-04 11:10:57', 'Active'),
(84, 'abdulla ', '3434.54', 'rakib0751@gmail.com', '2022-05-04 11:12:17', 'Active'),
(87, 'abdulla ', '4576.00', 'rakib0751@gmail.com', '2022-05-04 11:20:17', 'Active'),
(88, 'abdulla ', '3434.43', 'alrakib@arisecur.com', '2022-05-04 11:20:42', 'Active'),
(89, 'abdulla ', '123.43', 'rakib0751@raa.com', '2022-05-04 11:23:43', 'Active'),
(91, 'abdulla ', '3434.43', 'rakib0751@gmail.com', '2022-05-04 14:18:56', 'Active'),
(92, 'abdulla ', '4567.00', 'alrakib@arisecur.com', '2022-05-04 08:05:11', 'Active'),
(93, 'thth', '435.00', 'dfgsfdadfsaf@fsdsfas.ca', '2022-05-06 11:35:09', 'inactive'),
(94, 'abdulla ', '88888.00', '', '2022-05-05 14:18:58', 'inactive'),
(95, 'abdulla ', '77777.00', '', '2022-05-05 14:18:58', 'inactive'),
(96, 'abdulla ', '543.00', 'dsfoisdsdf@ggoa.com', '2022-05-05 14:18:58', 'inactive'),
(97, 'gjhh', '321.00', 'zt', '2022-05-05 14:18:58', 'inactive'),
(98, 'gjhh', '320.00', 'rakib0751@gmail.com', '2022-05-05 14:18:58', 'inactive'),
(99, 'gjhh', '321.00', 'sds@gfhfhfg', '2022-05-05 14:18:58', 'inactive'),
(100, 'fgfrrsd', '45543.00', 'rakib0751@gmail.com', '2022-05-05 14:18:58', 'inactive'),
(101, 'fgfrrsd', '45543.00', 'dsfoisdsdf@ggoa.com', '2022-05-05 14:18:58', 'inactive'),
(102, 'abdulla ', '55645.00', '', '2022-05-05 14:18:58', 'inactive'),
(121, 'abdulla ', '4567.00', 'alrakib@arisecur.com', '2022-05-04 08:05:11', 'Active'),
(122, 'thth', '435.00', 'dfgsfdadfsaf@fsdsfas.ca', '2022-05-04 08:47:25', 'Active'),
(123, 'abdulla ', '88888.00', '', '2022-05-03 07:42:16', 'Active'),
(124, 'abdulla ', '77777.00', '', '2022-05-03 07:42:16', 'Active'),
(125, 'abdulla ', '543.00', 'dsfoisdsdf@ggoa.com', '2022-05-03 15:26:37', 'Active'),
(126, 'gjhh', '321.00', 'zt', '2022-05-04 08:00:37', 'Active'),
(127, 'gjhh', '320.00', 'rakib0751@gmail.com', '2022-05-04 11:16:43', 'Active'),
(128, 'fgfrrsd', '45543.00', 'dsfoisdsdf@ggoa.com', '2022-05-03 15:26:27', 'Active'),
(129, 'abdulla ', '55645.00', '', '2022-05-03 15:28:46', 'Active'),
(130, 'mr abdullla ', '3421.00', 'emaple@ar.com', '2022-05-03 10:26:09', 'Active'),
(131, 'abdulla al rakib', '123.00', 'rakib0751@gmail.com', '2022-05-04 08:18:12', 'Active'),
(132, 'dfgdffd', '34343.00', 'dssd@sdfdsds', '2022-05-04 08:20:47', 'Active'),
(133, 'xxxyyy', '111222.00', 'xxxyyy@com.com', '2022-05-04 08:44:18', 'Active'),
(134, 'abdulla ', '3434.00', 'rakib0751@gmail.com', '2022-05-04 10:01:58', 'Active'),
(135, 'fgfrrsd', '343.66', 'rertertre@erttre.at', '2022-05-04 10:19:35', 'Active'),
(136, '334343dfsdfsdfsda', '0.00', 'sdfdsd@aasd.dsa', '2022-05-04 10:21:49', 'Active'),
(137, 'abdulla ', '3434.43', 'kdjioeds@grimfa.d', '2022-05-04 11:10:23', 'Active'),
(138, 'sdfsd', '222.54', 'dsfoisdsdf@ggoa.com', '2022-05-04 11:10:57', 'Active'),
(139, 'abdulla ', '3434.54', 'rakib0751@gmail.com', '2022-05-04 11:12:17', 'Active'),
(140, 'abdulla ', '4576.00', 'rakib0751@gmail.com', '2022-05-04 11:20:17', 'Active'),
(141, 'abdulla ', '3434.43', 'alrakib@arisecur.com', '2022-05-04 11:20:42', 'Active'),
(142, 'abdulla ', '123.43', 'rakib0751@raa.com', '2022-05-04 11:23:43', 'Active'),
(143, 'abdulla ', '3434.43', 'rakib0751@gmail.com', '2022-05-04 14:18:56', 'Active'),
(144, 'abdulla ', '4567.00', 'alrakib@arisecur.com', '2022-05-04 08:05:11', 'Active'),
(145, 'thth', '435.00', 'dfgsfdadfsaf@fsdsfas.ca', '2022-05-06 11:35:05', 'inactive'),
(146, 'abdulla ', '88888.00', '', '2022-05-05 14:18:58', 'inactive'),
(147, 'abdulla ', '77777.00', '', '2022-05-05 14:18:58', 'inactive'),
(148, 'abdulla ', '543.00', 'dsfoisdsdf@ggoa.com', '2022-05-05 14:18:58', 'inactive'),
(149, 'gjhh', '321.00', 'zt', '2022-05-05 14:18:58', 'inactive'),
(150, 'gjhh', '320.00', 'rakib0751@gmail.com', '2022-05-05 14:18:58', 'inactive'),
(151, 'gjhh', '321.00', 'sds@gfhfhfg', '2022-05-05 14:18:58', 'inactive'),
(152, 'fgfrrsd', '45543.00', 'rakib0751@gmail.com', '2022-05-05 14:18:58', 'inactive'),
(153, 'fgfrrsd', '45543.00', 'dsfoisdsdf@ggoa.com', '2022-05-05 14:18:58', 'inactive'),
(154, 'abdulla ', '55645.00', '', '2022-05-05 14:18:58', 'inactive'),
(155, 'fgfrrsd', '45543.00', 'rakib0751@gmail.com', '2022-05-05 14:18:58', 'inactive'),
(156, 'fgfrrsd', '45543.00', 'dsfoisdsdf@ggoa.com', '2022-05-05 14:18:58', 'inactive'),
(157, 'abdulla ', '55645.00', '', '2022-05-05 14:18:58', 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
